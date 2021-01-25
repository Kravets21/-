<?php
	class Pages extends CI_Controller {
	
        public function __construct() 
        {
                parent::__construct();
                $this->load->model('buyers_model'); //подключаем модели трех таблиц 
		$this->load->model('requests_info_model');
		$this->load->model('requests_model');
		$this->load->helper('url');
        }
	
	public function index() //по умолчанию
	{
		$this->load->view('templates/header');
		$this->load->view('pages/home');
		$this->load->view('templates/footer');
	}
	
	public function getDataWithoutJoin() //функция для первого задания, чтобы не грузить метод view
	{
		$buyers = $this->buyers_model->get_buyers();
		$requests = $this->requests_model->get_requests();
		$requests_info = $this->requests_info_model->get_requests_info();

		$arr['name'] = array();
		$arr['sum'] = array();
		$arr['info'] = array();
		$arr['buyer_id'] = array();

		foreach($buyers as $buyers_row => $buyers_key)
		{
		    array_push($arr['buyer_id'], $buyers_key['buyer_id']); 
		    array_push($arr['name'], $buyers_key['name']);
		    foreach($requests as $req_row => $req_key)
		    {
			    if($buyers_key['buyer_id'] === $req_key['buyer_id'])
			    {
				    array_push($arr['sum'], $req_key['sum']);
			    }
			    foreach($requests_info as $info_row => $info_key)
			    {
				    if(isset($info_key['request_id']) && $info_key['request_id'] === $req_key['request_id'] && !in_array($info_key['info'], $arr['info'])) 
				    {
						array_push($arr['info'], $info_key['info']);
				    }
			    }
		    }
		}

		$this->load->view('templates/header');
		$this->load->view('tasks/getDataWithoutJoin', $arr);
		$this->load->view('templates/footer');
	}
	
	public function getDataWithJoin() //функция для второго задания, чтобы не грузить метод view
	{
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
		$data['name'] = array();
		$data['sum'] = array();
		$data['info'] = array();
		$data['buyer_id'] = array();
		
		$tmp = $query->result(); // массив со всеми полями из запроса 
		    foreach ($tmp as $row) // запишем наши значения в отдельные массивы дял упрощения работы в view
		    {
			array_push($data['name'], $row->name);
			array_push($data['sum'], $row->sum);
			array_push($data['info'], $row->info);
		    	array_push($data['buyer_id'], $row->buyer_id); 
		    }

		$this->load->view('templates/header'); // шаблон для хедера
		$this->load->view('tasks/getDataWithJoin',$data); // наша страничка и массив данных из БД
		$this->load->view('templates/footer'); // шаблон для футера
	}

        public function view($page)
        {
	    if($page == 'getDataWithoutJoin') // Если имя нашего view(странички) = getDataWithoutJoin, то будет делать задание без джойн
	    {	
		$this->getDataWithoutJoin();
	    }
	    elseif($page == 'getDataWithJoin') // Если имя нашего view(странички) = getDataWithJoin, то будет делать задание с джойном
	    {
		$this->getDataWithJoin();
	    }
	    else{
		show_404();
	    }

        }
}


