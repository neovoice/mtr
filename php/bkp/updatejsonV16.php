<?php
//Autor: Wagner Bizarro
$evt = $_POST['evento'];
$name = $_POST['name'];
$stats = $_POST['stats'];

$file_peers = '../json/PeersStatus.json';
$file_queues = '../json/QueuesStatus.json';

$filepeers = file_get_contents('../json/PeersStatus.json');
$filequeues = file_get_contents('../json/QueuesStatus.json');

$fpeers = str_replace(']}', '',$filepeers);
$fpeers = str_replace(']'.' '.' '.'}', '',$filepeers);
$fpeers = str_replace(']'.' '.' '.' '.'}', '',$filepeers);
$fpeers = str_replace(']'.' '.' '.' '.' '.'}', '',$filepeers); 
$fpeers = str_replace(']]', ']',$filepeers);
$fpeers = str_replace(']  }', '',$filepeers);
$fpeers = str_replace(']   }', '',$filepeers);
$fpeers = str_replace(']    }', '',$filepeers);

$fqueues = str_replace(']}', '',$filequeues);
$fqueues = str_replace(']'.' '.' '.'}', '',$filequeues);
$fqueues = str_replace(']'.' '.' '.' '.'}', '',$filequeues);
$fqueues = str_replace(']'.' '.' '.' '.' '.'}', '',$filequeues);
$fqueues = str_replace(']]', ']',$filequeues);
$fqueues = str_replace(']  }', ']',$filequeues);
$fqueues = str_replace(']   }', ']',$filequeues);
$fqueues = str_replace(']    }', ']',$filequeues);

$jsonpeers = json_decode($fpeers, true);
$jsonqueues = json_decode($fqueues, true);

//print_r($jsonpeers);
switch ($evt) {
	case "Newstate":
	case "PeerStatus": 
	case "DeviceStateChange":
	case "ExtensionStatus":
	case "Hangup":
		//sleep(2);
		peerupdate($file_peers,$jsonpeers,$name,$stats);
		break;

	case "QueueCallerJoin":
	case "QueueCallerLeave":
		//sleep(2);
		queueupdate($file_queues,$jsonqueues,$name,$stats);
		break;
	
	default:
		break;
}

function peerupdate($file_peers,$datapeers,$name,$stats) {
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
	file_get_contents($file_peers);
	file_put_contents($file_peers, $newJsonPeers); 
 }
}

function queueupdate($file_queues,$dataqueues,$name,$count) {
	if (is_array($dataqueues)) {
	foreach ($dataqueues as $key => $entry) {
		if($entry['Queue'] == $name ) {
			$dataqueues[$key]['Count'] = $count;
			}
	}
	$newJsonQueues = json_encode($dataqueues, JSON_PRETTY_PRINT);
	//$newJsonQueues = json_encode($dataqueues);
	file_get_contents($file_queues);
	file_put_contents($file_queues, $newJsonQueues);
   }
}

?>