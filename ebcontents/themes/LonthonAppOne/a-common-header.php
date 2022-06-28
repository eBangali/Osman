<!-- Header -->
<header class=''>
  <div class='header-container'>
    <div class='container'>
      <div class='row'>
        <div class='col-xs-12 col-md-2 logo-block'> 
          <!-- Header Logo -->
          <div class='logo'><a href='/'><img alt='<?php echo hostingAndRoot; ?>' src='<?php echo themeResource; ?>/images/Logo.png'></a>
            <div class='logoBrandTitle'>
              <?php if(!mysqli_connect_errno()){
include_once(eblogin.'/registration_page.php');
$siteTitle = new ebapps\login\registration_page();
$siteTitle -> site_owner_title();
if($siteTitle->eBData >= 1) { foreach($siteTitle->eBData as $val){ extract($val); 
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
              <!--Shop-->
              <?php if (isset($_SESSION['ebusername'])){ ?>
              <li class='dropdown'> <a href='<?php echo outBayLink; ?>/product/' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-shopping-basket fa-lg' aria-hidden='true'></i> Shop <b class='caret'></b></a>
                <ul class='dropdown-menu'>
                  <?php if ($_SESSION['memberlevel'] >= 1) { ?>
                  <li><a href='<?php echo outBayLink; ?>/product/'><i class='fa fa-shopping-basket fa-lg' aria-hidden='true'></i> Shop</a></li>
                  <li><a href='<?php echo outBayLink; ?>/user-purchase-history.php' title='Purchase History'><i class='fa fa-list-alt fa-lg' aria-hidden='true'></i> Purchase History</a></li>
                  <li><a href='<?php echo outBayLink; ?>/returns-refunds.php' title='Return And Refund'><i class='fa fa-retweet fa-lg' aria-hidden='true'></i> Return And Refund</a></li>
                  <li><a href='<?php echo outBayLink; ?>/bay-referral.php' title='Referral URL'><i class='fa fa-user-plus fa-lg' aria-hidden='true'></i> Referral URL</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 13) { ?>
                  <li><a href='<?php echo outBayLink; ?>/admin-check-vat-tax-to-return.php' title='VAT/GST/TAX Amount'><i class='fa fa-retweet fa-lg' aria-hidden='true'></i> VAT/GST/TAX Amount</a></li>
                  <li><a href='<?php echo outBayLink; ?>/admin-check-returns-refunds.php' title='Admin Check Return And Refund'><i class='fa fa-retweet fa-lg' aria-hidden='true'></i> Admin Check Return And Refund</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 8) { ?>
                  <li><a href='<?php echo outBayLink; ?>/merchant-returns-refunds.php' title='Merchant Return And Refund'><i class='fa fa-retweet fa-lg' aria-hidden='true'></i> Merchant Return And Refund</a></li>
                  <li><a href='<?php echo outBayLink; ?>/merchant-sales-history.php' title='Sales History'><i class='fa fa-history fa-lg' aria-hidden='true'></i> Sales History</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 13) { ?>
                  <li><a href='<?php echo outBayLink; ?>/bay-bkash-payment-verify.php' title='bKash Payment Verify'><i class='fa fa-money fa-lg' aria-hidden='true'></i> bKash Payment Verify</a></li>
                  <li><a href='<?php echo outBayLink; ?>/dhl-export-rates-by-zone-and-product.php' title='DHL Rates'><i class='fa fa-truck fa-lg' aria-hidden='true'></i> DHL Rates</a></li>
                  <li><a href='<?php echo outBayLink; ?>/dhl-rating-zones.php' title='DHL Rating Zones'><i class='fa fa-bus fa-lg' aria-hidden='true'></i> DHL Rating Zones</a></li>
                  <li><a href='<?php echo outBayLink; ?>/bay-branding-status.php' title='Branding Status'><i class='fa fa-shield fa-lg' aria-hidden='true'></i> Branding Status</a></li>
                  <li><a href='<?php echo outBayLink; ?>/bay-branding.php' title='Branding Add New'><i class='fa fa-get-pocket fa-lg' aria-hidden='true'></i> Branding Add New</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 13) { ?>
                  <li><a href='<?php echo outBayLink; ?>/bay-admin-view-of-merchants-items.php' title='Item Approval'><i class='fa fa-refresh fa-lg' aria-hidden='true'></i> Item Approval</a></li>
                  <li><a href='<?php echo outBayLink; ?>/bay-add-item-unit.php' title='Add Item Unit'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Add Item Unit</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 8) { ?>
                  <li><a href='<?php echo outBayLink; ?>/bay-merchants-items-view.php' title='Item Status'><i class='fa fa-tasks fa-lg' aria-hidden='true'></i> Item Status</a></li>
                  <li><a href='<?php echo outBayLink; ?>/bay-merchant-add-items.php' title='Shop Add Item'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Shop Add Item</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 13) { ?>
                  <li><a href='<?php echo outBayLink; ?>/bay-add-category-d.php' title='Add Category D'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category D</a></li>
                  <li><a href='<?php echo outBayLink; ?>/bay-add-category-c.php' title='Add Category C'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category C</a></li>
                  <li><a href='<?php echo outBayLink; ?>/bay-add-category-b.php' title='Add Category B'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category B</a></li>
                  <li><a href='<?php echo outBayLink; ?>/bay-add-category-a.php' title='Add Category A'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category A</a></li>
                  <?php } ?>
                  <?php include_once (eblayout.'/a-common-navebar-bay-cat-sub-menue-login.php'); ?>
                </ul>
              </li>
              <?php }  else { ?>
              <?php include_once (eblayout.'/a-common-navebar-bay-cat-sub-menue.php'); ?>
              <?php } ?>
              <!--Blog-->
              <?php if (isset($_SESSION['ebusername'])){ ?>
              <li class='dropdown'> <a href='' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog <b class='caret'></b></a>
                <ul class='dropdown-menu'>
                  <?php if ($_SESSION['memberlevel'] >= 1) { ?>
                  <li><a href='<?php echo outContentsLink; ?>/contents/' title='Blog'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 9) { ?>
                  <li><a href='<?php echo outContentsLink; ?>/contents-approve-query.php' title='Comments'><i class='fa fa-comment fa-lg' aria-hidden='true'></i> Comments</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 13) { ?>
                  <li><a href='<?php echo outContentsLink; ?>/contents-admin-view-items.php' title='Approval'><i class='fa fa-refresh fa-lg' aria-hidden='true'></i> Approval</a></li>
                  <li><a href='<?php echo outContentsLink; ?>/contents_add_tags.php' title='Add Tags'><i class='fa fa-tags fa-lg' aria-hidden='true'></i> Add Tags</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 1) { ?>
                  <li><a href='<?php echo outContentsLink; ?>/contents_add_tags_pub.php' title='Tags URL'><i class='fa fa-tags fa-lg' aria-hidden='true'></i> Tags URL</a></li>
                  <li><a href='<?php echo outContentsLink; ?>/contents-items-status.php' title='Post Status'><i class='fa fa-tasks fa-lg' aria-hidden='true'></i> Post Status</a></li>
                  <li><a href='<?php echo outContentsLink; ?>/contents-add-items.php' title='Add a New Post'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Add a New Post</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 13) { ?>
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
              <li class='dropdown'> <a href='' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-cogs fa-lg' aria-hidden='true'></i> <?php echo $_SESSION['ebusername']; ?> <b class='caret'></b></a>
                <ul class='dropdown-menu'>
                  <?php if ($_SESSION['memberlevel'] >= 13) { ?>
                  <li><a href='<?php echo outAccessLink; ?>/sendMail.php' title='Mass eMail'><i class='fa fa-envelope fa-lg' aria-hidden='true'></i> Send eMail</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/access_all_account_information.php' title='User Info'><i class='fa fa-users fa-lg' aria-hidden='true'></i> User Info</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 9) { ?>
                  <li><a href='<?php echo outAccessLink; ?>/all_user_analytics.php' title='User Analytics'><i class='fa fa-users fa-lg' aria-hidden='true'></i> User Analytics</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/all_visitor_analytics.php' title='Visitor Analytics'><i class='fa fa-users fa-lg' aria-hidden='true'></i> Visitor Analytics</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/mrss.php' title='All mRSS'><i class='fa fa-rss fa-lg' aria-hidden='true'></i> All mRSS</a></li>
                  <li><a href='<?php echo outAccessLink; ?>/sitemap.php' title='Sitemap'><i class='fa fa-sitemap fa-lg' aria-hidden='true'></i> Sitemap</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 13) { ?>
                  <li><a href='<?php echo outAccessLink; ?>/access_payment_gateways.php' title='Payment Gateways'><i class='fa fa-credit-card fa-lg' aria-hidden='true'></i> Payment Gateways</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 13) { ?>
                  <li><a href='<?php echo outAccessLink; ?>/access-admin-merchant-profile.php' title='Business Info'><i class='fa fa-briefcase fa-lg' aria-hidden='true'></i> Business Info</a></li>
                  <?php } ?>
                  <?php if ($_SESSION['memberlevel'] >= 4) { ?>
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