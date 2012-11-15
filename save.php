<?php
	//print_r($_POST);
	include("func.php");

	$id = $_POST['id']; 
	$value = $_POST['value'];

	$data = explode(".",$id);
	$sid = $data[0];
	$pid = $data[1];
	$modifiedData = $data[2];


	$schedules=simplexml_load_file('bells.xml');
	$suc = findSchedule($schedules,$sid);
	$duc = findPeriod($suc,$pid);

	//in case of modifying a dow
	if(strcmp($modifiedData,"dow")==0){
	   $newdow=$data[3];
	   $olddow=explode(",",$duc->dow);
	   $possDOW=array("MON","TUE","WED","THU","FRI","SAT","SUN");

	   //insert dow
	   if(strcmp($value,'true')==0){
		//prevents double adding of days
		if(strpos($duc->dow,$newdow)==false){
		   $value = $duc->dow.",$newdow";	
		}
		else $value = $duc->dow;
		print("<div style=\"float:left;color:green;\">$newdow&nbsp;</div>");
           }
           //remove dow
	   else{
		$value="";
		foreach($olddow as $testdow){
		   if(strcmp($testdow,$newdow)==0){
			$testdow='';
		   }
		   $value.=$testdow.",";
		}
		$value=rtrim($value,",");
		print("<div style=\"float:left;color:rgb(220,220,220);\">$newdow&nbsp;</div>");
           }
		
	}
	elseif(strcmp($modifiedData,"active")==0){
		$suc->active=$value;
		print("<div class=\"$suc->active\">$suc->title</div>");
	}
	//not modifying a dow, just print the new value
	else{
		print($value);
	}
	
	//now save our stuff	
	$duc->$modifiedData=$value;

	//print($schedules->asXML());
	$handle=fopen("bells.xml","wb");
    	fwrite($handle,$schedules->asXML());
    	fclose($handle);


?>
