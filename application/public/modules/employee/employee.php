 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2016
 */

class Employee extends CI_Controller {
	var $login;
    function __construct() {
        parent::__construct();
        $this->load->model(array('login_model','base_model','excel_model'));
		$this->login = $this->site->getSession('glogin');
		$this->route = $this->router->class;
    }
    function _remap($method, $params = array()) {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }
        $this->_view();
    }
    function _view() {
		$data = new stdClass();
        $login = $this->login;
        if (!isset($login['id'])){
			redirect(base_url());
		}
		$permission = $this->base_model->getPermission($this->login, $this->route);
        if(!isset($permission['view'])) {
            redirect('authorize');
        }
		$data->permission = $permission;
        $data->routes = $this->route; 
       
	    $data->departments = $this->base_model->getDepartment($login['departmentid']);
		$data->positions = $this->base_model->getPosition('');
		$data->jobstatus = $this->base_model->getJobStatus('');
		$data->academics = $this->base_model->getAcademic('');
		$data->ethnics = $this->base_model->getEthnic('');	
		$data->religions = $this->base_model->getReligion(''); 
		$data->provinces = $this->base_model->getProvice();
		$data->departmentGroups = $this->base_model->getDepartmentGroup($login['departmentid']);
		#gegion add log
		$ctrol = getLanguage('nhan-vien');
		$func =  getLanguage('xem');
		$this->base_model->addAcction($ctrol,$func,'','');
		#end	
        $content = $this->load->view('view', $data, true);
        $this->site->write('content', $content, true);
        $this->site->render();
    }
	function form(){
		$login = $this->login;
		$id = $this->input->post('id');
		$find = $this->model->findID($id);
		if(empty($find->id)){
			$find = $this->base_model->getColumns('hre_ethnic');
		}
		$data = new stdClass();
        $result = new stdClass();
		$data->finds = $find;  
		if(empty($id)){
			$result->title = getLanguage('them-moi');
		}
		else{
			$result->title = getLanguage('sua');
		}
		$data->branchid = $login['branchid'];
        $result->content = $this->load->view('form', $data, true);
		$result->id = $id;
        echo json_encode($result);
	}
    function getList() {
        $permission = $this->base_model->getPermission($this->login, $this->route);
        if (!isset($permission['view'])) {
            //redirect('authorize');
        }
        $rows = 20; //$this->site->config['row'];
        $page = $this->input->post('page');
        $pageStart = $page * $rows;
        $rowEnd = ($page + 1) * $rows;
        $start = empty($page) ? 1 : $page + 1;
		$searchs = json_decode($this->input->post('search'), true);
		$index = $this->input->post('index');
        $order = $this->input->post('order');
		if(!empty($order)) {
            $order = str_replace('ord_', '', $order);
        }
		$searchs['index'] = $index;
        $searchs['order'] = $order;
	    
        $data = new stdClass();
        $result = new stdClass();
        $query = $this->model->getList($searchs, $page, $rows);
        $count = $this->model->getTotal($searchs);
        $data->datas = $query;
        $data->start = $start;
        $data->permission = $this->base_model->getPermission($this->login, $this->route);
        $page_view = $this->site->pagination($count, $rows, 5, $this->route, $page);
		if($count <= $rows){
			$page_view = '';
		}
		//Dan toc
		$ethnics = $this->base_model->getEthnic('');	
		$arrEthnics = array();
		foreach($ethnics as $item){
			$arrEthnics[$item->id] = $item->ethnic_name;
		}
		$data->arrEthnics = $arrEthnics;
		//Ton giao
		$religions = $this->base_model->getReligion('');	
		$arrReligions = array();
		foreach($religions as $item){
			$arrReligions[$item->id] = $item->religion_name;
		}
		$data->arrReligions = $arrReligions;
		//tinh thanh
		$provinces = $this->base_model->getProvince();
		$arrProvince = array();
		foreach($provinces as $item){
			$arrProvince[$item->id] = $item->province_name;
		}
		$data->arrProvinces = $arrProvince;
		//
		$academics = $this->base_model->getAcademic('');
		$arrAcademics = array();
		foreach($academics as $item){
			$arrAcademics[$item->id] = $item->academic_name;
		}
		$data->arrAcademics = $arrAcademics;
		//status_name
		$jobstatus = $this->base_model->getJobStatus('');
		$arrJobstatus = array();
		foreach($jobstatus as $item){
			$arrJobstatus[$item->id] = $item->status_name;
		}
		$data->arrJobstatus = $arrJobstatus;
		
        $result->paging = $page_view;
        $result->csrfHash = $this->security->get_csrf_hash();
        $result->viewtotal = $count;
        $result->content = $this->load->view('list', $data, true);
        echo json_encode($result);
    }
    function deletes() {
		$token =  $this->security->get_csrf_hash();
		$permission = $this->base_model->getPermission($this->login, $this->route);
		if (!isset($permission['delete'])){
			$result['status'] = 0;
			$result['csrfHash'] = $token;
			echo json_encode($result); exit;	
		}
		$id = $this->input->post('id');//print_r($id);exit;
		$login = $this->login;
		$array['dateupdate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['isdelete'] = 1;
		$array['userupdate'] = $this->login->username;
		
		$this->model->table('hr_staff')->save($id, $array);	
		$this->base_model->addAcction($this->route,$this->uri->segment(2));
		$result['status'] = 1;	
		$result['csrfHash'] = $token;
		echo json_encode($result);
	}
	function export(){
		$search = '{}';
		if(isset($_GET['search'])){
			$search = $_GET['search'];
		}
		$searchs = json_decode($search,true);
		include(APPPATH . 'libraries/excel2013/PHPExcel/IOFactory' . EXT);
		
		$versionExcel = 'Excel2007';
		$objPHPExcel = new PHPExcel();
		$sheetIndex = $objPHPExcel->setActiveSheetIndex(0);
		$sheetIndex->setTitle('danh sach nhan vien');
		
		$sheetIndex->setCellValueByColumnAndRow(0, 1, getLanguage('stt'));
		$sheetIndex->setCellValueByColumnAndRow(1, 1, getLanguage('ma-nhan-vien'));
		$sheetIndex->setCellValueByColumnAndRow(2, 1, getLanguage('ho-ten'));
		$sheetIndex->setCellValueByColumnAndRow(3, 1, getLanguage('gioi-tinh'));
		$sheetIndex->setCellValueByColumnAndRow(4, 1, getLanguage('ngay-sinh'));
		$sheetIndex->setCellValueByColumnAndRow(5, 1, getLanguage('noi-sinh'));
		$sheetIndex->setCellValueByColumnAndRow(6, 1, getLanguage('hon-nhan'));
		$sheetIndex->setCellValueByColumnAndRow(7, 1, getLanguage('quoc-tich'));
		$sheetIndex->setCellValueByColumnAndRow(8, 1, getLanguage('dan-toc'));
		$sheetIndex->setCellValueByColumnAndRow(9, 1, getLanguage('ton-giao'));
		$sheetIndex->setCellValueByColumnAndRow(10, 1, getLanguage('cmnd'));
		$sheetIndex->setCellValueByColumnAndRow(11, 1, getLanguage('ngay-cap'));
		$sheetIndex->setCellValueByColumnAndRow(12, 1, getLanguage('noi-cap'));
		$sheetIndex->setCellValueByColumnAndRow(13, 1, getLanguage('trinh-do-hoc-van'));
		$sheetIndex->setCellValueByColumnAndRow(14, 1, getLanguage('trinh-do-chuyen-mon'));
		$sheetIndex->setCellValueByColumnAndRow(15, 1, getLanguage('phong-ban'));
		$sheetIndex->setCellValueByColumnAndRow(16, 1, getLanguage('chu-vu'));
		$sheetIndex->setCellValueByColumnAndRow(17, 1, getLanguage('ngay-bat-dau'));
		$sheetIndex->setCellValueByColumnAndRow(18, 1, getLanguage('ngay-ky-hop-dong'));
		$sheetIndex->setCellValueByColumnAndRow(19, 1, getLanguage('ma-hop-dong'));
		$sheetIndex->setCellValueByColumnAndRow(20, 1, getLanguage('ngay-het-han'));
		$sheetIndex->setCellValueByColumnAndRow(21, 1, getLanguage('ma-so-bao-hiem'));
		$sheetIndex->setCellValueByColumnAndRow(22, 1, getLanguage('benh-vien-dang-ky'));
		$sheetIndex->setCellValueByColumnAndRow(23, 1, getLanguage('ma-so-thue'));
		$sheetIndex->setCellValueByColumnAndRow(24, 1, getLanguage('tk-ngan-hang'));
		$sheetIndex->setCellValueByColumnAndRow(25, 1, getLanguage('ngan-hang'));
		$sheetIndex->setCellValueByColumnAndRow(26, 1, getLanguage('tinh-trang-cong-viec'));
		$sheetIndex->setCellValueByColumnAndRow(27, 1, getLanguage('ten-nguoi-than'));
		$sheetIndex->setCellValueByColumnAndRow(28, 1, getLanguage('dien-thoai'));
		$sheetIndex->setCellValueByColumnAndRow(29, 1, getLanguage('quan-he'));

		$query = $this->model->getList($searchs, 0, 0, true);
		//Dan toc
		$ethnics = $this->base_model->getEthnic('');	
		$arrEthnics = array();
		foreach($ethnics as $item){
			$arrEthnics[$item->id] = $item->ethnic_name;
		}
		//Ton giao
		$religions = $this->base_model->getReligion('');	
		$arrReligions = array();
		foreach($religions as $item){
			$arrReligions[$item->id] = $item->religion_name;
		}
		//tinh thanh
		$provinces = $this->base_model->getProvince();
		$arrProvinces = array();
		foreach($provinces as $item){
			$arrProvinces[$item->id] = $item->province_name;
		}
		//
		$academics = $this->base_model->getAcademic('');
		$arrAcademics = array();
		foreach($academics as $item){
			$arrAcademics[$item->id] = $item->academic_name;
		}
		//status_name
		$jobstatus = $this->base_model->getJobStatus('');
		$arrJobstatus = array();
		foreach($jobstatus as $item){
			$arrJobstatus[$item->id] = $item->status_name;
		}

		$i=2;
		foreach($query as $item){
			if($item->sex == 1){
				$sex = 'Nam';
			}
			else if($item->sex == 2){
				$sex = 'Nữ';
			}
			else if($item->sex == -1){
				$sex = 'Giới tính khác';
			}
			else{
				$sex = '';
			}
			$marriage = '';
			if($item->marriage == 1){
				$marriage = 'Đã có gia đình';
			}
			else if($item->sex == 2){
				$marriage = 'Độc thân';
			}
			else if($item->marriage == -1){
				$marriage = 'Khác';
			}
			$birthday = '';
			if(!empty($item->birthday) && $item->birthday != '0000-00-00'){
				$birthday = date(configs('cfdate',strtotime($item->birthday)));
			}
			$nationality = '';
			if($item->nationality == 1){
				$nationality = 'Việt Nam';
			}
			elseif($item->nationality == -1){
				$nationality = 'Khác';
			}
			$ethnics = '';
			if(!empty($arrEthnics[$item->ethnicid])){
				$ethnics = $arrEthnics[$item->ethnicid];
			}
			//
			$religions = '';
			if(!empty($arrReligions[$item->religionid])){
				$religions = $arrReligions[$item->religionid];
			}
			$identityfrom = '';
			if(!empty($arrProvinces[$item->identity_from])){
				$identityfrom = $arrProvinces[$item->identity_from];
			}
			//arrAcademics
			$academiclevel = '';
			if(!empty($arrAcademics[$item->academic_level])){
				$academiclevel = $arrAcademics[$item->academic_level];
			}
			//arrJobstatus jobstatusid
			$jobstatus = '';
			if(!empty($arrJobstatus[$item->jobstatusid])){
				$jobstatus = $arrJobstatus[$item->jobstatusid];
			}
	
			
			$sheetIndex->setCellValueByColumnAndRow(0, $i, ($i-1));
			$sheetIndex->setCellValueByColumnAndRow(1, $i, $item->code);
			$sheetIndex->setCellValueByColumnAndRow(2, $i, $item->fullname);
			$sheetIndex->setCellValueByColumnAndRow(3, $i, $sex);
			$sheetIndex->setCellValueByColumnAndRow(4, $i,$birthday);
			$sheetIndex->setCellValueByColumnAndRow(5, $i, $item->place_of_birth);
			$sheetIndex->setCellValueByColumnAndRow(6, $i, $marriage);
			$sheetIndex->setCellValueByColumnAndRow(7, $i,$nationality);
			$sheetIndex->setCellValueByColumnAndRow(8, $i, $ethnics);
			$sheetIndex->setCellValueByColumnAndRow(9, $i, $religions);
			$sheetIndex->setCellValueByColumnAndRow(10, $i, $item->identity);
			$sheetIndex->setCellValueByColumnAndRow(11, $i, date(configs('cfdate',strtotime($item->identity_date))));
			$sheetIndex->setCellValueByColumnAndRow(12, $i, $identityfrom);
			$sheetIndex->setCellValueByColumnAndRow(13, $i, $academiclevel);
			$sheetIndex->setCellValueByColumnAndRow(14, $i, $item->academic_skills);
			$sheetIndex->setCellValueByColumnAndRow(15, $i, $item->departmentgroup_name);
			$sheetIndex->setCellValueByColumnAndRow(16, $i, $item->position_name);
			$sheetIndex->setCellValueByColumnAndRow(17, $i, date(configs('cfdate',strtotime($item->date_start))));
			$sheetIndex->setCellValueByColumnAndRow(18, $i, date(configs('cfdate',strtotime($item->contrac_date))));
			$sheetIndex->setCellValueByColumnAndRow(19, $i, $item->contrac_code);
			$sheetIndex->setCellValueByColumnAndRow(20, $i, date(configs('cfdate',strtotime($item->contac_expired_date))));
			$sheetIndex->setCellValueByColumnAndRow(21, $i, $item->insurance_code);
			$sheetIndex->setCellValueByColumnAndRow(22, $i, $item->insurance_hospital);
			$sheetIndex->setCellValueByColumnAndRow(23, $i, $item->tax_code);
			$sheetIndex->setCellValueByColumnAndRow(24, $i, $item->bank_accout);
			$sheetIndex->setCellValueByColumnAndRow(25, $i, $item->bank_name);
			$sheetIndex->setCellValueByColumnAndRow(26, $i, $jobstatus);
			$sheetIndex->setCellValueByColumnAndRow(27, $i, $item->family_name);
			$sheetIndex->setCellValueByColumnAndRow(28, $i, $item->family_phone);
			$sheetIndex->setCellValueByColumnAndRow(29, $i, $item->family_relation);
			
			$i++;
		}
		$today = gmdate("ymdHis", time() + 7 * 3600);;
        $name = "Birthday_".$today.".xlsx";
        $boderthin = "A1:AD" .($i-1);
        $sheetIndex->getStyle($boderthin)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel_model->exportExcel($objPHPExcel, $versionExcel, $name);
	}
}