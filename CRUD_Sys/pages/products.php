<?php 
include "../include/header.php";
include "../database/conn.php";
$newConn = newConn(DataBaseName);
$result = GetPros($newConn);

?>
<h1>Products page</h1>



<div class="container">
         <div class="col-12 ms-auto d-flex flex-wrap">
                        <!-- msg -->
  <?php  msgSeesion('success');?>
  <!-- end msg -->
          </div>
    <div class="row">
      <div class="col-12 mx-auto border rounded pt-2">
          <a class="btn btn-primary" href="addProduct.php">add product</a>
            <h1>products</h1>
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Cat</th>
      <th scope="col">By</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php $i=1; while($row = mysqli_fetch_assoc($result)) ?>
      <th scope="row">1</th>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['price'] ?></td>
      <td><?= $row['category'] ?></td>
    
    </tr>

  </tbody>
</table>
        </div>
    </div>
</div>


<?php include "../include/footer.php"; ?>