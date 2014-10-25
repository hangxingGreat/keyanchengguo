<?php
	class cooperationmanage extends CI_Controller
	{
		public function index()
		{
			$res = $this->db->get('cooperation');
			$data['cooperation'] = $res->result();
			$this->load->view('cooperation/main',$data);
		}

		public function add()
		{
			$category = $this->input->post('category');
			$list = $this->input->post('list');
			$number = $this->input->post('number');
			$place = $this->input->post('place');
			$purpose = $this->input->post('purpose');
			$url = $this->input->post('url');
			$news = $this->input->post('news');
			$picture = $this->input->post('picture');
			$this->load->model('cooperation');
			$bool = $this->cooperation->insertCooperation($category,$list,$number,$place,$purpose,$url,$news,$picture);
			if($bool)
			{
				echo "success";
			}
		}

		public function delete()
		{
			$category = $this->input->post('category');
			$place = $this->input->post('place');
			$purpose = $this->input->post('purpose');
			$this->load->model('cooperation');
			$bool = $this->cooperation->deleteCooperation($category,$place,$purpose);
			if($bool)
			{
				echo "success";
			}
		}
	}
?>