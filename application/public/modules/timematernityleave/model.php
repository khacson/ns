<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class TimematernityleaveModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id){
		if(empty($id)){
			$id = 0;
		}
        $query = $this->model->table('hre_empleaveshow')
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
		$sql.= " and ts.statusid = 3";
		if(!empty($search['time_start'])){
			//$sql.= " and (ts.time_start >= '".fmDateSave($search['time_start'])." 00:00:00' or )";
		}
		if(!empty($search['time_end'])){
			//$sql.= " and ts.time_end <= '".fmDateSave($search['time_end'])." 23:59:59' ";
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
		$sql = "SELECT ts.id, e.code,e.identity , e.fullname, d.departmanet_name, e.departmentid, ts.time_start, ts.time_end, p.position_name, dg.departmentgroup_name, e.group_work_id, e.positionid, ts.holidays_count_month
				from hre_empleaveshow ts 
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
				from hre_empleaveshow ts 
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
		$this->db->trans_start();
		$login = $this->login;
		$array = array();
		$employeeid = $search['employeeid'];
		$login = $this->login;
		$grouptype = $login['grouptype'];
		$departmentid = $login['departmentid'];//Cham theo bo phan
		
		$i = 0;
		if($grouptype > 1){//Theo tung bo phan
			$items = $this->model->table('hre_employee')->select('id,sex,departmentid,branchid')
							 ->where('id',$employeeid)
							 ->where('departmentid',$departmentid)
							 ->where('isdelete',0)
							 ->find();
		}
		else{
			$items = $this->model->table('hre_employee')->select('id,sex,departmentid,branchid,shiftid')
							 ->where('id',$employeeid)
							 ->where('isdelete',0)
							 ->find();
		}
		if(empty($items->id)){
			return -2;
		}
		else{
			if($items->sex != 2){
				return -4;
			}
			//Ca làm việc
			$shift = $this->model->table('hre_shift')->select('id,time_star,time_end')
								 ->where('id',$items->shiftid)
								 ->where('isdelete',0)
								 ->find();
			$shift_time_star = 0; 
			$shift_time_end = 0;
			if(!empty($shift->time_star)){
				$shift_time_star = $shift->time_star; 
				$shift_time_end = $shift->time_end;
			}
			
			$arrInsert = array();
			$arrInsert['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
			$arrInsert['usercreate'] = $search['usercreate'];
			$arrInsert['employeeid'] = $items->id;
			$arrInsert['statusid'] = 3;
			$arrInsert['departmentid'] =  $items->departmentid;
			$arrInsert['branchid'] =  $items->branchid;
			//S tinh ngay
			$time_starts =  fmDateTimeSave($search['time_start']); 
			$arrInsert['time_start'] = $time_starts;
			$month =  $search['holidays_count_month'];
			$arrInsert['holidays_count_month'] = $month ;
			$time_end = date('Y-m-d',strtotime(date("Y-m-d", strtotime($time_starts)) . " +$month month"));
			$arrInsert['time_end'] = $time_end. ' '.$shift_time_end; 
			$arrInsert['holidays_count_date'] = (strtolower($arrInsert['time_end']) - strtotime($time_starts))/(60*60*24);
			//End tinh ngay
			//datecheck
			$fromdate = fmDateTimeSave($search['time_start']);
			$todate = fmDateTimeSave($arrInsert['time_end']);
			
			$checkdate = $this->model->table('hre_empleaveshow')
							  ->select('id')
							  ->where('employeeid',$items->id)
							  ->where('time_start',fmDateTimeSave($search['time_start']))
							  ->where('isdelete',0)
							  ->where('statusid',3)
							  ->find();
			if(empty($checkdate->id)){
				$empleaveshowid =  $this->model->table('hre_empleaveshow')->save('',$arrInsert);
			}
			else{
				$this->model->table('hre_empleaveshow')->where('id',$checkdate->id)->update($arrInsert);
				$empleaveshowid = $checkdate->id;
			}
			//Danh sach ngay nghi
			$listDate = $this->listDate($fromdate,$todate,$shift_time_star,$shift_time_end);
			//Xóa dữ liệu cũ
			$this->model->table('hre_empleaveshow_detail')->where('empleaveshowid',$empleaveshowid)->delete();
			foreach($listDate as $key => $item){
				$time_start = $item['from'];
				$time_end = $item['end'];
				$insertDetail = array();
				$insertDetail['empleaveshowid'] = $empleaveshowid; 
				$insertDetail['employeeid'] = $arrInsert['employeeid'];
				$insertDetail['datecheck'] = date('Y-m-d',strtotime($time_start));
				$insertDetail['time_start'] = $time_start;
				$insertDetail['time_end'] = $time_end;
				$insertDetail['departmentid'] = $arrInsert['departmentid'];
				$insertDetail['branchid'] = $arrInsert['branchid'];
				$insertDetail['statusid'] = 3;
				$this->model->table('hre_empleaveshow_detail')->insert($insertDetail);
			}
			
			$this->db->trans_complete(); 
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return 0;
			} 
			else {
				return $empleaveshowid;
			}
		}
	}
	function edits($search,$id){
		 $this->db->trans_start();
		 $login = $this->login;
		 $array = array();
		 $array['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		 $array['userupdate'] = $search['userupdate'];
		 
		 $departmentid = $search['departmentid'];//Cham theo bo phan
		 if(empty($search['departmentid'])){
			$departmentid = $login['departmentid'];//Cham theo bo phan
		 }
		 $employeeid  =  $search['employeeid'];
		 //Nhan vien
		 $items = $this->model->table('hre_employee')->select('id,departmentid,branchid,shiftid')
								 ->where('id',$employeeid)
								 ->where('departmentid',$departmentid)
								 ->where('isdelete',0)
								 ->find();
		 //Lấy ca làm việc của nhân viên
		 $shift = $this->model->table('hre_shift')->select('id,time_star,time_end')
							 ->where('id',$items->shiftid)
							 ->where('isdelete',0)
							 ->find();
		 $shift_time_star = 0; 
		 $shift_time_end = 0;
		 if(!empty($shift->time_star)){
			$shift_time_star = $shift->time_star; 
			$shift_time_end = $shift->time_end;
		 }
		 //S tinh ngay
		 $time_start =  fmDateTimeSave($search['time_start']); 
		 $array['time_start'] = $time_start;
		 $month =  $search['holidays_count_month'];
		 $array['holidays_count_month'] = $month ;
		 $time_end = date('Y-m-d',strtotime(date("Y-m-d", strtotime($time_start)) . " +$month month"));
		 $array['time_end'] = $time_end. ' '.$shift_time_end; 
		 $array['holidays_count_date'] = (strtolower($array['time_end']) - strtotime($time_start))/(60*60*24);
		//End tinh ngay
		
		 $fromdate = fmDateTimeSave($search['time_start']);
		 $todate = fmDateTimeSave($array['time_end']);
		 
		 //Danh sach ngay nghi
		 $listDate = $this->listDate($fromdate,$todate,$shift_time_star,$shift_time_end);
		//Xóa dữ liệu cũ
		 $this->model->table('hre_empleaveshow_detail')->where('empleaveshowid',$id)->delete();
		 foreach($listDate as $key => $item){
			$time_start = $item['from'];
			$time_end = $item['end'];
			$insertDetail = array();
			$insertDetail['empleaveshowid'] = $id; 
			$insertDetail['employeeid'] = $items->id;
			$insertDetail['datecheck'] = date('Y-m-d',strtotime($time_start));
			$insertDetail['time_start'] = $time_start;
			$insertDetail['time_end'] = $time_end;
			$insertDetail['departmentid'] = $items->departmentid;
			$insertDetail['branchid'] = $items->branchid;
			$insertDetail['statusid'] = 3;
			$this->model->table('hre_empleaveshow_detail')->insert($insertDetail);
		 }
		 
		 $result = $this->model->table('hre_empleaveshow')->where('id',$id)->update($array);	
		 $this->db->trans_complete(); 
		 if ($this->db->trans_status() === FALSE) {
			 $this->db->trans_rollback();
			return 0;
		 } 
		 else {
			return $id;
		 }
	 }
	 function listDate($fromdate,$todate,$shift_time_star,$shift_time_end){
		$arrMonth = array();
		$start = strtotime(date('Y-m-d', strtotime($fromdate)));
		$end = strtotime(date('Y-m-d', strtotime($todate)));
		while($start <= $end){
			$m = (int) date('m', $start);
			$y = (int) date('Y', $start);
			$d = (int) date('d', $start);
			if($m < 10){
				$m = '0'.$m;
			}
			if($d < 10){
				$d = '0'.$d;
			}
			$yearmonth = $y.'-'.$m.'-'.$d;
			$arrMonth[] = $yearmonth;
			$start = strtotime("+1 day", $start);
		} 
		
		$timeStart = date('H:i:s', strtotime($fromdate));
		$timeEnd = date('H:i:s', strtotime($todate));
		$arrayNew  = array();
		if(count($arrMonth) == 1){
			foreach($arrMonth as $key => $date){
				$arrayNew[$key]['from'] = $date.' '.$timeStart;
				$arrayNew[$key]['end'] = $date.' '.$timeEnd;
			}
		}
		else{
			$i = 1; $total = count($arrMonth);
			foreach($arrMonth as $key => $date){
				if($i==1){
					$arrayNew[$key]['from'] = $date.' '.$timeStart;
				}
				else{
					$arrayNew[$key]['from'] = $date.' '.$shift_time_star;
				}
				if($i == $total){
					$arrayNew[$key]['end'] = $date.' '.$timeEnd;
				}
				else{
					$arrayNew[$key]['end'] = $date.' '.$shift_time_end;
				}
				$i++;
			}
		}
		return $arrayNew;
	 }
}