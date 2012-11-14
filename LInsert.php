<html>
<head>
<title>Belldandy - the Logos bell system!</title>
<link rel = "stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<form>
<?php
	include("func.php");
	$schedules=simplexml_load_file('bells.xml');
	$prepend = 0;
	foreach($schedules as $schedule){
	   print("<h1 class=\"$schedule->active\">");
	   print("<input type=\"text\" value=\"$schedule->title\"");
	   print("</h1>");
	   if(strcmp($schedule->active,"true")==0) $check="checked";
	   print("<input type=\"checkbox\" checked=\"$check\">");
	   print("<table>");
	   print("<tr class=\"h\"><td>Period</td><td>Start</td><td>End</td><td>DoW</td><td>Sound</td></tr>");

	   foreach($schedule->periods->period as $period){
		print("<tr class=\"c$prepend\">");
		print("<td><input type=\"text\" value=\"$period->name\"></td>");

		print("<td>");
		generateTimeSelect($start,$period->starttime);
		print("</td>");

		print("<td>");
		generateTimeSelect($start,$period->endtime);
		print("</td>");

		print("<td>");
		generateDOWSelect($period->name,$period->dow);
		print("</td>");
		print("<td><input type=\"file\" value=\"$period->sound\"></td>");
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
