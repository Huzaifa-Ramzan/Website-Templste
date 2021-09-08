<?php 
include 'config.php';
if(empty($_FILES['new_image']['name'])){
$new_file_name=$_POST['old_image'];

}
else{
    $error=[];
    $name=$_FILES['new_image']['name'];
    $size=$_FILES['new_image']['size'];
    $tmp_name=$_FILES['new_image']['tmp_name'];
    $type=$_FILES['new_image']['type'];
    $txt=end(explode('.',$name));
    $ext=strtolower($txt);
    $extension=['jpg','png','jpeg'];
    if(in_array($ext,$extension)===false){
        $error='chose file with extension png,jpg,jpeg';
    }
    if($size>2097152){
        $error='image size is greater then 2mb';
    }
    if(empty($error)==true){ 
        
        $img_name=time().'-'.$name;
        $new_file_name=$img_name;
        $target='upload/'.$new_file_name;
        
        move_uploaded_file($tmp_name,$target);
    }
    else{
        print_r($error);
        die();
    }

}


if(isset($_POST['submit'])){  
    $id2=$_POST['post_id'];
    $title=$_POST['post_title'];
    $desc=$_POST['postdesc'];
    $cat=$_POST['category'];
    $old_cat=$_POST['old_cat'];
    $sql2="UPDATE post set title='{$title}',description='{$desc}',category={$cat},post_img='{$new_file_name}'
    where post_id={$id2};";
     if($old_cat!=$cat){
    
     $sql2.="update category set  post=post - 1 where category_id={$old_cat};";
     $sql2.="update category set  post=post + 1 where category_id={$cat};";
     }
   
     if(mysqli_multi_query($con,$sql2))
     {
         
     header("Location:{$host}/admin/post.php");
     
    }
}
?>