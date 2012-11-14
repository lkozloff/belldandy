<html>
<head>
	<script src="jquery-1.8.2.min.js" type="text/javascript"></script>
	<link rel = "stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<form action = "write.php" method="post">
<table>
<tr class="h">
   <td>Period</td>
   <td>Start</td>
   <td>End</td>
   <td>DoW</td>
   <td>Sound</td>
</tr>
<tr>
   <td class="editable_textarea"><input type="text" value="Period Title" name="pname"></td>
   <td>
	<select name="starthour">
		<?php 	for($i=7;$i<24;$i++){if($i<10)$i="0".$i;print("<option>$i</option>");}
			for($i=0;$i<7;$i++) print("<option>0$i</option>"); ?>
	</select>:
	<select name="startmin">
		<?php for($i=0;$i<60;$i++){if($i<10)$i="0".$i;print("<option>$i</option>");} ?>
	</select>
   </td>
   <td>
	<select name="endhour">
		<?php 	for($i=7;$i<24;$i++){if($i<10)$i="0".$i;print("<option>$i</option>");}
			for($i=0;$i<7;$i++) print("<option>0$i</option>"); ?>
	</select>:
	<select name="endmin">
		<?php 	for($i=0;$i<60;$i++){if($i<10)$i="0".$i;print("<option>$i</option>");}?>
	</select>
   </td>
   <td>
	<input type = "checkbox" checked="yes" name="dow_arr[]" value ="MON">MON 
	<input type = "checkbox"checked="yes" name="dow_arr[]" value = "TUE">TUE
	<input type = "checkbox" checked="yes" name="dow_arr[]" value ="WED">WED
	<input type = "checkbox" checked="yes" name="dow_arr[]" value="THU">THU
	<input type = "checkbox" checked="yes" name="dow_arr[]" value="FRI">FRI
	<input type = "checkbox" name="dow_arr[]" value="SAT">SAT
	<input type = "checkbox" name="dow_arr[]" value="SUN">SUN
   </td>
   <td>bell.mp3</td>
</tr>

<tr><td class="editable_textarea">Period 2</td><td>11:19</td><td>11:20</td><td>MON,TUE,WED,THU,FRI</td><td>bell.mp3</td></tr><tr><td class="editable_textarea">Lunch</td><td>11:21</td><td>11:22</td><td>MON,TUE,WED,THU,FRI</td><td>bell.mp3</td></tr><tr><td class="editable_textarea">Period 3</td><td>11:23</td><td>11:24</td><td>MON,TUE,WED,THU,FRI</td><td>bell.mp3</td></tr><tr><td class="editable_textarea">Period 4</td><td>11:25</td><td>11:26</td><td>MON,TUE,WED,THU,FRI</td><td>bell.mp3</td></tr></table>
<input type = "hidden" name = "active" value="true">
<input type = "hidden" name = "sound" value="bell.mp3">
<input type = "hidden" name = "title" value="hidden test value">
<input type = "submit" name = "submit" value="submit">
</form>
</body>
</html>
