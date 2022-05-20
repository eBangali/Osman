<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
$htaccess_out  = "RewriteEngine on\n";
$htaccess_out .= "ErrorDocument 404 /error.php\n";
/*** This will redirece all www.domain.com/ to https://domain.com/ ***/
$htaccess_out .= "RewriteCond %{HTTPS} on\n";
$htaccess_out .= "RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]\n";
$htaccess_out .= "RewriteRule ^(.*)$ https://%1/$1 [R=301,L]\n";
/*** This will redirece all domain.com/ to https://www.domain.com/ ***/
/*
$htaccess_out .= "RewriteCond %{HTTPS} on\n";
$htaccess_out .= "RewriteCond %{HTTP_HOST} !^www\.(.*)$ [NC]\n";
$htaccess_out .= "RewriteRule ^(.*)$ https://www.%{HTTP_HOST}/$1 [R=301,L]\n";
*/

$filenamepath =  eb."/.htaccess";
if(is_writable($filenamepath)){
$fp = fopen($filenamepath,'w');
$write = fwrite($fp,$htaccess_out);
}
?>