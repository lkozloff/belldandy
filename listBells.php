<html>
<head>
<title>Belldandy - the Logos bell system!</title>
<link rel = "stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<?php
	$schedules=simplexml_load_file('bells.xml');
	$prepend = 0;
	foreach($schedules as $schedule){
	   print("<h1 class=\"$schedule->active\">");
	   print($schedule->title);
	   print("<table>");
	   print("<tr class=\"h\"><td>Period</td><td>Start</td><td>End</td><td>DoW</td><td>Sound</td></tr>");

	   foreach($schedule->periods->period as $period){
		print("<tr class=\"c$prepend\">");
		print("<td>".$period->name."</td>");
		print("<td>".$period->starttime."</td>");
		print("<td>".$period->endtime."</td>");
		print("<td>".$period->dow."</td>");
		print("<td>".$period->sound."</td>");
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
