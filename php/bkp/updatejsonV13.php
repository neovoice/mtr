<?php
//Autor: Wagner Bizarro
$evt = $_POST['evento'];
$name = $_POST['name'];
$stats = $_POST['stats'];

$file_peers = '../json/PeersStatus.json';
$file_queues = '../json/QueuesStatus.json';

switch ($evt) {
	case "Newstate":
	case "PeerStatus": 
	case "DeviceStateChange":
	case "ExtensionStatus":
	case "Hangup":
		peerupdate($file_peers,$name,$stats);
		break;

	case "QueueCallerJoin":
	case "QueueCallerLeave":
		queueupdate($file_queues,$name,$stats);
		break;
	
	default:
		break;
}

function peerupdate($file_peers,$name,$stats) {
$peers = file_get_contents($file_peers);
	$datapeers = json_decode($peers, true);
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
	//$newJsonPeers = json_encode($datapeers, JSON_PRETTY_PRINT);
	$newJsonPeers = json_encode($datapeers);
	file_put_contents($file_peers, $newJsonPeers); 
 }
}

function queueupdate($file_queues,$name,$count) {
$queues = file_get_contents($file_queues);
	$dataqueues = json_decode($queues, true);
	 if (is_array($dataqueues)) {
	foreach ($dataqueues as $key => $entry) {
		if($entry['Queue'] == $name ) {
			$dataqueues[$key]['Count'] = $count;
			}
	}
	//$newJsonQueues = json_encode($dataqueues, JSON_PRETTY_PRINT);
	$newJsonQueues = json_encode($dataqueues);
	file_put_contents($file_queues, $newJsonQueues);
   }
}

?>
