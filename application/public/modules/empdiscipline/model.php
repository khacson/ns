<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EmpdisciplineModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_discipline')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getEmployee() {
		
        $query = $this->model->table('hre_employee')
					  ->select('id,fullname')
					  ->where('isdelete',0)
					  ->find_all();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['discipline_content'])){
			$sql.= " and r.discipline_content like '%".$search['discipline_content']."%' ";	
		}
		if(!empty($search['date_discipline'])){
			$sql.= " and r.date_discipline = '".$search['date_discipline']."' ";	
		}
		if(!empty($login['departmentid'])){
			$sql.= " and e.departmentid in (".$login['departmentid'].")";	
		}
		if(!empty($login['branchid'])){
			$sql.= " and e.branchid in (".$login['branchid'].")";	
		}
		if(!empty($search['identity'])){
			$sql.= " and e.identity like '%".$search['identity']."%' ";	
		}
		if(!empty($search['code'])){
			$sql.= " and e.code like '%".$search['code']."%' ";	
		}
		if(!empty($search['fullname'])){
			$sql.= " and e.fullname like '%".$search['fullname']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT r.*, e.code ,e.fullname, dp.departmanet_name
				FROM `hre_discipline` AS r
				LEFT JOIN `hre_employee` e on e.id = r.employeeid
				LEFT JOIN `hre_department` dp on dp.id = e.departmentid
				WHERE r.isdelete = 0 
				$searchs
				and e.isdelete = 0
				and dp.isdelete = 0
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY r.date_discipline desc  ";
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
			FROM `hre_discipline` AS r
			LEFT JOIN `hre_employee` e on e.id = r.employeeid
			LEFT JOIN `hre_department` dp on dp.id = e.departmentid
			WHERE r.isdelete = 0
			$searchs	
			AND e.isdelete = 0
			and dp.isdelete = 0
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$login = $this->login;
		if(empty($array['date_discipline'])){
			 $array['date_discipline'] = gmdate("Y-m-d", time() + 7 * 3600);
		}
		else{
			  $array['date_discipline'] =  fmDateSave($array['date_discipline']);
		}
		//MA nhan vien
		/*$arrCode = explode(',',$array['code']);
		$str = '';
		$arrEmp = array(); 
		foreach($arrCode as $k=>$code){
			$check = $this->model->table('hre_employee')
							 ->select('id')
							 ->where('code',$code);
			if(!empty($login['departmentid'])){
				$check = $check->where('departmentid',$login['departmentid']);
			}
			$check = $check->find();
			if(empty($check->id)){
				$str.=','.$code;
			}
			$arrEmp[$code] = $check->id;
		}
		if(!empty($str)){
			 return substr($str,1);
		}
		$array['money'] =  fmNumberSave($array['money']);
		unset($array['code']); //code
		foreach($arrEmp as $code=>$employeeid){
			$array['employeeid'] = $employeeid;
			$result = 
		}*/
		$array['money'] =  fmNumberSave($array['money']);
		$this->model->table('hre_discipline')->insert($array);	
		return 1;
	}
	function edits($array,$id){
		$login = $this->login;
		if(empty($array['date_discipline'])){
			$array['date_discipline'] = gmdate("Y-m-d", time() + 7 * 3600);
		}
		else{
			$array['date_discipline'] =  fmDateSave($array['date_discipline']);
		}
		if(!empty($login['branchid'])){
			$array['branchid'] = $login['branchid'];
		}
		$array['money'] =  fmNumberSave($array['money']);
		unset($array['code']); //code
		$this->model->table('hre_discipline')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		
		$this->model->table('hre_discipline')
					->where("id in ($id)")
					->update($array);
		return 1;
	}
}