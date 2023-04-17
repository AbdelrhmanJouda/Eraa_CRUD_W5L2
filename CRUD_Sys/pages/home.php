<?php 
include "../include/header.php";
?>
<h1>home page</h1>



<div class="container">
         <div class="col-8 ms-auto d-flex flex-wrap">
                        <!-- msg -->
            <?php  msgSeesion('success'); ?>
                        <!-- end msg -->
          </div>
    <div class="row">
        <div class="col-4 mx-auto border rounded pt-2">
            <h1>welcome <?=UserName('user')['name'];?></h1>
           
        </div>
    </div>
</div>






<?php include "../include/footer.php"; ?>