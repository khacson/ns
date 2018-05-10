<?php

/**
 * @author binhit
 * @copyright 2009
 */

class config_model extends CI_Model
{
	function __construct()
	{
		parent::__construct('');
	}
    
    function insert(){
        echo 'config_model';
    }
	
	function Get($select='')
	{
		if(is_array($select)) 
        {
            $this->db->where_in('config_name',$select);
    		$query = $this->db->get('gce_configs');
    		if($query->num_rows()>0)
    		{
    			$config_lists=array();
    			foreach($query->result_array() as $item)
    			{
    				$config_lists[$item['config_name']]=$item['config_value'];
    			}
    			return $config_lists;
    		}
        }
        else
        {
            $this->db->where('config_name',$select);
    		$query = $this->db->get('configs');
            $query = $query->row_array();
            return $query['config_value'];
        }
		return false;
	}
	
	function Update($data)
	{
		if(!is_array($data))
		{
			return false;
		}
		foreach($data as $key=>$value)
		{
			$this->db->where('config_name',$key);
			$this->db->update('configs', array('config_value'=>$value));
		}
	}		
}
?>