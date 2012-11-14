<?php
	//print("ID:".$_POST['id']);
	include("func.php");

	$id = $_POST['id']; 
	$value = $_POST['value'];

	$data = explode(".",$id);
	$sid = $data[0];
	$pid = $data[1];
	$modifiedData = $data[2];


	$schedules=simplexml_load_file('bells.xml');
	$suc = findSchedule($schedules,$sid);
	if($suc==null)print("couldn't find that schedule?");
	$duc = findPeriod($suc,$pid);
	if($duc==null)print("couldn't find that period?");
	$duc->$modifiedData=$value;

	//print($schedules->asXML());
	$handle=fopen("bells.xml","wb");
    	fwrite($handle,$schedules->asXML());
    	fclose($handle);

	print($value);

?>
