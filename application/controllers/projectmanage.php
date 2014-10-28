<?php
	class projectmanage extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			if($this->session->userdata('token') != 'in')
			{
				redirect(site_url('welcome/login'),'refresh');
			}
		}
		
		public function index()
		{
			$this->load->view('project/main');
		}
		public function show()
		{
			$res = $this->db->get('project');
			$data['project'] = $res->result();
			$this->load->view('project/list',$data);
		}

		public function add()
		{
			$name = $this->input->post('name');
			$source = $this->input->post('source');
			$level = $this->input->post('level');
			$principal = $this->input->post('principal');
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$money = $this->input->post('money');
			$currency = $this->input->post('currency');
			$contract = $this->input->post('contract');
			$credit = $this->input->post('credit');
			$type = $this->input->post('type');
			$this->load->model('project');
			if($this->project->insertProject($name,$source,$level,$principal,$start,$end,$money,$currency,$contract,$credit,$type))
			{
				echo "添加成功";
			}else
			{
				echo "添加失败";
			}
		}
		public function delete()
		{
			$this->load->model('project');
			$projectid = $this->input->post('projectid');
			if($this->project->deleteProject($projectid))
			{
				echo "删除成功";
			}else
			{
				echo "删除失败";
			}
		}
		public function modify()
		{
			$projectid = $this->input->post('projectid');
			$name = $this->input->post('name');
			$source = $this->input->post('source');
			$level = $this->input->post('level');
			$principal = $this->input->post('principal');
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$money = $this->input->post('money');
			$currency = $this->input->post('currency');
			$contract = $this->input->post('contract');
			$credit = $this->input->post('credit');
			$type = $this->input->post('type');
			$which = $this->input->post('which');
			$this->load->model('project');
			if($currency =="" || $currency == null) $currency="DEFAULT";
			if($this->project->updateProject($projectid,$name,$source,$level,$principal,$start,$end,$money,$currency,$contract,$credit,$type,$which))
			{
				echo "修改成功";
			}else
			{
				echo "修改失败";
			}
		}

		public function awards()
		{
			$this->load->view('project/addaward');
		}

		public function aw_add()
		{
			$projectid = $this->input->post('projectid');
			$id = $this->input->post('id');
			$order = $this->input->post('order');
			$time = $this->input->post('time');
			$this->load->model('award');
			$bool = $this->award->insertAward($projectid,$id,$order,$time);
			if($bool)
			{
				echo "添加成功";
			}else
			{
				echo "添加失败";
			}
		}

		public function get_award()
		{
			$projectid = $this->input->post('projectid');
			$this->load->model('award');
			$data['award'] = $this->award->getAwardByID($projectid);
			$this->load->view('project/award',$data);
		}

		public function validation()
		{
			$this->load->view('project/addvalidation');
		}

		public function va_add()
		{
			$projectid = $this->input->post('projectid');
			$time = $this->input->post('time');
			$institute = $this->input->post('institute');
			$others = $this->input->post('others');
			$this->load->model('validation');
			$bool = $this->validation->insertValidation($projectid,$time,$institute,$others);
			if($bool)
			{
				echo "添加成功";
			}else
			{
				echo "添加失败";
			}
		}

		public function get_validation()
		{
			$projectid = $this->input->post('projectid');
			$this->load->model('validation');
			$data['validation'] = $this->validation->getValidationByID($projectid);
			$this->load->view('project/validation',$data);
		}

		public function funds()
		{
			$this->load->view('project/addfunds');
		}
		public function fu_add()
		{
			$projectid = $this->input->post('projectid');
			$payoff = $this->input->post('payoff');
			$year = $this->input->post('year');
			$remain = $this->input->post('remain');
			$others = $this->input->post('others');
			// echo $projectid,$payoff,$year,$remain,$others;
			$this->load->model('funds');
			$bool = $this->funds->insertFunds($projectid,$payoff,$year,$remain,$others);
			if($bool)
			{
				echo "添加成功";
			}else
			{
				echo "添加失败";
			}
		}

		public function get_funds()
		{
			$projectid = $this->input->post('projectid');
			$this->load->model('funds');
			$data['funds'] = $this->funds->getFundsByID($projectid);
			$this->load->view('project/funds',$data);
		}

	}
?>