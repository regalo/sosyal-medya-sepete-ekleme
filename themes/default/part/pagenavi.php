<?php
echo "<ul class=\"pagination\">";
if($page>1){
    echo "<li><a id='pk_refresh' href='".$pageurl."' title='İlk sayfaya git'>";
        echo "İlk Sayfa";
    echo "</a></li>";
}
$total_pages = ceil($total_rows / $per_page);
$range = 2;
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;
 
for ($x=$initial_num; $x<$condition_limit_num; $x++) {
    if (($x > 0) && ($x <= $total_pages)) {
        if ($x == $page) {
            echo "<li class='active'><a href=\"javascript:void(0)\">$x <span class=\"sr-only\">(current)</span></a></li>";
        }
        else {
            echo "<li><a id='pk_refresh' href='".$pageurl."$x/'>$x</a></li>";
        }
    }
}
if($page<$total_pages){
    echo "<li><a id='pk_refresh' href='".$pageurl."{$total_pages}/' title='{$total_pages}. Sayfaya git'>";
        echo "Son Sayfa";
    echo "</a></li>";
}
 
echo "</ul>";
?>