<?php
/*
Developed by ajamaludin
ajamaludin@gmail.com
You can use it with out any worries...It is free for you..It will display the out put like:
First | Previous | 3 | 4 | 5 | 6 | 7| 8 | 9 | 10 | Next | Last
Page : 7  Of  10 . Total Records Found: 20
*/
class Pagination_class{
	var $result;
	var $anchors;
	var $total;
	function Pagination_class($qry,$starting,$recpage)
	{
		$numrows	=	$qry;
		
		$next		=	$starting+$recpage;
		$var		=	((intval($numrows/$recpage))-1)*$recpage;
		$page_showing	=	intval($starting/$recpage)+1;
		$total_page	=	ceil($numrows/$recpage);

		if($numrows % $recpage != 0){
			$last = ((intval($numrows/$recpage)))*$recpage;
		}else{
			$last = ((intval($numrows/$recpage))-1)*$recpage;
		}
		$previous = $starting-$recpage;
		
		$anc = "<div class='col-md-5 col-sm-5 pgng'><div class='dataTables_paginate paging_bootstrap_full_number' id='sample_1_2_paginate' style='float: right;margin-top: -5px;'><ul class='pagination'>";
		if($previous < 0){
			$anc .= "<li class='page-first disabled'><a href='javascript:void(0)'>«</a></li>";
			$anc .= "<li class='page-pre disabled'><a href='javascript:void(0)'>‹</a></li>";
		}else{
			$anc .= "<li class='page-first'><a href='javascript:pagination(0)'>«</a></li>";
			$anc .= "<li class='page-pre'><a href='javascript:pagination($previous)'>‹</a></li>";
		}
		
		################If you dont want the numbers just comment this block###############	
		$norepeat = 2;//no of pages showing in the left and right side of the current page in the anchors 
		$j = 1;
		$anch = "";
		for($i=$page_showing; $i>1; $i--){
			$fpreviousPage = $i-1;
			$page = ceil($fpreviousPage*$recpage)-$recpage;			
			$anch = "<li class='page-number'><a href='javascript:pagination($page);'>$fpreviousPage </a></li>".$anch;
			if($j == $norepeat) break;
			$j++;
		}
		$anc .= $anch;
		$anc .= "<li class='page-number active'><a href='javascript:void(0)'>".$page_showing."</a></li>";
		$j = 1;
		for($i=$page_showing; $i<$total_page; $i++){
			$fnextPage = $i+1;
			$page = ceil($fnextPage*$recpage)-$recpage;
			$anc .= "<li class='page-number'><a href='javascript:pagination($page)'>".$fnextPage."</a></li>";
			if($j==$norepeat) break;
			$j++;
		}
		############################################################
		
		if($next >= $numrows){
			$anc .= "<li class='page-next disabled'><a href='javascript:void(0)'>›</a></li>";
			$anc .= "<li class='page-last disabled'><a href='javascript:void(0)'>»</a></li>";
		}else{
			$anc .= "<li class='page-next'><a href='javascript:pagination($next)'>›</a></li>";
			$anc .= "<li class='page-last'><a href='javascript:pagination($last)'>»</a></li>";			
		}
			$anc .= "</ul></div></div>";
		$this->anchors = $anc;
		$a = number_format($page_showing,0,'','.');
		$b = number_format($total_page,0,'','.');
		$c = number_format($numrows,0,'','.');
		
		$this->total = "<div class='col-md-7 col-sm-7'><div class='dataTables_info' id='sample_1_2_info' role='status' aria-live='polite'>Showing $a to $b of $c records</div></div>";
	}
}
?>
