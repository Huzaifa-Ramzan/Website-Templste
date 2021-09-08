<?php 
include 'config.php';

$id=$_GET['id'];
$sql="delete from category where category_id='{$id}'";
if(mysqli_query($con,$sql)){
 
header("Location:{$host}/admin/category.php");
}

mysqli_close($con);
?>