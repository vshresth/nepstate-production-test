<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['admin/push-notifications'] = 'admin/push/index';
$route['admin/push-notifications/send'] = 'admin/push/send';



$route['admin']="admin/dashboard";
$route['admin/logout']="admin/login/logout";
$route['admin/user-auth'] = 'admin/dashboard/auth_check';
$route['admin/notification'] = 'admin/dashboard/notification';
$route['admin/all-notifications'] = 'admin/dashboard/all_notifications';
$route['admin/notification-detail/(:num)'] = 'admin/dashboard/detail/$1';
$route['admin/my-profile'] = 'admin/myprofile/index';
$route['admin/change-password'] = 'admin/myprofile/change_password';
$route['admin/vendor-profile'] = 'admin/vendorprofile/index';


///Categories Routes
$route['admin/affiliates'] = 'admin/categories/index';
$route['admin/add-affiliate'] = 'admin/categories/add';
$route['admin/affiliate-status/(:num)/(:num)'] = 'admin/categories/status/$1/$2';
$route['admin/edit-affiliate/(:num)'] = 'admin/categories/edit/$1';
$route['admin/delete-affiliate/(:num)'] = 'admin/categories/delete/$1';

//Workout Routes
$route['admin/workouts'] = 'admin/location/index';
$route['admin/add-workout'] = 'admin/location/add';
$route['admin/workout-status/(:num)/(:num)'] = 'admin/location/status/$1/$2';
$route['admin/edit-workout/(:num)'] = 'admin/location/edit/$1';
$route['admin/delete-workout/(:num)'] = 'admin/location/delete/$1';


//Workout Exercise
$route['admin/workout/exercise/(:any)'] = 'admin/exercise/index/$1';
$route['admin/add-exercise/(:any)'] = 'admin/exercise/add/$1';
$route['admin/exercise-status/(:num)/(:num)'] = 'admin/exercise/status/$1/$2';
$route['admin/edit-exercise/(:num)/(:any)'] = 'admin/exercise/edit/$1/$2';
$route['admin/delete-exercise/(:num)'] = 'admin/exercise/delete/$1';


///Brands Routes
$route['admin/brands'] = 'admin/brands/index';
$route['admin/add-brand'] = 'admin/brands/add';
$route['admin/brand-status/(:num)/(:num)'] = 'admin/brands/status/$1/$2';
$route['admin/edit-brand/(:num)'] = 'admin/brands/edit/$1';
$route['admin/delete-brand/(:num)'] = 'admin/brands/delete/$1';
$route['admin/trash-brands'] = "admin/brands/trash";
$route['admin/restore-brand/(:num)'] = 'admin/brands/restore/$1';


///Stores Routes
$route['admin/providers'] = 'admin/stores/index';
$route['admin/provider-status/(:num)/(:num)'] = 'admin/stores/status/$1/$2';
$route['admin/delete-provider/(:num)'] = 'admin/stores/delete/$1';
$route['admin/provider/view-patients/(:num)'] = 'admin/stores/details/$1';
$route['admin/add-provider'] = 'admin/stores/add';
$route['admin/edit-provider/(:num)'] = 'admin/stores/edit/$1';

///TEAM Routes
$route['admin/care/teams'] = 'admin/teams/index';
$route['admin/team-status/(:num)/(:num)'] = 'admin/teams/status/$1/$2';
$route['admin/delete-team/(:num)'] = 'admin/teams/delete/$1';
$route['admin/add-team'] = 'admin/teams/add';
$route['admin/edit-team/(:num)'] = 'admin/teams/edit/$1';
$route['admin/view/members/(:num)'] = 'admin/teams/details/$1';

///languages Routes
$route['admin/languages'] = 'admin/languages/index';
$route['admin/add-language'] = 'admin/languages/add';
$route['admin/language-status/(:num)/(:num)'] = 'admin/languages/status/$1/$2';
$route['admin/language-default/(:num)/(:num)'] = 'admin/languages/mdefault/$1/$2';
$route['admin/edit-language/(:num)'] = 'admin/languages/edit/$1';
$route['admin/delete-language/(:num)'] = 'admin/languages/delete/$1';
$route['admin/trash-languages'] = "admin/languages/trash";
$route['admin/restore-language/(:num)'] = 'admin/languages/restore/$1';


///Company Details Routes
$route['admin/company-details'] = 'admin/company_details/index';
$route['admin/add-company-detail'] = 'admin/company_details/add';
$route['admin/company-detail-status/(:num)/(:num)'] = 'admin/company_details/status/$1/$2';
$route['admin/edit-company-detail/(:num)'] = 'admin/company_details/edit/$1';
$route['admin/delete-company-detail/(:num)'] = 'admin/company_details/delete/$1';
$route['admin/trash-company-details'] = "admin/company_details/trash";
$route['admin/restore-company-detail/(:num)'] = 'admin/company_details/restore/$1';


///FAQs Routes
$route['admin/faqs'] = 'admin/faqs/index';
$route['admin/add-faq'] = 'admin/faqs/add';
$route['admin/faq-status/(:num)/(:num)'] = 'admin/faqs/status/$1/$2';
$route['admin/edit-faq/(:num)'] = 'admin/faqs/edit/$1';
$route['admin/delete-faq/(:num)'] = 'admin/faqs/delete/$1';
$route['admin/trash-faqs'] = "admin/faqs/trash";
$route['admin/restore-faq/(:num)'] = 'admin/faqs/restore/$1';


///Product Routes
$route['admin/products'] = 'admin/products/index';
$route['admin/product/(:num)'] = 'admin/products/details/$1';
$route['admin/add-product'] = 'admin/products/add';
$route['admin/product-status/(:num)/(:num)'] = 'admin/products/status/$1/$2';
$route['admin/edit-product/(:num)'] = 'admin/products/edit/$1';
$route['admin/delete-product/(:num)'] = 'admin/products/delete/$1';
$route['admin/delete-product-image/(:num)'] = 'admin/products/delete_image/$1';
$route['admin/trash-products'] = "admin/products/trash";
$route['admin/restore-product/(:num)'] = 'admin/products/restore/$1';
$route['admin/import-products'] = 'admin/products/import';


///Admins Routes
$route['admin/admins'] = 'admin/admins/index';
$route['admin/add-admin'] = 'admin/admins/add';
$route['admin/admin-status/(:num)/(:num)'] = 'admin/admins/status/$1/$2';
$route['admin/edit-admin/(:num)'] = 'admin/admins/edit/$1';
$route['admin/trash-admins'] = 'admin/admins/trash';
$route['admin/delete-admin/(:num)'] = 'admin/admins/delete/$1';
$route['admin/restore-admin/(:num)'] = 'admin/admins/restore/$1';
$route['admin/admin-detail/(:num)'] = 'admin/admins/admin_detail/$1';
$route['admin/edit-admin-roles/(:num)'] = 'admin/admins/edit_admin_roles/$1';



///Staff Routes
$route['admin/add-staff'] = 'admin/staff/add';
$route['admin/staff-status/(:num)/(:num)'] = 'admin/staff/status/$1/$2';
$route['admin/edit-staff/(:num)'] = 'admin/staff/edit/$1';
$route['admin/delete-staff/(:num)'] = 'admin/staff/delete/$1';
$route['admin/staff/(:any)'] = 'admin/staff/index/$1';



///Emails Routes
$route['admin/emails'] = 'admin/emails/index';
$route['admin/add-email'] = 'admin/emails/add';
$route['admin/email-status/(:num)/(:num)'] = 'admin/emails/status/$1/$2';
$route['admin/edit-email/(:num)'] = 'admin/emails/edit/$1';
$route['admin/delete-email/(:num)'] = 'admin/emails/delete/$1';
$route['admin/trash-emails'] = "admin/emails/trash";
$route['admin/restore-email/(:num)'] = 'admin/emails/restore/$1';


///Pages Routes
$route['admin/pages'] = 'admin/pages/index';
$route['admin/add-page'] = 'admin/pages/add';
$route['admin/page-status/(:num)/(:num)'] = 'admin/pages/status/$1/$2';
$route['admin/edit-page/(:num)'] = 'admin/pages/edit/$1';
$route['admin/delete-page/(:num)'] = 'admin/pages/delete/$1';
$route['admin/trash-pages'] = "admin/pages/trash";
$route['admin/restore-page/(:num)'] = 'admin/pages/restore/$1';


///Users Routes
$route['admin/users'] = 'admin/users/index';
$route['admin/add-user'] = 'admin/users/add';
$route['admin/user-detail/(:num)'] = 'admin/users/details/$1';
$route['admin/user-status/(:num)/(:num)'] = 'admin/users/status/$1/$2';
$route['admin/edit-user/(:num)'] = 'admin/users/edit/$1';
$route['admin/delete-user/(:num)'] = 'admin/users/delete/$1';

$route['admin/patient/lifestyle/(:any)'] 	= 'admin/users/lifestyle_profile_patient/$1';
$route['admin/patient/lifestyle/(:any)/(:any)'] 	= 'admin/users/lifestyle_profile_patient/$1/$2';

$route['admin/patient/recommendations/(:num)'] 	= 'admin/users/patient_recommendations/$1';
$route['admin/patient-messages/(:any)'] = 'admin/users/chat/$1';
$route['admin/patient-details/(:any)'] = 'admin/users/personal_details/$1';

///PROGRAM Routes
$route['admin/program'] = 'admin/program/index';
$route['admin/add-program'] = 'admin/program/add';
$route['admin/program-status/(:num)/(:num)'] = 'admin/program/status/$1/$2';
$route['admin/edit-program/(:num)'] = 'admin/program/edit/$1';
$route['admin/delete-program/(:num)'] = 'admin/program/delete/$1';

///LESSONS Routes
$route['admin/lessons/(:any)'] = 'admin/lessons/index/$1';
$route['admin/add-lessons/(:any)'] = 'admin/lessons/add/$1';
$route['admin/lessons-status/(:num)/(:num)'] = 'admin/lessons/status/$1/$2';
$route['admin/edit-lessons/(:num)/(:num)'] = 'admin/lessons/edit/$1/$2';
$route['admin/delete-lessons/(:num)'] = 'admin/lessons/delete/$1';

$route['admin/lesson/order/(:any)'] = 'admin/lessons/display_order/$1';

$route['admin/messages'] = 'admin/admins/messages';
$route['admin/messages/(:any)'] = 'admin/admins/messages/$1';



///Orders Routes
$route['admin/orders'] = 'admin/orders/index';
$route['admin/orders/clear-filter'] = 'admin/orders/clear_filter';
$route['admin/order-status/(:num)/(:num)'] = 'admin/orders/status/$1/$2';
$route['admin/offers'] = 'admin/orders/offers';
$route['admin/order/details/(:num)'] = 'admin/orders/details/$1';


///Withdraw Routes
$route['admin/withdrawals'] = 'admin/withdrawals/index';
$route['admin/withdrawals-status/(:num)/(:num)'] = 'admin/withdrawals/status/$1/$2';

///Reports Routes
$route['admin/reports'] = 'admin/stores/reports';
$route['admin/reports-status/(:num)/(:num)'] = 'admin/stores/report_status/$1/$2';


///COUPON Routes
$route['admin/promo'] = 'admin/promo/index';
$route['admin/add-promo'] = 'admin/promo/add';
$route['admin/promo-status/(:num)/(:num)'] = 'admin/promo/status/$1/$2';
$route['admin/edit-promo/(:num)'] = 'admin/promo/edit/$1';
$route['admin/delete-promo/(:num)'] = 'admin/promo/delete/$1';

///SPORTS Routes
$route['admin/sports'] = 'admin/sports/index';
$route['admin/add-sport'] = 'admin/sports/add';
$route['admin/sport-status/(:num)/(:num)'] = 'admin/sports/status/$1/$2';
$route['admin/edit-sport/(:num)'] = 'admin/sports/edit/$1';
$route['admin/delete-sport/(:num)'] = 'admin/sports/delete/$1';


