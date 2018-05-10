 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author sonnk
 * @copyright 2016
 */

class Employeesexpired extends CI_Controller {
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
		$sheetIndex->setCellValueByColumnAndRow(1, 1, getLanguage('bo-phan'));
		$sheetIndex->setCellValueByColumnAndRow(2, 1, getLanguage('ma-nhan-vien'));
		$sheetIndex->setCellValueByColumnAndRow(2, 1, getLanguage('ho-ten'));
		$sheetIndex->setCellValueByColumnAndRow(4, 1, getLanguage('cmnd'));
		$sheetIndex->setCellValueByColumnAndRow(5, 1, getLanguage('ngay-cap'));
		$sheetIndex->setCellValueByColumnAndRow(6, 1, getLanguage('noi-cap'));
		$sheetIndex->setCellValueByColumnAndRow(7, 1, getLanguage('tk-ngan-hang'));
		$sheetIndex->setCellValueByColumnAndRow(8, 1, getLanguage('ngan-hang'));
		$sheetIndex->setCellValueByColumnAndRow(9, 1, getLanguage('ma-so-thue'));
		$sheetIndex->setCellValueByColumnAndRow(10, 1, getLanguage('chu-vu'));

		$query = $this->model->getList($searchs, 0, 0, true);
		//tinh thanh
		$provinces = $this->base_model->getProvince();
		$arrProvinces = array();
		foreach($provinces as $item){
			$arrProvinces[$item->id] = $item->province_name;
		}
		$i=2;
		foreach($query as $item){
			$identityfrom = '';
			if(!empty($arrProvinces[$item->identity_from])){
				$identityfrom = $arrProvinces[$item->identity_from];
			}
			
			
			$sheetIndex->setCellValueByColumnAndRow(0, $i, ($i-1));
			$sheetIndex->setCellValueByColumnAndRow(1, $i, $item->departmanet_name);
			$sheetIndex->setCellValueByColumnAndRow(2, $i, $item->code);
			$sheetIndex->setCellValueByColumnAndRow(3, $i, $item->fullname);
			$sheetIndex->setCellValueByColumnAndRow(4, $i, $item->identity);
			$sheetIndex->setCellValueByColumnAndRow(5, $i, date(configs('cfdate',strtotime($item->identity_date))));
			$sheetIndex->setCellValueByColumnAndRow(6, $i, $identityfrom);
			$sheetIndex->setCellValueByColumnAndRow(7, $i, $item->bank_accout);
			$sheetIndex->setCellValueByColumnAndRow(8, $i, $item->bank_name);
			$sheetIndex->setCellValueByColumnAndRow(9, $i, $item->tax_code);
			$sheetIndex->setCellValueByColumnAndRow(10, $i, $item->position_name);
			
			$i++;
		}
		$today = gmdate("ymdHis", time() + 7 * 3600);;
        $name = "Birthday_".$today.".xlsx";
        $boderthin = "A1:K" .($i-1);
        $sheetIndex->getStyle($boderthin)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel_model->exportExcel($objPHPExcel, $versionExcel, $name);
	}
}