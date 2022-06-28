<li>
  <div class='mm-search'>
    <?php include_once (ebbay.'/ebcart.php'); ?>
    <?php include_once (ebformkeys.'/valideForm.php'); ?>
    <?php $formKey = new ebapps\formkeys\valideForm(); ?>
    <?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$search_bay_error = '';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['submit_search_bay']))
{
extract($_REQUEST);

/* Form Key*/
if(isset($_REQUEST['form_key']))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST['form_key']);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = " Server Busy";
$error = 1;
}
}

/* search_bay */
if (empty($_REQUEST['search_bay']))
{
$search_bay_error = "Keyword?";
$error =1;
} 
/* valitation search_bay  */
elseif (! preg_match('/^([A-Za-z\-\ ]+){2,24}$/',$search_bay))
{
$search_bay_error = "Keyword?";
$error =1;
}
else 
{
$search_bay = $sanitization -> test_input($_POST['search_bay']);
}
?>
    <?php } ?>
    <form id='search1' method='post'>
      <div class='input-group'>
        <div class='input-group-btn'>
          <input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
          <button name='submit_search_bay' class='btn btn-default' type='submit'><i class='fa fa-search' aria-hidden='true'></i> </button>
        </div>
        <input type='text' class='form-control simple' name='search_bay' value='<?php echo $search_bay_error;  ?><?php echo $formKey_error; ?>' id='srch-term' required />
      </div>
    </form>
  </div>
</li>
