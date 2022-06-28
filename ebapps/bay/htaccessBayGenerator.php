<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
$htaccess_out  = "# NC makes the rule non case sensitive\n";
$htaccess_out .= "# L makes this the last rule that this specific condition will match\n";
$htaccess_out .= "# $ in the regular expression makes the matching stop so that 'customblah' will not work\n";
$htaccess_out .= "\n";
$htaccess_out .= "Options +FollowSymlinks\n";
$htaccess_out .= "RewriteEngine On\n";
$htaccess_out .= "Options -MultiViews\n";
$htaccess_out .= "\n";
//
$htaccess_out .= "# Rewrite for product.php\n";
$htaccess_out .= "RewriteRule ^product/$ ./product.php [L,NC]\n";
$htaccess_out .= "\n";
//
$htaccess_out .= "# Rewrite for product.php?view=abc-Abc\n";
$htaccess_out .= "RewriteRule ^product/([a-zA-Z-]+)/$ ./product.php?view=$1 [NC,L]\n";
$htaccess_out .= "\n";
//
$htaccess_out .= "# Rewrite for product.php?view=abc-Abc&id=123\n";
$htaccess_out .= "RewriteRule ^product/([a-zA-Z-]+)/([0-9]+)/$ ./product.php?view=$1&id=$2 [NC,L]\n";
$htaccess_out .= "\n";
//
$htaccess_out .= "# Rewrite for product.php?view=abc-Abc&id=123&title=abc-Abc\n";
$htaccess_out .= "RewriteRule ^product/([a-zA-Z-]+)/([0-9]+)/([0-9a-zA-Z-]+)/$ ./product.php?view=$1&id=$2&title=$3 [NC,L]\n";
$htaccess_out .= "\n";
//
$htaccess_out .= "# Rewrite for product.php?view=abc-Abc&id=123&category=abc-Abc-123&subcategory=abc-Abc-123\n";
$htaccess_out .= "RewriteRule ^product/([a-zA-Z-]+)/([0-9]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/$ ./product.php?view=$1&id=$2&category=$3&subcategory=$4 [NC,L]\n";
$htaccess_out .= "\n";
//
$htaccess_out .= "# Rewrite for product.php?view=abc-Abc&id=123&category=abc-Abc-123&subcategory=abc-Abc-123&omr=abc-123\n";
$htaccess_out .= "RewriteRule ^product/([a-zA-Z-]+)/([0-9]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-z-]+)/$ ./product.php?view=$1&id=$2&category=$3&subcategory=$4&omr=$5 [NC,L]\n";
$htaccess_out .= "\n";
//
$htaccess_out .= "# Rewrite for product.php?view=abc-Abc&id=123&category=abc-Abc-123&subcategoryone=abc-Abc-123&subcategortwo=abc-Abc-123\n";
$htaccess_out .= "RewriteRule ^product/([a-zA-Z-]+)/([0-9]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/$ ./product.php?view=$1&id=$2&category=$3&subcategoryone=$4&subcategortwo=$5 [NC,L]\n";
$htaccess_out .= "\n";
//
$htaccess_out .= "# Rewrite for product.php?view=abc-Abc&id=123&category=abc-Abc-123&subcategoryone=abc-Abc-123&subcategortwo=abc-Abc-123&subcategorythree=abc-Abc-123\n";
$htaccess_out .= "RewriteRule ^product/([a-zA-Z-]+)/([0-9]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/$ ./product.php?view=$1&id=$2&category=$3&subcategoryone=$4&subcategortwo=$5&subcategorythree=$6 [NC,L]\n";
$htaccess_out .= "\n";
//
$htaccess_out .= "# Rewrite for product.php?view=abc-Abc&id=123&category=abc-Abc-123&subcategoryone=abc-Abc-123&subcategortwo=abc-Abc-123&subcategorythree=abc-Abc-123&subcategorythree=abc-Abc-123&subcategorythree=abc-Abc-123&subcategorythree=abc-Abc-123&subcategorythree=abc-Abc-123\n";
$htaccess_out .= "RewriteRule ^product/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/([0-9a-zA-Z-]+)/$ ./product.php?view=$1&id=$2&category=$3&subcategoryone=$4&subcategortwo=$5&subcategorythree=$6&subcategorythree=$7&subcategorythree=$8&subcategorythree=$9&subcategorythree=$10 [NC,L]\n";
$htaccess_out .= "\n";
//
$filenamepath =  ebproduct."/.htaccess";
if(is_writable($filenamepath)){
$fp = fopen($filenamepath,'w');
$write = fwrite($fp,$htaccess_out);
}
?>