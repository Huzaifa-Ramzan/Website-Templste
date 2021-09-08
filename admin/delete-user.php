<?php 
if($_SESSION['role']=='0'){
    header("Location:http://localhost/news-template/admin/post.php");
    
}
$del=$_GET['id'];
include 'config.php';
$sql="delete  from user where user_id='{$del}'";
mysqli_query($con,$sql) or die('not run');
header('Location: http://localhost/news-template/admin/users.php');
mysqli_close($con);
?>