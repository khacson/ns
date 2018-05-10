<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class ShiftModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_shift')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['shift_name'])){
			$sql.= " and u.shift_name like '%".$search['shift_name']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT u.*
				FROM `hre_shift` AS u
				WHERE u.isdelete = 0 
				$searchs
				ORDER BY u.shift_name ASC 
				";
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `hre_shift` AS u
			WHERE u.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$check = $this->model->table('hre_shift')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('shift_name',$array['shift_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table('hre_shift')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_shift')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('shift_name',$array['shift_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table('hre_shift')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_shift')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}