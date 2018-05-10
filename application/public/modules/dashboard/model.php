<?php
/**
 * @author sonnk
 * @copyright 2016
 */
class DashboardModel extends CI_Model
{
	function __construct(){
		parent::__construct('');
	}
	function findID($id) {
		$tb = $this->base_model->loadTable();
        $query = $this->model->table($tb['g_manufacture'])
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function totalProcess($fromdate,$todate){
		$tb = $this->base_model->loadTable();
		$login = $this->login;
		$processid = $login['processid']; 
		$grouptype = $login['grouptype']; 
		$and = '';
		if(!empty($fromdate)){
			$and.= " and if(pd.statusacept = 1, pd.dateaccept, pd.datecreate) >= '".fmDateSave($fromdate)." 00:00:00' ";
		}
		if(!empty($todate)){
			$and.= " and if(pd.statusacept = 1, pd.dateaccept, pd.datecreate) <= '".fmDateSave($todate)." 23:59:59' ";
		}
		$sql = "
			SELECT count(1) total, 
			if(pd.statusacept = 1, pd.nextprocessid, pd.processid) as processid, pr.processname
			FROM `".$tb['g_phonedetail']."` pd
			LEFT JOIN `".$tb['g_phone']."` p on p.id = pd.phoneid
			LEFT JOIN `".$tb['g_process']."` pr on pr.processid = if(pd.statusacept = 1, pd.nextprocessid, pd.processid)
			WHERE pd.isdelete = 0
			AND pd.isnew = 1
			$and
			AND p.isdelete = 0
			group by if(pd.statusacept = 1, pd.nextprocessid, pd.processid)
			
		";
		$query = $this->model->query($sql)->execute();
		return $query;
	}
}