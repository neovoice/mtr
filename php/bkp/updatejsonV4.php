<?php
$evt = $_POST['evento'];
$name = $_POST['name'];
$stats = $_POST['stats'];

$file_peers = '../json/PeersStatus.json' ;
$file_queues = 'QueuesStatus.json' ;

if ( $evt == "Newstate" ) {
	peerupdate($file_peers,$name,$stats);
}

if ( $evt == "PeerStatus" ) {
	peerupdate($file_peers,$name,$stats);
}


if ( $evt == "DeviceStateChange" ) {
	peerupdate($file_peers,$name,$stats);
}

if ( $evt == "ExtensionStatus" ) {
	peerupdate($file_peers,$name,$stats);
}

if ( $evt == "Hangup" ) {
	peerupdate($file_peers,$name,$stats);
}

if ( $evt == "QueueCallerJoin" ) {
	queueupdate($file_queues,$name,$stats);
}


if ( $evt == "QueueCallerLeave" ) {
	queueupdate($file_queues,$name,$stats);
}

function peerupdate($file_peers,$name,$stats) {
$Peers = file_get_contents($file_peers);
	$data = json_decode($Peers, true);
	foreach ($data as $key => $entry) {
		if($entry['Peer'] == $name ) {
			$data[$key]['Status'] = $stats;
			//echo $entry['Peer'];
			//echo "\n";
			//echo  $data[$key]['Status'];
			//echo "\n";
			}
	}
	$newJsonString = json_encode($data);
	file_put_contents($file_peers, $newJsonString); 
}

function queueupdate($file_queues,$name,$count) {
$Queues = file_get_contents($file_queues);
	$data = json_decode($Queues, true);
	foreach ($data as $key => $entry) {
		if($entry['Peer'] == $name ) {
			$data[$key]['Status'] = $stats;
			}
	}
	$newJsonString = json_encode($data);
	 file_put_contents($file_queues, $newJsonString);
}

?>
