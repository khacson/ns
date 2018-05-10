<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EmployeeModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
		function getSearch($search){
		$sql = "";
		if(!empty($search['code'])){
			$sql.= " and s.code like '%".$search['code']."%' ";	
		}
		if(!empty($search['fullname'])){
			$sql.= " and s.fullname like '%".$search['fullname']."%' ";	
		}
		if(!empty($search['identity'])){
			$sql.= " and s.identity like '%".$search['identity']."%' ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and s.phone like '%".$search['phone']."%' ";	
		}
		if(!empty($search['academic_skills'])){
			$sql.= " and s.academic_skills like '%".$search['academic_skills']."%' ";	
		}
		if(!empty($search['birthday'])){
			$sql.= " and s.birthday = '".fmDateSave($search['birthday'])."' ";	
		}
		if(!empty($search['identity_date'])){
			$sql.= " and s.identity_date = '".fmDateSave($search['identity_date'])."' ";	
		}
		if(!empty($search['date_start'])){
			$sql.= " and s.date_start = '".fmDateSave($search['date_start'])."' ";	
		}
		if(!empty($search['contrac_date'])){
			$sql.= " and s.contrac_date = '".fmDateSave($search['contrac_date'])."' ";	
		}
		if(!empty($search['contac_expired_date'])){
			$sql.= " and s.contac_expired_date = '".fmDateSave($search['contac_expired_date'])."' ";	
		}
		if(!empty($search['contrac_code'])){
			$sql.= " and s.contrac_code like '%".$search['contrac_code']."%' ";	
		}
		if(!empty($search['insurance_code'])){
			$sql.= " and s.insurance_code like '%".$search['insurance_code']."%' ";	
		}
		if(!empty($search['insurance_hospital'])){
			$sql.= " and s.insurance_hospital like '%".$search['insurance_hospital']."%' ";	
		}
		if(!empty($search['tax_code'])){
			$sql.= " and s.tax_code like '%".$search['tax_code']."%' ";	
		}
		if(!empty($search['bank_accout'])){
			$sql.= " and s.bank_accout like '%".$search['bank_accout']."%' ";	
		}
		if(!empty($search['bank_name'])){
			$sql.= " and s.bank_name like '%".$search['bank_name']."%' ";	
		}
		if(!empty($search['family_name'])){
			$sql.= " and s.family_name like '%".$search['family_name']."%' ";	
		}
		if(!empty($search['family_phone'])){
			$sql.= " and s.family_phone like '%".$search['family_phone']."%' ";	
		}
		if(!empty($search['family_relation'])){
			$sql.= " and s.family_relation like '%".$search['family_relation']."%' ";	
		}
		if(!empty($search['place_of_birth'])){
			$sql.= " and s.place_of_birth like '%".$search['place_of_birth']."%' ";	
		}
		if(!empty($search['departmentid'])){
			$sql.= " and s.departmentid in (".$search['departmentid'].") ";	
		}
		if(!empty($search['identity_from'])){
			$sql.= " and s.identity_from in (".$search['identity_from'].") ";	
		}
		if(!empty($search['sex'])){
			$sql.= " and s.sex in (".$search['sex'].") ";	
		}
		if(!empty($search['marriage'])){
			$sql.= " and s.marriage in (".$search['marriage'].") ";	
		}
		if(!empty($search['nationality'])){
			$sql.= " and s.nationality in (".$search['nationality'].") ";	
		}
		if(!empty($search['positionid'])){
			$sql.= " and s.positionid in (".$search['positionid'].") ";	
		}
		if(!empty($search['jobstatusid'])){
			$sql.= " and s.jobstatusid in (".$search['jobstatusid'].") ";	
		}
		if(!empty($search['academic_level'])){
			$sql.= " and s.academic_level in (".$search['academic_level'].") ";	
		}
		if(!empty($search['ethnicid'])){
			$sql.= " and s.ethnicid in (".$search['ethnicid'].") ";	
		}
		if(!empty($search['religionid'])){
			$sql.= " and s.religionid in (".$search['religionid'].") ";	
		}
		if(!empty($this->login['departmentid'])){
			$sql.= " and s.departmentid = '".$this->login['departmentid']."' ";	
		}
		else{
			if(!empty($search['departmentid'])){
				$sql.= " and s.departmentid in (".$search['departmentid'].") ";	
			}
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$sql = "
				SELECT s.*, d.departmanet_name, p.position_name, dg.departmentgroup_name
				FROM hre_employee s
				left join hre_department d on d.id = s.departmentid
				left join hre_position p on p.id = s.positionid
				left join hre_departmentgroup dg on dg.id = s.group_work_id
				where s.isdelete = 0
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY s.fullname ASC ';
		}
		else{
			$sql.= ' ORDER BY '.$search['order'].' '.$search['index'].' ';
		}
		if(!empty($rows)){
			$sql.= ' limit '.$page.','.$rows; 
		}
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total
				FROM hre_employee s
				left join hre_department d on d.id = s.departmentid
				left join hre_position p on p.id = s.positionid
				where s.isdelete = 0
				$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function findID($id){
		 $query = $this->model->table('hre_employee')
					  ->select('*')
					  ->where('id',$id)
					  ->find();
		return $query;
	 }
}