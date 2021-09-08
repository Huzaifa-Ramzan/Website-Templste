<!-- Footer -->
<?php 
if($_SESSION['role']=='0'){
    header("Location:http://localhost/news-template/admin/post.php");
    
}
?>
<div id ="footer">
    <div class="container">
        <div class="row">
            <?php 
            include 'config.php';
            $sql="select * from setting";
            $result=mysqli_query($con,$sql);
            $row=mysqli_fetch_assoc($result);
            ?>
            <div class="col-md-12">
                <span><?php echo $row['websie_desc']?> <a href="http://yahoobaba.net/">Yahoo Baba</a></span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
