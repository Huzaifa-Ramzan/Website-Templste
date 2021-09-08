<?php include "header.php";if($_SESSION['role']=='0'){
    header("Location:http://localhost/news-template/admin/post.php");

    
}
?>
<?php

if(isset($_POST['submit'])){
                          
    include 'config.php';
    
      $id1=$_POST['category_id'];
    $cat=$_POST['category_name'];
      $sql1="update from category set category_name='{$cat}' where category_id='{$id1}'";
    
        if($result=mysqli_query($con,$sql1)){
            header("Location:{$host}/admin/category.php");
        }
    }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <?php 
                  include 'config.php';
                  $id=$_GET['id'];
                  $sql="select * from category where category_id='{$id}'";
                  $result=mysqli_query($con,$sql) or die('not run');
                  if (mysqli_num_rows($result)>0){
                      while($row=mysqli_fetch_assoc($result)){
                  ?>
                  <form action="<?php $_SERVER['PHP_SELF'];?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="category_id"  class="form-control" value="<?php $row['category_id'];?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" value="<?php  echo $row['category_name'];?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php 
                      }
                      }
                      
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
