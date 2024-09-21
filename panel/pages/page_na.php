<?php
$total_pages = ceil($total_rows / $records_per_page);
if ($total_pages>1) {
	echo '<div class="nexto">';
	if($page>2){
		if (isset($ayar->action))
	    echo '<a href="'.$ayar->getpage($ayar->page,$ayar->action).'?p='.($page-1).'"><i id="before" class="fa fa-chevron-circle-left"></i></a>';
	    else
	    	echo '<a href="'.$ayar->getpage($ayar->page).'?p='.($page-1).'"><i id="before" class="fa fa-chevron-circle-left"></i></a>';
	} elseif($page>1){
		if (isset($ayar->action))
	    echo '<a href="'.$ayar->getpage($ayar->page,$ayar->action).'"><i id="before" class="fa fa-chevron-circle-left"></i></a>';
	    else
	    	echo '<a href="'.$ayar->getpage($ayar->page).'"><i id="before" class="fa fa-chevron-circle-left"></i></a>';
	}

	if($page<$total_pages){
		if (isset($ayar->action))
			echo '<a href="'.$ayar->getpage($ayar->page,$ayar->action).'?p='.($page+1).'"><i id="next" class="fa fa-chevron-circle-right"></i></a>';
			else 
				echo '<a href="'.$ayar->getpage($ayar->page).'?p='.($page+1).'"><i id="next" class="fa fa-chevron-circle-right"></i></a>';
	}
	echo "</div>";
}
?>