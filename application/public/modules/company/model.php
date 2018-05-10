<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class CompanyModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
        $query = $this->model->table('hre_company')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['company_name'])){
			$sql.= " and u.company_name like '%".$search['company_name']."%' ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and u.phone like '%".$search['phone']."%' ";	
		}
		if(!empty($search['fax'])){
			$sql.= " and u.fax like '%".$search['fax']."%' ";	
		}
		if(!empty($search['email'])){
			$sql.= " and u.email like '%".$search['email']."%' ";	
		}
		if(!empty($search['mst'])){
			$sql.= " and u.mst like '%".$search['mst']."%' ";	
		}
		if(!empty($search['address'])){
			$sql.= " and u.address like '%".$search['address']."%' ";	
		}
		if(!empty($this->login['companyid'])){
			$sql.= " and u.id = '".$this->login['companyid']."' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$sql = " SELECT u.*
				FROM hre_company AS u
				WHERE u.isdelete = 0 
				$searchs
				ORDER BY u.company_name ASC 
				";
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total  
			FROM hre_company AS u
			WHERE u.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$check = $this->model->table('hre_company')
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('company_name',$array['company_name'])
					  ->find();
		 if(!empty($check->id)){
			return -1;	
		 }
		 if(!empty($array['datestart'])){
			$array['datestart'] = $this->site->fmDateSave($array['datestart']);
		 }
		 if(!empty($array['dateend'])){
			$array['dateend'] = $this->site->fmDateSave($array['dateend']);
		 }
		 $result = $this->model->table('hre_company')->insert($array);	
		 return $result;
	}
	function edits($array,$id){
		$check = $this->model->table('hre_company')
				  ->select('id')
				  ->where('isdelete',0)
				  ->where('company_name',$array['company_name'])
				  ->where('id <>',$id)
				  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		if(!empty($array['datestart'])){
			$array['datestart'] = fmDateSave($array['datestart']);
		 }
		 if(!empty($array['dateend'])){
			$array['dateend'] = fmDateSave($array['dateend']);
		 }
		$this->model->table('hre_company')->where('id',$id)->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		 $this->model->table('hre_company')->where("id in ($id)")->update($array);
		 return 1;
	}
}