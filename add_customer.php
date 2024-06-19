<?php
  $page_title = 'Add Customers';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>

 <?php
 if (isset($_POST['add_customer'])) {
     $req_fields = array('name','address','order_no','contact','email',);
 
     // Validate fields and handle potential errors
     $errors = validate_fields($req_fields); // Assuming `validate_fields` returns an array of errors
 
     if (empty($errors)) {
         try {
             // Attempt to add the customer to the database
             if ($db->addCustomer($_POST['name'], $_POST['address'], $_POST['order_no'],$_POST['contact'],$_POST['email'])) {
              $session->msg('s',"Customer Information has been created! ");
             } else {
                 $error_message = "Error adding customer. Please try again."; // Informative error message
                 $session->msg("ERROR", $error_message); // Use session message with error message
                 echo '<script>';
                 echo 'alert("' . $success_message . '");'; // Display alert with the success message
                 echo '</script>';
             }
         } catch (Exception $e) {
             $error_message = "An unexpected error occurred: " . $e->getMessage(); // Informative error message
             $session->msg("ERROR", $error_message); // Use session message with error message
             // Consider logging the exception for further debugging
             error_log($e->getMessage(), 3, '/path/to/error.log'); // Adjust path as needed
         }
     } else {
         // Handle validation errors
         $error_message = "Please fill in the required fields: " . implode(',' ,$error); // Combine errors into a single message
         $session->msg("ERROR", $error_message); // Use session message with error message
     }
 
     // Redirect to the appropriate page (consider using a flash message for one-time display)
     redirect('add_customer.php'); // Adjust redirection logic as needed
 }
 
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Customer</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          
          <form method="post" action="add_customer.php">
         
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <input type="text" class="form-control" name="address" placeholder="Shipping Address ">
            </div>
            <div class="form-group">
                <label for="order">Order #</label>
                <input type="text" class="form-control" name="order_no" placeholder="Order Number  ">
            </div>
            <div class="form-group">
                <label for="contact">Contact #</label>
                <input type="text" class="form-control" name="contact" placeholder="Contact Number  ">
            </div>
            <div class="form-group">
                <label for="contact"> Email Address</label>
                <input type="text" class="form-control" name="email" placeholder="Email Address  ">
            </div>
           
            <div class="form-group">
              <button type="submit" name="add_customer" class="btn btn-primary">Add Customer</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>