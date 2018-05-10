<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class JobstatusModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_job_status')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['status_name'])){
			$sql.= " and js.status_name like '%".$search['status_name']."%' ";	
		}
		if(!empty($search['ordering'])){
			$sql.= " and js.ordering like '%".$search['ordering']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT js.*
				FROM `hre_job_status` AS js
				WHERE js.isdelete = 0 
				$searchs
				
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY js.ordering ASC  ";
		}
		else{
			$sql.= " ORDER BY ".$search['order']." ".$search['index']." ";
		} 
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `hre_job_status` AS js
			WHERE js.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		
		$check = $this->model->table('hre_job_status')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('status_name',$array['status_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table('hre_job_status')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_job_status')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('status_name',$array['status_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table('hre_job_status')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_job_status')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}