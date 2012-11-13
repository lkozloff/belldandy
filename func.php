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
             if(strcmp($schedule->title,$key)==0){
                $selection = $schedule;
             }
           }
           
           return $selection;
    } 

   function findPeriod($periods,$key){
       $selection = null;
       foreach($period as $periods){
          if(strcmp($period->name,$key)==0){
		$selection = $period;
	  }
	}
	
	return $selection;
   }
?>

