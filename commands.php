<?php
error_reporting(0);
require_once 'bot.php';
$plugins = glob("plugins/*.php");
foreach ($plugins as $plugin) {
	include "$plugin";
}

//VARIABILI
$token = $_GET['api'];
$token_c = explode(":", $token, 2);
$BOT_ID = $token_c[0];
//$BOT_ID = "5772728824";
$supporter_group_id = "GROUPSUPPORTID";
$scam_channel_id = "CHANNELSCAMID";
$time = date('H:i', time());
$from_id_admin_check = getChatMember($chat_id, $from_id)['result']['status'];
$delay = 2;

##################################################################################
/////////////////////////////////////LIMITER & Plan Validation////////////////////
##################################################################################

//$token = $_GET['api'];

/*if (!sitePlanValid($token)) {
	die;
}
if (!siteBotEnable($token)) {
	die;
}

if($text) {
	addWaitObject("$from_id", time() + $delay);
	if(isObjectValid("$from_id")) {
	  setWaitObject("$from_id", time() + $delay);
	} else {
		die;
	}
}
*/
##################################################################################
/////////////////////////////////MANUTENZIONE/////////////////////////////////////
##################################################################################

global $query;
if (isMaintenance()) {
	if (!isAdmin("$from_id")) {
		if ($chat_type == "private") {
			sendmessage($chat_id, "La <b>manutenzione</b> è in corso, al momento non è possibile eseguire comandi.", 'HTML');
			die;
		} else {
			die;
		}
	}
}

##################################################################################
/////////////////////////////////////CANALE///////////////////////////////////////
##################################################################################

function updateMSG() {
		global $scam_channel_id;
		global $update;
		$msg_id = $update['channel_post']['reply_to_message']['message_id'];
		$supporters = arrayGetSupporter();
		foreach($supporters as $sid) {
			$nome = getChat("$sid")["result"]["first_name"];
			$id = getChat("$sid")["result"]["id"];
			$msg .= "	║\n	╠═»👮‍♀️<a href='tg://user?id=$sid'>$nome</a>\n";
		}
		editMessageText("<b>#Statistiche</b>

		<b>🌐 Host:</b> OVH
		<b>🇮🇹 Server Location:</b> Paris, France

		<b>👥 Gruppi: </b>" . totalGroup() ."
		<b>🗄 Scammer bannati:</b> " . totalScammer(), "$scam_channel_id", '25', NULL, 'HTML', TRUE);


	editMessageText("<b>#Supporter</b>
	╔════════════════╗
$msg	║
	╚════════════════╝
	", "$scam_channel_id", '34', NULL, 'HTML', TRUE);
}

##################################################################################
/////////////////////////////////////START////////////////////////////////////////
##################################################################################
$messaggiostart = "<b>💭 Benvenuto <a href='tg://user?id=$from_id'>$from_first_name</a>!</b>\n\n🧑‍💻 Questo è il bot ufficiale di @YourChannel.\n\n<b>📃 Qual'è la mia utilità?\n</b><i>Servo a bannare automaticamente i truffatori da un gruppo, per capire come, clicca ".'"<b>Guida</b>"!</i>';

$limiter = true;
if ($limiter) {
	if (stripos($text,'/start')===0 && $chat_type=='private') {
		sendmessage($chat_id, "$messaggiostart", 'HTML', NULL, NULL, NULL, $home);
		deleteMessage($chat_id, $message_id);
	}
	//HOME
	switch ($data) {
		case 'home':
			editMessageText("$messaggiostart", $message_chat_id, $message_message_id, null, 'HTML', null, $home);
			break;
		case 'info':
			editMessageText("<b>Guida all'uso</b>\n\n<b>Come utilizzarmi?</b>\n<i>Devi semplicemente aggiungermi al tuo gruppo, rendermi amministratore ed eseguire /done (nel gruppo).</i>\n\n<b>Cosa faccio esattamente?</b>\n<i>Banno tutti i truffatori segnalati da @YourChannel dai gruppi in cui sono admin.</i>\n\n<b>Come posso segnalare uno scammer?</b>\n<i>Basta scrivere ad una delle persone in </i><a href='https://t.me/ScamBlackListChannel/34'>questa lista.</a>\n\n<b>Se non hai capito digita /tutorial per vedere un esempio pratico.</b>", $message_chat_id, $message_message_id, NULL, 'HTML', TRUE, $info);
			break;
		case 'faq':
			editMessageText("<b>FAQ</b>\n\n<b>Quando aggiungo il bot al mio gruppo vengono bannati proprio tutti i truffatori?</b>\n<i>La risposta è si, tutti quelli già segnalati e che verranno segnalati. In caso il truffatore non sia mai entrato nel gruppo e il bot non sia risucito a bannarlo, quando entra verrà bannato in automatico.</i>\n\n<b>Se tolgo il bot i truffatori rimarranno bannati?</b>\n<i>Si, rimarranno comunque bannati dal gruppo, ma non quelli segnalati in seguito.</i>", $message_chat_id, $message_message_id, null, 'HTML', null, $faq);
			break;
		case 'moreinfo':
			editMessageText("<b>Informazioni</b>\n\nQuesto bot è nato il giorno 2 marzo 2020 ed è stato programmato completamente in <b>PHP 7.2</b> da <a href='tg://user?id=YourID'>YourName</a> e <a href='tg://user?id=YourSecondID'>YourSecondName</a>.\n\n<b>Versione attuale:</b> <code>1.0</code>\n\n<b>Ringraziamo</b> tutti gli utenti che ogni giorno ci <b>segnalano</b> nuovi truffatori.", $message_chat_id, $message_message_id, null, 'HTML', null, $faq);
			break;
		case 'listacomandi':
		editMessageText("<b>Comandi disponibili</b>\n
<b>/tutorial » </b><i>Semplice spiegazione di come usare il bot.</i>
\n<b>/status »  </b><i>Controlla le statistiche del bot, controllando numero di bannati e numero di gruppi in cui è contenuto il bot.</i>
\n<b>/check [ID] »  </b><i>Controlla che quell'id sia presente nei nostri database. (In alternativa si può inoltrare un messaggio della persona da controllare).</i>
\n<b>/pref »  </b><i>Da eseguire in un gruppo, sceglie la procedura da effettuare quando un utente viene bannato.</i>
\n<b>/supporto »  </b><i>Da eseguire in un gruppo, invia una richiesta di supporto agli amminitratori si SBL.</i>", $message_chat_id, $message_message_id, null, 'HTML', null, $listacomandi);
		break;
	}
} else {
	sendMessage("YourID", "Qualcuno sta spammando\nUtente: $from_first_name\nID: $from_id\nCHAT_ID: $chat_id", 'HTML');
	die;
}

##################################################################################
/////////////////////////////////////PUBBLICI/////////////////////////////////////
##################################################################################
if ($limiter) {
	//STATUS
	if (stripos($text, "/status")===0 || stripos($text, "/stato")===0 || stripos($text, "/about")===0 || stripos($text, "/info")===0) {
	 sendMessage($chat_id, "
	 <i>Ecco un piccolo resoconto del bot:</i>
	 \n<b>👑 Gruppi »</b> [ <b>" .totalGroup(). "</b> ]
	 \n<b>🔮 Supporters »</b> [ <b>" .totalSupporter() . "</b> ]
	 \n<b>🔎 Scammers Bannati »</b> [ <b>" . totalScammer(). "</b> ]
	 ", 'HTML');
	}

	//CHECK
	if (stripos($text, "/check ")===0 || stripos($text, "/verifica ")===0 || stripos($text, "/controlla ")===0) {
		$IDX = explode(" ", $text, 2)[1];
		if(is_numeric($IDX)) {
			if(isScammer($IDX)) {
				$proff = getProof("$IDX");
				sendMessage($chat_id, "L'<a href='tg://user?id=$IDX'>utente</a> è uno scammer!\nProve » <a href='$proff'>Clicca Qua</a> ", 'HTML', TRUE);
			} else {
				sendMessage($chat_id, "L'<a href='tg://user?id=$IDX'>utente</a> non è presente nella nostra blacklist.\n<b>Attenzione:</b> non esser blacklistato non implica essere legit!", 'HTML');
			}
		} else {
			sendMessage($chat_id, "<b>⚠️ ATTENZIONE:</b> inserire un <b>ID valido</b>!", 'HTML');
		}
	} elseif ($text == "/check" || $text == "/verifica" || $text == "/controlla") {
		sendMessage($chat_id, "<b>⚠️ ATTENZIONE:</b> devi specificare un <b>ID</b>!", 'HTML');
	}

	//PRIVATA
	if ($chat_type == "private") {
		//CONTROLLO MESSAGGI
		if ($update['message']['forward_from'] && $update['message']['forward_from']['id'] != "93372553") {
			$ID = $update['message']['forward_from']['id'];
			if (isScammer("$ID")) {
				$proff = getProof("$ID");
				sendMessage($chat_id, "⚠️ L'<a href='tg://user?id=$ID'>utente</a> è uno scammer!\nProve » <a href='$proff'>Clicca Qua</a> ", 'HTML', TRUE);
			} else {
				sendMessage($chat_id, "L'<a href='tg://user?id=$ID'>utente</a> non è presente nella nostra blacklist.\n<b>Attenzione:</b> non esser blacklistato non implica essere legit!", 'HTML');
			}
		} elseif ($update['message']['forward_from']['id'] == "93372553") {

			sendMessage($chat_id, "Bella!", 'HTML');

		} elseif ($update['message']['forward_sender_name']) {
			sendMessage($chat_id, "⚠️ L'utente ha la privacy privata!", 'HTML');
		}

		//TUTORIAL
		if (stripos($text, "/tutorial")===0) {
			sendVideo($chat_id, "BAADBAADfQcAAik4CVCe7UQ_FbTJoBYE");
		}
	}

	//SUPPORTO
	if (stripos($text, "/supporto")===0) {
		if ($chat_type != "private") {
			if ($from_id_admin_check == "administrator" or $from_id_admin_check == "creator") {
				if (supportGet("$chat_id") == "0") {
					if ($chat_id != "-1001294303004" && $chat_id != "-1001187514657") {
						sendMessage($chat_id, "⚠️ <b>Richiesta di supporto inviata correttamente</b> ⚠️\n\n<i>🔰 A breve entrerà un supporter a risolvere il problema!</i>", 'HTML');
						$dio = exportChatInviteLink($chat_id);
						enableSupport("$chat_id");
					//	$pata = json_encode($dio, JSON_PRETTY_PRINT);
						$dioa = $dio['result'];
						$menu['inline_keyboard'] =
						[
							[
								[
									'text' => "🔰 ENTRA 🔰",
									'url' => "$dioa",
								],

							]
						];
						sendMessage("-1001294303004", "⚠️ Richiesta di supporto ⚠️\n\nClicca qua sotto per entrare a dare supporto!", 'HTML', NULL, NULL, NULL, $menu);
					} else {
						sendMessage("-1001294303004", "Siamo nel gruppo di ScamBlackList...", 'HTML', NULL, NULL, NULL, $menu);
					}
				} else {
					sendMessage($chat_id, "⚠️ <b>ATTENZIONE</b>: Hai già richiesto supporto, sei pregato di attendere l'intervento di un supporter!", 'HTML');
				}
			} else {
				sendMessage($chat_id, "⚠️ Per richiedere supporto devi essere <b>amministratore</b> del gruppo!", 'HTML');
			}
		} else {
			sendMessage($chat_id, "⚠️ Non puoi eseguire questo comando in una <b>chat privata!</b>", 'HTML');
		}
	}

	if (supportGet("$chat_id") == "1") {
		$SUPPORTERJOIN = $update['message']['new_chat_member']['id'];
		$SUPPORTERLEFT = $update['message']['left_chat_member']['id'];
		if (isSupporter("$SUPPORTERJOIN")) {
			sendMessage($chat_id, "<b>🔰 Un supporter è entrato!</b>\n\n<i>Spiegategli il problema e provvererà a risolvere il prima possibile!</i>", 'HTML');
		} elseif (isSupporter("$SUPPORTERLEFT")) {
			sendMessage($chat_id, "<b>🔰 Il supporter è uscito!</b>", 'HTML');
			disableSupport("$chat_id");
		}
	}

	//PREF
	if (stripos($text, "/pref")===0) {
		if ($chat_type != "private") {
			if ($from_id_admin_check == "administrator" or $from_id_admin_check == "creator") {
				$attuale = "ERRORE";
				$patatine = prefGet($chat_id);
				if($patatine == "1") {
					$attuale = "Ban";
				} else if($patatine == "2") {
					$attuale = "Avverti";
				} else if($patatine == "3") {
					$attuale = "Muta";
				} else {
					$attuale = "ERRORE";
				}
				sendMessage($chat_id, "<b>🛠 Preferenze</b> [ Attuale: <b>$attuale</b> ]\n\n<i>Scegli l'operazione da eseguire quando un truffatore viene Reportato. (In tutti i casi ci sarà un avvertimento nel gruppo)</i>", 'HTML', NULL, NULL, NULL, $pref);
				deleteMessage($chat_id, $message_id);
			} else {
				sendMessage($chat_id, "⚠️ Questo comando è eseguibile sono <b>dagli amminstratori!</b>", 'HTML');
			}
		} else {
			sendMessage($chat_id, "⚠️ Questo comando è eseguibile sono <b>nei gruppi!</b>", 'HTML');
		}
	}
	//CALLBACK

	//PREF
	if (stripos($data, 'pref')===0 && (getChatMember($message_chat_id, $from_id)['result']['status'] == "administrator" or getChatMember($message_chat_id, $from_id)['result']['status'] == "creator")) {
		$patatine = prefGet($chat_id);
		if($patatine == "1") {
			$attuale = "Ban";
		} else if($patatine == "2") {
			$attuale = "Avverti";
		} else if($patatine == "3") {
			$attuale = "Muta";
		} else {
			$attuale = "ERRORE";
		}
		editMessageText("<b>🛠 Preferenze</b> [ Attuale: <b>$attuale</b> ]\n\n<i>Scegli l'operazione da eseguire quando un truffatore viene Reportato. (In tutti i casi ci sarà un avvertimento nel gruppo)</i>", $message_chat_id, $message_message_id, null, 'HTML', null, $pref);
	}

	switch ($data) {
		case 'ban':
			prefSet($message_chat_id, 1);
			$patatine = prefGet($message_chat_id);
			if($patatine == "1") {
				$attuale = "Ban";
			} else if($patatine == "2") {
				$attuale = "Avverti";
			} else if($patatine == "3") {
					$attuale = "Muta";
			} else {
				$attuale = "ERRORE";
			}
			editMessageText("<b>🛠 Preferenze</b> [ Attuale: <b>$attuale</b> ]\n\n<i>Scegli l'operazione da eseguire quando un truffatore viene Reportato. (In tutti i casi ci sarà un avvertimento nel gruppo)</i>", $message_chat_id, $message_message_id, null, 'HTML', null, $pref);
			break;

		case 'avverti':
			prefSet($message_chat_id, 2);
			$patatine = prefGet($message_chat_id);
			if($patatine == "1") {
				$attuale = "Ban";
			} else if($patatine == "2") {
				$attuale = "Avverti";
			} else if($patatine == "3") {
				$attuale = "Muta";
			} else {
				$attuale = "ERRORE";
			}
			editMessageText("<b>🛠 Preferenze</b> [ Attuale: <b>$attuale</b> ]\n\n<i>Scegli l'operazione da eseguire quando un truffatore viene Reportato. (In tutti i casi ci sarà un avvertimento nel gruppo)</i>", $message_chat_id, $message_message_id, null, 'HTML', null, $pref);
			break;

		case 'muta':
			prefSet($message_chat_id, 3);
			$patatine = prefGet($message_chat_id);
			if($patatine == "1") {
				$attuale = "Ban";
			} else if($patatine == "2") {
				$attuale = "Avverti";
			} else if($patatine == "3") {
				$attuale = "Muta";
			} else {
				$attuale = "ERRORE";
			}
			editMessageText("<b>🛠 Preferenze</b> [ Attuale: <b>$attuale</b> ]\n\n<i>Scegli l'operazione da eseguire quando un truffatore viene Reportato. (In tutti i casi ci sarà un avvertimento nel gruppo)</i>", $message_chat_id, $message_message_id, null, 'HTML', null, $pref);
			break;

		case 'close':
			deleteMessage($message_chat_id, $message_message_id);
			break;
	}
}
##################################################################################
/////////////////////////////////////////VIP//////////////////////////////////////
##################################################################################

if (isVip("$from_id") or isAdmin("$from_id") or isSupporter("$from_id")) {
	//SBL
	if (stripos($text, ".sbl")===0) {
		sendMessage($chat_id, "$from_first_name è veramente un <b>figone!</b> 🤩", 'HTML');
	}
}
##################################################################################
/////////////////////////////////////SUPPORTER////////////////////////////////////
##################################################################################

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

if (isAdmin("$from_id") or isSupporter("$from_id") && $chat_id == "-1001294303004") {

	//NBAN [NOME] [ID] [PROVE] [DESCRIZIONE]
	if (stripos($text, "/nban ")===0) {
		//CONFIG
		$dd = false;
		$first = microtime_float();
		$CONFIG = explode(" ", $text, 5);
		$NOME = $CONFIG[1];
		$ID = $CONFIG[2];
		$PROVE = $CONFIG[3];
    $DESCHI = $CONFIG[4];
		$DESCA = str_replace("'", "", $CONFIG[4]);
		$DESC = str_replace('"', "", $DESCA);
		if (!isAdmin("$ID") and !isSupporter("$ID") and $ID != $BOT_ID) {
			if (!isScammer("$ID")) {
				if (stripos($PROVE, "http")===0) {
					//MESSAGGIO CANALE

				  $menu['inline_keyboard'] =
				  [
						[
							[
								'text'          => '✉️ Prove',
								'url' => "$PROVE"
							]
						],
				  ];
					//BAN INSTANT + MESSAGGIO GRUPPI
					addScammer($ID, $PROVE, $DESC, $from_id);
					global $query;
					$action = "SELECT * FROM groups";
					$result = mysqli_query($query, $action);
					$total = totalGroup();
					forwardMessage($scam_channel_id, $scam_channel_id, 425, false);
					sendMessage("-1001494441769", "<b>👤 Nome truffatore</b>\n<a href='tg://user?id=$ID'>$NOME</a>\n\n<b>ID</b> » <code>$ID</code>\n\n<b>📄 Descrizione</b>\n<i>$DESCHI</i>\n\n╔════════Info════════╗\n\n<b>⌛ Orario</b> » $time\n<b>🔰 Supporter</b> » <a href='tg://user?id=$from_id'>$from_username</a>\n<b>📢 Canale</b> » <a href='https://t.me/ScamBlackListRedirect'>ScamBlackList</a>\n\n╚════════🗃════════╝", 'HTML', true, NULL, NULL, $menu);
					if (mysqli_num_rows($result) > 0) {
						for ($i=0; $i < mysqli_num_rows($result); $i++) {
							$row = mysqli_fetch_assoc($result);
				      $at = $row["tgid"];
							$pref = $row["pref"];
							if ($pref == "1") {
								kickChatMember("$at", "$ID");
								sendMessage($at, "⚠️ <a href='tg://user?id=$ID'>$NOME</a> è stato BlackListato\n<b>Prove</b> » <a href='t.me/ScamBlackListChannel'>ScamBlackList</a>\n<i>[Lo scammer è stato BANNATO]</i>", 'HTML', true);
							} elseif ($pref == "2") {
								sendMessage($at, "⚠️ <a href='tg://user?id=$ID'>$NOME</a> è stato BlackListato\n<b>Prove</b> » <a href='t.me/ScamBlackListChannel'>ScamBlackList</a>", 'HTML', true);
							} elseif ($pref == "3") {
								restrictChatMember($at, $ID, ['can_send_messages' => false]);
								sendMessage($at, "⚠️ <a href='tg://user?id=$ID'>$NOME</a> è stato BlackListato\n<b>Prove</b> » <a href='t.me/ScamBlackListChannel'>ScamBlackList</a>\n<i>[Lo scammer è stato MUTATO]</i>", 'HTML', true);
							}
							sleep(0.3);
						}
						$dd = true;
					}
				} else {
					sendMessage($chat_id, "<b>Something's wrong, i can feel it.</b> (Devi inserire un link valido)", 'HTML');
				}
			} else {
				sendMessage($chat_id, "<b>Something's wrong, i can feel it.</b> (Lo scammer è gia bannato)", 'HTML');
			}
		} else {
			sendMessage($chat_id, "<b>Something's wrong, i can feel it.</b> (non puoi BlackListare un Supporter o un Admin...)", 'HTML');
		}
		updateMSG();
		if($dd) {
			$now = microtime_float();
			$laga = ($now - $first);
			$total = totalGroup();
			$lag = round($laga, 4);
			sendMessage($chat_id, "BlackList eseguita in [ <b>$total</b> ] gruppi, <b>Tempo impiegato: $lag (Sec)</b>", 'HTML');
		}
	} elseif ($text == "/nban") {
		sendMessage($chat_id, "<b>Something's wrong, i can feel it.</b> (Devi inserire degli argomenti...)", 'HTML');
	}

	if (stripos($text, "/snban ")===0) {
		$CONFIG = explode(" ", $text, 5);
		$NOME = $CONFIG[1];
		$ID = $CONFIG[2];
		$PROVE = $CONFIG[3];
		$DESCA = str_replace("'", "", $CONFIG['4']);
		$DESC = str_replace('"', "", $DESCA);
		if (!isAdmin("$ID") and !isSupporter("$ID") and $ID != $BOT_ID) {
			if (stripos($PROVE, "http")===0) {
				$result = addScammer($ID, $PROVE, $DESC, $from_id);
				sendMessage($chat_id, "<b>$result</b>", 'HTML');
				sendMessage($chat_id, "<a href='tg://user?id=$ID'>$NOME</a> è stato BlackListato\n<b>Prove</b> » $PROVE | Desc: $DESC", 'HTML');
				global $query;
				$action = "SELECT * FROM groups";
				$result = mysqli_query($query, $action);
				$total = totalGroup();
				if (mysqli_num_rows($result) > 0) {
					for ($i=0; $i < mysqli_num_rows($result); $i++) {
						$row = mysqli_fetch_assoc($result);
						$at = $row["tgid"];
						kickChatMember("$at", "$ID");
						sleep(0.3);
					}
				}
			} else {
				sendMessage($chat_id, "<b>Something's wrong, i can feel it.</b> (Devi inserire un link valido)", 'HTML');
			}
		} else {
			sendMessage($chat_id, "<b>Something's wrong, i can feel it.</b> (non puoi BlackListare un Supporter o un Admin...)", 'HTML');
		}
		updateMSG();
	} elseif ($text == "/snban") {
		sendMessage($chat_id, "<b>Something's wrong, i can feel it.</b> (Devi inserire degli argomenti...)", 'HTML');
	}

	if (stripos($text, "/doinfo")===0) {
		$args = explode(" ", strtolower($text));
		if($args[1] == "") {
			$date  = date("Y-m-d");
			$msg = "<b>Ecco le statistiche:</b> \nScammers bannati oggi ($date):\n\n";
			$supporters = arrayGetSupporter();
			foreach($supporters as $sid) {
				$nome = getChat("$sid")["result"]["first_name"];
				$id = getChat("$sid")["result"]["username"];
				$totali = totalScammers($date, $sid);
				$msg .= "\n👮‍♀️ <a href='t.me/$id'>$nome</a> ha bannato <b>$totali</b> scammers.\n";
			}
		} elseif ($args[1] == "ieri") {
			$dayy  = date("d");
			$month = date("Y-m-");
			$day = $dayy-1;
			if($day <= 9) {
				$day = "0" . $day;
			}
			$date = $month . $day;
			$msg = "<b>Ecco le statistiche:</b> \nScammers bannati ieri ($date):\n\n";
			$supporters = arrayGetSupporter();
			foreach($supporters as $sid) {
				$nome = getChat("$sid")["result"]["first_name"];
				$id = getChat("$sid")["result"]["username"];
				$totali = totalScammers($date, $sid);
				$msg .= "\n👮‍♀️ <a href='t.me/$id'>$nome</a> ha bannato <b>$totali</b> scammers.\n";
			}
		} elseif ($args[1] == "totali" || $args[1] == "tot" || $args[1] == "totale" || $args[1] == "total") {
			$msg = "<b>Ecco le statistiche:</b> \nScammers bannati Totalmente:\n\n";
			$supporters = arrayGetSupporter();
			foreach($supporters as $sid) {
				$nome = getChat("$sid")["result"]["first_name"];
				$id = getChat("$sid")["result"]["username"];
				$totali = totalScammersNoData($sid);
				$msg .= "\n👮‍♀️ <a href='t.me/$id'>$nome</a> ha bannato <b>$totali</b> scammers.\n";
			}
		} else {
			$fixdate = explode("-", $args[1]);
			//rebuilding date :D
			if(is_numeric($fixdate[0]) && is_numeric($fixdate[1]) && is_numeric($fixdate[2])) {
				if($fixdate[1] <=9 && !(stripos($fixdate[1], "0")===0)) {
					$fixdate[1] = "0" . $fixdate[1];
				}
				if($fixdate[2] <=9 && !(stripos($fixdate[2], "0")===0)) {
					$fixdate[2] = "0" . $fixdate[2];
				}
				$date = $fixdate[0]. "-" . $fixdate[1] . "-" . $fixdate[2];
				$msg = "<b>Ecco le statistiche:</b> \nScammers bannati ieri ($date):\n\n";
				$supporters = arrayGetSupporter();
				foreach($supporters as $sid) {
					$nome = getChat("$sid")["result"]["first_name"];
					$id = getChat("$sid")["result"]["username"];
					$totali = totalScammers($date, $sid);
					$msg .= "\n👮‍♀️ <a href='t.me/$id'>$nome</a> ha bannato <b>$totali</b> scammers.\n";
				}
			} else {
				$msg = "errore formato data errato usare --> anno-mese-giorno es: 2020-02-03";
			}
		}
	sendMessage($chat_id, "$msg", 'HTML', true);
	}

	//UNBAN
	if (stripos($text, "/unban ")===0) {
		$CONFIG = explode(" ", $text);
		$IDz = $CONFIG[1];
		$action = "SELECT * FROM groups";
		$result = mysqli_query($query, $action);
		$total = totalGroup();
		delScammer("$IDz");
		sendMessage($chat_id, "<b>Utente sbannato da</b> [ <b>$total </b>] <b>gruppi!</b>", 'HTML');
		if (mysqli_num_rows($result) > 0) {
			for ($i=0; $i < mysqli_num_rows($result); $i++) {
				$row = mysqli_fetch_assoc($result);
				unbanChatMember($row["tgid"], $IDz);
			}
		}
		delScammer("$IDz");
		sendMessage($chat_id, "Fattoh.");
	} elseif ($text == "/unban") {
		sendMessage($chat_id, "<b>Something's wrong, i can feel it.</b> (Devi inserire degli argomenti...)", 'HTML');
	}
}

##################################################################################
/////////////////////////////////////ADMIN////////////////////////////////////////
##################################################################################

if (isAdmin("$from_id")) {

	if($text == "/parigay") {
		$ora= microtime_float();
		$end = microtime_float();
		$lagg = $end-$ora;
		$lag = round($lagg, 4);
		sendMessage($chat_id, ".");
	}
	if (isMaintenance()) {
		$smaint="Attiva";
	} else {
		$smaint="Inattiva";
	}
	//CONFIG
	if (stripos($text, "/config")===0) {
		sendMessage($chat_id, "<b>🛠 Manuntenzione</b> [ <b>$smaint</b> ] | Attivare/Disattivare manuntenzione?", 'HTML', NULL, NULL, NULL, $mnt_config);
	}

	switch ($data) {
		case 'mnt_btt':
			editMessageText("<b>🛠 Manuntenzione</b> [ <b>$smaint</b> ] | Attivare/Disattivare manuntenzione?", $message_chat_id, $message_message_id, null, 'HTML', null, $mnt_config);
			break;

		case 'mnt_enb':
			editMessageText("<b>MAINTENANCE ABILITATA</b>", $message_chat_id, $message_message_id, null, 'HTML', null, $mnt);
			enableMaintenance();
			break;

		case 'mnt_disb':
			editMessageText("<b>MAINTENANCE DISABILITATA</b>", $message_chat_id, $message_message_id, null, 'HTML', null, $mnt);
			disableMaintenance();
			break;

		case 'close':
			deleteMessage($message_chat_id, $message_message_id);
			break;
	}

	//TEST
	/*
	if (stripos($text, "/ig")===0) {
		$client_id = '9537e5787562747';
		$file = file_get_contents("test-image.png");
		$url = 'https://api.imgur.com/3/image.json';
		$headers = ["Authorization: Client-ID $client_id"];
		$pvars  = ['image' => base64_encode($file)];
		$curl = curl_init();
		curl_setopt_array($curl, [CURLOPT_URL=> $url, CURLOPT_TIMEOUT => 30, CURLOPT_POST => 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_HTTPHEADER => $headers, CURLOPT_POSTFIELDS => $pvars]);
		$json_returned = curl_exec($curl);
		echo "Result: " . $json_returned ;
		curl_close ($curl);
	}
	*/
	//STATS
	if (stripos($text, "/stats")===0) {
		$status = getPendingCount()-1;
		if ($status <= 20) {
			sendMessage($chat_id, "✅ <a href='https://t.me/ScamBlackListChannel/25'>Stato</a> » <i>Quiete </i>[ <b>$status</b> ]", 'HTML', TRUE);
		} elseif ($status >= 21 and $status <= 50) {
			sendMessage($chat_id, "⚠️ <a href='https://t.me/ScamBlackListChannel/25'>Stato</a> » <i>Allarme </i>[ <b>$status</b> ]", 'HTML', TRUE);
		} else {
			sendMessage($chat_id, "❌ <a href='https://t.me/ScamBlackListChannel/25'>Stato</a> » <i>Crash </i>[ <b>$status</b> ]", 'HTML', TRUE);
		}
	}
	/*
	//RESOLVER
	if (stripos($text, "/resolve ")===0) {
		$args= explode(" ", $text);
		//$total = totalGroup();
		$getchat = getChat($args[1]);
		$exec = $getchat["ok"];
		$result = $getchat["result"];
		if ($exec == "true"){
         		$result = $getchat["result"];

             	       $nome = $result["first_name"];
  			sendMessage($chat_id, $nome, 'HTML');
		}

	        $id = getChat("$sid")["result"]["username"];

		sendMessage($chat_id, "Risolvi: " .$args['1'], 'HTML');
	}*/

	if (stripos($text, "/grupz")===0) {
		updateMSG();
		$groupz = arrayGetGroups();
		foreach ($groupz as $group) {
			$dio = exportChatInviteLink($group);
			$invite = getChat($group)['result']['username'];
			$invites = getChat($group)['result']['invite_link'];
			if ($invite) {
				$sos = "@$invite";
			} elseif ($invites) {
				$sos = $invites;
			} else {
				$sos = $dio;
			}
			if (!$sos) {
				//delGroup($group);
			}
			$lista .= "\n$group > $sos";
			}
		sendMessage($chat_id, $lista);
	}

	if (stripos($text, "/sasso") === 0) {
		$groupzzz = arrayGetGroups();
		foreach ($groupzzz as $group) {
			$total = getChatMembersCount($group)['result'] + $total;
		}
		sendMessage($chat_id, "Utenti totali: $total");
	}

	if (stripos($text, "/uwu")===0) {
		sendMessage($chat_id, "Utenti: ".totalUser(), 'HTML');
		sleep(10);
		deleteMessage($chat_id, $message_id+1);
	}

	//NETMESSAGE
	if (stripos($text, "/nmsg ")===0) {
		$SUSS = explode(" ", $text, 2);
		$TESTOS = $SUSS[1];
		global $query;
		$action = "SELECT * FROM groups";
		$result = mysqli_query($query, $action);
		$total = totalGroup();
		sendMessage($chat_id, "<b>Messaggio inviato a</b> [ <b>$total </b>] <b>gruppi!</b>", 'HTML');
		if (mysqli_num_rows($result) > 0) {
			for ($i=0; $i < mysqli_num_rows($result); $i++) {
				$row = mysqli_fetch_assoc($result);
				sendMessage($row["tgid"], "$TESTOS", 'HTML');
			}
		}
	}

}

##################################################################################
/////////////////////////////////////AUTOMATICO///////////////////////////////////
##################################################################################

//SISTEMA PERMESSI GRUPPI

#admin check
$bot_admin_check = getChatMember($chat_id, $BOT_ID)['result']['status'];

#perms check
$bot_can_restrict_members = getChatMember($chat_id, $BOT_ID)['result']['can_restrict_members'];
$bot_can_invite_users = getChatMember($chat_id, $BOT_ID)['result']['can_invite_users'];

if ($update['message']['new_chat_member']['id'] == "$BOT_ID" or $update['message']['group_chat_created'] or $update['message']['supergroup_chat_created']) {
	sendMessage($chat_id, "<b>Ciao!</b>\n<i>Grazie per avermi aggiunto al vostro gruppo!</i>\n\nImpostatemi <b>amministratore</b> (con almeno i permessi di Bloccare Utenti e Invitare utenti tramite link), dopodichè eseguite /done per cominciare a bannare gli scammer presenti nella blacklist.\n\n<b>Attenzione:</b> Se non mi imposti admin non potrò funzionare!", "HTML");
}

if ($update['message']['left_chat_member']['id'] == "$BOT_ID") {
	if (isGroup("$chat_id")) {
		delGroup("$chat_id");
	}
}

if (!$bot_can_invite_users or !$bot_can_restrict_members) {
	if (isGroup("$chat_id")) {
		delGroup("$chat_id");
		sendMessage($chat_id, "Non ho i permessi di <b>Bloccare Utenti</b> o di <b>Invitare utenti tramite link</b>\nProcedo ad uscire dal gruppo.", 'HTML');
		leaveChat($chat_id);
	}
}

//SISTEMA GROUPBAN
if ($chat_type != "private" and $chat_type != "channel") {
	if (stripos($text, "/done")===0) {
		if (!isGroup("$chat_id")) {
			if ($bot_admin_check == "administrator") {
				if ($bot_can_restrict_members) {
					if ($bot_can_invite_users) {
						addGroup("$chat_id");
						sendMessage($chat_id, "🔰 Inizio procedura di ban dei <b>Truffatori!</b>\n\n<b>⚠️ Nota bene</b>: <a>Essendo molti, il processo verrà diluito probabilmente nei prossimi minuti</a>.", 'HTML');
						global $query;
						$action = "SELECT * FROM scammers";
						$result = mysqli_query($query, $action);
						if (mysqli_num_rows($result) > 0) {
							for ($i=0; $i < mysqli_num_rows($result); $i++) {
								$row = mysqli_fetch_assoc($result);
				        $id = $row["tgid"];
								kickChatMember($chat_id, "$id");
				        sleep(0.7);
							}
						}
					} else {
						sendMessage($chat_id, "⚠️ Mi manca il permesso di <b>invitare utenti tramite link</b>!", 'HTML');
					}
				} else {
					sendMessage($chat_id, "⚠️ Mi manca il permesso di <b>bannare gli scammer</b>!", 'HTML');
				}
			} else {
				sendMessage($chat_id, "<b>Non</b> sono amministratore!", 'HTML');
			}
		} else {
			sendMessage($chat_id, "Hai già eseguito <b>/done</b> in questo gruppo!", 'HTML');
		}
	}
	$joined = $update['message']['new_chat_member']['id'];
	if (isScammer("$joined")) {
		$patatine = prefGet($chat_id);
		if($patatine == "1") {
			sendMessage($chat_id, "Uno <a href='tg://user?id=$joined'>scammer</a> è appena entrato in chat!\nL'ho <b>bannato</b>.", 'HTML');
			kickChatMember($chat_id, "$joined");
		} else if($patatine == "2") {
			sendMessage($chat_id, "Uno <a href='tg://user?id=$joined'>scammer</a> è appena entrato in chat!", 'HTML');
		} else if($patatine == "3") {
			sendMessage($chat_id, "Uno <a href='tg://user?id=$joined'>scammer</a> è appena entrato in chat!\nL'ho <b>mutato</b>.", 'HTML');
			restrictChatMember($chat_id, $joined, ['can_send_messages' => false]);
		}
	}
}

##################################################################################
////////////////////////////////////////GRUPPO////////////////////////////////////
##################################################################################

//ADDUSERS (FUCK PRiVACY)
if (!isUser("$from_id") && !$update['message']['from']['is_bot']) {
	addUser("$from_id");
}

if ($chat_id == "-1001187514657") {
	//REP
	if (stripos($text, "+rep")===0) {
		if ($update['message']['reply_to_message']['from']['id']) {
			if (!$update['message']['reply_to_message']['from']['is_bot']) {
				if ($update['message']['reply_to_message']['from']['id'] != $from_id) {
					sendMessage($chat_id, "Feed positivo aggiunto a ". $update['message']['reply_to_message']['from']['first_name']);
					$id = $update['message']['reply_to_message']['from']['id'];
					addRep("$id");
				} else {
					sendMessage($chat_id, "Mi dispiace, ma non puoi darti feed da solo...", 'HTML');
				}
			} else {
				sendMessage($chat_id, "Mi dispiace, ma i bot non vendono...", 'HTML');
			}
		} else {
			sendMessage($chat_id, "Devi rispondere ad un messaggio del <b>venditore</b>!", 'HTML');
		}
	}
}

//REPS
if (stripos($text, ".reps")===0 && !$update['message']['reply_to_message']['from']['id']) {
	sendMessage($chat_id, "🔰 Reps (Feeds) di <b>$from_first_name</b>\n\n📦 Rep: ". getRep("$from_id"), 'HTML');
} elseif (stripos($text, ".reps")===0 && $update['message']['reply_to_message']['from']['id']) {
	if (!$update['message']['reply_to_message']['from']['is_bot']) {
		$id = $update['message']['reply_to_message']['from']['id'];
		$name = $update['message']['reply_to_message']['from']['first_name'];
		sendMessage($chat_id, "🔰 Reps (Feeds) di <b>$name</b>\n\n📦 Rep: ". getRep("$id"), 'HTML');
	} else {
		sendMessage($chat_id, "Mi dispiace, ma i bot non vendono...", 'HTML');
	}
}

/*
$api = $_POST['api'];
$link = strip_tags($_POST['link']);
$connections = $_POST['connections'];
$link = $link . '?api=' . $api;
$responseWebhook = setWebhook($api, $link, null, $connections);
$response = getMeApi($api);
*/

##################################################################################
///////////////////////////////////////CLONI//////////////////////////////////////
##################################################################################
	//CLONE 
    //function setWebhook($api, $url, $certificate = null, $max_connections = null, $allowed_updates = null)
	if (stripos($text, "/clone ")===0) {
		$bot_token = explode(" ", $text, 2)[1];
        $links = "https://spacenetwork.altervista.org/BlackListTG/commands.php";
        //$links = urlencode($linkss);
		$connections = '100';
		$link = $links . '?api=' . $bot_token;
		$responseWebhook = setWebhook($bot_token, $link, null, $connections);
		$response = getMeApi($bot_token);
        $r = $responseWebhook['description'];
    if ($r == 'Webhook was set' or $r == 'Webhook is already set' and $response['ok'] == true) {
        $username = $response['result']['username'];
        sendMessage($chat_id, 'Setup successful: <a href="http://t.me/' . htmlspecialchars($username) . '"> @' . htmlspecialchars($username) . '</a>', 'HTML');
    } else {
        $resp = $responseWebhook['description'];
        sendMessage($chat_id, "Setup failed: API TOKEN wrong or impossible to connect to Telegram\nResponse: $resp", 'HTML');
    }
	} elseif ($text == "/clone") {
		sendMessage($chat_id, "<b>⚠️ ATTENZIONE:</b> Token non valido!", 'HTML');
	}