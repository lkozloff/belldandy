<?php
	include("func.php");
	$sched = simplexml_load_file('bells.xml');
	$suc =findSchedule($sched,"Normal Schedule");
	$suc->active = "false";
	echo $sched->asXML();
?>
