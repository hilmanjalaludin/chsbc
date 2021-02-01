<?php 
	$totals_page = count($selpages);
	$max_page = 10;
	
	
	$paging  = " <ul> ";
	/** settup data page **/
	
	$start   = (!$current ? 1: ((($current%$max_page ==0) ? ($current/$max_page) : intval($current/$max_page)+1)-1)*$max_page+1);
	$end     = ((($start+$max_page-1)<=$totals_page) ? ($start+$max_page-1) : $totals_page );
	
	
	if( $current > 1)
	{
		$post = (INT)(($current)-1);
		$paging .="<li class=\"page-web-voice-normal\" onclick=\"Ext.DOM.Ext.DOM.ShowAgentByKeyword('1');\" ><a href=\"javascript:void(0);\">&lt;&lt;</a></li>";
		$paging .="<li class=\"page-web-voice-normal\" onclick=\"Ext.DOM.Ext.DOM.ShowAgentByKeyword('$post');\" ><a href=\"javascript:void(0);\">&lt;</a></li>";
	}
	
	if($start>$max_page){
		$paging.="<li cclass=\"page-web-voice-normal\"  onclick=\"Ext.DOM.Ext.DOM.ShowAgentByKeyword('" .($start-1) . "');\" ><a href=\"javascript:void(0);\">...</a></li>";
	}
		
	for( $p=$start; $p<=$end; $p++)
	{ 
		if( $p==$current) { 
			$paging .="<li class=\"page-web-voice-current\" id=\"{$selpages[$p]}\" onclick=\"Ext.DOM.Ext.DOM.ShowAgentByKeyword('{$p}');\"> <a href=\"javascript:void(0);\">{$p}</a></li>";
		}					
		else {
			$paging	.=" <li class=\"page-web-voice-normal\" id=\"{{$selpages[$p]}}\" onclick=\"Ext.DOM.Ext.DOM.ShowAgentByKeyword('{$p}');\"><a href=\"javascript:void(0);\">{$p}</a></li>";
		}
	}
	
	if($end<$totals_page){
		$paging.="<li class=\"page-web-voice-normal\" onclick=\"Ext.DOM.Ext.DOM.ShowAgentByKeyword('".($end+1) ."');\"><a href=\"javascript:void(0);\" >...</a></li>";
	}
	
	if($current<$totals_page){
		$paging.="<li class=\"page-web-voice-normal\" onclick=\"Ext.DOM.Ext.DOM.ShowAgentByKeyword('". ($current+1) ."');\"><a href=\"javascript:void(0);\" title=\"Next page\">&gt;</a></li>";
		$paging.="<li class=\"page-web-voice-normal\" onclick=\"Ext.DOM.Ext.DOM.ShowAgentByKeyword('". ($totals_page)."');\"><a href=\"javascript:void(0);\" title=\"Last page\">&gt;&gt;</a></li>";
	}
		
	
	$paging.="</ul>";
	__($paging);
	
?>



