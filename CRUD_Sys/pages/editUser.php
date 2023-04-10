<?php
include  "../include/header.php";
var_dump($_SESSION);

if(isset($_GET['name']) ){
    $name=$_GET['name'];
    $id=$_GET['id'];
}else{
    redirect('home.php');
}


?>



<h1>Edit user page</h1>

<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <!-- msg -->
            <div class="col-8 mx-auto text-center d-flex flex-wrap">
                <?php  msgSeesion('danger');?>
            </div>
            <!-- end msg -->

            <form   method="post" action="<?php echo BASE_URL."validations/editUser.php?id=$id" ?>">

                <div class="mb-3">
                    <label  class="form-label">Name</label>
                    <input type="text" name="name" value="<?= $name ?>" class="form-control" >
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