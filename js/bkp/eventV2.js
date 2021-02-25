//Autor: Wagner Bizarro
if(typeof(EventSource) !== "undefined") {
	var source = new EventSource("php/listening.php");
		source.onmessage = function(event){
		var jdata = JSON.parse(event.data);//jdata Array received event.php

		//INCALL,  DND 4800, DND 4800
		if ( (jdata["Event"].includes("Newstate")) && (jdata["Channel"]).includes("SIP/") 
			&& (jdata["Exten"] !== undefined )) {
			peer = jdata["CallerIDNum"];
			exten = jdata["Exten"];
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			exten = exten.replace(/(\r\n|\n|\r)/gm, "");
			if ( peer != exten){
			sleep(2000).then(() => {
				peerdial(peer,exten)});
			}	
		}
	
		//INUSE, NOT_INUSE, UNAVAILABLE
		if ( (jdata["Event"].includes("PeerStatus")) && (jdata["Peer"] !== undefined) 
			&& (jdata["State"] !== undefined) ){
			peer = jdata["Peer"];
			stats = jdata["State"];
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			peer = peer.replace(/\D/g,'');
			stats = stats.replace(/(\r\n|\n|\r)/gm, "");
			peerstatus(peer,stats);
		}

		//Registered, Unregistered
		if ( (jdata["Event"].includes("DeviceStateChange")) && (jdata["Peer"] !== undefined) 
			&& (jdata["PeerStatus"] !== undefined) ){
			peer = jdata["Peer"];
			stats = jdata["PeerStatus"];
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			peer = peer.replace(/\D/g,'');
			stats = stats.replace(/(\r\n|\n|\r)/gm, "");
			peerstatus(peer,stats);
		}
		
		//Idle, InUse, Ringing		
		if ( (jdata["Event"].includes("ExtensionStatus")) && (jdata["Exten"] !== undefined)
			&& (jdata["StatusText"] !== undefined) ){
			peer = jdata["Exten"];
			stats = jdata["StatusText"];
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			peer = peer.replace(/\D/g,'');
			stats = stats.replace(/(\r\n|\n|\r)/gm, "");
			//console.log(jdata["Event"]+" "+peer+" "+stats);
			peerstatus(peer,stats);
		}	

		//InUse, Idle
		if ( (jdata["Event"].includes("Hangup")) && (jdata["Device"] !== undefined)
			&& (jdata["StatusText"] !== undefined) ){
			peer = jdata["Device"];
			stats = jdata["StatusText"];
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			peer = peer.replace(/\D/g,'');
			stats = stats.replace(/(\r\n|\n|\r)/gm, "");
			peerstatus(peer,stats);
		}

		//Queue Count
		if ( (jdata["Event"].includes("QueueCallerJoin")) && (jdata["Queue"] !== undefined)
			&& (jdata["Count"] !== undefined) ){
				queue = jdata["Queue"];
				count = jdata["Count"];
				queue = queue.replace(/(\r\n|\n|\r)/gm, "");
				count = count.replace(/(\r\n|\n|\r)/gm, "");
				queuecount(queue,count);
			}
		
		if ( (jdata["Event"].includes("QueueCallerLeave")) && (jdata["Queue"] !== undefined)
			&& (jdata["Count"] !== undefined) ){
				queue = jdata["Queue"];
				count = jdata["Count"];
				queue = queue.replace(/(\r\n|\n|\r)/gm, "");
				count = count.replace(/(\r\n|\n|\r)/gm, "");
				queuecount(queue,count);
			}		 
  }
} 
else {
	console.log("error: PHP send event to JS");
}

var imported = document.createElement('script');
imported.src = '/js/functions.js';
document.head.appendChild(imported);
