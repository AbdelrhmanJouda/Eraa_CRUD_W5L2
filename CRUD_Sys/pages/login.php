<?php 
include "../include/header.php";

if(isset($_SESSION['logedin'])){
    header("location:../pages/home.php");
}
?>
<h1>Login page</h1>



<div class="container">
         <div class="col-8 ms-auto d-flex flex-wrap">
                        <!-- msg -->
  <?php  msgSeesion('success');?>
  <?php  msgSeesion('danger');?>
  <!-- end msg -->
          </div>
    <div class="row">
        <div class="col-4 mx-auto border rounded pt-2">

            <form   method="post" action="<?php echo BASE_URL."validations/loginHandle.php" ?>">

                <div class="mb-3">
                    <label  class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" >
                </div>
                <div class="mb-3">
                    <label  class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" >
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>







<?php include "../include/footer.php"; ?>