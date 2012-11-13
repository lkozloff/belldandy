<?php
	include("func.php");
	if(!isset($_POST['submit'])){
	   $title = "Fun Test!";
	   $active = "true";
	   $pname = "P1";
    	   $starthour = 18;
    	   $startmin = 15;
    	   $endhour = 18;
    	   $endmin = 16;
    	   $dow_arr = array('MON','TUE','WED','THU','FRI');
    	   $sound = "bell.mp3";
	}

	else{
	   $title = $_POST['title'];
	   $active = $_POST['active'];
	   $pname = $_POST['pname'];
	   $starthour = $_POST['starthour'];
	   $startmin = $_POST['startmin'];
	   $endhour = $_POST['endhour'];
	   $endmin = $_POST['endmin'];
	   $sound = $_POST['sound'];
	   $dow_arr = $_POST['dow_arr'];

	}

	//construct a nice DOW string
	foreach($dow_arr as $day){
	   $dow.=$day.",";
	}

	//get rid of the trailing comma
	$dow = rtrim($dow,",");



	$schedules=simplexml_load_file('bells.xml');

	$schedule=$schedules->addChild('schedule');

	$schedule->addChild('title',$title);
	$schedule->addChild('active',$active);
	$periods=$schedule->addChild('periods');
		
    $period = $periods->addChild('period');

   	$period->addChild('name',$pname);
    $period->addChild('starttime',$starthour.":".$startmin);
    $period->addChild('endtime',$endhour.":".$endmin);
    $period->addChild('dow',$dow);
    $period->addChild('sound',$sound);
	
    $handle=fopen("bells.xml","wb");
    fwrite($handle,$schedules->asXML());
    fclose($handle);

    myHeader();
    showBells();
    myFooter();
 
?>
