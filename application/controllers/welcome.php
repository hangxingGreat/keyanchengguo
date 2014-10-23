<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	//登录验证
	public function index()
	{
		//生成验证码
		$this->load->helper("captcha");
		$vals = array(
		    'word' => rand(1000,9999),
		    'img_path' => './captcha/',
		    'img_url' => base_url()."captcha/",
		    'img_width' => '150',
		    'img_height' => 30,
		    'expiration' => 120
	    );
	    $cap = create_captcha($vals);
	    $data = array(
	    'captcha_time' => $cap['time'],
	    'ip_address' => $this->input->ip_address(),
	    'word' => $cap['word']
	    );
	    //产生的验证码插入数据库
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
		//获取输入的用户名及密码（MD5加密后的结果存储在数据库）
		$user = $this->input->post("user");
		$passwd = md5($this->input->post("password"));
		$captcha = $this->input->post("captcha");
		//删除过期的验证码
		$expiration = time()-120; // 2分钟限制
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration); 
		// 再看是否有验证码存在
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		//从数据库获得数据
		$this->load->model("Admin");
		if($user == $this->Admin->getUser() && $passwd == $this->Admin->getPasswd() && $row -> count != 0)
		{
			/*验证成功*/
			$this -> home();
		}else
		{	
			/*验证失败*/
			$data['image'] = $cap['image'];
			$this->load->view("user/login",$data);
		}
		
	}

	// 用户名密码修改
	public function modify()
	{
		$user = $this->input->post("usr");
		$passwd = $this->input->post("passwd");
		if($user && $passwd)
		{
			$this -> load -> model("Admin");
			if($this -> Admin -> setUser($user))
				echo "用户名修改成功";
			if($this -> Admin -> setPasswd($passwd))
				echo "密码修改成功";
		}else
		{
			$this -> load -> view("user/modify");
		}
	}
	
	// 主界面
	public function home()
	{
		$this->load->view("home_page");
	}

}
?>

