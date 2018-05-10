<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class CriteriaprobationaryModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_criteriaprobationary')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['aprobationary_name'])){
			$sql.= " and e.aprobationary_name like '%".$search['aprobationary_name']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT e.*
				FROM `hre_criteriaprobationary` AS e
				WHERE e.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY e.aprobationary_name ASC  ";
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
			FROM `hre_criteriaprobationary` AS e
			WHERE e.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		
		$check = $this->model->table('hre_criteriaprobationary')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('aprobationary_name',$array['aprobationary_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table('hre_criteriaprobationary')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_criteriaprobationary')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('aprobationary_name',$array['aprobationary_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table('hre_criteriaprobationary')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_criteriaprobationary')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}