<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Nepstate';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['logout'] = 'Nepstate/logout';
$route['login'] = 'Nepstate/login';
$route['do/login'] = 'Nepstate/do_login';
$route['do/signup'] = 'Nepstate/do_signup';
$route['forgot/password'] = 'Nepstate/forgot_password';
$route['do/verify/email/(:any)'] = 'Nepstate/do_verify_email/$1';
$route['do/forgot/password'] = 'Nepstate/forgot_password_email';
$route['do/reset/password/(:any)'] = 'Nepstate/do_update_password/$1';

$route['change/password'] = 'Nepstate/do_change_password';
$route['profile'] = 'Nepstate/do_update_profile';
$route['tags/(:any)'] = 'Nepstate/tags_classifieds/$1';
$route['classifieds/(:any)'] = 'Nepstate/classifieds/$1';
$route['classified/detail/(:any)'] = 'Nepstate/classified_details/$1';
$route['blog'] = 'Nepstate/blog';
$route['blog/(:num)'] = 'Nepstate/blog/$1';
$route['blog/details/(:any)'] = 'Nepstate/blog_details/$1';
$route['confessions'] = 'Nepstate/confessions';
$route['confessions/(:num)'] = 'Nepstate/confessions/$1';
$route['confession/details/(:any)'] = 'Nepstate/blog_details/$1';

$route['forums'] = 'Nepstate/forums';
$route['forums/(:num)'] = 'Nepstate/forums/$1';
$route['forum/details/(:any)'] = 'Nepstate/blog_details/$1';

$route['about-us'] = 'Nepstate/about';
$route['contact-us'] = 'Nepstate/contact';
$route['faq'] = 'Nepstate/faq';
$route['pages/(:any)'] = 'Nepstate/pages/$1';

$route['dashboard'] = 'Nepstate/dashboard';
$route['resend_verification_email'] = 'Nepstate/resend_verification_email';
$route['favorites'] = 'Nepstate/favorites';
$route['my-listings'] = 'Nepstate/my_listings';
$route['my-blogs'] = 'Nepstate/my_blogs';
$route['my-confessions'] = 'Nepstate/my_blogs';
$route['my-forums'] = 'Nepstate/my_blogs';
$route['my-ads'] = 'Nepstate/my_ads';
$route['my-comments'] = 'Nepstate/my_comments';
$route['my-reviews'] = 'Nepstate/my_reviews';
$route['notifications'] = 'Nepstate/notifications';
$route['payments'] = 'Nepstate/my_payments';
$route['new/post/(:any)'] = 'Nepstate/new_post/$1'; 
$route['edit/post/(:any)'] = 'Nepstate/edit_post/$1'; 
$route['submit/classified'] = 'Nepstate/submit_classified';

$route['do/favorite/(:any)'] = 'Nepstate/do_add_favorite/$1'; 

$route['promote'] = 'Nepstate/promote_website';
$route['submit/promote'] = 'Nepstate/submit_payment_promotion';

$route['post-blog'] = 'Nepstate/post_blog';
$route['submit/blog'] = 'Nepstate/submit_blog';
$route['edit/blog/(:any)'] = 'Nepstate/edit_blog/$1'; 
$route['blog/tags/(:any)'] = 'Nepstate/tags_blogs/$1';

$route['confessions/tags/(:any)'] = 'Nepstate/tags_confession/$1';
$route['forums/tags/(:any)'] = 'Nepstate/tags_forums/$1';

$route['post-confession'] = 'Nepstate/post_confession';
$route['submit/confession'] = 'Nepstate/submit_confession';
$route['edit/confession/(:any)'] = 'Nepstate/edit_confession/$1';

$route['post-forum'] = 'Nepstate/post_confession';
$route['submit/forum'] = 'Nepstate/submit_confession';
$route['edit/forum/(:any)'] = 'Nepstate/edit_confession/$1';

$route['country-selection'] = 'Nepstate/countrySelection';
$route['cancel-country-selection'] = 'Nepstate/cancelCountrySelection';

$route['update-user-country/(:any)'] = 'Nepstate/updateUserCountry/$1';
$route['switch-country/(:any)'] = 'Nepstate/countrySwitch/$1';
$route['api/get_cities'] = 'ApiController/getCitiesByCountry';

$route['remove-account'] = 'Nepstate/removeAccount';
$route['delete-account'] = 'Nepstate/deleteAccount';
$route['chat/(:any)'] = 'Nepstate/chat/$1';
$route['my-chats'] = 'Nepstate/myChats';
$route['stripe'] = 'Nepstate/createStripeSessionLink';
$route['promotion_payment_success'] = 'Nepstate/promotion_payment_success';
$route['promotion_payment_cancel'] = 'Nepstate/promotion_payment_cancel';

$route['classified_payment_success'] = 'Nepstate/classified_payment_success';
$route['classified_payment_cancel'] = 'Nepstate/classified_payment_cancel';

// include "admin_routes.php";