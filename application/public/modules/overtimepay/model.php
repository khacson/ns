<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class OvertimepayModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_overtime_pay')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['overtime_name'])){
			$sql.= " and e.overtime_name like '%".$search['overtime_name']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT e.*
				FROM `hre_overtime_pay` AS e
				WHERE e.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY e.overtime_name ASC  ";
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
			FROM `hre_overtime_pay` AS e
			WHERE e.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		
		$check = $this->model->table('hre_overtime_pay')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('overtime_name',$array['overtime_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $array['overtime_pay'] = fmNumberSave($array['overtime_pay']);
		 $result = $this->model->table('hre_overtime_pay')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		
		$check = $this->model->table('hre_overtime_pay')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('overtime_name',$array['overtime_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$array['overtime_pay'] = fmNumberSave($array['overtime_pay']);
		$this->model->table('hre_overtime_pay')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_overtime_pay')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}