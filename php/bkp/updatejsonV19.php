<?php
//Autor: Wagner Bizarro
//$evt = $_POST['evento'];
//$name = $_POST['name'];
//$stats = $_POST['stats'];

$evt = "Newstate";
$name = "1002";
$stats = "4801";

$file_peers = '../json/PeersStatus.json';
$file_queues = '../json/QueuesStatus.json';

$filepeers = file_get_contents($file_peers);
$filequeues = file_get_contents($file_queues);

//Fixed error in file JSON
$fpeers = str_replace(']]', ']',$filepeers);
$fpeers = str_replace(']  }', '',$filepeers);
$fpeers = str_replace(']   }', '',$filepeers);
$fpeers = str_replace(']    }', '',$filepeers);
//$fpeers = strtok($filepeers, "]  }");

$fqueues = str_replace(']]', ']',$filequeues);
$fqueues = str_replace(']  }', ']',$filequeues);
$fqueues = str_replace(']   }', ']',$filequeues);
$fqueues = str_replace(']    }', ']',$filequeues);

$jsonpeers = json_decode($filepeers, true);
$jsonqueues = json_decode($filequeues, true);

//print_r($fpeers);
print_r($jsonpeers);
print_r($jsonqueues);

if (empty($jsonpeers)) {
	 echo "JSON Peers Corrompido\n";
	 shell_exec('cp /var/www/html/mtr/json/PeersStatusTemplate.json /var/www/html/mtr/json/PeerStatus.json');
}

if (empty($jsonqueues)) { 
	echo "JSON Queues Corrompido\n";
	shell_exec('cp /var/www/html/mtr/json/QueuesStatusTemplate.json /var/www/html/mtr/json/QueuesStatus.json');
}
/*
switch ($evt) {
	case "Newstate":
	case "PeerStatus": 
	case "DeviceStateChange":
	case "ExtensionStatus":
	case "Hangup":
		peerupdate($file_peers,$jsonpeers,$name,$stats);
		break;

	case "QueueCallerJoin":
	case "QueueCallerLeave":
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
	file_get_contents($file_queues);
	file_put_contents($file_queues, $newJsonQueues);
   }
}
*/
?>
