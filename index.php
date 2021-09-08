<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php 
                       include 'config.php';
                       
                       if(isset($_GET['page'])){
                        $page=$_GET['page'];
                        }
                        else{
                            $page=1;
                        }
                       $limit=3;
                       $offset=($page - 1) * $limit;
                       
                       $sql="SELECT * from post 
                       left join category on category = category_id 
                       left join user on author=user_id 
                       order by post_id desc
                       limit {$offset},{$limit}";
                           
                       $result=mysqli_query($con,$sql)or die ('not run');
                       if(mysqli_num_rows($result)>0){
                    ?>
                    <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content">
                        <?php 
                                 
                                 while($row=mysqli_fetch_assoc($result)){
                             
                             ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?id=<?php echo $row['category_id'];?>'><?php echo $row['category_name'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href="author.php?id=<?php echo$row['author'];?>"><?php echo $row['username'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'];?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,170).'....';?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                                    </div>
                                  
                                </div>
                            </div>
                            <?php 
                                    }
                                    ?>
                        </div>
                      <?php 
                                        
                                    } 
                                    $sql1='select * from post';
                                    $result1=mysqli_query($con,$sql1);
                                    if(mysqli_num_rows($result1)>0){
                                        $total_records=mysqli_num_rows($result1);
                                     
                                        $total_pages=ceil($total_records/$limit);
                                        echo"<ul class='pagination admin-pagination'>";
                                        if($page>1){
                                          echo'<li><a href="index.php?page='.($page-1).'">prev</a></li>';
                                      }
                                          for($i=1;$i<$total_pages;$i++){
                                              if($i==$page){
                                                  $active='active';
                                              } 
                                              else{
                                                  $active='';
                                              }
                                              echo'<li class="'.$active.'"><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                                          
                                           }
                                      if($page<$total_pages){
                                          echo'<li><a href="index.php?page='.($page+1).'">next</a></li>';
                                      }
                                  }
                  
                      ?>
                        
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>