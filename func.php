<?php
   function myHeader(){
      print("
	<html>
	<head>
	   <title>Belldandy - the Logos bell system!</title>
	   <link rel = \"stylesheet\" type=\"text/css\" href=\"styles.css\"/>
	</head>
	<body>");
   }

   function myFooter(){
      print("</body>
      </html>");
   } //end footer()

   function showBells(){
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
   }

    function findSchedule($schedules,$key){
           $selection = null;

           foreach($schedules as $schedule){
             if($schedule->sid==$key){
                $selection = $schedule;
             }
           }
           
           return $selection;
    } 

   function findPeriod($schedule,$key){
       $selection = null;
       foreach($schedule as $periods){
       foreach($periods as $period){
          if($period->pid==$key){
		$selection = $period;
	  }
	}
	}
	
	return $selection;
   }

   function generateTimeSelect($name,$curtimeval){
	 print("<select name=\"".$name."hour\">");
                $stime = explode(":",$curtimeval);
                $shour = $stime[0];
                $smin = $stime[1];
                $selected="";

                for($i=7;$i<24;$i++){
                        if($i<10)$i="0".$i;
                        if($i==$shour) $selected = "selected";
                        print("<option $selected>$i</option>");
                        $selected="";
                }

                for($i=0;$i<7;$i++) print("<option>0$i</option>");
                print("</select>"); //end hour selection

                print(":");
                print("<select name=\"startmin\">");
                
                for($i=0;$i<60;$i++){
                        if($i<10)$i="0".$i;
                        if($i==$smin) $selected = "selected";
                        print("<option $selected>$i</option>");
                        $selected="";
                }
                print("</select>"); //end min selection

   }

   function generateDOWSelect($name,$curdow){
	$possDOW=array("MON","TUE","WED","THU","FRI","SAT","SUN");
	$curdow = explode(",",$curdow);
	$checked="";

	foreach($possDOW as $thisDOW){
	   foreach($curdow as $testdow){
		   if(strcmp($testdow,$thisDOW)==0) $checked="checked";
	   }

	print("<input type = \"checkbox\" $checked name=\"DOW$name\" value =".$thisDOW.">".$thisDOW);
	$checked="";
	}

   }
?>

