<?php
  $page_title = 'Edit Customer';
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

<?php
//Update User basic info
  if(isset($_POST['update'])) {
    $req_fields = array('name','address','order_no','contact','email');
    validate_fields($req_fields);
    if(empty($errors)){
          $id = (int)$customer_id['id'];
          $name = remove_junk($db -> escape($_POST['name']));
          $address = remove_junk($db -> escape($_POST['address']));
          $order_no = remove_junk($db -> escape($_POST['order_no']));
          $contact = remove_junk($db -> escape($_POST['contact']));
          $email = remove_junk($db -> escape($_POST['email']));
          $sql = "UPDATE customers SET name ='{$name}', address ='{$address}',order_no ='{$order_no}',contact='{$contact}' ,email='{$email}'WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Account Updated ");
            redirect('edit_customer.php?id='.(int)$customer_id['id'], false);
          } else {
            $session->msg('d',' Sorry failed to updated!');
            redirect('edit_customer.php?id='.(int)$customer_id['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_customer.php?id='.(int)$customer_id['id'],false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>

 <div class="row">          
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
  <a href="customers.php"> <i class="glyphicon glyphicon-arrow-left" id="back-btn"> BACK</i></a> 
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Update Information
        </strong>
       </div>
       <div class="panel-body">
          <form method="post" action="edit_customer.php?id=<?php echo (int)$customer_id['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Name</label>
                  <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucwords($customer_id['name'])); ?>">
            </div>
            <div class="form-group">
                  <label for="address" class="control-label">Address</label>
                  <input type="text" class="form-control" name="address" value="<?php echo remove_junk(ucwords($customer_id['address'])); ?>">
            </div>
            <div class="form-group">
                  <label for="order #" class="control-label">Order #</label>
                  <input type="text" class="form-control" name="order_no" value="<?php echo remove_junk(ucwords($customer_id['order_no'])); ?>">
            </div>
            <div class="form-group">
                  <label for="contact" class="control-label">Contact #</label>
                  <input type="text" class="form-control" name="contact" value="<?php echo remove_junk(ucwords($customer_id['contact'])); ?>">
            </div>
            <div class="form-group">
                  <label for="email" class="control-label">Email Address</label>
                  <input type="text" class="form-control" name="email" value="<?php echo remove_junk(ucwords($customer_id['email'])); ?>">
            </div>
            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info">Update</button>
            </div>
        </form>
       </div>
     </div>
  </div>
 </div>
<?php include_once('layouts/footer.php'); ?>
