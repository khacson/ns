<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class BankModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		$tb = $this->base_model->loadTable();
        $query = $this->model->table($tb['g_bank'])
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['bank_code'])){
			$sql.= " and u.bank_code like '%".$search['bank_code']."%' ";	
		}
		if(!empty($search['bank_name'])){
			$sql.= " and u.bank_name like '%".$search['bank_name']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = " SELECT u.*
				FROM `".$tb['g_bank']."` AS u
				WHERE u.isdelete = 0 
				$searchs
				ORDER BY u.bank_name ASC 
				";
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `".$tb['g_bank']."` AS u
			WHERE u.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$tb = $this->base_model->loadTable();
		$check = $this->model->table($tb['g_bank'])
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('bank_name',$array['bank_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 $result = $this->model->table($tb['g_bank'])->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		$tb = $this->base_model->loadTable();
		$check = $this->model->table($tb['g_bank'])
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('bank_name',$array['bank_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$this->model->table($tb['g_bank'])
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		$tb = $this->base_model->loadTable();
		$this->model->table($tb['g_bank'])
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}