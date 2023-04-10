<?php
include  "../include/header.php";
if(isset($_SESSION['logedin'])){
    redirect('../index.php');
}
?>



<h1>Registeraion page</h1>

<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <!-- msg -->
            <div class="col-8 mx-auto text-center d-flex flex-wrap">
                <?php  msgSeesion('danger');?>
            </div>
            <!-- end msg -->

            <form   method="post" action="<?php echo BASE_URL."validations/regHandle.php" ?>">

                <div class="mb-3">
                    <label  class="form-label">Name</label>
                    <input type="text" name="name" value="<?php if(isset($_SESSION['old'])): echo $_SESSION['old'][0];  endif; ?>" class="form-control" >
                </div>
                <div class="mb-3">
                    <label  class="form-label">Email</label>
                    <input type="text" name="email" value="<?php if(isset($_SESSION['old'])): echo $_SESSION['old'][1]; unset($_SESSION['old']); endif; ?>" class="form-control" >
                </div>
                <div class="mb-3">
                    <label  class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" >
                </div>
                <div class="mb-3">
                    <label  class="form-label">Confirm password</label>
                    <input type="text" name="Conf_password" class="form-control" >
                </div>
              
                
               
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>



        </div>
    </div>
</div>


<?php include  "../include/footer.php"; ?>