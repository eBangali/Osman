<?php 
/*
Account Level Type | Access Level Power
#######################################
admin = 10 TO 13
1. Username will remain ever and can not be changed.
2. Can invite using email.
3. Can refer using referral url. 
4. Can be a POS salesman
5. Can be use POS purchase and sales module
6. Can add post.
7. Can purchase.
8. Can use POS as admin
9. Can use POS stock transfer, profit chart, multiple warehouse.
10. Can add product or services.
11. Domain Business Admin
12. Can use Tags URL
#######################################
artwriter = 9
1. Username will remain ever and can not be changed.
2. Can invite using email.
3. Can refer using referral url. 
4. Can be a POS salesman
5. Can be use POS purchase and sales module
6. Can add post.
7. Can purchase.
8. Can use POS as admin
9. Can use POS stock transfer, profit chart, multiple warehouse.
10. Can add product or services.
11. Can write article.
#######################################
merchant = 8
1. Username will remain ever and can not be changed.
2. Can invite using email.
3. Can refer using referral url. 
4. Can be a POS salesman
5. Can be use POS purchase and sales module
6. Can add post.
7. Can purchase.
8. Can use POS as admin
9. Can use POS stock transfer, profit chart, multiple warehouse.
10. Can add product or services.
#######################################
intro = 4
1. Username will remain ever and can not be changed.
2. Can invite using email.
3. Can refer using referral url. 
4. Can be a POS salesman
5. Can be use POS purchase and sales module
6. Can add post.
7. Can purchase.
8. Can use POS as admin
#######################################
manager = 3
1. Username will remain ever and can not be changed.
2. Can be a POS salesman
3. Can be use POS purchase and sales module
4. Can add post.
5. Can purchase.
6. Can refer using referral url.
#######################################
salseman = 2
1. Username will remain ever and can not be changed.
2. Can be a POS salesman
3. Can add post.
4. Can purchase.
5. Can refer using referral url.
#######################################
staff = 2
1. Username will remain ever and can not be changed.
2. Must be a POS salesman
3. Can add post.
4. Can purchase.
5. Can refer using referral url.
#######################################
public = 1
1. Username will remain ever and can not be changed.
2. Can add post.
3. Can purchase.
4. Can refer using referral url.
#######################################
invited = 1
1. Username will remain ever and can not be changed.
2. Can add post.
3. Can purchase.
4. Can refer using referral url.
#######################################
unsubscribe = 1
1. Will never get email promotion. 
2. Can add post.
3. Can purchase.
4. Can refer using referral url.
#######################################
blocked = 0
1. Can not access account any more.
2. Can not be register again using that email, username.
*/
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel'] >= 9)
{

}
else
{
$printText = "<div class='container'>";
$printText .= "<div class='row'>";
$printText .= "<div class='col-xs-12'>";
$printText .= "<div class='well'><b>You have no enough permission to access.</b></div>";
$printText .= "</div>";
$printText .= "</div>";
$printText .= "</div>";
echo $printText;
include_once (eblayout.'/a-common-footer.php');
die();
}	
}
?>