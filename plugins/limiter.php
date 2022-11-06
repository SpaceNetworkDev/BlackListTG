<?php

$hostmine = "localhost";
$dbmine = "YourDBName";
$usermine = "YourDBUser";
$passwordmine = "YourDBPassword";

$DBquery = mysqli_connect($hostmine, $usermine, $passwordmine, $dbmine);
date_default_timezone_set('Europe/Rome');
if (!$DBquery) {
	echo"DB ERROR";
	die;
}

function addWaitObject($object, $time) {
	global $DBquery;
	$action = "INSERT INTO sblwait (id, oggetto, last) VALUES (NULL, '$object', '$time')";
	if (!existObject($object)) {
		if (mysqli_query($DBquery, $action)) {
				return true;
		} else {
				return false;
		}
	} else {
		return false;
	}
}

function existObject($object) {
	global $DBquery;
		$action = "SELECT * FROM sblwait WHERE oggetto = '$object'";
		$result = mysqli_query($DBquery, $action);
		if (mysqli_num_rows($result) > 0) {
			return true;
		} else {
			return false;
		}
}

function isObjectValid($object) {
	global $DBquery;
		$action = "SELECT * FROM sblwait WHERE oggetto = '$object'";
		$result = mysqli_query($DBquery, $action);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["last"] <= time()) {
					return true;
				} else{
					return false;
				}
			}
		} else {
			return false;
		}
}

function setWaitObject($object, $time) {
		global $DBquery;
		$action = "UPDATE sblwait SET last='$time' WHERE oggetto= '$object'";
		$result = mysqli_query($DBquery, $action);
		if(existObject($object)) {
			if($result) {
				return true;
			} else {
        return false;
      }
		} else {
			return addWaitObject($object, $time);
		}
}
?>
