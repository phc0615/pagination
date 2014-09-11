<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Pagination</title>
</head>
<body>
<h3>Pagination - Show Products</h3>
<div class="show_products"> Show <a href="?limit=3">3</a> <a href="?limit=6">6</a> <a href="?limit=10">10</a> items</div>
<?php 
    include_once('connect.php');
    if(isset($_GET['limit'])) {
       $per_page = $_GET['limit'];
    }else {
    $per_page = 6; 
    }
    //calculate the num of products
    $pages_query =mysql_query("SELECT COUNT(id) FROM products"); 
    //total num of pages = total products / num of products per page
    $pages = ceil(mysql_result($pages_query,0) / $per_page);
    //URL setting, button click get page , presents the page clicked, or show page 1 
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    //product start from product 0 , if click page "2" products start from product 6 
    $start  = ($page - 1) * $per_page;
    //prev and next
    $prev = $page - 1;
    $next = $page + 1;
    //present products, start from 0($start), and 6(num of) products per page($per_page)
    $query = "SELECT name FROM products LIMIT $start, $per_page";
    $result = mysql_query($query);
    if(mysql_num_rows($result) > 0) {
      while($row = mysql_fetch_assoc($result)) {
                            echo $row['name']."<br/>";
            }
    }
    //if page exist, show pagination below
    if($pages >= 1) {
            if(!($page<=1)) { //page > 1 的時候才有 prev 
            echo '<a href="?limit='.$per_page.'&page='.$prev.'">Prev</a> ';
            }
    for($x=1;$x<=$pages;$x++) {
            //echo '<a href="?page='.$x.'">'.$x.'</a> ';
            if($x == $page) {
                    echo '<b><a href="?limit='.$per_page.'&page='.$x.'">'.$x.'</a></b> ';
            } else {
     echo '<a href="?limit='.$per_page.'&page='.$x.'">'.$x.'</a> ';
    }
    } // end for
    if(!($page >= $pages)) {
    echo '<a href="?limit='.$per_page.'&page='.$next.'">Next</a>';     
    }
    } // end if
    ?>
</body>
</html>
