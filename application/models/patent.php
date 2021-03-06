<?php
	// create table patent(
	// number int not null primary key auto_increment,
	// name text not null,
	// register text not null,
	// person int not null,
	// institute text not null,
	// time text not null
	// );
	class Patent extends CI_Model
	{
		public function insertPatent($name,$register,$person,$institute,$time)
		{
			$data = array(
				'number'=>null,
				'name'=>$name,
				'register'=>$register,
				'person'=>$person,
				'institute'=>$institute,
				'time'=>$time
				);
			return $this->db->insert('patent',$data);
		}

		public function getPatent()
		{
			$res = $this->db->get('patent');
			return $res->result();
		}

		public function getPatentByNumber($number)
		{
			$res = $this->db->where('number',$number)->get('patent')->row()->name;
			return $res;
		}

		public function getPatentByIdentifier($number)
		{
			$res = $this->db->where('number',$number)->get('patent')->row();
			return $res;
		}

		public function getPatentByYear($year)
		{
			$data = array();
			$res = $this->db->get('patent')->result();
			foreach($res as $item)
			{
				if(intval($item->time) == $year)
					$data[] = $item;
			}
			return $data;
		}

		public function updatePatent($number,$name,$register,$person,$institute,$time,$which)
		{
			$data = array(
				$which => $$which
				);
			return $this->db->update('patent',$data,array('number'=>$number));
		}

		public function deletePatent($number)
		{
			$res = $this->db->delete('patent',array('number'=>$number));
			$res &= $this->db->delete('patentlist',array('identifier'=>$number));
			return $res;
		}

		public function addFile($id,$file)
		{
			$res = $this->db->update('patent',array('file'=>$file),array('number'=>$id));
		}
	}
?>