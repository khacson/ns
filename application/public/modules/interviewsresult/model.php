<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class InterviewsresultModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		
        $query = $this->model->table('hre_hre_interviewschedule')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getSearch($search){
		$sql = "";
		if(!empty($search['fullname'])){
			$sql.= " and it.fullname like '%".$search['fullname']."%' ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and it.phone like '%".$search['phone']."%' ";	
		}
		if(!empty($search['email'])){
			$sql.= " and it.email like '%".$search['email']."%' ";	
		}
		if(!empty($search['description'])){
			$sql.= " and it.description like '%".$search['description']."%' ";	
		}
		if(!empty($search['recruitment_position'])){
			$sql.= " and it.recruitment_position like '%".$search['recruitment_position']."%' ";	
		}
		if(!empty($search['input_academic_skills'])){
			$sql.= " and it.input_academic_skills like '%".$search['input_academic_skills']."%' ";	
		}
		if(!empty($search['fromdate'])){
			$sql.= " and ts.date_interview >= '".fmDateSave($search['date_interview'])." 00:00:00' ";
		}
		if(!empty($search['todate'])){
			$sql.= " and ts.date_interview <= '".fmDateSave($search['date_interview'])." 23:59:59' ";
		}	
		if(!empty($search['sex'])){
			$sql.= " and d.sex in (".$search['sex'].") ";	
		}
		if(!empty($search['academic_level'])){
			$sql.= " and d.academic_level in (".$search['academic_level'].") ";	
		}
		if(!empty($search['academic_level'])){
			$sql.= " and d.academic_level in (".$search['academic_level'].") ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$sql = "SELECT it.*, al.academic_name
				FROM `hre_hre_interviewschedule` AS it
				LEFT JOIN `hre_academic_level` AS al on al.id = it.academic_level
				WHERE it.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY it.datecreate desc ";
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
			FROM `hre_hre_interviewschedule` AS it
			WHERE it.isdelete = 0
			$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function edits($array,$id){
		$update = array();
		$update['userupdate_result'] = $array['userupdate'];
		$update['dateupdate_result'] = $array['dateupdate'];
		$update['employee_interview'] = $array['employee_interview'];
		$update['result_interview'] = $array['result_interview'];
		$update['description_interview'] = $array['description_interview'];
		
		$this->model->table('hre_hre_interviewschedule')
					->where('id',$id)
					->update($update);	
		return $id;
		
	}
}