<!-- Header -->
<header class=''>
  <div class='header-container'>
    <div class='container'>
      <div class='row'>
        <div class='col-xs-12 col-md-2 logo-block'> 
          <!-- Header Logo -->
          <div class='logo'><a href='/index.php'><img alt='<?php echo hostingAndRoot; ?>' src='<?php echo themeResource; ?>/images/Logo.png'></a>
            <div class='logoBrandTitle'>
              <?php if(!mysqli_connect_errno()){
include_once(eblogin.'/registration_page.php');
$siteTitle = new ebapps\login\registration_page();
$siteTitle -> site_owner_title();
if($siteTitle->data >= 1) { foreach($siteTitle->data as $val){ extract($val); 
if(!empty($business_title_two)){
echo $business_title_two;
}
}
}
}
?>
            </div>
          </div>
          <!-- End Header Logo --> 
        </div>
        <div class='col-xs-12 col-md-10 pull-right hidden-md hidden-sm hidden-xs'>
          <div class='collapse navbar-collapse'>
            <ul class='nav navbar-nav navbar-right'>
              <li><a href='<?php echo hostingAndRoot; ?>/' title='Home'><i class='fa fa-home fa-lg' aria-hidden='true'></i> Home</a></li>
              <!--Blog-->
              <?php if (isset($_SESSION['ebusername'])){ ?>
              <li class='dropdown'> <a href='' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog <b class='caret'></b></a>
                <ul class='dropdown-menu'>
                  <?php if ($_SESSION['memberlevel'] >= 1) { ?>
                  <li><a href='<?php echo outContentsLink; ?>/contents/' title='Blog'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 9) { ?>
                  <li><a href='<?php echo outContentsLink; ?>/contents-approve-query.php' title='Comments'><i class='fa fa-comment fa-lg' aria-hidden='true'></i> Comments</a></li>
                  <li><a href='<?php echo outContentsLink; ?>/contents-admin-view-items.php' title='Approval'><i class='fa fa-refresh fa-lg' aria-hidden='true'></i> Approval</a></li>
                  <li><a href='<?php echo outContentsLink; ?>/contents_add_tags.php' title='Add Tags'><i class='fa fa-tags fa-lg' aria-hidden='true'></i> Add Tags</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 1) { ?>
                  <li><a href='<?php echo outContentsLink; ?>/contents_add_tags_pub.php' title='Tags URL'><i class='fa fa-tags fa-lg' aria-hidden='true'></i> Tags URL</a></li>
                  <li><a href='<?php echo outContentsLink; ?>/contents-items-status.php' title='Post Status'><i class='fa fa-tasks fa-lg' aria-hidden='true'></i> Post Status</a></li>
                  <li><a href='<?php echo outContentsLink; ?>/contents-add-items.php' title='Submit your Article'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Submit your Article</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 9) { ?>
                  <li><a href='<?php echo outContentsLink; ?>/contents-add-sub-category.php' title='Add Sub Category'><i class='fa fa-sort-amount-asc fa-lg' aria-hidden='true'></i> Add Sub Category</a></li>
                  <li><a href='<?php echo outContentsLink; ?>/contents-add-category.php' title='Add Category'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category</a></li>
                  <?php } ?>
                  <?php include_once (eblayout.'/a-common-navebar-blog-cat-sub-menue-login.php'); ?>
                </ul>
              </li>
              <?php }  else { ?>
              <?php include_once (eblayout.'/a-common-navebar-blog-cat-sub-menue.php'); ?>
              <?php //include_once (eblayout.'/a-common-navebar-blog-full-category-in-menu.php'); ?>
              <?php } ?>
              <!--SATTINGS-->
              <?php if (isset($_SESSION['ebusername'])){ ?>
              <li class='dropdown'> <a href='' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-cogs fa-lg' aria-hidden='true'></i> <b class='caret'></b></a>
                <ul class='dropdown-menu'>
                  <?php if ($_SESSION['memberlevel'] >= 9) { ?>
                  <li><a href='<?php echo outAccessLink; ?>/sendMail.php' title='Mass eMail'><i class='fa fa-envelope fa-lg' aria-hidden='true'></i> Send eMail</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/access_all_account_information.php' title='User Info'><i class='fa fa-users fa-lg' aria-hidden='true'></i> User Info</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/all_user_analytics.php' title='User Analytics'><i class='fa fa-users fa-lg' aria-hidden='true'></i> User Analytics</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/all_visitor_analytics.php' title='Visitor Analytics'><i class='fa fa-users fa-lg' aria-hidden='true'></i> Visitor Analytics</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/mrss.php' title='All mRSS'><i class='fa fa-rss fa-lg' aria-hidden='true'></i> All mRSS</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/sitemap.php' title='Sitemap'><i class='fa fa-sitemap fa-lg' aria-hidden='true'></i> Sitemap</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/access_payment_gateways.php' title='Payment Gateways'><i class='fa fa-credit-card fa-lg' aria-hidden='true'></i> Payment Gateways</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 8) { ?>
                  <li><a href='<?php echo outAccessLink; ?>/access-admin-merchant-profile.php' title='Business Info'><i class='fa fa-briefcase fa-lg' aria-hidden='true'></i> Business Info</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 6) { ?>
                  <li><a href='<?php echo outAccessLink; ?>/access-invite-result.php' title='Referral Statuses'><i class='fa fa-bar-chart fa-lg' aria-hidden='true'></i> Referral Statuses </a></li>
                  <li><a href='<?php echo outAccessLink; ?>/access-invite.php' title='Refer Someone'><i class='fa fa-user-plus fa-lg' aria-hidden='true'></i> Refer Someone</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 1) { ?>
                  <li><a href='<?php echo outAccessLink; ?>/access_update_account_information.php' title='Account Settings'><i class='fa fa-cog fa-lg' aria-hidden='true'></i> Account Settings </a></li>
                  <?php } ?>
                  <li class='last'><a href='<?php echo outPagesLink; ?>/logout.php' title='Log Out'><i class='fa fa-sign-out fa-lg' aria-hidden='true'></i> Log Out</a></li>
                </ul>
              </li>
              <?php } else { ?>
              <?php include_once (eblayout.'/a-common-navebar-settings-cat-sub-menue.php'); ?>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- end header -->