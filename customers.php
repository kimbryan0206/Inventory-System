<?php
  $page_title = 'Customers';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 page_require_level(3);
//pull out all user form database
 $all_customers = find_all_customers();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Customers</span>
       </strong>
         <a href="add_customer.php" class="btn btn-info pull-right">Add New Customer</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
          
            <th>Full Name </th>
            <th class="text-center" style="width: 15%;">Order #</th>

            <th class="text-center" style="width: 90px;">Action </th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_customers as $customers): ?>
          <tr class="customer-dash">
           <td><?php echo($customers['name'])?></td>
           <td class="text-center"><?php echo($customers['order_no'])?></td>
           <td>
           <div class="btn-group">
                      <a href="view_customer.php?id=<?php echo (int)$customers['id'];?>" class="btn btn-warning btn-xs"  title="View" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-eye-open"></span>
                       </a>
                       <a href="edit_customer.php?id=<?php echo (int)$customers['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                      <i class="glyphicon glyphicon-pencil"></i>
                       </a>
                       <a href="delete_customer.php?id=<?php echo (int)$customers['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
           </td>
        
        
       
          

          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
