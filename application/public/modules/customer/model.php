<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class CustomerModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		$tb = $this->base_model->loadTable();
        $query = $this->model->table('hre_customer')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['customer_code'])){
			$sql.= " and c.customer_code like '%".$search['customer_code']."%' ";	
		}
		if(!empty($search['customer_name'])){
			$sql.= " and c.customer_name like '%".$search['customer_name']."%' ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and c.phone like '%".$search['phone']."%' ";	
		}
		if(!empty($search['email'])){
			$sql.= " and c.email like '%".$search['email']."%' ";	
		}
		if(!empty($search['address'])){
			$sql.= " and c.address like '%".$search['address']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = " SELECT c.*
				FROM `hre_customer` AS c
				WHERE c.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY c.customer_name ASC  ";
		}
		else{
			$sql.= " ORDER BY ".$search['order']." ".$search['index']." ";
		} 
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM `hre_customer` AS c
			WHERE c.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$tb = $this->base_model->loadTable();
		$check = $this->model->table('hre_customer')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('phone',$array['phone'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 if(!empty($array['birthday'])){
			 $array['birthday'] = str_replace('/','-',$array['birthday']);
			 $array['birthday'] = date('Y-m-d',strtotime($array['birthday']));
		 }
		 $result = $this->model->table('hre_customer')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		$tb = $this->base_model->loadTable();
		$check = $this->model->table('hre_customer')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('phone',$array['phone'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		if(!empty($array['birthday'])){
			$array['birthday'] = str_replace('/','-',$array['birthday']);
			$array['birthday'] = date('Y-m-d',strtotime($array['birthday']));
		 }
		$this->model->table('hre_customer')->where('id',$id)->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		$tb = $this->base_model->loadTable();
		$this->model->table('hre_customer')->where("id in ($id)")->update($array);
		return 1;
	}
}