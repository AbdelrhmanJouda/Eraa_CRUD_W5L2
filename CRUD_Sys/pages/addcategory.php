<?php
include  "../include/header.php";
if(!isset($_SESSION['logedin'])){
    redirect('../index.php');
}elseif(!isset($_SERVER['HTTP_REFERER'])){
    redirect('../index.php');
}
?>

<h1>Add Category page</h1>
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <!-- msg -->
            <div class="col-8 mx-auto text-center d-flex flex-wrap">
                <?php  msgSeesion('danger');?>
            </div>
            <!-- end msg -->

            <form   method="post" action="<?php echo BASE_URL."validations/catHandle.php" ?>">
                <div class="mb-3">
                    <label  class="form-label">Category Name</label>
                    <input type="text" name="name" value="<?php if(isset($_GET['name'])): echo $_GET['name']; endif;  ?>" class="form-control" >
                </div>
                <div class="mb-3">
                    <label  class="form-label">Details</label>
                    <textarea type="textarea" name="details" value="<?php if(isset($_GET['details'])): echo $_GET['details']; endif; ?>" class="form-control" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
        </div>
    </div>
</div>


<?php include  "../include/footer.php"; ?>