<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/************************** EMAIL CONSTANTS *****************************/

define('EMAIL_FROM', 'sanjay@aasthasolutions.com'); // e.g. email@example.com
define('EMAIL_BCC', 'Your bcc email'); // e.g. email@example.com
define('FROM_NAME', 'CIAS Admin System'); // Your system name
define('EMAIL_PASS', 'A@stha17'); // Your email password
define('PROTOCOL', 'smtp'); // mail, sendmail, smtp
define('SMTP_HOST', 'ssl://smtp.googlemail.com'); // your smtp host e.g. smtp.gmail.com
define('SMTP_PORT', '465'); // your smtp port e.g. 25, 587
define('SMTP_USER', 'sanjay@aasthasolutions.com'); // your smtp user
define('SMTP_PASS', 'A@stha17'); // your smtp password
define('MAIL_PATH', '/usr/sbin/sendmail');


//Points value for sapphire
define("Sapphire0", '98');
define("Sapphire30", '128');
define("Sapphire55", '168');
define("Sapphire80", '218');
define("Sapphire105", '248');
define("Sapphire125", '268');
define("Sapphire155", '278');
define("Sapphire175", '298');
define("Sapphire200", '338');
define("Sapphire225", '378');
define("Sapphire250", '398');
//Points value for Rubby

define("Ruby0", '128');
define("Ruby30", '158');
define("Ruby55", '218');
define("Ruby80", '298');
define("Ruby105", '328');
define("Ruby125", '348');
define("Ruby155", '368');
define("Ruby175", '388');
define("Ruby200", '428');
define("Ruby225", '468');
define("Ruby250", '488');

//Points value for Diamond

define("Diamond0", '168');
define("Diamond30", '218');
define("Diamond55", '298');
define("Diamond80", '378');
define("Diamond105", '408');
define("Diamond125", '428');
define("Diamond155", '458');
define("Diamond175", '478');
define("Diamond200", '518');
define("Diamond225", '558');
define("Diamond250", '578');

//Points value for Emerald

define("Emerald0", '228');
define("Emerald30", '298');
define("Emerald55", '378');
define("Emerald80", '458');
define("Emerald105", '488');
define("Emerald125", '508');
define("Emerald155", '538');
define("Emerald175", '558');
define("Emerald200", '588');
define("Emerald225", '638');
define("Emerald250", '658');

//Points value for Pearl

define("Pearl0", '258');
define("Pearl30", '328');
define("Pearl55", '408');
define("Pearl80", '488');
define("Pearl105", '538');
define("Pearl125", '568');
define("Pearl155", '588');
define("Pearl175", '608');
define("Pearl200", '648');
define("Pearl225", '688');
define("Pearl250", '698');



//Points value for Economy

define("Economy0", '69');
define("Economy30", '79');
define("Economy55", '89');
define("Economy80", '99');
define("Economy105", '109');
define("Economy125", '119');
define("Economy155", '129');
define("Economy175", '139');
define("Economy200", '149');
define("Economy225", '159');
define("Economy250", '169');

//Points value for Special
define("SpecialAll", '59.01');


define("newsletter_design_constant_val",'25');
define("nl_flyer_constant_val",'19.99');
define("newsletter_color_constant_val",'1.29');
define("newsletter_black_white_constant_val",'0.99');
//define("month_packet_postage_constant_val",'1.42');
define("month_packet_postage_constant_val",'1.45');
//define("consultant_packet_postage_constant_val",'1.72');
define("consultant_packet_postage_constant_val",'1.75');
//define("consultant_bundles_constant_val",'6.8');
define("consultant_bundles_constant_val",'7.15');
define("consistency_gift_constant_val",'7');
define("reds_program_gift_constant_val",'5');
define("stars_program_gift_constant_val",'5');
define("gift_wrap_postpage_constant_val",'3.5');
//define("one_rate_postpage_constant_val",'6.8');
define("one_rate_postpage_constant_val",'7.75');	
define("month_blast_flyer_constant_val",'7.99');
define("flyer_ecard_unit_constant_val",'9.99');
define("unit_challenge_flyer_constant_val",'11.99');
define("team_building_flyer_constant_val",'11.99');
define("wholesale_promo_flyer_constant_val",'11.99');
//define("postcard_design_constant_val",'19.99');
define("postcard_design_constant_val",'24.99');
define("postcard_edit_constant_val",'9.99');
//define("ecard_unit_constant_val",'24.99');
define("ecard_unit_constant_val",'4.99');
//define("speciality_postcard_constant_val",'0.65');
define("speciality_postcard_constant_val",'0.69');
define("card_with_gift_constant_val", '2.59');

define("birthday_brownie_constant_val",'0.89');
define("birthday_starbucks_constant_val",'9.99');
define("referral_credit_constant_val",'50');
define("UACC_BILLING",'29.99');
define("customer_newsletter_constant_val",'1.25');
define("birthday_postcard_constant_val",'0.65');
define("anniversary_postcard_constant_val",'0.65');
define("picture_texting_constant_val",'0.04');
define("keyword_constant_val",'10');
define("client_setup_constant_val",'25');
//define("anniversary_starbucks_constant_val",'1');
define("anniversary_starbucks_constant_val",'9.99');
define("special_credit_constant_val",'1');
define("facebook",'19.99');
define("facebook_everything",'49.99');
define("email_newsletter",'19.99');
define("emailing_0",'38');
define("emailing_1",'55');
define("other_language_newsletter",'25');

define("DIGITAL_BIZ_CARD",'20');
define("canada_service",'29.01');

define("total_text_program7_n",'69.99');
define("total_text_program7_y",'39.99');
define("total_text_program7_p",'9.99');

//if package is S,E1,R,D,E and the total text text program is checked
define("total_text_program_s_e1_r",'29.99');
//if package is P and the total text text program is checked
define("total_text_program_d_e_p",'9.99');
//if package is Null or Unsubscribe
define("total_text_program_n",'59.99');

// if total text program is not checked and nsd is not checked then Texting will be
	//if Testing is yes and package is S,R,E1
	define("texting_s_r_e1",'19.99');
	//if texting is yes and package is D,E,P
	define("texting_d_e_p",'29.99');
	//If texting is yes and package is null or unsubscribe
	define("texting_n",'49.99');
// Newsletter Design value is 25 if design is simple newsletter both and advanced newsletter both
define("newsletter_desing_sb_ab",'25');
define("personal_unit_app_val",'29.99');
define("personal_website_val",'29.99');
define("pack_personal_unit_app_val",'59.99');
define("pack_personal_website_val",'59.99');
define("personal_url_val",'5');
define("subscription_updates_val",'35');
define("app_color_val",'5');
define("newsletter_formating_val",'20');
define("personal_unit_app_canada","49.99");
define("PROSPECT_SYSTEM","29.99");
define("CV_PROSPESCT_VAL","00.00");
define("MAGIC_BOOKER","49.99");
define("greeting_card_constant_val", '1.79');

/*API*/
define("FTP_USER", 'apiuser@ericdwoods.com');
define("FTP_HOST", 'ftp.ericdwoods.com');
define("FTP_PASS", '5Dr-w.4UAF');
define("FILE_PATH", 'upload/');
/*API*/



/*Email Constants*/
	const unsub = array('E'=>'Unsubscribe','S'=>'Abandonar', 'F'=>'');

	const print_option = array('E'=>'Newsletter Print Options','S'=>"Opciones de impresión del boletín", 'F'=>"Options d'impression de la newsletter");
	const contact = array('E'=>'Do Not Contact Consultant','S'=>'Consultoras que no se deben contactar', 'F'=>'Ne contactez pas le consultant');
	const name = array('E'=>'Client Name','S'=>'Nombre de Cliente', 'F'=>'Nom du client');
	const consultant_number = array('E'=>'Consultant ID','S'=>'Número de Consultora', 'F'=>'ID du consultant');	
	const mk_director = array('E'=>'How long have you been a MK director?','S'=>'Cuanto tiempo has sido director de MK?', 'F'=>'Depuis combien de temps êtes-vous administrateur de MK?');
	const intouch_password = array('E'=>'Password','S'=>'Contraseña', 'F'=>'Mot de passe');
	const unit_number = array('E'=>'Unit Number','S'=>'Número de Unidad', 'F'=>"Numéro d'unité");
	const month_mailing = array('E'=>'Start Month','S'=>'Mes Comienzo', 'F'=>"Mois de début");
	const year_mailing = array('E'=>'Start Year','S'=>'Año de Comienzo', 'F'=>"Année de début");
	const package = array('E'=>'Package For Billing','S'=>'Paquete a facturar', 'F'=>"Forfait pour la facturation");
	const total_text_program = array('E'=>'Total Text Program','S'=>'Programa Total de Texto', 'F'=>"Programme de texte total");
	const total_text_program7 = array('E'=>'7/2019 Total Text Package','S'=>'7/2019 Programa Total de Texto', 'F'=>"7/2019 Package de texte total");
	const unit_size = array('E'=>'Actual Unit Size','S'=>'Tamaño Actual Unidad', 'F'=>"Taille réelle de l'unité");
	const hidden_newsletter=array('E'=>'Newsletter Design','S'=>'Diseño del Boletín', 'F'=>"Conception de la newsletter");
	const distribution_one = array('E'=>'Emailing of Newsletter','S'=>'Boletín enviado por Correo Electrónico', 'F'=>"Carte de visite numérique");
	const package_value = array('E'=>'Package Price','S'=>'Precio del Paquete', 'F'=>"Prix du coffret");
	const distribution_two=array('E'=>'Facebooking Newsletter','S'=>'Boletín en Facebook','F'=>"Newsletter Facebooking");
	const closing_ecards = array('E'=>'Signature for Closing of E - Cards','S'=>'Firma ~ cierre de las tarjetas virtuales', 'F'=>"Signature pour la fermeture des cartes électroniques");
	const birthday_one = array('E'=>'Hand Signed Happy Birthday Cards with gift','S'=>'Tarjeta de Cumpleaños firmadas a mano con regalo', 'F'=>"Cartes de joyeux anniversaire signées à la main avec cadeau");
	const birthday_one1 = array('E'=>'Happy Birthday Post Card','S'=>'Tarjeta de Cumpleaños', 'F'=>"Carte postale de joyeux anniversaire");
	const anniversary_one = array('E'=>'Hand Signed Happy Anniversary Card with gift','S'=>'Tarjeta de Aniversario firmada a mano con regalo', 'F'=>"Carte de joyeux anniversaire signée à la main avec cadeau");
	const anniversary_two= array('E'=>'Happy Anniversary Post Card','S'=>'Tarjeta de Aniversario', 'F'=>"Carte postale de joyeux anniversaire");
	const status_one = array('E'=>'A3 Post card','S'=>'Tarjeta A3', 'F'=>"Carte postale A3");
	const status_two = array('E'=>'I1 Post Card','S'=>'Tarjeta I1', 'F'=>"Carte postale I1");
	const status_three = array('E'=>'I2 Post Card','S'=>'Tarjeta I2', 'F'=>"Carte postale I2");
	const status_four = array('E'=>'I3 Post Card','S'=>'Tarjeta I3', 'F'=>"Carte postale I3");	
	const status_five = array('E'=>'T1 Post Card','S'=>'Tarjeta T1', 'F'=>"Carte postale T1");
	const status_six = array('E'=>'Thank You Post Card','S'=>'Tarjeta Gracias por Ordenar', 'F'=>"Carte postale de remerciement");
	const status_seven = array('E'=>'Consistency club Post card - Gift Club','S'=>'Tarjeta de Club de Consistencia', 'F'=>"Carte postale Consistency Club - Gift Club");
	const amount_box = array('E'=>'Amount Box - Gift Club','S'=>'Cantidad Caja - Regalo', 'F'=>"Coffret montant - Gift Club");
	const accumulative = array('E'=>'Accumulative - Gift Club','S'=>'Cantidad Caja - Acumulativo - Regalo', 'F'=>"Cumulatif - Gift Club");	
	const monthly = array('E'=>'Monthly - Gift Club','S'=>'Mensual - regalo', 'F'=>"Mensuel - Gift Club");
	const status_seven0 = array('E'=>'Consistency club Tracked by $750 per quarter','S'=>'Por favor contabilicen $750 al mayoreo acumulativo en 3 meses', 'F'=>"Club de cohérence suivi de 750 $ par trimestre");
	const status_eight = array('E'=>'Star On Target Post Card','S'=>'Tarjeta En Marca para la Estrella', 'F'=>"Carte postale Star On Target");
	const status_nine = array('E'=>'Star Gifts at the end of the quarter ( star certificate ect.)','S'=>'Paquete de Ultimo Mes (este servicio tiene un cargo adicional de $1.35 por paquete)', 'F'=>"Cadeaux étoiles à la fin du trimestre (certificat étoile ect.)");
	const last_one = array('E'=>'Last Month Packet (postage charge of $1.35 per packet)','S'=>'Paquete de Ultimo Mes (este servicio tiene un cargo adicional de $1.35 por paquete):', 'F'=>"Paquet du mois dernier (frais de port de 1,35 $ par paquet)");
	const last_two=array('E'=>'Last Month Post Card','S'=>'Tarjeta de Ultimo Mes', 'F'=>"Carte postale du mois dernier");

	const gift_one = array('E'=>'Top 10 Month Gift Club: Gift goes to top 2,3 or 5 consultants - all 10 get post card (gifts based on unit size)','S'=>'Club Regalo Top 10 Ventas del Mes: Regalo se envía a las Top 2,3 o 5 consultoras - las Top 10 reciben tarjeta (regalos basados en el tamaño de unidad)', 'F'=>"Top 10 Month Gift Club: Le cadeau va aux 2 3 ou 5 meilleurs consultants - tous les 10 reçoivent une carte postale (cadeaux en fonction de la taille de l'unité)");

	
	const gift_three = array('E'=>'Top 10 YTD Sales Club with Gift : Gift mails to top 2, 3 or 5 consultants based on unit size.Top 10 are featured on post card to the 10/ e card to the whole unit','S'=>'Club Regalo Top 10 Ventas en el Año : Regalo  se envía a las Top 2,3 o 5 consultoras - las Top 10 reciben tarjeta (regalos basados en el tamaño de unidad)/ e card se le envía a toda la unidad', 'F'=>"Top 10 YTD Sales Club avec cadeau: des courriers cadeaux aux 2, 3 ou 5 meilleurs consultants en fonction de la taille de l'unité Les 10 meilleurs sont présentés sur la carte postale à la carte 10 / e à l'unité entière ");	

	const gift_four = array('E'=>'Top 5 Recruiting: Gift mails to queen of recruiting for the month - top 5 get post card recognition.','S'=>'Top 5 en Compartir: Regalo se le envía a la reina del compartir- top 5 reciben una postal de reconocimiento.', 'F'=>"Top 5 du recrutement: envoyez des courriels à la reine du recrutement pour le mois - les 5 meilleurs reçoivent la reconnaissance des cartes postales.");

	const gift_five = array('E'=>'Reds Program: quarterly program- All Sr consultants get post cards. All unit members get email. End of the quarter all red Jackets get gift from Director.  Gifts are $5 at the end of quarter plus shipping.','S'=>'Programa Sacos Rojos: programa trimestral= Todas las consultoras Senior reciben tarjetas. Todos los miembros de unidad reciben Correo Electrónico. Al final del trimestre, todos los Sacos Rojos reciben un regalo de la directora. Regalos son $5 al final del trimestre mas envío.', 'F'=>"Programme Reds: programme trimestriel - Tous les consultants Sr reçoivent des cartes postales. Tous les membres de l'unité reçoivent un e-mail. Fin du trimestre, toutes les vestes rouges reçoivent un cadeau du directeur. Les cadeaux coûtent 5 $ à la fin du trimestre plus les frais d'expédition.");

	const star_program = array('E'=>'Star Program','S'=>'Programa estrella', 'F'=>"Programme étoile");

	const consultant_one = array('E'=>'Husband Post Card','S'=>'Tarjeta a los Esposos', 'F'=>"Carte postale de mari");

	const consultant_two = array('E'=>'New Consultant Post Cards- 5 week series','S'=>'Serie de tarjetas por 5 semanas para Consultoras Nuevas', 'F'=>"Nouvelles cartes postales de consultant - Série de 5 semaines");

	const consultant_two1 = array('E'=>'New Consultant post card 1st card mailed if subscribed - 7 day wonder','S'=>'Tarjetas de Consultoras Nuevas - 1era tarjeta/ promoción 7 días maravillosos- enviar S para Si- N para No', 'F'=>"Nouvelle carte postale du consultant 1ère carte postée si vous êtes abonné - 7 jours merveille");

	const consultant_five = array('E'=>'New Consultant Packet Bundles- by request','S'=>'Paquete de Consultoras Nuevas- En vez de enviarlo a las consultoras/varios paquetes son enviados a la Directora que lo solicite', 'F'=>"Nouveaux packs de paquets de consultant - sur demande");

	const consultant_three = array('E'=>'New Consultant Packet - mailed directly to consultant at a added postage charge of $1.75','S'=>'Paquete de Consultora Nueva/ tipo de paquete', 'F'=>"Nouveau paquet de consultant - envoyé directement au consultant moyennant des frais postaux supplémentaires de 1,75 $");

	const consultant_four = array('E'=>'Type of packet','S'=>'Edición de paquete UA / propio paquete', 'F'=>"Type de paquet");

	const consultant_six = array('E'=>'Recruiter check list','S'=>'Listado de la Reclutadora', 'F'=>"Liste de contrôle du recruteur");

	const newsletter_design = array('E'=>'Ala Carte Newsletter Design','S'=>'Diseño del Boletín a la carta', 'F'=>"Conception de la newsletter Ala Carte");

	const email_news = array('E'=>'Formatting and or emailing of Newsletter $20','S'=>'Formato y / o el envío del boletín por correo electrónico $20', 'F'=>"Formatage et / ou envoi de la newsletter 20 $");

	const digitalBizCard = array('E'=>'Digital biz card $20','S'=>'Tarjeta Digital de Negocio $20', 'F'=>"Carte de visite numérique 20 $");

	const canadaService = array('E'=>'Canada Services - US Dollar $99','S'=>'Servicios de Canadá - Dólar estadounidense $ 99', 'F'=>"Services au Canada - Dollar américain 99 $");

	const facebook_news = array('E'=>'Ala Carte Facebook Posting','S'=>'Publicar Boletín en Facebook a la Carta', 'F'=>"Newsletter Facebooking");

	const facebook_everything_news = array('E'=>'Ala Carte Facebook Everything Posting','S'=>'Publicación de todo en Facebook a la carta', 'F'=>"Newsletter Tout Facebooking");

	const other_lang_newsletter = array('E'=>'Other Language Newsletter','S'=>'Boletín de otros idiomas', 'F'=>"Newsletter dans une autre langue");

	const newsletter_color=array('E'=>'Newsletter Color','S'=>'boletín de noticias Color', 'F'=>"Newsletter Noir Blanc");
	const newsletter_black_white = array('E'=>'Newsletter Black White','S'=>'boletín informativo Black White', 'F'=>"Newsletter Noir Blanc");
	const auto_send = array('E'=>'Date requested to Auto send newsletter','S'=>'Fecha seleccionada para enviar el Auto envío del Boletín', 'F'=>"Date requise pour l'envoi automatique de la newsletter");
	const n_zero = array('E'=>'NO Newsletter Printing&nbsp;(Printing of Newsletters -- C is for Color $1.29 - B is for B/W .99 ea.)','S'=>'Boletín (C Color, B es blanco y negro-Impresión $1.29 a Color o .99 por blanco y negro):', 'F'=>"AUCUNE impression de bulletin d'information (impression de bulletins - C est pour la couleur 1,29 $ - B est pour N / B, 99 ch.)");
	const n_one = array('E'=>'N1 Newsletter Printing','S'=>'Boletín N1', 'F'=>"Impression du bulletin N1");
	const n_two = array('E'=>'N2 Newsletter Printing','S'=>'Boletín N2', 'F'=>"Impression du bulletin N2");
	const n_three = array('E'=>'N3 Newsletter Printing','S'=>'Boletín N3', 'F'=>"Impression du bulletin N3");
	const a_one = array('E'=>'A1 Newsletter Printing','S'=>'Boletín A1', 'F'=>"Impression du bulletin A1");
	const a_two = array('E'=>'A2 Newsletter Printing','S'=>'Boletín A2', 'F'=>"Impression du bulletin A2");
	const a_three = array('E'=>'A3 Newsletter Printing','S'=>'Boletín A3', 'F'=>"Impression du bulletin A3");
	const i_one = array('E'=>'I1 Newsletter Printing','S'=>'Boletín I1', 'F'=>"Impression du bulletin I1");
	const i_two = array('E'=>'I2 Newsletter Printing','S'=>'Boletín I2', 'F'=>"Impression du bulletin I2");
	const i_three = array('E'=>'I3 Newsletter Printing','S'=>'Boletín I3', 'F'=>"Impression du bulletin I3");
	const t_one = array('E'=>'T1 Newsletter Printing','S'=>'Boletín T1', 'F'=>"Impression du bulletin T1");
	const t_two = array('E'=>'T2 Newsletter Printing','S'=>'Boletín T2', 'F'=>"Impression du bulletin T2-T5");
	const t_three = array('E'=>'TP Newsletter Printing','S'=>'Boletín TP', 'F'=>"Impression du bulletin T6");
	const t_four = array('E'=>'TS Newsletter Printing','S'=>'Boletín TS', 'F'=>"Impression du bulletin T7");
	const top_10_wsl = array('E'=>'TOP 10 WSL Newsletter Printing','S'=>'Boletín TOP 10 WSL', 'F'=>"Impression de la newsletter TOP 10 WSL");
	const top_20_wsl = array('E'=>'TOP 20 WSL Newsletter Printing','S'=>'Boletín TOP 20 WSL', 'F'=>"Impression de la newsletter TOP 20 WSL");
	const top_10_ytd = array('E'=>'TOP 10 YTD Newsletter Printing','S'=>'Boletín TOP 10 YTD', 'F'=>"Impression de la newsletter TOP 10 YTD");
	const top_20_ytd = array('E'=>'TOP 20 YTD Newsletter Printing','S'=>'Boletín TOP 20 YTD', 'F'=>"Impression de la newsletter TOP 20 YTD");
	const order_600_plus = array('E'=>'600+ Order Newsletter Printing','S'=>'Boletín 600+ Order', 'F'=>"Plus de 600 commandes d'impression de newsletter");
	const email = array('E' => 'Email address','S'=>'Correo Electrónico', 'F'=>"Adresse e-mail");
	const cell_number = array('E'=>'Cell Phone','S'=>'Celular', 'F'=>"Téléphone portable");
	const reffered_by = array('E'=>'Referred By','S'=>'Meta Unidad', 'F'=>"Référencé par");
	const first_bill_date = array('E'=>'First Time Bill Date','S'=>'Primera Facturación', 'F'=>"Date de la première facture");
	const account_number = array('E'=>'Account Number','S'=>'Número de Cuenta', 'F'=>"Numéro de compte");
	const cu_routing = array('E'=>'Routing','S'=>'Número de Ruta', 'F'=>"Routage");
	const personal_unit_app = array('E'=>'Personal Unit App','S'=>'App de Unidad Personal', 'F'=>"Application d'unité personnelle");
	const personal_unit_app_ca = array('E'=>'Personal Unit App - Canada','S'=>'App de Unidad Personal - Canada', 'F'=>"Application d'unité personnelle - Canada");
	const personal_website = array('E'=>'Personal Website','S'=>'Sitio Electrónico Personal', 'F'=>"Site Web personnel");
	const website_link = array('E'=>'Website Link','S'=>'Link del Sitio Electrónico', 'F'=>"Lien de site Web");
	const personal_url = array('E'=>'Personal URL','S'=>'URL con Nombre Personal', 'F'=>"URL personnelle");
	const subscription_updates = array('E'=>'10 Updates on subscription','S'=>'10 Actualizaciones con la subscripción', 'F'=>"10 mises à jour sur l'abonnement");
	const app_color = array('E'=>'App custom color','S'=>'Color personalizado de la Aplicación', 'F'=>"Couleur personnalisée de l'application");	
	const mask = array('E'=>'','S'=>'Número de Cuenta', 'F'=>"Compte");

	const total_charges = array('E'=>'Total Charges: (does not include gifts for Reds program, Consistency Club gifts, Newsletter mailings, monthly promotional contests ordered ala carte,  New consultant packet postage, Last month packet postage, )','S'=>'Total Cargos: (no incluye Regalos Programa Sacos Rojos ni del Club de Consistencia; ni el envío del Boletín por correo, promociones mensuales ordenadas a la carta,  Paquete de Consultoras Nuevas y Paquete de Ultimo mes)', 'F'=>"Frais totaux: (n'inclut pas les cadeaux pour le programme Reds, les cadeaux du Consistency Club, les envois de newsletters, les concours promotionnels mensuels commandés à la carte, les frais de port du nouveau paquet de consultant, les frais de port du mois dernier,)");


	const prospect_system_L = array('E'=>'Prospect System','S'=>'Sistema Prospect', 'F'=>"");
	const free_L = array('E'=>'Free','S'=>'Gratis', 'F'=>"");
	const magic_booker_L = array('E'=>'Magic Booker System','S'=>'Sistema Magic Booker', 'F'=>"");
	const month_packet_postage=array('E'=>'Last Month Packets Postage','S'=>'13mo mes de franqueo del paquete', 'F'=>"");
	const consultant_packet_postage = array('E'=>'','S'=>'Nuevo franqueo de paquete de consultor', 'F'=>"");
	const consultant_bundles = array('E'=>'','S'=>'Nuevos paquetes de consultores', 'F'=>"");
	const consistency_gift = array('E'=>'','S'=>'Regalo de consistencia', 'F'=>"");
	const reds_program_gift = array('E'=>'','S'=>'Regalo del programa Reds', 'F'=>"");
	const stars_program_gift = array('E'=>'','S'=>'Regalo del programa de estrellas', 'F'=>"");
	const gift_wrap_postpage = array('E'=>'','S'=>'Papel de regalo y franqueo', 'F'=>"");
	const one_rate_postpage = array('E'=>'','S'=>'Franqueo de una tarifa', 'F'=>"");
	const month_blast_flyer = array('E'=>'','S'=>'Flyer de fin de mes', 'F'=>"");
	const flyer_ecard_unit = array('E'=>'','S'=>'Flyer Ecard a la unidad', 'F'=>"");
	const unit_challenge_flyer = array('E'=>'','S'=>'Unit Challenge Flyer', 'F'=>"");
	const team_building_flyer = array('E'=>'','S'=>'Team Building Flyer', 'F'=>"");
	const nl_flyer = array('E'=>'','S'=>'Diseño NL Flyer', 'F'=>"");
	const wholesale_promo_flyer = array('E'=>'','S'=>'Promoción al por mayor Flyer', 'F'=>"");
	const postcard_design = array('E'=>'','S'=>'Diseño de Flyer / Página / Postal', 'F'=>"");
	const postcard_edit = array('E'=>'','S'=>'Volante / Página / Ediciones de tarjetas postales', 'F'=>"");
	const ecard_unit = array('E'=>'','S'=>'Diseño de Flyer / Ecard a la unidad', 'F'=>"");
	const speciality_postcard = array('E'=>'','S'=>'Tarjeta postal de especialidad', 'F'=>"");
	const card_with_gift = array('E'=>'','S'=>'Tarjeta con regalo', 'F'=>"");
	const birthday_brownie = array('E'=>'','S'=>'Tarjeta de cumpleaños y Brownie', 'F'=>"");
	const birthday_starbucks = array('E'=>'','S'=>'Tarjetas de cumpleaños y Starbucks', 'F'=>"");
	const anniversary_starbucks = array('E'=>'','S'=>'Tarjeta de aniversario y Starbucks', 'F'=>"");
	const referral_credit = array('E'=>'','S'=>'Crédito de referencia', 'F'=>"");
	const special_credit = array('E'=>'','S'=>'Crédito especial', 'F'=>"");
	const cc_billing = array('E'=>'','S'=>'Consultor Comunicación facturación', 'F'=>"");
	const customer_newsletter = array('E'=>'','S'=>'Boletín del cliente', 'F'=>"");
	const birthday_postcard = array('E'=>'','S'=>'Cumpleaños Tarjetas Postales', 'F'=>"");
	const anniversary_postcard = array('E'=>'','S'=>'Anniversary Tarjetas Postales', 'F'=>"");
	const sBbValue = array('E'=>'','S'=>'Opciones de imprenta del Boletín', 'F'=>"");
	const no_email_option = array('E'=>'','S'=>'Enviar a consultoras sin Correo Electrónico', 'F'=>"");
	const override_color = array('E'=>'','S'=>'Anular estado de color (uso oficial)', 'F'=>"");
	const override_black_white = array('E'=>'','S'=>'Anular B/W ( uso oficial)', 'F'=>"");
	const english_only = array('E'=>'','S'=>'Boletín en Ingles Solamente', 'F'=>"");
	const newsletter_send_notes = array('E'=>'','S'=>'Notas de envío del Boletín', 'F'=>"");
	const newsletter_formating = array('E'=>'Newsletter Formating','S'=>'Formato del Periódico', 'F'=>"");
	const total_points = array('E'=>'Total Points','S'=>'Total Points', 'F'=>"");
	const package_for = array('E'=>'Future Package Date','S'=>'Future Package Date', 'F'=>"");
	const mail_subject = array('E'=>'Unit Assistant Service','S'=>'Unit Assistant servicio', 'F'=>"Service assistant d'unité");
	const hello = array('E'=>'Hello','S'=>'Hola', 'F'=>"Bonjour");
	const warmly = array('E'=>'Warmly','S'=>'Con cariño', 'F'=>"Chaleureusement");
 	const t_name = array('E'=>'Client Name','S'=>'Nombre de Cliente', 'F'=>"");
 	const t_number = array('E'=>'Phone Number','S'=>'Número Celular', 'F'=>"Numéro de téléphone");
 	const t_consultant = array('E'=>'Consultant ID','S'=>'Número de Consultora', 'F'=>"");
 	const t_password = array('E'=>'Password','S'=>'Contraseña', 'F'=>"");
 	const national_area = array('E'=>'National Area','S'=>'Área Nacional', 'F'=>"Zone nationale");
 	const seminar_affiliation = array('E'=>'Seminar Affiliation','S'=>'Afiliación al Seminario', 'F'=>"Affiliation au séminaire");
 	const t_account = array('E'=>'Account','S'=>'Cuenta', 'F'=>"");
 	const t_routing = array('E'=>'Routing','S'=>'Ruta', 'F'=>"");
 	const client_note = array('E'=>'Client Note','S'=>'Nota de cliente', 'F'=>"Note du client");
 	const text_note = array('E'=>'Text Note','S'=>'Nota de texto', 'F'=>"Note textuelle");
 	const text_package = array('E'=>'Text Package','S'=>'Paquete de texto', 'F'=>"Paquet de texte");
 	const cc_anniversary = array('E'=>'Anniversary','S'=>'Aniversario', 'F'=>"Anniversaire");
 	const prospect_system = array('E'=>'Prospect System','S'=>'Sistema de prospectos', 'F'=>"Système de prospect");
 	const cv_prospect = array('E'=> 'Carona Virus special prospecting', 'S'=>'Prospección especial de Carona Virus', 'F'=>'Prospection spéciale du virus Carona');
 	const prospect_system_free = array('E'=>'Prospect System Free','S'=>'Prospect System Gratis', 'F'=>"Système Prospect gratuit");
 	const cc_birthday = array('E'=>'Birthday','S'=>'Cumpleaños', 'F'=>"Date d'anniversaire");
 	const product_promotion = array('E'=>'Product Promotion','S'=>'La promocion del producto', 'F'=>"La promotion du produit");
 	const client_birthday = array('E'=>'Client Birthday','S'=>'Cumpleaños del cliente', 'F'=>"Anniversaire du client");
 	const client_birthday_note = array('E'=>'Client Birthday Notes','S'=>'Notas de Cumpleaños del Cliente', 'F'=>"Notes d'anniversaire du client");
 	const cc_month_mail = array('E'=>'Month you want to start mailing','S'=>'Mes que desea iniciar el envío', 'F'=>"Mois au cours duquel vous souhaitez commencer à envoyer des e-mails");
 	const t_bill2 = array('E'=>'Bill to 2','S'=>'Cobrar a 2', 'F'=>"");
 	const t_bill3 = array('E'=>'Bill to 3','S'=>'Cobrar a 3', 'F'=>"");
 	const mary_kay_website = array('E'=>'Mary Kay Website','S'=>'Sitio web de Mary Kay', 'F'=>"Site Web de Mary Kay");
 	const fb_link = array('E'=>'FB Link if applicable','S'=>'Enlace FB si corresponde', 'F'=>"Lien FB le cas échéant");
 	const payment_type = array('E'=>'Payment Type','S'=>'Tipo de pago', 'F'=>"Type de paiement");
 	const director_title = array('E'=>'Director Title','S'=>'Título Director', 'F'=>"Titre du réalisateur");
 	const cc_referred = array('E'=>'Who referred you?','S'=>'Quien lo refirió?', 'F'=>"Qui vous a référé?");
 	const comment = array('E'=>'Questions/Comment','S'=>'Preguntas / Comentarios', 'F'=>"Questions / Commentaire");
 	const your_name = array('E'=>'your name', 'S'=>'tu nombre', 'F'=>'votre nom');

 	const APPROVE = array('E'=>'Approve', 'S'=>'Aprobar', 'F'=>'Approuver');
 	const CHANGES = array('E'=>'Changes', 'S'=>'Cambios', 'F'=>'Changements');
 	const CHANG_NEED = array('E'=>'Changes Needed', 'S'=>'Cambios necesarios', 'F'=>'Changements nécessaires');
 	const STAFF = array('E'=>'Staff', 'S'=>'Personal', 'F'=>'Personnel');




/*define("cron_list_id", "5f5cd8e4a0");
define("cron_template_id", 10000299);

define("billing_list_id", "525317dcdb");
define("billing_template_id", 10000303);

define("UACC_billing_list_id", "2989c77e8d");
define("UACC_billing_template_id", 10000307);*/


// Live
define("mailchimp_key", '99ebd2db2f5f20496a3adbd79861bd95-us16');

define("cron_list_id", "c9055d7279");
define("cron_template_id", 10000311);

define("billing_list_id", "3cfd020cb7");
define("billing_template_id", 10000323);

define("UACC_billing_list_id", "04ff86b27d");
define("UACC_billing_template_id", 131963);
