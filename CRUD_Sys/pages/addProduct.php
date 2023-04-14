<?php
include  "../include/header.php";
include "../database/conn.php";
if(!isset($_SESSION['logedin'])){
    redirect('../index.php');
}elseif(!isset($_SERVER['HTTP_REFERER'])){
    redirect('../index.php');
}
$NewConn = newConn(DataBaseName);
$result = GetCats($NewConn);
?>



<h1>add Product page</h1>

<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <!-- msg -->
            <div class="col-8 mx-auto text-center d-flex flex-wrap">
                <?php  msgSeesion('danger');?>
            </div>
            <!-- end msg -->

            <form   method="post" action="<?php echo BASE_URL."validations/productHandle.php" ?>">

                <div class="mb-3">
                    <label  class="form-label">Name</label>
                    <input type="text" name="name" value="<?php if(isset($_GET['name'])): echo $_GET['name'];  endif; ?>" class="form-control" >
                </div>
                <div class="mb-3">
                    <label  class="form-label">price</label>
                    <input type="text" name="price" value="<?php if(isset($_GET['price'])): echo $_GET['price']; endif; ?>" class="form-control" >
                </div>
                <div class="mb-3">
                    <label  class="form-label">stock</label>
                    <input type="text" name="stock" value="<?php if(isset($_GET['price'])): echo $_GET['price']; endif; ?>" class="form-control" >
                </div>
                <div class="mb-3">
                    <label  class="form-label">category</label>
                    <select type="select" name="category" class="form-control" >
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>    
                    <option value="<?= $row['name'] ?>"><?= $row['name']?></option>
                    <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label  class="form-label">added by</label>
                    <select type="select" name="user" class="form-control" >
                        <option value="<?= UserName('user') ?>"><?= UserName('user') ?></option>
                    </select>
                </div>
                             
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>


<?php include  "../include/footer.php"; ?>