<html>
<head>
<link rel="stylesheet" href="tigra_calendar/calendar.css">
<script language="JavaScript" src="tigra_calendar/calendar_us.js"></script>
</head>

<body>
<form name="product_list" method="get">
<span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000;font-weight: bold;">Start Date</span>&nbsp;&nbsp;<input type="text" name="start_date" id="start_date" value="<?php echo $start_date;?>" class='TxtBox_products'>&nbsp;

<script language='JavaScript'>
	new tcal ({
		// form name
		'formname': 'product_list',
		// input name
		'controlname': 'start_date'
	});

	</script>
	
&nbsp;&nbsp;<span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000;font-weight: bold;">End Date</span>&nbsp;&nbsp;<input type="text" name="end_date" id="end_date" value="<?php echo $end_date;?>" class="TxtBox_products">&nbsp;

<script language='JavaScript'>
	new tcal ({
		// form name
		'formname': 'product_list',
		// input name
		'controlname': 'end_date'
	});

	</script>
	
</form>
</body>
</html>