<?php 
include'config.php';

if(isset($_FILES['fileToUpload'])){
    $errors=array();
    $file_name=$_FILES['fileToUpload']['name'];
    $file_size=$_FILES['fileToUpload']['size'];
    $file_tmp=$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
    $txt=end(explode(".",$file_name));
    $file_ext=strtolower($txt);
    $extansion=['jpg','png','jpeg'];
    if(in_array($file_ext,$extansion)===false){
        $errors[]='please chose jpg, jpeg or png';
    }
    if($file_size > 2097152){
    $errors[]='file size is greater then 2MB';
    }
    if(empty($errors)==true){
        $img_name=time().'-'.$file_name;
        $new_file_name=$img_name;
        $target='upload/'.$new_file_name;
        move_uploaded_file($file_tmp,$target);
    }else{
        
    print_r($errors);
    die();
    }
    }
    
$title=mysqli_real_escape_string($con,$_POST['post_title']);
$dec=mysqli_real_escape_string($con,$_POST['postdesc']);
$cat=mysqli_real_escape_string($con,$_POST['category']);
$date=date('d M,Y');
session_start();
$author=$_SESSION['user_id'];

$sql="insert into post(title,description,category,post_date,author,post_img)
values('{$title}','{$dec}',{$cat},'{$date}',{$author},'{$new_file_name}');";
$sql.="update category set post=post+1 where category_id='{$cat}'";
if(mysqli_multi_query($con,$sql)){
    
    header("Location:http://localhost/news-template/admin/post.php");
}
else{
    echo"<div class='alter alter-danger'>query failed</div>";
}

?>