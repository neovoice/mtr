<?php
$evt = $_POST['evento'];
$name = $_POST['name'];
$stats = $_POST['stats'];

$file_peers = '../json/PeersStatus.json' ;
$file_queues = 'QueuesStatus.json' ;

if ( $evt == "Newstate" ) {
	$PeersAdylnet = file_get_contents($file_peers);
	$data = json_decode($PeersAdylnet, true);

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

if ( $evt == "PeerStatus" ) {
	$PeersAdylnet = file_get_contents($file_peers);
	$data = json_decode($PeersAdylnet, true);

	foreach ($data as $key => $entry) {
		if($entry['Peer'] == $name ) {
			$data[$key]['Status'] = $stats;
		}
    	}
    	$newJsonString = json_encode($data);
    	file_put_contents($file_peers, $newJsonString);		
}

if ( $evt == "DeviceStateChange" ) {
	$PeersAdylnet = file_get_contents($file_peers);
	$data = json_decode($PeersAdylnet, true);

	foreach ($data as $key => $entry) {
		if($entry['Peer'] == $name ) {
			$data[$key]['Status'] = $stats;
		}
    	}
    	$newJsonString = json_encode($data);
    	file_put_contents($file_peers, $newJsonString);
}

if ( $evt == "ExtensionStatus" ) {
}

if ( $evt == "Hangup" ) {
}

if ( $evt == "QueueCallerJoin" ) {
}

if ( $evt == "QueueCallerLeave" ) {
}

?>
