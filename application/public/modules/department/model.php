<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class DepartmentModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
        $query = $this->model->table('hre_department')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['departmanet_name'])){
			$sql.= " and d.departmanet_name like '%".$search['departmanet_name']."%' ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and d.phone like '%".$search['phone']."%' ";	
		}
		if(!empty($search['fax'])){
			$sql.= " and d.fax like '%".$search['fax']."%' ";	
		}
		if(!empty($search['heads'])){
			$sql.= " and d.heads like '%".$search['heads']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT d.*
				FROM `hre_department` AS d
				WHERE d.isdelete = 0 
				$searchs
				
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY d.departmanet_name ASC  ";
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
			FROM `hre_department` AS d
			WHERE d.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		
		$check = $this->model->table('hre_department')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('departmanet_name',$array['departmanet_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table('hre_department')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_department')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('departmanet_name',$array['departmanet_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table('hre_department')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_department')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}