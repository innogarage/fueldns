<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class _domains extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_domains() {
        $query = $this->db->query("SELECT * FROM domains ORDER BY id DESC");
        return $query->result();
    }

    function get_records($id) {
        $query = $this->db->query("SELECT * FROM records WHERE domain_id = $id");
        return $query->result();
    }

    function get_domain($id) {
        $query = $this->db->query("SELECT * FROM domains WHERE id = $id");
        return $query->row();
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