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

//Error JSON 
$error1 = "]]";
$error2 = "]  }";
$error3 = "]   }";
$error4 = "]    }";
$error5 = "]}"; 

//FIXED ERRORS PEERS
$fix = 0;
if ( (strpos($peerstatus, $error1) !== false) ){
	$fix = 1;
	fixPeers($error1,$fix,$file_peers_status,$peerstatus);
}

if ( (strpos($peerstatus, $error2) !== false) ){
	fixPeers($error2,$fix,$file_peers_status,$peerstatus);
}

if ( (strpos($peerstatus, $error3) !== false) ){
	fixPeers($error3,$fix,$file_peers_status,$peerstatus);
}

if ( (strpos($peerstatus, $error4) !== false) ){
	fixPeers($error4,$fix,$file_peers_status,$peerstatus);
}

if ( (strpos($peerstatus, $error5) !== false) ){
	fixPeers($error5,$fix,$file_peers_status,$peerstatus);
}

function fixPeers($error,$fix,$file_peers_status,$peerstatus){
	if ($fix == 0){
		$peerstatusnew = str_replace($error,'',$peerstatus);
		}
		else {
			$peerstatusnew = str_replace($error,']',$peerstatus); 
			}
		
		file_get_contents($file_peers_status);
		file_put_contents($file_peers_status, $peerstatusnew);
		$peerstatus = file_get_contents('/var/www/html/mtr/json/PeersStatus.json');
		$dtpeers = json_decode($peerstatus, true);
}

//FIXED ERRORS QUEUES
if ( (strpos($queuestatus, $error1) !== false) ){
	$fix = 1;
	fixQueues($error1,$fix,$file_queues_status,$queuestatus);
}	

if ( (strpos($queuestatus, $error2) !== false) ){
	fixQueues($error2,$fix,$file_queues_status,$queuestatus);
}

if ( (strpos($queuestatus, $error3) !== false) ){
	fixQueues($error3,$fix,$file_queues_status,$queuestatus);
}

if ( (strpos($queuestatus, $error4) !== false) ){
	fixQueues($error4,$fix,$file_queues_status,$queuestatus);
}

if ( (strpos($queuestatus, $error5) !== false) ){
	 fixQueues($error5,$fix,$file_queues_status,$queuestatus);
}

function fixQueues($error,$fix,$file_queues_status,$queuestatus){
	if ($fix == 0){
		$queuestatusnew = str_replace($error,'',$queuestatus); 
	    	}
		else {
		   	$queuestatusnew = str_replace($error,']',$queuestatus);
	           	}
		
		file_get_contents($file_queues_status);
		file_put_contents($file_queues_status, $queuestatusnew);
		$queuestatus = file_get_contents('/var/www/html/mtr/json/QueuesStatus.json');
		$dtqueues = json_decode($queuestatus, true);
	
}


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

?>
