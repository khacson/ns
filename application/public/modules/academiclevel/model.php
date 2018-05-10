<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class AcademiclevelModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_academic_level')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['academic_name'])){
			$sql.= " and ac.academic_name like '%".$search['academic_name']."%' ";	
		}
		if(!empty($search['ordering'])){
			$sql.= " and ac.ordering like '%".$search['ordering']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT ac.*
				FROM `hre_academic_level` AS ac
				WHERE ac.isdelete = 0 
				$searchs
				
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY ac.ordering ASC ";
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
			FROM `hre_academic_level` AS ac
			WHERE ac.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		
		$check = $this->model->table('hre_academic_level')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('academic_name',$array['academic_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table('hre_academic_level')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_academic_level')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('academic_name',$array['academic_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table('hre_academic_level')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_academic_level')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}