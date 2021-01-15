<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Pagination</title>
</head>
<body>
	<h3>Pagination</h3>
	<?php
include_once 'connect.php';
$per_page = 6;
//calculate the num of products
$pages_query = mysql_query("SELECT COUNT(id) FROM products");
//total num of pages = total products / num of products per page
$pages = ceil(mysql_result($pages_query, 0) / $per_page);
//URL setting, button click get page , presents the page clicked, or show page 1
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
//product start from product 0 , if click page "2" products start from product 6
$start = ($page - 1) * $per_page;
//prev and next
$prev = $page - 1;
$next = $page + 1;
//present products, start from 0($start), and 6(num of) products per page($per_page)
$query = "SELECT name FROM products LIMIT $start, $per_page";
$result = mysql_query($query);
if (mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_assoc($result)) {
        echo $row['name'] . "<br/>";
    }
}
echo "<br/>";
//if more than 1 page, show pagination below
if ($pages >= 1) {
    if (!($page <= 1)) {
        //page > 1 has prev
        echo '<a href="?page=' . $prev . '">Prev</a> ';
    }

    for ($x = 1; $x <= $pages; $x++) {
//echo '<a href="?page='.$x.'">'.$x.'</a> ';
        if ($x == $page) {
            echo '<b><a href="?page=' . $x . '">' . $x . '</a></b> ';
        } else {
            echo '<a href="?page=' . $x . '">' . $x . '</a>';
        }
    } // end for
    if (!($page >= $pages)) {
        echo '<a href="?page=' . $next . '">Next</a> ';
    }
    echo "</ul>";
}
; // end if
?>
<br/><br/>
<footer>Copyright &copy 2014. All Rights Reserved.</footer>
</body>
</html>