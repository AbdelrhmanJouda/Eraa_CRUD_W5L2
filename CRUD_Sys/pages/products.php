<?php 
include "../include/header.php";
include "../database/conn.php";
$newConn = newConn(DataBaseName);


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
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>

  </tbody>
</table>
        </div>
    </div>
</div>







<?php include "../include/footer.php"; ?>