<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class domains extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'domains'));
        $this->load->library('form_validation');
        $this->load->model('_domains','',true);
        $this->load->model('_groups','',true);
    }

    public function index()
    {
        $gid = $this->input->get("gid") ? $this->input->get("gid") : 0;
        $domains = $this->_domains->get_domains($gid);
        $groups = $this->_groups->get_groups();
        $this->load->view("layout/header");
        $this->load->view('domains/list', array('domains' => $domains, 'groups' => $groups, "gid" => $gid));
        $this->load->view('domains/index', array('domains' => $domains));
        $this->load->view("layout/footer");
    }

    public function records($id = null)
    {
        $gid = $this->input->get("gid") ? $this->input->get("gid") : 0;

        if ($dgid = $this->input->post("domain_group"))
        {
            $this->_groups->move($dgid, $id);
            redirect("/domains/records/".$id."?gid=".$gid);
        }

        $domains = $this->_domains->get_domains($gid);
        $groups = $this->_groups->get_groups();
        $domain = $this->_domains->get_domain($id);

        $records = $this->_domains->get_records($id);
        $grecords = array();
        $soa = array();
        foreach($records as $record)
            if ($record->type == "SOA") {
                $soa_record = explode(" ", $record->content);
                $soa_email = explode(".", $soa_record[1]);
                $soa_email_user = $soa_email[0];
                unset($soa_email[0]);
                $soa_email_host = implode(".", $soa_email);
                $soa_email = $soa_email_user."@".$soa_email_host;
                $soa["ns"] = $soa_record[0];
                $soa["email"] = $soa_email;
                $soa["serial"] = $soa_record[2];
                $soa["refresh"] = $soa_record[3];
                $soa["retry"] = $soa_record[4];
                $soa["expire"] = $soa_record[5];
                $soa["ttl"] = $soa_record[6];
                $soa["change_date"] = time_ago($record->change_date);
            } else {
                $grecords[$record->type][] = $record;
            }

        $this->load->view("layout/header");
        $this->load->view('domains/list', array('domains' => $domains, 'groups' => $groups, "gid" => $gid, 'domain' => $domain));
        $this->load->view('domains/records', array('domains' => $domains, 'groups' => $groups, "gid" => $gid, 'domain' => $domain, 'grecords' => $grecords, "soa" => $soa));
        $this->load->view("layout/footer");
    }

    public function export($id = null) {
        $domain = $this->_domains->get_domain($id);
        $domain->records = $this->_domains->get_records($id);
        header('Content-disposition: attachment; filename='.$domain->name.'.json');
        header('Content-Type: application/json');
        print_r(json_encode($domain));
    }

    public function remove() {
        $id = $this->input->post("remove_domain_id");
        $this->_domains->remove_domain($id);
        redirect("/domains");
    }

    public function add_record() {

        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('ttl', 'TTL', 'required|greater_than[299]');
        $this->form_validation->set_rules('priority', 'Priority', 'required|numeric');

        $return = array();
        if ($this->form_validation->run() == FALSE)
        {
            $return = array("status" => 0, "errors" => array(
                "name" => form_error("name"),
                "type" => form_error("type"),
                "content" => form_error("content"),
                "ttl" => form_error("ttl"),
                "priority" => form_error("priority")
            ));
        }
        else
        {
            $did = $this->input->post("did");
            $this->_domains->add_record($did, array(
                "name" => $this->input->post("name") ? $this->input->post("name") . "." . $this->input->post("domain_name") : $this->input->post("domain_name"),
                "type" => $this->input->post("type"),
                "content" => $this->input->post("content"),
                "ttl" => $this->input->post("ttl"),
                "priority" => $this->input->post("priority")
            ));
            $return = array("status" => 1);
        }
        echo json_encode($return);
    }

    public function add()
    {

        $gid = $this->input->get("gid") ? $this->input->get("gid") : 0;
        $domains = $this->_domains->get_domains($gid);
        $groups = $this->_groups->get_groups();

        $this->form_validation->set_rules('domain_name', 'Domain name', 'required|callback_valid_fqdn|callback_unique_name');
        $this->form_validation->set_rules('domain_email', 'Hostmaster email', 'required|valid_email');
        $this->form_validation->set_rules('domain_ttl', 'Domain TTL', 'required|greater_than[299]');
        $this->form_validation->set_rules('domain_group', 'Group', 'required');

        $form = array(
            "domain_name" => array(
                "id" => "domain_name",
                "name" => "domain_name",
                "value" => $this->input->post("domain_name"),
                "placeholder" => "domain.tld",
                "label" => "Domain name"
            ),
            "domain_email" => array(
                "id" => "domain_email",
                "name" => "domain_email",
                "value" => $this->input->post("domain_email"),
                "placeholder" => "hostmaster@domain.tld",
                "label" => "Hostmaster email"
            ),
            "domain_ttl" => array(
                "id" => "domain_ttl",
                "name" => "domain_ttl",
                "value" => $this->input->post("domain_ttl"),
                "placeholder" => "300",
                "label" => "TTL (seconds)"
            ),
            "domain_group" => array(
                "id" => "domain_group",
                "name" => "domain_group",
                "label" => "Group",
                "value" => $this->input->post("domain_group") ? $this->input->post("domain_group") : $gid,
                "options" => $this->_groups->get_groups(true)
            )
        );

        $this->load->view("layout/header");
        $this->load->view('domains/list', array('domains' => $domains, 'groups' => $groups, "gid" => $gid));

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('domains/add', array('form' => $form));
        }
        else
        {
            $domain_id = $this->_domains->add_domain(array(
                "domain_name" => $this->input->post("domain_name"),
                "domain_email" => $this->input->post("domain_email"),
                "domain_ttl" => $this->input->post("domain_ttl"),
                "domain_group" => $this->input->post("domain_group")
            ));

            if ($domain_id) redirect("/domains/records/".$domain_id);

            $this->load->view('domains/add', array('form' => $form, 'errors' => "System error. Cannot add domain."));

        }

        $this->load->view("layout/footer");

    }

    public function valid_fqdn($FQDN) {
        $this->form_validation->set_message('valid_fqdn','%s is not valid.');
        return (!empty($FQDN) && preg_match('/(?=^.{1,254}$)(^(?:(?!\d|-)[a-z0-9\-]{1,63}(?<!-)\.)+(?:[a-z]{2,})$)/i', $FQDN) > 0);
    }

    public function unique_name($name) {
        $this->form_validation->set_message('unique_name','%s already exists.');
        return $this->_domains->get_domain_by_name($name) ? FALSE : TRUE;
    }


}