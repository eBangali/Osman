<?php $objBrand= new ebapps\bay\ebcart(); $objBrand -> branding_carousel(); ?>
<?php if($objBrand->eBData > 0) { ?>
<?php
$branding ="<div id='rev_slider_4_wrapper' class='rev_slider_wrapper'>";
$branding .="<div id='brandingCarosoul' class='rev_slider'>";
$branding .="<ul>";
foreach($objBrand->eBData as $val): extract($val);
$branding .="<li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='";
$branding .=hypertextWithOrWithoutWww.$branding_image_url;
$branding .="'><img src='";
$branding .=hypertextWithOrWithoutWww.$branding_image_url;
$branding .="' alt='";
$branding .=$branding_title;
$branding .="' data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' />";
$branding .="<div class='info'>";
$branding .="<div class='tp-caption LargeTitle sfl tp-resizeme' data-endspeed='500' data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'><span class='eBTextBack'>".$branding_title."</span> </div>";
if(!empty($branding_url)){
$branding .="<div class='tp-caption sfb  tp-resizeme' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'><a href='".hypertextWithOrWithoutWww.$branding_url."' class='buy-btn eBTextBack'>Shop Now</a></div>";
}
$branding .="</div>";
$branding .="</li>";
endforeach;
$branding .="</ul>";
$branding .="</div>";
$branding .="</div>";
echo $branding;
}
?>
