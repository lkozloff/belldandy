#!/usr/bin/php
<?php
	$command = "/usr/bin/mpg321";
	$user = "root";
	$source_dir = "/var/www/belldandy/";
	$schedules=simplexml_load_file($source_dir.'bells.xml');
	$filename="bell.stub";
	$fh = fopen("/tmp/".$filename,"w");

	foreach($schedules as $schedule){
	if($schedule->active =='true'){
	   fwrite($fh,"### ".$schedule->title." ###\n");

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
		fwrite($fh,"\n    #- $name -#\n");
		fwrite($fh,"$sminute $shour * * $dow $user\t $command $source_dir$sound\n");
		fwrite($fh,"$eminute $ehour * * $dow $user\t $command $source_dir$sound\n");

	   }
	   fwrite($fh,"\n");
	   }
	}
	fclose($fh);


?>
