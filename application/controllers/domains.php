<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class domains extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('_domains','',true);
    }

    public function index()
    {
        $domains = $this->_domains->get_domains();
        $this->load->view("layout/header");
        $this->load->view('domains/list', array('domains' => $domains));
        $this->load->view('domains/index', array('domains' => $domains));
        $this->load->view("layout/footer");
    }

    public function records($id = null)
    {
        $domains = $this->_domains->get_domains();
        $domain = $this->_domains->get_domain($id);
        $records = $this->_domains->get_records($id);
        $this->load->view("layout/header");
        $this->load->view('domains/list', array('domains' => $domains, 'domain' => $domain));
        $this->load->view('domains/records', array('domains' => $domains, 'domain' => $domain, 'records' => $records));
        $this->load->view("layout/footer");
    }

    public function export($id = null) {
        $domain = $this->_domains->get_domain($id);
        $domain->records = $this->_domains->get_records($id);
        header('Content-disposition: attachment; filename='.$domain->name.'.json');
        header('Content-Type: application/json');
        print_r(json_encode($domain));
    }

    public function add()
    {
        $domains = $this->_domains->get_domains();
        $this->load->view("layout/header");
        $this->load->view('domains/list', array('domains' => $domains));
        $this->load->view('domains/add', array());
        $this->load->view("layout/footer");
    }

}