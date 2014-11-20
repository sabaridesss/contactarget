<?php 
include("smarty_config.php");

$id=$_REQUEST['type_page_id'];
$str=$_REQUEST['str'];
		$query2 =  'select * from emailnl_template_tbl where id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
		
		?>
		
        <div id="design_html">
        
        <a href="javascript:void(0);"onclick="TINY.box.show({iframe:'http://www.contacttarget.com/templatepreview.php?id=<?=$displaySite["id"]?>',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})">Preview</a></div>
        
        
