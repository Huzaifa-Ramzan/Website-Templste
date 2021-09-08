
<?php 
include 'config.php';
if(empty($_FILES['new_image']['name'])){
$new_file_name=$_POST['img'];

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
        $target='images/'.$new_file_name;
        
        move_uploaded_file($tmp_name,$target);
        
$sql1="select * from setting ";
$result1=mysqli_query($con,$sql1) or die('not run 1');
    $row1=mysqli_fetch_assoc($result1);
    
        
    unlink('images/'.$row1['website_img']);
    }
    else{
        print_r($error);
        die();
    }

}


if(isset($_POST['submit'])){  
   
    $title=$_POST['website_title'];
    $desc=$_POST['website_desc'];
 
    $sql2="UPDATE setting set website_title='{$title}',websie_desc='{$desc}',website_img='{$new_file_name}' where id=1";
    
   
     if(mysqli_multi_query($con,$sql2))
     {
         
     header("Location:{$host}/admin/post.php");
     
    }
}
?>