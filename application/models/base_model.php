<?php
/**
 * @author 
 * @copyright 2017
 */
class base_model extends CI_Model {
    function __construct() {
        parent::__construct('');
        $this->load->model();
        $this->route = $this->router->class;
		$this->login = $this->site->getSession('glogin');
    }
	function getListTable($fromdate,$todate){
		$arrMonth = array();
		$start = strtotime(date('Y-m-d', strtotime($fromdate))); 
		$end = strtotime(date('Y-m-d', strtotime($todate)));
		while($start <= $end){
			$d = date('d', $start);
			$m = date('m', $start);
			$y = date('Y', $start);
			
			$yearmonth = $y.'-'.$m.'-'.$d;
			$arrMonth[] = $yearmonth;
			$start = strtotime("+1 day", $start);
		}
		return $arrMonth;
	}
	public function getMacAddress() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $mac = shell_exec("arp -a $ip");
        $arr = explode(" ", $mac);
        if (isset($arr[3])) {
            $macAddress = $arr[3];
        } else {
            $macAddress = $ip;
        }
        if ($macAddress != 'entries') {
            return $ip . ' ' . $macAddress;
        } else {
            return $ip;
        }
    }
	public function getKPIDepartment(){
		$query = $this->model->table('hre_criteriakpi_department')
							 ->select('id,kpi_code,kpi_name,kpi_point_max')
							 ->order_by('kpi_name')
							 ->where('isdelete',0)->find_all();
		return $query;
	}
	public function getCriteriaProbationary(){
		$query = $this->model->table('hre_criteriaprobationary')
							 ->select('id,aprobationary_name')
							 ->order_by('aprobationary_name')
							 ->where('isdelete',0)->find_all();
		return $query;
	}
	function getProvice() {
        $query = $this->model->table('hre_province')
					  ->select('id,province_name')
					  ->where('isdelete',0)
					  ->find_all();
        return $query;
    }
	/*public function getAcademic(){
		$query = $this->model->table('hre_academic_level')
							 ->select('id,academic_name')
							 ->order_by('academic_name')
							 ->where('isdelete',0)->find_all();
		return $query;
	}*/
	public function getListDay($fromdate, $todate){
		$arrMonth = array();
		$start = strtotime(date('Y-m-d', strtotime($fromdate)));
		$end = strtotime(date('Y-m-d', strtotime($todate)));
		while($start <= $end){
			$d = date('d', $start);
			$m = date('m', $start);
			$y = date('Y', $start);
			$yearmonth = $y.'-'.$m.'-'.$d;
			$arrMonth[] = $yearmonth;
			$start = strtotime("+1 day", $start);
		}
		return $arrMonth;
	}
	public function getCountHolidays($item){
		$contrac_date = $item->contrac_date;
		$bonus_holiday = $item->bonus_holiday;
		$datecreate = gmdate("Y-m-d", time() + 7 * 3600);
		if(empty($bonus_holiday)){
			$bonus_holiday = 0;
		}
		$holidays = $this->getHolidayYear();
		//Nam ky HD
		$timeYears = 0;
		if(!empty($item->contrac_date) && $item->contrac_date != '1970-01-01' && $item->contrac_date !='0000-00-00'){
			$contrac_date = date(configs('cfdate'),strtotime($item->contrac_date));
			$times = (int)((strtotime($datecreate) - strtotime($item->contrac_date))/86400);
			$yearss = ($times/365);
			$timeYears = round($yearss,1);
		}
		$holidays_date = 0;
		if(!empty($timeYears)){
			foreach($holidays as $items){
				//Tim so ngay nghi dua vao nam hop dong
				if($timeYears >= $items->holidays_year_from && $timeYears < $items->holidays_year_to){
					$holidays_date = $items->holidays_date;
				}
			}
		}
		$total = $holidays_date + $bonus_holiday;
		return $total;
	}
	function getHolidayYear(){
		$query = $this->model->table('hre_holidays_year')
					  ->select('id,holidays_year_from,holidays_year_to,holidays_date')
					  ->where('isdelete',0)
					  ->find_all();
		return $query;
	}
	public function getProvince(){
		$query = $this->model->table('hre_province')
							 ->select('id,province_name')
							 ->where('isdelete',0);				
		$query = $query->find_all();
		return $query;
	}
	public function getKPI(){
		$query = $this->model->table('hre_criteriakpi')
							 ->select('id,kpi_code,kpi_name,kpi_point_max')
							 ->where('isdelete',0)
							 ->order_by('kpi_name');				
		$query = $query->find_all();
		return $query;
	}
	
	public function getShift($branchid){
		$query = $this->model->table('hre_shift')
							 ->select('id,shift_name')
							 ->where('isdelete',0);		
		if(!empty($branchid)){
		   $query = $query->where('branchid',$branchid);
		}							 
		$query = $query->find_all();
		return $query;
	}
	public function getDepartmentGroup($departmentid){
		$query = $this->model->table('hre_departmentgroup')
							 ->select('id,departmentgroup_name')
							 ->where('isdelete',0);	
		if(!empty($departmentid)){
		   $query = $query->where('departmentid',$departmentid);
		}
		$query = $query->find_all();
		return $query;
	}
	public function getEmployee(){
		$query = $this->model->table('hre_employee')
							 ->select("id,concat(code,'-',fullname) as fullname")
							 ->where('isdelete',0);				
		$query = $query->find_all();
		return $query;
	}	
	function getEmployees($login,$departmentid='') {
		if(empty($departmentid)){
			$departmentid = $login['departmentid'];
		}
		$grouptype = $login['grouptype'];
        $query = $this->model->table('hre_employee')
					  ->select('id,code,fullname')
					  ->where('isdelete',0);
		if(!empty($departmentid)){
			$query = $query->where('departmentid',$departmentid);
		}
		if($grouptype == 4){
			$query = $query->where('code',$login['username']);
		}
		$query = $query->find_all();
        return $query;
    }
	public function getDistric($provinceid){
			$query = $this->model->table('hre_district')
							 ->select('id,distric_name')
							 ->where('isdelete',0);
							 
		    if(!empty($provinceid)){
			   $query = $query->where('provinceid',$provinceid);
		    }					
		    $query = $query->find_all();
			return $query;
		}
	public function getEthnic($ethnicid){
			$query = $this->model->table('hre_ethnic')
							 ->select('id,ethnic_name')
							 ->where('isdelete',0);
							 
		    if(!empty($ethnicid)){
			   $query = $query->where('id',$ethnicid);
		    }	
			$query = $query->order_by('ethnic_name','ASC');
		    $query = $query->find_all();
			return $query;
		}
	public function getReligion($religionid){
			$query = $this->model->table('hre_religion')
							 ->select('id,religion_name')
							 ->where('isdelete',0);
							 
		    if(!empty($religionid)){
			   $query = $query->where('id',$religionid);
		    }	
			$query = $query->order_by('religion_name','ASC');
		    $query = $query->find_all();
			return $query;
		}
	public function getAcademic($academicid=''){
			$query = $this->model->table('hre_academic_level')
							 ->select('id,academic_name')
							 ->where('isdelete',0);
							 
		    if(!empty($academicid)){
			   $query = $query->where('id',$academicid);
		    }	
			$query = $query->order_by('ordering','ASC');
		    $query = $query->find_all();
			return $query;
		}
	public function getDepartment($deparmentid){
			$query = $this->model->table('hre_department')
							 ->select('id,departmanet_name')
							 ->where('isdelete',0);
							 
		    if(!empty($deparmentid)){
			   $query = $query->where('id',$deparmentid);
		    }	
			$query = $query->order_by('departmanet_name','ASC');
		    $query = $query->find_all();
			return $query;
		}
	public function getPosition($positionid){
			$query = $this->model->table('hre_position')
							 ->select('id,position_name')
							 ->where('isdelete',0);
							 
		    if(!empty($positionid)){
			   $query = $query->where('id',$positionid);
		    }	
			$query = $query->order_by('ordering','ASC');
		    $query = $query->find_all();
			return $query;
		}
	public function getCoefficient($coefficientid=""){
			$query = $this->model->table('hre_coefficient')
							 ->select('id,groupt_name,public_name,coefficient,coefficient_rank')
							 ->where('isdelete',0);
							 
		    if(!empty($positionid)){
			   $query = $query->where('id',$positionid);
		    }	
			$query = $query->order_by('ordering','ASC');
		    $query = $query->find_all();
			return $query;
		}
	public function getJobStatus($jobstatusid){
			$query = $this->model->table('hre_job_status')
							 ->select('id,status_name')
							 ->where('isdelete',0);
							 
		    if(!empty($jobstatusid)){
			   $query = $query->where('id',$jobstatusid);
		    }	
			$query = $query->order_by('status_name','ASC');
		    $query = $query->find_all();
			return $query;
		}
	public function addAcction($ctrol,$func,$acction_before='',$action_after=''){
			$login =  $this->site->getSession("glogin");
			$array['ctrl'] = $ctrol;
			$array['gaction'] = $func;
			$array['before'] = $acction_before;
			$array['after'] = $action_after;
			$array['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600); 
			$array['usercreate'] =  $login['userlogin'];
			$array['ipcreate'] = $this->getMacAddress();
			$this->model->table('hre_action')->insert($array);
	}
	function getMonth(){
			$arr = array(); 
			$arr[1] = 'Tháng 1';
			$arr[2] = 'Tháng 2';
			$arr[3] = 'Tháng 3';
			$arr[4] = 'Tháng 4';
			$arr[5] = 'Tháng 5';
			$arr[6] = 'Tháng 6';
			$arr[7] = 'Tháng 7';
			$arr[8] = 'Tháng 8';
			$arr[9] = 'Tháng 9';
			$arr[10] = 'Tháng 10';
			$arr[11] = 'Tháng 11';
			$arr[12] = 'Tháng 12';
			return $arr;
		}
	function loadTable(){
		$login = $this->login;
		if(!isset($login['companyid'])){
			//redirect(base_url().'authorize');
		}
		$companyid = $login['companyid'];
		$arrTable = array();
		//hre_settingreport 
		return $arrTable;
	}
	function getColumns($table){
		$tbs = $this->loadTable();
        $sql = "
			SELECT column_name
			FROM information_schema.columns
			WHERE table_name='$table'; 
		";
        $query = $this->model->query($sql)->execute();
        $obj = new stdClass();
        foreach ($query as $item) {
            $clm = $item->column_name;
            $obj->$clm = null;
        }
        return $obj;
    }
    public function getPermission($login, $route,$processid = '') {
        $right = array();
        if (isset($login['params'][$route])) {
            $right = $login['params'][$route];
        }
		if($route == 'process'){
			$query = $this->model->table('hre_menus')
						  ->select('id,params')
						  ->where('route',$route)
						  ->where('processid',$processid)
						  ->where('isdelete',0)
						  ->find();
			if(empty($query->id)){
				return array();
			}
			else{
				$arr = explode(',',$query->params); 
				$right = array();
				foreach($arr as $key=>$val){
					$right[$val] = '';
				}
			}
		}	
        return $right;
    }
    public function getGroup($schoolid) {
        $query = $this->model->table('phone_groups')
                ->select('id,groupname')
                ->where('isdelete', 0);

        if (!empty($schoolid)) {
            $query = $query->where('id', $schoolid);
        }
        $query = $query->find_all();
        return $query;
    }
	public function getBranch($branchid) {
        $tb = $this->loadTable();
		$query = $this->model->table('hre_branch')
                ->select('id,branch_name')
                ->where('isdelete', 0);

        if (!empty($branchid)) {
            $query = $query->where('id', $branchid);
        }
		$query = $query->order_by('branch_name');
        $query = $query->find_all();
        return $query;
    }
	public function getNetBranch($branchid) {
        $tb = $this->loadTable();
		$query = $this->model->table('hre_branch')
                ->select('id,branch_name')
                ->where('isdelete', 0);

        if (!empty($branchid)) {
            $query = $query->where('id <>', $branchid);
        }
		$query = $query->order_by('branch_name');
        $query = $query->find_all();
        return $query;
    }
	public function getAutocompleteUnique($uniqueid){
		$tb = $this->loadTable();
		$sql = "
			SELECT p.id, p.uniqueid as label, '1' as type
			FROM `".$tb['hre_phone']."` p 
			where p.uniqueid like '%".$uniqueid."%'
			and p.isdelete = 0
			order by p.uniqueid desc
			limit 10
			;
		";
		$query = $this->model->query($sql)->execute();
		if(count($query) == 0){
			$query = array();
			$info = new stdClass();
			$info->id = '';
			$info->label = 'Không tìm thấy số phiếu';
			$info->type = 0;
			$query[0] = $info;
		}
		return $query;
	}
	public function doc1so($so){
			$arr_chuhangdonvi=array('không','một','hai','ba','bốn','năm','sáu','bảy','tám','chín');
			$resualt='';
				$resualt=$arr_chuhangdonvi[$so];
			return $resualt;
		}
	public function doc2so($so){
			$arr_chubinhthuong=array('không','một','hai','ba','bốn','năm','sáu','bảy','tám','chín');
			$arr_chuhangdonvi=array('mươi','mốt','hai','ba','bốn','lăm','sáu','bảy','tám','chín');
			$arr_chuhangchuc=array('','mười','hai mươi','ba mươi','bốn mươi','năm mươi','sáu mươi','bảy mươi','tám mươi','chín mươi');
			$resualt='';
			$sohangchuc=substr($so,0,1);
			$sohangdonvi=substr($so,1,1);
			$resualt.=$arr_chuhangchuc[$sohangchuc];
			if($sohangchuc==1&&$sohangdonvi==1)
				$resualt.=' '.$arr_chubinhthuong[$sohangdonvi];
			elseif($sohangchuc==1&&$sohangdonvi>1)
				$resualt.=' '.$arr_chuhangdonvi[$sohangdonvi];
			elseif($sohangchuc>1&&$sohangdonvi>0)
				$resualt.=' '.$arr_chuhangdonvi[$sohangdonvi];
			
			return $resualt;
		}
	public function doc3so($so){
		$resualt='';
		$arr_chubinhthuong=array('không','một','hai','ba','bốn','năm','sáu','bảy','tám','chín');
		$sohangtram=substr($so,0,1);
		$sohangchuc=substr($so,1,1);
		$sohangdonvi=substr($so,2,1);
		$resualt=$arr_chubinhthuong[$sohangtram].' trăm';
		if($sohangchuc==0&&$sohangdonvi!=0)
			$resualt.=' linh '.$arr_chubinhthuong[$sohangdonvi];
		elseif($sohangchuc!=0)
			$resualt.=' '.$this->doc2so($sohangchuc.$sohangdonvi);
		return $resualt;
	}
	public function docso($so){
			$arrSo = explode('.',$so);
			if(isset($arrSo[0])){
				$so = $arrSo[0];
			}
			$sole = 0;
			if(isset($arrSo[1])){
				$sole = $arrSo[1];
			}
			$result='';
			$arr_So=array('ty'=>'',
						  'trieu'=>'',
						  'nghin'=>'',
						  'tram'=>'');
			$sochuso=strlen($so);
			for($i=$sochuso-1;$i>=0;$i--)
			{
				
				if($sochuso-$i<=3)
				{
				   $arr_So['tram']=substr($so,$i,1).$arr_So['tram'];
				}
				elseif($sochuso-$i>3&&$sochuso-$i<=6)
				{
					$arr_So['nghin']=substr($so,$i,1).$arr_So['nghin'];
				}
				elseif($sochuso-$i>6&&$sochuso-$i<=9)
				{
					$arr_So['trieu']=substr($so,$i,1).$arr_So['trieu'];
				}
				else
				{
					$arr_So['ty']=substr($so,$i,1).$arr_So['ty'];
				}
			}
			if($arr_So['ty']>0)
				$result.=$this->doc($arr_So['ty']).' tỷ';
			if($arr_So['trieu']>0)
			{
				if($arr_So['trieu']>=100||$arr_So['ty']>0)
					$result.=' '.$this->doc3so($arr_So['trieu']).' triệu';
				elseif($arr_So['trieu']>=10)
					$result.=' '.$this->doc2so($arr_So['trieu']).' triệu';
				else $result.=' '.$this->doc1so($arr_So['trieu']).' triệu';
			}
			if($arr_So['nghin']>0)
			{
				if($arr_So['nghin']>=100||$arr_So['trieu']>0)
					$result.=' '.$this->doc3so($arr_So['nghin']).' nghìn';
				elseif($arr_So['nghin']>=10)
					$result.=' '.$this->doc2so($arr_So['nghin']).' nghìn';
				else $result.=' '.$this->doc1so($arr_So['nghin']).' nghìn';
			}
			if($arr_So['tram']>0)
			{
			   if($arr_So['tram']>=100||$arr_So['nghin']>0)
					$result.=' '.$this->doc3so($arr_So['tram']);
			   elseif($arr_So['tram']>=10)
					$result.=' '.$this->doc2so($arr_So['tram']);
			   else $result.=' '.$this->doc1so($arr_So['tram']);
			}
			$number = trim($result);
			$sub = 	strtoupper(substr($number,0,1));
			if(!empty($sole)){
				return $sub.substr($number,1).' lẻ '.$this->doc2so($sole).' đồng';
			}
			else{
				return $sub.substr($number,1).' đồng';
			}
		}
}
