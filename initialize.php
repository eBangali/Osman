<?PHP
session_start();
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
/***************************************************************************************************************************
######################################### CHANGE OPTION STARTS  ############################################################
****************************************************************************************************************************/
/*** Database Settings ***/
const EB_HOSTNAME = "localhost";
const EB_DB_USERNAME = "YourUsername";
const EB_DB_PASSWORD = "YourPassword";
const EB_DATABASE = "YourDatabase";
/* Starts of SMTP Setting For your own domain */
/* NB: New domain required 78 hours to active smtp mailserver */
/*
const smtpHost = "";
const smtpPort = 587;
const smtpUsername = "";
const smtpPassword = "";
const adminEmail = "";
const contactEmail = "";
const alertToAdmin = "";
const adminMobile = "";
*/
/* Ends of SMTP Setting For your own domain */
/* 
Starts of SMTP Settings For Gmail and logout out from these urls 
https://security.google.com/settings/security/activity?hl=en&pli=1
https://www.google.com/settings/u/1/security/lesssecureapps
https://accounts.google.com/b/0/DisplayUnlockCaptcha
*/
/*** eMails Settings ***/
const smtpHost = "smtp.gmail.com";
const smtpPort = 587;
const smtpUsername = "YourGmailEmail";
const smtpPassword = "YourGmailPassword";
const adminEmail = "YourGmailEmail";
const contactEmail = "YourGmailEmail";
const alertToAdmin = "YourGmailEmail";
/*** Mobile Settings ***/
const adminMobile = "YourMobileNumberWithCountryCode";

/* Ends of SMTP Settings For Gmail and logout out from these urls */
/* Version */
const version = "v 22.01";
/*Salt User Password Hash*/
const salt_1= "}#f4ga~g%$%#$@!@|GK5J#~||\E6WT;IO[JN";
const salt_2= "#$%^&*$@!@-w*^%^&%&*:?#<--!<>";
//
/* Never Change Currency Setings */
define("primaryCurrency","GBP");
define("secondaryCurrency","BDT");
//
define("primaryCurrencySign","£");
define("secondaryCurrencySign","৳");
//
define("convertPrimary",1);
define("convertSecondary","13.00");
define("primaryTosecondary",floatval(convertPrimary)*floatval(convertSecondary));
/* License */
define("license", "YourLicense");
/***************************************************************************************************************************
######################################### END OF CHANGE OPTION  ############################################################
****************************************************************************************************************************/
/* The BackEnd System */
define("eb", dirname(__FILE__));
define("docRoot", $_SERVER['DOCUMENT_ROOT']);
$eBscema = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://";
define("hypertext", "$eBscema");
define("domain", "$_SERVER[HTTP_HOST]");
define("hostingName", hypertext."$_SERVER[HTTP_HOST]");
define("RootOnly", str_replace(docRoot, "", eb));
define("hostingAndRoot", hostingName.RootOnly);
define("fullUrl", hostingName."$_SERVER[REQUEST_URI]");
define("ebfromeb", eb."/ebapps/captcha");
//
define("domainForImagStore", str_replace("www.", "", parse_url(hostingName, PHP_URL_HOST)));
define("hypertextWithOrWithoutWww", str_replace(domainForImagStore, "", hostingName));
//
define("ebfromcap", hostingAndRoot."/ebapps/captcha");
define("ebbd", eb."/ebapps/dbconnection");
define("ebphpmailer", eb."/ebapps/PHPMailer");
define("ebformkeys", eb."/ebapps/formkeys");
define("ebformmail", eb."/ebapps/formmail");
define("ebHashKey", eb."/ebapps/hashpassword");
define("eblogin", eb."/ebapps/login");
define("ebsanitization", eb."/ebapps/sanitization");
define("themeSetting", eb."/ebapps/themeSetting");
define("ebimageupload", eb."/ebapps/upload");
//
define("ebfileupload", eb."/ebapps/upload");
define("ebfpdf", eb."/ebapps/fpdf");
define("ebqrcode", eb."/ebapps/qrcode");

/*################################# Default Settings ###############################################*/
/* FrontEnd */
define("ebout", eb."/out");
define("outLink", "/out");
define("outLinkFull", hostingAndRoot."/out");
/* Access */
define("ebaccess", eb."/out/access");
define("outAccessLink", "/out/access");
define("outAccessLinkFull", hostingAndRoot."/out/access");
/* Pages */
define("ebpages", eb."/out/pages");
define("outPagesLink", "/out/pages");
define("outPagesLinkFull", hostingAndRoot."/out/pages");
/* ################################ Problem Solving Blog CMS #############################################################*/
/* BacktEnd */
define("ebblog", eb."/ebapps/blog");
/* FrontEnd */
define("ebcontents", eb."/out/blog");
define("outContentsLink", "/out/blog");
define("outContentsLinkFull", hostingAndRoot."/out/blog");

/*################################# Barcode ################################################*/
define("ebBarcode", eb."/ebapps/barcode");
//
define('ebThemesActive', "LonthonAppOne");
/* For All Apps Theme Settings */
define("ebThemes", eb."/ebcontents/themes");
define("themeResource", "/ebcontents/themes/".ebThemesActive);
define("eblayout", eb."/ebcontents/themes/".ebThemesActive);
?>