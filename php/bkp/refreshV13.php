<?php
//Autor: Wagner Bizarro
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); 

$file_peers_status = '/var/www/html/mtr/json/PeersStatus.json';
$file_queues_status = '/var/www/html/mtr/json/QueuesStatus.json';

$queuestatus = file_get_contents('/var/www/html/mtr/json/QueuesStatus.json');
$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');

$dtqueues = json_decode($queuestatus, true);
$dtpeers = json_decode($peerstatus, true);

//Fixed Error JSON
$error1 = "]]";
$error2 = "]  }";
$error3 = "]   }";
$error4 = "]    }";
$error5 = "]}"; 

if ( (strpos($peerstatus, $error1) !== false) ){
	//echo "CHEQUEI AQUI\n";
	$peerstatusnew = str_replace($error1,']',$peerstatus);
        file_get_contents($file_peers_status);
	file_put_contents($file_peers_status, $peerstatusnew);
	$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');	
	$dtpeers = json_decode($peerstatus, true);
	//print_r($dtpeers);
}

if ( (strpos($peerstatus, $error2) !== false) ){
	$peerstatusnew = str_replace($error2,'',$peerstatus);
	file_put_contents($file_peers_status, $peerstatusnew);
	$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');
	$dtpeers = json_decode($peerstatus, true);
	
}

if ( (strpos($peerstatus, $error3) !== false) ){
	$peerstatusnew = str_replace($error3,'',$peerstatus);
	file_put_contents($file_peers_status, $peerstatusnew);
	$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');
	$dtpeers = json_decode($peerstatus, true);
}

if ( (strpos($peerstatus, $error4) !== false) ){
	$peerstatusnew = str_replace($error4,'',$peerstatus);
	file_put_contents($file_peers_status, $peerstatusnew);
	$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');
	$dtpeers = json_decode($peerstatus, true);
}

if ( (strpos($peerstatus, $error5) !== false) ){
	$peerstatusnew = str_replace($error5,'',$peerstatus);
	file_put_contents($file_peers_status, $peerstatusnew);
	$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');
	$dtpeers = json_decode($peerstatus, true);
}
	
/*if ($statusDtPeer == '')  {	
	shell_exec('cp /var/www/html/mtr/json/PeersStatusTemplate.json /var/www/html/mtr/json/PeersStatus.json');
	$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');
	$dtpeers = json_decode($peerstatus, true);
}
*/
/*if ($dtqueues == ''){
	shell_exec('cp /var/www/html/mtr/json/QueuesStatusTemplate.json /var/www/html/mtr/json/QueuesStatus.json');
	$queuestatus = file_get_contents('/var/www/html/mtr/json/QueuesStatus.json');
	$dtqueues = json_decode($queuestatus, true);
	//echo "QUEUESTATUS ATUALIZADO\n";
}
*/

/*
///$queuestatus = file_get_contents($file_queues_status);
//$peerstatus = file_get_contents($file_peers_status);
$dtqueues = json_decode($queuestatus, true);
$dtpeers = json_decode($peerstatus, true);

//CODE
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
