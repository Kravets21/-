<?php
class Buyers_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
	
	public function get_buyers()
	{
		$query = $this->db->get('buyers');
		return $query->result_array();
	}
	public function get_join()
	{
                $this->load->model('buyers_model'); 
		$this->load->model('requests_info_model');
		$this->load->model('requests_model');
		$query = $this->db->query('
		SELECT
		    b.buyer_id,
		    b.name,
		    r.sum,
		    re.info
		FROM
		    requests_info re
		RIGHT JOIN requests r ON
		    re.request_id = r.request_id
		INNER JOIN buyers b ON
		    r.buyer_id = b.buyer_id
		');
	    return $query->result();
	}
}

