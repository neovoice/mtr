<?php
//Autor: Wagner Bizarro
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); 

$queuestatus = file_get_contents('/var/www/html/mtr/json/QueuesStatus.json');
$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');

//Fixed Error JSON
$error1 = "]]";
$error2 = "]  }";
$error3 = "]   }";
$error4 = "]    }";
$error5 = "]}";

/*
if ( (strpos($peerstatus, $error1) !== false) || (strpos($peerstatus, $error2) !== false) || 
	(strpos($peerstatus, $error3) !== false) || (strpos($peerstatus, $error4) !== false) || (strpos($peerstatus, $error5) !== false) ) {
	shell_exec('cp /var/www/html/mtr/json/PeersStatusTemplate.json /var/www/html/mtr/json/PeersStatus.json');
	$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');
}

if ( (strpos($queuestatus, $error1) !== false) || (strpos($queuestatus, $error2) !== false) ||
	(strpos($queuestatus, $error3) !== false) || (strpos($queuestatus, $error4) !== false) || (strpos($queuestatus, $error5) !== false) ) {
	shell_exec('cp /var/www/html/mtr/json/QueuesStatusTemplate.json /var/www/html/mtr/json/QueuesStatus.json');
	$queuestatus = file_get_contents('/var/www/html/mtr/json/QueuesStatus.json');
}
*/

$dtqueues = json_decode($queuestatus, true);
$dtpeers = json_decode($peerstatus, true);


$statusDtPeer = var_dump($dtpeers);

if ($statusDtPeer == NULL) {
	echo "PeerStatus.JSON corrompido\n";
} else {
	print_r($dtpeers);
}

//if (empty($dtqueues)) {
//	print "Vazio";
//} else { print_r($dtpeers); } 

/*
if (is_array($dtpeers)) {
	foreach ($dtpeers as $key => $etr) {
		$peername = $dtpeers[$key]['Peer'];
		$peerstats =  $dtpeers[$key]['Status'];
		$peerdnd = $dtpeers[$key]['DND'];
		$datap = array(
			"evento"=>"peerstatus",
			"peer"=>"$peername",
			"status"=>"$peerstats",
			"dnd"=>"$peerdnd"
		);
		$strp = json_encode($datap);
		echo "data: {$strp}\n\n";
		flush();
	}

}

if (is_array($dtqueues)) {
	foreach ($dtqueues as $key => $etr) {
		$queuename = $dtqueues[$key]['Queue'];
		$queuecount = $dtqueues[$key]['Count'];
		$dataq = array(
			"evento"=>"queuestatus",
			"queue"=>"$queuename",
			"count"=>"$queuecount"
		);
		$strq = json_encode($dataq);
		echo "data: {$strq}\n\n";
		flush();
	
	}
}
*/
?>
