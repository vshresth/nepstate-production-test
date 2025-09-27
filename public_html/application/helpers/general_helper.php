<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * function slug take a title|String and return URL|String
 *
 * @param {title|String}
 * @return {url|String}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function slug($title){

    $ci = &get_instance();

    $title = strtolower(trim($title));
    $title = preg_replace('/\s+/', ' ',  $title);
    $title = preg_replace("/[^A-Za-z0-9 ]/", '', $title );
    $title = str_replace(" ", '-', $title );
    $countter = 0;
    foreach($GLOBALS['PAGES_TABLES'] as $table){
        $result = $ci->db->query('
            SELECT *
            FROM '.$table.'
            WHERE slug LIKE "'.$title.'%"
          ');
        if($result->num_rows()>0)
            $countter = ($countter+$result->num_rows());
    }

    if($countter > 0)
        $slug = $title.'-'.($countter+1);
    else
        $slug = $title;

    return $slug;

}
function slug_input($title){

    $ci = &get_instance();

    $title = strtolower(trim($title));
    $title = preg_replace('/\s+/', ' ',  $title);
    $title = preg_replace("/[^A-Za-z0-9 ]/", '', $title );
    $title = str_replace(" ", '_', $title );
    $countter = 0;
    $slug = $title;
    return $slug;
}
/**
 * function auth authorizes the admin or redirects to login page.
 *
 * 
 * @return {authorized|Boolean}
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function auth(){
	
	$ci = &get_instance();

	
	
	$is_login = $ci->session->userdata('is_Login');
	
	if($is_login === true){
		
		$admin_id = $ci->session->userdata('admin_id');
		
		if($ci->session->userdata("type_vendor")==1){
			$admin_data = get_company_by_id($admin_id);
		}
		else{
		$admin_data = get_admin_by_id($admin_id);

		}

		
		if($admin_data->num_rows() == 0){
			
			$ci->session->sess_destroy();
			
			redirect(base_url()."admin/login");
			
		}else{
			
			return false;
			
		}
		
	}else{



		
		redirect(base_url()."admin/login");
		
		
	}
}

function vendor_id()
{
	$ci = &get_instance();

	
	
	$is_login = $ci->session->userdata('is_Login');
	
	if($is_login === true){
		
		$admin_id = $ci->session->userdata('admin_id');
		
		if($ci->session->userdata("type_vendor")==1){
			return $admin_id;
		}
		return 0;
	}
	return 0;
}
/**
 * function is_session checks if user is logged in and went to login page,
 * this function redirects user to dashboard itself.
 *
 * 
 * @return {authorized|Boolean}
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function is_session(){
	
	$ci = &get_instance();
	
	$is_login = $ci->session->userdata('is_Login');
	
	if($is_login === true){
		
		$admin_id = $ci->session->userdata('admin_id');
		// echo $admin_id."admin"; exit;

		if($ci->session->userdata("type_vendor")==1){
			$admin_data = get_company_by_id($admin_id);
		}
		else{
		$admin_data = get_admin_by_id($admin_id);

		}



		
		
		if($admin_data->num_rows() == 0){
			
			$ci->session->sess_destroy();
			
			redirect(base_url()."admin/login");
			
		}else{
			
			redirect('admin/dashboard');
			
		}
		
	}else{
		
		return true;
		
		
	}
}

if (!function_exists('format_number')) {
    function format_number($number) {
        if ($number >= 1000 && $number < 1000000) {
            return round($number / 1000, 1) . 'K';
        } elseif ($number >= 1000000 && $number < 1000000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000000000) {
            return round($number / 1000000000, 1) . 'B';
        } else {
            return $number;
        }
    }
}


function is_vendor()
{
	$ci = &get_instance();

	return $ci->session->userdata("type_vendor")==1;
}

/**
 * function get_admin_by_id provides admin object by ID
 *
 * @param {$id|int}
 * @return {authorized|Object}
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_admin_by_id($id){
	
	$ci = &get_instance();
	
	$result = $ci->db->query('
		SELECT *
		FROM admin
		WHERE id = '.$id.'
	');
	
	return $result;
	
}
/**
 * function get_admin_by_id provides admin object by ID
 *
 * @param {$id|int}
 * @return {authorized|Object}
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_company_by_id($id){
	
	$ci = &get_instance();
	
	$result = $ci->db->query('
		SELECT *
		FROM vendors
		WHERE id = '.$id.'
	');
	
	return $result;
	
}

/**
 * function settings provides global settings from settings table
 *
 * @return {settings|Object}
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function settings(){
	
	$ci = &get_instance();
	
	$result = $ci->db->query('
		SELECT *
		FROM settings
		WHERE id = 1
	');
	
	return $result->row();
}
/**
 * function get_field_value_by_id provides an object containing value for specific
 * field in specific table against specific id.
 *
 * @param {$field|String} name of field
 * @param {$table|String} name of table
 * @param {$id|int} id of row
 * 
 * @return {$value|Object}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_field_value_by_id($field,$table,$id){
	
	$ci = &get_instance();
	
	$result = $ci->db->query('
		SELECT '.$field.'
		FROM '.$table.'
		WHERE id = '.$id.'
	');
	
	$result = $result->row();
	
	return $result->$field;
}

/**
 * function get_dot_extension_comma_splited gets all extensions allowed in db and 
 * returns them as comma splited. This function also puts dot (.) as prefix.
 *
 * @return {$extensions|array}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_dot_extension_comma_splited(){

    $ci = &get_instance();

    $result = $ci->db->query('
		SELECT extension
		FROM attachment_type
		WHERE status = 1
		AND is_deleted = 0
	');
    $arr = array();
    foreach($result->result() as $ext){
        $arr[] = '.'.strtolower($ext->extension);
    }

    return implode(',',$arr);
	
}



/**
 * function get_extension_comma_splitted gets all extensions allowed in db and 
 * returns them as comma splited.
 *
 * @return {$extensions|array}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_extension_comma_splited(){

    $ci = &get_instance();

    $result = $ci->db->query('
		SELECT extension
		FROM attachment_type
		WHERE status = 1
		AND is_deleted = 0
	');
    $arr = array();
    foreach($result->result() as $ext){
        $arr[] = strtolower($ext->extension);
    }

    return implode(',',$arr);


}

/**
 * function get_extension_piped_splited gets all extensions allowed in db and 
 * returns them as pipe splited.
 *
 * @return {$extensions|array}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_extension_piped_splited(){

    $ci = &get_instance();

    $result = $ci->db->query('
		SELECT extension
		FROM attachment_type
		WHERE status = 1
		AND is_deleted = 0
	');
    $arr = array();
    foreach($result->result() as $ext){
        $arr[] = strtolower($ext->extension);
    }

    return implode('|',$arr);


}
/**
 * function get_extensions_by_extend takes a string name of an extension, checks
 * if this extension is allowed in db or not, returns the object got from db.
 *
 * @param {$ext|String}
 * @return {$result|Object}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_extensions_by_extend($ext){

    $ci = &get_instance();

    $result = $ci->db->query('
		SELECT *
		FROM attachment_type
		WHERE status = 1
		AND is_deleted = 0
		AND extension = "'.$ext.'"
	');
    return $result;
}
/**
 * function get_attachment_by_id takes id as int and returns the attachement from 
 * db as object
 *
 * @param {$id|int}
 * @return {$result|Object}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_attachment_by_id($id){

    $ci = &get_instance();

    $result = $ci->db->query('
		SELECT *
		FROM attachments
		WHERE is_deleted = 0
		AND id = "'.$id.'"
	');


    return $result;

}
/**
 * function message_status_upadte updates status of messages. `is_read` = 1
 * this function takes array of ids of messages in conversation_messages table
 *
 * @param {$ids|array}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function message_status_upadte($ids){
	
	$ci = &get_instance();
	$ci->db->query('UPDATE `conversation_messages` SET `is_read` = 1 WHERE id IN ('.implode(',',$ids).')');
}

/**
 * function get_message_attachments takes ids of messages and returns objects 
 * of message attachements
 *
 * @param {$ids|array}
 * @return {$attachments|Object}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_message_attachments($ids){
    $ci = &get_instance();

    $result = $ci->db->query('
		SELECT i.*,t.icon
		FROM attachments i
		LEFT JOIN attachment_type t
		ON i.attachment_type_id = t.id
		WHERE i.is_deleted = 0
		AND i.raw_file = 0
		AND i.id IN ('.$ids.')
	');


    return $result;
}

/**
 * function time_elapsed_string_header takes date time in Y-m-d H:i:s format and 
 * return the string containing information of AGO format.
 *
 * @example time_elapsed_string_header("2019-01-16 00:00:00", false)
 * => "12 hours ago"
 *
 * @param {$datetime|string}
 * @param {$full|boolean}
 * @return {$friendly_format|String}
 * 
 * @since 1.0
 * @author Unknown
 */
function time_elapsed_string_header($datetime, $full = false) {


    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
/**
 * function check_role take the role in integer and checks if role is in user's
 * sessions or user is super admin
 *
 * @param {$role|number}
 * @return {$result|boolean}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function count_listing($table,$trash_only=false)
{
    $ti = &get_instance();
    return $ti->db->count_all_results($table);
}
function check_role($role)
{
    $ti = &get_instance();
    // print_r($ti->session->userdata('admin_roles'));exit;
    
    if(in_array($role,$ti->session->userdata('admin_roles')))
        return true;

    if(in_array(-1,$ti->session->userdata('admin_roles'))) return true;
    return false;
}

function is_admin()
{
	 $ti = &get_instance();
    // print_r($ti->session->userdata('admin_roles'));exit;
    
    if(in_array(-1,$ti->session->userdata('admin_roles')))
        return true;
    return false;
}

/**
 * function get_role_name returns the role name of give role number
 *
 * @param {$role|number}
 * @return {$result|string}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_role_name($role)
{
    $roles = get_all_roles();
    foreach ($roles as $key => $value) {
        # code...
        if($key==$role)
            return $value;
    }
}
/**
 * function get_all_roles returns array of all available roles in the system
 *
 * @return {$result|array}
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
function get_all_roles($region_only=false)
{

    return $arr = array(
        '-1'=>'Super Admin',
        '103'=>'Messages',
        '2'=>'Settings',
        '3'=>'Admins',
        '13'=>'Patients',
        '19'=> 'Providers',
        '104'=> 'Care Teams',
        '18'=> 'Subscription Plans',
        '99'=> 'Program'
    );
}
function guid()
{
    if (function_exists('com_create_guid') === true)
        return trim(com_create_guid(), '{}');

    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function user_info()
{
	$ti = &get_instance();
    if(isset($_SESSION['LISTYLOGIN'])){
        $user_id = $_SESSION['LISTYLOGIN']->id;
    }else {
        $user_id = 0;
    }
	$user = $ti->db->query("SELECT * FROM users WHERE id = ".$user_id)->result_object()[0];
	return $user;
}

// function rating_count($id,$star)
// {
//     $ti = &get_instance();
//     $count = $ti->db->query("SELECT * FROM rating WHERE psychic_id = ".$id." AND stars = ".$star)->num_rows();
//     return $count;
// }


function events(){

	$form = array(
					array(
							"title"=> "Event Title",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Event Organizer",
							"type" => "heading",
							"required" => "",
							"single" => 1,
						),
					array(
							"title"=> "Organizer Name",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Contact Number",
							"type" => "phone",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Email",
							"type" => "email",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Event Artist name",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Event Style",
							"type" => "select",
							"required" => "required",
							"single" => 0,
							"values" => "Venue,Live Streaming,To be announced",
						),
					array(
							"title"=> "Venue address",
							"type" => "text",
							"required" => "required",
							"single" => 0,
							"google" => 1
						),
					array(
							"title"=> "Venue Name",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Address",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "City",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "State",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Zip/Postal",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Country",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Event Date and time",
							"type" => "date-time",
							"required" => "required",
							"single" => 0,
						),
					array(
							"title"=> "Venue Name",
							"type" => "text",
							"required" => "required",
							"single" => 0,
						),
				);
}


function benefits_jobs(){
	$array_benefits = array("401 K plan", "Insurance: dental, Vision, Health", "Life insurance", "PTO", "Retirement Plan", "Performance Bonus", "Child care benefits", "Others");
	return $array_benefits;
}

function do_get_review_count($type, $pro_id){
	$ti = &get_instance();

	return $ti->db->query("SELECT * FROM order_reviews WHERE order_id = ".$pro_id." AND rating = ".$type)->num_rows();
}

function user_ip_check(){
	$ti = &get_instance();
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $user_ip = $_SERVER['REMOTE_ADDR'];
		}
		$check_ip =  $ti->db->query("SELECT * FROM user_ip WHERE user_ip = '".$user_ip."' ORDER BY id DESC LIMIT 1")->result_object()[0];
		return $check_ip;
}

if (!function_exists('userCountryId')) {
    function userCountryId() {
        if (isset($_COOKIE['user_country_id'])) {
            return $_COOKIE['user_country_id'];
        } else {
            return false;
        }
    }
}


if (!function_exists('userCityId')) {
    function userCityId() {
		if (isset($_COOKIE['user_city_id'])) {
            return $_COOKIE['user_city_id'];
        } else {
            return false;
        }
    }
}


if (!function_exists('userSelectOrNotCountry')) {
    function userSelectOrNotCountry() {
		if (isset($_COOKIE['userSelectCountryOrNor'])) {
            return $_COOKIE['userSelectCountryOrNor'];
        } else {
            return false;
        }
    }
}



if (!function_exists('getCountryNameById')) {

    function getCountryNameById($id) {
		$ti = &get_instance();
	
		return $ti->db->where('id', $id)->get('admin_countries')->row()->title;
    }
}


    

if (!function_exists('getCountryCodeById')) {

    function getCountryCodeById($id) {
		$ti = &get_instance();
	
		return $ti->db->where('id', $id)->get('admin_countries')->row()->code;
    }
}


if (!function_exists('getCountryInfo')) {

    function getCountryInfo() {
		$ti = &get_instance();
	
		return $ti->db->where('id', userCountryId())->get('admin_countries')->row();
    }
}



if (!function_exists('p')) {

    function p($array) {
	
		echo "<pre>";
		print_r($array);
		die;
    }
}




if (!function_exists('break_convert_to_array')) {

    function break_convert_to_array($paragraph) {
		return array_filter(array_map('trim', explode('<br />', trim($paragraph))));

    }
}



if (!function_exists('notificationContent')) {

    function notificationContent($key) {
		
		$contentArr = [
			'new-signup' => 'New Signup by user',
			'add-new-blog' => 'Request for blog approval',
			'add-new-confession' => 'Create New Confession by user',
			'add-new-forum' => 'Create New Forum by user',
			'add-new-event' => 'Create New Events by user',
			'add-new-service' => 'Create New Services by user',
			'add-new-job' => 'Create New Job by user',
			'add-new-it-training' => 'Create New it-trainings by user',
			'add-new-roomates-rental' => 'Create New roomates-rentals by user',
			'create-ad-for-home-banner' => 'Create New create-ad-for-home-banner by user',
			'create-ad-for-home-middle' => 'Create New create-ad-for-home-middle by user',
			'create-ad-for-right-banner' => 'Create New create-ad-for-right-banner by user',
			'create-ad-for-home-category-section' => 'Create New create-ad-for-home-category-section by user',
			'create-ad-for-home-category-page' => 'Create New create-ad-for-home-category-page by user',
			'create-ad-for-blog' => 'Create New create-ad-for-blog by user',
			'create-ad-for-forum' => 'Create New create-ad-for-forum by user',
			'create-ad-for-confession' => 'Create New create-ad-for-confession by user',
			'comment-on-blog' => 'comment ON Blog by user',
			'comment-on-forums' => 'comment ON Forums by user',
			'comment-on-confession' => 'comment ON Confession by user',
			'like-remove-on-blog' => 'like-remove-on-blog',
			'like-on-blog' => 'like--on blog by user',
			'dislike-on-blog' => 'dislike-on blog by user',
			'dislike-remove-on-blog' => 'dislike-remove-on blog by user',
			'like-remove-on-forum' => 'like-remove-on-forum by user',
			'like-remove-on-confession' => 'like-remove-on-confession by user',
			'like-on-forum' => 'like-on-forum by user',
			'like-on-confession' => 'like-on-confession by user',
			'remove-dislike-on-forum' => 'remove-dislike-on-forum',
			'dislike-on-forum' => 'dislike-on-forum',
			'dislike-remove-on-confession' => 'dislike-remove-on-confession',
			'dislike-on-confession' => 'dislike-on-confession',
			'review-on-classified' => 'review-on-classified',

		];


		return  $contentArr[$key];

		

    }
}