<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class EmpleaveshowModel extends CI_Model
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
		$sql.= " and ts.statusid = 1";
		if(!empty($search['fromdate'])){
			$sql.= " and ts.datecheck >= '".fmDateSave($search['fromdate'])." 00:00:00' ";
		}
		if(!empty($search['todate'])){
			$sql.= " and ts.datecheck <= '".fmDateSave($search['todate'])." 23:59:59' ";
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
		$sql = "SELECT ts.id, e.code,e.identity , e.fullname, d.departmanet_name, e.departmentid, ts.time_start, ts.time_end, p.position_name, dg.departmentgroup_name, e.group_work_id, e.positionid, ts.datecheck
				from hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_empleaveshow ts on e.id = ts.employeeid
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
				from hre_employee e
				left join hre_department d on d.id = e.departmentid
				left join hre_empleaveshow ts on e.id = ts.employeeid
				left join hre_position p on p.id = e.positionid  and p.isdelete = 0
				WHERE e.isdelete = 0 
				$searchs
				and d.isdelete = 0
				";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($search){
		
		$array = array();
		$login = $this->login;
		$grouptype = $login['grouptype'];
		$departmentid = $search['departmentid'];//Cham theo bo phan
		$employeeid = $search['employeeid'];//Cham theo bo phan
		if(empty($search['departmentid'])){
			$departmentid = $login['departmentid'];//Cham theo bo phan
		}
		$departmentid = $search['departmentid'];
		$i = 0;
		$fromdate = fmDateTimeSave($search['time_start']);
		$todate = fmDateTimeSave($search['time_end']);
		
		if(!empty($departmentid) && empty($employeeid)){//Chấm theo bộ phận
			$query = $this->model->table('hre_employee')->select('id,departmentid,branchid, time_star,time_end')
								 ->join('hre_shift','hre_shift.id = hre_employee.shiftid','left')
								 ->where('departmentid',$departmentid)
								 ->where('isdelete',0)
								 ->find_all();
			foreach($query as $item){
				$shift_time_star = $item->time_star; 
				$shift_time_end = $item->time_end;
				$listDate = $this->listDate($fromdate,$todate,$shift_time_star,$shift_time_end);
				$arrInsert = array();
				$arrInsert['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
				$arrInsert['usercreate'] = $search['usercreate'];
				$arrInsert['employeeid'] = $item->id;
				$arrInsert['departmentid'] =  $item->departmentid;
				$arrInsert['branchid'] =  $item->branchid;
				$arrInsert['time_start'] = fmDateTimeSave($search['time_start']); 
				$arrInsert['time_end'] = fmDateTimeSave($search['time_end']);  
				$arrInsert['datecheck'] = fmDateSave($search['time_start']);
				$arrInsert['statusid'] = 1;					
				//datecheck
				$checkdate = $this->model->table('hre_empleaveshow')
								  ->select('id')
								  ->where('employeeid',$item->id)
								  ->where('datecheck',fmDateSave($search['time_start']))
								  ->where('isdelete',0)
								  ->where('statusid',1)
								  ->find();
				if(empty($checkdate->id)){
					$empleaveshowid = $this->model->table('hre_empleaveshow')->save('',$arrInsert);
				}
				else{
					$this->model->table('hre_empleaveshow')->where('id',$checkdate->id)->update($arrInsert);
					$empleaveshowid = $checkdate->id;
				}
				//Xóa dữ liệu cũ
				 $this->model->table('hre_empleaveshow_detail')->where('empleaveshowid',$id)->delete();
				 foreach($listDate as $key => $items){
					$time_start = $items['from'];
					$time_end = $items['end'];
					$insertDetail = array();
					$insertDetail['empleaveshowid'] = $empleaveshowid; 
					$insertDetail['employeeid'] = $item->id;
					$insertDetail['datecheck'] = date('Y-m-d',strtotime($time_start));
					$insertDetail['time_start'] = $time_start;
					$insertDetail['time_end'] = $time_end;
					$insertDetail['departmentid'] = $item->departmentid;
					$insertDetail['branchid'] = $item->branchid;
					$insertDetail['statusid'] = 1;
					$this->model->table('hre_empleaveshow_detail')->insert($insertDetail);
				 }
				$i++;
			}	
			return $i;
		}
		else{
			$items = $this->model->table('hre_employee')->select('id,departmentid,branchid,shiftid')
								 ->where('id',$employeeid)
								 ->where('isdelete',0)
								 ->find();
			if(empty($items->id)){
				return -2;
			}
			else{
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
				$fromdate = fmDateTimeSave($search['time_start']);
				$todate = fmDateTimeSave($search['time_end']);
				
				$arrInsert = array();
				$arrInsert['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
				$arrInsert['usercreate'] = $search['usercreate'];
				$arrInsert['employeeid'] = $items->id;
				$arrInsert['departmentid'] =  $items->departmentid;
				$arrInsert['branchid'] =  $items->branchid;
				$arrInsert['time_start'] = fmDateTimeSave($search['time_start']); 
				$arrInsert['time_end'] = fmDateTimeSave($search['time_end']); 
				$arrInsert['datecheck'] = fmDateSave($search['time_start']);
				$arrInsert['statusid'] = 1;		
				//datecheck
				
				$checkdate = $this->model->table('hre_empleaveshow')
								  ->select('id')
								  ->where('employeeid',$items->id)
								  ->where('datecheck',fmDateSave($search['time_start']))
								  ->where('isdelete',0)
								  ->where('statusid',1)
								  ->find();
				if(empty($checkdate->id)){
					$empleaveshowid = $this->model->table('hre_empleaveshow')->save('',$arrInsert);
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
					$insertDetail['employeeid'] = $items->id;
					$insertDetail['datecheck'] = date('Y-m-d',strtotime($time_start));
					$insertDetail['time_start'] = $time_start;
					$insertDetail['time_end'] = $time_end;
					$insertDetail['departmentid'] = $items->departmentid;
					$insertDetail['branchid'] = $items->branchid;
					$insertDetail['statusid'] = 1;
					$this->model->table('hre_empleaveshow_detail')->insert($insertDetail);
				 }
				 return $empleaveshowid;
			}
		}
		
	}
	function edits($search,$id){
		 $this->db->trans_start();
		 $login = $this->login;
		 $array = array();
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
		$fromdate = fmDateTimeSave($search['time_start']);
		$todate = fmDateTimeSave($search['time_end']);
		
		 $array['dateupdate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		 $array['userupdate'] = $search['userupdate'];
		 $array['time_start'] = fmDateTimeSave($search['time_start']); 
		 $array['time_end'] = fmDateTimeSave($search['time_end']); 
		 $array['datecheck'] = fmDateSave($search['time_start']);	
		 $array['statusid'] = 1;			
		 
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
			$insertDetail['statusid'] = 1;
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