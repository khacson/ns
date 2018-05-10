<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EmpbirthdayModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_ethnic')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['code'])){
			$sql.= " and e.code like '%".$search['code']."%' ";	
		}
		if(!empty($search['fullname'])){
			$sql.= " and e.fullname like '%".$search['fullname']."%' ";	
		}
		if(!empty($search['identity'])){
			$sql.= " and e.identity like '%".$search['identity']."%' ";	
		}
		if(!empty($search['departmentid'])){
			$sql.= " and e.departmentid in (".$search['departmentid'].") ";	
		}
		if(!empty($search['positionid'])){
			$sql.= " and e.positionid in (".$search['positionid'].") ";	
		}
		if(!empty($search['birthday'])){
			if((int)$search['birthday'] < 10){
				$birthday = '0'.$search['birthday'];
			}
			else{
				$birthday = $search['birthday'];
			}
			
			$sql.= " and e.birthday like '%-".$birthday."-%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		/*$sql = "
			(SELECT e.id, e.`code`, e.fullname, e.sex, e.identity, e.phone, e.email, e.departmentid, e.positionid, d.departmanet_name,
			 p.position_name, e.jobstatusid, e.academic_level, e.ethnicid, e.religionid, e.birthday, DATE_FORMAT((e.birthday), '%d') as dates
				FROM hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_position p on p.id = e.positionid
				where e.isdelete = 0
				-- and  DATE_FORMAT((e.birthday), '%d') >= DATE_FORMAT((select now()), '%d')
				ORDER BY e.birthday ASC  
				)
				union all
				(
				SELECT e.id, e.`code`, e.fullname, e.sex, e.identity, e.phone, e.email, e.departmentid, e.positionid, d.departmanet_name,
			 p.position_name, e.jobstatusid, e.academic_level, e.ethnicid, e.religionid, e.birthday, DATE_FORMAT((e.birthday), '%d') as dates
				FROM hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_position p on p.id = e.positionid
				where e.isdelete = 0
				-- and  DATE_FORMAT((e.birthday), '%d') < DATE_FORMAT((select now()), '%d')
				ORDER BY e.birthday ASC  
				)
		";*/
		$sql = "
			SELECT e.id, e.`code`, e.fullname, e.sex, e.identity, e.phone, e.email, e.departmentid, e.positionid, d.departmanet_name,
			 p.position_name, e.jobstatusid, e.academic_level, e.ethnicid, e.religionid, e.birthday, DATE_FORMAT((e.birthday), '%d') as dates
			FROM hre_employee e
			left join hre_department d on d.id = e.departmentid
			left join hre_position p on p.id = e.positionid
			where e.isdelete = 0
			$searchs
			-- and  DATE_FORMAT((e.birthday), '%d') >= DATE_FORMAT((select now()), '%d')
			ORDER BY e.birthday ASC  
		";
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
				FROM hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_position p on p.id = e.positionid
				where e.isdelete = 0
				$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
}