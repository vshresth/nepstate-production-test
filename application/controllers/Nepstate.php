<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Stripe\Stripe;
use Stripe\Checkout\Session;
class Nepstate extends ADMIN_Controller {
	

	function __construct()
	{
		
		parent::__construct();
		error_reporting(1);
		
		$this->load->library('form_validation');
		$this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        $this->db->reconnect();
        $this->data['uploads'] = base_url()."resources/uploads/";
		$this->data['assets'] = base_url()."resources/frontend/";	
		$this->data['settings'] = settings();
		$this->data['title'] = settings()->site_title;
		$this->data['sub_heading'] = settings()->site_sub;
		$this->data['show_header'] = 1;
		$this->data['page_url'] = "about-us";
		$this->data['classified_BASE_URL'] = base_url()."resources/uploads/classified-listing/";
		


		$checkVisitor = $this->db->where('ip_address', $_SERVER['REMOTE_ADDR'])->get('visitors')->num_rows();

		if($checkVisitor == 0) {

			$this->db->insert('visitors',['ip_address' => $_SERVER['REMOTE_ADDR']]);

		}	

		// CHECK SUBSCRIPTION
		// $page = $this->uri->segment(1);
		// $page2 = $this->uri->segment(2);

		if(isset($_SESSION['LISTYLOGIN'])){
			$userId = user_info()->id;
			$checkUserIsExist = $this->db->where('id', $userId)->get('users')->row();

			if(empty($checkUserIsExist)) {
				session_destroy();
				redirect(base_url());
			}
		}


	// Check if this is a Google crawler (don't redirect crawlers)
	$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
	$isGoogleBot = stripos($userAgent, 'googlebot') !== false || 
				   stripos($userAgent, 'google') !== false ||
				   stripos($userAgent, 'bingbot') !== false ||
				   stripos($userAgent, 'crawler') !== false;

	if(!isset($_COOKIE['user_country_id'])  && !isset($_COOKIE['user_city_id']) && !$isGoogleBot) {
		if ($this->uri->segment(1) !== 'country-selection' && $this->uri->segment(1) !== 'update-user-country') {
			
			// redirect(base_url().'update-user-country/1');

			$currentUrl = current_url();
			$queryString = $_SERVER['QUERY_STRING'];
			if (!empty($queryString)) {
				$currentUrl .= '?' . $queryString;
			}

			// Redirect with return URL
			redirect(base_url() . 'update-user-country/1?redirect=' . urlencode($currentUrl));
			
		}
		
	}

				

		if(isset($_COOKIE['user_country_id']) && isset($_COOKIE['user_city_id'])) {
			
			// $this->data['country_city_ConditionQuery'] = ' AND country_id = '.userCountryId().' AND (city_id = \'' . userCityId() . '\' OR city_id IS NULL)';
			$this->data['country_city_ConditionQuery'] = ' AND country_id = ' . userCountryId() . ' AND city_id = \'' . userCityId().'\'';

			$queryCity = "( city_id = '".userCityId()."' OR LOWER(city) = '".strtolower(userCityId())."'  OR LOWER(state) = '".strtolower(userCityId())."' )";
			$this->data['country_city_ConditionQuery_classified'] = ' AND country_id = ' . userCountryId() . ' AND ' .$queryCity;
			$this->data['country_ConditionQuery'] = ' AND ad_expires > "' . date('Y-m-d') . '" AND country_id = ' . userCountryId(); // only for product ads

		}else if(isset($_COOKIE['user_country_id']) && !isset($_COOKIE['user_city_id'])) {
			
			$this->data['country_city_ConditionQuery'] = ' AND country_id = '.userCountryId();
			$this->data['country_city_ConditionQuery_classified'] = ' AND country_id = '.userCountryId();
			$this->data['country_ConditionQuery'] = ' AND ad_expires > "' . date('Y-m-d') . '" AND country_id = ' . userCountryId(); // only for product ads

		}
		
		$this->data['blog_forum_confession_condition_query'] = '';
		
	}

	public function contactUs()
	{
		try{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$subject = $this->input->post('subject');
			$userMessage = $this->input->post('message');
			$message = '<p> Name: ' . $name . '</p><p> Email: ' . $email . '</p><p> Subject: ' . $subject . '</p><p> Message: ' . $userMessage . ' </p>';
// 			$this->do_send_email(settings()->email, settings()->email, 'Contact Email', $message, 0, 0);
			$this->do_send_email('noreply@nepstate.com', 'noreply@nepstate.com', 'Contact Email', $message, 0, 0);
// 			$this->do_send_email(settings()->email, 'bilal@code-xperts.com', 'Contact Email', $message, 0, 0);

			$_SESSION['valid'] = "Message sent successfully.";
			redirect($_SERVER['HTTP_REFERER']);
		}catch(Exception $e){
			$_SESSION['invalid'] = "Some Error Occurred!";
			redirect($_SERVER['HTTP_REFERER']);
		}

	}
	
	public function updateUserCountry($countryId)
	{   
		setcookie('user_city_id', '', 0, '/');
		setcookie("user_country_id", $countryId, time() + (60 * 60 * 24 * 30), "/");
		
		if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'update-country') {
			setcookie('userSelectCountryOrNor', $countryId, time() + (60 * 60 * 24 * 30), '/');
		}

		// if(isset($_REQUEST['reset']) && $_REQUEST['reset'] == 1) {
		// 	 unset($_SESSION['keyword']);
		// 	 unset($_SESSION['userCityName']);
		// 	 unset($_SESSION['countryId']);

		// 	 redirect(base_url());
		// }else{
		// 	redirect($_SERVER['HTTP_REFERER']);
		// }


		if (isset($_REQUEST['reset']) && $_REQUEST['reset'] == 1) {
			unset($_SESSION['keyword']);
			unset($_SESSION['userCityName']);
			unset($_SESSION['countryId']);
		}
	
		//  Redirect user back to original page if redirect param is set
		if (isset($_GET['redirect'])) {
			redirect($_GET['redirect']);
		} else if (isset($_SERVER['HTTP_REFERER'])) {
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url()); // fallback
		}

	}


	public function cancelCountrySelection()
	{
		if(userSelectOrNotCountry() == false) {
			setcookie('userSelectCountryOrNor', 1, time() + (60 * 60 * 24 * 30), '/');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}


	public function updateUserCity()
	{   
		$countryCode = $_REQUEST['country'];
		$countryInfo = $this->db->where('code', $countryCode)->get('admin_countries')->row();
		$countryId = $countryInfo->id;
		$city = $_REQUEST['userCityText'];
		setcookie("user_country_id", $countryId, time() + (60 * 60 * 24 * 30), "/");
		setcookie("user_city_id", $city, 0, "/");
		redirect($_SERVER['HTTP_REFERER']);
	}


		


	public function countrySelection()
	{
		
		$this->data['listOfCountries'] = $this->db->get('admin_countries')->result_object();
		$this->data['uploads'] = base_url().'resources/uploads/documents/';
		// $this->data['logo'] = base_url().'resources/frontend/assets/images/logo.png';
		$this->data['logo'] = settings()->site_logo;
		$this->load->view('frontend/country_selection',$this->data);
	}

	

	
	
	private function generateRandomString($length = 10) {
	    $characters = '023456789abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	private function generateRandomStringCode($length = 10) {
	    $characters = '023456789';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function logout(){
		unset($_SESSION["LISTYLOGIN"]);
		unset($_SESSION['PRODUCT_SLUG']);
		session_destroy();
		redirect(base_url());
	}
	public function index()
	{	
		
		$this->data['page_url'] = "index";
		$this->data['show_home'] = 1;
		$this->load->view('frontend/home',$this->data);
	}

	public function promote_website(){
	
		if(isset($_SESSION['LISTYLOGIN'])) {
			$this->data['page_url'] = "classifieds";
			$this->data['show_footer_ad'] = 1;
			$this->data['show_home'] = 0;
			$this->load->view('frontend/promote_website',$this->data);
		} else {
			$_SESSION['invalid'] = "Please login to post your ads!";
			$_SESSION['RETURN'] = 'promote';
			$_SESSION['show_popup_login'] = 1;
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function do_search_keyword(){
		$_SESSION['TEXT_SEARCH'] = $this->input->post('q');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function do_clear_search(){
		unset($_SESSION['TEXT_SEARCH']);
		
		if(isset($_GET['slug'])) {
			redirect(base_url().'classifieds/'.$_GET['slug']);

		}else{

			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function classifiedAdvancedSearch() {

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		
			$postLocation = $this->input->post('postLocation');
			$countryCode = $this->input->post('countryCode');
			$countryInfo = $this->db->where('code', $countryCode)->get('admin_countries')->row();
			$countryId = $countryInfo->id;
			
			$userCityName = $this->input->post('userCityName');
			$keywords = $this->input->post('keyword');
			$slug = $this->input->post('slug');

			$this->session->set_userdata('userCityName', $userCityName);
			$this->session->set_userdata('keyword', $keywords);
			$this->session->set_userdata('countryId', $countryId);
			$this->session->set_userdata('slug', $slug);

			redirect(current_url());

		}else{

			$keywords = $this->session->userdata('keyword');
			$userCityName = $this->session->userdata('userCityName');
			$countryId = $this->session->userdata('countryId');
			$slug = $this->session->userdata('slug');
		}	

		$this->data['page_url'] = "classifieds";
		$this->data['slug'] = $slug;
		$this->data['tags'] = 0;
		$this->data['show_home'] = 0;
		$this->data['keywords'] = $keywords;
		$this->data['country_id'] = $countryId;
		$this->data['userCityName'] = $userCityName;
		$this->data['advance_search'] = 1;
		$this->load->view('frontend/classifieds',$this->data);

	}

	
	public function classifieds($id){
		
		$this->data['page_url'] = "classifieds";
		$this->data['slug'] = $id;
		$this->data['tags'] = 0;
		$this->data['show_home'] = 0;
		$this->data['advance_search'] = $_GET['advance_search'] ?? 0;
		$this->data['country_id'] = $_COOKIE['user_country_id'] ?? 0;
		$this->load->view('frontend/classifieds',$this->data);
	}

	public function tags_classifieds($id){
		$this->data['page_url'] = "classifieds";
		$this->data['slug'] = $id;
		$this->data['tags'] = 1;
		$this->load->view('frontend/classifieds',$this->data);
	}

	

	public function new_post($slug){
		
		if(isset($_SESSION['LISTYLOGIN'])) {

			$this->db->where('user_id', user_info()->id)->delete('history_of_before_apply_coupons');

		
			$this->data['page_url'] = "classifieds";
			$this->data['slug'] = $slug;
			$this->data['show_footer_ad'] = 1;
			$this->load->view('frontend/post_classifieds',$this->data);
		} else {
			
			
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function edit_post($id){
		$this->data['page_url'] = "classifieds";
		$this->data['id'] = $id;
		$product = $this->db->query("SELECT * FROM products WHERE id = '".$id."'")->result_object()[0];
		$category = $this->db->query("SELECT * FROM categories WHERE slug = '".$product->category."'")->result_object()[0];
		// echo $this->db->last_query();
		// echo "<pre>";
		// print_r($category);
		$this->data['slug'] = $category->slug;
		$this->data['product'] = $product;
		$this->data['edit'] = 1;
		$this->data['show_footer_ad'] = 1;
		$this->load->view('frontend/post_classifieds',$this->data);
	}

	public function classified_details($slug){
	
		$user_ip = $this->input->ip_address() ?? $_SERVER['REMOTE_ADDR'];
		$this->saveClicks($slug);
		$this->saveViews($user_ip, $slug); //Save Views
		$this->data['slug'] = $slug;
		$this->data['page_url'] = "classified-details";
		$this->load->view('frontend/classified-details',$this->data);
	}


	public function saveViews($ip, $productSlug)
	{
		$productInfo = $this->db->where('slug', $productSlug)->get('products')->row();

		$checkView = $this->db->where('ip', $ip)->where('product_slug', $productSlug)->get('views')->row();
		if (empty($checkView) ) {
			if($productInfo->uID != user_info()->id) {
				$this->db->insert('views', ['ip' => $ip, 'product_slug' => $productSlug, 'product_creator_id' => $productInfo->uID, 'created_at' => date('Y-m-d H:i:s')]);
			}
		}
	}



	public function saveClicks($slug)
	{
		$productInfo = $this->db->where('slug', $slug)->get('products')->row();

		if($productInfo->uID != user_info()->id) {

			$this->db->where('slug', $slug)->update('products', ['clicks' => $productInfo->clicks + 1]);
		}
	}


	public function blog(){
		
		$this->data['page_url'] = "index";
		$this->data['show_home'] = 0;
		$this->data['title_show'] = "Blog";
		$this->load->library("pagination");
		$query_new = "";
		if(isset($_POST['s'])){
			$query_new = ' AND ';
			$query_new .= "( title LIKE '%".$_POST['s']."%' ";
			$query_new .= " OR tags LIKE '%".$_POST['s']."%' )";
		}

		

		$products = $this->db->query("SELECT * FROM blogs WHERE is_approved = 1 AND status = 1 ".$this->data['blog_forum_confession_condition_query']." ".$query_new." ORDER BY id DESC")->result_object();


		 $config = array();
	     $config["base_url"] = base_url()."blog";
	     $config["total_rows"] = count($products);
	     $config["per_page"] = 5;
	     $config["uri_segment"] = 2;
	     $config['full_tag_open'] = "<div class='pagination'><ul>";
	     $config['full_tag_close'] = '</ul></div>';
	     $config['num_tag_open'] = '<li>';
	     $config['num_tag_close'] = '</li>';
	     $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
	     $config['cur_tag_close'] = '</a></li>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['first_tag_open'] = '<li>';
	     $config['first_tag_close'] = '</li>';
	     $config['last_tag_open'] = '<li>';
	     $config['last_tag_close'] = '</li>';
	     $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
	     $config['next_tag_open'] = '<li>';
	     $config['next_tag_close'] = '</li>';
	     $per_page=$config["per_page"]; 
	     
	     $this->pagination->initialize($config); 

	    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
      	$this->data["links"] = $this->pagination->create_links();

      	$qry = "";
      	$sort_qry = " ORDER BY id DESC";
      	if(isset($_GET['sort'])){
	        $sort = $_GET['sort'];
	        if($sort == "title-asc"){
	            $sort_qry = " ORDER BY title ASC";
	        } else if($sort == "title-desc"){
	            $sort_qry = " ORDER BY title DESC";
	        } else if($sort == "date-asc"){
	            $sort_qry = " ORDER BY created_at ASC";
	        } else if($sort == "views-desc"){
	            $sort_qry = " ORDER BY views DESC";
	        } else if($sort == "views-asc"){
	            $sort_qry = " ORDER BY views ASC";
	        } 
	        else {
	            $sort_qry = " ORDER BY id DESC";
	        }
	    } 


      	$products_data = $this->db->query("SELECT * FROM blogs WHERE is_approved = 1 AND status = 1 ".$this->data['blog_forum_confession_condition_query']." ".$query_new." ".$sort_qry." LIMIT ".$page.", ".$per_page)->result_object();
      	// echo $this->db->last_query();
      	$this->data['blogs'] = $products_data;
		
		$this->load->view('frontend/blog',$this->data);
	}

	public function tags_blogs($val){
		$this->data['page_url'] = "index";
		$this->data['show_home'] = 0;
		$this->data['title_show'] = "Tags";
		$this->load->library("pagination");
		$new_query = " AND FIND_IN_SET('".$val."', tags) > 0";
		$products = $this->db->query("SELECT * FROM blogs WHERE status = 1 ".$this->data['blog_forum_confession_condition_query']." ".$new_query." ORDER BY id DESC")->result_object();

		 $config = array();
	     $config["base_url"] = base_url()."blog";
	     $config["total_rows"] = count($products);
	     $config["per_page"] = 6;
	     $config["uri_segment"] = 4;
	     $config['full_tag_open'] = "<div class='pagination'><ul>";
	     $config['full_tag_close'] = '</ul></div>';
	     $config['num_tag_open'] = '<li>';
	     $config['num_tag_close'] = '</li>';
	     $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
	     $config['cur_tag_close'] = '</a></li>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['first_tag_open'] = '<li>';
	     $config['first_tag_close'] = '</li>';
	     $config['last_tag_open'] = '<li>';
	     $config['last_tag_close'] = '</li>';
	     $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
	     $config['next_tag_open'] = '<li>';
	     $config['next_tag_close'] = '</li>';
	     $per_page=$config["per_page"]; 
	     
	     $this->pagination->initialize($config); 

	    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      	$this->data["links"] = $this->pagination->create_links();

      	$qry = "";
      	
      	$products_data = $this->db->query("SELECT * FROM blogs WHERE status = 1 ".$this->data['blog_forum_confession_condition_query']." ".$new_query." LIMIT ".$page.", ".$per_page)->result_object();
      	$this->data['blogs'] = $products_data;
		$this->load->view('frontend/blog',$this->data);
	}

	public function tags_confession($val){
		$this->data['page_url'] = "index";
		$this->data['show_home'] = 0;
		$this->data['title_show'] = "Tags";
		$this->load->library("pagination");
		$new_query = " AND FIND_IN_SET('".$val."', tags) > 0";
		$products = $this->db->query("SELECT * FROM confessions WHERE status = 1 ".$this->data['blog_forum_confession_condition_query']." ".$new_query." ORDER BY id DESC")->result_object();

		 $config = array();
	     $config["base_url"] = base_url()."blog";
	     $config["total_rows"] = count($products);
	     $config["per_page"] = 6;
	     $config["uri_segment"] = 4;
	     $config['full_tag_open'] = "<div class='pagination'><ul>";
	     $config['full_tag_close'] = '</ul></div>';
	     $config['num_tag_open'] = '<li>';
	     $config['num_tag_close'] = '</li>';
	     $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
	     $config['cur_tag_close'] = '</a></li>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['first_tag_open'] = '<li>';
	     $config['first_tag_close'] = '</li>';
	     $config['last_tag_open'] = '<li>';
	     $config['last_tag_close'] = '</li>';
	     $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
	     $config['next_tag_open'] = '<li>';
	     $config['next_tag_close'] = '</li>';
	     $per_page=$config["per_page"]; 
	     
	     $this->pagination->initialize($config); 

	    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      	$this->data["links"] = $this->pagination->create_links();

      	$qry = "";
      	
      	$products_data = $this->db->query("SELECT * FROM confessions WHERE status = 1 ".$this->data['blog_forum_confession_condition_query']." ".$new_query." LIMIT ".$page.", ".$per_page)->result_object();
      	$this->data['blogs'] = $products_data;
		$this->load->view('frontend/confessions',$this->data);
	}

	public function tags_forums($val){
		$this->data['page_url'] = "index";
		$this->data['show_home'] = 0;
		$this->data['title_show'] = "Tags";
		$this->load->library("pagination");
		$new_query = " AND FIND_IN_SET('".$val."', tags) > 0";
		
		$products = $this->db->query("SELECT * FROM confessions WHERE status = 1 ".$this->data['blog_forum_confession_condition_query']." ".$new_query." ORDER BY id DESC")->result_object();

		 $config = array();
	     $config["base_url"] = base_url()."blog";
	     $config["total_rows"] = count($products);
	     $config["per_page"] = 6;
	     $config["uri_segment"] = 4;
	     $config['full_tag_open'] = "<div class='pagination'><ul>";
	     $config['full_tag_close'] = '</ul></div>';
	     $config['num_tag_open'] = '<li>';
	     $config['num_tag_close'] = '</li>';
	     $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
	     $config['cur_tag_close'] = '</a></li>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['first_tag_open'] = '<li>';
	     $config['first_tag_close'] = '</li>';
	     $config['last_tag_open'] = '<li>';
	     $config['last_tag_close'] = '</li>';
	     $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
	     $config['next_tag_open'] = '<li>';
	     $config['next_tag_close'] = '</li>';
	     $per_page=$config["per_page"]; 
	     
	     $this->pagination->initialize($config); 

	    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      	$this->data["links"] = $this->pagination->create_links();

      	$qry = "";
      	
      	$products_data = $this->db->query("SELECT * FROM confessions WHERE status = 1 ".$this->data['blog_forum_confession_condition_query']." ".$new_query." LIMIT ".$page.", ".$per_page)->result_object();
      	$this->data['blogs'] = $products_data;
		$this->load->view('frontend/forums',$this->data);
	}

	public function post_blog(){
		$this->data['page_url'] = "classifieds";
		$this->data['tags'] = 0;
		$this->data['show_home'] = 0;
		$this->load->view('frontend/post_blog',$this->data);
	}


	public function do_delete_blog($id){
		
		if(isset($_SESSION['LISTYLOGIN'])){
			$this->db->query("DELETE FROM blogs WHERE id = ".$id);
			$_SESSION['valid'] = "Blog information deleted successfully!";
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	

	public function do_delete_confession($id){
	
		if(isset($_SESSION['LISTYLOGIN'])){
			$this->db->query("DELETE FROM confessions WHERE id = ".$id);
			$_SESSION['valid'] = "Information deleted successfully!";
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function submit_blog(){
		
		if(isset($_SESSION['LISTYLOGIN'])){
			
				
            	$status_val = 1;
            	if(isset($_POST['draft'])){
            		$status_val = 2;
            	}
                $slug_val = slug($this->input->post('title'));



				$arr = array(
					'title' => $this->input->post('title'),
					'uID' => user_info()->id,
					'author'=> $this->input->post('author'),
					'description'=> $this->input->post('description'),
					'status'=> $status_val,
					'created_at'=> date("Y-m-d H:i:s"),
					'slug' => $slug_val,
					'tags' => $this->input->post('event_tags'),
					'notif' => $this->input->post('comment_notif')?1:0
				);
				

				if(userCountryId()  && userCityId()) {
					$arr['country_id'] = userCountryId();
					$arr['city_id'] = userCityId();
				}else if(userCountryId()  && !userCityId()) {
					$arr['country_id'] = userCountryId();
				}

				
				// echo "<pre>";
				// print_r($arr);
				// echo "</pre>";
				// die;

				$input = "logo";
		        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
		        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
			        if($image['upload'] == true || $_FILES[$input]['size']<1){
			            $image = $image['data'];
			            $arr['image'] = $this->data['classified_BASE_URL'].$image['file_name'];
			        }
		    	}
				
				if(isset($_GET['edit'])){
					
					unset($arr['uID']);
					unset($arr['slug']);
					$this->db->where('id', $_GET['edit']);
					$this->db->update('blogs',$arr);
					$pID = $_GET['edit'];

					if($status_val == 1) {
						$this->saveNotification(user_info()->id, 'admin', 'add-new-blog', $pID, notificationContent('add-new-blog'), null, null, 'blog');
						$adminMessage = 'Dear Admin, <br><br>	
						A new blog has been submitted and is awaiting your approval. <br><br>
						<img src="'.$arr['image'].'"><br><br>	
						<strong>Blog Author:</strong> '.$this->input->post('author').'<br><br>
						<strong>Blog Title:</strong> '.$this->input->post('title').'<br><br>
						<strong>Blog Description:</strong> '.$this->input->post('description').'<br><br>
						Best Regards, <br>
						'.settings()->site_title.'
						';
						
						$this->do_send_email(settings()->email, settings()->email, 'New Blog Approval Request', $adminMessage, 0);
						$message = 'Dear '.user_info()->name.', <br><br>
						Thank you for submitting your blog post. <br><br>
						Your submission has been received successfully. Our team will review your post to ensure it meets our quality standards. Once the review process is complete, your blog post will be published and made public.';
						$this->do_send_email(settings()->email, user_info()->email, 'Blog Post Submission Received', $message, 0);
						$_SESSION['valid'] = "Your blog information has been submitted to admin!";
					}else{
						$_SESSION['valid'] = "Blog information has been updated!";
					}

					unset($_SESSION['INVALID_FORM_DATA']);
					redirect(base_url()."my-blogs");
					// redirect($_SERVER['HTTP_REFERER']);
				} else {
					
					$this->db->insert('blogs',$arr);
					$pID = $this->db->insert_id();

					if($status_val == 1) {
						
						$this->saveNotification(user_info()->id, 'admin', 'add-new-blog', $pID, notificationContent('add-new-blog'), null, null, 'blog');
						$adminMessage = 'Dear Admin, <br><br>	
						A new blog has been submitted and is awaiting your approval. <br><br>
						<img src="'.$arr['image'].'"><br><br>	
						<strong>Blog Author:</strong> '.$this->input->post('author').'<br><br>
						<strong>Blog Title:</strong> '.$this->input->post('title').'<br><br>
						<strong>Blog Description:</strong> '.$this->input->post('description').'<br><br>
						Best Regards, <br>
						'.settings()->site_title.'
						';
						
						$this->do_send_email(settings()->email, settings()->email, 'New Blog Approval Request', $adminMessage, 0);

						$message = 'Dear '.user_info()->name.', <br><br>
						Thank you for submitting your blog post. <br><br>
						Your submission has been received successfully. Our team will review your post to ensure it meets our quality standards. Once the review process is complete, your blog post will be published and made public.';
						$this->do_send_email(settings()->email, user_info()->email, 'Blog Post Submission Received', $message, 0);


						$_SESSION['valid'] = "Your blog information has been submitted to admin!";
					}else{
						$_SESSION['valid'] = "Your blog information save in draft!";
					}

					
					unset($_SESSION['INVALID_FORM_DATA']);
					redirect(base_url()."my-blogs");
				}
				
			
		} else {
			redirect(base_url());
		}
	}
	public function blog_details($slug){
		$this->data['page_url'] = "index";
		$this->data['show_home'] = 0;
		$this->data['slug'] = $slug;
		$this->load->view('frontend/blog-details',$this->data);
	}

	// public function confessions(){
	// 	$this->data['page_url'] = "classified";
	// 	$this->load->view('frontend/confessions',$this->data);
	// }

	public function submit_confession(){
		if(isset($_SESSION['LISTYLOGIN'])){
            	$status_val = 1;
            	if(isset($_POST['draft'])){
            		$status_val = 2;
            	}

            	if($this->uri->segment(2) == "forum"){
            		$ttt_type = "forum";
            		$cat = $this->input->post('forumcat');
            	} else {
            		$ttt_type = 'confession';
            		$cat = 0;
            	}
                $slug_val = slug($this->input->post('title'));
				$arr = array(
					'title' => $this->input->post('title'),
					'cID'=> $cat,
					'uID' => user_info()->id,
					'author'=> $this->input->post('author')==""?"Anonymous":$this->input->post('author'),
					'description'=> $this->input->post('description'),
					'status'=> $status_val,
					'created_at'=> date("Y-m-d H:i:s"),
					'slug' => $slug_val,
					'tags' => $this->input->post('event_tags'),
					'notif' => $this->input->post('comment_notif')?1:0,
					'nsfw' => $this->input->post('nsfw')?1:0,
					'type'	=> $ttt_type
				);


				if(userCountryId()  && userCityId()) {
					$arr['country_id'] = userCountryId();
					$arr['city_id'] = userCityId();
				}else if(userCountryId()  && !userCityId()) {
					$arr['country_id'] = userCountryId();
				}

				

				// echo "<pre>";
				// print_r($arr);
				// echo "</pre>";
				// die;

				$input = "logo";
		        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
		        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
			        if($image['upload'] == true || $_FILES[$input]['size']<1){
			            $image = $image['data'];
			            $arr['image'] = $this->data['classified_BASE_URL'].$image['file_name'];
			        }
		    	}
				
				if(isset($_GET['edit'])){
					unset($arr['uID']);
					unset($arr['slug']);
					$this->db->where('id', $_GET['edit']);
					$this->db->update('confessions',$arr);
					$pID = $_GET['edit'];
					// $_SESSION['valid'] = "Blog information has been updated!";
					unset($_SESSION['INVALID_FORM_DATA']);
					if($this->uri->segment(2) == "forum"){
						redirect(base_url()."my-forums");
					} else {
						redirect(base_url()."my-confessions");
					}
					
					// redirect($_SERVER['HTTP_REFERER']);
				} else {
					$this->db->insert('confessions',$arr);
					$pID = $this->db->insert_id();

					if($ttt_type == 'confession') {
						$this->saveNotification(user_info()->id, 'admin', 'add-new-confession', $pID, notificationContent('add-new-confession'), null, null, 'confessions');
					}else if($ttt_type == 'forum') {
						$this->saveNotification(user_info()->id, 'admin', 'add-new-forum', $pID, notificationContent('add-new-forum'), null, null, 'forums');
					}

					$_SESSION['valid'] = "Your ".$ttt_type." information has been posted successfully!";
					unset($_SESSION['INVALID_FORM_DATA']);

					if($this->uri->segment(2) == "forum"){
						redirect(base_url()."my-forums");
					} else {
						redirect(base_url()."my-confessions");
					}
				}
				
			
		} else {
			redirect(base_url());
		}
	}
	public function post_confession(){
		$this->data['page_url'] = "classifieds";
		$this->data['tags'] = 0;
		$this->data['show_home'] = 0;
		$this->load->view('frontend/post_confession',$this->data);
	}

	public function confessions(){
		$this->data['page_url'] = "index";
		$this->data['show_home'] = 0;
		$this->data['title_show'] = "Confessions";
		$this->load->library("pagination");
		$query_new = "";
		if(isset($_POST['s'])){
			$query_new = ' AND ';
			$query_new .= "( title LIKE '%".$_POST['s']."%' ";
			$query_new .= " OR tags LIKE '%".$_POST['s']."%' )";
		}

		$products = $this->db->query("SELECT * FROM confessions WHERE status = 1  ".$this->data['blog_forum_confession_condition_query']." AND type = 'confession' ".$query_new." ORDER BY id DESC")->result_object();

		 $config = array();
	     $config["base_url"] = base_url()."confessions";
	     $config["total_rows"] = count($products);
	     $config["per_page"] = 5;
	     $config["uri_segment"] = 2;
	     $config['full_tag_open'] = "<div class='pagination'><ul>";
	     $config['full_tag_close'] = '</ul></div>';
	     $config['num_tag_open'] = '<li>';
	     $config['num_tag_close'] = '</li>';
	     $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
	     $config['cur_tag_close'] = '</a></li>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['first_tag_open'] = '<li>';
	     $config['first_tag_close'] = '</li>';
	     $config['last_tag_open'] = '<li>';
	     $config['last_tag_close'] = '</li>';
	     $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
	     $config['next_tag_open'] = '<li>';
	     $config['next_tag_close'] = '</li>';
	     $per_page=$config["per_page"]; 
	     
	     $this->pagination->initialize($config); 

	    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
      	$this->data["links"] = $this->pagination->create_links();

      	$qry = "";
      	$final_new_in_array = "";
      	$sort_qry = " ORDER BY id DESC";
      	if(isset($_GET['sort'])){
	        $sort = $_GET['sort'];
	        if($sort == "title-asc"){
	            $sort_qry = " ORDER BY title ASC";
	        } else if($sort == "title-desc"){
	            $sort_qry = " ORDER BY title DESC";
	        } else if($sort == "date-asc"){
	            $sort_qry = " ORDER BY created_at ASC";
	        } else if($sort == "views-desc"){
	            $sort_qry = " ORDER BY views DESC";
	        } else if($sort == "views-asc"){
	            $sort_qry = " ORDER BY views ASC";
	        } 
	        else if($sort == "nsfw"){
	            $query_new .= " AND nsfw = 1";
	        } 
	        else if($sort == "viewed"){
	        	$new_in_array = "-1,";
	        	$virwed = $this->db->query("SELECT cID AS cID, COUNT(*) AS cid_count FROM confession_views WHERE type = 2 GROUP BY cID ORDER BY cid_count DESC")->result_object();
	        	foreach($virwed as $k=>$row){
	        		$new_in_array .= $row->cID.",";
	        	}
	        	$final_new = substr($new_in_array, 0, -1);
	        	$final_new_in_array = " AND id IN (".$final_new.")";
	        } 
	        else if($sort == "liked"){
	        	$new_pro = "-1,";
	        	foreach($products as $k=>$r){
					$new_pro .= $r->id.",";
	        	}
	        	$f_pro = substr($new_pro, 0, -1);

	        	$new_in_array = "-1,";
	        	
	        	$virwed = $this->db->query("SELECT bID AS cID, COUNT(*) AS cid_count FROM confession_likes WHERE bID IN(".$f_pro.") GROUP BY bID ORDER BY cid_count DESC")->result_object();
	        	foreach($virwed as $k=>$row){
	        		$new_in_array .= $row->cID.",";
	        	}
	        	$final_new = substr($new_in_array, 0, -1);
	        	$final_new_in_array = " AND id IN (".$final_new.")";
	        } 
	        else {
	            $sort_qry = " ORDER BY id DESC";
	        }
	    } 

      	$products_data = $this->db->query("SELECT * FROM confessions WHERE status = 1 ".$this->data['blog_forum_confession_condition_query']." AND type = 'confession' ".$final_new_in_array." ".$query_new." ".$sort_qry." LIMIT ".$page.", ".$per_page)->result_object();
      	// echo $this->db->last_query();
      	$this->data['blogs'] = $products_data;
		$this->load->view('frontend/confessions',$this->data);
	}
	public function forums(){
		$this->data['page_url'] = "index";
		$this->data['show_home'] = 0;
		$this->data['title_show'] = "Forums";
		$this->load->library("pagination");
		$query_new = "";
		if(isset($_POST['s'])){
			$query_new = ' AND ';
			$query_new .= "( title LIKE '%".$_POST['s']."%' ";
			$query_new .= " OR tags LIKE '%".$_POST['s']."%' )";
		}
		$cat_query = "";
		if(isset($_GET['cat'])){
			$cat = $this->db->query("SELECT * FROm forum_categories WHERE slug = '".$_GET['cat']."'")->result_object()[0];
			if(!empty($cat)){
				$cat_query = ' AND cID =  '.$cat->id;
			}
		}
		
		$products = $this->db->query("SELECT * FROM confessions WHERE status = 1 ".$this->data['blog_forum_confession_condition_query']." AND type = 'forum' ".$query_new." ".$cat_query." ORDER BY id DESC")->result_object();

		 $config = array();
	     $config["base_url"] = base_url()."forums";
	     $config["total_rows"] = count($products);
	     $config["per_page"] = 12;
	     $config["uri_segment"] = 2;
	     $config['full_tag_open'] = "<div class='pagination'><ul>";
	     $config['full_tag_close'] = '</ul></div>';
	     $config['num_tag_open'] = '<li>';
	     $config['num_tag_close'] = '</li>';
	     $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
	     $config['cur_tag_close'] = '</a></li>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['first_tag_open'] = '<li>';
	     $config['first_tag_close'] = '</li>';
	     $config['last_tag_open'] = '<li>';
	     $config['last_tag_close'] = '</li>';
	     $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
	     $config['prev_tag_open'] = '<li>';
	     $config['prev_tag_close'] = '</li>';
	     $config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
	     $config['next_tag_open'] = '<li>';
	     $config['next_tag_close'] = '</li>';
	     $per_page=$config["per_page"]; 
	     
	     $this->pagination->initialize($config); 

	    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
      	$this->data["links"] = $this->pagination->create_links();

      	$qry = "";
      	$final_new_in_array = "";
      	$sort_qry = " ORDER BY id DESC";
      	if(isset($_GET['sort'])){
	        $sort = $_GET['sort'];
	        if($sort == "title-asc"){
	            $sort_qry = " ORDER BY title ASC";
	        } else if($sort == "title-desc"){
	            $sort_qry = " ORDER BY title DESC";
	        } else if($sort == "date-asc"){
	            $sort_qry = " ORDER BY created_at ASC";
	        } else if($sort == "views-desc"){
	            $sort_qry = " ORDER BY views DESC";
	        } else if($sort == "views-asc"){
	            $sort_qry = " ORDER BY views ASC";
	        } 
	        else if($sort == "nsfw"){
	            $query_new .= " AND nsfw = 1";
	        } 
	        else if($sort == "viewed"){
	        	$new_in_array = "-1,";
	        	$virwed = $this->db->query("SELECT cID AS cID, COUNT(*) AS cid_count FROM confession_views WHERE type = 1 GROUP BY cID ORDER BY cid_count DESC")->result_object();
	        	foreach($virwed as $k=>$row){
	        		$new_in_array .= $row->cID.",";
	        	}
	        	$final_new = substr($new_in_array, 0, -1);
	        	$final_new_in_array = " AND id IN (".$final_new.")";
	        } 
	        else if($sort == "liked"){
	        	$new_pro = "-1,";
	        	foreach($products as $k=>$r){
					$new_pro .= $r->id.",";
	        	}
	        	$f_pro = substr($new_pro, 0, -1);

	        	$new_in_array = "-1,";
	        	
	        	$virwed = $this->db->query("SELECT bID AS cID, COUNT(*) AS cid_count FROM confession_likes WHERE bID IN(".$f_pro.") GROUP BY bID ORDER BY cid_count DESC")->result_object();
	        	foreach($virwed as $k=>$row){
	        		$new_in_array .= $row->cID.",";
	        	}
	        	$final_new = substr($new_in_array, 0, -1);
	        	$final_new_in_array = " AND id IN (".$final_new.")";
	        } 
	        else {
	            $sort_qry = " ORDER BY id DESC";
	        }
	    } 
      	$products_data = $this->db->query("SELECT * FROM confessions WHERE  status = 1  ".$this->data['blog_forum_confession_condition_query']." AND type = 'forum' ".$final_new_in_array." ".$query_new." ".$cat_query." ".$sort_qry." LIMIT ".$page.", ".$per_page)->result_object();
      	// echo $this->db->last_query();
      	// die;
      	$this->data['blogs'] = $products_data;
		$this->load->view('frontend/forums',$this->data);
	}

	public function about(){
		$this->data['page_url'] = "about-us";
		$this->load->view('frontend/about-us',$this->data);
	}
	public function contact(){
		$this->data['page_url'] = "about-us";
		$this->load->view('frontend/contact-us',$this->data);
	}
	public function faq(){
		$this->data['page_url'] = "about-us";
		$this->load->view('frontend/faq',$this->data);
	}
	
	public function pages($slug){
		$this->data['page_url'] = $slug;
		$this->load->view('frontend/pages',$this->data);
	}

	public function dashboard(){
		if(isset($_SESSION['LISTYLOGIN'])){
			$this->data['page_url'] = "about-us";
			$this->data['show_footer_ad'] = 1;



			$this->data['title_page'] = "Dashboard";
			$this->load->view('frontend/dashboard',$this->data);
		} else {
			redirect(base_url());
		}
	}

	public function favorites(){
		$this->data['page_url'] = "about-us";
		$this->data['show_footer_ad'] = 1;
		$this->data['title_page'] = "My Favorites";
		$this->load->view('frontend/favorites',$this->data);
	}

	public function my_listings(){
		
		$this->data['page_url'] = "about-us";
		$this->data['show_footer_ad'] = 1;
		if(isset($_GET['type'])){
			$tttt = $_GET['type'];
			if($tttt == "active"){
				$text_ = "Active Listings";
			} else if($tttt == "expired"){
				$text_ = "Expired Listings";
			} else {
				$text_ = "My Listings";
			}
		} else {
			$text_ = "My Listings";
		}
		$this->data['title_page'] = $text_;
		$this->load->view('frontend/my_listings',$this->data);
	}

	public function my_blogs(){

		if(isset($_SESSION['LISTYLOGIN'])){

			$this->data['page_url'] = "about-us";
			$this->data['show_footer_ad'] = 1;
			if($this->uri->segment(1)== "my-confessions"){
				$text_ = "My Confessions";
			} else if($this->uri->segment(1)== "my-forums"){
				$text_ = "My Forums";
			} else {
				$text_ = "My Blogs";
			}
			$this->data['title_page'] = $text_;
			$this->load->view('frontend/my_blogs',$this->data);
		}else {
			redirect(base_url());
		}
	}



	public function edit_blog($id){
		$this->data['page_url'] = "classifieds";
		$this->data['id'] = $id;
		$product = $this->db->query("SELECT * FROM blogs WHERE id = '".$id."'")->result_object()[0];
		$this->data['slug'] = $category->slug;
		$this->data['product'] = $product;
		$this->data['edit'] = 1;
		$this->data['show_footer_ad'] = 1;
		$this->load->view('frontend/post_blog',$this->data);
	}

	public function edit_confession($id){
		$this->data['page_url'] = "classifieds";
		$this->data['id'] = $id;
		$product = $this->db->query("SELECT * FROM confessions WHERE id = '".$id."'")->result_object()[0];
		$this->data['slug'] = $category->slug;
		$this->data['product'] = $product;
		$this->data['edit'] = 1;
		$this->data['show_footer_ad'] = 1;
		$this->load->view('frontend/post_confession',$this->data);
	}

	public function my_ads(){

		if(isset($_GET['type'])) {

			$type = $_GET['type'];

			if($type == "active") {
				$text_ = "Active Ads";
			}else if($type == "expired") {
				$text_ = "Expired Ads";
			}else {
				$text_ = "My Ads";

			}
		}else{
			$text_ = "My Ads";
		}

		$this->data['page_url'] = "about-us";
		$this->data['show_footer_ad'] = 1;
		
		$this->data['title_page'] = $text_;
		$this->load->view('frontend/my_ads',$this->data);
	}
	public function my_comments(){
		$this->data['page_url'] = "about-us";
		$this->data['show_footer_ad'] = 1;
		$this->data['title_page'] = "My Comments";
		$this->load->view('frontend/my-comments', $this->data);
	}
	public function my_payments(){
		$this->data['page_url'] = "about-us";
		$this->data['show_footer_ad'] = 1;
		$this->data['title_page'] = "My Payments";
		$this->load->view('frontend/my-payments',$this->data);
	}
	public function my_reviews(){
		$this->data['page_url'] = "about-us";
		$this->data['show_footer_ad'] = 1;
		$this->data['title_page'] = "My Reviews";
		$this->load->view('frontend/my_reviews',$this->data);
	}

	public function notifications(){
		
		$getNOotifications = $this->db->where('notification_for', 'user')->where('creator_id', user_info()->id )->order_by('id', 'DESC')->get('all_notifications')->result_object();
		$this->db->where('notification_for', 'user')->where('creator_id', user_info()->id )->where('seen', 0)->update('all_notifications', ['seen' => 1]);
		$this->data['show_footer_ad'] = 1;
		$this->data['notifications'] = $getNOotifications;
		$this->data['title_page'] = "Notifications";
		$this->load->view('frontend/notifications',$this->data);
	}

	public function delete_notification($id) {
		$this->db->where('id', $id)->delete('all_notifications');
		redirect(base_url().'notifications');
	}



	public function delete_all_notifications() {
		$this->db->where('notification_for', 'user')->where('creator_id', user_info()->id )->delete('all_notifications');
		$_SESSION['valid'] = "All notifications deleted successfully.";
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function do_clear_session_popup(){
		unset($_SESSION['SIGNUPFORM']);
		unset($_SESSION['show_popup_login']);
		unset($_SESSION['show_popup_signup']);
		unset($_SESSION['invalid_popup']);
	}

	public function forgot_password(){
		if(isset($_SESSION["LISTYLOGIN"])){
			redirect(base_url());
		} else {
			$this->data['page_url'] = "about-us";
			$this->data['show_header'] = 0;
			$this->load->view('frontend/forgot',$this->data);
		}
	}
	public function forgot_password_email()
	{
		$email_to = $this->input->post('username');
		$ret = $this->db->query("SELECT * FROM `users` WHERE LOWER(`email`) = '".strtolower($email_to)."'");
		$ret_num = $ret->num_rows();
		if($ret_num == 0 )
		{
			$_SESSION['invalid'] = 'Email Address not found in our records!';
			redirect(base_url().'forgot/password');
		}
		else
		{
			$row = $ret->result_object()[0];
			$rendomcode = $this->generateRandomString(30);
			$arr = array(
				'session_id' => $rendomcode,
			);
			$this->db->where('email', $email_to);
			$this->db->update('users',$arr);

			
			$url_click = base_url()."do/reset/password/".($rendomcode);
			$message = '
				<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$row->name.'</strong>,<br /><br/>
					
					Please click on below link to reset your password.
					
					<br><br>
					<a href='.$url_click.'>'.$url_click.'</a>
					<br />	<br />	
					Best Regards,
					<br>
					'.settings()->site_title.'</span>				
			';
			 $this->do_send_email(settings()->email, $email_to, 'Forgot Password', $message, 1);
			
			$_SESSION['valid'] = 'Reset password link has been sent successfully to your email!';
			redirect(base_url());
		}
	}

	public function do_update_password($id){
		$this->form_validation->set_rules('password', 'New password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
		if ($this->form_validation->run() == FALSE)
		{
			$session__ = $this->db->query("SELECT * FROM users WHERE session_id = '".$id."'")->result_object()[0];
			if(!empty($session__)){
				$this->load->view('frontend/password_reset', $this->data);
			} else {
				$_SESSION['invalid'] = 'Link has been expired or revoked!';
				redirect(base_url());
			}
		}
		else
		{
			$arr = array(
				'session_id' => null,
				'password'=> md5($this->input->post('password')),
			);
			$this->db->where('session_id', $id);
			$this->db->update('users',$arr);

			// echo $this->db->last_query();
			// die;

			$_SESSION["valid"] = "You password has been reset successfully.";
			redirect(base_url());
		}
	}

	public function do_change_password(){
		$this->data['title_page'] = "Change password";
		$this->form_validation->set_rules('opass', 'Old password', 'trim|required');
		$this->form_validation->set_rules('npass', 'New password', 'trim|required');
		$this->form_validation->set_rules('cnpass', 'Confirm password', 'trim|required|matches[npass]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('frontend/change_password',$this->data);
		}
		else
		{
			$old = $this->db->query("SELECT * FROM users WHERE id = ".user_info()->id." AND password = '".md5($this->input->post('opass'))."'")->num_rows();
			if($old == 0){
				$_SESSION["invalid"] = "Old password is not correct.";
				redirect(base_url()."change/password");
				die;
			}

			$arr = array(
				'password'=> md5($this->input->post('npass')),
			);
			$this->db->where('id', user_info()->id);
			$this->db->update('users',$arr);
			$_SESSION["valid"] = "You password has been changed successfully.";
			redirect(base_url()."change/password");
		}
	}



	public function do_signup()
	{	
		
		if(isset($_SESSION["LISTYLOGIN"])){
			redirect(base_url());
		}
		else{
				$email_to_check = $this->input->post('email');
				$username_to_check = $this->input->post('username');

				$check_user = $this->db->query("SELECT * FROM users WHERE email = '".$email_to_check."'")->num_rows();
				
				if($check_user > 0){
					$_SESSION['SIGNUPFORM'] = $_POST;
					$_SESSION['show_popup_signup'] = 1;
					$_SESSION['invalid_popup'] = "Email address already exist in our records!";
					redirect($_SERVER['HTTP_REFERER']);
					die;
				}

				$check_username = $this->db->query("SELECT * FROM users WHERE username = '".$username_to_check."'")->num_rows();
				if($check_username > 0){
					$_SESSION['SIGNUPFORM'] = $_POST;
					$_SESSION['show_popup_signup'] = 1;
					$_SESSION['invalid_popup'] = "Username already exist in our records!";
					redirect($_SERVER['HTTP_REFERER']);
					die;
				}

				$rendomcode = $this->generateRandomString(25);
				$arr = array(
					'name' => $this->input->post('fname'),
					'username'=> trim($username_to_check),
					'email'=> trim($email_to_check),
					'password'=> md5($this->input->post('password')),
					'created_at'=> date("Y-m-d H:i:s"),
					'status'=> 1,
					'verify_email' => 0,
					'session_id' => $rendomcode,
				);

				if(userCountryId()  && userCityId()) {
					$arr['country_id'] = userCountryId();
					$arr['city_id'] = userCityId();
				}else if(userCountryId()  && !userCityId()) {
					$arr['country_id'] = userCountryId();
				}


				
				$this->db->insert('users',$arr);
				$u__i = $this->db->insert_id();
				$this->saveNotification($u__i, 'admin', 'new-signup', $u__i, notificationContent('new-signup'), null, null ,'signup');
				//DO LOGIN
				$check_login = $this->db->query("SELECT * FROM `users` where LOWER(`email`) = '".strtolower($email_to_check)."' AND `password` = '".md5($this->input->post('password'))."'");
				$ceck_count = $check_login->num_rows();
				if($ceck_count > 0){
					$row = $check_login->result_object()[0];
					$_SESSION["LISTYLOGIN"] = $row;
				}

				$url_click = base_url()."do/verify/email/".($rendomcode);
				$emailTemplate = $this->db->where('code', 'signup-email')->get('email_template')->row();
				// $message = '
				// 	<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$this->input->post('fname').'</strong>,<br /><br/>
				// 			'.$emailTemplate->content.'


				// 		<a href='.$url_click.'>'.$url_click.'</a>
				// 		<br />	<br />	
				// 		Best Regards,
				// 		<br>
				// 		'.settings()->site_title.'</span>						
				// ';
				
				$data = [
					'content' => $emailTemplate->content,
					'instaLink' => $emailTemplate->instagram,
					'facebookLink' => $emailTemplate->facebook,
					'twitterLink' => $emailTemplate->twitter,
					'pinterestLink' => $emailTemplate->pinterest,
					'linkedinLink' => $emailTemplate->linkedin,
					'instaImage' => $this->data['assets'].'assets/images/emails/images/instagram2x.png',
					'facebookImage' => $this->data['assets'].'assets/images/emails/images/facebook2x.png',
					'twitterImage' => $this->data['assets'].'assets/images/emails/images/twitter2x.png',
					'pinterestImage' => $this->data['assets'].'assets/images/emails/images/pinterest2x.png',
					'linkedingImage' => $this->data['assets'].'assets/images/emails/images/linkedin2x.png'
				];
				
				// Load the view and get the HTML content
				$message = $this->load->view('frontend/new-email.php', $data, TRUE);
				$this->send_verification_email($row);
				$this->do_send_welcom_email(settings()->email, $email_to_check ,$emailTemplate->name , $message);


				unset($_SESSION['SIGNUPFORM']);
				unset($_SESSION['show_popup_signup']);
				$_SESSION["valid"] = "Your account has been created successfully!";
				redirect($_SERVER['HTTP_REFERER']);
		}
	}
	// Your account has been created successfully!
						// <br /><br />
						// Please click on below link to verify your email address.
						
						// <br><br>



	
	public function profile()
	{
		if(isset($_SESSION["LISTYLOGIN"])){
			$this->load->view('frontend/profile',$this->data);
		}
		
		else{
			redirect(base_url()."login");
		}
	}

												

	public function do_login(){
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$return_url = $this->input->post('return_url');

		$check_login = $this->db->query("SELECT * FROM `users` where (LOWER(`email`) = '".strtolower($email)."' OR LOWER(`username`) = '".strtolower($email)."') AND `password` = '".$password."'");
		$ceck_count = $check_login->num_rows();
		$return = isset($_SESSION['RETURN'])?$_SESSION['RETURN']:"";
		
		// If return_url is provided in the form, use it
		if($return_url && $return_url != ""){
			$return = $return_url;
		}
		
		if($ceck_count > 0){
			$row = $check_login->result_object()[0];
			if($row->status==0){
				$_SESSION["invalid"] = "Your account is blocked by admin! Please connect with administrator.";
				redirect(base_url());
				die;
			}
			unset($_SESSION['show_popup_login']);
			unset($_SESSION['show_popup_signup']);
			$_SESSION["LISTYLOGIN"] = $row;
			// redirect(base_url()."dashboard");

			
			if($return != ""){
				unset($_SESSION['RETURN']);
				redirect(base_url().$return);
			} else {
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else {
			$_SESSION["invalid"] = "Invalid Email Address or Password!";
			$_SESSION['show_popup_login'] =  1;
			if($return != ""){
				redirect(base_url().$return);
			} else {
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}


	public function forgot_password_otp(){
		if(isset($_SESSION["LISTYLOGIN"])){
			redirect(base_url());
		} else {
			if(isset($_SESSION['EMAILFORGOT'])){
				$this->load->view('frontend/forgot_otp',$this->data);
			} else {
				$_SESSION['invalid'] = 'Invalid Link or email not found!';
				redirect(base_url().'login');
			}
		}
	}

	public function validate_otp(){
		if(isset($_SESSION["LISTYLOGIN"])){
			redirect(base_url());
		} else {
			if(isset($_SESSION['EMAILFORGOT'])){
				$check_otp = $this->db->query("SELECT * FROM users WHERE LOWER(email) = '".strtolower($_SESSION['EMAILFORGOT'])."' AND otp_code = ".$this->input->post('otp'))->result_object()[0];
				if(!empty($check_otp)){
					$this->load->view('frontend/password_recover',$this->data);
				} else {
					$_SESSION['invalid'] = 'Invalid OTP Code!';
					redirect(base_url().'otp/password');
				}
				
			} else {
				$_SESSION['invalid'] = 'Invalid Link or email not found!';
				redirect(base_url().'login');
			}
		}
	}

	public function do_google_login(){
		require_once 'vendor/autoload.php';

		$google_app_id = '431763947394-anvjjaeadnv029919s6k02o6df8v5a4v.apps.googleusercontent.com';
		$google_app_secret = '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';

		$google_callbackurl   =  base_url().'nepstate/do_google_login';

		$google_client = new Google_Client();
		$google_client->setClientId($google_app_id);
		$google_client->setClientSecret($google_app_secret);

		$google_client->setRedirectUri($google_callbackurl);

		$google_client->addScope('email');
		$google_client->addScope('profile');



		if (isset($_GET["code"])) {

	    //It will Attempt to exchange a code for an valid authentication token.
		    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

		    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
		    if (!isset($token['error'])) {
		        $google_client->setAccessToken($token['access_token']);
		        $google_service = new Google_Service_Oauth2($google_client);
		        //Get user profile data from google
		        $data = $google_service->userinfo->get();


		        	$email_to_check = $data['email'];
					$username_to_check = $data['id'];


					$check_user = $this->db->query("SELECT * FROM users WHERE email = '".$email_to_check."'")->num_rows();
					if($check_user > 0){

					}  else {
						$rendomcode = $this->generateRandomString(25);
						$arr = array(
							'name' => $data['name'],
							'username'=> trim($username_to_check),
							'email'=> trim($email_to_check),
							'password'=> md5($username_to_check),
							'created_at'=> date("Y-m-d H:i:s"),
							'status'=> 1,
							'verify_email' => 1,
							'g_id' => $username_to_check,
							'profile_pic' => $data['picture']
						);
						
						if(userCountryId()  && userCityId()) {
							$arr['country_id'] = userCountryId();
							$arr['city_id'] = userCityId();
						}else if(userCountryId()  && !userCityId()) {
							$arr['country_id'] = userCountryId();
						}

						
						$this->db->insert('users',$arr);

						// DO SEND WELCOME EMAIL
						$message = '
							<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$data['name'].'</strong>,<br /><br/>
								Welcome to Netstate.
								<br><br>
								Your account has been created & verified successfully as you have loggedin with an Google account!
								
								<br />	<br />	
								Best Regards,
								<br>
								'.settings()->site_title.'</span>						
						';
						$this->do_send_email(settings()->email, $email_to_check, 'NepState - Account Created Confirmation', $message, 0);
						$emailTemplate = $this->db->where('code', 'signup-email')->get('email_template')->row();

						$data = [
							'content' => $emailTemplate->content,
							'instaLink' => $emailTemplate->instagram,
							'facebookLink' => $emailTemplate->facebook,
							'twitterLink' => $emailTemplate->twitter,
							'pinterestLink' => $emailTemplate->pinterest,
							'linkedinLink' => $emailTemplate->linkedin,
							'instaImage' => $this->data['assets'].'assets/images/emails/images/instagram2x.png',
							'facebookImage' => $this->data['assets'].'assets/images/emails/images/facebook2x.png',
							'twitterImage' => $this->data['assets'].'assets/images/emails/images/twitter2x.png',
							'pinterestImage' => $this->data['assets'].'assets/images/emails/images/pinterest2x.png',
							'linkedingImage' => $this->data['assets'].'assets/images/emails/images/linkedin2x.png'
						];
						
						// Load the view and get the HTML content
						$message = $this->load->view('frontend/new-email.php', $data, TRUE);
						
						$this->do_send_welcom_email(settings()->email, $email_to_check ,$emailTemplate->name , $message);

					}

					unset($_SESSION['show_popup_login']);
					unset($_SESSION['show_popup_signup']);

					//DO LOGIN
					$check_login = $this->db->query("SELECT * FROM `users` where LOWER(`email`) = '".strtolower($email_to_check)."' AND `g_id` = '".($username_to_check)."'");
					$ceck_count = $check_login->num_rows();

					$return = isset($_SESSION['RETURN'])?$_SESSION['RETURN']:"";
					if($ceck_count > 0){
						$row = $check_login->result_object()[0];
						$_SESSION["LISTYLOGIN"] = $row;
						if($return != ""){
							redirect(base_url().$return);
						} else {
							redirect(base_url()."dashboard");
						}

					} else {
						$_SESSION['invalid'] = "Account with this email address already registered without Google Accoun!";
		        		redirect(base_url());
					}
		        
		    } else {
		        $_SESSION['invalid'] = "Your token has expired! Please try again!";
		        redirect(base_url());
		    }
		}
	}

	public function resend_verification_email(){
		if(isset($_SESSION['LISTYLOGIN'])){
			$rendomcode = $this->generateRandomString(25);
			$arr = array(
				'session_id'=> $rendomcode,
			);
			$this->db->where('id', user_info()->id);
			$this->db->update('users',$arr);

			$row = $this->db->query("SELECT * FROM `users` where id = ".user_info()->id)->result_object()[0];
			$url_click = base_url()."do/verify/email/".($rendomcode);
			$message = '
				<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$row->name.'</strong>,<br /><br/>
					Your account has been created successfully!
					<br /><br />
					Please click on below link to verify your email address.
					
					<br><br>
					<a href='.$url_click.'>'.$url_click.'</a>
					<br />	<br />	
					Best Regards,
					<br>
					'.settings()->site_title.'</span>						
			';
			$this->do_send_email(settings()->email, $row->email, 'NepState - Verify Account', $message, 0);
			$_SESSION["valid"] = "Verification email has been sent successfully!";
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$_SESSION["invalid"] = "You're not loggedin!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function send_verification_email($userInfo){
		
			$rendomcode = $this->generateRandomString(25);
			$arr = array(
				'session_id'=> $rendomcode,
			);
			$this->db->where('id', $userInfo->id);
			$this->db->update('users',$arr);

			$row = $this->db->query("SELECT * FROM `users` where id = ".$userInfo->id)->result_object()[0];
			$url_click = base_url()."do/verify/email/".($rendomcode);
			$message = '
				<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$row->name.'</strong>,<br /><br/>
					Your account has been created successfully!
					<br /><br />
					Please click on below link to verify your email address.
					
					<br><br>
					<a href='.$url_click.'>'.$url_click.'</a>
					<br />	<br />	
					Best Regards,
					<br>
					'.settings()->site_title.'</span>						
			';
			$this->do_send_email(settings()->email, $row->email, 'NepState - Verify Account', $message, 0);
			
		
	}




	

	

	public function contact_us()
	{
		$this->load->view('frontend/contact_us',$this->data);
	}


	 public function do_update_profile(){
    	$this->data['title_page'] = "My Account";
    	$this->form_validation->set_rules('name', 'Name', 'trim|required');
    	$this->form_validation->set_rules('username', 'User Name', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('frontend/profile',$this->data);
		}
		else
		{
			$arr = array(
				'name'=> $this->input->post('name'),
				'username'=> $this->input->post('username'),
				// 'mobile'=> $this->input->post('mobile'),
			);

			$input = "logo";
	        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	        	
	        	$image = $this->image_upload($input,'./resources/uploads/profiles/','jpg|jpeg|png|gif');
		        if($image['upload'] == true || $_FILES[$input]['size']<1){
		            $image = $image['data'];
		            $arr['profile_pic'] = base_url().'resources/uploads/profiles/'.$image['file_name'];
		        }
	    	}

			$this->db->where('id', user_info()->id);
			$this->db->update('users',$arr);
			$_SESSION["valid"] = "Profile has been updated successfully.";
			redirect(base_url()."profile");
		}
    }


	public function free_membership($id){
		if(isset($_SESSION["LISTYLOGIN"])){
			$plan = $this->db->query("SELECT * FROM subscription_plans WHERE id = ".$id)->result_object()[0];
			$today = date("Y-m-d");
	    	$new_date = date('Y-m-d', strtotime($plan->days_included.' days', strtotime($today)));

	    	$arry = array(
	            "payment_done"=>1,
	            "subscription" => 1,
	            "subscriptin_status" => 1,
	            "subscription"=>$plan->id,
	            "date_subscription" => $today,
	            "paid_by" => "Free",
	            "subscriptin_expiry" => $new_date
	        );
	        $this->db->where("id",user_info()->id)->update("users",$arry);
		    $_SESSION['valid'] = "Your subscription has been started successfully!";
		    redirect(base_url());
		} else {
			redirect(base_url()."login");
		}
	}

	public function do_payment_subscription($id){
    	if($_SERVER['REQUEST_METHOD'] == 'POST'){
    		$product = $this->db->query("SELECT * FROM subscription_plans WHERE id = ".$id)->result_array()[0];
    		$plan = $this->db->query("SELECT * FROM subscription_plans WHERE id = ".$id)->result_object()[0];

			// Buyer information
			$name = $_POST['name_on_card'];
			$nameArr = explode(' ', $name);
			$firstName = !empty($nameArr[0])?$nameArr[0]:'';
			$lastName = !empty($nameArr[1])?$nameArr[1]:'';
			// $city = 'Charleston';
			// $zipcode = '25301';
			$countryCode = 'US';
			
			// Card details
			$creditCardNumber = trim(str_replace(" ","",$_POST['card_number']));
			$creditCardType = $_POST['card_type'];
			$expMonth = $_POST['expiry_month'];
			$expYear = $_POST['expiry_year'];
			$cvv = $_POST['cvv'];
			
			// Load PaypalPro library
			$this->load->library('PaypalPro');
			
			// Payment details
			$paypalParams = array(
				'paymentAction' => 'Sale',
				'itemName' => $product['title'],
				'itemNumber' => $product['id'],
				'amount' => $product['price'],
				'currencyCode' => 'USD',
				'creditCardType' => 'Visa',
				'creditCardNumber' => $creditCardNumber,
				'expMonth' => $expMonth,
				'expYear' => $expYear,
				'cvv' => $cvv,
				'firstName' => $firstName,
				'lastName' => $lastName,
				// 'city' => $city,
				// 'zip'	=> $zipcode,
				'countryCode' => $countryCode,
			);
			$response = $this->paypalpro->paypalCall($paypalParams);
			$paymentStatus = strtoupper($response["ACK"]);
			// echo "<pre>";
			// print_r($response);
			// die;
			if($paymentStatus == "SUCCESS"){
				// Transaction info
				$transactionID = $response['TRANSACTIONID'];
				$paidAmount = $response['AMT'];
				$currency = $response['CURRENCYCODE'];

				$today = date("Y-m-d");
		    	$new_date = date('Y-m-d', strtotime($plan->days_included.' days', strtotime($today)));

		    	$arry = array(
		            "payment_done"=>1,
                    "subscription" => 1,
                    "subscriptin_status" => 1,
                    "subscription" =>$plan->id,
                    "payment_object"=>json_encode($response),
                    "date_subscription" => $today,
                    "paid_by" => "Credit Card",
                    "subscriptin_expiry" => $new_date
		        );
				
		        $this->db->where("id",user_info()->id)->update("users",$arry);
				$_SESSION['valid'] = "Your subscription has been started successfully!";
		    	redirect(base_url());

			}else{
				$_SESSION['invalid'] = $response['L_LONGMESSAGE0'];
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
    }

	public function charge_payment($id){
        require_once('vendor/autoload.php');
        $plan = $this->db->query("SELECT * FROM subscription_plans WHERE id = ".$id)->result_object()[0];
        $price = $plan->price;
        if($price > "0") {
            $price = $price * 100;
            \Stripe\Stripe::setApiKey('sk_test_zMO3MByh3kZKQJQr6xXAXqK7');
            $token = $_POST['stripeToken'];
            // Create a Customer
            $customer = \Stripe\Customer::create(array(
                "email" => user_info()->email,
                "source" => $token,
            ));
            // Save the customer id in your own database!
            // Charge the Customer instead of the card

            try {
                $charge = \Stripe\Charge::create(array(
                    "amount" => $price,
                    "currency" => "usd",
                    "customer" => $customer->id
                ));
            } catch (\Stripe\Error\InvalidRequest $e) {
                $_SESSION['invalid'] = "Some Error Occured, Please try again.";
                redirect($_SERVER['HTTP_REFERER']);
                exit();

            } catch (\Stripe\Error\Base $e) {
                //Send User to Error Page
                $_SESSION['invalid'] = "Some Error Occured, Please try again.";
                redirect($_SERVER['HTTP_REFERER']);
                exit();

            } catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught

                $body = $e->getJsonBody();
                $err  = $body['error'];
                $_SESSION['invalid'] = $err;
                redirect($_SERVER['HTTP_REFERER']);
                exit();
            } catch (Exception $e) {
                //Send User to Error Page
                $_SESSION['invalid'] = "Some Error Occured, Please try again.";
                redirect($_SERVER['HTTP_REFERER']);
                exit();

            };

            if($charge->status == "succeeded"){
            	$today = date("Y-m-d");
            	$new_date = date('Y-m-d', strtotime($plan->days_included.' days', strtotime($today)));

                $this->db->where("id",user_info()->id)->update("users",array(
                    "payment_done"=>1,
                    "subscription" => 1,
                    "subscriptin_status" => 1,
                    "subscription"=>$plan->id,
                    "payment_object"=>json_encode($charge),
                    "date_subscription" => $today,
                    "paid_by" => "Credit Card",
                    "subscriptin_expiry" => $new_date
                ));
               $_SESSION['valid'] = "Your subscription has been started successfully!";
               redirect(base_url());
            } else {
                $this->db->where("id",$id)->update("users",array(
                    "payment_done"=>0,
                    "payment_object"=>json_encode($charge)
                ));
                redirect(base_url()."pay/now".$id);
            }

        }
    }


    public function collection_hub(){
    	if(isset($_SESSION["LISTYLOGIN"])){
			$this->load->view('frontend/collection_hub',$this->data);
		} else {
			redirect(base_url()."login");
		}
    }

    public function manage_collection($unique_id){
    	if(isset($_SESSION["LISTYLOGIN"])){
			if($unique_id!=""){
				$request = $this->db->query("SELECT * FROM collection_data WHERE unique_id = '".$unique_id."' AND uID = ".user_info()->id)->result_object()[0];
				if(!empty($request)){
					$_SESSION['COLLECTION_UNIQUE_ID'] = $unique_id;
					redirect(base_url()."collection/personal");
				} else {
					$_SESSION["invalid"] = "You are not authorized to this collection.";
					redirect(base_url()."collection/hub");
				}
			} else {
				$_SESSION["invalid"] = "Invalid Request.";
				redirect(base_url()."collection/hub");
			}
		} else {
			redirect(base_url()."login");
		}
    }

    public function manage_collection_view($unique_id){
    	if(isset($_SESSION["LISTYLOGIN"])){
			if($unique_id!=""){
				$request = $this->db->query("SELECT * FROM collection_data WHERE unique_id = '".$unique_id."' AND uID = ".user_info()->id)->result_object()[0];
				if(!empty($request)){
					$_SESSION['COLLECTION_UNIQUE_ID'] = $unique_id;
					$_SESSION['COLLECTION_VIEW'] = 1;
					redirect(base_url()."view/personal/collection");
				} else {
					$_SESSION["invalid"] = "You are not authorized to this collection.";
					redirect(base_url()."collection/hub");
				}
			} else {
				$_SESSION["invalid"] = "Invalid Request.";
				redirect(base_url()."collection/hub");
			}
		} else {
			redirect(base_url()."login");
		}
    }

    public function do_check_percentage_and_get_data($table){
    	// echo $_SESSION['COLLECTION_UNIQUE_ID'];
    	// die;
    		if(isset($_SESSION['COLLECTION_UNIQUE_ID'])) {
    			$get_collection = $this->db->query("SELECT * FROM collection_data WHERE unique_id = '".$_SESSION['COLLECTION_UNIQUE_ID']."' AND uID = ".user_info()->id."")->result_object()[0];

    		} else {
    			$get_collection = $this->db->query("SELECT * FROM collection_data WHERE percent_complete != '100' AND uID = ".user_info()->id." ORDER BY id DESC LIMIT 1")->result_object()[0];
    		}

    		if(empty($get_collection)){
    			$un___id = $this->generateRandomString(10);
    			$dbData['uID']       	= user_info()->id;
		        $dbData['unique_id']    = $un___id;
		        $dbData['started_date'] = date('Y-m-d H:i:s');
		        $this->db->insert('collection_data',$dbData);
		        $unique_id = $un___id;
    		} else {
    			$unique_id = $get_collection->unique_id;
    		}

    		$this->data['uniquee_idd'] = $unique_id;

    		$personal_data = $this->db->query("SELECT * FROM ".$table." WHERE uID = ".user_info()->id." AND cID = '".$unique_id."'")->result_object()[0];
    		$this->data['personal_data'] = $personal_data;
    }

    public function do_update_percentage($unique_id){
    		$get_collection = $this->db->query("SELECT * FROM collection_data WHERE unique_id = '".$unique_id."' AND uID = ".user_info()->id."")->result_object()[0];
    		$old_collection = $get_collection->percent_complete;
    		$new_collection = (100/5);
    		$percent_add = round(($old_collection + $new_collection),2);

    		if($percent_add > 100){
    			$percent_add = "100";
    		}

			$arr = array(
				'percent_complete'	=> $percent_add,
			);
			$this->db->where('unique_id', $unique_id);
			$this->db->update('collection_data',$arr);
    }


    public function personal(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['title'] = 'Personal Data';
    		//$this->do_check_percentage_and_get_data('collection_personal');
    		//$unique_id = $this->data['uniquee_idd'];
    		//$personal_data = $this->data['personal_data'];

    		$personal_data = $this->db->query("SELECT * FROM collection_personal WHERE uID = ".user_info()->id)->result_object()[0];
    		$this->data['personal_data'] = $personal_data;

    		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
	    	$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
	    	$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
	    	$this->form_validation->set_rules('mobile', 'Phone Number', 'trim|required');
	    	$this->form_validation->set_rules('occupation', 'Occupation', 'trim|required');
	    	$this->form_validation->set_rules('religion', 'Religion', 'trim|required');
	    	if(empty($personal_data)){
	    		if (empty($_FILES['logo']['name']))
				{
	    			$this->form_validation->set_rules('logo', 'Body Picture', 'trim|required');
	    		}
	    	}

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('frontend/personal',$this->data);
			}
			else
			{
				$arr = array(
					'uID'			=> user_info()->id,
					'cID'			=> "123",
					'first_name'	=> $this->input->post('fname'),
					'last_name'		=> $this->input->post('lname'),
					'sex'			=> $this->input->post('sex'),
					'age'			=> $this->input->post('age'),
					'dob'			=> $this->input->post('dob'),
					'mailing_address'	=> $this->input->post('mailing_address')!=""?$this->input->post('mailing_address'):null,
					'mobile'		=> $this->input->post('mobile'),
					'occupation'	=> $this->input->post('occupation'),
					'religion'		=> $this->input->post('religion'),
				);

				$input = "logo";
		        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
		        	$image = $this->image_upload($input,'./resources/uploads/collection/','jpg|jpeg|png|gif');
			        if($image['upload'] == true || $_FILES[$input]['size']<1){
			            $image = $image['data'];
			            $arr['body_picture'] = base_url().'resources/uploads/collection/'.$image['file_name'];
			        }
		    	}

				if(empty($personal_data)){
					// $this->do_update_percentage($unique_id);
					$this->db->insert('collection_personal',$arr);
				} else {
					// $this->db->where('cID', $unique_id);
					$this->db->where('uID', user_info()->id);
					$this->db->update('collection_personal',$arr);
				}
				redirect(base_url()."collection/clinical/data");
			}
		} else {
			redirect(base_url()."login");
		}
    }

    public function collection_clinical(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['title'] = 'Clinical Data';
    		$this->do_check_percentage_and_get_data('collection_clinical');
    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];
    		$this->load->view('frontend/collection_clinical',$this->data);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function get_test_display($id){
		if(isset($_SESSION["LISTYLOGIN"])){
			$this->data['id'] = $id;
			$this->data['time'] = time();
			echo $this->load->view('frontend/common/get_labortart_test',$this->data,true);
		} else {
			$_SESSION["invalid"] = "You are not loggedin, your chat has been ended";
			echo 999999;
		}
	}

    
   

    

    

    // public function collection_nutrition_protein(){
    // 	if(isset($_SESSION["LISTYLOGIN"])){
    // 		$this->data['show_range_slider'] = 1;
    // 		$this->data['title'] = 'Nutrition';
    		

    // 		$this->do_check_percentage_and_get_data('collection_nutrition');
    // 		$unique_id = $this->data['uniquee_idd'];
    // 		$personal_data = $this->data['personal_data'];
    // 		$this->load->view('frontend/collection_nutrition',$this->data);
    // 	} else {
    // 		redirect(base_url()."login");
    // 	}
    // }
    public function collection_behavior(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['title'] = 'Behavior';
    		$this->data['title_behav'] = "Sleep";
    		$this->do_check_percentage_and_get_data('collection_behavior');
    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];
    		$this->load->view('frontend/collection_behavior',$this->data);
    	} else {
    		redirect(base_url()."login");
    	}
    }
    public function do_submit_behavior(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->do_check_percentage_and_get_data('collection_behavior');

    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];

    		$arr_push['behavior_step_1'] = json_encode($_POST);
    		$arr_push['submitted_at'] = date("Y-m-d");
    		
			if(empty($personal_data)){
				$arr_push['uID'] = user_info()->id;
    			$arr_push['cID'] = $unique_id;
				$this->db->insert('collection_behavior',$arr_push);
			} else {
				$this->db->where('cID', $unique_id);
				$this->db->where('uID', user_info()->id);
				$this->db->update('collection_behavior',$arr_push);
			}
			redirect(base_url()."collection/behavior/sleep");

    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function collection_behavior_sleep(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['title'] = 'Behavior';
    		$this->data['title_behav'] = "Stress";
    		$this->do_check_percentage_and_get_data('collection_behavior');
    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];
    		$this->load->view('frontend/collection_behavior_sleep',$this->data);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_submit_behavior_sleep(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->do_check_percentage_and_get_data('collection_behavior');

    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];

    		$arr_push['behavior_sleep'] = json_encode($_POST);
    		$arr_push['sleeping_points'] = $this->input->post('points_calculated');
    		$arr_push['submitted_at'] = date("Y-m-d");
			if(empty($personal_data)){
				$arr_push['uID'] = user_info()->id;
    			$arr_push['cID'] = $unique_id;
				$this->db->insert('collection_behavior',$arr_push);
			} else {
				$this->db->where('cID', $unique_id);
				$this->db->where('uID', user_info()->id);
				$this->db->update('collection_behavior',$arr_push);
			}
			redirect(base_url()."collection/behavior/smoking");

    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function collection_behavior_smoking(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['title'] = 'Behavior';
    		$this->data['title_behav'] = "Smoking";
    		$this->do_check_percentage_and_get_data('collection_behavior');
    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];
    		$this->load->view('frontend/collection_behavior_smoking',$this->data);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_submit_behavior_smoking(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->do_check_percentage_and_get_data('collection_behavior');

    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];

    		$arr_push['behavior_smoking'] = json_encode($_POST);
    		$arr_push['smoking_points'] = $this->input->post('points_calculated');
    		$arr_push['submitted_at'] = date("Y-m-d");
			if(empty($personal_data)){
				$arr_push['uID'] = user_info()->id;
    			$arr_push['cID'] = $unique_id;
				$this->db->insert('collection_behavior',$arr_push);
			} else {
				$this->db->where('cID', $unique_id);
				$this->db->where('uID', user_info()->id);
				$this->db->update('collection_behavior',$arr_push);
			}
			redirect(base_url()."collection/behavior/alcohol");

    	} else {
    		redirect(base_url()."login");
    	}
    }

     public function collection_behavior_alcohol(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['title'] = 'Behavior';
    		$this->data['title_behav'] = "Alcohol";
    		$this->do_check_percentage_and_get_data('collection_behavior');
    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];
    		$this->load->view('frontend/collection_behavior_alcohol',$this->data);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_submit_behavior_alcohol(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->do_check_percentage_and_get_data('collection_behavior');

    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];

    		$arr_push['behavior_alcohol'] = json_encode($_POST);
    		$arr_push['alcohol_points'] = $this->input->post('points_calculated');
    		$arr_push['percent_update'] = 1;
    		$arr_push['submitted_at'] = date("Y-m-d");

			if(empty($personal_data)){
				$arr_push['uID'] = user_info()->id;
    			$arr_push['cID'] = $unique_id;
				$this->db->insert('collection_behavior',$arr_push);
			} else {

				if($personal_data->percent_update==0){
					$this->do_update_percentage($unique_id);
				}

				$this->db->where('cID', $unique_id);
				$this->db->where('uID', user_info()->id);
				$this->db->update('collection_behavior',$arr_push);
			}
			redirect(base_url()."analytics");

    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function collection_nutrition($page=""){

    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['show_range_slider'] = 1;
    		$this->data['title'] = 'Nutrition';

    		if($page == "protein"){
    			$this->data['title_nuti'] = "Protein";
	    		$this->data['page'] = "protein";
	    		$this->data['page_head'] = "PROTEIN QUANTITY";
	    		$this->data['page_p'] = "In the past week, how many servings of the following protein sources did you consume in <b>total for the week</b>?";
    		} else if($page == "fats"){
    			$this->data['title_nuti'] = "Fats";
	    		$this->data['page'] = "fats";
	    		$this->data['page_head'] = "FAT QUANTITY";
	    		$this->data['page_p'] = "In the past week, how many servings of the following fat sources did you consume on average <b>per day</b>?";
    		} 
    		else if($page == "grains"){
    			$this->data['title_nuti'] = "Grains";
	    		$this->data['page'] = "grains";
	    		$this->data['page_head'] = "GRAIN QUANTITY";
	    		$this->data['page_p'] = "In the past week, how many servings of the following grains did you consume on average <b>per day</b>?";
    		} 
    		else if($page == "other"){
    			$this->data['title_nuti'] = "Other";
	    		$this->data['page'] = "other";
	    		$this->data['page_head'] = "BEVERAGE QUANTITY";
	    		$this->data['page_p'] = "In the past week, how many servings of the following beverages did you consume on average <b>per day</b>?";
    		} 
    		else if($page == "habits"){
    			$this->data['title_nuti'] = "Habits";
	    		$this->data['page'] = "habits";
	    		$this->data['page_head'] = "HABITS QUANTITY";
	    		$this->data['page_p'] = "";
    		} 
    		else {
	    		$this->data['title_nuti'] = "Plant Food";
	    		$this->data['page'] = "plant_food";
	    		$this->data['page_head'] = "PLANT FOOD QUANTITY";
	    		$this->data['page_p'] = "In the past week, how many servings of the following plant foods did you consume on average <b>per day</b>?";
    		}

    		$this->do_check_percentage_and_get_data('collection_nutrition');
    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];
    		$this->load->view('frontend/collection_nutrition',$this->data);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_save_nutrition_plant($page){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->do_check_percentage_and_get_data('collection_nutrition');
    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];

    		if($page == "plant_food"){
    			$array_food = plat_food();
				$redirect = "protein";
			}
			else if($page == "protein"){
				$array_food = protein_food();
				$redirect = "fats";
			} 
			else if($page == "fats"){
				$array_food = fats_food();
				$redirect = "grains";
			}
			else if($page == "grains"){
				$array_food = grains_food();
				$redirect = "other";
			}
			else if($page == "other"){
				$array_food = other_food();
				$redirect = "habits";
			}
			else if($page == "habits"){
				$array_food = habits_food();
				$redirect = "activity";
				$arr_push['percent_update'] = 1;
			}

    		foreach ($array_food[0] as $key => $row) {
    			$slug = slug_input($row['heading']);
    			$arr[$slug] = $this->input->post($slug);
    		}
    		foreach ($array_food[1] as $key => $row) {
    			// print_r($row);
    			$slug = slug_input($row['heading']);
    			if($row['multipe']==1){
    				if($this->input->post($slug) != null){
	    				$arr[$slug] = implode(",",$this->input->post($slug));
	    			}
    			} else {
    				$arr[$slug] = $this->input->post($slug);
    			}
    		}
    		
    		// print_r($arr);
    		// echo "</pre>";
    		// die;
    		$arr_push[$page] = json_encode($arr);
    		$arr_push['submitted_at'] = date("Y-m-d");
    		
			if(empty($personal_data)){
				$arr_push['uID'] = user_info()->id;
    			$arr_push['cID'] = $unique_id;
				$this->db->insert('collection_nutrition',$arr_push);
			} else {
				$this->db->where('cID', $unique_id);
				$this->db->where('uID', user_info()->id);
				$this->db->update('collection_nutrition',$arr_push);
			}

			
			if($page == "habits"){
				if($personal_data->percent_update==0){
					$this->do_update_percentage($unique_id);
				}
				redirect(base_url()."collection/".$redirect);
			} else {
				redirect(base_url()."collection/nutrition/".$redirect);
			}


    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function collection_activity(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['title'] = 'Activity';
    		$this->do_check_percentage_and_get_data('collection_activity');
    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];
    		$this->load->view('frontend/collection_activity',$this->data);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function collection_activity_step_2(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['title'] = 'Activity';
    		$this->do_check_percentage_and_get_data('collection_activity');
    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];
    		$this->load->view('frontend/collection_activity_2',$this->data);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_save_activity_step(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->do_check_percentage_and_get_data('collection_activity');

    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];

    		$arr_push['acyivity_step'] = json_encode($_POST);

			if(empty($personal_data)){
				$arr_push['uID'] = user_info()->id;
    			$arr_push['cID'] = $unique_id;
				$this->db->insert('collection_activity',$arr_push);
			} else {
				$this->db->where('cID', $unique_id);
				$this->db->where('uID', user_info()->id);
				$this->db->update('collection_activity',$arr_push);
			}
			redirect(base_url()."collection/activity/step/2");

    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_save_activity_step_2(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->do_check_percentage_and_get_data('collection_activity');

    		$unique_id = $this->data['uniquee_idd'];
    		$personal_data = $this->data['personal_data'];

    		$arr_push['cardio'] = json_encode($_POST);
    		$arr_push['percent_update'] = 1;
    		$arr_push['submitted_at'] = date("Y-m-d");

			if(empty($personal_data)){

				$arr_push['uID'] = user_info()->id;
    			$arr_push['cID'] = $unique_id;
				$this->db->insert('collection_activity',$arr_push);
			} else {
				if($personal_data->percent_update==0){
					$this->do_update_percentage($unique_id);
				}
				$this->db->where('cID', $unique_id);
				$this->db->where('uID', user_info()->id);
				$this->db->update('collection_activity',$arr_push);
			}
			redirect(base_url()."collection/behavior");

    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function messages($id=""){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		if(user_info()->user_type == 1){
	    		$check_admin_messages = $this->db->query("SELECT * FROM conversations WHERE user_id = ".user_info()->id." AND is_admin = 1")->result_object()[0];
	    		if(empty($check_admin_messages)){
	    			$rendomcode = $this->generateRandomString(8);
					$arr = array(
						'user_id' 	=> user_info()->id,
						'provider_id'=> 0,
						'convo_id' 	=> $rendomcode,
						'is_admin' 	=> 1,
						'created_at' => date("Y-m-d H:i:s")
					);
					$this->db->insert('conversations',$arr);
	    		}
    		} else {
    			if(user_info()->team_parent != 0){
    				redirect(base_url()."patients");
    				die;
    			}
    			$check_admin_messages = $this->db->query("SELECT * FROM conversations WHERE provider_id = ".user_info()->id." AND is_admin = 1")->result_object()[0];
	    		if(empty($check_admin_messages)){
	    			$rendomcode = $this->generateRandomString(8);
					$arr = array(
						'user_id' 	=> 0,
						'provider_id'=> user_info()->id,
						'convo_id' 	=> $rendomcode,
						'is_admin' 	=> 1,
						'created_at' => date("Y-m-d H:i:s")
					);
					$this->db->insert('conversations',$arr);
	    		}
    		}
    		$this->data['convo_id'] = $id;
    		$this->data['admin_chat_convo'] = $check_admin_messages;
    		$this->load->view('frontend/messages',$this->data);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function get_chat_display($id){

		if(isset($_SESSION["LISTYLOGIN"])){
			$this->data['id'] = $id;
			echo $this->load->view('frontend/common/chat_listing',$this->data,true);
		} else {
			$_SESSION["invalid"] = "You are not loggedin, your chat has been ended";
			echo 999999;
		}
	}

	public function get_chat_display_admin($id){
		$this->data['id'] = $id;
		echo $this->load->view('frontend/common/chat_listing_admin',$this->data,true);
	}

	public function do_start_chat($id){
		if(user_info()->user_type == 2){

			if(user_info()->team_parent != 0){
				redirect(base_url()."patients");
				die;
			}
			$check_admin_messages = $this->db->query("SELECT * FROM conversations WHERE user_id = ".$id." AND provider_id = ".user_info()->id." AND is_admin = 0")->result_object()[0];
		} else {
			$check_admin_messages = $this->db->query("SELECT * FROM conversations WHERE user_id = ".user_info()->id." AND provider_id = ".$id." AND is_admin = 0")->result_object()[0];
		}
		
    		if(empty($check_admin_messages)){
    			$rendomcode = $this->generateRandomString(8);
				$arr = array(
					'user_id' 	=> $id,
					'provider_id'=> user_info()->id,
					'convo_id' 	=> $rendomcode,
					'is_admin' 	=> 0,
					'created_at' => date("Y-m-d H:i:s")
				);
				$this->db->insert('conversations',$arr);
				$convo_id = $this->db->insert_id();
    		} else {
    			$convo_id = $check_admin_messages->convo_id;
    		}

    		redirect(base_url()."messages/".$convo_id);

	}

	public function send_chat($id){
		if(isset($_SESSION["LISTYLOGIN"])){
			$conversation = $this->db->query("SELECT * FROM conversations WHERE convo_id = '".$id."'")->result_object()[0];
			$arr = array(
				'sender_id'=> user_info()->id,
				'created_at'=> date("Y-m-d H:i:s"),
				'convo_id'=> $id,
				'sender' => 1,
				'm_read' => 0,
				'message' => ($this->input->post('chat_text')),
			);

			$input = "file";
		        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
		        	$image = $this->image_upload($input,'./resources/uploads/collection/','*');
			        if($image['upload'] == true || $_FILES[$input]['size']<1){
			            $image = $image['data'];
			            $arr['media'] = base_url().'resources/uploads/collection/'.$image['file_name'];
			        }
		    	}

			$this->db->insert('chats',$arr);
			echo "1";
		} else {
			$_SESSION["invalid"] = "You are not loggedin, your chat has been ended";
			echo 999999;
		}
	}

	public function send_admin_chat($id){
			$conversation = $this->db->query("SELECT * FROM conversations WHERE convo_id = '".$id."'")->result_object()[0];
			$arr = array(
				'sender_id'=> -1,
				'created_at'=> date("Y-m-d H:i:s"),
				'convo_id'=> $id,
				'sender' => -1,
				'm_read' => 0,
				'message' => ($this->input->post('chat_text')),
			);

			$input = "file";
		        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
		        	$image = $this->image_upload($input,'./resources/uploads/collection/','*');
			        if($image['upload'] == true || $_FILES[$input]['size']<1){
			            $image = $image['data'];
			            $arr['media'] = base_url().'resources/uploads/collection/'.$image['file_name'];
			        }
		    	}
		    	
			$this->db->insert('chats',$arr);

			if($conversation->provider_id == 0){
				$user_type = $conversation->user_id;
			} else {
				$user_type = $conversation->provider_id;
			}

			$actual_link = base_url()."messages/".$conversation->convo_id;

			$user = $this->db->query("SELECT * FROM users WHERE id = ".$user_type)->result_object()[0];
			// SEND EMAIL
			$message = '
				<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$user->first_name.'</strong>,<br /><br/>
					You have received a new message from admin.
					<br />
					Please click on below link to create your account.
					<br /><br />
					<a href='.$actual_link.'>'.$actual_link.'</a>
					<br />	<br />
					Best Regards,
					<br>
					'.settings()->site_title.'</span>						
			';
			$this->do_send_email(settings()->email, $user->email, 'New Message from admin - LMS Portal', $message, 0);

			echo "1";
	}

    public function analytics($page=""){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		if($page == ""){
    			$this->data['active_tab'] = "Biomarkers";
    		}
    		else if($page == "vitals"){
    			$this->data['active_tab'] = "Vitals & Body Composition";
    		}
    		else if($page == "nutrition"){
    			$this->data['active_tab'] = "Nutrition";
    		}
    		else if($page == "activity"){
    			$this->data['active_tab'] = "Activity";
    		}
    		else if($page == "behavior"){
    			$this->data['active_tab'] = "Behavior";
    		}

    		$this->data['page'] = $page;
    		$this->load->view('frontend/analytics',$this->data);	

    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function program(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		if(user_info()->user_type==1){
	    		if(user_info()->allow_program == 1){
	    			$this->load->view('frontend/program',$this->data);	
	    		} else {
	    			$_SESSION['invalid'] = "You don't have permission to view this page!";
	    			redirect(base_url());
	    		}
    		} else {
    			$this->load->view('frontend/program',$this->data);	
    		}
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function start_program_progress($pid, $heading_id){
    	if(isset($_SESSION["LISTYLOGIN"])){
    			$get_ = $this->db->query("SELECT * FROM user_program_progress WHERE pID = ".$pid." AND pro_head = ".$heading_id." AND uID = ".user_info()->id)->result_object()[0];
    			if(empty($get_)){
	    			$dbData['uID']       	= user_info()->id;
			        $dbData['pID']    		= $pid;
			        $dbData['pro_head']    	= $heading_id;
			        $dbData['complete']    	= 1;
			        $dbData['started_at'] 	= date('Y-m-d H:i:s');
			        $this->db->insert('user_program_progress',$dbData);
		    	}

		        redirect(base_url()."program/session/".$pid);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function session($id){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['id'] = $id;
    		$this->load->view('frontend/program_sessions',$this->data);	
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function complete_session($id){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$proram_lesson = $this->db->query("SELECT * FROM program_lessions WHERE id = ".$id)->result_object()[0];

    		$this->data['id'] = $id;

    		// $next = $this->db->query("select *
			// 	from program_lessions
			// 	where id > ".$id."
			// 	order by display_priority ASC
			// 	limit 1")->result_object()[0];

			$next = $this->db->query("select *
				from program_lessions
				where 
				(display_priority > ".$proram_lesson->display_priority." OR id > ".$id.")
				AND p_id = ".$proram_lesson->p_id."
				AND status = 1
				order by display_priority, id ASC
				limit 1")->result_object()[0];

    		if(empty($next)){
    			$next = $this->db->query("select *
				from program_lessions
				where 
				(display_priority > ".$proram_lesson->display_priority." OR p_id > ".$proram_lesson->p_id.")
		        AND status = 1
				order by display_priority, id ASC
				limit 1")->result_object()[0];
    		}

    		// $next = $this->db->query("select *
			// 	from program_lessions
			// 	where 
			// 	(display_priority > ".$proram_lesson->display_priority." OR id > ".$id.")
			// 	AND p_id = ".$proram_lesson->p_id."
			// 	AND status = 1
			// 	order by display_priority, id ASC
			// 	limit 1")->result_object()[0];

    		// if(empty($next)){
    		// 	$next = $this->db->query("select *
			// 	from program_lessions
			// 	where 
			// 	(display_priority > ".$proram_lesson->display_priority." OR id > ".$id.")
			// 	AND p_id > ".$proram_lesson->p_id."
			// 	AND status = 1
			// 	order by display_priority, id ASC
			// 	limit 1")->result_object()[0];
    		// }
    		// echo $this->db->last_query();
    		// die;
    		
			$arr = array(
				'complete' => 2,
			);
			$this->db->where('uID', user_info()->id);
			$this->db->where('pID', $id);
			$this->db->update('user_program_progress',$arr);

			// UPDATE PERCENTAGE OF USER
			$all_lessons = $this->db->query("SELECT * FROM program_lessions WHERE status = 1")->num_rows();

    		$user_complete_lessons = $this->db->query("SELECT * FROM user_program_progress WHERE complete = 2  AND uID = ".user_info()->id)->num_rows();

    		$percentage = ($user_complete_lessons/$all_lessons)*100;
    		

    		$arr = array(
				'percentage_complete' => $percentage,
			);
			$this->db->where('uID', user_info()->id);
			$this->db->update('user_program_progress',$arr);

			if(!empty($next)){

				$checl_ = $this->db->query("SELECT * FROM user_program_progress WHERE pID = ".$next->id." AND uID = ".user_info()->id)->result_object()[0];
				if(empty($checl_)){
					$dbData['uID']       	= user_info()->id;
			        $dbData['pID']    		= $next->id;
			        $dbData['pro_head']    	= $next->p_id;
			        $dbData['complete']    	= 1;
			        $dbData['started_at'] 	= date('Y-m-d H:i:s');
			        $dbData['percentage_complete'] = $percentage;
			        $this->db->insert('user_program_progress',$dbData);
		    	}
		        redirect(base_url().'program/session/'.$next->id);
			} else {
				redirect(base_url()."program");
			}
			

			

    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function recommendations(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->load->view('frontend/recommendations',$this->data);	
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function provider_recommendations($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
    		$this->data['id'] = $id;
    		$this->load->view('frontend/provider_recommendations',$this->data);	
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function add_patient_recommendations($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
    		$this->data['id'] = $id;
    		$this->load->view('frontend/add_recommendations',$this->data);	
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function patients(){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
    		$this->load->view('frontend/common/header',$this->data);
    		$this->load->view('frontend/provider/patients',$this->data);	

    	} else {
    		redirect(base_url()."login");
    	}
    }
    
    public function create_invite_link(){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
    		$randomString = $this->generateRandomString(25);
    		$today = date("Y-m-d");
	    	$new_date = date('Y-m-d', strtotime('1 days', strtotime($today)));

	    	$actual_link = base_url()."invite/".$randomString;

			$dbData['provider_id']      = user_info()->id;
	        $dbData['actual_link']    	= $randomString;
	        $dbData['created_at'] 		= date('Y-m-d');
	        $dbData['expired_at'] 		= $new_date;
	        $dbData['is_public'] 		= 1;
	        $this->db->insert('invitation',$dbData);

	        echo $actual_link;
    	}
    }

    public function do_save_team_id_session($id){
    	$_SESSION['TEAM_ID'] = $id;
    }


    public function create_team_invite_link(){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
    		$randomString = $this->generateRandomString(25);
    		$today = date("Y-m-d");
	    	$new_date = date('Y-m-d', strtotime('1 days', strtotime($today)));

	    	$actual_link = base_url()."invite/teams/".$randomString;

			$dbData['provider_id']      = user_info()->id;
			$dbData['team_id']      	= $_SESSION['TEAM_ID'];
	        $dbData['actual_link']    	= $randomString;
	        $dbData['created_at'] 		= date('Y-m-d');
	        $dbData['expired_at'] 		= $new_date;
	        $dbData['is_public'] 		= 1;
	        $this->db->insert('invitation_teams',$dbData);
	        echo $actual_link;
    	}
    }

    public function invite_teams($link){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$_SESSION['invalid'] = "You are already loggedin to the portal.";
    		redirect(base_url());
    	} else {
    		$this->data['show_header'] = 0;
    		$this->data['link'] = $link;
    		$this->load->view('frontend/invite_teams',$this->data);	
    	}
    }

     public function do_send_team_invitation(){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){

    		for($i=0; $i<=count($_POST['fname'])-1;$i++){
    			$randomString = $this->generateRandomString(25);
	    		$today = date("Y-m-d");
		    	$new_date = date('Y-m-d', strtotime('1 days', strtotime($today)));

		    	$actual_link = base_url()."invite/teams/".$randomString;
		    	$full_name = $_POST['fname'][$i]." ".$_POST['lname'][$i];

				$dbData['provider_id']      = user_info()->id;
		        $dbData['actual_link']    	= $randomString;
		        $dbData['created_at'] 		= date('Y-m-d H:i:s');
		        $dbData['expired_at'] 		= $new_date;
		        $dbData['is_public'] 		= 0;
		        $dbData['team_id']      	= $_SESSION['TEAM_ID'];
		        $dbData['first_name']      	= $_POST['fname'][$i];
		        $dbData['last_name']      	= $_POST['lname'][$i];
		        $dbData['email']      		= $_POST['email'][$i];
		        
		        $this->db->insert('invitation_teams',$dbData);

		        //SEND EMAIL TO INVITES

		        // SEND EMAIL
				$message = '
					<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$full_name.'</strong>,<br /><br/>
						You have been invited to join the Lifestyle Medicine Solutions Portal as a Care Team Member.
						<br />
						Please click on below link to create your account.
						<br /><br />
						<a href='.$actual_link.'>'.$actual_link.'</a>
						<br />	<br />
						Best Regards,
						<br>
						'.settings()->site_title.'</span>						
				';
				$this->do_send_email(settings()->email, $_POST['email'][$i], 'Invitation - LMS Portal', $message, 0);

    		}

    		$_SESSION['valid'] = "Invitation has been sent successfully!";
    		redirect(base_url()."care/team");

    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."care/team");
    	}
    }


    public function do_send_invitation(){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
    		$exists_email = array();

    		for($i=0; $i<=count($_POST['fname'])-1;$i++){

    			$chek_user = $this->db->query("SELECT * FROM users WHERE email = '".$_POST['email'][$i]."'")->num_rows();
    			if($chek_user>0){
    				$exists_email[] = $_POST['email'][$i];
    			} else {

	    			$randomString = $this->generateRandomString(25);
		    		$today = date("Y-m-d");
			    	$new_date = date('Y-m-d', strtotime('1 days', strtotime($today)));

			    	$actual_link = base_url()."invite/".$randomString;
			    	$full_name = $_POST['fname'][$i]." ".$_POST['lname'][$i];

					$dbData['provider_id']      = user_info()->id;
			        $dbData['actual_link']    	= $randomString;
			        $dbData['created_at'] 		= date('Y-m-d H:i:s');
			        $dbData['expired_at'] 		= $new_date;
			        $dbData['is_public'] 		= 0;

			        $dbData['first_name']      	= $_POST['fname'][$i];
			        $dbData['last_name']      	= $_POST['lname'][$i];
			        $dbData['email']      		= $_POST['email'][$i];
			        
			        $this->db->insert('invitation',$dbData);

			        //SEND EMAIL TO INVITES

			        // SEND EMAIL
					$message = '
						<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$full_name.'</strong>,<br /><br/>
							You have been invited to join the Lifestyle Medicine Solutions portal. 
							<br />
							Please click on below link to create your account.
							<br /><br />
							<a href='.$actual_link.'>'.$actual_link.'</a>
							<br />	<br />
							Best Regards,
							<br>
							'.settings()->site_title.'</span>						
					';
					$this->do_send_email(settings()->email, $_POST['email'][$i], 'Invitation - LMS Portal', $message, 0);
	    		}
	    	}
	    	if(!empty($exists_email)){
	    		$_SESSION['invalid_emails'] = $exists_email;
		    } else {
		    	unset($_SESSION['invalid_emails']);
		    	$_SESSION['valid'] = "Invitation has been sent successfully!";
		    }
    		
    		redirect(base_url()."patients");

    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."patients");
    	}
    }

    public function invite($link){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$_SESSION['invalid'] = "You are already loggedin to the portal.";
    		redirect(base_url());
    	} else {
    		$this->data['show_header'] = 0;
    		$this->data['link'] = $link;
    		$this->load->view('frontend/invite',$this->data);	
    	}
    }

    public function do_get_another_patient(){
		$this->data['time'] = time();
		$this->data['show_delete'] = 1;
		$this->load->view('frontend/provider/invite_form',$this->data);	
    }

    public function archive_patients(){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type == 2){
    		$this->load->view('frontend/common/header',$this->data);
    		$this->load->view('frontend/provider/archive_patients',$this->data);	
    	} else {
    		redirect(base_url()."login");
    	}
    }
   

	public function do_team_signup($link)
	{
		if(isset($_SESSION["LISTYLOGIN"])){
			redirect(base_url());
		}
		else{
				$invite_ = $this->db->query("SELECT * FROM invitation_teams WHERE actual_link = '".$link."'")->result_object()[0];

				$rendomcode = $this->generateRandomString(25);
				$arr = array(
					'first_name' => $this->input->post('fname'),
					'last_name' => $this->input->post('lname'),
					'email'=> $invite_->is_public ==1?$this->input->post('email'):$invite_->email,
					'created_at'=> date("Y-m-d H:i:s"),
					'password'=> md5($this->input->post('password')),
					'status'=> 1,
					'user_type' => 2,
					'signup_type' => 0,
					'team_parent' => $invite_->provider_id,
					'team_id' => $invite_->team_id 
				);
				$this->db->insert('users',$arr);

				// uPDATE INVITE STATUS
				if($invite_->is_public != 1){

					// $this->db->query("DELETE FROM invitation HWERE actual_link = '".$link."'");
					$arr = array(
						'status' => 2,
					);
					$this->db->where('actual_link', $link);
					$this->db->update('invitation_teams',$arr);
				}
				
				$_SESSION["valid"] = "Your account has been setup successfully!";
				redirect(base_url()."choose/type/provider");
		}
	}

	public function do_archive($id){
		if(isset($_SESSION['LISTYLOGIN'])){

			$arr = array(
					'archive' => 1,
					'archive_date' => date("Y-m-d H:i:s")
					);
			$this->db->where('id', $id);
			$this->db->update('users',$arr);
			$_SESSION["valid"] = "Patient Account Archived successfully!";
			redirect(base_url()."patients");
		} else {
			redirect(base_url()."login");
		}
	}
	public function do_bulk_archive(){
		if(isset($_SESSION['LISTYLOGIN']) && user_info()->user_type == 2){
			$bulk_id = $this->input->post('patient_ckbox');
			echo count($bulk_id);
			for($i=0;$i<=count($bulk_id)-1;$i++){
				$arr = array(
						'archive' => 1,
						'archive_date' => date("Y-m-d H:i:s")
						);
				$this->db->where('id', $bulk_id[$i]);
				$this->db->update('users',$arr);
			}
			$_SESSION["valid"] = "Patients Account Archived successfully!";
			redirect(base_url()."patients");
		} else {
			redirect(base_url()."login");
		}
	}
	public function do_uarchive($id){
		if(isset($_SESSION['LISTYLOGIN'])){

			$arr = array(
					'archive' => 0,
					'archive_date' => null
					);
			$this->db->where('id', $id);
			$this->db->update('users',$arr);
			$_SESSION["valid"] = "Patient Account un-Archived successfully!";
			redirect(base_url()."patients");
		} else {
			redirect(base_url()."login");
		}
	}

	public function profile_patient($id)
	{
		if(isset($_SESSION["LISTYLOGIN"])){
    		$this->data['id'] = $id;
    		$this->data['show_header_footer'] = 1;
    		$this->load->view('backend/users/collection_details',$this->data);	
    	} else {
    		redirect(base_url()."login");
    	}
	}

	public function lifestyle_profile_patient($page="", $id){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		if($page == "biomarkers"){
    			$this->data['active_tab'] = "Biomarkers";
    		}
    		else if($page == "vitals"){
    			$this->data['active_tab'] = "Vitals & Body Composition";
    		}
    		else if($page == "nutrition"){
    			$this->data['active_tab'] = "Nutrition";
    		}
    		else if($page == "activity"){
    			$this->data['active_tab'] = "Activity";
    		}
    		else if($page == "behavior"){
    			$this->data['active_tab'] = "Behavior";
    		}

    		$this->data['page'] = $page;
    		$this->data['id'] = $id;
    		$user_details = $this->db->query("SELECT * FROM users WHERE id = ".$id)->result_object()[0];
    		$this->data['user_'] = $user_details;
    		$this->data['title_any'] = "Patient Lifestyle Profile -::- ".$user_details->first_name." ".$user_details->last_name;
    		$this->load->view('frontend/analytics',$this->data);	

    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function delete_invitation($email, $pid){
    	if(isset($_SESSION['LISTYLOGIN']) && user_info()->user_type == 2){
			$this->db->query("DELETE FROM invitation WHERE email = '".$email."' AND provider_id = ".$pid);
			$_SESSION["valid"] = "Patients invitation removed successfully!";
			redirect(base_url()."patients");
		} else {
			$_SESSION['invalid'] = "You are not authorized to do this action";
			redirect(base_url()."patients");
		}
    }

    public function disconnect_patient($id){
    	if(isset($_SESSION['LISTYLOGIN']) && user_info()->user_type == 2){

    		$get_user = $this->db->query("SELECT * FROM users WHERE id = ".$id)->result_object()[0];

    		$this->db->query("DELETE FROM invitation WHERE email = '".$get_user->email."' AND provider_id = ".user_info()->id);
    		
			$arr = array(
				'assign_provider' => 0,
			);
			$this->db->where('id', $id);
			$this->db->update('users',$arr);


			$_SESSION["valid"] = "Patients disconnected from your list!";
			redirect(base_url()."patients");
		} else {
			$_SESSION['invalid'] = "You are not authorized to do this action";
			redirect(base_url()."patients");
		}
    }

    public function provider_analytics(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->load->view('frontend/provider_analytics',$this->data);	
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function meetings(){
    	if(isset($_SESSION["LISTYLOGIN"])){
    		$this->load->view('frontend/meetings',$this->data);	
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_save_meeting_link(){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){


			$dbData['uID']      		= user_info()->id;
	        $dbData['meeting_date']    	= $this->input->post('meeting_date');
	        $dbData['created_at'] 		= date('Y-m-d H:i:s');
	        $dbData['meeting_time'] 	= $this->input->post('meeting_time');
	        $dbData['meeting_link'] 	= $this->input->post('meeting_link');

	        $this->db->insert('meetings',$dbData);

    		$_SESSION['valid'] = "Meeting link has been saved successfully!";
    		redirect(base_url()."meetings");

    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."meetings");
    	}
    }


    public function do_delete_meeting($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){

			$this->db->query("DELETE FROM meetings WHERE id = ".$id);

    		$_SESSION['valid'] = "Meeting deleted successfully!";
    		redirect(base_url()."meetings");

    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."meetings");
    	}
    }

    public function do_update_meeting($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
			
	        $dbData['meeting_date']    	= $this->input->post('meeting_date');
	        $dbData['meeting_time'] 	= $this->input->post('meeting_time');
	        $dbData['meeting_link'] 	= $this->input->post('meeting_link');

	        $this->db->where('uID', user_info()->id);
	        $this->db->where('id', $id);
			$this->db->update('meetings',$dbData);

    		$_SESSION['valid'] = "Meeting information updated successfully!";
    		redirect(base_url()."meetings");
    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."meetings");
    	}
    }

    public function do_update_team_name($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
			
	        $dbData['name']    	= $this->input->post('team_name');

	        $this->db->where('provider_id', user_info()->id);
	        $this->db->where('id', $id);
			$this->db->update('teams',$dbData);

    		$_SESSION['valid'] = "Team information updated successfully!";
    		redirect(base_url()."care/team");
    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."care/team");
    	}
    }

    public function do_save_team_name(){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
			$dbData['provider_id'] = user_info()->id;
	        $dbData['name']    	= $this->input->post('team_name');
	        $this->db->insert('teams',$dbData);

    		$_SESSION['valid'] = "Team name has been saved successfully!";
    		redirect(base_url()."care/team");

    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."care/team");
    	}
    }


    public function delete_team($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
			$this->db->query("DELETE FROM teams WHERE id = ".$id." AND provider_id = ".user_info()->id);
    		$_SESSION['valid'] = "Team deleted successfully!";
    		redirect(base_url()."care/team");
    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."care/team");
    	}
    }

    public function do_delete_team_member_account($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
			$this->db->query("DELETE FROM users WHERE id = ".$id);
    		$_SESSION['valid'] = "Team member deleted successfully!";
    		redirect(base_url()."care/team");
    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."care/team");
    	}
    }

    public function do_get_teams_dropdwon(){
    	$teams = $this->db->query("SELECT * FROM teams WHERE provider_id = ".user_info()->id." ORDER BY id DESC")->result_object();
    	$html = '<select name="assign_team" required class="form-control custom_input">';
    	$html .= '<option value="0">--Not Assign--</option>';
    	foreach($teams as $key=>$row){
    		$html .= '<option value="'.$row->id.'">'.$row->name.'</option>';
    	}
    	$html .= '</select>';

    	echo $html;
    }

    public function do_assign_team_id($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
			
			$dbData['team_id']    	= $this->input->post('assign_team');
	        $this->db->where('id', $id);
			$this->db->update('users',$dbData);

    		$_SESSION['valid'] = "Team has been assigned successfully!";
    		redirect(base_url()."patients");
    	} else {
    		$_SESSION['invalid'] = "Invalid Access";
    		redirect(base_url()."patients");
    	}
    }

    public function do_submit_recommendations($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
	        $dbData['medication_intake'] 	= $this->input->post('medication_intake')?$this->input->post('medication_intake'):0;
	        $dbData['additional_medication'] = nl2br($this->input->post('additional_medication'));
	        $dbData['nutrition_phase'] 		= $this->input->post('nutrition_phase')?$this->input->post('nutrition_phase'):0;


	        $dbData['nutrition_image'] = $this->input->post('nutrition_image')?$this->input->post('nutrition_image'):0;
	        $dbData['additional_nutrition'] = nl2br($this->input->post('additional_nutrition'));

	        $dbData['physica_phase'] 		 = implode(",",$this->input->post('physica_phase'));
	        $dbData['additional_physical'] = nl2br($this->input->post('additional_physical'));

	        $dbData['sleep_phase'] = implode(",",$this->input->post('sleep_phase'));
	        $dbData['additional_sleep'] = nl2br($this->input->post('additional_sleep'));
	        $dbData['sleep_image'] = $this->input->post('sleep_image')?$this->input->post('sleep_image'):0;

	        $dbData['nicotine_image'] = $this->input->post('nicotine_image')?$this->input->post('nicotine_image'):0;
	        $dbData['additional_nicotine'] = nl2br($this->input->post('additional_nicotine'));

	        $dbData['stress_image'] = $this->input->post('stress_image')?$this->input->post('stress_image'):0;
	        $dbData['additional_stress'] = nl2br($this->input->post('additional_stress'));

	        $dbData['social_image'] = $this->input->post('social_image')?$this->input->post('social_image'):0;
	        $dbData['additional_social'] = nl2br($this->input->post('additional_social'));

	        $dbData['appointments_phase'] = implode(",",$this->input->post('appointments_phase'));
	        $dbData['appointment_followup'] = $this->input->post('appointment_followup');
	        $dbData['appointment_shared'] = $this->input->post('appointment_shared');
	        $dbData['additional_appointments'] = nl2br($this->input->post('additional_appointments'));

	        $dbData['uID'] = $id;
	        $dbData['provider_id'] = user_info()->id;
	        $dbData['created_at'] = date("Y-m-d");
	        
	        // echo "<pre>";
	        // print_r($dbData);
	        // die;
	        $this->db->insert('user_recommendations',$dbData);

    		$_SESSION['valid'] = "Meeting information updated successfully!";
    		redirect(base_url()."provider/recommendations/".$id);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function care_team(){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
    		$this->load->view('frontend/care_team',$this->data);	
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_submit_patient_response($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==1){

    		$get_res = $this->db->query("SELECT * FROM user_recommendations WHERE id = ".$id)->result_object()[0];

    		$dbData['patient_medication_response'] = $this->input->post('patient_medication_response')!=""?nl2br($this->input->post('patient_medication_response')):$get_res->patient_medication_response;
	        $dbData['patient_nutrition_response'] 	= $this->input->post('patient_nutrition_response')!=""?nl2br($this->input->post('patient_nutrition_response')):$get_res->patient_nutrition_response;
	        $dbData['patient_physical_response'] 	= $this->input->post('patient_physical_response')!=""?nl2br($this->input->post('patient_physical_response')):$get_res->patient_physical_response;
	        $dbData['patient_sleep_response'] 	= $this->input->post('patient_sleep_response')!=""?nl2br($this->input->post('patient_sleep_response')):$get_res->patient_sleep_response;
	        $dbData['patient_nicotine_response'] 	= $this->input->post('patient_nicotine_response')!=""?nl2br($this->input->post('patient_nicotine_response')):$get_res->patient_nicotine_response;
	        $dbData['patient_stress_response'] 	= $this->input->post('patient_stress_response')!=""?nl2br($this->input->post('patient_stress_response')):$get_res->patient_stress_response;
	        $dbData['social_stress_response'] 	= $this->input->post('social_stress_response')!=""?nl2br($this->input->post('social_stress_response')):$get_res->social_stress_response;
	        $dbData['social_appointments_response'] 	= $this->input->post('social_appointments_response')!=""?nl2br($this->input->post('social_appointments_response')):$get_res->social_appointments_response;


	        $this->db->where('id', $id);
			$this->db->update('user_recommendations',$dbData);

    		$_SESSION['valid'] = "Your response has been submitted successfully!";
    		redirect(base_url()."recommendations?open=".$id);
    		// redirect($_SERVER['HTTP_REFERER']);

    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_update_program_access($id){
    	if(isset($_SESSION["LISTYLOGIN"]) && user_info()->user_type==2){
    		$user = $this->db->query("SELECT * FROM users WHERE id = ".$id)->result_object()[0];
    		$arr = array(
				'allow_program' => $user->allow_program==1?0:1,
			);
			$this->db->where('id', $id);
			$this->db->update('users',$arr);
			$_SESSION['valid'] = "Program access status has been updated successfully!";
    		redirect($_SERVER['HTTP_REFERER']);
    	} else {
    		redirect(base_url()."login");
    	}
    }

    public function do_verify_email($code){
		$check_code = $this->db->query("SELECT * FROM users WHERE session_id = '".$code."'")->result_object()[0];
		if(empty($check_code)){
			$_SESSION["invalid"] = "Invalid Link or expired!";
			redirect(base_url());
		} else {
			$arr = array(
				'session_id' => null,
				'verify_email'=> 1,
				'status'=> 1,
			);
			
			$this->db->where('session_id', $code);
			$this->db->update('users',$arr);
			$_SESSION["valid"] = "Your email has been verified successfully!";
			redirect(base_url());
		}
	}

	
	private function do_send_email($from, $to, $subject, $message, $show=0, $isContact = 1){
		$template = '
        <table cellpadding="0" cellspacing="0" style="background: #fff;width: 100%; padding: 10px; border-radius: 10px; float: left;font-family:arial; border:5px solid #5c7c28" width="100%">
            <tr>
                <td colspan="2" style="text-align: center;">
                    <img src="'.settings()->site_logo.'" style="width: 80px;">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="color:#fff">...</td>
            </tr>
       
            <tr>
                <td style="font-size: 12px; font-family:arial; padding: 30px; padding-bottom: 10px">
                    '.$message.'
                </td>
            </tr>
            ';
            if($show==1){
                $template .= '
                <tr>
                    <td style="font-weight: bold; font-size: 12px; font-family:arial; padding-top: 30px; padding-bottom: 10px; text-align:center;">
                            If you did not request a new password, we ask that you kindly ignore this email
                    </td>
                </tr>
                ';
            }   

			if($isContact == 1) {
				$template .= '
					<tr>
						<td style="font-weight: bold; font-size: 12px; font-family: arial; padding-top: 10px; padding-bottom: 10px; text-align: center;">
							Need Help?
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold; font-size: 12px; padding-top: 0px; padding-bottom: 10px; text-align: center;">
							Please send any feedback or bug reports to <a href="mailto:'.settings()->email.'">'.settings()->email.'</a>
						</td>
					</tr>';
			}
			
			$template .= '</table>';
			


		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.hostinger.com',
			'smtp_port' => 465,
			'smtp_user' => 'noreply@nepstate.com',
			'smtp_pass' => 'NepState@2026',
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'wordwrap'  => true,
			'smtp_crypto' => 'ssl',
		];

		$this->load->library('email', $config);

		

		$this->email->set_newline("\r\n");
		// $this->email->from($from, settings()->site_title);
		$this->email->from("noreply@nepstate.com", settings()->site_title);

		$this->email->to($to);
		$this->email->subject($subject.' -::- '.settings()->site_title);
		$this->email->message($template);
		$this->email->set_mailtype("html");

		$send = $this->email->send();

		
	}



	public function do_send_welcom_email($from, $to, $subject, $message)
	{

		$template = '
        <table cellpadding="0" cellspacing="0" style="background: #fff;width: 100%; padding: 10px; border-radius: 10px; float: left;font-family:arial; border:5px solid #5c7c28" width="100%">
           
          
            <tr>
                <td style="font-size: 12px; font-family:arial; padding: 30px; padding-bottom: 10px">
                    '.$message.'
                </td>
            </tr>
            ';
          
			$template .= '</table>';
			

		$this->load->library('email');
		$this->email->set_newline("\r\n");
		// $this->email->from($from, settings()->site_title);
		$this->email->from("noreply@nepstate.com", settings()->site_title);

		$this->email->to($to); 
		$this->email->subject($subject.' -::- '.settings()->site_title);
		$this->email->message($template);
		$this->email->set_mailtype("html");

		$send = $this->email->send();
	}
	
	public function email_test(){
		// SEND EMAIL
			$message = '
				<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>USER</strong>,<br /><br/>
					Please use below code to reset your password.
					<br />
					<br />
					OTP Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>:&nbsp;&nbsp;</strong> 12345 <br />
					<br />	
					Best Regards,
					<br>
					'.settings()->site_title.'</span>					
			';
			$this->do_send_email(settings()->email, 'dedevelopers@hotmail.com', 'Forgot Password', $message, 1);
	}

	private function do_send_email_phpmailer($from, $to, $subject, $message, $show=0){
		$template = '
        <table cellpadding="0" cellspacing="0" style="background: #fff;width: 100%; padding: 10px; border-radius: 10px; float: left;font-family:arial; border:5px solid #5c7c28" width="100%">
            <tr>
                <td colspan="2" style="text-align: center;">
                    <img src="'.$this->data['assets'].'images/email_logo.jpg" style="width: 80px;">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="color:#fff">...</td>
            </tr>
       
            <tr>
                <td style="font-size: 12px; font-family:arial; padding: 30px; padding-bottom: 10px">
                    '.$message.'
                </td>
            </tr>
            ';
            if($show==1){
                $template .= '
                <tr>
                    <td style="font-weight: bold; font-size: 12px; font-family:arial; padding-top: 30px; padding-bottom: 10px; text-align:center;">
                            If you did not request a new password, we ask that you kindly ignore this email
                    </td>
                </tr>
                ';
            }   
            $template .= '
            <tr>
                <td style="font-weight: bold; font-size: 12px; font-family:arial; padding-top: 10px; padding-bottom: 10px; text-align:center">
                        Need Help?
                </td>
            </tr>

            <tr>
                <td style="font-weight: bold; font-size: 12px; padding-top: 0px; padding-bottom: 10px; text-align:center">
                        Please send any feedback or bug reports to <a href="mailto:'.settings()->email.'">'.settings()->email.'</a>
                </td>
            </tr>
        </table>';

        //Load Composer's autoloader
		require 'vendor/autoload.php';

		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		    $mail->SMTPDebug = FALSE;     
		    $mail->isSMTP();                                            //Send using SMTP

		    // $mail->Username   = 'admin@lmedsolutions.com';                     //SMTP username
		    // $mail->Password   = 'LMsolutions@23';                                 //SMTP password

		    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = 'admin@lmedsolutions.com';                     //SMTP username
		    $mail->Password   = 'rkbflaezgqngfexg';                               //SMTP password

		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		    //Recipients
		    $mail->setFrom($from, settings()->site_title);
		    $mail->addAddress($to);     //Add a recipient
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = $subject.' -::- '.settings()->site_title;
		    $mail->Body    = $template;

		    $mail->send();
		    //echo 'Message has been sent';
			} catch (Exception $e) {
			   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
	}

	public function upload_to_db_category(){
		$array_sub = array("Day care","Child Care","Elder Care","Nanny Services","Pet Care","HouseKeeing");
		foreach($array_sub as $key=>$row){
			$arr = array(
					'title' => $row,
					'parent_id' => 53,
					'slug'=> slug($row),
					'created_at'=> date("Y-m-d H:i:s"),
					'status'=> 1,
			);
			$this->db->insert('categories',$arr);
		}
	}

	public function get_image_uploaded(){
		$this->load->view('frontend/common/display_images',$this->data);
	}

	public function remove_file_uploaded($id){
			unlink('./resources/uploads/classified-listing/'.$_SESSION["storyimages"][$id]);
			unset($_SESSION["storyimages"][$id]);
	}
	public function upload_multiple(){
		$actual_name = "";
		foreach ($_FILES as $key => $file)
		{
			$upload_p = './resources/uploads/classified-listing/';
			$uploaded_name = $file["name"];
			$ext = explode(".", $uploaded_name)[count(explode(".", $uploaded_name))-1];
			$config['upload_path']          = $upload_p;
	        $config['allowed_types']        = 'jpg|jpeg|png|PNG|JPEG|JPG|gif';
	        $config['max_size']             = 100000;
	        $config["encrypt_name"] 		= false;
	        $supposed_name = date("ymdyhis");
			$actual_name = $supposed_name .'.'.$ext;
	        $config['file_name'] = $actual_name;
	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload($key))
	        {
	            $error = array('error' => $this->upload->display_errors());
				$err = strip_tags($error["error"]);
	            echo json_encode(array("action"=>"failed","error"=>$err));
	        }
	        else
	        {
	        	$image = $this->upload->data();
	        	$_SESSION['storyimages'][] = $this->data['classified_BASE_URL'].$image['file_name'];
	        }
	    }
	    echo json_encode(array("action"=>"success","error"=>$actual_name));
	}


	public function remove_file_uploaded_gallery($id){
			unlink('./resources/uploads/classified-listing/'.$_SESSION["storyimagesOthers"][$id]);
			unset($_SESSION["storyimagesOthers"][$id]);
	}
	public function get_image_uploaded_gallery(){
		$this->load->view('frontend/common/display_images_gallery',$this->data);
	}
	public function upload_multiple_gallery(){
		$actual_name = "";
		foreach ($_FILES as $key => $file) 
		{
			$upload_p = './resources/uploads/classified-listing/';
			$uploaded_name = $file["name"];
			$ext = explode(".", $uploaded_name)[count(explode(".", $uploaded_name))-1];
			$config['upload_path']          = $upload_p;
	        $config['allowed_types']        = 'jpg|jpeg|png|PNG|JPEG|JPG|gif';
	        $config['max_size']             = 100000;
	        $config["encrypt_name"] 		= false;
	        $supposed_name = date("ymdyhis");
			$actual_name = $supposed_name .'.'.$ext;
	        $config['file_name'] = $actual_name;
	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload($key))
	        {
	            $error = array('error' => $this->upload->display_errors());
				$err = strip_tags($error["error"]);
	            echo json_encode(array("action"=>"failed","error"=>$err));
	        }
	        else
	        {
	        	$image = $this->upload->data();
	        	$_SESSION['storyimagesOthers'][] = $this->data['classified_BASE_URL'].$image['file_name'];
	        }
	    }

	    echo json_encode(array("action"=>"success","error"=> $this->data['classified_BASE_URL'].$actual_name));
	}
	// public function submit_classified(){
		
	// 	if(isset($_SESSION['LISTYLOGIN'])){
			
	// 		// $banner_images = $this->input->post('banner_type');
	// 		// print_r($banner_images);
	// 		// die;
		
	// 		if(!isset($_GET['edit'])){
				
	// 			require_once('vendor/autoload.php');
				
	// 			$p_id = $this->input->post('plan');
	// 			$is_coupon_apply = $this->input->post('is_coupon_apply');
	// 			$sub_plan = $this->input->post('sub_plan_amount');
	// 			$plan = $this->db->query("SELECT * FROM payment_plans WHERE id = ".$p_id)->result_object()[0];

	// 			if($is_coupon_apply == 0) {

	// 				$price = $plan->amount;
					
	// 				if($sub_plan != 0){
	// 					$price = ($sub_plan);
	// 				} else {
	// 					$price = ($price);
	// 				}
	// 			}else if($is_coupon_apply == 1) {
	// 				$price = ($sub_plan);
	// 			}

				

	// 			$price = $price * 100;
	//             \Stripe\Stripe::setApiKey('sk_test_zMO3MByh3kZKQJQr6xXAXqK7');
	//             $token = $_POST['stripeToken'];

	//             $customer = \Stripe\Customer::create(array(
	//                 "email" => user_info()->email,
	//                 "source" => $token,
	//             ));

	//             try {
	//                 $charge = \Stripe\Charge::create(array(
	//                     "amount" => $price,
	//                     "currency" => "usd",
	//                     "customer" => $customer->id
	//                 ));
	//             } catch (\Stripe\Error\InvalidRequest $e) {
	//             	$_SESSION['INVALID_FORM_DATA'] = json_encode($_POST);
	//                 $_SESSION['invalid'] = "Some Error Occured, Please try again.";
	//                 redirect($_SERVER['HTTP_REFERER']);
	//                 exit();

	//             } catch (\Stripe\Error\Base $e) {
	//                 //Send User to Error Page
	//                 $_SESSION['INVALID_FORM_DATA'] = json_encode($_POST);
	//                 $_SESSION['invalid'] = "Some Error Occured, Please try again.";
	//                 redirect($_SERVER['HTTP_REFERER']);
	//                 exit();

	//             } catch(\Stripe\Error\Card $e) {
	//                 // Since it's a decline, \Stripe\Error\Card will be caught

	//                 $body = $e->getJsonBody();
	//                 $err  = $body['error'];
	//                 $_SESSION['INVALID_FORM_DATA'] = json_encode($_POST);
	//                 $_SESSION['invalid'] = $err;
	//                 redirect($_SERVER['HTTP_REFERER']);
	//                 exit();
	//             } catch (Exception $e) {
	//                 //Send User to Error Page
	//                 $_SESSION['INVALID_FORM_DATA'] = json_encode($_POST);
	//                 $_SESSION['invalid'] = "Some Error Occured, Please try again.";
	//                 redirect($_SERVER['HTTP_REFERER']);
	//                 exit();

	//             };
	//         }

			
    //         if($charge->status == "succeeded" || isset($_GET['edit'])){
				
	// 			$this->db->where('user_id', user_info()->id)->delete('history_of_before_apply_coupons');

    //         	$today = date("Y-m-d");
    //         	$total_days = $plan->months * 30;
    //         	$new_date = date('Y-m-d', strtotime($total_days.' days', strtotime($today)));

    //             $rendomcode = $this->generateRandomString(25);
    //             $slug_val = slug($this->input->post('title'));
	// 			$arr = array(
	// 				'title' => $this->input->post('title'),
	// 				'uID' => user_info()->id,
	// 				'json_content'=> json_encode($_POST),
	// 				'category'=> $this->input->post('category'),
	// 				'sub_cat'=> $this->input->post('subcategory'),
	// 				'status'=> 1,
	// 				'created_at'=> date("Y-m-d H:i:s"),
	// 				'slug' => $slug_val,
	// 				'plan_id' => $p_id,
	// 				'sub_plan_id' => $this->input->post('show_on_banners'),
	// 				'expiry_date' => $new_date,
	// 				'payment_done'=> 1,
	// 				'payment_object' => json_encode($charge),
	// 				'amount_paid' => ($price/100),
	// 				'latitude' => $this->input->post('latitude'),
	// 				'longitude' => $this->input->post('longitude'),
	// 				'city' => $this->input->post('city'),
	// 				'state' => $this->input->post('state'),
	// 				'zip_code' => $this->input->post('zip_code'),
	// 				'country' => $this->input->post('country'),
					
	// 			);

				
	// 			if(userCountryId()  && userCityId()) {
	// 				$arr['country_id'] = userCountryId();
	// 				$arr['city_id'] = userCityId();
	// 			}else if(userCountryId()  && !userCityId()) {
	// 				$arr['country_id'] = userCountryId();
	// 			}

				
	// 			if(isset($_GET['edit'])){
	// 				unset($arr['uID']);
	// 				unset($arr['plan_id']);
	// 				unset($arr['sub_plan_id']);
	// 				unset($arr['expiry_date']);
	// 				unset($arr['payment_done']);
	// 				unset($arr['payment_object']);
	// 				unset($arr['amount_paid']);
	// 				unset($arr['slug']);
	// 				unset($arr['country_id']);
	// 				unset($arr['city_id']);

	// 				$this->db->where('id', $_GET['edit']);
	// 				$this->db->update('products',$arr);
	// 				$pID = $_GET['edit'];
	// 				$_SESSION['valid'] = "Classified information has been updated!";
	// 			} else {
	// 				$this->db->insert('products',$arr);
	// 				$pID = $this->db->insert_id();
	// 				$categoryType = $this->input->post('category');
	// 				if($categoryType == 'events') {
	// 					$this->saveNotification(user_info()->id, 'admin', 'add-new-event', $pID, notificationContent('add-new-event'), null, null , 'events');
	// 				}else if($categoryType == 'services') {
	// 					$this->saveNotification(user_info()->id, 'admin', 'add-new-service', $pID, notificationContent('add-new-service'), null, null, 'services');
	// 				}else if($categoryType == 'jobs') {
	// 					$this->saveNotification(user_info()->id, 'admin', 'add-new-job', $pID, notificationContent('add-new-job'), null, null, 'jobs');
	// 				}else if($categoryType == 'it-trainings') {
	// 					$this->saveNotification(user_info()->id, 'admin', 'add-new-it-training', $pID, notificationContent('add-new-it-training'), null, null, 'it-trainings');
	// 				}else if($categoryType == 'roomates-rentals') {
	// 					$this->saveNotification(user_info()->id, 'admin', 'add-new-roomates-rental', $pID, notificationContent('add-new-roomates-rental'), null, null, 'roomates-rentals');
	// 				}

	// 				// ADD BANNERS IMAGES IF ANY
	// 				$banner_images = $this->input->post('banner_type');
	// 				if(is_array($banner_images))
	// 				{
	// 					if(count($banner_images) > 0 ){

	// 						// CATEGORY HOME PAGE
	// 						$input = "category_home_page";
	// 				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 					        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 					            $image = $image['data'];
	// 					            $image_category_home_page = $image['file_name'];
	// 					        }
	// 				    	}

	// 				    	// CATEGORY HOME PAGE
	// 						$input = "cat_right";
	// 				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 					        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 					            $image = $image['data'];
	// 					            $image_cat_right = $image['file_name'];
	// 					        }
	// 				    	}

	// 				    	// WEBSITE BANNER HOME PAGE
	// 						$input = "website_home_banner";
	// 				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 				        	$image_2 = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 					        if($image_2['upload'] == true || $_FILES[$input]['size']<1){
	// 					            $image_2 = $image_2['data'];
	// 					            $image_website_home_banner = $image_2['file_name'];
	// 					        }
	// 				    	}

	// 				    	$input = "home_middle";
	// 				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 					        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 					            $image = $image['data'];
	// 					            $image_home_middle = $image['file_name'];
	// 					        }
	// 				    	}

	// 				    	$input = "web_footer";
	// 				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 					        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 					            $image = $image['data'];
	// 					            $image_web_footer = $image['file_name'];
	// 					        }
	// 				    	}

	// 						$this->db->query("DELETE FROM products_ads WHERE uID_pID = ".$pID);


	// 						foreach($banner_images as $ii=>$img){

	// 							$today = date("Y-m-d");
	// 							$days_plan = ($plan->months * 30);
	// 	    					$new_expiry_date = date('Y-m-d', strtotime($days_plan.' days', strtotime($today)));

	// 							$arr_img__ = array(
	// 									'ad_for' => $img,
	// 									'created_at' => date("Y-m-d"),
	// 									'status' => 1,
	// 									'link' => base_url()."classified/detail/".$slug_val,
	// 									'uID_pID' => $pID,
	// 									'user_id' => user_info()->id,
	// 									'category' => $this->input->post('category'),
	// 									'image'=> null,
	// 									'plan_id' => $plan->id,
	// 									'ad_expires' => $new_expiry_date
	// 							);

	// 							if($img == "category_home_page"){
	// 								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_category_home_page;
	// 								// $arr_img__['ad_location'] = $this->input->post('location_ad_category');
	// 							}
	// 							if($img == "website_home_banner"){
	// 								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_website_home_banner;
	// 							}

	// 							if($img == "home_middle"){
	// 								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_home_middle;
	// 							}

	// 							if($img == "web_footer"){
	// 								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_web_footer;
	// 							}

	// 							if($img == "cat_right"){
	// 								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_cat_right;
	// 								$arr_img__['ad_location'] = "right_banner";

	// 							}

	// 							if(userCountryId()  && userCityId()) {
	// 								$arr_img__['country_id'] = userCountryId();
	// 								$arr_img__['city_id'] = userCityId();
	// 							}else if(userCountryId()  && !userCityId()) {
	// 								$arr_img__['country_id'] = userCountryId();
	// 							}

								
	// 							$this->db->insert('products_ads',$arr_img__);
	// 							$insertedId = $this->db->insert_id();
	// 							$adCategoryType = $img;
	// 							if($adCategoryType == 'website_home_banner') {
	// 								$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-home-banner', $insertedId, notificationContent('create-ad-for-home-banner'), null, null, 'promote');
	// 							}else if($adCategoryType == 'home_middle') {
	// 								$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-home-middle', $insertedId, notificationContent('create-ad-for-home-middle') , null, null, 'promote');
	// 							}else if($adCategoryType == 'cat_right') {
	// 								$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-right-banner', $insertedId, notificationContent('create-ad-for-right-banner') , null, null, 'promote');
	// 							}else if($adCategoryType == 'website_home_category_section') {
	// 								$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-home-category-section', $insertedId, notificationContent('create-ad-for-home-category-section') , null, null, 'promote');
	// 							}else if($adCategoryType == 'category_home_page') {
	// 								$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-home-category-page', $insertedId, notificationContent('create-ad-for-home-category-page'), null, null, 'promote');
	// 							}else if($adCategoryType == 'blog') {
	// 								$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-blog', $insertedId, notificationContent('create-ad-for-blog'), null, null, 'promote');
	// 							}else if($adCategoryType == 'forum') {
	// 								$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-forum', $insertedId, notificationContent('create-ad-for-forum'), null, null, 'promote');
	// 							}else if($adCategoryType == 'confession') {
	// 								$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-confession', $insertedId, notificationContent('create-ad-for-confession'), null, null, 'promote');
	// 							}

								
	// 							if($img == "website_home_category_section"){
	// 								$arr_update['sub_plan_id'] = "website_home_category_section";
	// 								$this->db->where('id', $pID);
	// 								$this->db->update('products',$arr_update);
	// 							}
	// 						}
	// 					}
	// 				}

	// 				$_SESSION['valid'] = "Your classified has been posted!";
	// 			}


	// 			if(!empty($_SESSION['storyimages'])){
	// 				$this->db->query("DELETE FROM product_images WHERE product_id = ".$pID);
	// 				foreach($_SESSION['storyimages'] as $key=> $img){
	// 					$arr_img = array(
	// 						'product_id' => $pID,
	// 						'image'=> $img,
	// 					);
	// 					$this->db->insert('product_images',$arr_img);
	// 				}
	// 			}

	// 			if(!empty($_SESSION['storyimagesOthers'])){
	// 				$this->db->query("DELETE FROM product_images WHERE gallery = 1 AND product_id = ".$pID);
	// 				foreach($_SESSION['storyimagesOthers'] as $key=> $img){
	// 					$arr_img = array(
	// 						'product_id' => $pID,
	// 						'image'=> $img,
	// 						'gallery'=> 1,
	// 					);
	// 					$this->db->insert('product_images',$arr_img);
	// 				}
	// 			}
	// 			unset($_SESSION['INVALID_FORM_DATA']);
	// 			unset($_SESSION['storyimages']);
	// 			unset($_SESSION['storyimagesOthers']);
	// 			unset($_SESSION['ALREADY_SESSION_IMAGE']);
	// 			redirect(base_url()."my-listings?id=".$pID);
    //         } else {
    //             $_SESSION['INVALID_FORM_DATA'] = json_encode($_POST);
    //             $_SESSION['invalid'] = "Payment not confirmed. Please try again after sometime!";
    //             redirect($_SERVER['HTTP_REFERER']);
    //         }
			
	// 	} else {
	// 		redirect(base_url());
	// 	}
	// }	



	public function submit_classified(){

		//  echo "<pre>";print_r($_POST);die;
		$this->db->trans_begin();
	try{
		
		if(isset($_SESSION['LISTYLOGIN'])){
			// echo "<pre>";
			// print_r($_POST);
			// die;
			// $banner_images = $this->input->post('banner_type');
			// print_r($banner_images);
			// die;
			$isFreePlan = $this->input->post('is_free_plan');
			if(!isset($_GET['edit'])){
				
				require_once('vendor/autoload.php');
				 
				$p_id = $this->input->post('plan');
				$is_coupon_apply = $this->input->post('is_coupon_apply');
				$sub_plan = $this->input->post('sub_plan_amount');
				$plan = $this->db->query("SELECT * FROM payment_plans WHERE id = ".$p_id)->result_object()[0];

				if($is_coupon_apply == 0) {

					$price = $plan->amount;
					
					if($sub_plan != 0){
						$price = ($sub_plan);
					} else {
						$price = ($price);
					}

				}else if($is_coupon_apply == 1) {
					$price = ($sub_plan);
				}

				$price = $price * 100;
	        
	         }

				$this->db->where('user_id', user_info()->id)->delete('history_of_before_apply_coupons');

            	$today = date("Y-m-d");
            	$total_days = $plan->months * 30;
            	$new_date = date('Y-m-d', strtotime($total_days.' days', strtotime($today)));
                $rendomcode = $this->generateRandomString(25);
                $slug_val = slug($this->input->post('title'));
				$arr = array(
					'title' => $this->input->post('title'),
					'uID' => user_info()->id,
					'json_content'=> json_encode($_POST),
					'category'=> $this->input->post('category'),
					'sub_cat'=> $this->input->post('subcategory'),
					'status'=> 1,
					'created_at'=> date("Y-m-d H:i:s"),
					'slug' => $slug_val,
					'plan_id' => $p_id,
					'sub_plan_id' => $this->input->post('show_on_banners'),
					'expiry_date' => $new_date,	
					'payment_done'=> 1,
					'payment_object' => '',
					'amount_paid' => ($price/100),
					'latitude' => $this->input->post('latitude'),
					'longitude' => $this->input->post('longitude'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'zip_code' => $this->input->post('zip_code'),
					'country' => $this->input->post('country'),
				);

				
				if(userCountryId()  && userCityId()) {
					$arr['country_id'] = userCountryId();
					$arr['city_id'] = userCityId();
				}else if(userCountryId()  && !userCityId()) {
					$arr['country_id'] = userCountryId();
				}

				
				if(isset($_GET['edit']) || $isFreePlan == 1){
					
					if($isFreePlan == 0) {
						
						unset($arr['uID']);
						unset($arr['plan_id']);
						unset($arr['sub_plan_id']);
						unset($arr['expiry_date']);
						unset($arr['payment_done']);
						unset($arr['payment_object']);
						unset($arr['amount_paid']);
						unset($arr['slug']);
						unset($arr['country_id']);
						unset($arr['city_id']);

						$this->db->where('id', $_GET['edit']);
						$this->db->update('products',$arr);
						$pID = $_GET['edit'];
						$_SESSION['valid'] = "Classified information has been updated!";
						
					}elseif($isFreePlan == 1) {
						$arr['payment_status'] = 'completed';
						$this->db->insert('products',$arr);
						$pID = $this->db->insert_id();
						$_SESSION['valid'] = "Classified information has been updated!";
					}
				} else {

					$this->db->insert('temporary_products',$arr);
					$pID = $this->db->insert_id();
					$categoryType = $this->input->post('category');
                    

					// ADD BANNERS IMAGES IF ANY
					$adInsertedIds = [];
					$adImageType = [];	
					$banner_images = $this->input->post('banner_type');
					if(is_array($banner_images))
					{
						if(count($banner_images) > 0 ){

							// CATEGORY HOME PAGE
							$input = "category_home_page";
					        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
					        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
						        if($image['upload'] == true || $_FILES[$input]['size']<1){
						            $image = $image['data'];
						            $image_category_home_page = $image['file_name'];
						        }
					    	}

					    	// CATEGORY HOME PAGE
							$input = "cat_right";
					        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
					        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
						        if($image['upload'] == true || $_FILES[$input]['size']<1){
						            $image = $image['data'];
						            $image_cat_right = $image['file_name'];
						        }
					    	}

					    	// WEBSITE BANNER HOME PAGE
							$input = "website_home_banner";
					        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
					        	$image_2 = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
						        if($image_2['upload'] == true || $_FILES[$input]['size']<1){
						            $image_2 = $image_2['data'];
						            $image_website_home_banner = $image_2['file_name'];
						        }
					    	}

					    	$input = "home_middle";
					        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
					        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
						        if($image['upload'] == true || $_FILES[$input]['size']<1){
						            $image = $image['data'];
						            $image_home_middle = $image['file_name'];
						        }
					    	}

					    	$input = "web_footer";
					        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
					        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
						        if($image['upload'] == true || $_FILES[$input]['size']<1){
						            $image = $image['data'];
						            $image_web_footer = $image['file_name'];
						        }
					    	}

							$this->db->query("DELETE FROM products_ads WHERE uID_pID = ".$pID);

							
							
							foreach($banner_images as $ii=>$img){

								$today = date("Y-m-d");
								$days_plan = ($plan->months * 30);
		    					$new_expiry_date = date('Y-m-d', strtotime($days_plan.' days', strtotime($today)));

								$arr_img__ = array(
										'ad_for' => $img,
										'created_at' => date("Y-m-d"),
										'status' => 1,
										'link' => base_url()."classified/detail/".$slug_val,
										'uID_pID' => $pID,
										'user_id' => user_info()->id,
										'category' => $this->input->post('category'),
										'image'=> null,
										'plan_id' => $plan->id,
										'ad_expires' => $new_expiry_date
								);

								if($img == "category_home_page"){
									$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_category_home_page;
									// $arr_img__['ad_location'] = $this->input->post('location_ad_category');
								}
								if($img == "website_home_banner"){
									$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_website_home_banner;
								}

								if($img == "home_middle"){
									$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_home_middle;
								}

								if($img == "web_footer"){
									$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_web_footer;
								}

								if($img == "cat_right"){
									$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_cat_right;
									$arr_img__['ad_location'] = "right_banner";

								}

								if(userCountryId()  && userCityId()) {
									$arr_img__['country_id'] = userCountryId();
									$arr_img__['city_id'] = userCityId();
								}else if(userCountryId()  && !userCityId()) {
									$arr_img__['country_id'] = userCountryId();
								}

								
								$this->db->insert('temporary_products_ads',$arr_img__);
								$insertedId = $this->db->insert_id();

								$adInsertedIds[] = $insertedId;
								$adImageType[] = $img;


								if(isset($_GET['edit'])) {

									if($img == "website_home_category_section"){
										$arr_update['sub_plan_id'] = "website_home_category_section";
										$this->db->where('id', $pID);
										$this->db->update('products',$arr_update);
									}
								}else{
									if($img == "website_home_category_section"){
										$arr_update['sub_plan_id'] = "website_home_category_section";
										$this->db->where('id', $pID);
										$this->db->update('temporary_products',$arr_update);
									}
								}

								
							}
						}
					}


					// $_SESSION['valid'] = "Your classified has been posted!";

					if(!isset($_GET['edit']) && $isFreePlan == 0){

						$stripeToken = '';
						try {
							Stripe::setApiKey($this->stripeSecretKey());
							$session = Session::create([
								'payment_method_types' => ['card'], 
								'line_items' => [[
									'price_data' => [
										'currency' => 'usd',
										'product_data' => [
											'name' => 'Nepsate',
										],
										'unit_amount' => $price, 
									],
									'quantity' => 1,
								]],
								'mode' => 'payment', 
								'automatic_tax' => ['enabled' => true],
									'metadata' => [
										'country' => 'IN',
									],
								

								'success_url' => base_url('classified_payment_success?session_id={CHECKOUT_SESSION_ID}&pid='.$pID.'&&category-type='.$categoryType.'&&userid='.user_info()->id.'&&ad-ids=' . 
									(!empty($adInsertedIds) ? implode(',', $adInsertedIds) : $adInsertedIds) . '&&types=' . 
									(!empty($adImageType) ? implode(',', $adImageType) : $adImageType)
								),
								'cancel_url' => base_url('classified_payment_cancel?pid='.$pID.'&&ad-ids='.
									(!empty($adInsertedIds) ? implode(',', $adInsertedIds) : $adInsertedIds)
								),

							]);
					
							$stripeToken = $session->url;
							
						} catch (\Exception $e) {
							echo $e->getMessage();
							die;
							$_SESSION['invalid'] = "Some Error Occured, Please try again.";
							redirect($_SERVER['HTTP_REFERER']);
							exit();
							die;
						}
					}
				}

				
				if(!empty($_SESSION['storyimages'])){
					$this->db->query("DELETE FROM product_images WHERE product_id = ".$pID);
					foreach($_SESSION['storyimages'] as $key=> $img){
						$arr_img = array(
							'product_id' => $pID,
							'image'=> $img,
						);
						$this->db->insert('product_images',$arr_img);
					}
				}

				if(!empty($_SESSION['storyimagesOthers'])){
					$this->db->query("DELETE FROM product_images WHERE gallery = 1 AND product_id = ".$pID);
					foreach($_SESSION['storyimagesOthers'] as $key=> $img){
						$arr_img = array(
							'product_id' => $pID,
							'image'=> $img,
							'gallery'=> 1,
						);
						$this->db->insert('product_images',$arr_img);
					}
				}

				unset($_SESSION['INVALID_FORM_DATA']);
				unset($_SESSION['storyimages']);
				unset($_SESSION['storyimagesOthers']);
				unset($_SESSION['ALREADY_SESSION_IMAGE']);
				// redirect(base_url()."my-listings?id=".$pID);
				$this->db->trans_commit();
				
				if($isFreePlan == 0 && !isset($_GET['edit'])) {
					$this->data['stripeTokent'] = $stripeToken; 
					$this->load->view('frontend/common/stripePayment',$this->data);
				}else if($isFreePlan == 1 && !isset($_GET['edit'])){ 
					$this->db->where('id', user_info()->id)->update('users',array('free_listings_count' => user_info()->free_listings_count + 1));
					$_SESSION['valid'] = "Your Free Classified has been submitted successfully!";
					redirect(base_url()."my-listings");
					die;
				}else if(isset($_GET['edit'])){ 
					redirect(base_url()."my-listings");
					die;
				}

            
		} else {
			redirect(base_url());
			die;
		}

		}catch(\Exception $e) { 
			$this->db->trans_rollback();
			$_SESSION['valid'] = "Some Error occurred please contact the admin!";
			redirect(base_url());
			die;
		}
	}


	

	// public function submit_payment_promotion(){
	// 	if(isset($_SESSION['LISTYLOGIN'])){
	// 			// echo "<pre>";
	// 			// print_r($_POST);
	// 			// die;
				
	// 			require_once('vendor/autoload.php');
	// 			$p_id = $this->input->post('plan');
	// 			$sub_plan = $this->input->post('sub_plan_amount');
	// 			$plan = $this->db->query("SELECT * FROM payment_plans WHERE id = ".$p_id)->result_object()[0];
	// 			$price = $plan->amount;

	// 			if($sub_plan != 0){
	// 				$price = ($sub_plan);
	// 			} else {
	// 				$price = ($price);
	// 			}

	// 			$price = $price * 100;
	//             \Stripe\Stripe::setApiKey('sk_test_zMO3MByh3kZKQJQr6xXAXqK7');
	//             $token = $_POST['stripeToken'];

	//             $customer = \Stripe\Customer::create(array(
	//                 "email" => user_info()->email,
	//                 "source" => $token,
	//             ));

	//             try {
	//                 $charge = \Stripe\Charge::create(array(
	//                     "amount" => $price,
	//                     "currency" => "usd",
	//                     "customer" => $customer->id
	//                 ));
	//             } catch (\Stripe\Error\InvalidRequest $e) {
	//             	$_SESSION['INVALID_FORM_DATA'] = json_encode($_POST);
	//                 $_SESSION['invalid'] = "Some Error Occured, Please try again.";
	//                 redirect($_SERVER['HTTP_REFERER']);
	//                 exit();

	//             } catch (\Stripe\Error\Base $e) {
	//                 //Send User to Error Page
	//                 $_SESSION['INVALID_FORM_DATA'] = json_encode($_POST);
	//                 $_SESSION['invalid'] = "Some Error Occured, Please try again.";
	//                 redirect($_SERVER['HTTP_REFERER']);
	//                 exit();

	//             } catch(\Stripe\Error\Card $e) {
	//                 // Since it's a decline, \Stripe\Error\Card will be caught

	//                 $body = $e->getJsonBody();
	//                 $err  = $body['error'];
	//                 $_SESSION['INVALID_FORM_DATA'] = json_encode($_POST);
	//                 $_SESSION['invalid'] = $err;
	//                 redirect($_SERVER['HTTP_REFERER']);
	//                 exit();
	//             } catch (Exception $e) {
	//                 //Send User to Error Page
	//                 $_SESSION['INVALID_FORM_DATA'] = json_encode($_POST);
	//                 $_SESSION['invalid'] = "Some Error Occured, Please try again.";
	//                 redirect($_SERVER['HTTP_REFERER']);
	//                 exit();

	//             };

    //         	if($charge->status == "succeeded"){
					
	// 				// ADD BANNERS IMAGES IF ANY
	// 				$banner_images = $this->input->post('banner_type');
					
	// 				if(count($banner_images) > 0){

	// 					// CATEGORY HOME PAGE
	// 					$input = "category_home_page";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 			        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 				            $image = $image['data'];
	// 				            $image_category_home_page = $image['file_name'];
	// 				            $url_category_home_page =  $this->input->post('category_home_page_url');
	// 				            $location_ad_category = $this->input->post('location_ad_category');
	// 				        }
	// 			    	}

	// 			    	// CATEGORY HOME PAGE
	// 					$input = "cat_right";

	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 			        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 				            $image = $image['data'];
	// 				            $image_cat_right = $image['file_name'];
	// 				            $url_cat_right=  $this->input->post('cat_right_section_url');
	// 				            $location_cat_right = 'right_banner';
	// 				            $cat_name_rrr = $this->input->post('cat_right_section');
	// 				        }
	// 			    	}

	// 			    	// WEBSITE BANNER HOME PAGE
	// 					$input = "website_home_banner";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 			        	$image_2 = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image_2['upload'] == true || $_FILES[$input]['size']<1){
	// 				            $image_2 = $image_2['data'];
	// 				            $image_website_home_banner = $image_2['file_name'];
	// 				            $url_website_home_banner =  $this->input->post('website_home_banner_url');
	// 				            $location_ad = "";
	// 				        }
	// 			    	}

	// 			    	$input = "home_middle";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 			        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 				            $image = $image['data'];
	// 				            $image_home_middle = $image['file_name'];
	// 				            $url_home_middle =  $this->input->post('home_middle_url');
	// 				            $location_ad = "";
	// 				        }
	// 			    	}

	// 			    	$input = "web_footer";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 			        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 				            $image = $image['data'];
	// 				            $image_web_footer = $image['file_name'];
	// 				            $url_web_footer =  $this->input->post('web_footer_url');
	// 				            $location_ad = "";
	// 				        }
	// 			    	}	

						
	// 			    	$input = "blog";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 						$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 							$image = $image['data'];
	// 				             $image_blog = $image['file_name'];
					           
	// 							$url_blog =  $this->input->post('blog_url');
	// 				            $location_ad =  $this->input->post('location_ad_blog');
	// 				        }
	// 			    	}


	// 					$input = "blogTopBanner";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
							
						
	// 			        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
								
	// 							$image = $image['data'];
	// 				             $image_blog = $image['file_name'];
					           
	// 							$url_blog =  $this->input->post('blog_url');
	// 				            $location_ad =  $this->input->post('location_ad_blog');
	// 				        }
	// 			    	}

						

						    
	// 			    	$input = "confession";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 			        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 				            $image = $image['data'];
	// 				            $image_confession = $image['file_name'];
	// 				            $url_confession =  $this->input->post('confession_url');
	// 				            $location_ad =  $this->input->post('location_ad_confession');
	// 				        }
	// 			    	}

	// 					$input = "confessionTopBanner";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 			        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 				            $image = $image['data'];
	// 				            $image_confession = $image['file_name'];
	// 				            $url_confession =  $this->input->post('confession_url');
	// 				            $location_ad =  $this->input->post('location_ad_confession');
	// 				        }
	// 			    	}

	// 			    	$input = "forum";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 			        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 				            $image = $image['data'];
	// 				            $image_forum = $image['file_name'];
	// 				            $url_forum =  $this->input->post('forum_url');
	// 				            $location_ad =  $this->input->post('location_ad_forum');
	// 				        }
	// 			    	}

	// 					$input = "forumTopBanner";
	// 			        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	// 			        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
	// 				        if($image['upload'] == true || $_FILES[$input]['size']<1){
	// 				            $image = $image['data'];
	// 				            $image_forum = $image['file_name'];
	// 				            $url_forum =  $this->input->post('forum_url');
	// 				            $location_ad =  $this->input->post('location_ad_forum');
	// 				        }
	// 			    	}

	// 					// $this->db->query("DELETE FROM products_ads WHERE uID_pID = ".$pID);
	// 					foreach($banner_images as $ii=>$img){

	// 						$today = date("Y-m-d");
	// 						$days_plan = ($plan->months * 30);
	//     					$new_expiry_date = date('Y-m-d', strtotime($days_plan.' days', strtotime($today)));

	// 						$arr_img__ = array(
	// 								'ad_for' => $img,
	// 								'created_at' => date("Y-m-d"),
	// 								'status' => 1,
	// 								'link' => null,
	// 								'uID_pID' => 0,
	// 								'category' => null,
	// 								'image'=> null,
	// 								'user_id' => user_info()->id,
	// 								'plan_id' => $plan->id,
	// 								'ad_expires' => $new_expiry_date,
	// 						);

	// 						if($img == "category_home_page"){
	// 							$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_category_home_page;
	// 							$arr_img__['link'] = $url_category_home_page;
	// 							$arr_img__['category'] = $this->input->post('category_home_page');
	// 							// $arr_img__['ad_location'] = $location_ad_category;
	// 						}
	// 						if($img == "website_home_banner"){
	// 							$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_website_home_banner;
	// 							$arr_img__['link'] = $url_website_home_banner;
	// 						}

	// 						if($img == "home_middle"){
	// 							$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_home_middle;
	// 							$arr_img__['link'] = $url_home_middle;
	// 						}

	// 						if($img == "web_footer"){
	// 							$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_web_footer;
	// 							$arr_img__['link'] = $url_web_footer;
	// 						}

	// 						if($img == "blog"){
								
	// 							$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_blog;
	// 							$arr_img__['link'] = $url_blog;
	// 							$arr_img__['ad_location'] = $location_ad;
	// 						}

	// 						if($img == "confession"){
	// 							$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_confession;
	// 							$arr_img__['link'] = $url_confession;
	// 							$arr_img__['ad_location'] = $location_ad;
	// 						}

	// 						if($img == "forum"){
	// 							$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_forum;
	// 							$arr_img__['link'] = $url_forum;
	// 							$arr_img__['ad_location'] = $location_ad;
	// 						}

	// 						if($img == "cat_right"){
	// 							$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_cat_right;
	// 							$arr_img__['link'] = $url_cat_right;
	// 							$arr_img__['category'] = $cat_name_rrr;
	// 							$arr_img__['ad_location'] = "right_banner";
	// 						}

	// 						if(userCountryId()  && userCityId()) {
	// 							$arr_img__['country_id'] = userCountryId();
	// 							$arr_img__['city_id'] = userCityId();
	// 						}else if(userCountryId()  && !userCityId()) {
	// 							$arr_img__['country_id'] = userCountryId();
	// 						}

						
	// 						// print_r($arr_img__);
	// 						// die;

	// 						$this->db->insert('products_ads',$arr_img__);
	// 						$insertedId = $this->db->insert_id();

	// 						$adCategoryType = $img;
	// 						if($adCategoryType == 'website_home_banner') {
	// 							$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-home-banner', $insertedId, notificationContent('create-ad-for-home-banner') , null, null, 'promote');
	// 						}else if($adCategoryType == 'home_middle') {
	// 							$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-home-middle', $insertedId, notificationContent('create-ad-for-home-middle') , null, null, 'promote');
	// 						}else if($adCategoryType == 'cat_right') {
	// 							$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-right-banner', $insertedId, notificationContent('create-ad-for-right-banner') , null, null, 'promote');
	// 						}else if($adCategoryType == 'website_home_category_section') {
	// 							$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-home-category-section', $insertedId, notificationContent('create-ad-for-home-category-section') , null, null, 'promote');
	// 						}else if($adCategoryType == 'category_home_page') {
	// 							$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-home-category-page', $insertedId, notificationContent('create-ad-for-home-category-page') , null, null, 'promote');
	// 						}else if($adCategoryType == 'blog') {
	// 							$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-blog', $insertedId, notificationContent('create-ad-for-blog') , null, null, 'promote');
	// 						}else if($adCategoryType == 'forum') {
	// 							$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-forum', $insertedId, notificationContent('create-ad-for-forum') , null, null, 'promote');
	// 						}else if($adCategoryType == 'confession') {
	// 							$this->saveNotification(user_info()->id, 'admin', 'create-ad-for-confession', $insertedId, notificationContent('create-ad-for-confession') , null, null, 'promote');
	// 						}
	// 					}
	// 				}

	// 				$_SESSION['valid'] = "Your promotional advertisement has been submitted successfully!";
	// 				redirect(base_url()."my-ads");

    //         } else {
    //             $_SESSION['invalid'] = "Payment not confirmed. Please try again after sometime!";
    //             redirect($_SERVER['HTTP_REFERER']);
    //         }
			
	// 	} else {
	// 		redirect(base_url());
	// 	}
	// }

	public function submit_payment_promotion(){
	$this->db->trans_begin();
	try{
		if(isset($_SESSION['LISTYLOGIN'])){

				$p_id = $this->input->post('plan');
				$sub_plan = $this->input->post('sub_plan_amount');
				$plan = $this->db->query("SELECT * FROM payment_plans WHERE id = ".$p_id)->result_object()[0];
				$price = $plan->amount;

				if($sub_plan != 0){
					$price = ($sub_plan);
				} else {
					$price = ($price);
				}

				$price = $price * 100;
				$banner_images = $this->input->post('banner_type');
					
					if(count($banner_images) > 0){

						// CATEGORY HOME PAGE
						$input = "category_home_page";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
					            $image = $image['data'];
					            $image_category_home_page = $image['file_name'];
					            $url_category_home_page =  $this->input->post('category_home_page_url');
					            $location_ad_category = $this->input->post('location_ad_category');
					        }
				    	}

				    	// CATEGORY HOME PAGE
						$input = "cat_right";

				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
					            $image = $image['data'];
					            $image_cat_right = $image['file_name'];
					            $url_cat_right=  $this->input->post('cat_right_section_url');
					            $location_cat_right = 'right_banner';
					            $cat_name_rrr = $this->input->post('cat_right_section');
					        }
				    	}

				    	// WEBSITE BANNER HOME PAGE
						$input = "website_home_banner";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
				        	$image_2 = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image_2['upload'] == true || $_FILES[$input]['size']<1){
					            $image_2 = $image_2['data'];
					            $image_website_home_banner = $image_2['file_name'];
					            $url_website_home_banner =  $this->input->post('website_home_banner_url');
					            $location_ad = "";
					        }
				    	}

				    	$input = "home_middle";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
					            $image = $image['data'];
					            $image_home_middle = $image['file_name'];
					            $url_home_middle =  $this->input->post('home_middle_url');
					            $location_ad = "";
					        }
				    	}

				    	$input = "web_footer";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
					            $image = $image['data'];
					            $image_web_footer = $image['file_name'];
					            $url_web_footer =  $this->input->post('web_footer_url');
					            $location_ad = "";
					        }
				    	}	

						
				    	$input = "blog";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
							$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
								$image = $image['data'];
					             $image_blog = $image['file_name'];
					           
								$url_blog =  $this->input->post('blog_url');
					            $location_ad =  $this->input->post('location_ad_blog');
					        }
				    	}


						$input = "blogTopBanner";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
							
						
				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
								
								$image = $image['data'];
					             $image_blog = $image['file_name'];
					           
								$url_blog =  $this->input->post('blog_url');
					            $location_ad =  $this->input->post('location_ad_blog');
					        }
				    	}

						

						    
				    	$input = "confession";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
					            $image = $image['data'];
					            $image_confession = $image['file_name'];
					            $url_confession =  $this->input->post('confession_url');
					            $location_ad =  $this->input->post('location_ad_confession');
					        }
				    	}

						$input = "confessionTopBanner";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
					            $image = $image['data'];
					            $image_confession = $image['file_name'];
					            $url_confession =  $this->input->post('confession_url');
					            $location_ad =  $this->input->post('location_ad_confession');
					        }
				    	}

				    	$input = "forum";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
					            $image = $image['data'];
					            $image_forum = $image['file_name'];
					            $url_forum =  $this->input->post('forum_url');
					            $location_ad =  $this->input->post('location_ad_forum');
					        }
				    	}

						$input = "forumTopBanner";
				        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
				        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
					        if($image['upload'] == true || $_FILES[$input]['size']<1){
					            $image = $image['data'];
					            $image_forum = $image['file_name'];
					            $url_forum =  $this->input->post('forum_url');
					            $location_ad =  $this->input->post('location_ad_forum');
					        }
				    	}

						$insertedidsArr = [];
						$imgTypeArr = [];
						// $this->db->query("DELETE FROM products_ads WHERE uID_pID = ".$pID);
						
						foreach($banner_images as $ii=>$img){

							$today = date("Y-m-d");
							$days_plan = ($plan->months * 30);
	    					$new_expiry_date = date('Y-m-d', strtotime($days_plan.' days', strtotime($today)));

							$arr_img__ = array(
									'ad_for' => $img,
									'created_at' => date("Y-m-d"),
									'status' => 1,
									'link' => null,
									'uID_pID' => 0,
									'category' => null,
									'image'=> null,
									'user_id' => user_info()->id,
									'plan_id' => $plan->id,
									'ad_expires' => $new_expiry_date,
									'payment_status' => 'pending',
							);

							if($img == "category_home_page"){
								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_category_home_page;
								$arr_img__['link'] = $url_category_home_page;
								$arr_img__['category'] = $this->input->post('category_home_page');
								// $arr_img__['ad_location'] = $location_ad_category;
							}
							
							if($img == "website_home_banner"){
								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_website_home_banner;
								$arr_img__['link'] = $url_website_home_banner;
							}

							if($img == "home_middle"){
								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_home_middle;
								$arr_img__['link'] = $url_home_middle;
							}

							if($img == "web_footer"){
								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_web_footer;
								$arr_img__['link'] = $url_web_footer;
							}

							if($img == "blog"){
								
								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_blog;
								$arr_img__['link'] = $url_blog;
								$arr_img__['ad_location'] = $location_ad;
							}

							if($img == "confession"){
								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_confession;
								$arr_img__['link'] = $url_confession;
								$arr_img__['ad_location'] = $location_ad;
							}

							if($img == "forum"){
								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_forum;
								$arr_img__['link'] = $url_forum;
								$arr_img__['ad_location'] = $location_ad;
							}

							if($img == "cat_right"){
								$arr_img__['image'] = $this->data['classified_BASE_URL'].$image_cat_right;
								$arr_img__['link'] = $url_cat_right;
								$arr_img__['category'] = $cat_name_rrr;
								$arr_img__['ad_location'] = "right_banner";
							}

							if(userCountryId()  && userCityId()) {
								$arr_img__['country_id'] = userCountryId();
								$arr_img__['city_id'] = userCityId();
							}else if(userCountryId()  && !userCityId()) {
								$arr_img__['country_id'] = userCountryId();
							}


							$this->db->insert('temporary_products_ads',$arr_img__);
							$insertedId = $this->db->insert_id();
							$insertedIdsArr[] = $insertedId;
							$imgTypeArr[] = $img;

							// echo "<pre>";
							// print_r($_POST);
							// die;
						}
							if(!empty($insertedIdsArr) && !empty($imgTypeArr)) {

								$stripeToken = '';
								try {
									Stripe::setApiKey($this->stripeSecretKey());
									$session = Session::create([
										'payment_method_types' => ['card'], 
										'line_items' => [[
											'price_data' => [
												'currency' => 'usd',
												'product_data' => [
													'name' => 'Nepsate',
												],
												'unit_amount' => $price, 
											],
											'quantity' => 1,
										]],
										'mode' => 'payment', 
										'automatic_tax' => ['enabled' => true],
											'metadata' => [
												'country' => 'IN',
											],
										

										'success_url' => base_url('promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid='.user_info()->id.'&&ids=' . 
											(is_array($insertedIdsArr) ? implode(',', $insertedIdsArr) : $insertedIdsArr) . '&&types=' . 
											(is_array($imgTypeArr) ? implode(',', $imgTypeArr) : $imgTypeArr)
										),
										'cancel_url' => base_url('promotion_payment_cancel?ids='.
											(is_array($insertedIdsArr) ? implode(',', $insertedIdsArr) : $insertedIdsArr)
										),

									]);
							
									$stripeToken = $session->url;
									
								} catch (\Exception $e) {
									
									$_SESSION['invalid'] = "Some Error Occured, Please try again.";
									redirect($_SERVER['HTTP_REFERER']);
									
									die;
								}
							}
					}

					$this->data['stripeTokent'] = $stripeToken; 
					$this->db->trans_commit();
					$this->load->view('frontend/common/stripePayment',$this->data);

			
		} else {
			redirect(base_url());
		}

		}catch(\Exception $e) {
			$this->db->trans_rollback();
			$_SESSION['valid'] = "Some Error occurred please contact the admin!";
			redirect(base_url());
		}
	}

	public function do_update_ads($id){
		if(isset($_SESSION['LISTYLOGIN'])){

           $image_ad = array(
				'link' => $this->input->post('link_ad'),
			);
	    	$input = "image_ad";
	        if((isset($_FILES[$input]) && $_FILES[$input]['size'] > 0)) {
	        	$image = $this->image_upload($input,'./resources/uploads/classified-listing/','jpg|jpeg|png|gif');
		        if($image['upload'] == true || $_FILES[$input]['size']<1){
		            $image = $image['data'];
		            $image_ad['image'] = $this->data['classified_BASE_URL'].$image['file_name'];
		        }
	    	} 

	    	
			$this->db->where('id', $id);
			$this->db->update('products_ads',$image_ad);

			$_SESSION['valid'] = "Your promotional advertisement has been updated successfully!";
			redirect(base_url()."my-ads");

		} else {
			redirect(base_url());
		}
	}

	public function do_save_location_browser($lat, $lng){

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $user_ip = $_SERVER['REMOTE_ADDR'];
		}
		$user_ip__ = $this->db->query("SELECT * FROM user_ip WHERE user_ip = '".$user_ip."'")->result_object();
		if(empty($user_ip__)){
			$arr = array(
					'user_ip' => $user_ip,
					'lat'=> $lat,
					'lng'=> $lng,
				);

			$this->db->insert('user_ip',$arr);
			echo 1;
		} else {
			echo 0;
		}
	}


	public function do_add_favorite($id){
		if(isset($_SESSION['LISTYLOGIN'])){
			$whishlist = $this->db->query("SELECT * FROM wishlist WHERE user_id = ".user_info()->id." AND product_id = ".$id)->result_object()[0];
			if(empty($whishlist)){
				$rendomcode = $this->generateRandomString(25);
				$arr = array(
					'user_id' => user_info()->id,
					'product_id'=> $id,
					'created_at'=> date("Y-m-d H:i:s"),
				);
				$this->db->insert('wishlist',$arr);
				$_SESSION['valid'] = "Classified Added to favorites!";
			} else {
				
				$authID = $_SESSION['LISTYLOGIN']->id;
				
				$this->db->query("DELETE FROM wishlist WHERE user_id = $authID AND product_id = $id");
				$_SESSION['valid'] = "Classified removed from favorites!";
				redirect($_SERVER['HTTP_REFERER']);
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function remove_favorites($id){
		if(isset($_SESSION['LISTYLOGIN'])){
			$this->db->query("DELETE FROM wishlist WHERE id = ".$id);
			$_SESSION['valid'] = "Classified removed from favorites!";
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function do_delete_products($id){
		if(isset($_SESSION['LISTYLOGIN'])){
			$this->db->query("DELETE FROM product_images WHERE product_id = ".$id);
			$this->db->query("DELETE FROM products WHERE id = ".$id);
			$_SESSION['valid'] = "Classified deleted successfully!";
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function do_delete_advertisement($id){
		if(isset($_SESSION['LISTYLOGIN'])){
			$this->db->query("DELETE FROM products_ads WHERE id = ".$id);
			$_SESSION['valid'] = "Ad deleted successfully!";
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	// public function get_price_banners($id, $cID){
	// 	$row = $this->db->query("SELECT * FROM payment_plans WHERE FIND_IN_SET('".$cID."', cID) > 0 AND status = 1")->result_object()[0];
	// 	$cat_title = $this->db->query("SELECT * FROM categories WHERE id = ".$cID)->result_object()[0];
	// 	$list = '<label>Classified Display (Website Banners):</label>';
	// 	$list .= '<select name="show_on_banners" class="form-control" onchange="do_sub_plan(this)">';
	// 	$list .= '<option value="">--Choose--</option>';
	// 	$list .= '<option data-amount="'.$row->category_home_page.'" value="category_home_page">Post on '.$cat_title->title.' home page ($'.$row->category_home_page.')</option>';
	// 	$list .= '<option data-amount="'.$row->website_home_category_section.'" value="website_home_category_section">Post on Website home page '.$cat_title->title.' section ($'.$row->website_home_category_section.')</option>';
	// 	$list .= '<option data-amount="'.$row->website_home_banner.'" value="website_home_banner">Post on Website home page banner ($'.$row->website_home_banner.')</option>';
	// 	$list .= '</select>';

	// 	echo $list;
	// }

	public function get_price_banners($id, $cID){
		$row = $this->db->query("SELECT * FROM payment_plans WHERE FIND_IN_SET('".$cID."', cID) > 0 AND status = 1")->result_object()[0];
		$cat_title = $this->db->query("SELECT * FROM categories WHERE id = ".$cID)->result_object()[0];
		$list = '<label class="wd100">Classified Display (Website Banners):</label>';
		$list .= '
		<div class="radio-button">
	      <input type="checkbox" id="ban_1" data-amount="'.$row->category_home_page.'" value="category_home_page" class="new_class_radio payment_banner" name="banner_type[]">
	      <label for="ban_1">Post on '.$cat_title->title.' home page ($'.$row->category_home_page.')</label>
		</div>
		<div class="radio-button">
		      <input type="checkbox" id="ban_2" data-amount="'.$row->website_home_category_section.'" value="website_home_category_section" class="new_class_radio payment_banner" name="banner_type[]">
		      <label for="ban_2">Post on Post on Website home page  '.$cat_title->title.' section ($'.$row->website_home_category_section.')</label>
		</div>
		<div class="radio-button">
		      <input type="checkbox" id="ban_3" data-amount="'.$row->website_home_banner.'" value="website_home_category_section" class="new_class_radio payment_banner" name="banner_type[]">
		      <label for="ban_3">Post on Website home page banner ($'.$row->website_home_banner.')</label>
		</div>';
		echo $list;
	}

	public function do_submit_review(){
		if(isset($_SESSION['LISTYLOGIN'])){
			$arr_img = array(
				'user_id' => user_info()->id,
				'order_id'=> $this->input->post('post_id'),
				'review'=> nl2br($this->input->post('comment')),
				'rating'=> $this->input->post('rt_rating'),
				'title'=> $this->input->post('rt_title'),
				'created_at'=> date("Y-m-d H:i:s"),
			);
			// echo "<pre>";
			// print_r($arr_img);
			// die;

			$productInfo = $this->db->where('id', $this->input->post('post_id'))->get('products')->row();
			$this->db->insert('order_reviews',$arr_img);
			if($productInfo->uID != user_info()->id){
				
				$this->saveNotification(user_info()->id, 'user', 'review-on-classified', $this->input->post('post_id'), notificationContent('review-on-classified'), null, $productInfo->uID, 'review-on-classified');
			}
			$_SESSION['valid'] = "Your review has been posted successfully!";
			redirect($_SERVER['HTTP_REFERER']);

		} else {
			$_SESSION['show_popup_login'] = 1;
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function post_comment_blog(){
		if(isset($_SESSION['LISTYLOGIN'])){
			$arr_img = array(
				'uID' => user_info()->id,
				'bID'=> $this->input->post('post_id'),
				'comment'=> nl2br($this->input->post('comment')),
				'created_at'=> date("Y-m-d H:i:s"),
				'commenter_name' => user_info()->name
			);
			
			$this->db->insert('blog_comment',$arr_img);


			$conf = $this->db->query("SELECT * FROM blogs WHERE id = ".$this->input->post('post_id'))->result_object()[0];
			if($conf->notif == 1 && $conf->uID != user_info()->id){
				$url_click = base_url().'blog/details/'.$conf->slug;
				$user = $this->db->query("SELECT * FROM users WHERE id = ".$conf->uID)->result_object()[0];
				$message = '
					<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$user->name.'</strong>,<br /><br/>
						
						You have received a comment on your blog.
						
						<br><br>
						<a href='.$url_click.'>'.$url_click.'</a>
						<br />	<br />	
						Best Regards,
						<br>
						'.settings()->site_title.'</span>						
				';
				$this->saveNotification(user_info()->id, 'user', 'comment-on-blog', $conf->id, notificationContent('comment-on-blog'), nl2br($this->input->post('comment')), $conf->uID, 'blog');
				$this->do_send_email(settings()->email, $user->email, 'New Comment of blog', $message, 1);
			}


			$_SESSION['valid'] = "Your comment has been posted successfully!";
			redirect($_SERVER['HTTP_REFERER']);

		} else {
			$_SESSION['show_popup_login'] = 1;
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function post_comment_confession(){
		if(isset($_SESSION['LISTYLOGIN'])){

			$type_name = $this->input->post('post_type');
			
			$arr_img = array(
				'uID' => user_info()->id,
				'bID'=> $this->input->post('post_id'),
				'comment'=> nl2br($this->input->post('comment')),
				'created_at'=> date("Y-m-d H:i:s"),
				'commenter_name' => user_info()->name
			);
			
			$this->db->insert('confession_comment',$arr_img);

			$conf = $this->db->query("SELECT * FROM confessions WHERE id = ".$this->input->post('post_id'))->result_object()[0];
			if($conf->notif == 1 && $conf->uID != user_info()->id){
				if($type_name=="forums"){
					$this->saveNotification(user_info()->id, 'user', 'comment-on-forums', $conf->id, notificationContent('comment-on-forums'), nl2br($this->input->post('comment')), $conf->uID, 'forum');
					$url_click = base_url().'forum/details/'.$conf->slug;
				} else {
					$this->saveNotification(user_info()->id, 'user', 'comment-on-confession', $conf->id, notificationContent('comment-on-confession'), nl2br($this->input->post('comment')), $conf->uID, 'confession');
					$url_click = base_url().'confession/details/'.$conf->slug;
				}
				$user = $this->db->query("SELECT * FROM users WHERE id = ".$conf->uID)->result_object()[0];
				$message = '
					<span style="font-family: arial;font-size:12px;line-height:18px;">DEAR <strong>'.$user->name.'</strong>,<br /><br/>
						
						You have received a comment on your '.$type_name.'.
						
						<br><br>
						<a href='.$url_click.'>'.$url_click.'</a>
						<br />	<br />	
						Best Regards,
						<br>
						'.settings()->site_title.'</span>						
				';
				$this->do_send_email(settings()->email, $user->email, 'New Comment of '.$type_name, $message, 1);
			}

			$_SESSION['valid'] = "Your comment has been posted successfully!";
			redirect($_SERVER['HTTP_REFERER']);

		} else {
			$_SESSION['show_popup_login'] = 1;
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function like($id){
		$slug = $this->db->query("SELECT * FROM blogs WHERE id = ".$id)->result_object()[0];
		
		if(isset($_SESSION['LISTYLOGIN'])){
			$check_like = $this->db->query("SELECT * FROM blog_likes WHERE bID = ".$id." AND uID = ".user_info()->id)->result_object()[0];
			$check_dlike = $this->db->query("SELECT * FROM blog_likes WHERE bID = ".$id." AND likebg =  1 AND uID = ".user_info()->id)->result_object()[0];
			if(!empty($check_dlike)){

				$this->db->query("DELETE FROM blog_likes WHERE id = ".$check_like->id);
				$this->saveNotification(user_info()->id, 'user', 'like-remove-on-blog', $id, notificationContent('like-remove-on-blog'), null,$slug->uID, 'blog');
				$_SESSION['valid'] = "You have removed your like!";
			} else {
				$arr_img = array(
					'uID' => user_info()->id,
					'bID'=> $id,
					'created_at'=> date("Y-m-d H:i:s"),
					'likebg'=> 1
				);
				
				if(!empty($check_like)){
					$this->db->where('id', $check_like->id);
					$this->db->update('blog_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'like-on-blog', $id, notificationContent('like-on-blog'), null,$slug->uID, 'blog');

				} else {
					$this->db->insert('blog_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'like-on-blog', $id, notificationContent('like-on-blog'), null,$slug->uID, 'blog');

				}

				$_SESSION['valid'] = "You have liked this blog!";
			}
			redirect($_SERVER['HTTP_REFERER']);

		} else {
			$_SESSION['show_popup_login'] = 1;
			$_SESSION['RETURN'] = "blog/details/".$slug->slug;
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function dislike($id){
		$slug = $this->db->query("SELECT * FROM blogs WHERE id = ".$id)->result_object()[0];
		
		if(isset($_SESSION['LISTYLOGIN'])){

			$check_like = $this->db->query("SELECT * FROM blog_likes WHERE bID = ".$id." AND uID = ".user_info()->id)->result_object()[0];

			$check_dlike = $this->db->query("SELECT * FROM blog_likes WHERE bID = ".$id." AND likebg =  2 AND uID = ".user_info()->id)->result_object()[0];
			if(!empty($check_dlike)){
				$this->db->query("DELETE FROM blog_likes WHERE id = ".$check_like->id);
				$this->saveNotification(user_info()->id, 'user', 'dislike-remove-on-blog', $id, notificationContent('dislike-remove-on-blog'), null ,$slug->uID, 'blog');

				$_SESSION['valid'] = "You have removed your dislike!";
			} else {
				$arr_img = array(
					'uID' => user_info()->id,
					'bID'=> $id,
					'created_at'=> date("Y-m-d H:i:s"),
					'likebg'=> 2
				);
				if(!empty($check_like)){
					$this->db->where('id', $check_like->id);
					$this->db->update('blog_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'dislike-on-blog', $id, notificationContent('dislike-on-blog'), null, $slug->uID, 'blog');

				} else {
					$this->db->insert('blog_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'dislike-on-blog', $id, notificationContent('dislike-on-blog'), null, $slug->uID, 'blog');

				}
				$_SESSION['valid'] = "You have disliked this blog!";
			}
			
			redirect($_SERVER['HTTP_REFERER']);

		} else {
			$_SESSION['show_popup_login'] = 1;
			$_SESSION['RETURN'] = "blog/details/".$slug->slug;
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function like_confession($id){
		
		$slug = $this->db->query("SELECT * FROM confessions WHERE id = ".$id)->result_object()[0];
		
		if(isset($_SESSION['LISTYLOGIN'])){
			$check_like = $this->db->query("SELECT * FROM confession_likes WHERE bID = ".$id." AND uID = ".user_info()->id)->result_object()[0];

			$check_dlike = $this->db->query("SELECT * FROM confession_likes WHERE bID = ".$id." AND likebg =  1 AND uID = ".user_info()->id)->result_object()[0];
			if(!empty($check_dlike)){
				$this->db->query("DELETE FROM confession_likes WHERE id = ".$check_like->id);

				$this->saveNotification(user_info()->id, 'user', 'like-remove-on-confession', $id, notificationContent('like-remove-on-confession'), null, $slug->uID , 'confession');
				$_SESSION['valid'] = "You have removed your like!";
				if(isset($_GET['loc'])){
					echo "3";
					die;
				}
			} else {
				$arr_img = array(
					'uID' => user_info()->id,
					'bID'=> $id,
					'created_at'=> date("Y-m-d H:i:s"),
					'likebg'=> 1
				);
				
				if(!empty($check_like)){
					$this->db->where('id', $check_like->id);
					$this->db->update('confession_likes',$arr_img);
						$this->saveNotification(user_info()->id, 'user', 'like-on-confession', $id, notificationContent('like-on-confession'), null, $slug->uID, 'confession');
					
				} else {
					$this->db->insert('confession_likes',$arr_img);
						$this->saveNotification(user_info()->id, 'user', 'like-on-confession', $id, notificationContent('like-on-confession'), null, $slug->uID, 'confession');
					
				}
				$_SESSION['valid'] = "You have liked this confession!";
			}
			if(!isset($_GET['loc'])){
				redirect($_SERVER['HTTP_REFERER']);
			} else{
				echo "1";
				die;
			}

		} else {
			
			if(isset($_GET['loc'])){
				echo "-1";
				die;
			}

			$_SESSION['show_popup_login'] = 1;
			$_SESSION['RETURN'] = "confession/details/".$slug->slug;
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}




	public function like_forum($id){
		
		$slug = $this->db->query("SELECT * FROM confessions WHERE id = ".$id)->result_object()[0];
		
		if(isset($_SESSION['LISTYLOGIN'])){
			$check_like = $this->db->query("SELECT * FROM confession_likes WHERE bID = ".$id." AND uID = ".user_info()->id)->result_object()[0];

			$check_dlike = $this->db->query("SELECT * FROM confession_likes WHERE bID = ".$id." AND likebg =  1 AND uID = ".user_info()->id)->result_object()[0];
			if(!empty($check_dlike)){
				$this->db->query("DELETE FROM confession_likes WHERE id = ".$check_like->id);
				$this->saveNotification(user_info()->id, 'user', 'like-remove-on-forum', $id, notificationContent('like-remove-on-forum'), null, $slug->uID, 'forum');

				$_SESSION['valid'] = "You have removed your like!";
			} else {
				$arr_img = array(
					'uID' => user_info()->id,
					'bID'=> $id,
					'created_at'=> date("Y-m-d H:i:s"),
					'likebg'=> 1
				);
				
				if(!empty($check_like)){
					$this->db->where('id', $check_like->id);
					$this->db->update('confession_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'like-on-forum', $id, notificationContent('like-on-forum'), null, $slug->uID, 'forum');

				} else {
					$this->db->insert('confession_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'like-on-forum', $id, notificationContent('like-on-forum'), null, $slug->uID, 'forum');

				}
				$_SESSION['valid'] = "You have liked this Forum!";
			}
			if(!isset($_GET['ajax'])){
				redirect($_SERVER['HTTP_REFERER']);
			} else{
				echo "1";
				die;
			}

		} else {
			if(isset($_GET['ajax'])){
				echo "i am hgere";
				echo "-1";
				die;
			}
			
			$_SESSION['show_popup_login'] = 1;
			$_SESSION['RETURN'] = "confession/details/".$slug->slug;
			$_SESSION['invalid'] = "Please login to perform this action!";

			if(!isset($_GET['ajax'])){
				redirect($_SERVER['HTTP_REFERER']);
			} 

		}
	}

	public function dislike_confession($id){
		$slug = $this->db->query("SELECT * FROM confessions WHERE id = ".$id)->result_object()[0];
		
		if(isset($_SESSION['LISTYLOGIN'])){

			$check_like = $this->db->query("SELECT * FROM confession_likes WHERE bID = ".$id." AND uID = ".user_info()->id)->result_object()[0];

			$check_dlike = $this->db->query("SELECT * FROM confession_likes WHERE bID = ".$id." AND likebg =  2 AND uID = ".user_info()->id)->result_object()[0];
			if(!empty($check_dlike)){
				$this->db->query("DELETE FROM confession_likes WHERE id = ".$check_like->id);
				$this->saveNotification(user_info()->id, 'user', 'dislike-remove-on-confession', $id, notificationContent('dislike-remove-on-confession'), null,  $slug->uID, 'confession');

				$_SESSION['valid'] = "You have removed your dislike!";
				if(isset($_GET['loc'])){
					echo "3";
					die;
				}
			} else {
				$arr_img = array(
					'uID' => user_info()->id,
					'bID'=> $id,
					'created_at'=> date("Y-m-d H:i:s"),
					'likebg'=> 2
				);
				if(!empty($check_like)){
					$this->db->where('id', $check_like->id);
					$this->db->update('confession_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'dislike-on-confession', $id, notificationContent('dislike-on-confession'), null, $slug->uID, 'confession');

				} else {
					$this->db->insert('confession_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'dislike-on-confession', $id, notificationContent('dislike-on-confession'), null,  $slug->uID, 'confession');

				}
				$_SESSION['valid'] = "You have disliked this confession!";
			}
			
			if(!isset($_GET['loc'])){
				redirect($_SERVER['HTTP_REFERER']);
			} else{
				echo "1";
				die;
			}
		} else {
			if(isset($_GET['loc'])){
				echo "-1";
				die;
			}
			$_SESSION['show_popup_login'] = 1;
			$_SESSION['RETURN'] = "confession/details/".$slug->slug;
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function dislike_forum($id){
		$slug = $this->db->query("SELECT * FROM confessions WHERE id = ".$id)->result_object()[0];
		
		if(isset($_SESSION['LISTYLOGIN'])){

			$check_like = $this->db->query("SELECT * FROM confession_likes WHERE bID = ".$id." AND uID = ".user_info()->id)->result_object()[0];

			$check_dlike = $this->db->query("SELECT * FROM confession_likes WHERE bID = ".$id." AND likebg =  2 AND uID = ".user_info()->id)->result_object()[0];
			if(!empty($check_dlike)){
				$this->db->query("DELETE FROM confession_likes WHERE id = ".$check_like->id);
				$this->saveNotification(user_info()->id, 'user', 'remove-dislike-on-forum', $id, notificationContent('remove-dislike-on-forum'),null, $slug->uID, 'forum');

				$_SESSION['valid'] = "You have removed your dislike!";
			} else {
				$arr_img = array(
					'uID' => user_info()->id,
					'bID'=> $id,
					'created_at'=> date("Y-m-d H:i:s"),
					'likebg'=> 2
				);
				if(!empty($check_like)){
					$this->db->where('id', $check_like->id);
					$this->db->update('confession_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'dislike-on-forum', $id, notificationContent('dislike-on-forum'), null,  $slug->uID, 'forum');

				} else {
					$this->db->insert('confession_likes',$arr_img);
					$this->saveNotification(user_info()->id, 'user', 'dislike-on-forum', $id, notificationContent('dislike-on-forum'), null,  $slug->uID, 'forum');

				}
				$_SESSION['valid'] = "You have disliked this forum!";
			}
			
			redirect($_SERVER['HTTP_REFERER']);

		} else {
			$_SESSION['show_popup_login'] = 1;
			$_SESSION['RETURN'] = "forum/details/".$slug->slug;
			$_SESSION['invalid'] = "Please login to perform this action!";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function do_check_login_user(){
		if(isset($_SESSION['LISTYLOGIN'])){
			echo 1;
		} else {
			echo 99;
		}
	}



	public function searchClassifiedsByCountry()
	{
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
			$countryCode = $this->input->post('countryCode');
			$countryInfo = $this->db->where('code', $countryCode)->get('admin_countries')->row();
			$countryId = $countryInfo->id;
			
			$userCityName = $this->input->post('userCityName');
			$keyword = $this->input->post('keyword');

			$this->session->set_userdata('keyword', $keyword);
			$this->session->set_userdata('userCityName', $userCityName);
			$this->session->set_userdata('countryId', $countryId);

			 // Redirect to the same function (GET request)
			 redirect(current_url());

		}else{
			
			$keyword = $this->session->userdata('keyword');
			$userCityName = $this->session->userdata('userCityName');
			$countryId = $this->session->userdata('countryId');
		}

		if($countryId && $userCityName != '') {
			
			$listOfClassifieds = $this->db->group_start()
			->like('LOWER(title)', strtolower($keyword), 'both')
			->or_like("LOWER(JSON_EXTRACT(json_content, '$.description'))", strtolower($keyword), 'both')
			->group_start()
			->where('city_id', $userCityName)
			->or_where('LOWER(city)', strtolower($userCityName))
			->or_where('LOWER(state)', strtolower($userCityName))
			->group_end()
			->group_end()
			->where('country_id', $countryId)	
		->where('status', 1)
		->where('expiry_date >', date('Y-m-d'))
		->get('products')
		->result_object();

		
		}

		if($countryId && $userCityName == '') {
			
			$listOfClassifieds = $this->db->group_start()
                                  ->like('LOWER(title)', strtolower($keyword), 'both')
								  ->or_like("LOWER(JSON_EXTRACT(json_content, '$.description'))", strtolower($keyword), 'both')
								  ->group_end()
                                  ->where('country_id', $countryId)
                              ->where('status', 1)
							  ->where('expiry_date >', date('Y-m-d'))
                              ->get('products')
                              ->result_object();

		}

		if(empty($listOfClassifieds)) {
			 redirect(base_url());
			die;
		}

		$this->data['page_url'] = "classifieds";
		$this->data['slug'] = $id;
		$this->data['tags'] = 0;
		$this->data['show_home'] = 0;
		$this->data['all_products'] = $listOfClassifieds;
		$this->load->view('frontend/search_classifieds.php',$this->data);

	}


	public function searchClassifiedsByCountryCopy()
{
    $countryCode = $this->input->post('countryCode');
    $countryInfo = $this->db->where('code', $countryCode)->get('admin_countries')->row();
    $countryId = $countryInfo->id;

    if ($this->input->post('keyword') !== null && $this->input->post('userCityName') !== null) {
        $keyword = $this->input->post('keyword');
        $userCityName = $this->input->post('userCityName');
        
		$this->session->set_userdata('countryId', $countryId);
		$this->session->set_userdata('keyword', $keyword);
        $this->session->set_userdata('userCityName', $userCityName);
    } else {
		
        $keyword = $this->session->userdata('keyword');
		$countryId = $this->session->userdata('countryId');
		$userCityName = $this->session->userdata('userCityName');
    }

    if ($countryId && $userCityName != '') {
        $this->db->like('LOWER(title)', strtolower($keyword), 'both');
        $listOfClassifieds = $this->db->where('country_id', $countryId)->where('city_id', $userCityName)->where('status', 1)->get('products')->result_object();
    }

    if ($countryId && $userCityName == '') {
        $this->db->like('LOWER(title)', strtolower($keyword), 'both');
        $listOfClassifieds = $this->db->where('country_id', $countryId)->where('status', 1)->get('products')->result_object();
    }

    $this->data['page_url'] = "classifieds";
    $this->data['slug'] = $id;
    $this->data['tags'] = 0;
    $this->data['show_home'] = 0;
    $this->data['all_products'] = $listOfClassifieds;
    $this->load->view('frontend/search_classifieds.php', $this->data);
}

public function promoteValidation()
{
	//Expire sab ad check karni ha ky show na hon.
	//sliders ma sirf expire ko check kar raha ho jaha par sigle images han waha par count b check kar raha ho

	$adTypeArr = $this->input->post('adType');
	$adLocation = $this->input->post('adLocation');
	$category = $this->input->post('categoryType');
	$userId = $_SESSION['LISTYLOGIN']->id;
	$currentDate = date('Y-m-d');
	$userCountryId = $_COOKIE['user_country_id'];
	// echo json_encode(['adLocation' => $adLocation, 'adType' => $adType, 'category' => $category]);
	// 		http_response_code(200);
	// 		die;

	$checkCount = 0;
	$loopKeys = 0;
	foreach($adTypeArr as $key => $adType) {
		$loopKeys++;
		if($adType == 'home_middle' || $adType == 'web_footer') {
			$countSaveAds = 0;
			if($adType == 'home_middle') {
				$countSaveAds = 5;
			}else if($adType == 'web_footer') {
				$countSaveAds = 8;
			}
			
			
			$countAds = $this->db->where('ad_for', $adType)
			->where('country_id', $userCountryId)
			->where('ad_expires >', $currentDate)
			->count_all_results('products_ads');
	
			
			if($countAds >= $countSaveAds) {
				$checkExistAds = $this->db->where('ad_for', $adType)->where('country_id', $userCountryId)->where('ad_expires > ', $currentDate)->order_by('ad_expires', 'ASC')->get('products_ads')->row();
				$expireTimestamp = strtotime($checkExistAds->ad_expires);
				$currentTimestamp = strtotime($currentDate);
				$remainingTimeSeconds = $expireTimestamp - $currentTimestamp;
				$remainingTimeDays = floor($remainingTimeSeconds / (60 * 60 * 24));
				echo json_encode(['message' => 'already_added_home_middle', 'left_days' => $remainingTimeDays]);
				http_response_code(200);
				die;
			}
		}else if($adType == 'blog' || $adType == 'forum' || $adType == 'confession') {
			if($adLocation == 'right_banner') {
				$checkExistAds = $this->db->where('country_id', $userCountryId)->where('ad_for', $adType)->where('ad_location', $adLocation)->where('ad_expires > ', $currentDate)->get('products_ads')->row();
				if(!empty($checkExistAds)) {
					$expireTimestamp = strtotime($checkExistAds->ad_expires);
					$currentTimestamp = strtotime($currentDate);
					$remainingTimeSeconds = $expireTimestamp - $currentTimestamp;
					$remainingTimeDays = floor($remainingTimeSeconds / (60 * 60 * 24));
					if($checkExistAds->user_id == $userId) {
						echo json_encode(['message' => 'already_added_this_user', 'left_days' => $remainingTimeDays]);
						http_response_code(200);
						die;
		 
					}else{
						echo json_encode(['message' => 'already_added_other_user', 'left_days' => $remainingTimeDays]);
						http_response_code(200);
						die;
					}
				}
			}
		}else if($adType == 'cat_right') {
			$checkExistAds = $this->db->where('country_id', $userCountryId)->where('category', $category)->where('ad_for', $adType)->where('ad_expires > ', $currentDate)->get('products_ads')->row();
			if(!empty($checkExistAds)) {
				$expireTimestamp = strtotime($checkExistAds->ad_expires);
				$currentTimestamp = strtotime($currentDate);
				$remainingTimeSeconds = $expireTimestamp - $currentTimestamp;
				$remainingTimeDays = floor($remainingTimeSeconds / (60 * 60 * 24));
				if($checkExistAds->user_id == $userId) {
					echo json_encode(['message' => 'already_added_this_user', 'left_days' => $remainingTimeDays]);
					http_response_code(200);
					die;
	 
				}else{
					echo json_encode(['message' => 'already_added_other_user', 'left_days' => $remainingTimeDays]);
					http_response_code(200);
					die;
				}
			}
		}

		$checkCount++;
	}

	if($checkCount == $loopKeys) {
		echo json_encode(['message' => 'not_found']);
		http_response_code(200);
		die;
	}


}
	

	public function do_delete_blog_comment($id) 
	{
		$this->db->where('id', $id)->delete('blog_comment');
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function do_delete_confession_comment($id) 
	{
		$this->db->where('id', $id)->delete('confession_comment');
		redirect($_SERVER['HTTP_REFERER']);
	}



	public function deleteAccount()
	{	
		
		if(isset($_SESSION['LISTYLOGIN'])){
			$this->data['page_url'] = "deleteaccount";
			$this->data['show_footer_ad'] = 1;
			$this->data['title_page'] = 'Delete Your Account';
			$this->load->view('frontend/delete_account',$this->data);
		}else {
			redirect(base_url());
		}
	}

	public function removeAccount()
    {

		$confirmationText = $this->input->post('confirmation');
		$checkConfirmation = trim($confirmationText) === 'DELETE';

		if(!empty($checkConfirmation) && $checkConfirmation == 1) {
			
			$userId = user_info()->id;
    
			// Start transaction
			$this->db->trans_begin();
	
			try {
				// Retrieve and delete user's blogs and related data
				$blogIds = $this->db->select('id')->where('uID', $userId)->get('blogs')->result_array();
				$blogIds = array_column($blogIds, 'id');
	
				if (!empty($blogIds)) {
					$this->db->where_in('bID', $blogIds)->delete('blog_comment');
					$this->db->where_in('bID', $blogIds)->delete('blog_likes');
				}
	
				$this->db->where('uID', $userId)->delete('blogs');
				$this->db->where('uID', $userId)->delete('blog_comment');
				$this->db->where('uID', $userId)->delete('blog_likes');
	
				// Retrieve and delete user's confessions and related data
				$confessionIds = $this->db->select('id')->where('uID', $userId)->get('confessions')->result_array();
				$confessionIds = array_column($confessionIds, 'id');
	
				if (!empty($confessionIds)) {
					$this->db->where_in('bID', $confessionIds)->delete('confession_comment');
					$this->db->where_in('bID', $confessionIds)->delete('confession_likes');
				}
	
				$this->db->where('uID', $userId)->delete('confessions');
				$this->db->where('uID', $userId)->delete('confession_comment');
				$this->db->where('uID', $userId)->delete('confession_likes');
	
				// Delete user's products and related data
				$this->db->where('uID', $userId)->delete('products');
				$this->db->where('user_id', $userId)->delete('products_ads');
				$this->db->where('user_id', $userId)->delete('wishlist');
	
				$userInfo = $this->db->where('id', $userId)->get('users')->row();
				$message = '
					<span style="font-family: Arial; font-size: 12px; line-height: 18px;">
						Dear <strong>' . $userInfo->name . '</strong>,<br /><br/>
						
						This is to confirm that your account has been successfully deleted at your request.<br />
						We are sorry to see you go, but we respect your decision.<br /><br />
						
						Thank you for being a part of ' . settings()->site_title . '.<br /><br />
						
						Best Regards,<br>
						The ' . settings()->site_title . ' Team
					</span>';
	
				$this->do_send_email(settings()->email, $userInfo->email , 'Delete Your Account', $message, 0, 0);
	
	
				// Delete user account
				$this->db->where('id', $userId)->delete('users');
	
				// Commit transaction
				if ($this->db->trans_status() === FALSE) {
					$_SESSION['invalid'] = "Some Error Occurred!";
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$this->db->trans_commit();
				}
	
				// Destroy user session and redirect to homepage
				unset($_SESSION["LISTYLOGIN"]);
				session_destroy();
				redirect(base_url());
			} catch (Exception $e) {
				// Rollback transaction in case of error
				$this->db->trans_rollback();
				$_SESSION['invalid'] = "Some Error Occurred!";
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$_SESSION['invalid'] = "Invalid Confirmation value.";
			redirect($_SERVER['HTTP_REFERER']);
		}

		
    }


public function ghraph_views()
{
	
$current_year = date('Y');

// Query to get the views per month for the current year
$query = $this->db->select('MONTH(created_at) as month, COUNT(*) as views')
                  ->where('product_creator_id', user_info()->id)
                  ->where('YEAR(created_at)', $current_year)
                  ->group_by('MONTH(created_at)')
                  ->order_by('MONTH(created_at)')
                  ->get('views');

$results = $query->result_array();
$monthly_views = array_fill(1, 12, 0);

foreach ($results as $key => $result) {
    if ($key == 0) {
        $monthly_views[$result['month']] = intval($result['views']);
    } else {
        $monthly_views[$result['month']] = $result['views'];
    }
}

// Get full month names
$month_names = [
    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 
    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 
    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
];

// Format the result as needed
$formatted_monthly_views = [];
for ($month = 1; $month <= 12; $month++) {
    $formatted_monthly_views[] = [
        $month_names[$month],
        $monthly_views[$month]
    ];
}

	http_response_code(200);
	echo json_encode($formatted_monthly_views);

}


public function applyCoupon()
{
	try{

	
		$coupon = $this->input->post('coupon');
		$price = $this->input->post('price');
		$selectAdType = $this->input->post('selectAdType');
		$planAmount = $this->input->post('planAmount');
		$subPlanAmount = $this->input->post('subPlanAmount');
		$categoryID = $this->input->post('categoryID');

		if($categoryID != 0) {
			$couponInfo = $this->db->where('category_id', $categoryID)->where('coupon_code', $coupon)->where('status', 1)->get('coupons')->row();
		}else if($categoryID == 0) {
			$couponInfo = $this->db->where('coupon_code', $coupon)->where('status', 1)->get('coupons')->row();
		}
		
		
		
		if(!empty($couponInfo)) {

			$currentDate = date('Y-m-d');
			if($couponInfo->start_date <= $currentDate && $couponInfo->end_date > $currentDate) {
				
				if($couponInfo->discount_type == 1) {
					$calculate = floatval($price) - floatval($couponInfo->discount);
					$totalAmount = $calculate;
					$discountedAmount = $couponInfo->discount;
					
				}else if($couponInfo->discount_type == 0){
					$calculate = floatval($price) - floatval(($price * $couponInfo->discount) / 100);
					$totalAmount = $calculate;
					$discountedAmount = ($price * $couponInfo->discount) / 100;
				}	


				if($totalAmount <= 0) {
					$totalAmount = 'discount_exceeds';
				
				}else{

					$existRecord = $this->db->where('user_id', user_info()->id)->get('history_of_before_apply_coupons')->row();
					if(empty($existRecord)) {
						$this->db->insert('history_of_before_apply_coupons', [
							'user_id' => user_info()->id,
							'is_select_ad_type' => $selectAdType,
							'plan_amount' => $planAmount,
							'total_amount' => $subPlanAmount,
							'discounted_amount' => $discountedAmount
						]);
					}else if(!empty($existRecord)){
						$this->db->where('id', $existRecord->id)->update('history_of_before_apply_coupons', [
							'is_select_ad_type' => $selectAdType,
							'plan_amount' => $planAmount,
							'total_amount' => $subPlanAmount,
							'discounted_amount' => $discountedAmount
						]);
					}
				}	
			}else if($couponInfo->start_date > $currentDate)  {
				http_response_code(200);
				echo json_encode('false');
				die;
			}else if($couponInfo->end_date <= $currentDate) {
				http_response_code(200);
				echo json_encode('expired');
				die;
			}
			

			http_response_code(200);
			echo json_encode([$totalAmount]);
		}else{
			http_response_code(200);
			echo 
			('false');
		}
	}catch(Exception $e) {
		
		http_response_code(200);
		echo json_encode('false'. $e->getMessage());
	}

	}



	public function cancelCoupon()
	{

		$couponInfo = $this->db->where('user_id', user_info()->id)->get('history_of_before_apply_coupons')->row();

		if(!empty($couponInfo)) {
			$this->db->where('user_id', user_info()->id)->delete('history_of_before_apply_coupons');
			http_response_code(200);
			echo json_encode($couponInfo);
		}else{
			http_response_code(200);
			echo json_encode('false');
		}
		
	}



// 	public function chat($productId)
// 	{

// 		if(isset($_SESSION['LISTYLOGIN'])) {
// 			$this->data['page_url'] = "classifieds";
// 			$this->data['slug'] = 'chat';
// 			$this->data['tags'] = 0;
// 			$this->data['show_home'] = 0;

			

// 			 $productInfo = $this->db->where('id', $productId)->get('products')->row();

// 			if(!empty($productInfo)) {
// 				$check = $this->db->where('product_id', $productId)->where('user_id', user_info()->id)->get('conversations')->row();
// 				if(empty($check) && $productInfo->uID != user_info()->id) {
// 					$this->db->insert('conversations', ['product_id' => $productId, 'product_creator_id' => $productInfo->uID, 'user_id' => user_info()->id, 'user_2' => $productInfo->uID, 'created_at' => date('Y-m-d H:i:s')]);
// 				}
// 			}
			
// 			$getConversation = $this->db->where('product_id', $productId)->get('conversations')->row();
			
// 			if($getConversation->product_creator_id == user_info()->id) {
// 				$allConversation = $this->db->where('product_id', $productId)->order_by('id', 'DESC')->get('conversations')->result_object();
// 			}else if($getConversation->product_creator_id != user_info()->id) {
				
// 				 $allConversation = $this->db->where('product_id', $productId)->where('user_id', user_info()->id)->get('conversations')->result_object();
// 			}

			

// 			if(isset($_GET['conversation_id']) ) {
// 				$conversationId = $_GET['conversation_id'];
// 				$chats = $this->db->where('conversation_id', $_GET['conversation_id'])->order_by('id', 'ASC')->get('chats')->result_object();
// 				$this->db->where('conversation_id', $_GET['conversation_id'])->update('chats', ['seen' => 1]);
// 				$conversationInfo = $this->db->where('id', $conversationId)->get('conversations')->row();
// 				$name = $_GET['name'];
// 			}else{
// 				$conversationId = 0;
// 				$name = '';
// 				$chats = [];
// 				$conversationInfo = [];
// 			}



// 			$this->data['productInfo'] = $productInfo;
// 			$this->data['conversations_all'] = $allConversation;
// 			$this->data['productId'] = $productId;
// 			$this->data['chat'] = $chats;
// 			$this->data['conversationId'] = $conversationId;
// 			$this->data['name'] = $name;
// 			$this->load->view('frontend/chat.php',$this->data);

// 	}else{
		  
// 		$_SESSION['invalid'] = "Please login to post your ads!";
// 		$_SESSION['RETURN'] = 'promote';
// 		$_SESSION['show_popup_login'] = 1;
// 		redirect($_SERVER['HTTP_REFERER']);
// 	}

// }


public function chat($productId)
	{
		
		if(isset($_SESSION['LISTYLOGIN'])) {
			$this->data['page_url'] = "classifieds";
			$this->data['slug'] = 'chat';
			$this->data['tags'] = 0;
			$this->data['show_home'] = 0;

			 $productInfo = $this->db->where('id', $productId)->get('products')->row();

			if(!empty($productInfo)) {
				$check = $this->db->where('product_id', $productId)->where('user_id', user_info()->id)->get('conversations')->row();
				if(empty($check) && $productInfo->uID != user_info()->id) {
					$this->db->insert('conversations', ['product_id' => $productId, 'product_creator_id' => $productInfo->uID, 'user_id' => user_info()->id, 'user_2' => $productInfo->uID, 'created_at' => date('Y-m-d H:i:s')]);
					$conversationID = $this->db->insert_id();
					$conversationInfo = $this->db->where('id', $conversationID)->get('conversations')->row();
					$this->db->insert('chats', ['conversation_id' =>  $conversationID, 'sender_id' => $conversationInfo->product_creator_id, 'receiver_id' => user_info()->id, 'sender_type' => 'creator', 'created_at' => date('Y-m-d H:i:s'), 'message' => 'Thank you for reaching out! How can we assist you further?', 'file_type' => 'message']);

				}else{
					$conversationID = $check->id;
				}
			}

			if(!empty($conversationID)) {
				$conversationInfo = $this->db->where('id', $conversationID)->get('conversations')->row();
			
				if(user_info()->id == $conversationInfo->user_id){
					$userInfo = $this->db->where('id', $conversationInfo->user_2)->get('users')->row();
					
					}else if(user_info()->id == $conversationInfo->user_2){
					$userInfo = $this->db->where('id', $conversationInfo->user_id)->get('users')->row();
				}	

				if(isset($_SESSION['PRODUCT_SLUG'] ) && $_SESSION['PRODUCT_SLUG'] != 'dashboard') {

					if(isset($_GET['slug']) && $_GET['slug'] != 'dashboard'){
						$_SESSION['PRODUCT_SLUG'] = $_GET['slug'];
					}else{
						$productSlug = $_SESSION['PRODUCT_SLUG'];
					}
				
				}else{
					if(isset($_GET['slug']) && $_GET['slug'] != 'dashboard'){

						$_SESSION['PRODUCT_SLUG'] = $_GET['slug'];
						$productSlug = $_SESSION['PRODUCT_SLUG'];
					}
				
				}

				return redirect(base_url().'my-chats?slug='.$productSlug.'&&conversation_id='.$conversationID.'&&name='.$userInfo->name.'&&redirect-by=product&&product-id='.$productId);
			}
			

				
	}else{
		  
		$_SESSION['invalid'] = "Please login to post your ads!";
		$_SESSION['RETURN'] = 'promote';
		$_SESSION['show_popup_login'] = 1;
		redirect($_SERVER['HTTP_REFERER']);
	}

}



public function chatMain($productId)
	{
		
		if(isset($_SESSION['LISTYLOGIN'])) {
			$this->data['page_url'] = "classifieds";
			$this->data['slug'] = 'chat';
			$this->data['tags'] = 0;
			$this->data['show_home'] = 0;

			 $productInfo = $this->db->where('id', $productId)->get('products')->row();

			if(!empty($productInfo)) {
				$check = $this->db->where('product_id', $productId)->where('user_id', user_info()->id)->get('conversations')->row();
				if(empty($check) && $productInfo->uID != user_info()->id) {
					$this->db->insert('conversations', ['product_id' => $productId, 'product_creator_id' => $productInfo->uID, 'user_id' => user_info()->id, 'user_2' => $productInfo->uID, 'created_at' => date('Y-m-d H:i:s')]);
				}
			}
			
			$getConversation = $this->db->where('product_id', $productId)->get('conversations')->row();
			
			if($getConversation->product_creator_id == user_info()->id) {
				$allConversation = $this->db->where('product_id', $productId)->order_by('id', 'DESC')->get('conversations')->result_object();
			}else if($getConversation->product_creator_id != user_info()->id) {
				
				 $allConversation = $this->db->where('product_id', $productId)->where('user_id', user_info()->id)->get('conversations')->result_object();
			}

			

			if(isset($_GET['conversation_id']) ) {
				$conversationId = $_GET['conversation_id'];
				$chats = $this->db->where('conversation_id', $_GET['conversation_id'])->order_by('id', 'ASC')->get('chats')->result_object();
				$this->db->where('conversation_id', $_GET['conversation_id'])->where('receiver_id', user_info()->id)->update('chats', ['seen' => 1]);
				$conversationInfo = $this->db->where('id', $conversationId)->get('conversations')->row();
				$name = $_GET['name'];
			}else{
				$conversationId = 0;
				$name = '';
				$chats = [];
				$conversationInfo = [];
			}


			$this->data['redirectBy'] = 'product';
			$this->data['productInfo'] = $productInfo;
			$this->data['conversations_all'] = $allConversation;
			$this->data['productId'] = $productId;
			$this->data['chat'] = $chats;
			$this->data['conversationId'] = $conversationId;
			$this->data['name'] = $name;
			// $this->load->view('frontend/chat.php',$this->data);
			$this->load->view('frontend/my_chat.php',$this->data);


	}else{
		  
		$_SESSION['invalid'] = "Please login to post your ads!";
		$_SESSION['RETURN'] = 'promote';
		$_SESSION['show_popup_login'] = 1;
		redirect($_SERVER['HTTP_REFERER']);
	}

}


	public function myChats()
	{
		
		if(isset($_SESSION['LISTYLOGIN'])) {
			$this->data['page_url'] = "classifieds";
			$this->data['show_footer_ad'] = 1;
			$this->data['slug'] = 'chat';
			$this->data['tags'] = 0;
			$this->data['show_home'] = 0;
			
			$redirectBy = $_GET['redirect-by'];
			$allConversation = $this->db->where('user_id', user_info()->id)->or_where('user_2', user_info()->id)->order_by('id', 'DESC')->get('conversations')->result_object();
			
			if(isset($_GET['conversation_id']) ) {
				
				$conversationId = $_GET['conversation_id'];
				$chats = $this->db->where('conversation_id', $_GET['conversation_id'])->order_by('id', 'ASC')->get('chats')->result_object();
				$this->db->where('conversation_id', $_GET['conversation_id'])->where('receiver_id', user_info()->id)->update('chats', ['seen' => 1]);
				$conversationInfo = $this->db->where('id', $conversationId)->get('conversations')->row();
				$name = $_GET['name'];
			}else{
				$conversationId = 0;
				$name = '';
				$chats = [];
				$conversationInfo = [];
			}

			

			$backURL = '';
			
			if(isset(  $_GET['slug'] )  && $_GET['slug'] == 'dashboard'){
				$_SESSION['PRODUCT_SLUG'] = 'dashboard';
				$backURL = base_url().'dashboard';
			}else if(isset($_SESSION['PRODUCT_SLUG']) && $_SESSION['PRODUCT_SLUG'] != 'dashboard'){
				$backURL = base_url().'classified/detail/'.$_SESSION['PRODUCT_SLUG'];
			}else if(isset($_SESSION['PRODUCT_SLUG']) && $_SESSION['PRODUCT_SLUG'] == 'dashboard'){
				$backURL = base_url().'dashboard';
			}

			$this->data['backURL'] = $backURL;
			$this->data['redirectBy'] = $_GET['redirect-by'] ? $_GET['redirect-by'] : 'mychat';
			$this->data['conversations_all'] = $allConversation;
			$this->data['chat'] = $chats;
			$this->data['conversationId'] = $conversationId;
			$this->data['name'] = $name;
			$this->data['productId'] = $_GET['product-id'] ? $_GET['product-id'] : 0;
			$this->load->view('frontend/my_chat.php',$this->data);

	}else{
		  
		$_SESSION['invalid'] = "Please login to post your ads!";
		$_SESSION['RETURN'] = 'promote';
		$_SESSION['show_popup_login'] = 1;
		redirect($_SERVER['HTTP_REFERER']);
	}
	}



	public function send_message()
	{
		$message = $this->input->post('message');
		$conversationId = $this->input->post('conversationId');
		$fileTitle = $this->input->post('file_title');
		$file_type = $this->input->post('file_type');
		$file = '';
		if((isset($_FILES['file']) && $_FILES['file']['size'] > 0)) {
			$image = $this->image_upload('file','./resources/uploads/classified-listing/','jpg|jpeg|png|gif|svg|csv|pptx|ppt|xlsx|xls|docx|doc|pdf');
			if($image['upload'] == true || $_FILES['file']['size']<1){
				$image = $image['data'];
				$file = $this->data['classified_BASE_URL'].$image['file_name'];
			}
		}


		$convoInfo = $this->db->where('id', $conversationId)->get('conversations')->row();

		if(user_info()->id == $convoInfo->user_id) {
			$receiverId = $convoInfo->product_creator_id;
			$sender_type = 'user';
		}else if(user_info()->id == $convoInfo->product_creator_id) {
			$receiverId = $convoInfo->user_id;
			$sender_type = 'creator';
		}

		$this->db->insert('chats', ['conversation_id' =>  $conversationId, 'sender_id' => user_info()->id, 'receiver_id' => $receiverId, 'sender_type' => $sender_type, 'created_at' => date('Y-m-d H:i:s'), 'message' => $message, 'file' => $file, 'file_title' => $fileTitle, 'file_type' => $file_type]);
		$insertedId = $this->db->insert_id();

		if(!empty($insertedId)) {
			$this->saveNotification($receiverId, 'user', 'new-message', $conversationId, 'You have received a new message', null, $receiverId, 'new-message');

			$getInsertedData = $this->db->where('id', $insertedId)->get('chats')->row();
			http_response_code(200);
			echo json_encode(['status' => true, 'chat' => $getInsertedData]);
		}else{
			http_response_code(200);
			echo json_encode(['status' => false]);
		}

		
	}

	public function get_message()
	{
		$conversationId = $this->input->post('conversationId');
		$allConversation = $this->db->where('user_id', user_info()->id)->or_where('user_2', user_info()->id)->order_by('id', 'DESC')->get('conversations')->result_object();

		if(!empty($conversationId)) {

			$chats = $this->db->where('conversation_id', $conversationId)->order_by('id', 'ASC')->get('chats')->result_object();
			$this->db->where('conversation_id', $conversationId)->where('receiver_id', user_info()->id)->update('chats', ['seen' => 1]);
			$this->data['chat'] = $chats;
			$this->load->view('frontend/common/chat.php',$this->data);

		}else{
			$this->data['chat'] = [];
			$this->load->view('frontend/common/chat.php',$this->data);
		}

		
	}


	public function get_message_backup()
	{
		$conversationId = $this->input->post('conversationId');
		$allConversation = $this->db->where('user_id', user_info()->id)->or_where('user_2', user_info()->id)->order_by('id', 'DESC')->get('conversations')->result_object();

		if(!empty($conversationId)) {

			$chats = $this->db->where('conversation_id', $conversationId)->where('receiver_id', user_info()->id)->where('seen', 0)->order_by('id', 'ASC')->get('chats')->result_object();
			$this->db->where('conversation_id', $conversationId)->where('receiver_id', user_info()->id)->update('chats', ['seen' => 1]);
				// $this->db->where('conversation_id', $conversationId)->where('sender_type', 'creator')->update('chats', ['seen' => 1]);
			

			http_response_code(200);
			echo json_encode(['status' => true, 'chats' => $chats, 'conversation' => $allConversation]);


			// $convoInfo = $this->db->where('id', $conversationId)->get('conversations')->row();

			// if(user_info()->id == $convoInfo->user_id) {
	
				
	
			// }else if(user_info()->id == $convoInfo->product_creator_id) {
	
			// 	$chats = $this->db->where('conversation_id', $conversationId)->where('receiver_id', user_info()->id)->where('seen', 0)->order_by('id', 'ASC')->get('chats')->result_object();
			// 	$this->db->where('conversation_id', $conversationId)->where('receiver_id', user_info()->id)->update('chats', ['seen' => 1]);
			// 	// $this->db->where('conversation_id', $conversationId)->where('sender_type', 'user')->update('chats', ['seen' => 1]);
			// 	http_response_code(200);
			// 	echo json_encode(['status' => true, 'chats' => $chats]);
			// }
		}else{
			http_response_code(200);
			echo json_encode(['status' => true, 'chats' => $chats, 'conversation' => $allConversation]);
		}

		
	}






	public function saveNotification($userId, $notificationFor, $type, $indicateID, $text, $comment = null, $creatorId= null, $indicate)
	{

		if($indicate == 'blog') {
			$query = $this->db->query("SELECT * FROM blogs WHERE id = ".$indicateID)->result_object()[0];
			$slug = $query->slug;
			$indicate_title = $query->title;
		}else if($indicate == 'confession' || $indicate == 'forum') {
			$query = $this->db->query("SELECT * FROM confessions WHERE id = ".$indicateID)->result_object()[0];
			$slug = $query->slug;
			$indicate_title = $query->title;
		}else if($indicate == 'review-on-classified') {
			$query = $this->db->query("SELECT * FROM products WHERE id = ".$indicateID)->result_object()[0];
			$slug = $query->slug;
			$indicate_title = $query->title;
		}else if($indicate == 'new-message') {
			$chatInfo = $this->db->where('conversation_id', $indicateID)->order_by('id', 'DESC')->get('chats')->row();
			$query = $this->db->query("SELECT * FROM users WHERE id = ".$chatInfo->sender_id)->result_object()[0];
			$slug = $query->name;
		}

		$this->db->insert('all_notifications', [
			'user_id' => $userId,
			'creator_id' => $creatorId,
			'notification_for' => $notificationFor,
			'notification_indicate' => $indicate,
			'type' => $type,
			'indicate_id' => $indicateID,
			'indicate_slug' => $slug,
			'indicate_title' => $indicate_title,
			'text' => $text,
			'comment' => $comment,
			'created_at' => date('Y-m-d H:i')
		]);

		return true;
	}



	public function getNotifiationCount()
{
    $old_count = isset($_SESSION['NOTIFIATION_COUNT']) ? $_SESSION['NOTIFIATION_COUNT'] : 0;

    $count = $this->db->where('notification_for', 'user')
                      ->where('creator_id', user_info()->id)
                      ->where('seen', 0)
                      ->get('all_notifications')
                      ->num_rows();

    $notification = $this->db->where('notification_for', 'user')
                             ->where('creator_id', user_info()->id)
                             ->where('seen', 0)
                             ->order_by('id', 'DESC')
                             ->get('all_notifications')
                             ->result_array();

    if (!empty($notification)) {
        $notification = $notification[0]['creator_id'];
    } else {
        $notification = '';
    }

    $_SESSION['NOTIFIATION_COUNT'] = $count;


	$chatCount = $this->db->where('receiver_id', user_info()->id)->where('seen', 0)->get('chats')->num_rows();
	$allConversations = $this->db->where('user_id', user_info()->id)->or_where('user_2', user_info()->id)->order_by('id', 'DESC')->get('conversations')->result();

    // Load the conversations view and capture the output
    $this->data['conversations_all'] = $allConversations;
    $conversationsHtml = $this->load->view('frontend/common/conversations.php', $this->data, true);


    http_response_code(200);
    echo json_encode(['count' => $count, 'old_count' => $old_count, 'creator_id' => $notification, 'chat_count' => $chatCount, 'conversations_html' => $conversationsHtml]);
}


	public function delete_review($id) {

		$this->db->where('id', $id)->delete('order_reviews');
		$_SESSION['valid'] = "Review deleted successfully.";
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function delete_all_chat($id) {
		$this->db->where('conversation_id', $id)->delete('chats');
		$this->db->where('id', $id)->delete('conversations');
		$_SESSION['valid'] = "All messages deleted successfully.";
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function promotion_payment_success()
	{			
		require 'vendor/autoload.php';

		\Stripe\Stripe::setApiKey($this->stripeSecretKey()); // Stripe Secret Key

		 $session_id = $_GET['session_id'] ?? null;
		 $payment_intent_id = '';
		if ($session_id) {
			try {
				$session = \Stripe\Checkout\Session::retrieve($session_id);
				$payment_intent_id = $session->payment_intent;

			} catch (Exception $e) {
				$session = [];
			}
		} else {
			$session = [];
		}

		$this->db->trans_begin();
		try{

		$insertedIds = $_GET['ids'];
		$imgs = $_GET['types'];
		$userId = $_GET['userid'];

		$idsArr = [];
		$imgTypeArr = [];
		if(!empty($insertedIds) && !empty($imgs)) {
			$idsArr = explode(',', $insertedIds);
			$imgTypeArr = explode(',', $imgs);
		}

		
		foreach($idsArr as $key => $insertedId) { 
			$getTemporaryAds = $this->db->where('id', $insertedId)->get('temporary_products_ads')->row();
			$this->db->where('id', $insertedId)->delete('temporary_products_ads');
			
			if ($getTemporaryAds) {
				$temporaryAdsArray = (array)$getTemporaryAds;
				unset($temporaryAdsArray['id']);
				$temporaryAdsArray['payment_status'] = 'completed';
				$temporaryAdsArray['payment_object'] = json_encode($session);
				$temporaryAdsArray['stripe_transaction_id'] = $payment_intent_id;
				$this->db->insert('products_ads', $temporaryAdsArray);
				$newProductId = $this->db->insert_id();

				$adCategoryType = $imgTypeArr[$key];
				if($adCategoryType == 'website_home_banner') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-home-banner', $newProductId, notificationContent('create-ad-for-home-banner') , null, null, 'promote');
				}else if($adCategoryType == 'home_middle') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-home-middle', $newProductId, notificationContent('create-ad-for-home-middle') , null, null, 'promote');
				}else if($adCategoryType == 'cat_right') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-right-banner', $newProductId, notificationContent('create-ad-for-right-banner') , null, null, 'promote');
				}else if($adCategoryType == 'website_home_category_section') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-home-category-section', $newProductId, notificationContent('create-ad-for-home-category-section') , null, null, 'promote');
				}else if($adCategoryType == 'category_home_page') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-home-category-page', $newProductId, notificationContent('create-ad-for-home-category-page') , null, null, 'promote');
				}else if($adCategoryType == 'blog') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-blog', $newProductId, notificationContent('create-ad-for-blog') , null, null, 'promote');
				}else if($adCategoryType == 'forum') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-forum', $newProductId, notificationContent('create-ad-for-forum') , null, null, 'promote');
				}else if($adCategoryType == 'confession') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-confession', $newProductId, notificationContent('create-ad-for-confession') , null, null, 'promote');
				}
			}
		}	
		$this->db->trans_commit();
			$_SESSION['valid'] = "Your promotional advertisement has been submitted successfully!";
			redirect(base_url()."my-ads");
		}catch(\Exception $e) {
			$this->db->trans_rollback();
			$_SESSION['valid'] = "Some Error occurred please contact the admin!";
			redirect(base_url()."my-ads");
		}
	}



	public function classified_payment_success()
	{

		require 'vendor/autoload.php';

		\Stripe\Stripe::setApiKey($this->stripeSecretKey()); // Stripe Secret Key

		 $session_id = $_GET['session_id'] ?? null;
		 $payment_intent_id = '';
		if ($session_id) {
			try {
				$session = \Stripe\Checkout\Session::retrieve($session_id);
				$payment_intent_id = $session->payment_intent;

			} catch (Exception $e) {
				$session = [];
			}
		} else {
			$session = [];
		}

		$this->db->trans_begin();
		try{
		$categoryType = $_GET['category-type'];
		$productId = $_GET['pid'];
		$insertedIds = $_GET['ad-ids'];
		$imgs = $_GET['types'];
		$userId = $_GET['userid'];

		$idsArr = [];
		$imgTypeArr = [];

		$temporaryProduct = $this->db->where('id', $productId)->get('temporary_products')->row();
		if ($temporaryProduct) {
			$this->db->where('id', $productId)->delete('temporary_products');
			$temporaryProductArray = (array)$temporaryProduct;
			unset($temporaryProductArray['id']);
			$temporaryProductArray['payment_status'] = 'completed';
			$temporaryProductArray['payment_object'] = json_encode($session);
			$temporaryProductArray['stripe_transaction_id'] = $payment_intent_id;
			$temporaryProductArray['payment_done'] = 1;
			$this->db->insert('products', $temporaryProductArray);
		    $newProductId = $this->db->insert_id();
			$this->db->where('product_id', $productId)->update('product_images', ['product_id' => $newProductId]);

			if($categoryType == 'events') {
				$this->saveNotification($userId, 'admin', 'add-new-event', $newProductId, notificationContent('add-new-event'), null, null , 'events');
			}else if($categoryType == 'services') {
				$this->saveNotification($userId, 'admin', 'add-new-service', $newProductId, notificationContent('add-new-service'), null, null, 'services');
			}else if($categoryType == 'jobs') {
				$this->saveNotification($userId, 'admin', 'add-new-job', $newProductId, notificationContent('add-new-job'), null, null, 'jobs');
			}else if($categoryType == 'it-trainings') {
				$this->saveNotification($userId, 'admin', 'add-new-it-training', $newProductId, notificationContent('add-new-it-training'), null, null, 'it-trainings');
			}else if($categoryType == 'roomates-rentals') {
				$this->saveNotification($userId, 'admin', 'add-new-roomates-rental', $newProductId, notificationContent('add-new-roomates-rental'), null, null, 'roomates-rentals');
			}
		}

		if(!empty($insertedIds) && !empty($imgs)) {
			$idsArr = explode(',', $insertedIds);
			$imgTypeArr = explode(',', $imgs);
		}

		foreach($idsArr as $key => $insertedId) {

			
			$getTemporaryAds = $this->db->where('id', $insertedId)->get('temporary_products_ads')->row();
			$this->db->where('id', $insertedId)->delete('temporary_products_ads');
			if ($getTemporaryAds) {
				$temporaryAdsArray = (array)$getTemporaryAds;
				unset($temporaryAdsArray['id']);
				$temporaryAdsArray['payment_status'] = 'completed';
				$this->db->insert('products_ads', $temporaryAdsArray);
				$newAdId = $this->db->insert_id();

				$adCategoryType = $imgTypeArr[$key];
				if($adCategoryType == 'website_home_banner') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-home-banner', $newAdId, notificationContent('create-ad-for-home-banner') , null, null, 'promote');
				}else if($adCategoryType == 'home_middle') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-home-middle', $newAdId, notificationContent('create-ad-for-home-middle') , null, null, 'promote');
				}else if($adCategoryType == 'cat_right') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-right-banner', $newAdId, notificationContent('create-ad-for-right-banner') , null, null, 'promote');
				}else if($adCategoryType == 'website_home_category_section') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-home-category-section', $newAdId, notificationContent('create-ad-for-home-category-section') , null, null, 'promote');
				}else if($adCategoryType == 'category_home_page') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-home-category-page', $newAdId, notificationContent('create-ad-for-home-category-page') , null, null, 'promote');
				}else if($adCategoryType == 'blog') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-blog', $newAdId, notificationContent('create-ad-for-blog') , null, null, 'promote');
				}else if($adCategoryType == 'forum') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-forum', $newAdId, notificationContent('create-ad-for-forum') , null, null, 'promote');
				}else if($adCategoryType == 'confession') {
					$this->saveNotification($userId, 'admin', 'create-ad-for-confession', $newAdId, notificationContent('create-ad-for-confession') , null, null, 'promote');
				}

			
			}
		}
		$this->db->trans_commit();
		$_SESSION['valid'] = "Your Classified has been submitted successfully!";
		redirect(base_url()."my-listings");
		}catch(\Exception $e) {
			$this->db->trans_rollback();
			$_SESSION['valid'] = "Some Error occurred please contact the admin!";
			redirect(base_url()."my-listings");
		}
	}



	public function promotion_payment_cancel() {
		
		$this->db->trans_begin();
	try{
		$insertedIds = $_GET['ids'];
		$idsArr = [];
		if(!empty($insertedIds)) {
			$idsArr = explode(',', $insertedIds);
		}

		foreach($idsArr as $insertedId) { 
			$this->db->where('id', $insertedId)->delete('products_ads');
		}
		$this->db->trans_commit();
		$_SESSION['invalid'] = "Your promotional advertisement has been cancelled!";
		redirect(base_url()."my-ads");
	}catch(\Exception $e) {
			$this->db->trans_rollback();
			$_SESSION['invalid'] = "Some Error occurred please contact the admin!";
			redirect(base_url()."my-ads");
		}
	}



	public function classified_payment_cancel() {
	$this->db->trans_begin();
		try{
			$insertedIds = $_GET['ad-ids'];
			$pid = $_GET['pid'];

			$idsArr = [];
			if(!empty($insertedIds)) {
				$idsArr = explode(',', $insertedIds);
			}

			$this->db->where('id', $pid)->delete('products');
			foreach($idsArr as $insertedId) {
				$this->db->where('id', $insertedId)->delete('products_ads');
			}
			$this->db->trans_commit();
			$_SESSION['invalid'] = "Your classified has been cancelled!";
			redirect(base_url()."my-listings");
		}catch(\Exception $e) {
			$this->db->trans_rollback();
			$_SESSION['invalid'] = "Some Error occurred please contact the admin!";
			redirect(base_url()."my-listings");
		}

	}


	public function getPlanInfo($id, $type) {
		$planInfo = $this->db->where('id', $id)->get('payment_plans')->row();
		$this->data['planInfo'] = $planInfo;
		$this->data['type'] = $type;

		$this->load->view('frontend/common/ads-boxes-file.php',$this->data);
	}


	public function stripeSecretKey() {
		//Stripe Secret Key
		return "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";
	}
}