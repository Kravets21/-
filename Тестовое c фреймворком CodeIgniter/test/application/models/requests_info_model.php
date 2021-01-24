<?php
class Requests_info_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
	
	public function get_requests_info()
	{
	    $query = $this->db->get('requests_info');
	    return $query->result_array();
	}
}

