<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class groups extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('_groups','',true);
    }

    public function index()
    {
        $this->load->view("groups/index");
    }

    public function ajax_list($id = null)
    {
        $form = array(
            "domain_group" => array(
                "id" => "domain_group",
                "name" => "domain_group",
                "label" => "Group",
                "value" => $id,
                "options" => $this->_groups->get_groups(true)
            )
        );
        $this->load->view("groups/ajax_list", array("form" => $form));
    }

    public function ajax_add()
    {

        if ($group_name = $this->input->post("group_name"))
        {
            $id = $this->_groups->add_group($group_name);
            return $this->ajax_list($id);
        }
        else
        {
            $this->load->view("groups/ajax_add");
        }

    }

}