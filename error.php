<?php include_once('initialize.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-blog.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<section class='content-wrapper'>
<div class='container'>
<div class='std'>
<div class='page-not-found'>
<h2>404</h2>
<h3><img src='<?php echo themeResource; ?>/images/signal.png'>Oops! The Page you requested was not found!</h3>
<div><a href='<?php echo hostingAndRoot; ?>/index.php' type='button' class='btn-home'><span>Back To Home</span></a></div>
</div>
</div>
</div>
</section>
<?php include_once (eblayout.'/a-common-footer.php'); ?>