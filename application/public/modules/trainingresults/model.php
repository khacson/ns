<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class TrainingresultsModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function getCatalog() {
        $query = $this->model->table('hre_trainingcourse')
					  ->select('id,trainingcourse_name')
					  ->where('isdelete',0)
					  ->order_by('datecreate','desc')
					  ->find_all();
        return $query;
    }
	function findID($id) {
		
        $query = $this->model->table('hre_trainingresults')
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
		if(!empty($search['result_status'])){
			$sql.= " and e.result_status like '%".$search['result_status']."%' ";	
		}
		if(!empty($search['description'])){
			$sql.= " and e.description like '%".$search['description']."%' ";	
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
		if(!empty($search['date_finish'])){
			$sql.= " and tr.date_finish = '".fmDateSave($search['date_finish'])."' ";
		}
		if(!empty($search['catalogid'])){
			$sql.= " and tn.catalogid in (".$search['catalogid'].") ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		
		$searchs = $this->getSearch($search);
		$sql = " SELECT tn.*, e.code,e.identity , e.fullname, d.departmanet_name, e.departmentid, ct.trainingcourse_name
				FROM `hre_trainingresults` AS tn
				left join hre_trainingcourse ct on ct.id = tn.catalogid
				left join hre_employee e on e.id = tn.employeeid
				left join hre_department d on d.id = e.departmentid
				WHERE tn.isdelete = 0
				$searchs
				and ct.isdelete = 0
				";
		if(empty($search['order'])){
			$sql .= " ORDER BY tn.datecreate ASC  ";
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
			FROM `hre_trainingresults` AS tn
			left join hre_trainingcourse ct on ct.id = tn.catalogid
			left join hre_employee e on e.id = tn.employeeid
			left join hre_department d on d.id = e.departmentid
			WHERE tn.isdelete = 0
			$searchs	
			and ct.isdelete = 0
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$id){
		$items = $this->model->table('hre_employee')->select('id,departmentid,branchid')
								 ->where('id',$array['employeeid'])
								 ->where('isdelete',0)
								 ->find();
		$array['branchid'] =  $items->branchid;	
		$array['departmentid'] =  $items->departmentid;	
		//Check exit
		$check = $this->model->table('hre_trainingresults')
					  ->select('id')
					  ->where('employeeid',$array['employeeid'])
					  ->where('catalogid',$array['catalogid'])
					  ->find();
		if(!empty($check->id)){
			return -1;
		}
		$array['date_finish'] =  fmDateSave($array['date_finish']); 
		$result = $this->model->table('hre_trainingresults')->insert($array);	
		return $result;
	}
	function edits($array,$id){
		$items = $this->model->table('hre_employee')->select('id,departmentid,branchid')
								 ->where('id',$array['employeeid'])
								 ->where('isdelete',0)
								 ->find();
		$array['branchid'] =  $items->branchid;	
		$array['departmentid'] =  $items->departmentid;	
		//Check exit
		$check = $this->model->table('hre_trainingresults')
					  ->select('id')
					  ->where('employeeid',$array['employeeid'])
					  ->where('catalogid',$array['catalogid'])
					  ->where('id <>',$id)
					  ->find();
		if(!empty($check->id)){
			return -1;
		}
		$array['date_finish'] =  fmDateSave($array['date_finish']); 
		$this->model->table('hre_trainingresults')
					->where('id',$id)
					->update($array);	
		return $id;
		
	}
	function deletes($id,$array){
		$this->model->table('hre_trainingresults')
					->where("id in ($id)")
					->delete();
		return 1;
	}
}