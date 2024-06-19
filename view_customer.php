<?php
  $page_title = 'View Customer';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $customer_id = find_by_id('customers',(int)$_GET['id']);
  if(!$customer_id){
    $session->msg("d","Missing user id.");
    redirect('customers.php');
  }
?>
<?php include_once('layouts/header.php'); ?>             
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-8">
  <a href="customers.php"> <i class="glyphicon glyphicon-arrow-left" id= "back-btn"> BACK</i></a>    
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Viewing <?php echo remove_junk(ucwords($customer_id['name'])); ?> Information         
        </strong>
                     
       </div>
       
       <div class="panel-body">
          <form method="post" action="edit_user.php?id=<?php echo (int)$customer_id['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Full Name</label>
                  <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucwords($customer_id['name'])); ?>">
            </div>  
            <div class="form-group">
                  <label for="address" class="control-label">Shipping Address</label>
                  <input type="text" class="form-control" name="address" value="<?php echo remove_junk(ucwords($customer_id['address'])); ?>">
            </div>   
            <div class="form-group">
                  <label for="order #" class="control-label">Order # </label>
                  <input type="text" class="form-control" name="order_no" value="<?php echo remove_junk(ucwords($customer_id['order_no'])); ?>">
            </div>  
            <div class="form-group">
                  <label for="contact #" class="control-label">Contact # </label>
                  <input type="text" class="form-control" name="contact" value="<?php echo remove_junk(ucwords($customer_id['contact'])); ?>">
            </div>  
            <div class="form-group">
                  <label for="email" class="control-label">Email</label>
                  <input type="text" class="form-control" name="email" value="<?php echo remove_junk(ucwords($customer_id['email'])); ?>">
            </div> 
        </form>
       </div>
     </div>
  </div>
 

 </div>
<?php include_once('layouts/footer.php'); ?>
