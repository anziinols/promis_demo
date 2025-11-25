<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
//$autoRoutesImproved(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('login', 'Home::login');
$routes->post('login', 'Home::login');
$routes->post('login_po', 'Home::login_po');
$routes->get('logout', 'Home::logout');
$routes->get('about', 'Home::about');
$routes->get('projects_list', 'Home::projects_list');
$routes->get('home_project_one_view/(:any)', 'Home::home_project_one_view/$1');

//Admindash routes
$routes->get('dashboard', 'Admindash::index');
$routes->get('my_account', 'Admindash::my_account');
$routes->get('reports_dashboard', 'Admindash::reports_dashboard');

$routes->post('update_admin_orglogo', 'Admindash::update_admin_orglogo');
$routes->post('update_admin_orginfo', 'Admindash::update_admin_orginfo');

//Notifications routes
$routes->get('notifications', 'Notifications::index');
$routes->post('add_notification', 'Notifications::add_notification');
$routes->post('update_notification', 'Notifications::update_notification');
$routes->get('delete_notification/(:num)', 'Notifications::delete_notification/$1');
$routes->get('get_csrf_token', 'Admindash::get_csrf_token');


//Pro_Reports routes
$routes->get('report_projects_dash', 'ProReports::index');
$routes->get('report_projects_status/(:any)', 'ProReports::report_projects_status/$1');
$routes->get('report_projects_view/(:any)', 'ProReports::report_projects_view/$1');
$routes->get('report_pro_payment_record/(:any)', 'ProReports::report_pro_payment_record/$1');

$routes->get('report_contractors_dash', 'ProReports::report_contractors_dash');
$routes->get('report_contractors_view/(:any)', 'ProReports::report_contractors_view/$1');

$routes->get('report_pro_officers_dash', 'ProReports::report_pro_officers_dash');
$routes->get('report_pro_officers_view/(:any)', 'ProReports::report_pro_officers_view/$1');



//pofficers
$routes->get('po_dash', 'POfficers::index');
$routes->get('po_open_project/(:any)', 'POfficers::po_open_project/$1');
$routes->get('po_details/(:any)', 'POfficers::po_details/$1');
$routes->get('po_details_info_edit/(:any)', 'POfficers::po_details_info_edit/$1');
$routes->get('po_phases/(:any)', 'POfficers::po_phases/$1');
$routes->get('po_milestones/(:any)', 'POfficers::po_milestones/$1');
$routes->post('milestone_notes', 'POfficers::milestone_notes');
$routes->post('milestone_files', 'POfficers::milestone_files');
$routes->post('delete_milestone_file', 'POfficers::delete_milestone_file');
$routes->get('po_files_open/(:any)', 'POfficers::po_files_open/$1');
$routes->get('po_funding_open/(:any)', 'POfficers::po_funding_open/$1');
$routes->get('po_events_open/(:any)', 'POfficers::po_events_open/$1');
$routes->get('po_reports_open/(:any)', 'POfficers::po_reports_open/$1');
$routes->get('mark_notification_read/(:num)', 'POfficers::mark_notification_read/$1');
$routes->get('notifications_archive', 'POfficers::notifications_archive');
$routes->post('getdistricts', 'POfficers::getdistricts');




//projects routes
$routes->get('projects', 'Projects::index');
$routes->get('new_projects', 'Projects::create_projects');
$routes->get('open_projects/(:any)', 'Projects::open_projects/$1');
$routes->get('open_prophases/(:any)', 'Projects::open_prophases/$1');
$routes->get('project_phases/(:any)', 'Projects::project_phases/$1');
$routes->get('edit_projects/(:any)', 'Projects::edit_projects/$1');
$routes->get('milestones/(:any)', 'Milestones::pro_milestones/$1');
$routes->get('open_proevents/(:any)', 'Projects::open_proevents/$1');
$routes->get('getaddress', 'Projects::getaddress');

$routes->post('edit_project_budget', 'Projects::edit_project_budget');
$routes->post('set_project_contractor', 'Projects::set_project_contractor');
$routes->post('set_project_officers', 'Projects::set_project_officers');

$routes->post('add_proevents', 'Projects::add_proevents');
$routes->post('edit_proevents', 'Projects::edit_proevents');

$routes->post('edit_projects/(:any)', 'Projects::edit_projects/$1');
$routes->post('new_projects', 'Projects::create_projects');

$routes->get('edit_projects_status/(:any)', 'Projects::edit_projects_status/$1');
$routes->post('update_projects_status', 'Projects::update_projects_status');

$routes->get('edit_projects_contractors/(:any)', 'Projects::edit_projects_contractors/$1');
$routes->post('update_projects_contractors', 'Projects::update_projects_contractors');

$routes->get('edit_projects_officers/(:any)', 'Projects::edit_projects_officers/$1');
$routes->post('update_projects_officers', 'Projects::update_projects_officers');


$routes->post('getaddress', 'Projects::getaddress');
$routes->post('gps_upload', 'Projects::gpsfile_upload');
$routes->post('prodocs_upload', 'Projects::prodocs_upload');
$routes->post('prodocs_edit', 'Projects::prodocs_edit');
$routes->post('prodocs_delete', 'Projects::prodocs_delete');
$routes->post('gps_set', 'Projects::gps_set');
$routes->post('addpayments', 'Projects::addpayments');
$routes->post('editpayments', 'Projects::editpayments');


$routes->post('milestones/(:any)', 'Projects::pro_milestones/$1');
$routes->post('add_phases', 'Projects::add_phases');
$routes->post('edit_phases', 'Projects::edit_phases');
$routes->post('delete_phases', 'Projects::delete_phases');

$routes->post('add_milestones', 'Projects::add_milestones');
$routes->post('edit_milestones', 'Projects::edit_milestones');
$routes->post('delete_milestones', 'Projects::delete_milestones');
$routes->post('pro_status', 'Projects::pro_status');


//project officers
$routes->get('project_officers', 'Project_officers::index');
$routes->post('add_project_officers', 'Project_officers::add_project_officers');
$routes->post('edit_project_officers', 'Project_officers::edit_project_officers');
$routes->post('edit_password_project_officers', 'Project_officers::edit_password_project_officers');


//Project Leads
$routes->get('proleads', 'Proleads::index');
$routes->get('contractors', 'Proleads::contractors_list');
$routes->get('contractors_new', 'Proleads::contractors_new');
$routes->get('edit_contractors/(:any)', 'Proleads::edit_contractors/$1');
$routes->get('open_contractor/(:any)', 'Proleads::open_contractor/$1');

$routes->post('create_contractor', 'Proleads::create_contractor');
$routes->post('update_contractor', 'Proleads::update_contractor');
$routes->post('update_con_contacts', 'Proleads::update_con_contacts');

$routes->post('create_con_files', 'Proleads::create_con_files');
$routes->post('update_con_files', 'Proleads::update_con_files');
$routes->post('delete_con_files', 'Proleads::delete_con_files');

$routes->post('update_con_logo', 'Proleads::update_con_logo');

$routes->post('create_con_notices', 'Proleads::create_con_notices');


// Dakoii Routes
$routes->get('dakoii', 'Dakoii::index');
$routes->get('dlogout', 'Dakoii::logout');
$routes->get('ddash', 'Dakoii::ddash');
$routes->get('dopen_org/(:any)', 'Dakoii::open_org/$1');
$routes->get('dlist_org', 'Dakoii::list_org');

$routes->post('dlogin', 'Dakoii::login');
$routes->post('daddorg', 'Dakoii::addorg');
$routes->post('deditorg', 'Dakoii::editorg');
$routes->post('dadduser', 'Dakoii::adduser');
$routes->post('daddadmin', 'Dakoii::create_admin');
$routes->post('dakoii_update_org_logo', 'Dakoii::dakoii_update_org_logo');
$routes->post('dakoii_update_org_address', 'Dakoii::dakoii_update_org_address');
$routes->post('dakoii_update_org_location_lock', 'Dakoii::dakoii_update_org_location_lock');
$routes->post('dakoii_remove_org_location_lock', 'Dakoii::dakoii_remove_org_location_lock');
$routes->post('getaddress', 'Dakoii::getaddress');
$routes->post('get_provinces_by_country', 'Dakoii::get_provinces_by_country');
$routes->get('get_csrf_token', 'Dakoii::get_csrf_token');

//Locations routes
// Countries
$routes->get('countries', 'Locations::countries');
$routes->get('countries_create', 'Locations::countries_create');
$routes->post('countries_create', 'Locations::countries_create');
$routes->get('countries_edit/(:num)', 'Locations::countries_edit/$1');
$routes->post('countries_edit/(:num)', 'Locations::countries_edit/$1');
$routes->post('countries_delete', 'Locations::countries_delete');

// Provinces
$routes->get('provinces', 'Locations::provinces');
$routes->get('provinces_create', 'Locations::provinces_create');
$routes->post('provinces_create', 'Locations::provinces_create');
$routes->get('provinces_edit/(:num)', 'Locations::provinces_edit/$1');
$routes->post('provinces_edit/(:num)', 'Locations::provinces_edit/$1');
$routes->post('provinces_delete', 'Locations::provinces_delete');

// Districts
$routes->get('districts', 'Locations::districts');
$routes->get('districts_create', 'Locations::districts_create');
$routes->post('districts_create', 'Locations::districts_create');
$routes->get('districts_edit/(:num)', 'Locations::districts_edit/$1');
$routes->post('districts_edit/(:num)', 'Locations::districts_edit/$1');
$routes->post('districts_delete', 'Locations::districts_delete');

// LLGs
$routes->get('llgs', 'Locations::llgs');
$routes->get('llgs_create', 'Locations::llgs_create');
$routes->post('llgs_create', 'Locations::llgs_create');
$routes->get('llgs_edit/(:num)', 'Locations::llgs_edit/$1');
$routes->post('llgs_edit/(:num)', 'Locations::llgs_edit/$1');
$routes->post('llgs_delete', 'Locations::llgs_delete');

// AJAX routes for cascading dropdowns
$routes->post('locations_get_provinces', 'Locations::get_provinces');
$routes->post('locations_get_districts', 'Locations::get_districts');

//testing
$routes->get('testa', 'Test::index');
$routes->get('ajax', 'Test::ajax');
$routes->post('ajax', 'Test::ajax');
$routes->post('ajaxform', 'Test::ajaxform');
$routes->get('ajaxform', 'Test::ajaxform');
$routes->get('testmap', 'Test::testmap');
$routes->get('test_view', 'Test::test_view');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
