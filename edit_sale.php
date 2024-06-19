<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sale = find_by_id('sales',(int)$_GET['id']);
if(!$sale){
  $session->msg("d","Missing product id.");
  redirect('sales.php');
}
?>
<?php $product = find_by_id('products',$sale['product_id']); ?>
<?php

  if(isset($_POST['update_sale'])){
    $req_fields = array('sku','quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$product['id']);
          $sku   = $db->escape($_POST['sku']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = date("Y-m-d", strtotime($date));

          $sql  = "UPDATE sales SET";
          $sql .= " product_id= '{$p_id}',sku='{$sku}',qty={$s_qty},price='{$s_total}',date='{$s_date}'";
          $sql .= " WHERE id ='{$sale['id']}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                    update_product_qty($s_qty,$p_id,$sku);
                    $session->msg('s',"Updated Successfully.");
                    redirect('sales.php?id='.$sale['id'], false);
                  } else {
                    $session->msg('d',' Update Failed');
                    redirect('sales.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('edit_sale.php?id='.(int)$sale['id'],false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
  <div class="panel">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>All Sales</span>
     </strong>
     <div class="pull-right">
       <a href="sales.php" class="btn btn-primary">SHOW ALL ORDERS</a>
     </div>
    </div>
    <div class="panel-body">
       <table class="table table-bordered">
         <thead>
          <th class="text-center" > Product Name </th>
          <th class="text-center" style="width: 10%;"> SKU </th>
          <th class="text-center" style="width: 10%;"> Qty </th>
          <th class="text-center" style="width: 10%;"> Price </th>
          <th class="text-center" style="width: 10%;"> Total </th>
          <th class="text-center" style="width: 10%;"> Date</th>
          <th class="text-center"> Action</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
                <td id="s_name" class="text-center">            
                 <input type="text" class="form-control text-center"  name="name" value="<?php echo $product['name']; ?>">
                </td>
                <td id="sku" class="text-center">               
                 <input type="text" class="form-control text-center"  name="sku" value="<?php echo $product['sku']; ?>">
                </td>
                <td id="s_qty" >
                  <input type="text" class="form-control text-center"  name="quantity" value="<?php echo (int)$sale['qty']; ?>">
                </td>
                <td id="s_price">
                  <input type="text" class="form-control text-center" name="price" value="<?php echo remove_junk($product['sale_price']); ?>" >
                </td>
                <td>
                  <input type="text" class="form-control text-center" name="total" value="<?php echo remove_junk($sale['price']); ?>">
                </td>
                <td id="s_date">
                  <input type="date" class="form-control text-center" name="date" data-date-format="" value="<?php echo remove_junk($sale['date']); ?>">
                </td>
                <td>
                  <div class="text-center"><button type="submit" name="update_sale" class="btn btn-primary">Update sale</button></div>
                </td>
              </form>
              </tr>
           </tbody>
       </table>

    </div>
  </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
