<?php 

$del=$_GET['id'];
$cid=$_GET['cid'];
include 'config.php';
$sql1="select * from post where post_id={$del}";
$result=mysqli_query($con,$sql1) or die('not run 1');
    $row=mysqli_fetch_assoc($result);
    unlink('upload/'.$row['post_img']);


$sql="delete  from post where post_id='{$del}';";
$sql.="update category set  post=post-1 where category_id={$cid}";

mysqli_multi_query($con,$sql) or die('not run');
header('Location: http://localhost/news-template/admin/post.php');
mysqli_close($con);

?>