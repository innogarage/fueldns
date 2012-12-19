<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _domains extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->config->load('fueldns', TRUE);
    }

    function get_domains($gid = null)
    {
        if ((int)$gid > 0)
            $query = $this->db->query("SELECT * FROM domains WHERE group_id = $gid ORDER BY id DESC");
        else
            $query = $this->db->query("SELECT * FROM domains ORDER BY id DESC");
        return $query->result();
    }

    function get_records($id)
    {
//        $this->db->select('*');
//        $this->db->where("domain_id", $id);
//        $this->db->group_by('type');
//        $this->db->order_by('change_date', 'desc');
//        $query = $this->db->get('records');
//
//        print_r($query->result());

        $query = $this->db->query("SELECT * FROM records WHERE domain_id = $id");
        return $query->result();
    }

    function get_domain($id)
    {
        $query = $this->db->query("SELECT * FROM domains WHERE id = $id");
        return $query->row();
    }

    function get_domain_by_name($name)
    {
        $query = $this->db->query("SELECT * FROM domains WHERE name = '".$name."'");
        return $query->row();
    }

    function remove_domain($id)
    {
        $this->db->delete('domains', array('id' => $id));
        $this->db->delete('records', array('domain_id' => $id));
    }

    function add_record($did, $data = array()) {
        $record = array(
            "domain_id" => $did,
            "name" => $data['name'],
            "type" => $data['type'],
            "content" => $data['content'],
            "ttl" => $data['ttl'],
            "change_date" => time(),
            "prio" => $data['priority']
        );
        $soa_q = $this->db->query("SELECT * FROM records WHERE domain_id = $did AND type = 'SOA'");
        $soa_r = $soa_q->row();
        $soa = $soa_r->content;
        $soa = explode(" ", $soa);
        $soa[2] = substr($soa[2], 0, -2) == date("Ymd",time()) ? $soa[2] + 1 : date("Ymd",time()) . "01";
        $this->db->update('records', array("content" => implode(" ", $soa), "change_date" => time()), array('domain_id' => $did, "type" => "SOA"));
        $this->db->insert("records", $record);
    }

    function add_domain($data = array())
    {
        $nameservers = $this->config->item('nameservers', 'fueldns');
        $domain = array(
            "name" => $data['domain_name'],
            "group_id" => $data['domain_group']
        );

        $this->db->insert("domains", $domain);
        $domain_id = $this->db->insert_id();

        $serial = date("Ymd",time()) . "01";

        $soa = array(array(
            "domain_id" => $domain_id,
            "name" => $data['domain_name'],
            "type" => "SOA",
            "content" => $nameservers['ns1']['host'] . " " . str_replace("@", ".", $data['domain_email']) . " " . $serial . " 3600 600 86400 " . $data['domain_ttl'],
            "ttl" => $data['domain_ttl'],
            "change_date" => time(),
            "prio" => 0
        ));
        $ns = array();
        foreach($nameservers as $_ns) {
            $ns[] = array(
                "domain_id" => $domain_id,
                "name" => $data['domain_name'],
                "type" => "NS",
                "content" => $_ns['host'],
                "ttl" => $data['domain_ttl'],
                "change_date" => time(),
                "prio" => 0
            );
        }
        $records = array_merge($soa, $ns);
        $this->db->insert_batch("records", $records);

        return $domain_id;
    }

    function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}