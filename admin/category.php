<?php include "header.php"; 
if($_SESSION['role']=='0'){
    header("Location:http://localhost/news-template/admin/post.php");
    
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php 
                        include 'config.php';
                        
                        $limit=3;
                        if(isset($_GET['page']))
                        {

                        $page_no=$_GET['page'];
                         }
                        else{
                            $page_no=1;

                        }
                        $offset=($page_no-1)*$limit;
                        $sql="SELECT * FROM category ORDER BY category_id DESC
                         LIMIT {$offset},{$limit}";
                        $result=mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)>0){
                            $s_no=$offset+1;
                            while($row=mysqli_fetch_assoc($result)){
                                
                        ?>
                        <tr>
                            <td class='id'><?php echo $s_no;?></td>
                            <td><?php echo$row['category_name'];?></td>
                            <td><?php echo $row['post'];?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id'];?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php 
                    $s_no++;    
                    }
                        }
                        ?>
                    </tbody>
                </table>
                    <ul class='pagination admin-pagination'>
                    
                    <?php 
                    include 'config.php';
                    $sql1='select * from category';
                    $result1=mysqli_query($con,$sql1);
                    if($page_no>1){
                        echo'<li><a href="category.php?page='.($page_no-1).'">prev</a></li>';
                    }
                    if (mysqli_num_rows($result1)>0){
                        $total_records=mysqli_num_rows($result1);
                        
                        $total_pages=ceil($total_records/$limit);
                        for($i=1;$i<=$total_pages;$i++){
                            if($i==$page_no){
                                $active='active';
                            } 
                            else{
                                $active='';
                            }
                            echo'<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                        }
                    }
                    if($page_no<$total_pages){
                        echo'<li><a href="category.php?page='.($page_no+1).'">next</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
