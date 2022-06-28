<?php
if(!mysqli_connect_errno()){ ?>
<li> <a href='<?php echo outBayLink; ?>/product/' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-shopping-basket fa-lg' aria-hidden='true'></i> Shop<b class='caret'></b></a>
  <ul class='dropdown-menu multi-level'>
    <li><a href='<?php echo outBayLink; ?>/product/'><i class='fa fa-shopping-basket fa-lg' aria-hidden='true'></i> Shop</a></li>
    <?php include_once (ebbay.'/ebcart.php'); ?>
    <?php
$category = new ebapps\bay\ebcart();
$category ->menu_category_showroom();
?>
    <?php if($category->eBData >= 1) { ?>
    <?php foreach($category->eBData as $catval): extract($catval); ?>
    <?php if (!empty($s_category_a)){ ?>
    <li class='dropdown-submenu'> <a href='<?php echo outBayLink; ?>/product/' class='dropdown-toggle' data-toggle='dropdown'>
      <?php $cat = $s_category_a; echo $category->visulString($s_category_a); ?>
      </a> 
      <ul class='dropdown-menu'>
        <?php
$subcategory = new ebapps\bay\ebcart();
$subcategory ->menu_sub_category_showroom($cat);
?>
        <?php if($subcategory->eBData >= 1) { ?>
        <?php foreach($subcategory->eBData as $subval): extract($subval); ?>
        <?php if (!empty($s_category_a) and !empty($s_category_b)){ ?>
        <?php $catSub = $s_category_a; $catSubSub = $s_category_b; ?>
        <li class='dropdown-submenu'> <a href='<?php echo outBayLink; ?>/product/' class='dropdown-toggle' data-toggle='dropdown'><?php echo $subcategory->visulString($s_category_b); ?></a>
        <ul class='dropdown-menu'>
<?php
$subSubcategory = new ebapps\bay\ebcart();
$subSubcategory ->menu_sub_sub_category_showroom($catSub,$catSubSub);
?>
<?php if($subSubcategory->eBData >= 1) { ?>
<?php foreach($subSubcategory->eBData as $subsubval): extract($subsubval); ?>
<?php if (!empty($s_category_a) and !empty($s_category_b) and !empty($s_category_c)){ 
?>
<li><a href='<?php echo outBayLink; ?>/product/item-details-grid/<?php echo $bay_showroom_approved_items_id; ?>/' title='<?php echo $s_category_c; ?>'><?php echo $subSubcategory->visulString($s_category_c); ?></a></li>
<?php } ?>
<?php endforeach; } ?>
</ul>
        </li>
        <?php } ?>
        <?php endforeach; } ?>
      </ul>
    </li>
    <?php } ?>
    <?php endforeach; } ?>
  </ul>
</li>
<?php } ?>