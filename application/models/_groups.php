<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _groups extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_groups($array = false) {
        $query = $this->db->query("SELECT * FROM groups ORDER BY id DESC");

        $groups = array();

        foreach($query->result() as $group)
            $groups[$group->id] = $array ? (array) $group : $group;

        return $groups;
    }

    function add_group($name = null)
    {
        $data = array(
            "name" => $name
        );
        $this->db->insert('groups', $data);
        return $this->db->insert_id();
    }

    function move($gid, $did)
    {
        $this->db->where('id', $did);
        $this->db->update("domains", array("group_id" => $gid));
    }

}