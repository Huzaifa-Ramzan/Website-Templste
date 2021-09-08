<?php include "header.php"; 
 include 'config.php';   


?>
<?php 
    ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading text-center"><b>Settings</b></h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
    <?php 
    $sql="select * from setting";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);

        
    }
        ?>
        <!-- Form for show edit-->
        <form action="save-update-setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
          
            <div class="form-group">
                <label for="exampleInputTile">website_title</label>
                <input type="text" name="website_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['website_title'];?>">
            </div>
           
         
          
            <div class="form-group">
                <label for="">Logo</label>
                <input type="file" name="new_image">
                <img  src="images/<?php echo $row['website_img'];?>" height="150px">
                <input type="hidden" name="img" value="<?php echo $row['website_img'];?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="website_desc" class="form-control"  required rows="5">
                <?php echo $row['websie_desc'];?>
                </textarea>
            </div>


            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php 
                  
              
                 
                  ?>

        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
