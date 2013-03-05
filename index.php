<html>
<head>
<title>Belldandy - the Logos bell system!</title>
<link rel = "stylesheet" type="text/css" href="styles.css"/>
<script src="js/jquery-1.8.2.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jeditable.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jeditable.time.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jeditable.ajaxupload.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jeditable.checkbox.js" type="text/javascript" charset="utf-8"></script>
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
    //not yet implemented
    /*$(".ajaxupload").editable("upload.php", { 
        indicator : "<img src='img/indicator.gif'>",
        type      : 'ajaxupload',
        submit    : 'Upload',
        cancel    : 'Cancel',
        tooltip   : "Click to upload..."
    });*/
    $(".cbox").editable("save.php", { 
        type      : 'checkbox',
        submit    : 'OK',
        cancel    : 'Cancel',
	checkbox: { trueValue: 'true', falseValue: 'false'}
    });

 });
</script>
<script type="text/javascript">
    <!--
    function updateTime() {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        if (minutes < 10){
            minutes = "0" + minutes;
        }
        if (seconds < 10){
            seconds = "0" + seconds;
        }
        var v = hours + ":" + minutes + ":" + seconds + " ";
        if(hours > 11){
            v+="";
        } else {
            v+=""
        }
	
	if(hours < 10){
	   hours = "0" + hours;
	}
        setTimeout("updateTime()",1000);
        document.getElementById('time').innerHTML=v;
	document.getElementById('time').style.left=seconds+"px";
	document.getElementById('time').style.top=minutes*5+"px";
    }
    updateTime();
    //-->
</script>

</head>
<body>
 <div style="font-size:350%;font-family: sans-serif;color:rgb(0,0,228);height:500px"/>
	<h1><span id="time" style="position:relative;"/></h1>
</div>
<?php
	include("func.php");
	$schedules=simplexml_load_file('bells.xml');
	$prepend = 0;
	foreach($schedules as $schedule){
	   print("<h1 class=\"$schedule->active\">");
	   print("<div class=\"cbox\" id=\"$schedule->sid.0.active\">".$schedule->title."</div></h1>");
	   print("<table>");
	   print("<tr class=\"h\"><td>Period</td><td>Start</td><td>End</td><td>DoW</td><td>Sound</td></tr>");

	   foreach($schedule->periods->period as $period){
		$elementID=$schedule->sid.".".$period->pid;
		print("<tr class=\"c$prepend\">");
		print("<td class=\"edit\" id=\"$elementID.name\">".$period->name."</td>");
		print("<td class=\"timepicker\"id=\"$elementID.starttime\">".$period->starttime."</td>");
		print("<td class=\"timepicker\" id=\"$elementID.endtime\">".$period->endtime."</td>");

 		print("<td>");
                generateDOWSelect($period->name,$period->dow,$elementID);
                print("</td>");

		print("<td class=\"ajaxupload\"id=\"$elementID.sound\">".$period->sound."</td>");
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
