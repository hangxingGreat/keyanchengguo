<?php
	class Admin extends CI_Model
	{
		//获取用户名
		public function getUser()
		{
			$res = $this->db->get("Admin");
			$obj = $res->result();
			return $obj[0]->Name;
		}
		//获取密码
		public function getPasswd()
		{
			$res = $this->db->get("Admin");
			$obj = $res->result();
			return $obj[0]->Password;
		}
		// 更改用户名
		public function setUser($user)
		{
			$res = $this->db->update('Admin',array('Name'=>$user));
			return $res;
		}
		// 更改密码
		public function setPasswd($passwd)
		{
			$res = $this->db->update('Admin',array('Password'=>$passwd));
			return $res;
		}
		// 获得指定用户的权限
		public function getMode($user)
		{
			$res = $this->db->where('Name',$user)->get("Admin");
			return $res->row()->mode;
		}
	}
?>