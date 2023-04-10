<?php 
include "../include/header.php";
include "../database/conn.php";
$newConn = newConn(DataBaseName);
$result = GetUsers($newConn);

?>
<h1>Users page</h1>



<div class="container">
    <div class="row">
        <div class="col-12 mx-auto border rounded pt-2">
                 <!-- msg -->
                 <?php  msgSeesion('success'); ?>
                        <!-- end msg -->
            <h1>Users</h1>
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th >Name</th>
      <th >Email</th>
      <th >Edit</th>
      <th >Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <?php $i=1; while($row = mysqli_fetch_assoc($result)): ?>    
      <th scope="row"><?=$i++?></th>
      <td ><?=$row['id']?></td>
      <td ><?=$row['name']?></td>
      <td ><?=$row['email']?></td>
      <td>
        <a class="btn btn-success" href="editUser.php?id=<?=$row['id'];?>&email=<?=$row['email']?>&name=<?=$row['name']?>">Edit</a> 
        </td>
      <td>
        <a class="btn btn-danger" href="../validations/deleteUser.php?email=<?=$row['email'];?>">Delete</a> 
        </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
        </div>
    </div>
</div>







<?php include "../include/footer.php"; ?>