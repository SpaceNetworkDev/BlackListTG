<?php
/*
ADMIN - SUPPORTER - VIP - SCAMMER - USERS
*/
##################################################################################
///////////////////////////////////////MYSQL//////////////////////////////////////
##################################################################################

$servername = "localhost";
$username = "YourDBUsername";
$password = "YourDBPassword";
$database = "YourDBName";
include_once 'commands.php';
$query = mysqli_connect($servername, $username, $password, $database);

date_default_timezone_set('Europe/Rome');

if (!$query) {
	echo"Errore Interno nel Database";
	die;
}

/*
$hostSite = "NULL";
$dbSite = "NULL";
$userSite = "NULL";
$passwordSite = "NULL";
$querySite = mysqli_connect($hostSite, $userSite, $passwordSite, $dbSite);

if (!$querySite) {
	echo"DB ERROR";

}
*/

$ctime = time();

/*function sitePlanValid($botToken) {
  global $querySite;
	$action = "SELECT * FROM tgbots WHERE Token= '$botToken'";
	$result = mysqli_query($querySite, $action);
	$row = mysqli_fetch_assoc($result);
  $edate = $row["expirydate"];
  $today = time();
	if($edate >= $today) {
    return true;
  } else {
    return false;
  }
}


function siteBotEnable($botToken) {
  global $querySite;
  $action = "SELECT * FROM tgbots WHERE Token= '$botToken'";
  $result = mysqli_query($querySite, $action);
  $row = mysqli_fetch_assoc($result);
  if($row["active"] == "1") {
    return true;
  } else if($row["active"] == "0") {
    return false;
  }

}
*/

//TESTING
/*function autoBan($sid) {
	global $query;
	$action = "SELECT * FROM groups";
	$result = mysqli_query($query, $action);

	if (mysqli_num_rows($result) > 0) {
		/*while($row = mysqli_fetch_assoc($result)) {
			//
			//	echo "<br>" . $row["tgid"] . "</br>";
			echo $row["tgid"];
			sendMessage("-1001494441769", "asdasd";)
		}*/

	/*	for ($i=0; $i < mysqli_num_rows($result); $i++) {
			$row = mysqli_fetch_assoc($result);
			echo "<br> " . $row["tgid"]. "</br>";
			sendMessage($row["tgid"], "asdasd");

		}

	}
}*/
##################################################################################
///////////////////////////////////////IS/////////////////////////////////////////
##################################################################################

//ADMIN (TRUE, FALSE)
function isAdmin($tgid) {
  global $query;
		$action = "SELECT * FROM admins WHERE tgid = '$tgid'";
		$result = mysqli_query($query, $action);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["tgid"] === $tgid) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}

}

//SUPPORTER (TRUE, FALSE)
function isSupporter($tgid) {
	global $query;
		$action = "SELECT * FROM supporters WHERE tgid = '$tgid'";
		$result = mysqli_query($query, $action);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["tgid"] === $tgid) {
					return true;
				} else{
					return false;
				}
			}
		} else {
			return false;
		}
}

//VIP (TRUE, FALSE)
function isVip($tgid) {
  global $query;
		$action = "SELECT * FROM vips WHERE tgid = '$tgid'";
		$result = mysqli_query($query, $action);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["tgid"] === $tgid) {
					return true;
				} else{
					return false;
				}
			}
		} else {
			return false;
		}

}

//GROUP (TRUE, FALSE)
function isGroup($tgid) {
  global $query;
		$action = "SELECT * FROM groups WHERE tgid = '$tgid'";
		$result = mysqli_query($query, $action);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["tgid"] === $tgid) {
					return true;
				} else{
					return false;
				}
			}
		} else {
			return false;
		}

}

//SCAMMER (TRUE, FALSE)
function isScammer($tgid) {
	global $query;
		$action = "SELECT * FROM scammers WHERE tgid = '$tgid'";
		$result = mysqli_query($query, $action);
		if (mysqli_num_rows($result) > 0) {
			return true;
		} else {
			return false;
		}
}

function isUser($tgid) {
	global $query;
		$action = "SELECT * FROM users WHERE tgid = '$tgid'";
		$result = mysqli_query($query, $action);
		if (mysqli_num_rows($result) > 0) {
			 return true;

		} else {
			return false;
		}
}



##################################################################################
///////////////////////////////////////ADD-DEL////////////////////////////////////
##################################################################################

//ADMIN
function addAdmin($tgid) {
  global $query;
		$action = "INSERT INTO admins (id, tgid) VALUES (NULL, '$tgid')";
      if (!isAdmin($tgid)) {
        if (mysqli_query($query, $action)) {
          return true;
  			} else {
          return false;
  			}
      } else {
        return false;
      }

}

function delAdmin($tgid) {
  global $query;
		$action ="DELETE FROM admins WHERE tgid = '$tgid'";
    if (isAdmin($tgid)) {
			if (mysqli_query($query, $action)) {
        return true;
			} else {
        return false;
			}
		} else {
      return false;
		}
}


//SUPPORTERS
function addSupporter($tgid) {
  global $query;
		$action = "INSERT INTO supporters (id, tgid) VALUES (NULL, '$tgid')";
      if (!isSupporter($tgid)) {
        if (mysqli_query($query, $action)) {
          return true;
  			} else {
          return false;
  			}
      } else {
        return false;
      }
}

function delSupporter($tgid) {
  global $query;
		$action ="DELETE FROM supporters WHERE tgid = '$tgid'";
    if (isSupporter($tgid)) {
			if (mysqli_query($query, $action)) {
        return true;
			} else {
        return false;
			}
		} else {
      return false;
		}
}


//GRUPPI
function addGroup($tgid) {
  global $query;
		$action = "INSERT INTO groups (id, tgid, pref, support) VALUES (NULL, '$tgid', '1', '0')";
      if (!isGroup($tgid)) {
        if (mysqli_query($query, $action)) {
          return true;
  			} else {
          return false;
  			}
      } else {
        return false;
      }
}

function delGroup($tgid) {
  global $query;
		$action = "DELETE FROM groups WHERE tgid = '$tgid'";
    if (isGroup($tgid)) {
			if (mysqli_query($query, $action)) {
        return true;
			} else {
        return false;
			}
		} else {
      return false;
		}
}

//VIP
function addVip($tgid) {
  global $query;
		$action = "INSERT INTO vips (id, tgid) VALUES (NULL, '$tgid')";
      if (!isVip($tgid)) {
        if (mysqli_query($query, $action)) {
          return true;
  			} else {
          return false;
  			}
      } else {
        return false;
      }
}

function delVip($tgid) {
  global $query;
		$action ="DELETE FROM vips WHERE tgid = '$tgid'";
    if (isVip($tgid)) {
			if (mysqli_query($query, $action)) {
        return true;
			} else {
        return false;
			}
		} else {
      return false;
		}
}


//SCAMMER
function addScammer($tgid, $PROVE, $DESCRIZIONE, $bby) {
  global $query;
	$date  = date("Y-m-d");
		$action = "INSERT INTO scammers (id, tgid, PROVE, DESCRIZIONE, banby, data) VALUES (NULL, '$tgid', '$PROVE', '$DESCRIZIONE', '$bby', '$date')";
      if (!isScammer($tgid)) {
        if (mysqli_query($query, $action)) {
          return true;
  			} else {
          return mysqli_error($query);
  			}
      } else {
        return false;
      }
}

function delScammer($tgid) {
  global $query;
		$action ="DELETE FROM scammers WHERE tgid = '$tgid'";
    if (isScammer($tgid)) {
			if (mysqli_query($query, $action)) {
        return true;
			} else {
        return false;
			}
		} else {
      return false;
		}
}

//USERS
function addUser($tgid) {
  global $query;
	global $ctime;
	$action = "INSERT INTO users (id, tgid, rep) VALUES (NULL, '$tgid', '0')";
    if (!isUser($tgid)) {
      if (mysqli_query($query, $action)) {
        return true;
  		} else {
        return mysqli_error($query);
  		}
    } else {
      return false;
    }
}

function delUser($tgid) {
  global $query;
		$action ="DELETE FROM users WHERE tgid = '$tgid'";
    if (isUser($tgid)) {
			if (mysqli_query($query, $action)) {
        return true;
			} else {
        return false;
			}
		} else {
      return false;
		}
}

//REPS
function getRep($tgid) {
  global $query;
	$action = "SELECT * FROM users WHERE tgid = '$tgid'";
	$result = mysqli_query($query, $action);
	if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
					return $row["rep"];
			}
	} else {
			return false;
	}
}

function addRep($tgid) {
  global $query;
	$piu = getRep("$tgid")+1;
	$action = "UPDATE  users SET rep='$piu' WHERE tgid='$tgid'";
    if (isUser($tgid)) {
      if (mysqli_query($query, $action)) {
        return true;
  		} else {
        return mysqli_error($query);
  		}
    } else {
      return false;
    }
}

##################################################################################
///////////////////////////////////////TOTAL//////////////////////////////////////
##################################################################################

//ADMIN
function totalAdmin() {
  global $query;
		$action = "SELECT * FROM admins";
		$result = mysqli_query($query, $action);
		return mysqli_num_rows($result);

}

//SUPPORTER
function totalSupporter() {
  global $query;
		$action = "SELECT * FROM supporters";
		$result = mysqli_query($query, $action);
		return mysqli_num_rows($result);

}

//VIP
function totalVip() {
  global $query;
		$action = "SELECT * FROM vips";
		$result = mysqli_query($query, $action);
		return mysqli_num_rows($result);

}

//GRUPPI
function totalGroup() {
  global $query;
		$action = "SELECT * FROM groups";
		$result = mysqli_query($query, $action);
		return mysqli_num_rows($result);

}

//SCAMMER
function totalScammer() {
  global $query;
		$action = "SELECT * FROM scammers";
		$result = mysqli_query($query, $action);
		return mysqli_num_rows($result);

}

//USER
function totalUser() {
  global $query;
		$action = "SELECT * FROM users";
		$result = mysqli_query($query, $action);
		return mysqli_num_rows($result);

}

function totalScammers($data, $sID) {
  global $query;
		$action = "SELECT * FROM scammers WHERE data='$data' AND banby='$sID'";
		$result = mysqli_query($query, $action);
		return mysqli_num_rows($result);

}

function totalScammersNoData($sID) {
  global $query;
		$action = "SELECT * FROM scammers WHERE banby='$sID'";
		$result = mysqli_query($query, $action);
		return mysqli_num_rows($result);

}

##################################################################################
///////////////////////////////////////MAINTENANCE////////////////////////////////
##################################################################################

//IS
function isMaintenance() {
  global $query;
		$action = "SELECT * FROM bot WHERE name = 'maintenance'";
		$result = mysqli_query($query, $action);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["status"]) {
					return true;
				} else{
					return false;
				}
			}
		} else {
			return false;
		}

}
//ENABLE
function enableMaintenance() {
  global $query;
		$action = "UPDATE bot SET status='1' WHERE name='maintenance'";
		if (mysqli_query($query, $action)) {
			return true;
		} else {
			return false;
			echo mysqli_error($query);
		}

}
//DISABLE
function disableMaintenance() {
  global $query;
		$action = "UPDATE bot SET status='0' WHERE name='maintenance'";
		if (mysqli_query($query, $action)) {
			return true;
		} else {
			return false;
			echo mysqli_error($query);
		}

}
##################################################################################
//////////////////////////////////////SET////////////////////////////////////////
##################################################################################

function prefSet($tgid, $pref) {
	global $query;
	$action = "UPDATE groups SET pref='$pref' WHERE tgid='$tgid'";
	if (mysqli_query($query, $action)) {
			return true;
		} else {
			return false;
			echo mysqli_error($query);
	}
}

function prefGet($tgid) {
  global $query;
	$action = "SELECT * FROM groups WHERE tgid = '$tgid'";
	$result = mysqli_query($query, $action);
	if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
					return $row["pref"];
			}
	} else {
			return false;
	}
}

##################################################################################
//////////////////////////////////////SUPPORT/////////////////////////////////////
##################################################################################

function disableSupport($tgid) {
	global $query;
	$action = "UPDATE groups SET support='0' WHERE tgid='$tgid'";
	if (mysqli_query($query, $action)) {
			return true;
		} else {
			return false;
			echo mysqli_error($query);
	}
}

function enableSupport($tgid) {
	global $query;
	$action = "UPDATE groups SET support='1' WHERE tgid='$tgid'";
	if (mysqli_query($query, $action)) {
			return true;
		} else {
			return false;
			echo mysqli_error($query);
	}
}

function supportGet($tgid) {
	global $query;
	$action = "SELECT * FROM groups WHERE tgid = '$tgid'";
	$result = mysqli_query($query, $action);
	if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
					return $row["support"];
			}
	} else {
			return false;
	}
}
##################################################################################
//////////////////////////////////////get ARRAY///////////////////////////////////
##################################################################################

function arrayGetGroups() {
	global $query;
	$action = "SELECT * FROM groups";
	$result = mysqli_query($query, $action);
	if (mysqli_num_rows($result) > 0) {
	  for ($i=0; $i < mysqli_num_rows($result); $i++) {
	    $row = mysqli_fetch_assoc($result);
	    $array[] = $row["tgid"];
	  }
	}
	return $array;
}

function arrayGetSupporter() {
	global $query;
	$action = "SELECT * FROM supporters";
	$result = mysqli_query($query, $action);
	if (mysqli_num_rows($result) > 0) {
	  for ($i=0; $i < mysqli_num_rows($result); $i++) {
	    $row = mysqli_fetch_assoc($result);
	    $array[] = $row["tgid"];
	  }
	}
	return $array;
}
function arrayGetScammersTotal() {
	global $query;
	$action = "SELECT * FROM scammers";
	$result = mysqli_query($query, $action);
	if (mysqli_num_rows($result) > 0) {
	    $row = mysqli_fetch_assoc($result);
			$array[] = $row;

	}
	return $array;
}

##################################################################################
//////////////////////////////////////ALTRO///////////////////////////////////////
##################################################################################


//RETURN TEXT (PROVE)
function getProof($scammerID) {
	global $query;
		$action = "SELECT * FROM scammers WHERE tgid = '$scammerID'";
		$result = mysqli_query($query, $action);
			while($row = mysqli_fetch_assoc($result)) {
					return $row["PROVE"];
				}

}

function scammerList($chat_id) {
	global $query;

		$action = "SELECT * FROM scammers";
		$result = mysqli_query($query, $action);
		if(mysqli_num_rows($result)!=0){
			while($row = mysqli_fetch_assoc($result))
			{
				sendMessage($chat_id, $row['tgid']);
			}
		}
}



?>
