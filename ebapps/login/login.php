<?php
namespace ebapps\login;
/*****************************************************************************
############################### GNU General Public License ###################
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
#############################################################################
*****************************************************************************/
include_once(ebbd.'/dbconfig.php');
use ebapps\dbconnection\dbconfig;
/*** ***/
include_once(ebbd.'/eBConDb.php');
use ebapps\dbconnection\eBConDb;
/*** ***/
include_once(ebphpmailer.'/Exception.php');
use ebapps\PHPMailer\Exception;
/*** ***/
include_once(ebphpmailer.'/PHPMailer.php');
use ebapps\PHPMailer\PHPMailer;
/*** ***/
include_once(ebphpmailer.'/SMTP.php');
use ebapps\PHPMailer\SMTP;

class login extends dbconfig
{
/*** for login process ***/
public function login2system($ebusername, $ebpassword)
{
$queryLogin = "SELECT ebusername, ebpassword, active, full_name, mobileactive, account_type, member_level, address_verified, omrusername FROM excessusers WHERE ebusername='$ebusername' and ebpassword='$ebpassword'";
$resultLogin = eBConDb::eBgetInstance()->eBgetConection()->query($queryLogin);

$numLoginResult = $resultLogin->num_rows;
//
if($numLoginResult == 1)
{
$userinfo = mysqli_fetch_array($resultLogin);
$this->eBUsername = $_SESSION['ebusername'] = $userinfo['ebusername'];
$this->eBPassword = $_SESSION['ebpassword'] = $userinfo['ebpassword'];
$this->eBActiveEmail = $_SESSION['activeEmail'] = $userinfo['active'];
$this->eBFullname = $_SESSION['fullname'] = $userinfo['full_name'];
$this->eBActiveMobile = $_SESSION['activeMobile'] = $userinfo['mobileactive'];
$this->eBMembertype = $_SESSION['membertype'] = $userinfo['account_type'];
$this->eBMemberlevel = $_SESSION['memberlevel'] = $userinfo['member_level'];
$this->eBAddressverified = $_SESSION['addressverified'] = $userinfo['address_verified'];
}
$resultLogin -> free_result();
}
/*** For email verification ***/
private function verifiedEmail()
{
if($_SESSION['activeEmail'] == 0)
{
include_once (ebaccess.'/access_verify_re_send.php');
exit();
}
}

/*** Full Name ***/
private function verifiedFullname()
{
if(empty($_SESSION['fullname']))
{
include_once (ebaccess.'/access_update_account_information.php');
}
}

/*** ***/
public function getsession_verify()
{
if(isset($_SESSION['ebusername']) and isset($_SESSION['ebpassword']))
{
$this->login2system(isset($_SESSION['ebusername']), isset($_SESSION['ebpassword']));
}
}
/*** ***/
public function getsession()
{
if(isset($_SESSION['ebusername']) and isset($_SESSION['ebpassword']))
{
if($_SESSION['memberlevel'] >= 1)
{
$this->verifiedEmail();
$this->login2system(isset($_SESSION['ebusername']), isset($_SESSION['ebpassword']));
}
if($_SESSION['memberlevel'] != 13)
{
if($_SESSION['memberlevel'] >= 2) 
{
/* $this->verifiedFullname(); */
$this->login2system(isset($_SESSION['ebusername']), isset($_SESSION['ebpassword']));
}
}
}
}

/*** ***/
public function retrieve($usernameemail)
{
$queryFirstForActiveUser = "SELECT ebusername, ebpassword, email, active, mobile from excessusers WHERE ebusername='$usernameemail' OR email='$usernameemail'";
$resultQueryFirstForActiveUser = eBConDb::eBgetInstance()->eBgetConection()->query($queryFirstForActiveUser);
$num_ResultQueryFirstForActiveUser = $resultQueryFirstForActiveUser->num_rows;
$activeUserinfo = mysqli_fetch_array($resultQueryFirstForActiveUser);
if ($num_ResultQueryFirstForActiveUser == 1)
{
$active= intval($activeUserinfo['active']);	
if($active == 1)
{
/////////
$mail = new PHPMailer(true);
try
{
//
$mail->isSMTP();
//$mail->$mail = SMTP::DEBUG_SERVER;
$mail->Host = smtpHost;
$mail->SMTPAuth   = true;
$mail->Username   = smtpUsername;
$mail->Password   = smtpPassword;
/* For port 587 and TLS */
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = smtpPort;
//
$mail->setFrom(adminEmail, domain);
$mail->addAddress($activeUserinfo['email']);
$mail->isHTML(true);
//$mail->addAttachment('');
//
$mail->Subject = "Retrieve your username and password";
//
$message ="<html>";
$message .="<head>";
$message .="<meta charset='utf-8'>";
$message .="<meta name='viewport' content='width=device-width, initial-scale=1'>";
$message .="<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
$message .="<style type='text/css'>
/* CLIENT-SPECIFIC STYLES */
body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
img{-ms-interpolation-mode: bicubic;}
/* RESET STYLES */
img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
table{border-collapse: collapse !important;}
body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
/* iOS BLUE LINKS */
a[x-apple-data-detectors]
{
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* MOBILE STYLES */
@media screen and (max-width: 525px)
{
/* ALLOWS FOR FLUID TABLES */
.wrapper
{
width: 100% !important;
max-width: 100% !important;
}
/* ADJUSTS LAYOUT OF LOGO IMAGE */
.logo img
{
margin: 0 auto !important;
}
/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
.mobile-hide 
{
display: none !important;
}
.img-max 
{
max-width: 100% !important;
width: 100% !important;
height: auto !important;
}
/* FULL-WIDTH TABLES */
.responsive-table
{
width: 100% !important;
}
/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
.padding
{
padding: 6px 3% 9px 3% !important;
}
.padding-meta
{
padding: 9px 3% 0px 3% !important;
text-align: center;
}
.padding-copy
{
padding: 9px 3% 9px 3% !important;
text-align: center;
}
.no-padding
{
padding: 0 !important;
}
.section-padding
{
padding: 9px 9px 9px 9px !important;
}
/* ADJUST BUTTONS ON MOBILE */
.mobile-button-container
{
margin: 0 auto;
width: 100% !important;
}
.mobile-button
{
padding: 9px !important;
border: 0 !important;
font-size: 16px !important;
display: block !important;
}
}
/* ANDROID CENTER FIX */
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>";
$message .="</head>";
$message .="<body>";
$message .="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='wrapper'>";
//
$message .="<tr>";
$message .="<td>Retrieve your username and password.</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td>Please follow the instructions below.</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td>Username: ".$activeUserinfo['ebusername']."</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td>Temporary Password: ".$activeUserinfo['ebpassword']."</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td>This is temporary login page. Please change your password with above username and password</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='".outAccessLinkFull."/accessChangePassswordTemporary.php' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>Change your password</a>";
$message .="</td>";
$message .="</tr>";
$message .="</table>";
$message .="</body>";
$message .="</html>";
//
$mail->Body = $message;
//
$mail->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
//
}
else
{
////////////////
$mail = new PHPMailer(true);
try
{
$mail->isSMTP();
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->Host = smtpHost;
$mail->SMTPAuth   = true;
$mail->Username   = smtpUsername;
$mail->Password   = smtpPassword;
/* For port 587 and TLS */
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = smtpPort;
//
$mail->setFrom(adminEmail, domain);
$mail->addAddress($activeUserinfo['email']);
$mail->isHTML(true);
//$mail->addAttachment('');
$mail->Subject = "We invite you to active your account";
//
$message ="<html>";
$message .="<head>";
$message .="<meta charset='utf-8'>";
$message .="<meta name='viewport' content='width=device-width, initial-scale=1'>";
$message .="<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
$message .="<style type='text/css'>
/* CLIENT-SPECIFIC STYLES */
body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
img{-ms-interpolation-mode: bicubic;}
/* RESET STYLES */
img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
table{border-collapse: collapse !important;}
body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
/* iOS BLUE LINKS */
a[x-apple-data-detectors]
{
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* MOBILE STYLES */
@media screen and (max-width: 525px)
{
/* ALLOWS FOR FLUID TABLES */
.wrapper
{
width: 100% !important;
max-width: 100% !important;
}
/* ADJUSTS LAYOUT OF LOGO IMAGE */
.logo img
{
margin: 0 auto !important;
}
/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
.mobile-hide 
{
display: none !important;
}
.img-max 
{
max-width: 100% !important;
width: 100% !important;
height: auto !important;
}
/* FULL-WIDTH TABLES */
.responsive-table
{
width: 100% !important;
}
/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
.padding
{
padding: 6px 3% 9px 3% !important;
}
.padding-meta
{
padding: 9px 3% 0px 3% !important;
text-align: center;
}
.padding-copy
{
padding: 9px 3% 9px 3% !important;
text-align: center;
}
.no-padding
{
padding: 0 !important;
}
.section-padding
{
padding: 9px 9px 9px 9px !important;
}
/* ADJUST BUTTONS ON MOBILE */
.mobile-button-container
{
margin: 0 auto;
width: 100% !important;
}
.mobile-button
{
padding: 9px !important;
border: 0 !important;
font-size: 16px !important;
display: block !important;
}
}
/* ANDROID CENTER FIX */
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>";
$message .="</head>";
$message .="<body>";
$message .="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='wrapper'>";
//
$message .="<tr>";
$message .="<td>We invite you to active your account</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td><br></td>";
$message .="</tr>";
$message .="<tr>";
$message .="<td>Retrieve your username and password.</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td>Please follow the instructions below.</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td>Username: ".$activeUserinfo['ebusername']."</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td>Temporary Password: ".$activeUserinfo['ebpassword']."</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td>This is temporary login page. Please change your password with above username and password</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='".outAccessLinkFull."/accessChangePassswordTemporary.php' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>Change your password</a>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
//
$mail->Body = $message;
//
$mail->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
//
}
echo "<b>Please check your eMail in Inbox or SPAM folder, We have eMailed your username and password.</b>";
/*** ***/
echo "</div></div></div></div></div>";
include_once (eblayout.'/a-common-footer.php');
exit();
}
else
{
echo "<b>Sorry, there is no user.</b>";
echo "</div></div></div></div></div>";
include_once (eblayout.'/a-common-footer.php');
exit();
}
}
/*** ***/
}
?>
