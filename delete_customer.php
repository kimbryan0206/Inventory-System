<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $customers_id = find_by_id('customers',(int)$_GET['id']);
  if(!$customers_id){
    $session->msg("d","Missing customer id.");
    redirect('customers.php');
  }
?>
<?php
  $customers_id= delete_by_id('customers',(int)$customers_id['id']);
  if($customers_id){
      $session->msg("s","Customer Info Deleted.");
      redirect('customers.php');
  } else {
      $session->msg("d","Customer Deletion Failed.");
      redirect('customers.php');
  }
?>