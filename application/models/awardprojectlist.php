<?php
// create table awardprojectlist(
// 	projectid int not null,
// 	identifier int not null,
// 	foreign key(projectid) references project(`projectid`)
// );
	class Awardprojectlist extends CI_Model
	{
		public function insertAwardprojectlist($id,$identifier)
		{
			$data = array(
				'projectid'=>$id,
				'identifier'=>$identifier
				);
			return $this->db->insert('awardprojectlist',$data);
		}

		public function deleteAll($number)
		{
			$this->db->delete('awardprojectlist',array('identifier'=>$number));
		}

		public function getIdentifierByProjectid($projectid)
		{
			$res = $this->db->where('projectid',$projectid)->get('awardprojectlist');
			return $res->result();
		}
	}
?>