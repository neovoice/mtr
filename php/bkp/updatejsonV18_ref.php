<?php
//Autor: Wagner Bizarro
$evt = $_POST['evento'];
$name = $_POST['name'];
$stats = $_POST['stats'];

//$evt = "Newstate";
//$name = "1001";
//$stats = "RINGING";

$file_peers = '../json/PeersStatus.json';
$file_queues = '../json/QueuesStatus.json';
$file_peers_ref = '../json/PeersStatusRef.json';
$file_queues_ref = '../json/QueuesStatusRef.json';

$filepeers = file_get_contents($file_peers);
$filequeues = file_get_contents($file_queues);

$fpeers = strtok($filepeers, '%');
$fqueues = strtok($filequeues, '%');

$jsonpeers = json_decode($fpeers, true);
$jsonqueues = json_decode($fqueues, true);

//print_r($jsonqueues);

switch ($evt) {
	case "Newstate":
	case "PeerStatus": 
	case "DeviceStateChange":
	case "ExtensionStatus":
	case "Hangup":
		peerupdate($file_peers_ref,$jsonpeers,$name,$stats);
		break;

	case "QueueCallerJoin":
	case "QueueCallerLeave":
		queueupdate($file_queues_ref,$jsonqueues,$name,$stats);
		break;
	
	default:
		break;
}

function peerupdate($file_peers_ref,$datapeers,$name,$stats) {
	if (is_array($datapeers)) {
	foreach ($datapeers as $key => $entry) {
		if($entry['Peer'] == $name ) {
			if ($stats == '4801') {	
				$datapeers[$key]['DND'] = 1;
				$datapeers[$key]['Status'] = 'Registered';
			}
			if ($stats == '4800'){
				$datapeers[$key]['DND'] = 0;
				$datapeers[$key]['Status'] = 'Registered';
			}
			else {
				$datapeers[$key]['Status'] = $stats;
			}
	}
    }
	$newJsonPeers = json_encode($datapeers, JSON_PRETTY_PRINT);
	file_get_contents($file_peers_ref);
	file_put_contents($file_peers_ref, $newJsonPeers); 
 }
}

function queueupdate($file_queues_ref,$dataqueues,$name,$count) {
	if (is_array($dataqueues)) {
	foreach ($dataqueues as $key => $entry) {
		if($entry['Queue'] == $name ) {
			$dataqueues[$key]['Count'] = $count;
			}
	}
	$newJsonQueues = json_encode($dataqueues, JSON_PRETTY_PRINT);
	file_get_contents($file_queues_ref);
	file_put_contents($file_queues_ref, $newJsonQueues);
   }
}
?>
