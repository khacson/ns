<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class PositionModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_position')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['position_name'])){
			$sql.= " and p.position_name like '%".$search['position_name']."%' ";	
		}
		if(!empty($search['ordering'])){
			$sql.= " and p.ordering like '%".$search['ordering']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT p.*
				FROM `hre_position` AS p
				WHERE p.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY p.ordering ASC   ";
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
			FROM `hre_position` AS p
			WHERE p.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		
		$check = $this->model->table('hre_position')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('position_name',$array['position_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table('hre_position')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_position')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('position_name',$array['position_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table('hre_position')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_position')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}