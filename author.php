<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                
                $aid=$_GET['id'];
                  
                include 'config.php';
                
                $sql="SELECT * from post 
                left join user on author=user_id
                where user_id={$aid}";
                
                $result=mysqli_query($con,$sql) or die('not run');
                mysqli_num_rows($result);
                  $row=mysqli_fetch_assoc($result);

                ?>
                <div class="post-container">
                  <h2 class="page-heading"><?php echo $row['username'];?></h2>
                  <?php 
                  if(isset($_GET['page'])){
                  $page=$_GET['page'];
                  }
                  else{
                      $page=1;
                  }
                  $limit=3;
                  $offset=($page-1)*$limit;
                  $sql="SELECT * from post 
                  left join user on author=user_id
                  left join category on category=category_id
                  where user_id={$aid}
                  order by post_id desc
                  limit {$offset},{$limit}";
                  
                  $result1=mysqli_query($con,$sql) or die('not run');
                  if (mysqli_num_rows($result1)>0){
                    while($row1=mysqli_fetch_assoc($result1)){
                        
                  ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row1['post_id'];?>"><img src="admin/upload/<?php echo$row1['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row1['post_id'];?>'><?php echo$row1['title'];?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href="category.php?id=<?php echo $row1['category_id'];?>"><?php echo$row1['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?id=<?php echo $row1['author'];?>'><?php echo $row1['username'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row1['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo $row1['description'];?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row1['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                  }
                  if(mysqli_num_rows($result)){
                    $total_records=mysqli_num_rows($result);
                   
                    $total_pages=ceil($total_records/$limit);
                    echo"<ul class='pagination'>";
                    if($page>1){
                        
                        echo'<li ><a href="author.php?id='.$aid.'& page='.($page-1).'">prev</a></li>';
    
                    }
                    for($i=1;$i<=$total_pages;$i++){
                        if($i==$page){
                            $active="active";
                        }
                        else{
                            $active='';
                        }
                        echo'<li class="'.$active.'"><a href="author.php?id='.$aid.'&page='.$i.'">'.$i.'</a></li>';
                      
                    }
                    if($page<$total_pages){
                        echo'<li ><a href="author.php?id='.$aid.'& page='.($page+1).'">next</a></li>';
    
                    }
                    echo"  </ul>";
                }
                ?>
                  
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
