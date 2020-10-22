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
|	$route['default_controller']                  = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override']                        = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes']                = FALSE;
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
$route['login_page.html'] 				= 'welcome/login_page';





//------------------------------------- D A S H B O A R D --------------------------------------//
//$route['ruang_enable.html'] 			= 'Con_main/aktifkan_ruang';
//$route['ruang_disable.html'] 			= 'Con_main/non_aktifkan_ruang';
$route['dashboard.html'] 				= 'Con_main/dashboard';

$route['jadwal_sekarang.html'] 			= 'Con_main/jadwal_saat_ini';
$route['status_peminjaman.html'] 		= 'Con_main/status_peminjaman';

$route['cari_jadwal.html'] 				= 'Con_main/cari_jadwal';
$route['get_jadwal.html'] 				= 'Con_main/get_jadwal';
$route['jadwal_penggunaan_ruang.html'] 	= 'Con_main/jadwal_penggunaan_ruang';

//------------------------------------------ M O N I T O R I N G --------------------------------//
/*$route['monitoring_ruang.html'] 			= 'Con_monitoring/monitoring_ruang';
$route['log_ruang.html'] 					= 'Con_monitoring/log_ruang_by_id_ruang';*/

$route['monitoring_penggunaan_ruang.html'] 	= 'Con_monitoring/monitoring_penggunaan_ruang';
$route['monitoring_exe_ftahun.html'] 		= 'Con_monitoring/monitoring_exe_ftahun';
$route['monitoring_exe_fbulan.html'] 		= 'Con_monitoring/monitoring_exe_fbulan';
$route['monitoring_by_hari.html'] 			= 'Con_monitoring/monitorig_by_hari';

	/*#manual
	$route['monitoring_manual.html'] 				= 'Con_monitoring/monitoring_manual';
	$route['log_manual_penggunaan_ruang.html']		= 'Con_monitoring/log_manual_penggunaan_ruang';
	$route['manual_exe_ftahun.html'] 				= 'Con_monitoring/manual_exe_ftahun';
	$route['manual_exe_ftahun.html'] 				= 'Con_monitoring/manual_exe_ftahun';
	$route['manual_exe_fbulan.html'] 				= 'Con_monitoring/manual_exe_fbulan';*/

//------------------------------------------- R F I D --------------------------------------------//
$route['rfid.html'] 						= 'Con_rfid/rfid_list';
$route['input_data_rfid.html'] 				= 'Con_rfid/input_data_rfid';
$route['edit_data_rfid.html'] 				= 'Con_rfid/edit_data_rfid';
$route['exe_update_data_rfid.html'] 		= 'Con_rfid/exe_update_rfid';
$route['hapus_data_rfid.html'] 				= 'Con_rfid/hapus_data_rfid';

//------------------------------------------- M A N U A L --------------------------------------------//
/*$route['sistem_manual.html'] 				= 'Con_manual/dashboard_sistem_manual';
$route['mengembalikan_kunci.html'] 			= 'Con_manual/mengembalikan_kunci';
$route['form_input_log_manual.html'] 		= 'Con_manual/input_log_manual';
$route['exe_input_log_manual.html'] 		= 'Con_manual/exe_input_log_manual';
$route['exe_data_peminjam_fix.html'] 		= 'Con_manual/exe_data_peminjam_fix';*/

//---------------------------------------P E M I N J A M A N -----------------------------------------//
$route['pinjam_kunci_ruang.html'] 			= 'Con_main/pinjam_kunci_ruang';
$route['form_pinjam_2.html'] 				= 'Con_main/exe_pinjam_kunci';
$route['pinjam_fix.html'] 					= 'Con_main/pinjam_fix';

$route['kembalikan_kunci_ruang.html'] 		= 'Con_main/kunci_kembali';
$route['edit_data_ruang.html'] 				= 'Con_main/edit_data_ruang';
$route['exe_update_ruang.html'] 			= 'Con_main/exe_update_ruang';
$route['ruang.html'] 						= 'Con_main/dashboard';


//-------------------------------------J A D W A L -------------------------------------------------//
$route['jadwal.html'] 						= 'Con_jadwal/list_manajemen_jadwal';
$route['aktifkan_semester.html'] 			= 'Con_jadwal/aktifkan_semester';
$route['aktifkan_tahun_ajaran.html'] 		= 'Con_jadwal/aktifkan_tahun_ajaran';