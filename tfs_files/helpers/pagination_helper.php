<?php
	function hasan(){
	return "asdasasd";
	}
	function generatePagination($module, $currPage, $numOfPages, $rpp=25, $adjacents=3) {
		
		
	
		$pagination = '<ul id="pagination-clean">';
        
		//First Page Link
		if($currPage == 1){
    		$pagination .= '<li class="previous-off">Start</li>';
    	}else{
    		$pagination .= '<li class="active"><a href="'.site_url("$module/1").'">Start</a></li>';
    	}
		
		//Previous Page Link
    	if($currPage > 1){
    		$pagination .= '<li class="active"><a href="'.site_url("$module/".($currPage-1)).'">&lt; Previous</a></li>';
    	}else{
    		$pagination .= '<li class="previous-off">&lt; Previous</li>';
    	}
		
		//Numbered Page Links
		/*for($i=1;$i<=$numOfPages;$i++):
        	if($i==$currPage){
        		$pagination .= '<li class="notactive">'.$i.'</li>';
        	}else{
        		$pagination .= '<li class="active"><a href="'.site_url("$module/page/$i").'">'.$i.'</a></li>';
        	}
    	endfor;*/
		
		$lastpage 	= $numOfPages;		//lastpage is = total pages / items per page, rounded up.
		$lpm1 		= $lastpage - 1;
		$page		= $currPage;
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= '<li class="notactive">'.$counter.'</li>';
				else
					$pagination.= '<li class="active"><a href="'.site_url("$module/$counter").'">'.$counter.'</a></li>';
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= '<li class="notactive">'.$counter.'</li>';
					else
						$pagination.= '<li class="active"><a href="'.site_url("$module/$counter").'">'.$counter.'</a></li>';
				}
				$pagination.= "...";
				$pagination.= '<li class="active"><a href="'.site_url("$module/$lpm1").'">'.$lpm1.'</a></li>';
				$pagination.= '<li class="active"><a href="'.site_url("$module/$lastpage").'">'.$lastpage.'</a></li>';
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= '<li class="active"><a href="'.site_url("$module/1").'">1</a></li>';
				$pagination.= '<li class="active"><a href="'.site_url("$module/2").'">2</a></li>';
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= '<li class="notactive">'.$counter.'</li>';
					else
						$pagination.= '<li class="active"><a href="'.site_url("$module/$counter").'">'.$counter.'</a></li>';
				}
				$pagination.= "...";
				$pagination.= '<li class="active"><a href="'.site_url("$module/$lpm1").'">'.$lpm1.'</a></li>';
				$pagination.= '<li class="active"><a href="'.site_url("$module/$lastpage").'">'.$lastpage.'</a></li>';
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= '<li class="active"><a href="'.site_url("$module/1").'">1</a></li>';
				$pagination.= '<li class="active"><a href="'.site_url("$module/2").'">2</a></li>';
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= '<li class="notactive">'.$counter.'</li>';
					else
						$pagination.= '<li class="active"><a href="'.site_url("$module/$counter").'">'.$counter.'</a></li>';
				}
			}
		}
		
		
		
		
		
		
		
		
		//Next Page Link
    	if($currPage < $numOfPages){
			$pagination .= '<li class="active"><a href="'.site_url("$module/".($currPage+1)).'">Next &gt;</a></li>';
    	}else{
			$pagination .= '<li class="next-off">Next &gt;</li>';
    	}
		
		//Last Page Link
		if($currPage == $numOfPages){
			$pagination .= '<li class="next-off">End</li>';
		}else{
			$pagination .= '<li class="active"><a href="'.site_url("$module/$numOfPages").'">End</a></li>';
		}
		
		//Current Page of Total Pages
		$pagination .= '<li class="active"> Page '.$currPage.' of '.$numOfPages.'</li>';
		$pagination .= '</ul>';
		
		
		
		
		
	
	//$total_pages = $numOfPages;
//	
//	/* Setup vars for query. */
//	$targetpage = site_url("view-all-comments"); 	//your file name  (the name of this file)
//	$limit 		= $rpp; 								//how many items to show per page
//	$page 		= $currPage;
//	if($page) 
//		$start = ($page - 1) * $limit; 			//first item to display on this page
//	else
//		$start = 0;								//if no page var is given, set start to 0
//	
//	/* Setup page vars for display. */
//	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
//	$prev = $page - 1;							//previous page is page - 1
//	$next = $page + 1;							//next page is page + 1
//	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
//	$lpm1 = $lastpage - 1;						//last page minus 1
//	
//	/* 
//		Now we apply our rules and draw the pagination object. 
//		We're actually saving the code to a variable in case we want to draw it more than once.
//	*/
//	$pagination = "";
//	if($lastpage > 1)
//	{	
//		$pagination .= "<div class=\"pagination\">";
//		//previous button
//		if ($page > 1) 
//			$pagination.= "<a href=\"$targetpage/$prev\">previous</a>";
//		else
//			$pagination.= "<span class=\"disabled\">previous</span>";	
//		
//		//pages	
//		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
//		{	
//			for ($counter = 1; $counter <= $lastpage; $counter++)
//			{
//				if ($counter == $page)
//					$pagination.= "<span class=\"current\">$counter</span>";
//				else
//					$pagination.= "<a href=\"$targetpage/$counter\">$counter</a>";					
//			}
//		}
//		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
//		{
//			//close to beginning; only hide later pages
//			if($page < 1 + ($adjacents * 2))		
//			{
//				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
//				{
//					if ($counter == $page)
//						$pagination.= "<span class=\"current\">$counter</span>";
//					else
//						$pagination.= "<a href=\"$targetpage/$counter\">$counter</a>";					
//				}
//				$pagination.= "...";
//				$pagination.= "<a href=\"$targetpage/$lpm1\">$lpm1</a>";
//				$pagination.= "<a href=\"$targetpage/$lastpage\">$lastpage</a>";		
//			}
//			//in middle; hide some front and some back
//			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
//			{
//				$pagination.= "<a href=\"$targetpage/1\">1</a>";
//				$pagination.= "<a href=\"$targetpage/2\">2</a>";
//				$pagination.= "...";
//				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
//				{
//					if ($counter == $page)
//						$pagination.= "<span class=\"current\">$counter</span>";
//					else
//						$pagination.= "<a href=\"$targetpage/$counter\">$counter</a>";					
//				}
//				$pagination.= "...";
//				$pagination.= "<a href=\"$targetpage/$lpm1\">$lpm1</a>";
//				$pagination.= "<a href=\"$targetpage/$lastpage\">$lastpage</a>";		
//			}
//			//close to end; only hide early pages
//			else
//			{
//				$pagination.= "<a href=\"$targetpage/1\">1</a>";
//				$pagination.= "<a href=\"$targetpage/2\">2</a>";
//				$pagination.= "...";
//				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
//				{
//					if ($counter == $page)
//						$pagination.= "<span class=\"current\">$counter</span>";
//					else
//						$pagination.= "<a href=\"$targetpage/$counter\">$counter</a>";					
//				}
//			}
//		}
//		
//		//next button
//		if ($page < $counter - 1) 
//			$pagination.= "<a href=\"$targetpage/$next\">next</a>";
//		else
//			$pagination.= "<span class=\"disabled\">next</span>";
//		$pagination.= "</div>\n";		
//	}
		
		
		
		
		
		
		
		
		
		
		
		
		return $pagination;
		
	}
?>