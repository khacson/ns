<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class TimemissionotherModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id){
		if(empty($id)){
			$id = 0;
		}
        $query = $this->model->table('hre_timemission_other')
					  ->where('isdelete',0)
					  ->where("id in ($id)")
					  ->find();
        return $query;
    }
	function getEmployee(){

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
		if(!empty($login['branchid'])){
			$sql.= " and e.branchid in (".$login['branchid'].")";	
		}
		else{
			if(!empty($search['branchid'])){
				$sql.= " and e.branchid in (".$search['branchid'].") ";	
			}
		}
		if(!empty($login['departmentid'])){
			$sql.= " and e.departmentid in (".$login['departmentid'].")";	
		}
		else{
			if(!empty($search['departmentid'])){
				$sql.= " and e.departmentid in (".$search['departmentid'].") ";	
			}
		}
		$sql.= " and ts.statusid = 2";
		if(!empty($search['time_start'])){
			$sql.= " and ts.time_start >= '".fmDateSave($search['time_start'])." 00:00:00' ";
		}
		if(!empty($search['time_end'])){
			$sql.= " and ts.time_end <= '".fmDateSave($search['time_end'])." 23:59:59' ";
		}	
		if(!empty($search['group_work_id'])){
			$sql.= " and e.group_work_id in (".$search['group_work_id'].") ";	
		}
		if(!empty($search['positionid'])){
			$sql.= " and e.positionid in (".$search['positionid'].") ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$sql = "SELECT ts.id, e.code,e.identity , e.fullname, d.departmanet_name, e.departmentid, ts.time_start, ts.time_end, p.position_name, dg.departmentgroup_name, e.group_work_id, e.positionid
				from hre_timemission_other ts 
				left join hre_employee e on e.id = ts.employeeid
				left join hre_department d on d.id = e.departmentid
				left join hre_position p on p.id = e.positionid and p.isdelete = 0
				left join hre_departmentgroup dg on dg.id = e.group_work_id
				WHERE e.isdelete = 0 
				$searchs
				and d.isdelete = 0
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY e.code DESC ';
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
		$sql = "SELECT count(1) total
				from hre_timemission_other ts 
				left join hre_employee e on e.id = ts.employeeid
				left join hre_department d on d.id = e.departmentid
				WHERE e.isdelete = 0 
				$searchs
				and d.isdelete = 0
				";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($search){
		$array = array();
		$departmentid = $search['departmentid'];//Cham theo bo phan
		if(empty($search['departmentid'])){
			$departmentid = $login['departmentid'];//Cham theo bo phan
		}
		if(strtotime(fmDateTimeSave($search['time_start'])) > strtotime(fmDateTimeSave($search['time_end']))){
			return -3;
		}
		$employeeid = $search['employeeid'];
		$items = $this->model->table('hre_employee')->select('id,departmentid,branchid')
								 ->where('id',$employeeid)
								 ->where('departmentid',$departmentid)
								 ->where('isdelete',0)
								 ->find();
		if(empty($items->id)){
			return -2;
		}
		else{
			$arrInsert = array();
			$arrInsert['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			$arrInsert['usercreate'] = $search['usercreate'];
			$arrInsert['employeeid'] = $items->id;
			$arrInsert['departmentid'] =  $items->departmentid;
			$arrInsert['branchid'] =  $items->branchid;
			$arrInsert['time_start'] = fmDateTimeSave($search['time_start']); 
			$arrInsert['time_end'] = fmDateTimeSave($search['time_end']); 
			$arrInsert['datecheck'] = fmDateSave($search['time_start']);
			$arrInsert['statusid'] = 2;					
			//datecheck
			$checkdate = $this->model->table('hre_timemission_other')
							  ->select('id')
							  ->where('employeeid',$items->id)
							  ->where('datecheck',fmDateSave($search['time_start']))
							  ->where('isdelete',0)
							  ->where('statusid',2)
							  ->find();
			if(empty($checkdate->id)){
				$this->model->table('hre_timemission_other')->insert($arrInsert);
			}
			else{
				$this->model->table('hre_timemission_other')->where('id',$checkdate->id)->update($arrInsert);
			}
			return 1;
		}
		
	}
	function edits($search,$id){
		 if(strtotime(fmDateTimeSave($search['time_start'])) > strtotime(fmDateTimeSave($search['time_end']))){
			return -3;
		 }
		 $array = array();
		 $array['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		 $array['userupdate'] = $search['userupdate'];
		 $array['time_start'] = fmDateTimeSave($search['time_start']); 
		 $array['time_end'] = fmDateTimeSave($search['time_end']); 
		 $arrInsert['datecheck'] = fmDateSave($search['time_start']);	
		 $arrInsert['statusid'] = 2;					
		 $result = $this->model->table('hre_timemission_other')->where('id',$id)->update($array);	
		 return $id;
	 }
}