<?php

include 'config.php';
 $search=basename($_SERVER['PHP_SELF']);
switch($search){
case "single.php":
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="select * from post where post_id={$id}";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        $title=$row['title'];
    }
    else{
       $title="result not found"." news"; 
    echo $title;
    }
    break;

case "author.php":
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="select * from user where user_id={$id}";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        $title=$row['first_name']." ".$row['last_name'];
    }
    else{
        
       $title="result not found"." news"; 
       echo $title;
    }
    break;

case"category.php":
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="select * from category where category_id={$id}";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        $title=$row['category_name'];
    }
    else{
        
       $title="result not found"." news"; 
       echo $title;
    }
    break;

case "search.php":
    if(isset($_GET['search'])){
        $search=$_GET['search'];
       
        $title=$search;
    }
    else{
        
       $title="result not found"." news"; 
       echo $title;
    }
    break;

default:
$title="news-site";
 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News | <?php echo $title;?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <?php 
                    $sql="select * from setting";
                    $result=mysqli_query($con,$sql);
                    $row=mysqli_fetch_assoc($result);
                    ?>
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="admin/images/<?php echo $row['website_img'];?>"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                if(isset($_GET['id'])){
                $id=$_GET['id'];
                }
                include 'config.php';
                $sql="select * from category where post > 0";
                $result=mysqli_query($con,$sql);
                if(mysqli_num_rows($result)>0){
                    echo"<ul class='menu'>
                    <li><a href='index.php'>All</a></li>";
                    
                       
                    while($row=mysqli_fetch_assoc($result)){
                    $active='';    
                    if(isset($_GET['id'])){
                        if($row['category_id']==$id){
                            $active='active';

                        }
                        else{
                            $active='';
                        }
                    }
                   
                        echo"<li><a class='{$active}' href='category.php?id={$row['category_id']}'>{$row['category_name']}</a></li>";
                        
                    }
                    echo"   </ul>";
                }
                ?>
               
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
