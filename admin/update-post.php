<?php include "header.php"; 
 include 'config.php';   
 
 if($_SESSION['role']==0){
     $id=$_GET['id'];
$sql2="select *from post where post_id={$id}";
$result2=mysqli_query($con,$sql2);
$row2=mysqli_fetch_assoc($result2);
if($_SESSION['user_id']!=$row2['author']){
    header("Location:{$host}/admin/post.php");
}
 }

?>
<?php 
 if(isset($_POST['submit'])){
    
    $id=mysqli_real_escape_string($con,$_POST['post_id']);
    $title=mysqli_real_escape_string($con,$_POST['post_title']);
    $dec=mysqli_real_escape_string($con,$_POST['postdesc']);
    $cat=mysqli_real_escape_string($con,$_POST['category']);
    $img=mysqli_real_escape_string($con,$_POST['new-image']);
    $sql1="update post set title='{$title}',description='{$dec}',category='{$cat}',post_img='{$img}' where post_id='{$id}'";
    
    if( $result=mysqli_query($con,$sql1)){
       
    header("Location:{$host}/admin/post.php");
        }
    }?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
    <?php 

        $id=$_GET['id'];
      
        $sql="select * from post where post_id='{$id}'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
        ?>
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id'];?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title'];?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $row['description'];?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <?php 
                $sql1="select * from category";
                $result1=mysqli_query($con,$sql1);
                if(mysqli_num_rows($result1)>0){
                    echo'<select class="form-control" name="category"> 
                    <option value="" disabled> Select Category</option>';
                    while($row1=mysqli_fetch_assoc($result1)){
                        if($row['category']==$row1['category_id']){
                            $select='selected';
                        }
                        else{
                            $select='';
                        }
                        
                        echo"<option {$select} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                    }
                    echo'</select>';
                }
                   
                ?>
                 <input type='hidden' name='old_cat' value="<?php echo $row['category'];?>">

            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new_image">
                <img  src="upload/<?php echo $row['post_img'];?>" height="150px">
                <input type="hidden" name="old_image" value="<?php echo $row['post_img'];?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php }
                  }
              
                 
                  ?>

        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
