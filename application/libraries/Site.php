<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author Leon
 * @copyright 2015
 */
include(BASEPATH . 'core/Template' . EXT);

class Site extends CI_Template {
    var $config;
    var $time_exit = 0;
    var $CI;
    var $lang = 'vn';
	var $sessionName = 'hrsalary';
    function __construct() {
        parent::__construct('public', 'default');
		$this->CI->load->model(array('langguage_model'));
        $this->set_master_template();
        $lang = $this->GetSession('langs');
		if(empty($lang)){
			$lang = 'vn';
		}
        $login = $this->GetSession('glogin'); 
        $route = $this->CI->router->class;
        $this->lang = $lang;
        $this->add_region('copyright');
        $this->add_region('lang');
		
        $this->config = array();
        $this->config['copyright'] = 'Son Nguyen';
        $this->config['sitename'] = 'hrsalary';
		$route = $this->CI->router->class; 
		if($route != 'authorize' && $route != 'service'){ 
			if(!isset($login['id'])){
				redirect(base_url().'authorize');	
			}
		}
        $this->write('copyright', $this->config['copyright'], true);
        $this->write('title_page', $this->config['sitename'], true);
        $this->write('lang', $lang, true);
    }
    function setTemplate($name) {
        $this->set_master_template($name);
    }
    function CreateCookie($cookie_name, $cookie_data, $cookie_time, $type = 'd') {
        switch ($type) {
            case 's':
                $time = $cookie_time;
                break;
            case 'm':
                $time = $cookie_time * 60;
                break;
            case 'h':
                $time = $cookie_time * 3600;
                break;
            case 'd':
                $time = $cookie_time * 86400;
                break;
            case 'w':
                $time = $cookie_time * 86400 * 7;
                break;
            case 'M':
                $time = $cookie_time * 2678400;
                break;
            default:
                $time = $cookie_time * 32140800;
        }

        $domain = $this->CI->config->item('cookie_domain');
        $path = $this->CI->config->item('cookie_path');
        setcookie('cookie_' . $cookie_name . '_' .$this->sessionName, $cookie_data, time() + $time, $path, $domain, 0);
    }
    function SetCookie($cookie_name, $cookie_data) {
        $_COOKIE['cookie_' . $cookie_name . '_' .$this->sessionName] = $cookie_data;
    }
    function NameCookie($cookie_name) {
        return 'cookie_' . $cookie_name . '_' .$this->sessionName;
    }
    function GetCookie($cookie_name) {
        return (isset($_COOKIE['cookie_' . $cookie_name . '_' .$this->sessionName]) ? $_COOKIE['cookie_' . $cookie_name . '_' .$this->sessionName] : "");
    }
    function DeleteCookie($cookie_name) {
        $domain = $this->CI->config->item('cookie_domain');
        $path = $this->CI->config->item('cookie_path');
        setcookie('cookie_' . $cookie_name . '_' .$this->sessionName, '', 0, $path, $domain, 0);
    }
    function SetSession($name, $value) {
        $this->CI->session->set_userdata($name . '_' .$this->sessionName, $value);
    }
    function SetFlashData($name, $value) {
        $this->CI->session->set_flashdata($name . '_' .$this->sessionName, $value);
    }
    function GetFlashData($name) {
        return $this->CI->session->flashdata($name . '_' .$this->sessionName);
    }
    function GetSession($name) {
        return $this->CI->session->userdata($name . '_' .$this->sessionName);
    }
    function DeleteSession($name) {
        return $this->CI->session->unset_userdata($name . '_' .$this->sessionName);
    }
    function friendlyURL($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/( |'|,|\||\.|\"|\?|\/|\%|–|!)/", '-', $str);
        $str = preg_replace("/(\()/", '-', $str);
        $str = preg_replace("/(\))/", '-', $str);
        $str = preg_replace("/(&)/", '-', $str);
		//$str = preg_replace("/(+)/", '-', $str);
		$str = preg_replace("/(----)/", '-', $str);
        $str = preg_replace("/(---)/", '-', $str);
        $str = preg_replace("/(--)/", '-', $str);
        return strtolower($str);
    }

    function pagination($count, $rows, $links, $task, $page = 0) {
        $CI = & get_instance();
        $config['base_url'] = base_url() . $task;
        $config['total_rows'] = $count;
        $config['per_page'] = $rows;
        $config['num_links'] = $links;

        $num_pages = (!empty($rows)) ? ceil($count / $rows) : 1;
        $cur_page = $page;
        $cur_page = (int) $cur_page;
        if (!is_numeric($cur_page)) {
            $cur_page = 0;
        }
        if ($cur_page > $count) {
            $cur_page = ($num_pages - 1) * $rows;
        }
        $cur_page = floor(($cur_page / $rows) + 1);

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = ''; //'<div class="limit">Trang thứ '.$cur_page.' / '.ceil($count/$rows).'</div></div>';

        $config['first_link'] = '&nbsp;';
        $config['prev_link'] = '&nbsp;';
        $config['next_link'] = '&nbsp;';
        $config['last_link'] = '&nbsp;';
        $CI->load->library('pagination');

        $CI->pagination->initialize($config);
        return $CI->pagination->create_links($page);
    }
	function createCapcha($name, $width = 100, $height = 35, $characters = 2){
        $font = BASEPATH .'fonts/courbd.ttf';
        $possible = '23456789abcdefghjkmnopqrstvwxyz';
        $text = '';
        $i = 0;
        while ($i < $characters) {
            $text .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
            $i++;
        }
		$this->DeleteSession($name);
		$this->SetSession($name,md5($text));
      
        $im = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($im, 255, 255, 255);
        $grey = imagecolorallocate($im, 128, 128, 128);
        $black = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 399, $height, $white);
        $noise_color = imagecolorallocate($im, 100,120, 180);
        $noise_color3 = imagecolorallocate($im, 0, 120, 180);
        $noise_color2 = imagecolorallocate($im, 100, 120, 180);
        for( $i=0; $i < ($width*$height)/3; $i++ ) {

            imagefilledellipse($im, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
        }

        /* generate random lines in background */
        for( $i=0; $i < ($width*$height)/150; $i++ ) {

            imageline($im, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color2);
            imageline($im, mt_rand(0,$width), mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$height), $noise_color3);
        }

        $item_space = ($width-3)/$characters;
        $max_font_size = 20;
        $min_font_size = 14;
        for ($i = 0; $i < $characters; $i++) {
            $x = ($i*$item_space)+5;
            $font_size = 	rand(
                $min_font_size,
                $max_font_size
            );
            $y = rand( ($height/2), $height-3);
            imagettftext($im, $font_size, 0, $x, $y, $grey, $font, $text[$i]);
            imagettftext($im, $font_size, 0, $x-1, $y-1, $black, $font, $text[$i]);

        }
        header('Content-type: image/png');

		imagejpeg($im);
        imagedestroy($im);
    }
}
function rand_pass($length) {
    $pool = '0123456789abcdefghijklmnopqrstuvwxyz';

    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
    }
    return $str;
}
function getUnique($length) {
    $pool = '0123456789';

    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
    }
    return $str;
}
function create_id($string, $length = 5, $prefix = '') {
    $id = $prefix;
    if ($string == "") {
        for ($i = 0; $i < ($length - 1); $i++)
            $id.='0';
        $id.='1';
    } else {
        $temp = ((int) substr($string, (abs(strlen($string) - $length)), strlen($string)) + 1);
        $n = $length - strlen($temp);
        $str = '';
        for ($i = 0; $i < $n; $i++) {
            $str.='0';
        }
        $id.=$str . $temp;
    }
    return $id;
}
function url_tmpl() {
    $site = new Site();
    return base_url() . $site->path;
}
function getLanguagePubic($key = "") {
    $site = new Site();
    $language = $site->GetSession('languagepublic');
    if (isset($language[$key])) {
        return $language[$key];
    }
	else {
        return $key;
    }
}
function fmDateSave($date){
	$date = preg_replace("/( )/", '-', $date);
	$date = preg_replace("/( |'|,|\||\.|\"|\?|\/|\%|–|!)/", '-', $date);
	return date('Y-m-d',strtotime($date));
}
function fmDateTimeSave($dates){
	$arrDate = explode(' ',$dates);
	$date = trim($arrDate[0]);
	$time = '';
	if(isset($arrDate[1])){
		$time = $arrDate[1];
	}
	$date = preg_replace("/( )/", '-', $date);
	$date = preg_replace("/( |'|,|\||\.|\"|\?|\/|\%|–|!)/", '-', $date);
	return date('Y-m-d',strtotime($date)).' '.$time;
}
function fmNumberSave($number){
	$number = preg_replace("/( |'|,|\||\|\"|\?|\/|\%|–|!)/", '', $number);
	$number = roundNumber($number);
	return $number;
}
function roundNumber($number){ //config
	$site = new Site();
	$config =  $site->GetSession('config');
	if(empty($number)){
		return 0;
	}
	if(isset($config->cfnumber)){
		return round($number,$config->cfnumber);
	}
	else{
		return round($number,2); //mac dinh làm tron 2 so	
	}
}
function fmNumber($number){
	if(empty($number)){
		return 0;
	}
	$cfnumber = 2;
	$number = round($number,$cfnumber);
	if(strpos($number,'.')){ //Số lẽ
		$number = number_format($number,$cfnumber);
	}
	else{
		$number = number_format($number);
	}
	return $number;
}
function configs($key=""){	
	$site = new Site();
	$config =  $site->GetSession('config');
	if(isset($config->$key)){
		return $config->$key;
	}
	else{
		return "";
	}
}
function getLanguage($key=""){
	$site = new Site();
	$language =  $site->GetSession('language');
	if(isset($language[$key])){
		return $language[$key];
	}
	else{
		return $key;
	}
}