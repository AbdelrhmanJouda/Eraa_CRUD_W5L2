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
      <div class="col mx-auto border rounded pt-2">
          <a class="btn btn-primary" href="addProduct.php">add product</a>
            <h1>products</h1>
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Stock</th>
      <th scope="col">Cat id</th>
      <th scope="col">user id</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php $i=1; while($row = mysqli_fetch_assoc($result)): ?>
      <th scope="row"><?=$i++?></th>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['price'] ?></td>
      <td><?= $row['stock'] ?></td>
      <td><?= $row['category_id'] ?></td>
      <td><?= $row['user_id'] ?></td>
      
      <td>
        <a class="btn btn-danger" href="../validations/deletePro.php?id=<?=$row['id'];?>">Delete</a> 
        </td>
      </tr>
    
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
        </div>
    </div>
</div>


<?php include "../include/footer.php"; ?>