<?php
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
	$data = json_decode($peers, true);
	if (is_array($data)) {
	foreach ($data as $key => $entry) {
		if($entry['Peer'] == $name ) {
			if ($stats == '4801') {	
				$data[$key]['DND'] = 1;
				$data[$key]['Status'] = 'Registered';
			}
			if ($stats == '4800'){
				$data[$key]['DND'] = 0;
				$data[$key]['Status'] = 'Registered';
			}
			else {
				$data[$key]['Status'] = $stats;
			}
	}
    }
	$newJsonString = json_encode($data);
	file_put_contents($file_peers, $newJsonString); 
 }
}

function queueupdate($file_queues,$name,$count) {
$queues = file_get_contents($file_queues);
	$data = json_decode($queues, true);
	 if (is_array($data)) {
	foreach ($data as $key => $entry) {
		if($entry['Queue'] == $name ) {
			$data[$key]['Count'] = $count;
			}
	}
	$newJsonString = json_encode($data);
	 file_put_contents($file_queues, $newJsonString);
   }
}
?>
