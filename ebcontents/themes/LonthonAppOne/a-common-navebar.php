<div class='col-lg-2 col-md-3 col-sm-3 col-xs-12 hidden-xs nav-icon'>
        <div class='mega-container visible-lg visible-md visible-sm'>
          <div class='navleft-container'>
            <div class='mega-menu-title'>
              <h3><i class='fa fa-navicon fa-lg'></i>All</h3>
            </div>
            <div class='mega-menu-category'>
              <ul class='nav'>
                <?php if (isset($_SESSION['ebusername'])){ ?>
                <!--Shop-->
                <li> <a href='<?php echo outBayLink; ?>/product/'><i class='fa fa-shopping-basket fa-lg' aria-hidden='true'></i> Shop</a>
                  <div class='wrap-popup'>
                    <div class='popup'>
                      <div class='row'>
                        <div class='col-sm-6'>
                          <ul class='nav'>
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
                          </ul>
                        </div>
                        <div class='col-sm-6 has-sep'>
                          <ul class='nav'>
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
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!--Start eCommerce Dextop Menue-->
                <?php include_once (ebbay.'/ebcart.php'); ?>
                <?php $category = new ebapps\bay\ebcart(); $category ->menu_category_showroom(); ?>
                <?php if($category->eBData >= 1) { ?>
                <?php foreach($category->eBData as $catval): extract($catval); ?>
                <?php if (!empty($s_category_a)){ ?>
                <li><a href='<?php echo outBayLink; ?>/product/'>
                  <?php $cat = $s_category_a; echo $category->visulString($s_category_a); ?>
                  </a>
                  <div class='wrap-popup'>
                    <div class='popup'>
                      <div class='row'>
                        <?php $subcategory = new ebapps\bay\ebcart(); $subcategory ->menu_sub_category_showroom($cat); ?>
                        <?php if($subcategory->eBData >= 1) { ?>
                        <?php $bayHasSep =0; foreach($subcategory->eBData as $subval): extract($subval); ?>
                        <?php  ?>
                        <?php if (!empty($s_category_a) and !empty($s_category_b)){ ?>
                        <?php $catSub = $s_category_a; $catSubSub = $s_category_b; ?>
                        <div class='col-sm-6 <?php if($bayHasSep%2==0) { echo "has-sep"; } ?>'>
                          <h3><?php echo $subcategory->visulString($s_category_b); ?></h3>
                          <ul class='nav'>
                            <?php $subSubcategory = new ebapps\bay\ebcart(); $subSubcategory ->menu_sub_sub_category_showroom($catSub,$catSubSub); ?>
                            <?php if($subSubcategory->eBData >= 1) { ?>
                            <?php foreach($subSubcategory->eBData as $subsubval): extract($subsubval); ?>
                            <?php if (!empty($s_category_a) and !empty($s_category_b) and !empty($s_category_c)){ ?>
                            <li><a href='<?php echo outBayLink; ?>/product/item-details-grid/<?php echo $bay_showroom_approved_items_id; ?>/' title='<?php echo $s_category_c; ?>'><?php echo $subSubcategory->visulString($s_category_c); ?></a></li>
                            <?php } endforeach; } ?>
                          </ul>
                        </div>
                        <?php  } $bayHasSep++; endforeach; } ?>
                      </div>
                    </div>
                  </div>
                </li>
                <?php } endforeach; } ?>
                <!--End eCommerce Dextop Menue--> 
                <!--Blog-->
                <li> <a href='<?php echo outContentsLink; ?>/contents/'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog</a>
                  <div class='wrap-popup'>
                    <div class='popup'>
                      <div class='row'>
                        <div class='col-sm-6'>
                          <ul class='nav'>
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
                          </ul>
                        </div>
                        <div class='col-sm-6 has-sep'>
                          <ul class='nav'>
                            <?php if ($_SESSION['memberlevel'] >= 1) { ?>
                            <li><a href='<?php echo outContentsLink; ?>/contents_add_tags_pub.php' title='Tags URL'><i class='fa fa-tags fa-lg' aria-hidden='true'></i> Tags URL</a></li>
                            <li><a href='<?php echo outContentsLink; ?>/contents-items-status.php' title='Post Status'><i class='fa fa-tasks fa-lg' aria-hidden='true'></i> Post Status</a></li>
                            <li><a href='<?php echo outContentsLink; ?>/contents-add-items.php' title='Add a New Post'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Add a New Post</a></li>
                            <?php } ?>
                            <?php if ($_SESSION['memberlevel'] >= 13) { ?>
                            <li><a href='<?php echo outContentsLink; ?>/contents-add-sub-category.php' title='Add Sub Category'><i class='fa fa-sort-amount-asc fa-lg' aria-hidden='true'></i> Add Sub Category</a></li>
                            <li><a href='<?php echo outContentsLink; ?>/contents-add-category.php' title='Add Category'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category</a></li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                      <!--Start Blog Dextop Menue-->
                      <?php include_once (ebblog.'/blog.php'); ?>
                      <div class='row'>
                        <?php $contentCategory = new ebapps\blog\blog(); $contentCategory ->menu_category_contents(); ?>
                        <?php if($contentCategory->eBData >= 1) { ?>
                        <?php $contentHasSep =0; foreach($contentCategory->eBData as $contentCategoryVal): extract($contentCategoryVal); ?>
                        <?php if (!empty($contents_category)){ ?>
                        <?php $conternCat = $contents_category; ?>
                        <div class='col-sm-6 <?php if($contentHasSep%2==0) { echo "has-sep"; } ?>'>
                          <h3><?php echo $contentCategory->visulString($contents_category); ?></h3>
                          <ul class='nav'>
                            <?php $contentSubCategory = new ebapps\blog\blog(); $contentSubCategory ->menu_sub_category_contents($conternCat); ?>
                            <?php if($contentSubCategory->eBData >= 1) { ?>
                            <?php foreach($contentSubCategory->eBData as $contentSubCategoryVal): extract($contentSubCategoryVal); ?>
                            <?php if (!empty($contents_category) and !empty($contents_sub_category)){ ?>
                            <li><a href='<?php echo outContentsLink; ?>/contents/subcategory/<?php echo $contents_id; ?>/' title='<?php echo $contents_sub_category; ?>'><?php echo $contentSubCategory->visulString($contents_sub_category); ?></a></li>
                            <?php } endforeach; } ?>
                          </ul>
                        </div>
                        <?php } $contentHasSep++; endforeach; } ?>
                      </div>
                      <!--End Blog Dextop Menue--> 
                    </div>
                  </div>
                </li>
                <!--SATTINGS-->
                <li> <a href='<?php echo outAccessLink; ?>/home.php'><i class='fa fa-cogs fa-lg' aria-hidden='true'></i> <?php echo $_SESSION['ebusername']; ?> </a>
                  <div class='wrap-popup column1'>
                    <div class='popup'>
                      <ul class='nav'>
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
                    </div>
                  </div>
                </li>
                <?php } else { ?>
                <?php if(!mysqli_connect_errno()){ ?>
                <?php if (empty($_SESSION['ebusername'])){ ?>
                <li class='nosub'><a href='<?php echo outAccessLink; ?>/home.php' title='Log In'><i class='fa fa-sign-in fa-lg' aria-hidden='true'></i> Log In</a></li>
                <li class='nosub'><a href='<?php echo outAccessLink; ?>/signup.php' title='Sign Up'><i class='fa fa-user-plus fa-lg' aria-hidden='true'></i> Sign Up</a></li>
                <?php } ?>
                <!--Start eCommerce Dextop Menue-->
                <?php include_once (ebbay.'/ebcart.php'); ?>
                <?php $category = new ebapps\bay\ebcart(); $category ->menu_category_showroom(); ?>
                <?php if($category->eBData >= 1) { ?>
                <?php foreach($category->eBData as $catval): extract($catval); ?>
                <?php if (!empty($s_category_a)){ ?>
                <li><a href='<?php echo outBayLink; ?>/product/'>
                  <?php $cat = $s_category_a; echo $category->visulString($s_category_a); ?>
                  </a>
                  <div class='wrap-popup'>
                    <div class='popup'>
                      <div class='row'>
                        <?php $subcategory = new ebapps\bay\ebcart(); $subcategory ->menu_sub_category_showroom($cat); ?>
                        <?php if($subcategory->eBData >= 1) { ?>
                        <?php $bayHasSep =0; foreach($subcategory->eBData as $subval): extract($subval); ?>
                        <?php  ?>
                        <?php if (!empty($s_category_a) and !empty($s_category_b)){ ?>
                        <?php $catSub = $s_category_a; $catSubSub = $s_category_b; ?>
                        <div class='col-sm-6 <?php if($bayHasSep%2==0) { echo "has-sep"; } ?>'>
                          <h3><?php echo $subcategory->visulString($s_category_b); ?></h3>
                          <ul class='nav'>
                            <?php $subSubcategory = new ebapps\bay\ebcart(); $subSubcategory ->menu_sub_sub_category_showroom($catSub,$catSubSub); ?>
                            <?php if($subSubcategory->eBData >= 1) { ?>
                            <?php foreach($subSubcategory->eBData as $subsubval): extract($subsubval); ?>
                            <?php if (!empty($s_category_a) and !empty($s_category_b) and !empty($s_category_c)){ ?>
                            <li><a href='<?php echo outBayLink; ?>/product/item-details-grid/<?php echo $bay_showroom_approved_items_id; ?>/' title='<?php echo $s_category_c; ?>'><?php echo $subSubcategory->visulString($s_category_c); ?></a></li>
                            <?php } endforeach; } ?>
                          </ul>
                        </div>
                        <?php  } $bayHasSep++; endforeach; } ?>
                      </div>
                    </div>
                  </div>
                </li>
                <?php } endforeach; } ?>
                <!--End eCommerce Dextop Menue-->
                <!--Start Blog Dextop Menue-->
                <?php include_once (ebblog.'/blog.php'); ?>
                <li><a href='<?php echo outContentsLink; ?>/contents/' title='Blog'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i> Blog</a>
                  <div class='wrap-popup'>
                    <div class='popup'>
                      <div class='row'>
                        <?php $contentCategory = new ebapps\blog\blog(); $contentCategory ->menu_category_contents(); ?>
                        <?php if($contentCategory->eBData >= 1) { ?>
                        <?php $contentHasSep =0; foreach($contentCategory->eBData as $contentCategoryVal): extract($contentCategoryVal); ?>
                        <?php if (!empty($contents_category)){ ?>
                        <?php $conternCat = $contents_category; ?>
                        <div class='col-sm-6 <?php if($contentHasSep%2==0) { echo "has-sep"; } ?>'>
                          <h3><?php echo $contentCategory->visulString($contents_category); ?></h3>
                          <ul class='nav'>
                            <?php $contentSubCategory = new ebapps\blog\blog(); $contentSubCategory ->menu_sub_category_contents($conternCat); ?>
                            <?php if($contentSubCategory->eBData >= 1) { ?>
                            <?php foreach($contentSubCategory->eBData as $contentSubCategoryVal): extract($contentSubCategoryVal); ?>
                            <?php if (!empty($contents_category) and !empty($contents_sub_category)){ ?>
                            <li><a href='<?php echo outContentsLink; ?>/contents/subcategory/<?php echo $contents_id; ?>/' title='<?php echo $contents_sub_category; ?>'><?php echo $contentSubCategory->visulString($contents_sub_category); ?></a></li>
                            <?php } endforeach; } ?>
                          </ul>
                        </div>
                        <?php } $contentHasSep++; endforeach; } ?>
                      </div>
                    </div>
                  </div>
                </li>
                <!--End Blog Dextop Menue-->
                <?php } } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
