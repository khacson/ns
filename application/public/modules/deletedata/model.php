<?php
/**
 * @author sonnk
 * @copyright 2018
 */
class DeletedataModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_table')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getProvice() {
		
        $query = $this->model->table('hre_province')
					  ->select('id,province_name')
					  ->where('isdelete',0)
					  ->find_all();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['table_name'])){
			$sql.= " and tb.table_name like '%".$search['table_name']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT tb.*
				FROM `hre_table` AS tb
				WHERE tb.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY tb.order_number ASC  ";
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
			FROM `hre_table` AS tb
			WHERE tb.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function deletes($id,$array){
		$query = $this->model->table('hre_table')
					->where("id in ($id)")
					->find_all();
		foreach($query as $item){
			$arrListTable = explode(';',$item->table_key);
			foreach($arrListTable as $key=>$table){
				if(!empty($table)){
					$sql = "truncate $table;";
					$this->model->executeQuery($sql);
				}
			}
		}
		return 1;
	}
}