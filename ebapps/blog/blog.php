<?php
namespace ebapps\blog;
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
/** **/
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
//
class blog extends dbconfig
{
/*** ***/
public function __construct()
{
parent::__construct();
include_once(ebblog.'/htaccessContentsGenerator.php');

/* ######## Video Marketing Blog ######## */
eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `blog_category` (
`contents_category_id` int(11) NOT NULL AUTO_INCREMENT,
`contents_category` varchar(64) NOT NULL,
PRIMARY KEY (`contents_category_id`),
UNIQUE KEY `contents_category` (`contents_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");


eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `blog_sub_category` (
`contents_sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
`contents_sub_category` varchar(64) NOT NULL,
`contents_category_in_blog_sub_category` varchar(64) NOT NULL,
PRIMARY KEY (`contents_sub_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `blog_subcategory_keywords` (
`cont_subcategory_keywords_id` int(11) NOT NULL AUTO_INCREMENT,
`cont_items_id_in_subcat_keywords` int(11) NOT NULL,
`cont_subcategory_keywords_value` varchar(48) NOT NULL,
`cont_tag_ebusername` varchar(64) NOT NULL,
PRIMARY KEY (`cont_subcategory_keywords_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `blog_contents` (
`contents_id` int(11) NOT NULL AUTO_INCREMENT,
`username_contents` varchar(64) NOT NULL,
`contents_approved` varchar(8) NOT NULL,
`contents_category` varchar(64) NOT NULL,
`contents_sub_category` varchar(64) NOT NULL,
`contents_og_image_url` varchar(255) NOT NULL,
`contents_og_small_image_url` varchar(255) NOT NULL,
`contents_og_image_title` varchar(160) NOT NULL,
`contents_og_image_what_to_do` longtext NOT NULL,
`contents_og_image_how_to_solve` longtext NOT NULL,
`contents_affiliate_link` varchar(255) NOT NULL,
`contents_github_link` varchar(255) NOT NULL,
`contents_preview_link` varchar(255) NOT NULL,
`contents_video_link` varchar(255) NOT NULL,
`contents_date` varchar(64) NOT NULL,
PRIMARY KEY (`contents_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `blog_comments` (
`blogs_comments_id` int(11) NOT NULL AUTO_INCREMENT,
`blogs_id_in_comments` int(11) NOT NULL,
`blogs_username` varchar(64) NOT NULL,
`blogs_comment_details` varchar(5120) NOT NULL,
`blogs_comment_date` varchar(64) NOT NULL,
`blogs_comment_status` varchar(4) NOT NULL,
PRIMARY KEY (`blogs_comments_id`),
KEY `blogs_username` (`blogs_username`),
KEY `blogs_comment_status` (`blogs_comment_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

	
eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `blog_like` (
`blog_like_id` int(11) NOT NULL AUTO_INCREMENT,
`blogs_id_in_blog_like` int(11) NOT NULL,
`blogs_username` varchar(64) NOT NULL,
`blogs_like_date` varchar(64) NOT NULL,
PRIMARY KEY (`blog_like_id`),
KEY `blogs_username` (`blogs_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `blog_category` (`contents_category_id`, `contents_category`) VALUES
(1, 'WordPress'),
(2, 'Website-Template'),
(3, 'UI-UX'),
(4, 'Graphics-Design'),
(5, 'Print-Design'),
(6, 'Web-Graphics'),
(7, 'Photoshop-Tutorial'),
(8, 'Photo-Editing'),
(9, 'Video-Editing'),
(10, 'Submit-your-Article'),
(11, 'Hobby'),
(12, 'SEO'),
(13, 'PHP'),
(14, 'SQL'),
(15, 'Sales-Leads')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `blog_sub_category` (`contents_sub_category_id`, `contents_sub_category`, `contents_category_in_blog_sub_category`) VALUES
(1, 'Blog-Magazine', 'WordPress'),
(2, 'Education', 'WordPress'),
(3, 'Entertainment', 'WordPress'),
(4, 'WooCommerce', 'WordPress'),
(5, 'Events-Booking', 'WordPress'),
(6, 'Rental-Website', 'WordPress'),
(7, 'Admin-Templates', 'Website-Template'),
(8, 'Landing-Pages', 'Website-Template'),
(9, 'Contact-Pages', 'Website-Template'),
(10, '404-Pages', 'Website-Template'),
(11, 'Search-Pages', 'Website-Template'),
(12, 'IOS-PSD-Templates', 'UI-UX'),
(13, 'Android-PSD-Template', 'UI-UX'),
(14, 'Responsive-Web-Design', 'UI-UX'),
(15, 'Background-Images', 'Graphics-Design'),
(16, 'Hero-Image', 'Graphics-Design'),
(17, 'Product-Mockup-Templates', 'Graphics-Design'),
(18, 'Brochure-Templates', 'Print-Design'),
(19, 'Business-Card-Templates', 'Print-Design'),
(20, 'Magazine-Templates', 'Print-Design'),
(21, 'Packaging-Templates', 'Print-Design'),
(22, 'Product-PSD-Mockup', 'Web-Graphics'),
(23, 'Banner-ADs', 'Web-Graphics'),
(24, 'PSD-Templates', 'Photoshop-Tutorial'),
(25, 'Clipping-path', 'Photo-Editing'),
(26, 'Color-correction', 'Photo-Editing'),
(27, 'Image-manipulation', 'Photo-Editing'),
(28, 'Image-masking', 'Photo-Editing'),
(29, 'Manequin-ghost', 'Photo-Editing'),
(30, 'Multi-clipping-path', 'Photo-Editing'),
(31, 'Neck-joint', 'Photo-Editing'),
(32, 'Photo-retouch', 'Photo-Editing'),
(33, 'Shadow', 'Photo-Editing'),
(34, 'Video-Editing-Templates', 'Video-Editing'),
(35, 'Guest-Post', 'Submit-your-Article'),
(36, 'Fashion-Design', 'Hobby'),
(37, 'Gardening', 'Hobby'),
(38, 'Cooking', 'Hobby'),
(39, 'Travelling', 'Hobby'),
(40, 'Crochet', 'Hobby'),
(41, 'Cultivate', 'Hobby'),
(42, 'Science-and-Technology', 'Hobby'),
(43, 'Photography', 'Hobby'),
(44, 'Painting', 'Hobby'),
(45, 'Exercise', 'Hobby'),
(46, 'Dance', 'Hobby'),
(47, 'Scrapbooking', 'Hobby'),
(48, 'Video-Games', 'Hobby'),
(49, 'Chess', 'Hobby'),
(50, 'Pottery', 'Hobby'),
(51, 'Archery', 'Hobby'),
(52, 'Cycling', 'Hobby'),
(53, 'Scuba-Diving', 'Hobby'),
(54, 'Baking', 'Hobby'),
(55, 'Toys', 'Hobby'),
(56, 'Embroidery', 'Hobby'),
(57, 'Calligraphy', 'Hobby'),
(58, 'Guitars', 'Hobby'),
(59, 'Football', 'Hobby'),
(60, 'Underwater-Diving', 'Hobby'),
(61, 'Football', 'Hobby'),
(62, 'Quilting', 'Hobby'),
(63, 'Parachuting', 'Hobby'),
(64, 'Singing', 'Hobby'),
(65, 'Organic-Visitor', 'SEO'),
(66, 'CMS', 'PHP'),
(67, 'Blog', 'PHP'),
(68, 'Portfolio-Website', 'PHP'),
(69, 'eCommerce-Website', 'PHP'),
(70, 'Booking-System', 'PHP'),
(71, 'Generate-Sales-Leads', 'Sales-Leads'),
(72, 'Keyword-Targeted', 'Sales-Leads'),
(73, 'Article', 'Submit-your-Article')");
}
/** **/
public function item_details($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents";
$query .= " WHERE contents_approved='OK' AND blog_contents.contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/** **/
public function contentsRelatedAllTagsMrss($cont_subcategory_keywords_value)
{
$cont_items_id_in_subcat_keywords = intval($cont_items_id_in_subcat_keywords);
$query = "SELECT * FROM blog_subcategory_keywords WHERE cont_items_id_in_subcat_keywords=$cont_items_id_in_subcat_keywords";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_blog_items_id_for_tags()
{
$query ="SELECT * FROM ";
$query .="blog_contents WHERE contents_approved='OK'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
echo "<option value='".$rows['contents_id']."'>".$this->visulString($rows['contents_id'])." ".$this->visulString($rows['contents_sub_category'])."</option>"; 
}
}
$result -> free_result();
}
/*** ***/
public function submit_blog_sub_subcategory_keywords($blog_product_or_services_id, $blog_subcategory_keywords)
{
$blog_tag_ebusername  = $_SESSION['ebusername'];
$blog_product_or_services_id = intval($blog_product_or_services_id);
$query_test = "SELECT * FROM  blog_subcategory_keywords where cont_items_id_in_subcat_keywords=$blog_product_or_services_id and cont_subcategory_keywords_value='$blog_subcategory_keywords'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;
if($num_result == 0)
{
$query = "INSERT INTO blog_subcategory_keywords set cont_items_id_in_subcat_keywords=$blog_product_or_services_id, cont_subcategory_keywords_value='$blog_subcategory_keywords', cont_tag_ebusername='$blog_tag_ebusername'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
else
{
/*** ***/
echo $this->ebNotDone();
}
$testresult -> free_result();
}
/*** ***/
public function select_contents_sub_category_for_tags($blog_product_or_services_id)
{
$blog_product_or_services_id = intval($blog_product_or_services_id);
$query ="SELECT contents_sub_category FROM";
$query .=" blog_contents where contents_id=$blog_product_or_services_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_blog_items_tags_views_pub()
{
$query = "SELECT * FROM blog_subcategory_keywords JOIN blog_contents ON blog_subcategory_keywords.cont_items_id_in_subcat_keywords = blog_contents.contents_id WHERE blog_contents.contents_approved='OK' ORDER BY blog_subcategory_keywords.cont_subcategory_keywords_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function select_blog_items_tags_views()
{
$username_poster_cont  = $_SESSION['ebusername'];
$query = "SELECT * FROM blog_subcategory_keywords JOIN blog_contents ON blog_subcategory_keywords.cont_items_id_in_subcat_keywords = blog_contents.contents_id WHERE blog_contents.contents_approved='OK' AND blog_contents.username_contents='$username_poster_cont' ORDER BY blog_subcategory_keywords.cont_subcategory_keywords_id DESC";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_implementation_video_last_for_promotion()
{
$query = "select contents_video_link, contents_sub_category FROM blog_contents WHERE contents_approved='OK' AND contents_video_link LIKE '%/%' ORDER BY contents_id DESC limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function delete_contents_query_admin($blogs_comments_id,$blogs_comment_details)
{
$blogs_comments_id = intval($blogs_comments_id);
$blogs_comment_details = $_POST['blogs_comment_details'];
$query = "DELETE FROM blog_comments";
$query .= " WHERE blogs_comments_id=$blogs_comments_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
/*** ***/
echo $this->ebDone();	
}
$result -> free_result();
}
/*** ***/
public function approve_contents_query_admin($blogs_comments_id, $blogs_id_in_comments, $blogs_comment_details)
{
$blogs_comments_id = intval($blogs_comments_id);
$blogs_id_in_comments = intval($blogs_id_in_comments);
$blogs_comment_details = $_POST['blogs_comment_details'];
$blogs_comment_details_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$blogs_comment_details);
$query = "UPDATE blog_comments SET blogs_comment_details='$blogs_comment_details_2nd', blogs_comment_status='OK'";
$query .=" WHERE blogs_comments_id=$blogs_comments_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
$queryTwo = "SELECT blogs_username FROM blog_comments WHERE blogs_comments_id=$blogs_comments_id";
$resultTwo = eBConDb::eBgetInstance()->eBgetConection()->query($queryTwo);
$resultTwoInfo = mysqli_fetch_array($resultTwo);
$blogs_username = $resultTwoInfo['blogs_username'];
/*** ***/
$queryThree = "SELECT email FROM excessusers WHERE ebusername='$blogs_username'";
$resultThree = eBConDb::eBgetInstance()->eBgetConection()->query($queryThree);
$resultThreeInfo = mysqli_fetch_array($resultThree);
$blog_comment_email = $resultThreeInfo['email'];
/*###################*/
/*** ***/
$mailReply = new PHPMailer(true);
try
{
//
$mailReply->isSMTP();
//$mailReply->SMTPDebug = SMTP::DEBUG_SERVER;
$mailReply->Host = smtpHost;
$mailReply->SMTPAuth   = true;
$mailReply->Username   = smtpUsername;
$mailReply->Password   = smtpPassword;
/* For port 587 and TLS */
$mailReply->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mailReply->Port = smtpPort;
//
$mailReply->setFrom(adminEmail, domain);
$mailReply->addAddress($blog_comment_email);
$mailReply->isHTML(true);
//$mailReply->addAttachment('');
$mailReply->Subject = "Your comment approved";
//
$message ="<html>";
$message .="<head>";
$message .="<title>Your comment approved</title>";
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
$message .="<td>Hi, $blogs_username your comment approved</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outContentsLinkFull."/contents/details/$blogs_id_in_comments/";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>View</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
//
$mailReply->Body = $message;

$mailReply->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$mailReply->ErrorInfo}";
}
/*###################*/
$this->massMailSendForBlogComment($blogs_username, $blogs_id_in_comments);
}
/*
#####################
Blog Mass eMail for Comments
#####################
*/
public function massMailForBlogComment($blogs_id_in_comments)
{
/*** eMail to Users ***/
$queryCheckForEmail = "SELECT email FROM excessusers";
$queryCheckForEmail .= " JOIN blog_comments ON blog_comments.blogs_username=excessusers.ebusername";
$queryCheckForEmail .= " WHERE blog_comments.blogs_id_in_comments=$blogs_id_in_comments AND blog_comments.blogs_comment_status='OK'";
$resultCheckForEmail = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheckForEmail);
if($resultCheckForEmail)
{
while($rows = $resultCheckForEmail->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$resultCheckForEmail -> free_result();
}
//
public function massMailSendForBlogComment($blogs_username, $blogs_id_in_comments)
{
/*** eMail to Users ***/
$arr_email = $this->massMailForBlogComment($blogs_id_in_comments);
if( $arr_email >= 1)
{
foreach($arr_email as $val): extract($val);
$iTo[]=$email;
endforeach;
}
//
$subject = $blogs_username." also comment where you comment";

$message ="<html>";
$message .="<head>";
$message .="<title>$subject</title>";
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
$message .="<td>Hi, $subject</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outContentsLinkFull."/contents/details/$blogs_id_in_comments/";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>View the comment</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
//
for($i =0; $i<=count($iTo)-1; $i++)
{
/*###################*/
/*** ***/
$massMail = new PHPMailer(true);
try
{
//
$massMail->isSMTP();
//$massMail->SMTPDebug = SMTP::DEBUG_SERVER;
$massMail->Host = smtpHost;
$massMail->SMTPAuth   = true;
$massMail->Username   = smtpUsername;
$massMail->Password   = smtpPassword;
/* For port 587 and TLS */
$massMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$massMail->Port = smtpPort;
//
$massMail->setFrom(adminEmail, domain);
$massMail->addAddress($iTo[$i]);
$massMail->isHTML(true);
//$massMail->addAttachment('');
$massMail->Subject = $subject;
//
$massMail->Body = $message;

$massMail->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$massMail->ErrorInfo}";
}
/*###################*/
}
}
/*** ***/
public function read_all_contents_query_admin()
{
$query = "SELECT * FROM";
$query .= " blog_comments";
$query .= " where blogs_comment_status='NO' order by blogs_comments_id desc";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function submit_contents_query_mini_merchant($blogs_id_in_comments,$blogs_comment_details)
{
$contents_id = intval($blogs_id_in_comments);
$blogs_id_in_comments = intval($blogs_id_in_comments);
$blogs_username = $_SESSION['ebusername'];
$blogs_comment_date = date("r");

$blogs_comment_details = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$blogs_comment_details);

eBConDb::eBgetInstance()->eBgetConection()->query("insert into blog_comments set blogs_id_in_comments=$blogs_id_in_comments, blogs_username='$blogs_username', blogs_comment_details='$blogs_comment_details', blogs_comment_date='$blogs_comment_date', blogs_comment_status='OK'");
/*** ***/
$this->massMailSendForBlogOpinion($contents_id);
}
/*** ***/
public function submit_contents_query_visitor($blogs_id_in_comments,$blogs_comment_details)
{
$blogs_id_in_comments = intval($blogs_id_in_comments);
$blogs_comment_date = date("r");
$blogs_username = $_SESSION['ebusername'];
$blogs_comment_details = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$blogs_comment_details);

eBConDb::eBgetInstance()->eBgetConection()->query("insert into blog_comments set blogs_id_in_comments=$blogs_id_in_comments, blogs_username='$blogs_username', blogs_comment_details='$blogs_comment_details', blogs_comment_date='$blogs_comment_date', blogs_comment_status='NO'");
/*** ***/
$queryThree = "SELECT email FROM excessusers WHERE ebusername='$blogs_username'";
$resultThree = eBConDb::eBgetInstance()->eBgetConection()->query($queryThree);
$resultThreeInfo = mysqli_fetch_array($resultThree);
$blog_comment_email = $resultThreeInfo['email'];

/*** ***/
$from = $blog_comment_email;
/*** ***/
$subject = "$blogs_username left a comment";
/*** ***/
$message ="<html>";
$message .="<head>";
$message .="<title>$blogs_username left a comment</title>";
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
$message .="<td>$blogs_username left a comment on $blogs_comment_date</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outContentsLinkFull."/contents-approve-query.php";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>Review the comment</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
/*** ***/
/*###################*/
/*** ***/
$massMail = new PHPMailer(true);
try
{
//
$massMail->isSMTP();
//$massMail->SMTPDebug = SMTP::DEBUG_SERVER;
$massMail->Host = smtpHost;
$massMail->SMTPAuth   = true;
$massMail->Username   = smtpUsername;
$massMail->Password   = smtpPassword;
/* For port 587 and TLS */
$massMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$massMail->Port = smtpPort;
//
$massMail->setFrom(adminEmail, domain);
$massMail->addAddress(adminEmail);
$massMail->isHTML(true);
//$massMail->addAttachment('');
$massMail->Subject = $subject;
//
$massMail->Body = $message;

$massMail->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$massMail->ErrorInfo}";
}
/*###################*/
/*** ***/
}
/*** ***/
/*** ***/
public function read_contents_query_to_submit_another_one($articleno)
{
$items_id = intval($articleno);
$query = "SELECT * FROM";
$query .= " blog_comments";
$query .= " where blogs_id_in_comments=$items_id order by blogs_comments_id desc LIMIT 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function count_total_like($articleno)
{
$blogs_id_in_like = intval($articleno);
$query = "SELECT COUNT(blogs_id_in_blog_like) as totalPostLikes FROM ";
$query .="blog_like ";
$query .="where blogs_id_in_blog_like=$blogs_id_in_like";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function add_for_like($contents_id_for_like)
{
if(isset($_REQUEST['add_for_like']))
{
extract($_REQUEST);
$contents_id_for_like = intval($_POST["contents_id_for_like"]);
$usernameLiker = $_SESSION["ebusername"];
$blogs_like_date = date("r");

$queryCheck = "SELECT * FROM blog_like WHERE blogs_id_in_blog_like=$contents_id_for_like AND blogs_username='$usernameLiker'";
$resultCheck = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheck);
$num_result = $resultCheck->num_rows;

if($num_result == 0)
{
$query = "INSERT INTO blog_like SET blogs_id_in_blog_like=$contents_id_for_like, blogs_username='$usernameLiker', blogs_like_date='$blogs_like_date'";
$entryResult = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$this->massMailForBlogLike($usernameLiker, $contents_id_for_like);
}

}
$resultCheck -> free_result();
}
/*
#####################
Blog Mass eMail Like
#####################
*/
public function massMailForBlog($contents_id_for_like)
{
/*** eMail to Users ***/
$queryCheckForEmail = "SELECT email FROM excessusers";
$queryCheckForEmail .= " JOIN blog_like ON blog_like.blogs_username=excessusers.ebusername";
$queryCheckForEmail .= " WHERE blog_like.blogs_id_in_blog_like=$contents_id_for_like";
$resultCheckForEmail = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheckForEmail);
if($resultCheckForEmail)
{
while($rows = $resultCheckForEmail->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$resultCheckForEmail -> free_result();
}
//
public function massMailForBlogLike($usernameLiker, $contents_id_for_like)
{
/*** eMail to Users ***/
$arr_email = $this->massMailForBlog($contents_id_for_like);
if( $arr_email >= 1){
foreach($arr_email as $val): extract($val);
$iTo[]=$email;
endforeach;
}
$subject = $usernameLiker." also like";
$message ="<html>";
$message .="<head>";
$message .="<title>$subject</title>";
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
$message .="<td>Hi, $subject</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outContentsLinkFull."/contents/details/$contents_id_for_like/";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>View the link</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
//
for($i =0; $i<=count($iTo)-1; $i++)
{
/*###################*/
/*** ***/
$massMail = new PHPMailer(true);
try
{
//
$massMail->isSMTP();
//$massMail->SMTPDebug = SMTP::DEBUG_SERVER;
$massMail->Host = smtpHost;
$massMail->SMTPAuth   = true;
$massMail->Username   = smtpUsername;
$massMail->Password   = smtpPassword;
/* For port 587 and TLS */
$massMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$massMail->Port = smtpPort;
//
$massMail->setFrom(adminEmail, domain);
$massMail->addAddress($iTo[$i]);
$massMail->isHTML(true);
//$massMail->addAttachment('');
$massMail->Subject = $subject;
//
$massMail->Body = $message;

$massMail->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$massMail->ErrorInfo}";
}
/*###################*/
}
}
/*** ***/
public function count_like_now($articleno)
{
$like_username = isset($_SESSION['ebusername']);
$blogs_id_in_like = intval($articleno);
$query = "SELECT COUNT(blogs_id_in_blog_like) AS likeNow FROM ";
$query .="blog_like ";
$query .="WHERE blogs_id_in_blog_like=$blogs_id_in_like AND blogs_username='$like_username'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
	
/*** ***/
public function count_total_contents($articleno)
{
$blogs_id_in_comments = intval($articleno);
$query ="SELECT COUNT(blogs_id_in_comments) as totalPostComments FROM ";
$query .="blog_comments ";
$query .="where blogs_id_in_comments=$blogs_id_in_comments and blogs_comment_status='OK' order by blogs_comments_id desc";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}


/*** ***/
public function read_all_contents_query($articleno)
{
$blogs_id_in_comments = intval($articleno);
$query = "SELECT * FROM";
$query .= " blog_comments";
$query .= " where blogs_id_in_comments=$blogs_id_in_comments and blogs_comment_status='OK' order by blogs_comments_id desc";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function edit_update_contents_item($contents_id,$username_contents,$contents_approved,$contents_category,$contents_sub_category,$contents_og_image_title,$contents_og_image_what_to_do,$contents_og_image_how_to_solve,$contents_affiliate_link, $contents_github_link,$contents_preview_link,$contents_video_link)
{
$contents_id = intval($contents_id);
$contents_approved = intval($contents_approved);
$contents_og_image_what_to_do_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$contents_og_image_what_to_do);
$contents_og_image_how_to_solve_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$contents_og_image_how_to_solve);

$query = "SELECT * FROM  blog_contents WHERE contents_id=$contents_id AND username_contents='$username_contents'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $testresult->num_rows;
/*** ***/
if($num_result == 1)
{
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel'] <= 9)
{
if(!empty($contents_approved))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_approved='GPOST' where contents_id=$contents_id and username_contents='$username_contents'");
}
}
else
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_approved='NO' where contents_id=$contents_id and username_contents='$username_contents'");
}
}
/*** ***/
if(!empty($contents_category))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_category='$contents_category' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(!empty($contents_sub_category))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_sub_category='$contents_sub_category' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(!empty($contents_og_image_title))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_og_image_title='$contents_og_image_title' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(isset($contents_og_image_what_to_do))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_og_image_what_to_do='$contents_og_image_what_to_do_2nd' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(isset($contents_og_image_how_to_solve))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_og_image_how_to_solve='$contents_og_image_how_to_solve_2nd' where contents_id=$contents_id and username_contents='$username_contents'");
}

/*** ***/
if(!empty($contents_affiliate_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_affiliate_link='$contents_affiliate_link' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(!empty($contents_github_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_github_link='$contents_github_link' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(empty($contents_github_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_github_link='$contents_github_link' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(!empty($contents_preview_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_preview_link='$contents_preview_link' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(empty($contents_preview_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_preview_link='$contents_preview_link' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(!empty($contents_video_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_video_link='$contents_video_link' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
if(empty($contents_video_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update blog_contents set contents_video_link='$contents_video_link' where contents_id=$contents_id and username_contents='$username_contents'");
}
/*** ***/
echo $this->ebDone();
}
$testresult -> free_result();
}
/*** ***/
public function edit_select_contents_category(){
$query = "SELECT * FROM ";
$query .= "blog_category";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function edit_select_contents_item()
{
if(isset($_GET['contents_id'])){ $contents_id = intval($_GET['contents_id']);}
if(isset($_GET['username_contents'])){ $username_contents = $_GET['username_contents'];}

$query = "SELECT * FROM blog_contents";
$query .= " WHERE contents_id =$contents_id and username_contents ='$username_contents'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function menu_sub_category_contents($cat)
{
$query = "SELECT * FROM blog_contents WHERE contents_category='$cat' AND contents_id IN (SELECT MAX(contents_id) FROM blog_contents WHERE contents_approved='OK' GROUP BY contents_sub_category) ORDER BY contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function menu_category_contents()
{
$query = "SELECT * FROM blog_contents WHERE contents_id IN (SELECT MAX(contents_id) FROM blog_contents WHERE contents_approved='OK' GROUP BY contents_category) ORDER BY contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function search_in_contents()
{
/* Read to Edit */
if(isset($_REQUEST['search_contents']))
{
extract($_REQUEST);
$query = "SELECT * FROM blog_contents where blog_contents.contents_approved=1 AND blog_contents.contents_og_image_title LIKE '%".$_REQUEST['search_contents']."%'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function submit_contents_sub_category($contentCategory, $contentsSub_category)
{
$query_test = "SELECT * FROM  blog_sub_category WHERE contents_sub_category='$contentsSub_category' AND contents_category_in_blog_sub_category='$contentCategory'";

$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;

if($num_result == 0)
{
$query = "INSERT INTO blog_sub_category SET contents_sub_category='$contentsSub_category', contents_category_in_blog_sub_category='$contentCategory'";
$entryResult = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
if($entryResult)
{
/*** ***/
echo $this->ebDone();
}
else
{
/*** ***/
echo $this->ebNotDone();
}
}
else
{
/*** ***/
echo $this->ebNotDone();
}
$testresult -> free_result();
}
/*** ***/
public function submit_contents_category($contents_category)
{
/*OK*/
$query_test = "SELECT * FROM  blog_category where contents_category='$contents_category'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;
if($num_result == 0)
{
$query = "INSERT INTO blog_category set contents_category='$contents_category'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
else 
{
/*** ***/
echo $this->ebNotDone();
}
$testresult -> free_result();
}
/*** ***/
public function select_contents_category(){
$query = "SELECT * FROM";
$query .= " blog_category";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows=$result->fetch_array())
{
echo "<option value='".$rows['contents_category']."'>".$this->visulString($rows['contents_category'])."</option>"; 
}
}
$result -> free_result();
}

/*** ***/
public function submit_new_contents_item($contents_category, $contents_sub_category, $contents_og_image_title, $contents_og_image_what_to_do, $contents_og_image_how_to_solve, $contents_affiliate_link, $contents_github_link, $contents_preview_link, $contents_video_link)
{
$username = $_SESSION['ebusername'];
$contents_date = date("r");

$contents_og_image_what_to_do_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$contents_og_image_what_to_do);
$contents_og_image_how_to_solve_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$contents_og_image_how_to_solve);
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel'] <= 9)
{
$query1 = "INSERT INTO blog_contents set username_contents='$username', contents_approved='GPOST', contents_category='$contents_category', contents_sub_category='$contents_sub_category',contents_og_image_url='',contents_og_small_image_url='',contents_og_image_title='$contents_og_image_title', contents_og_image_what_to_do='$contents_og_image_what_to_do_2nd', contents_og_image_how_to_solve='$contents_og_image_how_to_solve_2nd', contents_affiliate_link='$contents_affiliate_link', contents_github_link='$contents_github_link', contents_preview_link='$contents_preview_link', contents_video_link='$contents_video_link', contents_date='$contents_date'";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);
$blogs_id = eBConDb::eBgetInstance()->eBgetConection()->insert_id;
/* #### First entry for Comments #### */
$query2 = "INSERT INTO blog_comments SET blogs_id_in_comments=$blogs_id, blogs_username='$username', blogs_comment_details='Any Query?', blogs_comment_date='$contents_date', blogs_comment_status='OK'";
$result2 = eBConDb::eBgetInstance()->eBgetConection()->query($query2);
/*** ***/
if($result2)
{
/*** ***/
echo $this->ebDone();
}
}
else
{
$query1 = "INSERT INTO blog_contents set username_contents='$username', contents_approved='NO', contents_category='$contents_category', contents_sub_category='$contents_sub_category',contents_og_image_url='',contents_og_small_image_url='',contents_og_image_title='$contents_og_image_title', contents_og_image_what_to_do='$contents_og_image_what_to_do_2nd', contents_og_image_how_to_solve='$contents_og_image_how_to_solve_2nd', contents_affiliate_link='$contents_affiliate_link', contents_github_link='$contents_github_link', contents_preview_link='$contents_preview_link', contents_video_link='$contents_video_link', contents_date='$contents_date'";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);
$blogs_id = eBConDb::eBgetInstance()->eBgetConection()->insert_id;
/* #### First entry for Comments #### */
$query2 = "INSERT INTO blog_comments SET blogs_id_in_comments=$blogs_id, blogs_username='$username', blogs_comment_details='Any Query?', blogs_comment_date='$contents_date', blogs_comment_status='OK'";
$result2 = eBConDb::eBgetInstance()->eBgetConection()->query($query2);
/*** ***/
if($result2)
{
/*** ***/
echo $this->ebDone();
}
}
}
}
/*** ***/
public function contents_view_items()
{
$username = $_SESSION['ebusername'];
$query = "SELECT * FROM ";
$query .= "blog_contents ";
$query .= "WHERE contents_approved !='DELETED' AND blog_contents.username_contents='$username' ORDER BY contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function updates_contents_image_url($contents_id,$contents_og_image_url)
{
/* Do not use target='_blank', it will not remove the image */
$contents_id = intval($contents_id);
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel'] <= 9)
{
$query = "update blog_contents set contents_approved='GPOST', contents_og_image_url='$contents_og_image_url' where contents_id=$contents_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
}
else
{
$query = "update blog_contents set contents_approved='NO', contents_og_image_url='$contents_og_image_url' where contents_id=$contents_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
}
}
if($result)
{
/*** ***/
echo $this->ebDone();
?>
<script>
window.location.replace('contents-items-status.php');
</script>
<?php
}
}
/*** ***/
public function updates_contents_small_image_url($contents_id,$contents_og_small_image_url)
{
/* Do not use target='_blank', it will not remove the image */
$contents_id = intval($contents_id);
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel'] <= 9)
{
$query = "update blog_contents set contents_approved='GPOST', contents_og_small_image_url='$contents_og_small_image_url' where contents_id=$contents_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
}
else
{
$query = "update blog_contents set contents_approved='NO', contents_og_small_image_url='$contents_og_small_image_url' where contents_id=$contents_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
}
}
}
/*** ***/
public function select_image_from_contents()
{
/* Read to Edit */
if(isset($_REQUEST['upload_image']))
{
extract($_REQUEST);
$contents_id = intval($contents_id);
$query  = "SELECT * FROM ";
$query .= "blog_contents  ";
$query .= "WHERE blog_contents.contents_id=$contents_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
/* admin contents view */
public function admin_contents_view_items()
{
$query = "SELECT * FROM ";
$query .= "blog_contents where contents_approved='NO' ORDER BY blog_contents.contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function approve_contents_items($contents_id)
{
/*** ***/
$contents_id = intval($contents_id);
$contents_approved ="OK";
/* update bay_merchant_add_items */
$update_contents_add_items = "UPDATE blog_contents SET contents_approved='$contents_approved' WHERE contents_id=$contents_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($update_contents_add_items);
//
/* ### Mamory Problem ### */
$this->massMailSendForBlogOpinion($contents_id);
}
/*
#####################
Blog Mass eMail for Update Post
#####################
*/
public function massMailForBlogUpdatedPost()
{
$query = "SELECT email FROM excessusers WHERE active=1 AND account_type='public'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*
#####################
Blog Mass eMail for COMMENT/ OPINION
#####################
*/
public function massMailForBlogOpinion()
{
/*** eMail to Users ***/
$queryCheckForEmail = "SELECT email, emailhash, omrusername FROM excessusers WHERE active=1 AND account_type='invited'";
$resultCheckForEmail = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheckForEmail);
if($resultCheckForEmail)
{
while($rows = $resultCheckForEmail->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$resultCheckForEmail -> free_result();
}
//
public function massMailSendForBlogOpinion($contents_id)
{
/*** eMail to Users ***/
$arr_email = $this->massMailForBlogOpinion();
if( $arr_email >= 1)
{
foreach($arr_email as $val): extract($val);
$iTo[]=$email;
$iemailhash[] = $emailhash;
$iOmrusername[] = $omrusername;
endforeach;

/*** ***/
for($i =0; $i<=count($iTo)-1; $i++)
{
$subject = $iOmrusername[$i]." invite you to submit your Opinion";
/*** ***/
$message ="<html>";
$message .="<head>";
$message .="<title>$subject</title>";
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
$message .="<td bgcolor='#014693'>";
$message .="<p style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; color: #ffffff; display: block;'>";
$message .=" ".$iOmrusername[$i]." invite you to submit your Opinion to the comment section<br>";
$message .="</p>";
$message .="</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td bgcolor='#014693'>";
$message .="<a href='";
$message .=outContentsLinkFull."/contents/details/$contents_id/";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; color: #ffffff; display: block;'>";
$message .=" Submit your Opinion";
$message .="</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td bgcolor='#014693'>";
$message .="<p style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; color: #ffffff; display: block;'>";
$message .=" Or";
$message .="</p>";
$message .="</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td bgcolor='#014693'>";
$message .="<a href='";
$message .=outAccessLink."/signupByInvite.php?email=$iTo[$i]";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; color: #ffffff; display: block;'>";
$message .=" Sign up with us";
$message .="</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td bgcolor='#014693'>";
$message .="<p style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; color: #ffffff; display: block;'>  Sincerely Thanks</p>";
$message .="<br>";

$message .="<br>";
$message .="<br>";
$message .="<br>";
$message .="</td>";
$message .="</tr>";
//
$message .="<tr>";
$message .="<td bgcolor='#014693'>";
$message .="<a href='";
$message .=outAccessLink."/unsubscribe.php?email=$iTo[$i]&emailhash=$iemailhash[$i]";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; color: #ffffff; display: block;'>";
$message .=" Please unsubscribe if you do not like us";
$message .="</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
/*###################*/
/*** ***/
$massMail = new PHPMailer(true);
try
{
//
$massMail->isSMTP();
//$massMail->SMTPDebug = SMTP::DEBUG_SERVER;
$massMail->Host = smtpHost;
$massMail->SMTPAuth   = true;
$massMail->Username   = smtpUsername;
$massMail->Password   = smtpPassword;
/* For port 587 and TLS */
$massMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$massMail->Port = smtpPort;
//
$massMail->setFrom(adminEmail, domain);
$massMail->addAddress($iTo[$i]);
$massMail->isHTML(true);
//$massMail->addAttachment('');
$massMail->Subject = $subject;
//
$massMail->Body = $message;

$massMail->send();
}
catch (Exception $e)
{
echo "Message could not be sent. Mailer Error: {$massMail->ErrorInfo}";
}
/*###################*/
}
}

}
/*** ***/
public function notSercicesApproved($contents_id, $contents_og_image_url) 
{
$contents_id = intval($contents_id);
$contents_og_image_url = str_replace(hostingName, docRoot, hypertext.$contents_og_image_url);
if(!empty($contents_og_image_url))
{
unlink($contents_og_image_url);
}
$query1 = "UPDATE blog_contents SET contents_approved='NO', contents_og_image_url='', contents_og_small_image_url='' where contents_id=$contents_id";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);
$result1 = eBConDb::eBgetInstance()->eBgetConection()->query($query1);
if($result1)
{
/*** ***/
echo $this->ebDone();
}
}

/*** ***/
public function notSercicesApproved_small($contents_id, $contents_og_small_image_url) 
{
$contents_og_small_image_url = str_replace(hostingName, docRoot, hypertext.$contents_og_small_image_url);
if(!empty($contents_og_small_image_url))
{
unlink($contents_og_small_image_url); 
}
}
/*** ***/
public function delete_contents_items($contents_id, $contents_og_image_url) 
{
$contents_id = intval($contents_id);
/*** you'll have to use the path on your server to delete the image, not the url. ***/ 
$contents_image_path = str_replace(hostingName, docRoot, hypertext.$contents_og_image_url);
if(!empty($contents_image_path))
{
unlink($contents_image_path);
}
$query = "UPDATE blog_contents SET contents_approved='DELETED', contents_og_image_url='', contents_og_small_image_url='' WHERE contents_id=$contents_id";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);

$blogs_username = $_SESSION['ebusername'];
$queryDelete = "DELETE * FROM blog_contents WHERE blogs_username='$blogs_username' AND blogs_id_in_comments=$contents_id";
$resultDelete = eBConDb::eBgetInstance()->eBgetConection()->query($queryDelete);
/*** ***/
echo $this->ebDone();
}
/*** ***/
public function delete_contents_small_items($contents_id, $contents_og_small_image_url) 
{
$contents_id = intval($contents_id);
/*** you'll have to use the path on your server to delete the image, not the url. ***/ 
$contents_small_image_path = str_replace(hostingName, docRoot, hypertext.$contents_og_small_image_url);
if(!empty($contents_small_image_path))
{
unlink($contents_small_image_path);
}
}
//
public function read_contents_items_download_link_to_edit()
{
/* Read to Edit */
if(isset($_REQUEST['contents_github_link']))
{
extract($_REQUEST);
$contents_id = intval($_REQUEST['contents_id']);
$query = "SELECT * FROM ";
$query .= "blog_contents  ";
$query .= "where contents_id=$contents_id ";
$query .= "limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function update_contents_download_link($contents_id, $contents_github_link)
{
$contents_id = intval($contents_id);
$query = "update blog_contents set contents_approved='NO', contents_github_link='$contents_github_link' where contents_id=$contents_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
$result -> free_result();
}
/*** ***/
public function read_contents_items_video_link_to_edit()
{
/* Read to Edit */
if(isset($_REQUEST['contents_video_link']))
{
extract($_REQUEST);
$contents_id = intval($_REQUEST['contents_id']);
$query = "SELECT * FROM ";
$query .= "blog_contents  ";
$query .= "where contents_id=$contents_id ";
$query .= "limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function read_contents_items_preview_link_to_edit()
{
/* Read to Edit */
if(isset($_REQUEST['contents_preview_link']))
{
extract($_REQUEST);
$contents_id = intval($_REQUEST['contents_id']);
$query = "SELECT * FROM ";
$query .= "blog_contents  ";
$query .= "where contents_id=$contents_id ";
$query .= "limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
}
/*** ***/
public function update_contents_video_link($contents_id, $contents_video_link)
{
$contents_id = intval($contents_id);
$query = "update blog_contents set contents_approved='NO', contents_video_link='$contents_video_link' where contents_id=$contents_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
$result -> free_result();
}

/*** ***/
public function update_contents_preview_link($contents_id, $contents_preview_link)
{
$contents_id = intval($contents_id);
$query = "update blog_contents set contents_approved='NO', contents_preview_link='$contents_preview_link' where contents_id=$contents_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
$result -> free_result();
}
/*** ***/
public function blogs_curl()
{
$c = curl_init();
curl_setopt($c, CURLOPT_URL, "https://ebangali.com/out/soft/licensekey.php");
curl_setopt($c, CURLOPT_TIMEOUT, 30);
curl_setopt($c, CURLOPT_POST, 1);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
$postfileds = 'server='.domain.'&license='.license;
curl_setopt($c, CURLOPT_POSTFIELDS, $postfileds);
$result = curl_exec($c);
if($result == "fail")
{
/*Do Nothing*/
}	
}
/*** ***/
public function blog_control()
{
//
$this->eb_blog();
/*
$this->blogs_curl();
*/
}
/*** ***/
private function eb_blog()
{
/* */
if(isset($_GET['articleno']))
{
$articleno = intval($_GET['articleno']);
$contentsGuestPost = $this->item_details_guest_post($articleno);
$postApproveType = $contentsGuestPost['contents_approved'];
}
/* */
if(isset($_GET['keywordblog']))
{
$keywordblog = intval($_GET['keywordblog']);
$blogKeyWord = $this->item_keyword_blog($keywordblog);
$contentsKeyword = $blogKeyWord['cont_subcategory_keywords_value'];
}

/* */
if(isset($_GET['username_contents']))
{
$articlewriter = $_GET['username_contents'];
$contentsDetails = $this->item_details_articlewriter($articlewriter);
$contentsbloggroup = $contentsDetails['username_contents'];
}
/* controling cart */
$view = empty($_GET['view']) ? 'index' : $_GET['view'];
$controller = 'shop';
/* switch to which view */
switch ($view)
{
case "index":
/**/	
break;
/**/
case "category":
/**/
break;
/**/
case "subcategory":
/**/
break;
/**/
case "writer":
/**/
break;
/**/
case "details":
/**/
break;
/**/
case "solve":
/**/
break;
/**/
case "tags":
/**/
break;
/**/
}
include (ebcontents.'/views/layouts/'.$controller.'.php');
}

/*** ***/
public function contents_carousel_all()
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' and contents_og_image_url!='' ORDER BY blog_contents.contents_id DESC LIMIT 15";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_video()
{
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel'] <= 9)
{
$query = "SELECT contents_category, contents_sub_category, contents_video_link from blog_contents WHERE contents_category IN (SELECT contents_category FROM blog_contents WHERE contents_approved='GPOST' GROUP BY contents_category) ORDER BY contents_id DESC LIMIT 4";
}
else
{
$query = "SELECT contents_category, contents_sub_category, contents_video_link from blog_contents WHERE contents_category IN (SELECT contents_category FROM blog_contents WHERE contents_approved='OK' GROUP BY contents_category) ORDER BY contents_id DESC LIMIT 4";
}
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
}
}

/*** ***/
public function contentsForeCommerce()
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' ORDER BY contents_id DESC LIMIT 3";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/** **/
public function rightBarAllCategory()
{
/* Read newest post from each category */
$query = "SELECT * FROM blog_contents WHERE contents_id IN (SELECT MAX(contents_id) FROM blog_contents WHERE contents_approved='OK' GROUP BY contents_category) ORDER BY contents_id DESC LIMIT 5";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/** **/
public function rightBarAllCategoryPost($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' AND contents_id !=$articleno ORDER BY contents_id DESC LIMIT 5";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/** **/
public function rightBarAll()
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' ORDER BY contents_id DESC LIMIT 9";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/* */
public function guestContentsLikeAll()
{
$userForBlog = $_SESSION['ebusername'];
$queryLike ="SELECT * FROM blog_contents ";
$queryLike .="JOIN blog_like ON blog_contents.contents_id = blog_like.blogs_id_in_blog_like ";
$queryLike .="WHERE blog_contents.contents_approved='GPOST' AND blog_like.blogs_username='$userForBlog' ORDER BY blog_contents.contents_id DESC";		 
$result = eBConDb::eBgetInstance()->eBgetConection()->query($queryLike);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/* */
public function contentsLikeAll()
{
$userForBlog = $_SESSION['ebusername'];
$queryLike ="SELECT * FROM blog_contents ";
$queryLike .="JOIN blog_like ON blog_contents.contents_id = blog_like.blogs_id_in_blog_like ";
$queryLike .="WHERE blog_contents.contents_approved='OK' AND blog_like.blogs_username='$userForBlog' ORDER BY blog_contents.contents_id DESC";		 
$result = eBConDb::eBgetInstance()->eBgetConection()->query($queryLike);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/** GUEST POST PAGINATION **/
public function guestPostContentsPostAll()
{
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;

$per_page = 10; 

$startpoint = ($page * $per_page) - $per_page;
//
$statement = "blog_contents WHERE contents_approved='GPOST' ORDER BY contents_id DESC"; 

$query = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_page}";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/** GUEST POST PAGINATION  **/
public function guestPostContentsPagination()
{
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;

$per_page = 10; 

$startpoint = ($page * $per_page) - $per_page;

$url='?';

$statement = "blog_contents WHERE contents_approved='GPOST' ORDER BY contents_id DESC"; 

$query = "SELECT COUNT(*) as `num` FROM {$statement}";
$row = mysqli_fetch_array(mysqli_query(eBConDb::eBgetInstance()->eBgetConection(),$query));

$total = $row['num'];
$adjacents = "2"; 

$prevlabel = "&lsaquo; Prev";
$nextlabel = "Next &rsaquo;";
$lastlabel = "Last &rsaquo;&rsaquo;";

$page = ($page == 0 ? 1 : $page);  
$start = ($page - 1) * $per_page;

$prev = $page - 1;
$next = $page + 1;

$lastpage = ceil($total/$per_page);

$lpm1 = $lastpage - 1;

$pagination = "<div class='pager'>";
$pagination .= "<div class='pages'>";
if($lastpage > 1)
{   
$pagination .= "<ul class='pagination'>";
//$pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";

if ($page > 1)
$pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";

if ($lastpage < 7 + ($adjacents * 2)){   
for ($counter = 1; $counter <= $lastpage; $counter++){
if ($counter == $page)
$pagination.= "<li class='active'><a>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}

} elseif($lastpage > 1 + ($adjacents * 2)){

if($page < 1 + ($adjacents * 2)) {

for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>...</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  

} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>...</li>";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>..</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      

} else {

$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>..</li>";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
}
}

if ($page < $counter - 1) {
$pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
$pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
}

$pagination.= "</ul>";
}
$pagination.= "</div>";
$pagination.= "</div>";
return $pagination;
}
/** PAGINATION **/
public function contentsPostAll()
{
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;

$per_page = 10; 

$startpoint = ($page * $per_page) - $per_page;
//
$statement = "blog_contents WHERE contents_approved='OK' ORDER BY contents_id DESC"; 

$query = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_page}";

$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/** PAGINATION **/
public function contentsPagination()
{
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;

$per_page = 10; 

$startpoint = ($page * $per_page) - $per_page;

$url='?';

$statement = "blog_contents WHERE contents_approved='OK' ORDER BY contents_id DESC"; 

$query = "SELECT COUNT(*) as `num` FROM {$statement}";
$row = mysqli_fetch_array(mysqli_query(eBConDb::eBgetInstance()->eBgetConection(),$query));

$total = $row['num'];
$adjacents = "2"; 

$prevlabel = "&lsaquo; Prev";
$nextlabel = "Next &rsaquo;";
$lastlabel = "Last &rsaquo;&rsaquo;";

$page = ($page == 0 ? 1 : $page);  
$start = ($page - 1) * $per_page;

$prev = $page - 1;
$next = $page + 1;

$lastpage = ceil($total/$per_page);

$lpm1 = $lastpage - 1;

$pagination = "<div class='pager'>";
$pagination .= "<div class='pages'>";
if($lastpage > 1)
{   
$pagination .= "<ul class='pagination'>";
//$pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";

if ($page > 1)
$pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";

if ($lastpage < 7 + ($adjacents * 2)){   
for ($counter = 1; $counter <= $lastpage; $counter++){
if ($counter == $page)
$pagination.= "<li class='active'><a>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}

} elseif($lastpage > 1 + ($adjacents * 2)){

if($page < 1 + ($adjacents * 2)) {

for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>...</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  

} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>...</li>";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
$pagination.= "<li class='dot'>..</li>";
$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      

} else {

$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
$pagination.= "<li class='dot'>..</li>";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
if ($counter == $page)
$pagination.= "<li><a class='current'>{$counter}</a></li>";
else
$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
}
}
}

if ($page < $counter - 1) {
$pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
$pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
}

$pagination.= "</ul>";
}
$pagination.= "</div>";
$pagination.= "</div>";
return $pagination;
}

/*** ***/
public function contents_list_menue()
{
$query = "select contents_id, contents_og_image_title from blog_contents WHERE contents_approved='OK' ORDER BY contents_id DESC LIMIT 16";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_thurmnail_subcategory_gpost($category,$subcategory)
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='GPOST' and contents_category='$category' AND contents_sub_category='$subcategory' ORDER BY contents_id DESC";

$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_thurmnail_subcategory($category,$subcategory)
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' and contents_category='$category' AND contents_sub_category='$subcategory' ORDER BY contents_id DESC";

$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_thurmnail_category_gpost($category)
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='GPOST' AND contents_category='$category' ORDER BY contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_thurmnail_category($category)
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' AND contents_category='$category' ORDER BY contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_thurmnail_group_guest($contentsbloggroup)
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='GPOST' AND username_contents='$contentsbloggroup' ORDER BY contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_thurmnail_group($contentsbloggroup)
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' AND username_contents='$contentsbloggroup' ORDER BY contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function itemDetailsContentsGuest($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='GPOST' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function itemDetailsContents($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function item_details_contents_guest($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='GPOST' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while ($row = $result->fetch_array()) 
{
return $row;
}
}
$result -> free_result();
}
/*** ***/
public function item_details_contents($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while ($row = $result->fetch_array()) 
{
return $row;
}
}
$result -> free_result();
}

/*** ***/
public function item_keyword_blog($keywordblog)
{
$keywordblog = intval($keywordblog);
$query = "SELECT cont_subcategory_keywords_value FROM blog_subcategory_keywords WHERE cont_subcategory_keywords_id=$keywordblog";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while ($row = $result->fetch_array()) 
{
return $row;
}
}
$result -> free_result();
}
/*** ***/
public function item_details_guest_post($articleno)
{
$query = "SELECT contents_approved FROM blog_contents WHERE contents_id='$articleno'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($row = $result->fetch_array()) 
{
return $row;
}
}
$result -> free_result();
}
/*** ***/
public function item_details_articlewriter($articlewriter)
{
$articlewriter = strval($articlewriter);
$query = "SELECT * FROM blog_contents WHERE username_contents='$articlewriter'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while ($row = $result->fetch_array()) 
{
return $row;
}
}
$result -> free_result();
}
/*** ***/
public function contents_detail_all_part_guest($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='GPOST' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_detail_all_part($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_detail_how_to_do_guest($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='GPOST' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_detail_how_to_do($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_detail_video_guest($articleno)
{
$articleno = intval($articleno);
$query = "select contents_video_link from blog_contents WHERE contents_approved='GPOST' and contents_id=$articleno";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_detail_video($articleno)
{
$articleno = intval($articleno);
$query = "select contents_video_link from blog_contents WHERE contents_approved='OK' and contents_id=$articleno";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_download_guest($articleno)
{
$articleno = intval($articleno);
$query = "select contents_preview_link, contents_github_link from blog_contents WHERE contents_approved='GPOST' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_download($articleno)
{
$articleno = intval($articleno);
$query = "select contents_preview_link, contents_github_link from blog_contents WHERE contents_approved='OK' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}

/*** ***/
public function content_item_details_seo($articleno)
{
$articleno = intval($articleno);
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' and contents_id=$articleno";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function content_item_details_seo_last()
{
if(isset($articleno)){ $articleno = intval($articleno); }
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' order by contents_id DESC limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows=$result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function last_item()
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' ORDER BY contents_id DESC limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_mrss()
{
$query = "SELECT * FROM blog_contents WHERE contents_approved='OK' ORDER BY contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/*** ***/
public function contents_mrss_video()
{
$query = "select contents_id, contents_category, contents_sub_category, contents_og_image_title, contents_og_image_what_to_do, contents_date, contents_video_link from blog_contents WHERE contents_approved='OK' ORDER BY contents_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->eBData[]=$rows;
}
return $this->eBData;
}
$result -> free_result();
}
/* End */
}
?>