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
	public function addAcction($ctrol,$func,$acction_before='',$action_after=''){
			$login =  $this->site->getSession("glogin");
			$array['ctrl'] = $ctrol;
			$array['gaction'] = $func;
			$array['before'] = $acction_before;
			$array['after'] = $action_after;
			$array['datecreate'] = gmdate("Y-m-d H:i:s", time() + 7 * 3600); 
			$array['usercreate'] =  $login['userlogin'];
			$array['ipcreate'] = $this->getMacAddress();
			$this->model->table('g_action')->insert($array);
	}
	function loadTable(){
		$login = $this->login;
		if(!isset($login['companyid'])){
			//redirect(base_url().'authorize');
		}
		$companyid = $login['companyid'];
		$arrTable = array();
		$arrTable['g_branch'] = 'g_branch_'.$companyid;	
		$arrTable['g_translate'] = 'g_translate_0';	
		$arrTable['g_language'] = 'g_language_'.$companyid;	
		$arrTable['g_manufacture'] = 'g_manufacture_'.$companyid;
		$arrTable['g_process'] = 'g_process_'.$companyid;
		$arrTable['g_processdetail'] = 'g_processdetail_'.$companyid;
		$arrTable['g_phone'] = 'g_phone_'.$companyid;
		$arrTable['g_phonedetail'] = 'g_phonedetail_'.$companyid;	
		$arrTable['g_customer'] = 'g_customer_'.$companyid;		
		$arrTable['g_product'] = 'g_product_'.$companyid;			
		$arrTable['g_service'] = 'g_service_'.$companyid;
		$arrTable['g_userdata'] = 'g_userdata_'.$companyid;
		$arrTable['g_barcod_setting'] = 'g_barcod_setting_'.$companyid;
		$arrTable['g_systemdata'] = 'g_systemdata_'.$companyid;
		$arrTable['g_capacity'] = 'g_capacity_'.$companyid; 
		$arrTable['g_color'] = 'g_color_'.$companyid; 
		$arrTable['g_report_list'] = 'g_report_list_'.$companyid; 
		$arrTable['g_settingreport'] = 'g_settingreport_'.$companyid; 
		$arrTable['g_receiving_config'] = 'g_receiving_config_'.$companyid; 
		$arrTable['g_partnumber_use'] = 'g_partnumber_use_'.$companyid; 
		$arrTable['g_partnumber'] = 'g_partnumber_'.$companyid; 
		$arrTable['g_payment'] = 'g_payment_'.$companyid; 
		$arrTable['g_inventory'] = 'g_inventory_'.$companyid; 
		$arrTable['g_historyinput'] = 'g_historyinput_'.$companyid; 
		$arrTable['g_catalog_pay'] = 'g_catalog_pay_'.$companyid; 
		$arrTable['g_catalog_receipt'] = 'g_catalog_receipt_'.$companyid; 
		$arrTable['g_pay'] = 'g_pay_'.$companyid;
		$arrTable['g_receipt'] = 'g_receipt_'.$companyid;
		$arrTable['g_catalog_service'] = 'g_catalog_service_'.$companyid;
		$arrTable['g_supplier'] = 'g_supplier_'.$companyid;
		$arrTable['g_bank'] = 'g_bank_'.$companyid;
		$arrTable['g_callcenter'] = 'g_callcenter_'.$companyid;
		$arrTable['g_catalog_callcenter'] = 'g_catalog_callcenter_'.$companyid;
		$arrTable['g_catalog_service_promotion'] = 'g_catalog_service_promotion_'.$companyid;
		$arrTable['g_businessdepartment'] = 'g_businessdepartment_'.$companyid;
		$arrTable['g_users'] = 'g_users';
		$arrTable['g_catalog_part'] = 'g_catalog_part_'.$companyid;
		$arrTable['g_phone_service'] = 'g_phone_service_'.$companyid;
		$arrTable['g_suppliers'] = 'g_suppliers_'.$companyid;
		$arrTable['g_stockdepartment'] = 'g_stockdepartment_'.$companyid;
		$arrTable['g_acceptmoney'] = 'g_acceptmoney_'.$companyid;
		$arrTable['g_transfermoney'] = 'g_transfermoney_'.$companyid;
		$arrTable['g_phonedetail_node'] = 'g_phonedetail_node_'.$companyid;
		//g_settingreport 
		return $arrTable;
	}
	function getColumns($table){
		$tbs = $this->loadTable();
        $sql = "
			SELECT column_name
			FROM information_schema.columns
			WHERE table_name='".$tbs[$table]."'; 
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
			$query = $this->model->table('g_menus')
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
	function getCatalogCallCenter(){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_catalog_callcenter'])
                ->select('id,catalog_callcenter_name')
                ->where('isdelete', 0);
        $query = $query->find_all();
        return $query;
	}
	function getgSupplier(){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_supplier'])
                ->select('id,supplier_name')
                ->where('isdelete', 0);
        $query = $query->order_by('supplier_name','asc')->find_all();
        return $query;
	}
	function getCatalogServicePromotion(){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_catalog_service_promotion'])
                ->select('id,catalog_service_name,discount')
                ->where('isdelete', 0)
				->order_by('catalog_service_name');
        $query = $query->find_all();
        return $query;
	}
	public function getBranch($branchid) {
        $tb = $this->loadTable();
		$query = $this->model->table($tb['g_branch'])
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
		$query = $this->model->table($tb['g_branch'])
                ->select('id,branch_name')
                ->where('isdelete', 0);

        if (!empty($branchid)) {
            $query = $query->where('id <>', $branchid);
        }
		$query = $query->order_by('branch_name');
        $query = $query->find_all();
        return $query;
    }
	public function getCatalogPay() {
        $tb = $this->loadTable();
		$query = $this->model->table($tb['g_catalog_pay'])
                ->select('id,catalog_pay_name')
                ->where('isdelete', 0);
		$query = $query->order_by('catalog_pay_name');
        $query = $query->find_all();
        return $query;
    }
	public function getCatalogReceipt() {
        $tb = $this->loadTable();
		$query = $this->model->table($tb['g_catalog_receipt'])
                ->select('id,catalog_receipt_name')
                ->where('isdelete', 0);
		$query = $query->order_by('catalog_receipt_name');
        $query = $query->find_all();
        return $query;
    }
	public function getUserAcceptPay($branchid) {
		$and = "";
		if(!empty($branchid)){
			$and = " and u.branchid = '$branchid'";
		}
		$sql = "
			select u.id, u.fullname
			from g_users u
			left join g_groups g on g.id = u.groupid
			where u.isdelete = 0
			$and
			and g.isdelete = 0
			and g.grouptype > -1
		";
        return $this->model->query($sql)->execute();
    }
	public function getTechnicians($branchid) {
		$and = "";
		if(!empty($branchid)){
			$and = " and u.branchid = '$branchid'";
		}
		$sql = "
			select u.id, u.fullname
			from g_users u
			left join g_groups g on g.id = u.groupid
			where u.isdelete = 0
			$and
			and g.isdelete = 0
			and g.grouptype = 4
		";
        return $this->model->query($sql)->execute();
    }
	public function getTechnicianTransfer($branchid) {
		$and = "";
		if(!empty($branchid)){
			$and = " and u.branchid = '$branchid'";
		}
		$sql = "
			select u.id, u.fullname
			from g_users u
			left join g_groups g on g.id = u.groupid
			where u.isdelete = 0
			$and
			and g.isdelete = 0
			and g.grouptype = 7
		";
        return $this->model->query($sql)->execute();
    }
    public function getProcess($processid ='') {
		$tb = $this->loadTable();
        $query = $this->model->table($tb['g_process'])
                ->select('processid,processname')
                ->where('isdelete', 0);
		if(!empty($processid)){
			$query = $query->where("processid in ($processid)");
		}
        $query = $query->find_all();
        return $query;
    }
	function getOneProcess($processid){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_process'])
                ->select('*')
                ->where('isdelete', 0);
		$query = $query->where("processid",$processid);
        $query = $query->limit(1)->find();
        return $query;
	}
	function getPreProcess($processid){		
		$tb = $this->loadTable();
		if(empty($processid)){
			$processid = 0;
		}
		$sql = "
			SELECT pd.processnode as processid, pr.processname
				FROM `".$tb['g_processdetail']."` pd
				LEFT JOIN `".$tb['g_process']."` pr on pr.processid = pd.processnode
				WHERE pd.isdelete = 0
				AND pd.nextprocessid in ($processid)
				AND pr.isdelete = 0
				GROUP BY pd.processnode
				;
		";
		return $this->model->query($sql)->execute();
	}
    public function getManufacturer(){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_manufacture'])
				->select('id,manufacture_name')
                ->where('isdelete', 0)
				->order_by('ordering,manufacture_name','ASC');
        $query = $query->find_all();
        return $query;
    }
	
	public function getUserData($processid=''){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_userdata'])
                ->where('isdelete', 0);
		if(!empty($processid)){
			$query = $query->where('processid',$processid);
		}
		$query = $query->order_by('ordering','ASC');
        $query = $query->find_all();
        return $query;
    }
	public function getProduct($manufactureid=''){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_product'])
				->select('id,product_name,manufactureid')
                ->where('isdelete', 0);
		if(!empty($manufactureid)){
			$query = $query->where('manufactureid in ('.$manufactureid.')');
		}
		$query = $query->order_by('manufactureid, product_name','ASC');
        $query = $query->find_all();
        return $query;
    }
	public function getService($productid=''){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_service'])
				->select('id,service_name,manufactureid,revenue_code,accounting_code')
                ->where('isdelete', 0);
		if(!empty($productid)){
			$query = $query->where('productid in ('.$productid.')');
		}
		$query = $query->order_by('accounting_code','ASC');
        $query = $query->find_all();
        return $query;
    }
	public function getSystemdata($processid=''){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_systemdata'])
                ->where('isdelete', 0);
		if(!empty($processid)){
			$query = $query->where('processid',$processid);
		}
		$query = $query->order_by('ordering','ASC');
        $query = $query->find_all();
        return $query;
    }
	public function getSystemdataBarcode($processid=''){
		$tb = $this->loadTable();
		$sql = "
			SELECT s.id,s.keylang, s.keylang_placeholder , s.processid, s.clmname, s.systemdataname, s.placeholder, s.datatype, s.datalist, s.datadefault, s.tablejoin, s.isnotnull,
			(
				select bs.systemid
				from `".$tb['g_barcod_setting']."` bs
				where bs.isdelete = 0
				and bs.processid = s.processid
				and bs.systemid = s.id
				limit 1
			) as systemid,
			(
				select bs.typeid
				from `".$tb['g_barcod_setting']."` bs
				where bs.isdelete = 0
				and bs.processid = s.processid
				and bs.systemid = s.id
				limit 1
			) as typeid
			FROM `".$tb['g_systemdata']."` s
			WHERE s.isdelete = 0
			AND s.processid = '$processid'
			AND s.isshow = 1
			order by s.ordering asc
			;
		"; 
	    return $this->model->query($sql)->execute();
	}
	public function getCapacity(){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_capacity'])
                ->where('isdelete', 0)
				->order_by('capacity','ASC');
        $query = $query->find_all();
        return $query;
    }
	public function getColor(){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_color'])
                ->where('isdelete', 0)
				->order_by('colorname','ASC');
        $query = $query->find_all();
        return $query;
    }
	public function getBank(){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_bank'])
				->select("id,concat(bank_name,'(',bank_code,')') as bank_name")
                ->where('isdelete', 0)
				->order_by('bank_name','ASC');
        $query = $query->find_all();
        return $query;
    }
	public function getCustomer($phone=''){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_customer'])
                ->where('isdelete', 0);
		if(!empty($phone)){
			$query = $query->where("phone like '%$phone%'");
		}		
		$query = $query->order_by('customer_name','ASC');
        $query = $query->find_all();
        return $query;
    }
	public function getNextProcess($processnode){
		$tb = $this->loadTable();
		$sql = "
			SELECT pd.processnode, pd.nextprocessid, p.processname
			FROM `".$tb['g_processdetail']."` pd
			LEFT JOIN `".$tb['g_process']."` p on p.processid = pd.nextprocessid
			WHERE pd.isdelete = 0
			AND p.isdelete = 0
			AND pd.processnode = '$processnode'
			;
		";
		$query = $this->model->query($sql)->execute();
	    return $query;
	}
	public function getPartCatalog($productid,$color=''){
		$tb = $this->loadTable();
		$sql = "
			SELECT `id`, `partnumber`, `description`, `productid`, `quantity`, `price`
			FROM `".$tb['g_partnumber']."`
			WHERE isdelete = 0
			LIMIT 9
			/*FIND_IN_SET($productid,`productid`)*/
		";
		return  $this->model->query($sql)->execute();
	}
	public function getAllSetting($processid){
		$tb = $this->loadTable();
		$sql = " 
		select *
		FROM(
			SELECT bs.*, p.processname, s.systemdataname, if(bs.systemid = '-1','uniqueid', s.clmname) as clmname
					FROM `".$tb['g_barcod_setting']."`  bs
					LEFT JOIN `".$tb['g_process']."` p on p.processid = bs.processid
					LEFT JOIN `".$tb['g_systemdata']."` s on s.id = bs.systemid AND s.isdelete = 0
					WHERE bs.isdelete = 0 
					AND p.isdelete = 0
					AND bs.datatype = 0
					AND bs.processid = '$processid'
					union all
			SELECT bs.*, p.processname, s.userdataname as systemdataname, concat('userdata_',s.id) as clmname 
					FROM `".$tb['g_barcod_setting']."`  bs
					LEFT JOIN `".$tb['g_process']."` p on p.processid = bs.processid
					LEFT JOIN `".$tb['g_userdata']."` s on s.id = bs.systemid 
					WHERE bs.isdelete = 0 
					AND p.isdelete = 0
					AND s.isdelete = 0
					AND bs.datatype = 1
					AND bs.processid = '$processid'
			) t
				ORDER BY t.order_row, t.order_clm
				";
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	public function getAllSettingGroup($processid){
		$tb = $this->loadTable();
		$sql = "
			select *
			from(
			SELECT bs.id, bs.order_row, bs.order_clm, bs.displayname, bs.typeid, 	bs.font_size, if(bs.systemid = '-1','uniqueid', s.clmname) as clmname 
							FROM `".$tb['g_barcod_setting']."`  bs
							LEFT JOIN `".$tb['g_process']."` p on p.processid = bs.processid
							LEFT JOIN `".$tb['g_systemdata']."` s on s.id = bs.systemid 
							WHERE bs.isdelete = 0 
							AND p.isdelete = 0
							AND s.isshow = 1
							AND s.isdelete = 0
							AND bs.datatype = 0
							AND bs.processid = '$processid'
			union all
			SELECT bs.id, bs.order_row, bs.order_clm, bs.displayname, bs.typeid, 	bs.font_size, concat('userdata_',s.id) as clmname 
							FROM `".$tb['g_barcod_setting']."`  bs
							LEFT JOIN `".$tb['g_process']."` p on p.processid = bs.processid
							LEFT JOIN `".$tb['g_userdata']."` s on s.id = bs.systemid 
							WHERE bs.isdelete = 0 
							AND p.isdelete = 0
							AND s.isdelete = 0
							AND bs.datatype = 1
							AND bs.processid = '$processid'
			) t
			group by t.order_row
		";
		return $query = $this->model->query($sql)->execute();
	}
	public function getQueryJoin(){
		$tb = $this->loadTable();
		$system = $this->model->table($tb['g_systemdata'])
					   ->select('id,tablejoin,clmname')
					   ->where('tablejoin <>','')
					   ->where('tablejoin is not null')
					   ->where('isdelete',0)
					   ->where('isshow',1)
					   ->find_all(); 
		$arrTable = array();
		$arrTable['g_manufacture'] = 'manufacture_name';
		$arrTable['g_product'] = 'product_name';
		$arrTable['g_color'] = 'colorname';
		$arrTable['g_capacity'] = 'capacity';
		$arrTable['g_customer'] = 'customer_name';
		$join = '';
		$select = '';
		foreach($system as $item){
			$tablejoin = $item->tablejoin;
			$clmname = $item->clmname;
			$names = $arrTable[$tablejoin];
			if($tablejoin == 'g_customer'){
				$select.= " , concat(".$tablejoin.".".$names.",' - ',".$tablejoin.".phone) as ".$clmname."_names ";
			}
			else{
				$select.= " , ".$tablejoin.".".$names." as ".$clmname."_names ";
			}
			if($tablejoin == 'g_process'){
				$join.= " LEFT JOIN `$tablejoin` on ".$tablejoin.".processid = if(pd.statusacept = 1,pd.nextprocessid,pd.processid)  AND ".$tablejoin.".isdelete = 0 ";
			}
			else{
				$join.= " LEFT JOIN `$tablejoin` on ".$tablejoin.".id = p.".$clmname."  AND ".$tablejoin.".isdelete = 0 ";
			}
		}
		$arr = array();
		$arr['select'] = $select;
		$arr['join'] = $join;
		return $arr;
	}
	public function getSettingFormSearch($reportid){
		$tb = $this->loadTable();
		$sql = "
			SELECT sr.clmname, `clmname_search`, `clmname_search_odering`, st.systemdataname, st.placeholder, st.datatype, `datalist`, `datadefault`, `tablejoin`, `isnotnull` 
			FROM `".$tb['g_settingreport']."` sr 
			LEFT JOIN `".$tb['g_systemdata']."` st ON st.clmname = sr.clmname 
			WHERE `reportid` = '$reportid'
			AND sr.clmname_search = 1 
			AND st.isdelete =0 
			ORDER BY sr.clmname_search_odering ASC
		";
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	public function getSettingFormExport($reportid){
		$tb = $this->loadTable();
		$sql = "
			select sr.clmname, st.clmname_export, sr.clmname_search_odering, st.systemdataname, st.placeholder,
			st.datatype, st.datalist, st.datadefault, st.tablejoin, st.isnotnull
			from `".$tb['g_settingreport']."` sr
			left join `".$tb['g_systemdata']."` st on st.clmname = sr.clmname
			where sr.isdelete = 0
			and st.clmname_export = 1
			order by clmname_export_odering asc
		";
		return $this->model->query($sql)->execute();
	}
	public function getSettingGridview($reportid){
		/*$query = $this->model->table('g_settingreport')
					  ->select('g_settingreport.clmname,clmname_clm,clmname_clm_odering,g_systemdata.systemdataname,g_systemdata.placeholder, g_systemdata.datatype, datalist, datadefault, tablejoin, isnotnull')
					  ->join('g_systemdata','g_systemdata.clmname = g_settingreport.clmname','left')
					  ->where('reportid',$reportid)
					  ->where('g_settingreport.clmname_clm',1)
					  ->where('g_systemdata.isdelete',0)
					  ->order_by('g_settingreport.clmname_clm_odering','asc')
					  ->find_all();
		return $query;*/
		$tb = $this->loadTable();
		$sql = "
			select sr.clmname, sr.clmname_clm, sr.clmname_export, sr.clmname_search_odering, st.systemdataname, st.placeholder,
			st.datatype, st.datalist, st.datadefault, st.tablejoin, st.isnotnull
			from `".$tb['g_settingreport']."` sr
			left join `".$tb['g_systemdata']."` st on st.clmname = sr.clmname
			where sr.isdelete = 0
			and sr.clmname_clm = 1
			order by clmname_export_odering asc
		";
		return $this->model->query($sql)->execute();
	}
	public function getSettingExport($reportid){
		/*$query = $this->model->table('g_settingreport')
					  ->select('g_settingreport.clmname,clmname_export,clmname_export_odering,g_systemdata.systemdataname,g_systemdata.placeholder, g_systemdata.datatype, datalist, datadefault, tablejoin, isnotnull')
					  ->join('g_systemdata','g_systemdata.clmname = g_settingreport.clmname','left')
					  ->where('reportid',$reportid)
					  ->where('g_settingreport.clmname_export',1)
					  ->where('g_systemdata.isdelete',0)
					  ->order_by('g_settingreport.clmname_export_odering','asc')
					  ->find_all();
		return $query;*/
		$tb = $this->loadTable();
		$sql = "
			select sr.clmname, st.clmname_export, sr.clmname_search_odering, st.systemdataname, st.placeholder,
			st.datatype, st.datalist, st.datadefault, st.tablejoin, st.isnotnull
			from `".$tb['g_settingreport']."` sr
			left join `".$tb['g_systemdata']."` st on st.clmname = sr.clmname
			where sr.isdelete = 0
			and st.clmname_export = 1
			order by clmname_export_odering asc
		";
		return $this->model->query($sql)->execute();
	}
	public function getDataCombo($table){
		$tb = $this->loadTable();
		if($table == 'g_manufacture'){
			$query = $this->model->table($tb['g_manufacture'])
						  ->where('isdelete',0)
						  ->order_by('manufacture_name')
						  ->find_combo('id','manufacture_name');
			return $query;
		}
		elseif($table == 'g_product'){
			$query = $this->model->table($tb['g_product'])
						  ->where('isdelete',0)
						  ->order_by('ordering')
						  ->find_combo('id','product_name');
			return $query;
		}
		elseif($table == 'g_color'){
			$query = $this->model->table($tb['g_color'])
						  ->where('isdelete',0)
						  ->order_by('colorname')
						  ->find_combo('id','colorname');
			return $query;
		}
		elseif($table == 'g_process'){
			$query = $this->model->table($tb['g_process'])
						  ->where('isdelete',0)
						  ->order_by('processname')
						  ->find_combo('processid','processname');
			return $query;
		}
		elseif($table == 'g_capacity'){
			$query = $this->model->table($tb['g_capacity'])
						  ->where('isdelete',0)
						  ->order_by('capacity')
						  ->find_all();
			$array = array();
			foreach($query as $item){
				$array[$item->id] = $item->capacity .'GB';
			}
			return $array;
		}
		elseif($table == 'g_customer'){
			$query = $this->model->table($tb['g_customer'])
						  ->select('id,phone,customer_name')
						  ->where('isdelete',0)
						  ->order_by('customer_name')
						  ->find_all();
			$array = array();
			foreach($query as $item){
				$array[$item->id] = $item->customer_name;
			}
			return $array;
		}
	}
	public function getAutocompleteUniqueProcess($uniqueid,$prs){
		$sql = "
			SELECT p.id, p.uniqueid as label, '1' as type
			FROM g_phone p 
			LEFT JOIN g_phonedetail pd on p.id = pd.phoneid
			where p.uniqueid like '%".$uniqueid."%'
			and p.isdelete = 0
			and pd.isdelete = 0
			and (if(pd.statusacept=1, pd.nextprocessid, pd.processid)) = '$prs'
			and pd.isnew = 1
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
	public function getAutocompleteUnique($uniqueid){
		$tb = $this->loadTable();
		$sql = "
			SELECT p.id, p.uniqueid as label, '1' as type
			FROM `".$tb['g_phone']."` p 
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
	public function getAutocompleteUniqueReceiving($uniqueid){
		$tb = $this->loadTable();
		$sql = "
			SELECT p.id, p.uniqueid as label, '1' as type
			FROM `".$tb['g_phone']."` p 
			LEFT JOIN `".$tb['g_phonedetail']."` pd on p.id = pd.phoneid
			where p.uniqueid like '%".$uniqueid."%'
			and p.isdelete = 0
			and pd.isnew = 1
			and pd.processid = 1
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
	public function getAutocompletetTechnician($branchid,$fullname){
		$tb = $this->loadTable();
		$and = "";
		if(!empty($branchid)){
			$and = " and u.branchid = '$branchid'";
		}
		if(!empty($branchid)){
			$and = " and u.fullname like '%$fullname%'";
		}
		$sql = "
			select u.id, if(u.usercode <> '' and u.usercode is not null,concat(u.fullname,' - ',u.usercode), u.fullname) as label
			from g_users u
			left join g_groups g on g.id = u.groupid
			where u.isdelete = 0
			$and
			and g.isdelete = 0
			and g.grouptype = 6
		";
        return $this->model->query($sql)->execute();
	}
	public function getAutocompletetBanks($bank_name){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_bank'])
					  ->select("id, bank_name as label")
					  ->where('isdelete',0);
		if(!empty($bank_name)){
			$query = $query->where("bank_name like '%$bank_name%'");
		}
		$query = $query->order_by('bank_name')
					  ->limit(10)
					  ->find_all();
        return $query;
	}
	public function getAutocompletetService($productid,$service_name){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_service'])
					  ->select("id, service_name as label, price, discount_staff")
					  ->where('isdelete',0)
					  ->where('productid',$productid);
		if(!empty($service_name)){
			$query = $query->where("service_name like '%$service_name%'");
		}
		$query = $query->order_by('service_name')
					  ->limit(10)
					  ->find_all();
        return $query;
	}
	public function getAutocompleteCus3($customer_name){
		$tb = $this->loadTable();
		$sql = "
			select c.id, c.rank, c.customer_name as label, c.phone, c.email, c.birthday, 
			c.address, c.presenter_phone, c.presenter_name,
			(
			 select p.uniqueid
			 from `".$tb['g_phone']."` p
			 where p.customerid = c.id
			 order by p.datecreate desc
			 limit 1
			) as uniqueid
			from `".$tb['g_customer']."` c
			where c.isdelete = 0
		";
		if(!empty($customer_name)){
			$sql.= " and (c.customer_name like '%$customer_name%' or c.phone like '%$customer_name%' )";
		}
		$sql.= " order by c.customer_name asc limit 10";
		return $this->query($sql)->execute();
	}
	public function getAutocompleteCus($customer_name,$phone){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_customer'])
					  ->select("id, concat(customer_name, ' - ', phone) as label, phone, email, birthday, address")
					  ->where('isdelete',0);
		if(!empty($customer_name)){
			$query = $query->where("customer_name like '%$customer_name%'");
		}
		if(!empty($phone)){
			$query = $query->where("phone like '%$phone%'");
		}
		$query = $query->order_by('customer_name')
					  ->limit(10)
					  ->find_all();
		return $query;
	}
	public function getAutocompleteCus2($customer_name,$phone){
		$tb = $this->loadTable();
		$sql = "
			select c.id, c.rank, c.customer_name as label, c.phone, c.email, c.birthday, 
			c.address, c.presenter_phone, c.presenter_name,
			(
			 select count(1)
			 from `".$tb['g_phone']."` p
			 where p.customerid = c.id
			) as visit
			from `".$tb['g_customer']."` c
			where c.isdelete = 0
		";
		if(!empty($customer_name)){
			$sql.= " and c.customer_name like '%$customer_name%' ";
		}
		if(!empty($phone)){
			$sql.= " and c.phone like '%$phone%' ";
		}
		$sql.= " order by c.customer_name asc limit 10";
		return $this->query($sql)->execute();
	}
	public function getAutocompleteProduct($product_name,$manufactureid){
		$tb = $this->loadTable();
		$sql = "
			select p.id as productid, TRIM(p.product_name) as label, p.manufactureid, TRIM(m.manufacture_name) as manufacture_name
			from `".$tb['g_product']."` p
			left join `".$tb['g_manufacture']."` m on m.id = p.manufactureid
			where p.isdelete = 0
		";
		if(!empty($product_name)){
			$sql.= " and p.product_name like '%$product_name%' ";
		}
		if(!empty($manufactureid)){
			$sql.= " and p.manufactureid = '$manufactureid' ";
		}
		$sql.= " order by p.product_name asc limit 10";
		return $this->query($sql)->execute();
	}
	public function getAutocompleteManuafacture($manufacture_name){
		$tb = $this->loadTable();
		$sql = "
			select c.id as manufactureid, TRIM(c.manufacture_name) as label
			from `".$tb['g_manufacture']."` c
			where c.isdelete = 0
		";
		if(!empty($manufacture_name)){
			$sql.= " and c.manufacture_name like '%$manufacture_name%' ";
		}
		$sql.= " order by c.manufacture_name asc limit 10";
		return $this->query($sql)->execute();
	}
	public function getAutocompleteServicePromotion($catalog_service_name){
		$tb = $this->loadTable();
		$sql = "
			select c.id, TRIM(c.catalog_service_name) as label, c.discount
			from `".$tb['g_catalog_service_promotion']."` c
			where c.isdelete = 0
		";
		if(!empty($catalog_service_name)){
			$sql.= " and c.catalog_service_name like '%$catalog_service_name%' ";
		}
		$sql.= " order by c.catalog_service_name asc limit 10";
		return $this->query($sql)->execute();
	}
	public function getAutocomplete($search){
		$tb = $this->loadTable();
		
		if(!is_numeric($search)){
			$query = $this->model->table($tb['g_phone'])
					  ->select("id, customer_name as label")
					  ->where('isdelete',0)
					  ->where("customer_name like '%$search%'")
					  ->limit(10)
					  ->find_all();
		}
		else{
			$query = $this->model->table($tb['g_phone'])
					  ->select("id, uniqueid as label")
					  ->where('isdelete',0)
					  ->where("uniqueid like '%$search%'")
					  ->limit(10)
					  ->find_all();
			if(count($query) == 0){
				$query = $this->model->table($tb['g_phone'])
					  ->select("id, customer_phone as label")
					  ->where('isdelete',0)
					  ->where("customer_phone like '%$search%'")
					  ->limit(10)
					  ->find_all();
			}
		}
		return $query;
	}
	public function getPrice($login,$fromdate='',$todate=''){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_payment'])
					  ->select('sum(price) as price')
					  ->where('isdelete',0);
		if(!empty($fromdate)){
			$query = $query->where('datecreate >=',fmDateSave($fromdate).' 00:00:00');
		}
		if(!empty($todate)){
			$query = $query->where('datecreate <=',fmDateSave($todate).' 23:59:59');
		}			  
		$query = $query->find();
		if(!empty($query->price)){
			return $query->price;
		}
		else{
			return 0;
		}
	}
	public function countAccept($login,$fromdate='',$todate=''){
		$tb = $this->loadTable();
		$processid = $login['processid'];
		$userlogin = $login['userlogin'];
		if(empty($processid)){
			$processid = 0;
		}
		$grouptype = $login['grouptype'];
		$and = '';
		if($grouptype > 0){
			$and.= " and pd.useraccept = '".$userlogin."' ";	
		}
		if(!empty($fromdate)){
			$and.= " and pd.datetransfer >= '".fmDateSave($fromdate)." 00:00:00' ";
		}
		if(!empty($todate)){
			$and.= " and pd.datetransfer <= '".fmDateSave($todate)." 23:59:59' ";
		}
		$sql = "
			SELECT count(1) total
				FROM `".$tb['g_phonedetail']."` pd
				LEFT JOIN `".$tb['g_phone']."` p on p.id = pd.phoneid
				WHERE pd.isdelete = 0
				AND pd.statusacept = 0
				AND pd.nextprocessid in ($processid)
				AND pd.isnew = 1
				AND pd.shipcustomer = 0
				$and
				AND p.isdelete = 0
		";
		$query = $this->model->query($sql)->execute();
		if(!empty($query[0]->total)){
			return $query[0]->total;
		}
		else{
			return 0;
		}
	}
	public function countAcceptList($login,$fromdate='',$todate=''){
		$tb = $this->loadTable();
		$processid = $login['processid'];
		$userlogin = $login['userlogin'];
		$grouptype = $login['grouptype'];
		$username = $login['username'];
		if(empty($processid)){
			$processid = 0;
		}
		$and = '';
		if(!empty($fromdate)){
			$and.= " and pd.datetransfer >= '".fmDateSave($fromdate)." 00:00:00' ";
		}
		if(!empty($todate)){
			$and.= " and pd.datetransfer <= '".fmDateSave($todate)." 23:59:59' ";
		}
		$and = '';
		if($grouptype > 0){
			$and.= " AND pd.useraccept = '$userlogin' ";	
		}
		$sql = "
			SELECT count(1) total, pd.usercreate, u.avatar, u.fullname, pr.processname, pd.processid
				FROM `".$tb['g_phonedetail']."` pd
				LEFT JOIN `".$tb['g_phone']."` p on p.id = pd.phoneid
				LEFT JOIN g_users u on u.username = pd.usercreate
				LEFT JOIN g_process pr on pr.processid = pd.processid
				WHERE pd.isdelete = 0
				AND pd.statusacept = 0
				AND pd.isnew = 1
				AND pd.shipcustomer = 0
				AND pd.nextprocessid in ($processid)
				$and
				AND p.isdelete = 0
				group by p.usercreate, pd.processid
		";
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	public function countTransfer($login,$fromdate='',$todate=''){
		$tb = $this->loadTable();
		$processid = $login['processid'];
		if(empty($processid)){
			$processid = 0;
		}
		$login = $this->login;
		$grouptype = $login['grouptype'];
		$username = $login['username'];
		$and = '';
		if($grouptype > 0){
			$and.= " and pd.usercreate = '".$username."' ";	
		}
		if(!empty($fromdate)){
			$and.= " and if(pd.statusacept = 1, pd.dateaccept, pd.datecreate) >= '".fmDateSave($fromdate)." 00:00:00' ";
		}
		if(!empty($todate)){
			$and.= " and if(pd.statusacept = 1, pd.dateaccept, pd.datecreate) <= '".fmDateSave($todate)." 23:59:59' ";
		}
		$sql = "
			SELECT count(1) total
				FROM `".$tb['g_phonedetail']."` pd
				LEFT JOIN `".$tb['g_phone']."` p on p.id = pd.phoneid
				LEFT JOIN `".$tb['g_process']."` pr on pr.processid = pd.processid
				WHERE pd.isdelete = 0
				AND pd.statusacept = -1
				AND pd.isnew = 1
				AND if((pd.shipcustomer = 1 and pd.statusacept != -1 and pd.nextprocessid = 0), 0,1) = 1
				AND pd.processid in ($processid)
				AND p.isdelete = 0
				$and
		";
		$query = $this->model->query($sql)->execute();
		if(!empty($query[0]->total)){
			return $query[0]->total;
		}
		else{
			return 0;
		}
	}
	public function countWip($login,$fromdate='',$todate=''){
		$tb = $this->loadTable();
		$processid = $login['processid'];
		if(empty($processid)){
			$processid = 0;
		}
		$grouptype = $login['grouptype'];
		$username = $login['username'];
		$and = '';
		if($grouptype > 0){
			$and.= " and if(pd.statusacept = 1, pd.useraccept, pd.usercreate) = '".$username."' ";	
		}
		if(!empty($fromdate)){
			$and.= " and if(pd.statusacept = 1, pd.dateaccept, pd.datecreate) >= '".fmDateSave($fromdate)." 00:00:00' ";
		}
		if(!empty($todate)){
			$and.= " and if(pd.statusacept = 1, pd.dateaccept, pd.datecreate) <= '".fmDateSave($todate)." 23:59:59' ";
		}
		$sql = "
			SELECT count(1) total
				FROM `".$tb['g_phonedetail']."` pd
				LEFT JOIN `".$tb['g_phone']."` p on p.id = pd.phoneid
				LEFT JOIN `".$tb['g_process']."` pr on pr.processid = pd.processid
				WHERE pd.isdelete = 0
				AND pd.isnew = 1
				AND if((pd.shipcustomer = 1 and pd.statusacept != -1 and pd.nextprocessid = 0), 0,1) = 1
				and if(pd.statusacept = 1, pd.nextprocessid, pd.processid) in ($processid)
				AND p.isdelete = 0
				$and
		";
		$query = $this->model->query($sql)->execute();
		if(!empty($query[0]->total)){
			return $query[0]->total;
		}
		else{
			return 0;
		}
	}
	public function countInput($login,$fromdate='',$todate=''){
		$tb = $this->loadTable();
		$processid = $login['processid'];
		if(empty($processid)){
			$processid = 0;
		}
		$grouptype = $login['grouptype'];
		$username = $login['username'];
		$and = '';
		if($grouptype > 0){
			$and.= " and pd.usercreate = '".$username."' ";	
		}
		if(!empty($fromdate)){
			$and.= " and pd.datecreate >= '".fmDateSave($fromdate)." 00:00:00' ";
		}
		if(!empty($todate)){
			$and.= " and pd.datecreate <= '".fmDateSave($todate)." 23:59:59' ";
		}
		if(!empty($processid)){
			$and.= " AND pd.processid in ($processid)";
		}
		$sql = "
			select count(1) total
			from(
				SELECT 1
					FROM `".$tb['g_phonedetail']."` pd
					LEFT JOIN `".$tb['g_phone']."` p on p.id = pd.phoneid
					LEFT JOIN `".$tb['g_process']."` pr on pr.processid = pd.processid
					WHERE pd.isdelete = 0
					AND p.isdelete = 0
					$and
					group by p.uniqueid
				) t
		";
		$query = $this->model->query($sql)->execute();
		if(!empty($query[0]->total)){
			return $query[0]->total;
		}
		else{
			return 0;
		}
	}
	public function transferCustomer($login,$fromdate='',$todate=''){
		$tb = $this->loadTable();
		$username = $login['username'];
		$grouptype = $login['grouptype'];
		$and = '';
		if(!empty($fromdate)){
			$and.= " and if(pd.statusacept = 1, pd.dateaccept, pd.datecreate) >= '".fmDateSave($fromdate)." 00:00:00' ";
		}
		if(!empty($todate)){
			$and.= " and if(pd.statusacept = 1, pd.dateaccept, pd.datecreate) <= '".fmDateSave($todate)." 23:59:59' ";
		}
		if($grouptype > 0){
			$and.= " and pd.usercreate = '$username'";	
		}
		$sql = "
			SELECT count(1) total
				FROM `".$tb['g_phonedetail']."` pd
				LEFT JOIN `".$tb['g_phone']."` p on p.id = pd.phoneid
				WHERE pd.isdelete = 0
				AND pd.isnew = 1
				AND pd.shipcustomer = 1
				AND pd.nextprocessid = 0
				$and
				AND p.isdelete = 0
		";
		$query = $this->model->query($sql)->execute();
		if(!empty($query[0]->total)){
			return $query[0]->total;
		}
		else{
			return 0;
		}
	}
	public function createAction($processid,$userlogin){
		$sql = "
			SELECT u.id, u.username , u.groupid, u.avatar , u.fullname, u.supplierid, '".$processid."' as processid,u.processid as listprocessid , u.email, u.phone, g.groupname, g.isadmin, g.params, g.companyid, g.grouptype, u.branchid
			FROM g_users u
			LEFT JOIN g_groups g on g.id = u.groupid
			WHERE u.isdelete = 0
			AND g.isdelete = 0
			and u.activate = 1
			AND u.username = '$userlogin' 
			;
		";
		$query = $this->model->query($sql)->execute();
		$data = $query[0];
		$userlogin = $query[0]->username;
		
		$result = new stdClass();
		$login = (array)$data;
		#region set Ctrl
		$sql = "
			SELECT m.id, if((m.processid = 1 and m.route = 'process'),'receiving',m.route) as route, m.processid
				FROM g_menus m
				where m.isdelete = 0
				and m.route <> '#'
				;
		";
		$query = $this->model->query($sql)->execute();
		$listMenu = array();
		foreach($query as $item){
			$listMenu[$item->id] = $item->route;
		}
		$params = json_decode($login['params'],true);
		$arr_params = array();
		foreach($params as $key=>$val){
			if(isset($listMenu[$key])){
				$arr_params[$listMenu[$key]] = $val;
			}
		}
		#end
		$login['userlogin'] = $userlogin;
		$login['params'] = $arr_params;
		$this->site->SetSession('glogin',$login);
	}
	public function getUserInprocess($processid){
		/*$listid = $this->getNextProcessList($processid);
		$arr = explode(',',$listid);
		$and = '';
		foreach($arr as $k=>$prsid){
			$and.= "or  ";
		}
		$ands = substr($and,2);
		*/
		if(empty($processid)){
			$processid = 0;
		}
		$sql = "
			SELECT u.processid, u.username, u.fullname
			FROM g_users u
			LEFT JOIN g_groups g on g.id = u.groupid
			where u.isdelete = 0
			and g.grouptype > 0
			and FIND_IN_SET($processid,u.processid)
		";
		return $this->model->query($sql)->execute();
	}
	public function getNextProcessList($processid){
		$tb = $this->loadTable();
		$sql = "
			SELECT pr.nextprocessid, p.processname
				FROM `".$tb['g_processdetail']."` pr
				LEFT JOIN `".$tb['g_process']."` p on p.processid = pr.nextprocessid
				where pr.isdelete = 0
				and pr.processnode = '$processid'
				and pr.isdelete = 0
				order by pr.datecreate asc 
				;
		";	
		return $this->model->query($sql)->execute();		
	}
	public function getAutocompletePart($part){
		$sql = "
			select id,partnumber ,concat(partnumber,' - ',description) as label, 1 as type,
			manufactureid, productid, description
			from `".$tb['g_partnumber']."` 
			where isdelete = 0
			and (partnumber like '%$part%' or description like '%$part%')
			order by partnumber asc
			limit 10
		";
		$query = $this->model->query($sql)->execute();		  
		if(count($query) == 0){
			$query = array();
			$info = new stdClass();
			$info->id = '';
			$info->label = 'Không tìm thấy linh kiện';
			$info->type = 0;
			$query[0] = $info;
		}
		return $query;
	}
	public function getCatalog(){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_catalog_part'])
                ->where('isdelete', 0)
				->order_by('catalog_name','ASC');
        $query = $query->find_all();
        return $query;
    }
	public function getBusiness($branchid) {
		$and = "";
		if(!empty($branchid)){
			$and = " and u.branchid = '$branchid'";
		}
		$sql = "
			select u.id, u.fullname
			from g_users u
			left join g_groups g on g.id = u.groupid
			where u.isdelete = 0
			$and
			and g.isdelete = 0
			and g.grouptype = 5
		";
        return $this->model->query($sql)->execute();
    }
	function getSuppliers(){
		$tb = $this->loadTable();
		$query = $this->model->table($tb['g_suppliers'])
                ->select('id,supplier_name')
                ->where('isdelete', 0);
        $query = $query->order_by('supplier_name','asc')->find_all();
        return $query;
	}
	public function curlDataAcountting($url,$string){
		$ch = curl_init();
		$header = array();
		$header[] = "Accept:text/html,application/xhtml+xml,application/json,application/xml;q=0.9,image/webp,*/*;q=0.8";
		$header[] = "Cache-Control:max-age=0";
		$header[] = "Host:getsupport.apple.com";
		$header[] = "Cookie: en-US";
		
		$header[] = "Content-Type: text/html; charset=UTF-8";
		$header[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36";
		
		curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER  ,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$string);
		$content = curl_exec($ch);
		$header_data= curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$arr = array();
		$arr['content'] = $content;
		$arr['header'] = $header_data;
		return $arr;
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
