<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'portal';
$route['404_override'] = 'portal/error404';
$route['translate_uri_dashes'] = FALSE;



/////////////////////////   Admin Panel  ////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////


$route['admin'] = "portal";
$route['portal'] = "portal";
$route['signin']['POST'] = "portal/signin";
$route['signup']['POST'] = "portal/signup_save";
$route['signup']['GET'] = "portal/signup";
$route['logout']['GET'] = "portal/logout";
$route['account']['GET'] = "portal/account";
$route['account']['POST'] = "portal/account_save";
$route['user/email-verify/(:any)']['GET'] = "user/email_verification/$1";
$route['dashboard'] = "portal/dashboard";
$route['users'] = "portal/users_list";
$route['forgot-password']['GET'] = "portal/forgot_password";
$route['forgot-password']['POST'] = "portal/forgot_password_send";
$route['reset-password/(:any)']['GET'] = "portal/reset_password/$1";
$route['reset-password']['POST'] = "portal/reset_password_save";

$route['branches']['GET'] = "portal/branches_list";
$route['add-branch']['POST'] = "portal/add_branch_save";
$route['edit-branch']['POST'] = "portal/edit_branch_save";

$route['products']['GET'] = "portal/products_list";
$route['add-product']['GET'] = "portal/add_product";
$route['add-product']['POST'] = "portal/add_product_save";
$route['delete-product']['POST'] = "portal/delete_product";
$route['edit-product/(:num)']['GET'] = "portal/edit_product/$1";
$route['edit-product/(:num)']['POST'] = "portal/edit_product_save/$1";
$route['product-detail/(:num)/(:any)']['GET'] = "home/product/$1";

$route['public-products']['GET'] = "portal/public_products_list";
$route['public-product-detail/(:num)/(:any)']['GET'] = "portal/public_products_detail/$1";


$route['countries']['GET'] = "portal/countries_list";
$route['add-country']['POST'] = "portal/add_country_save";
$route['edit-country']['POST'] = "portal/edit_country_save";
$route['delete-country']['POST'] = "portal/delete_country";


$route['edit-user']['POST'] = "portal/edit_user_save";
$route['add-user']['POST'] = "portal/add_user_save";
$route['delete-user']['POST'] = "portal/delete_user";


/////////////////////////   User Roles & Permissions  ////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////


$route['user-permissions']['GET'] = "portal/all_user_permissions";
$route['add-user-permission']['POST'] = "portal/add_user_permission_save";
$route['edit-user-permission']['POST'] = "portal/edit_user_permission_save";
$route['delete-user-permission']['POST'] = "portal/delete_user_permission";
$route['user-roles']['GET'] = "portal/all_user_roles";
$route['add-user-role']['POST'] = "portal/add_user_role_save";
$route['edit-user-role']['POST'] = "portal/edit_user_role_save";
$route['delete-user-role']['POST'] = "portal/delete_user_role";
$route['user-roles-permissions/(:any)']['GET'] = "portal/all_user_roles_permissions/$1";
$route['add-user-roles-permissions']['POST'] = "portal/add_user_roles_permissions_save";