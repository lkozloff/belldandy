<?php
	$command = "/usr/bin/mpg321";
	$user = "root";
	$source_dir = "/var/www/";
	$schedules=simplexml_load_file('bells.xml');

	foreach($schedules as $schedule){
	if($schedule->active =='true'){
	   print("### ".$schedule->title." ###\n");

	   foreach($schedule->periods->period as $period){
		$name = $period->name;
		$start = $period->starttime;
		$end = $period->endtime;
		$dow = $period->dow;
		$sound = $period->sound;
		
		$stime = explode(":",$start);
		$etime = explode(":",$end);
		
		$shour = $stime[0];
		$sminute = $stime[1];
		
		$ehour = $etime[0];
		$eminute = $etime[1];
		
		//print out the actual cron statements, formatted nicely
		print("\n    #- $name -#\n");
		print("$sminute $shour * * $dow $user\t $command $source_dir$sound\n");
		print("$eminute $ehour * * $dow $user\t $command $source_dir$sound\n");

	   }
	   print("\n");
	   }
	}


?>
