<html>
<head>
<title>Belldandy - the Logos bell system!</title>
<link rel = "stylesheet" type="text/css" href="styles.css"/>
<script src="jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.jeditable.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.jeditable.time.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.jeditable.ajaxupload.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
 $(document).ready(function() {
     $('.edit').editable('save.php', {
         indicator : 'Saving...',
         tooltip   : 'Click to edit...'
     });
     $('.edit_area').editable('save.php', { 
         type      : 'textarea',
         cancel    : 'Cancel',
         submit    : 'OK',
         indicator : '<img src="img/indicator.gif">',
         tooltip   : 'Click to edit...'
     });
     $(".timepicker").editable("save.php", { 
        indicator : "<img src='img/indicator.gif'>",
        type      : 'time',
        submit    : 'OK',
        tooltip   : "Click to edit..."
    });
    $(".ajaxupload").editable("upload.php", { 
        indicator : "<img src='img/indicator.gif'>",
        type      : 'ajaxupload',
        submit    : 'Upload',
        cancel    : 'Cancel',
        tooltip   : "Click to upload..."
    });
 });
</script>
</head>
<body>
<?php
	include("func.php");
	$schedules=simplexml_load_file('bells.xml');
	$prepend = 0;
	foreach($schedules as $schedule){
	   print("<h1 class=\"$schedule->active\">");
	   print($schedule->title);
	   print("<table>");
	   print("<tr class=\"h\"><td>Period</td><td>Start</td><td>End</td><td>DoW</td><td>Sound</td></tr>");

	   foreach($schedule->periods->period as $period){
		print("<tr class=\"c$prepend\">");
		print("<td class=\"edit\" id=\"$schedule->sid.$period->pid.name\">".$period->name."</td>");
		print("<td class=\"timepicker\"id=\"$schedule->sid.$period->pid.starttime\">".$period->starttime."</td>");
		print("<td class=\"timepicker\" id=\"$schedule->sid.$period->pid.endtime\">".$period->endtime."</td>");

 		print("<td>");
                generateDOWSelect($period->name,$period->dow);
                print("</td>");

		print("<td class=\"ajaxupload\"id=\"$schedule->sid.$period->pid.sound\">".$period->sound."</td>");
		print("</tr>");

		$prepend++;
		$prepend=$prepend%2;
	   }
	   print("</table>");
	   $prepend = 0;
	}
?>
</table>
</body>
</html>
