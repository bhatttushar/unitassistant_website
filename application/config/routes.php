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
$route['default_controller'] = 'front/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*********** USER DEFINED ROUTES *******************/

$route['user-login'] = 'front/login';
$route['user-signup'] = 'front/signup';
$route['user-account'] = 'front/user_account';
$route['user-logout'] = 'front/logout';
$route['notes'] = 'front/all_notes';

$route['notes-listing'] = 'front/all_notes_list_ajax';
$route['search-notes-by-tags'] = 'front/search_notes_by_tags';

$route['emails'] = 'front/all_emails';
$route['emails-listing'] = 'front/all_emails_list_ajax';

$route['reggie'] = 'reggie/reggie';
$route['reggie-canada'] = 'reggie_canada/reggie_canada';
$route['reggie-uacc'] = 'reggie_uacc/reggie_uacc';
$route['reggie-bellafizz'] = 'reggie_bellafizz/reggie_bellafizz';
$route['reggie-bellafizz-unique-email'] = 'reggie_bellafizz/reggie_bellafizz_unique_email';
$route['reggie-bellafizz-unique-rep-id'] = 'reggie_bellafizz/reggie_bellafizz_unique_rep_id';
$route['reggie-uacc-unique-email'] = 'reggie_uacc/reggie_uacc_unique_email';
$route['reggie-uacc-unique-id'] = 'reggie_uacc/reggie_uacc_unique_id';
$route['reggie-ua-unique-email'] = 'reggie/reggie_ua_unique_email';
$route['reggie-ua-unique-id'] = 'reggie/reggie_ua_unique_id';

/* Directors */
$route['directors'] = 'directors/director_list/index';
$route['director-listing'] = 'directors/director_list/AjaxData';
$route['add-to-uacc/(:num)'] = 'directors/director_list/addToUACC/$1';
$route['client-emails/(:num)'] = 'directors/director_list/client_emails/$1';
$route['view-client-email/(:num)/(:any)'] = 'directors/director_list/view_client_email/$1/$2';
$route['add-director'] = 'directors/director_add/index';
$route['check-cc'] = 'directors/director_add/index';
$route['check-email-exists'] = 'directors/director_add/EmailExist';
$route['check-consultant-exists'] = 'directors/director_add/ConsultantExist';
$route['add-general-info'] = 'directors/director_add/add_general_info';
$route['add-emails'] = 'directors/director_add/add_emails';
$route['add-design-info'] = 'directors/director_add/add_design_info';
$route['add-packaging'] = 'directors/director_add/add_packaging';
$route['add-note'] = 'directors/director_edit/add_note';
$route['note-list'] = 'directors/director_edit/note_list';
$route['edit-director/(:num)'] = 'directors/director_edit/index/$1';
$route['edit-future-director/(:num)'] = 'directors/director_edit/index/$1';
$route['unsubscribed-directors'] = 'directors/unsub_director/index';
$route['unsub-director-listing'] = 'directors/unsub_director/AjaxData';
$route['unsub-director-note/(:num)'] = 'directors/unsub_director/unsub_director_note/$1';
$route['future-directors'] = 'directors/future_director_list/index';
$route['future-director-listing'] = 'directors/future_director_list/AjaxData';
$route['delete-future-director/(:num)'] = 'directors/future_director_list/delete_director/$1';
/* End to directors */

/* Customer Communication */
$route['customer-communication'] = 'UACC/UACC_list/index';
$route['uacc-listing'] = 'UACC/UACC_list/AjaxData';
$route['uacc-client-emails/(:num)'] = 'UACC/UACC_list/uacc_client_emails/$1';
$route['view-uacc-client-email/(:num)/(:any)'] = 'UACC/UACC_list/view_uacc_client_email/$1/$2';
$route['add-uacc'] = 'UACC/UACC/add_uacc';
$route['edit-uacc/(:num)'] = 'UACC/UACC/edit_uacc/$1';
$route['check-uacc-email-exists'] = 'UACC/UACC/UACCEmailExist';
$route['check-uacc-consultant-exists'] = 'UACC/UACC/UACCConsultantExist';
$route['add-cc-note'] = 'UACC/UACC/add_cc_note';
$route['cc-note-list'] = 'UACC/UACC/cc_note_list';
$route['unsub-uacc-note/(:num)'] = 'UACC/UACC/unsub_uacc_note/$1';
$route['unsubscribed-uacc'] = 'UACC/UACC_list/Unsub_uacc_list';
$route['unsub-uacc-listing'] = 'UACC/UACC_list/Unsub_uacc_AjaxData';
/* End Customer Communication */


/* Bella Fizz */
$route['bellafizz'] = 'bellafizz/bellafizz/index';
$route['bellafizz-listing'] = 'bellafizz/bellafizz/AjaxData';
$route['add-bellafizz'] = 'bellafizz/bellafizz/add_bellafizz';
$route['edit-bellafizz/(:num)'] = 'bellafizz/bellafizz/edit_bellafizz/$1';
$route['bellafizz-unique-email'] = 'bellafizz/bellafizz/bellafizzEmailExist';
$route['bellafizz-unique-rep'] = 'bellafizz/bellafizz/bellafizzRepExists';
$route['delete-bellafizz/(:num)'] = 'bellafizz/bellafizz/delete_bellafizz/$1';
$route['add-bellafizz-note'] = 'bellafizz/bellafizz/add_bellafizz_note';
$route['bellafizz-note-list'] = 'bellafizz/bellafizz/bellafizz_note_list';
/* End Bella Fizz */


/* Prospect */
$route['prospects'] = 'prospects/prospects/index';
$route['prospects-listing'] = 'prospects/prospects/AjaxData';
$route['add-prospects'] = 'prospects/prospects/add_prospects';
$route['edit-prospects/(:num)'] = 'prospects/prospects/edit_prospects/$1';
$route['delete-prospects/(:num)'] = 'prospects/prospects/delete_prospects/$1';
$route['add-prospects-note'] = 'prospects/prospects/add_prospects_note';
$route['prospects-note-list'] = 'prospects/prospects/prospects_note_list';
/* End Prospect */


/* Admin Side */
	$route['admin'] = 'admin/admin_login/login';
	$route['admin/admin-login'] = 'admin/admin_login/login';
	$route['admin/dashboard'] = 'admin/dashboard';
	$route['admin/logout'] = 'admin/dashboard/logout';
	$route['admin/user-list'] = 'admin/user/index';
	$route['admin/add-user'] = "admin/user/add_user";
	$route['admin/edit-user/(:num)'] = "admin/user/edit_user/$1";
	$route['admin/delete-user/(:num)'] = "admin/user/delete_user/$1";
	$route['admin/delete-all-user'] = "admin/user/delete_all_user";
	$route['admin/user-logout/(:num)'] = "admin/user/user_logout/$1";
	$route['admin/re-send-mail/(:num)'] = "admin/user/re_send_mail/$1";
	$route['admin/track-hours/(:num)'] = "admin/user/track_hours/$1";
	$route['admin/download-whole-track/(:num)'] = "admin/user_track_export/download_whole_track/$1";
	$route['admin/download-daily-track/(:num)'] = "admin/user_track_export/download_daily_track/$1";
	$route['admin/download-weekly-track/(:num)'] = "admin/user_track_export/download_weekly_track/$1";

	// directors
	$route['admin/directors'] = 'admin/directors';
	$route['admin/approve-newsletter-design/(:any)'] = 'admin/directors/approve_newsletter_design/$1';
	$route['admin/newsletter-approval-failed'] = 'admin/directors/newsletter_approval_failed';
	$route['admin/newsletter-approval-success'] = 'admin/directors/newsletter_approval_success';
	$route['admin/director-emails/(:num)'] = 'admin/directors/director_emails/$1';
	$route['admin/newsletter-message/(:num)'] = 'admin/directors/newsletter_message/$1';
	$route['admin/view-email-detail/(:num)/(:any)'] = 'admin/directors/view_email_detail/$1/$2';
	$route['admin/delete-director/(:num)'] = 'admin/directors/delete_director/$1';
	$route['admin/delete-selected-director'] = 'admin/directors/delete_selected_director';
	$route['admin/approve-director/(:num)'] = 'admin/directors/approve_director/$1';
	$route['admin/dis-approve-director/(:num)'] = 'admin/directors/dis_approve_director/$1';
	$route['admin/director-history/(:num)'] = 'admin/directors/director_history/$1';
	$route['admin/view-history/(:num)'] = 'admin/directors/view_history/$1';
	$route['admin/delete-history/(:num)/(:num)'] = 'admin/directors/delete_history/$1/$2';
	$route['admin/delete-all-history'] = 'admin/directors/delete_all_history';
	$route['admin/excel-export'] = 'admin/excel_export/downloadExcel';
	$route['admin/excel-save'] = 'admin/excel_export/downloadExcel';
	$route['admin/excel-export/(:num)'] = 'admin/excel_export/downloadExcel/$1';
	$route['admin/upload-balance-excel'] = 'billing/upload_excel/upload_balance_excel';
	$route['admin/upload-unit-excel'] = 'billing/upload_excel/upload_unit_excel';
	$route['admin/upload-excel'] = 'billing/upload_excel/uploadExcel';
	$route['admin/texting-reports'] = 'admin/dashboard/texting_reports';
	$route['admin/newsletter-reports'] = 'admin/dashboard/newsletter_reports';
	$route['admin/newsletter-design-status'] = 'admin/dashboard/newsletter_design_status';
	$route['admin/requested-changes'] = 'admin/dashboard/requested_changes';
	$route['admin/view-changes-detail'] = 'admin/dashboard/view_changes_detail';
	$route['admin/email-setting'] = 'admin/dashboard/email_setting';
	$route['admin/archieved-clients'] = 'admin/directors/archieved_clients';
	$route['admin/revert-client/(:num)'] = 'admin/directors/revert_client/$1';
	$route['admin/revert-to-client-list/(:num)'] = 'admin/directors/revert_to_client_list/$1';
	$route['admin/archieved-UACC-clients'] = 'admin/UACC/archieved_uacc_clients';
	$route['admin/revert-UACC-client/(:num)'] = 'admin/UACC/revert_uacc_client/$1';
	$route['admin/revert-to-UACC-client-list/(:num)'] = 'admin/UACC/revert_to_uacc_client_list/$1';
	$route['admin/unsuscribed-clients'] = 'admin/directors/unsuscribed_clients';
	$route['admin/unsubscribed-export'] = 'admin/unsub_export/unsubscribed_excel';
	$route['admin/unsuscribed-UACC-clients'] = 'admin/UACC/unsuscribed_uacc_clients';
	$route['admin/unsubscribed-UACC-export/(:any)'] = 'admin/UACC_excel_export/download_uacc_excel/$1';
	$route['admin/newsletter-messages'] = 'admin/dashboard/newsletter_message';
	$route['admin/app-version'] = 'admin/dashboard/app_version';
	$route['admin/ua-admin-emails'] = 'admin/dashboard/ua_admin_emails';
	$route['admin/ua-user-emails'] = 'admin/dashboard/ua_user_emails';
	$route['admin/uacc-admin-emails'] = 'admin/dashboard/uacc_admin_emails';
	$route['admin/uacc-user-emails'] = 'admin/dashboard/uacc_user_emails';
	$route['admin/email-contents'] = 'admin/dashboard/email_contents';
	$route['admin/uacc-email-contents'] = 'admin/dashboard/uacc_email_contents';
	$route['admin/approve-log'] = 'admin/dashboard/approve_log';
	$route['admin/push-notifications'] = 'admin/dashboard/push_notifications';
	$route['admin/uacc-push-notifications'] = 'admin/dashboard/uacc_push_notifications';
	// End of directors


	// future
	$route['admin/future-update-list'] = 'admin/directors/future_update_list';
	$route['admin/future-history/(:num)'] = 'admin/directors/future_history/$1';
	$route['admin/delete-future-client/(:num)'] = 'admin/directors/delete_future_client/$1';
	$route['admin/delete-selected-future-client'] = 'admin/directors/delete_selected_future_client';
	// End future


	// Customer Communication
	$route['admin/uacc'] = 'admin/UACC';
	$route['admin/delete-uacc/(:num)'] = 'admin/UACC/delete_uacc/$1';
	$route['admin/delete-selected-uacc'] = 'admin/UACC/delete_selected_uacc';
	$route['admin/uacc-history/(:num)'] = 'admin/UACC/uacc_history/$1';
	$route['admin/view-uacc-history/(:num)'] = 'admin/UACC/view_uacc_history/$1';
	$route['admin/delete-uacc-history/(:num)/(:num)'] = 'admin/UACC/delete_uacc_history/$1/$2';
	$route['admin/delete-selected-uacc-history'] = 'admin/UACC/delete_selected_uacc_history';
	$route['admin/uacc-excel-export'] = 'admin/UACC_excel_export/download_uacc_excel';
	$route['admin/uacc-excel-save'] = 'admin/UACC_excel_export/download_uacc_excel';
	$route['admin/uacc-history-excel-export/(:num)'] = 'admin/UACC_excel_export/download_uacc_excel/$1';
	$route['admin/upload-credit-excel'] = 'UACC_billing/upload_uacc_excel/upload_credit_excel';
	// End of Customer Communication


	// BellaFizz
	$route['admin/bellafizz'] = 'admin/bellafizz';
	$route['admin/delete-bellafizz/(:num)'] = 'admin/bellafizz/delete_bellafizz/$1';
	$route['admin/bellafizz-excel-export'] = 'admin/bellafizz/download_bellafizz_excel';
	$route['admin/bellafizz-excel-export/(:num)'] = 'admin/bellafizz/download_bellafizz_excel/$1';
	// End BellaFizz

/* End of Admin Side */



/* Billing Side */

	// Director Billings
	$route['billing/dashboard'] = 'billing/billing/index';
	$route['billing/clients'] = 'billing/billing/clients';
	$route['billing/ajaxData'] = 'billing/billing/ajaxData';
	$route['billing/create-invoice'] = 'billing/billing/create_invoice';
	$route['billing/edit-invoice/(:num)'] = 'billing/billing/create_invoice/$1';
	$route['billing/invoices-list'] = 'billing/billing/invoices_list';
	$route['billing/invoices-list/(:num)'] = 'billing/billing/invoices_list/$1';
	$route['billing/delete-invoice-pdf'] = 'billing/billing/delete_invoice_pdf';
	$route['billing/delete-all-invoice'] = 'billing/billing/delete_all_invoice';
	$route['billing/search-keyword'] = 'billing/billing/search_keyword';
	$route['billing/search-name'] = 'billing/billing/search_name';
	$route['billing/get-invoice-data'] = 'billing/billing/get_invoice_data';
	$route['billing/save-invoice'] = 'billing/billing/save_invoice';
	$route['billing/make-payment'] = 'billing/billing/make_payment';
	$route['billing/unpaid'] = 'billing/billing/unpaid';
	$route['billing/get-mail-content'] = 'billing/billing/get_mail_content';
	$route['billing/send-invoice-mail'] = 'billing/billing/send_invoice_mail';
	$route['billing/reset-balance/(:num)'] = 'billing/billing/reset_balance/$1';
	$route['billing/reset-all-balance'] = 'billing/billing/reset_all_balance';
	$route['billing/get-all-invoice'] = 'billing/billing/get_all_invoice';
	$route['billing/save-all-invoice'] = 'billing/billing/save_all_invoice';
	$route['billing/upload-excel'] = 'billing/upload_excel/uploadExcel';
	$route['billing/upload-balance-excel'] = 'billing/upload_excel/upload_balance_excel';
	$route['billing/upload-unit-excel'] = 'billing/upload_excel/upload_unit_excel';
	$route['billing/invoice-year-report/(:num)'] = 'billing/report/download_year_report/$1';
	$route['billing/all-invoice-report'] = 'billing/report/all_invoice_report';
	$route['billing/all-invoice-report/(:any)'] = 'billing/report/all_invoice_report/$1';
	$route['billing/bank-report/(:any)'] = 'billing/report/bank_report/$1';
	$route['billing/item-report'] = 'billing/report/item_report';
	$route['billing/billing-changes-report'] = 'billing/report/billing_changes_report';
	$route['billing/unsubscribed-report'] = 'billing/report/unsubscribed_report';
	$route['billing/unsubscribed-client'] = 'billing/billing/Unsbclients';
	$route['billing/reports'] = 'billing/report/index';
	$route['billing/credit-payment'] = 'billing/billing/credit_payment';
	$route['billing/payment-credit'] = 'billing/billing/payment_credit';
	$route['billing/proccess-payment'] = 'billing/billing/proccess_payment';
	$route['billing/send-selected-invoice-mail'] = 'billing/billing/send_selected_invoice_mail';
	$route['billing/send-all-invoice-mail'] = 'billing/billing/send_selected_invoice_mail';
	// End of Director Billings


	// UACC Billings
	$route['uacc-billing/dashboard'] = 'UACC_billing/UACC_billing/index';
	$route['uacc-billing/clients'] = 'UACC_billing/UACC_billing/uacc_clients';
	$route['uacc-billing/ajaxData'] = 'UACC_billing/UACC_billing/ajaxData';
	$route['uacc-billing/billing-history'] = 'UACC_billing/UACC_billing/uacc_billing_history';
	$route['uacc-billing/billing-history-data'] = 'UACC_billing/UACC_billing/billing_history_data';
	$route['uacc-billing/reset-balance/(:num)'] = 'UACC_billing/UACC_billing/reset_UACC_balance/$1';
	$route['uacc-billing/reset-all-balance'] = 'UACC_billing/UACC_billing/reset_all_UACC_balance';
	$route['uacc-billing/delete-all-invoice'] = 'UACC_billing/UACC_billing/delete_all_UACC_invoice';
	$route['uacc-billing/create-invoice'] = 'UACC_billing/UACC_billing/create_UACC_invoice';
	$route['uacc-billing/edit-invoice/(:num)'] = 'UACC_billing/UACC_billing/create_UACC_invoice/$1';
	$route['uacc-billing/search-keyword'] = 'UACC_billing/UACC_billing/search_UACC_keyword';
	$route['uacc-billing/search-name'] = 'UACC_billing/UACC_billing/search_UACC_name';
	$route['uacc-billing/get-invoice-data'] = 'UACC_billing/UACC_billing/get_UACC_invoice_data';
	$route['uacc-billing/save-invoice'] = 'UACC_billing/UACC_billing/save_UACC_invoice';
	$route['uacc-billing/invoices-list'] = 'UACC_billing/UACC_billing/UACC_invoices_list';
	$route['uacc-billing/invoices-list/(:num)'] = 'UACC_billing/UACC_billing/UACC_invoices_list/$1';
	$route['uacc-billing/all-invoices-list'] = 'UACC_billing/UACC_billing/UACC_invoices_history_list';
	$route['uacc-billing/all-invoices-list/(:num)'] = 'UACC_billing/UACC_billing/UACC_invoices_history_list/$1';
	$route['uacc-billing/make-payment'] = 'UACC_billing/UACC_billing/UACC_make_payment';
	$route['uacc-billing/unpaid'] = 'UACC_billing/UACC_billing/UACC_unpaid';
	$route['uacc-billing/credit-payment'] = 'UACC_billing/UACC_billing/UACC_credit_payment';
	$route['uacc-billing/payment-form'] = 'UACC_billing/UACC_billing/UACC_payment_form';
	$route['uacc-billing/proccess-payment'] = 'UACC_billing/UACC_billing/proccess_UACC_payment';
	$route['uacc-billing/delete-invoice-pdf'] = 'UACC_billing/UACC_billing/delete_UACC_invoice_pdf';
	$route['uacc-billing/get-mail-content'] = 'UACC_billing/UACC_billing/get_UACC_mail_content';
	$route['uacc-billing/send-invoice-mail'] = 'UACC_billing/UACC_billing/send_UACC_invoice_mail';
	$route['uacc-billing/get-all-invoice'] = 'UACC_billing/UACC_billing/get_all_UACC_invoice';
	$route['uacc-billing/save-all-invoice'] = 'UACC_billing/UACC_billing/save_all_UACC_invoice';
	$route['uacc-billing/upload-credit-excel'] = 'UACC_billing/upload_uacc_excel/upload_credit_excel';
	$route['uacc-billing/invoice-year-report/(:num)'] = 'UACC_billing/UACC_report/download_year_UACC_report/$1';
	$route['uacc-billing/unsubscribed-report'] = 'UACC_billing/UACC_report/unsubscribed_UACC_report';
	$route['uacc-billing/all-invoice-report'] = 'UACC_billing/UACC_report/all_UACC_invoice_report';
	$route['uacc-billing/all-invoice-report/(:any)'] = 'UACC_billing/UACC_report/all_UACC_invoice_report/$1';
	$route['uacc-billing/bank-report/(:any)'] = 'UACC_billing/UACC_report/bank_UACC_report/$1';
	$route['uacc-billing/item-report'] = 'UACC_billing/UACC_report/item_UACC_report';
	$route['uacc-billing/total-bank-report'] = 'UACC_billing/UACC_report/total_bank_UACC_report';
	$route['uacc-billing/upload-balance-excel'] = 'UACC_billing/upload_uacc_excel/upload_UACC_balance_excel';
	$route['uacc-billing/send-all-invoice-mail'] = 'UACC_billing/UACC_billing/send_selected_UACC_invoice_mail';
	$route['uacc-billing/reports'] = 'UACC_billing/UACC_report/index';
	// End of UACC Billings

/* End of Billing Side */


/* UA API */
$route['user-login-api'] = 'API/user/user_login';
$route['user-profile'] = 'API/user_profile/index';
$route['device-update'] = 'API/user/device_update';
$route['contact'] = 'API/contact/index';
$route['bitly-api'] = 'API/user/bitly_api';
$route['ncp-api'] = 'API/user/ncp_api';
$route['change'] = 'API/change/index';
$route['change-android'] = 'API/change/change_android';
$route['newsletter-approve'] = 'API/newsletter_approve/index';
$route['newsletter-changes'] = 'API/newsletter_changes/index';
$route['client-package'] = 'API/client_package/index';
$route['response-token'] = 'API/response_token/index';
$route['android-firebase'] = 'API/firebase/android_firebase';
$route['ios-firebase'] = 'API/firebase/ios_firebase';
/* UA API */


/* UACC API */
$route['uacc-user-login'] = 'API/user/uacc_user_login';
$route['uacc-contact'] = 'API/contact/uacc_contact';
$route['uacc-bizz'] = 'API/bizz/index';
$route['uacc-user-profile'] = 'API/user_profile/uacc_user_profile';
/* UACC API */


/* TBP API*/
$route['tbp-user-login'] = 'API/user/tbp_user_login';
$route['tbp-user-profile'] = 'API/user_profile/tbp_user_profile';
$route['tbp-contact'] = 'API/contact/tbp_contact';
/* End TBP API*/