<?php
	class Pages extends CI_Controller {
	
        public function __construct() 
        {
                parent::__construct();
                $this->load->model('buyers_model'); //подключаем модели трех таблиц 
		$this->load->model('requests_info_model');
		$this->load->model('requests_model');
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
		
		$arr = array(); // тут будет результат
		$requests_info_tmp = array(); //временный массив для доп инф.
		foreach($requests as $request_row => $request) // заранее записываем дополнительную информацию из 3-ей таблицы
		{
		    foreach ($requests_info as $info_row => $info)
		    {
			if ($info['request_id'] === $request['request_id'])
			{
			    $requests_info_tmp += [$info['request_id'] => $info]; 
			}
		    }
		}
		foreach ($buyers as $buyers_key => $buyer) {
		    $request_data = array(); // тут будем хранить данные о реквесте и обнуляем каждый цикл
		    $join = array(); // для того чтобы потом слепить все массивы в один
		    $buyer_id = $buyer['buyer_id'];
		    $request_id = 0;
		    array_push($join ,$buyer);
		    foreach($requests as $request_row => $request)
		    {
			if($request['buyer_id'] === $buyer_id)
			{
			    array_push($join ,$request);
			    if (array_key_exists($request['request_id'],$requests_info_tmp)) {
				array_push($join ,$requests_info_tmp[$request['request_id']]);
			    }
			    $request_id = $request['request_id'];
			    break;
			}
		    }
		    array_push($request_data,$join);
		    $arr += [$buyer_id => array($request_id => $request_data)];
		}
		
		//var_dump($arr[1][1]); // arr[покупатель с айди = 1][запрос этого покутеля с айди = 1] = [name1,id1,sum1,info1....]
		$result['data'] = array();
		foreach($arr as $arr_key => $arr_value) // трюк, чтобы передать во view в нормальном виде
		{
		    $result['data'] += $arr_value;
		}
		
//		Старое решение: 
//		$arr['name'] = array();
//		$arr['sum'] = array();
//		$arr['info'] = array();
//		$arr['buyer_id'] = array();
//
//		foreach($buyers as $buyers_row => $buyers_key)
//		{
//		    array_push($arr['buyer_id'], $buyers_key['buyer_id']); 
//		    array_push($arr['name'], $buyers_key['name']);
//		    foreach($requests as $req_row => $req_key)
//		    {
//			    if($buyers_key['buyer_id'] === $req_key['buyer_id'])
//			    {
//				    array_push($arr['sum'], $req_key['sum']);
//			    }
//			    foreach($requests_info as $info_row => $info_key)
//			    {
//				    if(isset($info_key['request_id']) && $info_key['request_id'] === $req_key['request_id'] && !in_array($info_key['info'], $arr['info'])) 
//				    {
//						array_push($arr['info'], $info_key['info']);
//				    }
//			    }
//		    }
//		}

		$this->load->view('templates/header');
		$this->load->view('tasks/getDataWithoutJoin',$result);
		$this->load->view('templates/footer');
	}
	
	public function getDataWithJoin() //функция для второго задания, чтобы не грузить метод view
	{
		$data['name'] = array();
		$data['sum'] = array();
		$data['info'] = array();
		$data['buyer_id'] = array();
		
		$tmp = $this->buyers_model->get_join();
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


