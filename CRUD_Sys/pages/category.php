<?php 
include "../include/header.php";
include "../database/conn.php";
$newConn = newConn(DataBaseName);
$result = GetCats($newConn);

?>
<h1>Category page</h1>



<div class="container">
         <div class="col-12 ms-auto d-flex flex-wrap">
                        <!-- msg -->
  <?php  msgSeesion('success');?>
  <!-- end msg -->
          </div>
    <div class="row">
      <div class="col-12 mx-auto border rounded pt-2">
          <a class="btn btn-primary" href="addcategory.php">add Category</a>
            <h1>Categories</h1>
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Details</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; while($row= mysqli_fetch_assoc($result)): ?>
    <tr>
      <th scope="row"><?=$i++;?></th>
      <td><?=$row['name']?></td>
      <td><?=$row['details']?></td>
      <td>
        <a class="btn btn-success" href="editCat.php?id=<?=$row['id'];?>&name=<?=$row['name']?>&details=<?=$row['details']?>">Edit</a> 
        </td>
      <td>
        <a class="btn btn-danger" href="../validations/deleteCat.php?id=<?=$row['id'];?>">Delete</a> 
        </td>
      </tr>
      <?php endwhile; ?>

  </tbody>
</table>
        </div>
    </div>
</div>







<?php include "../include/footer.php"; ?>