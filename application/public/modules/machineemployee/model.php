<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class MachineemployeeModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
        $query = $this->model->table('hre_machine_fingerprint')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['employee_code'])){
			$sql.= " and u.employee_code like '%".$search['employee_code']."%' ";	
		}
		if(!empty($search['fullname'])){
			$sql.= " and u.fullname like '%".$search['fullname']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT u.*
				FROM `hre_machine_fingerprint` AS u
				WHERE u.isdelete = 0 
				$searchs
				ORDER BY u.employee_code ASC 
				";
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `hre_machine_fingerprint` AS u
			WHERE u.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		
		$check = $this->model->table('hre_machine_fingerprint')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('employee_code',$array['employee_code'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table('hre_machine_fingerprint')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_machine_fingerprint')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('employee_code',$array['employee_code'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table('hre_machine_fingerprint')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_machine_fingerprint')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}