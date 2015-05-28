<?php
error_reporting(E_ALL);

function load_secret_data($filename)
{
	$hash = array();
	$file_data = file_get_contents($filename);
	$file_data = explode(",", $file_data);
	for($i=0;$i<count($file_data);$i+=2)
	{
		$hash[$file_data[$i]] = $file_data[$i+1];
	}
	return $hash;
}

function verify_login($id, $password)
{
	$hash = load_secret_data("../secrets.txt");
	if(isset($hash[$id]) && $hash[$id] == $password)
	{
		unset($hash[$id]);
		$file_str = "";
		foreach($hash as $id => $secret)
		{
			$file_str .= $id . "," . $secret . ",";
		}
		$file_str = rtrim($file_str, ",");
		if(file_put_contents("../secrets.txt", $file_str));
		{
			return true;
		}
	}
	return false;
}

//main starts here
	$id = $_POST['id'];
	$secret_key = $_POST['secret_key'];

	if(verify_login($id, $secret_key))
	{
		//single field only
		$vote = $_POST['vote_for'];
		if(file_put_contents("../votes.txt", $vote . "\n", FILE_APPEND))
		{ 
			echo("Voted successfully :) (for " . $vote . ") " );
		}
		else 
		{
			echo("Something went very wrong . If you see this, report with code phpsucksnoconcurrency to the admin");		
		}
	}	
	else
	{
		echo("Either you have already voted or you entered invalid details. If it is neither, please contact whoever sent you this");
	}


?>
