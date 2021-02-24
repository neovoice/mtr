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

//FUNCTIONS
function sleep (time) {
	return new Promise((resolve) => setTimeout(resolve, time));
}

function peerdial(peer,exten) {
var dnd = peer+'dnd';
	if ( (peer.length <= 4) && (peer !== "")
		&& (exten !== "") && (peer !== undefined)){
	  switch (exten) {
	
		case '4801':
			console.log(peer+" DND_ON");
			$('#'+dnd).removeClass('dndOff').addClass('dndOn');
			break;

		case '4800':
			console.log(peer+" DND_OFF");
			$('#'+dnd).removeClass('dndOn').addClass('dndOff');	
			break;

		default:
			if (peer != exten) {
			console.log('PEERDIAL:Default '+peer+': '+exten);
			$('#'+peer).text('em ligacao');
			$('#'+peer).removeClass('offline');
			$('#'+peer).removeClass('azul').addClass('vermelho');
			break;
			} else	
			console.log('PEERDIAL2:Default '+peer+': '+exten);
			break;
}
}
}

function peerstatus(peer,stats) {
       if ( (peer.length <= 4) && (peer !== "") 
	      && (stats !== "") && (peer !== undefined)){ 
       switch (stats) {

		case 'InUse':
		case 'INUSE':
			console.log('PeerStatus:INUSE '+peer+':'+stats);
			$('#'+peer).text('em ligacao');
			$('#'+peer).removeClass('offline');
			$('#'+peer).removeClass('azul').addClass('vermelho');
			break;

		case 'UNAVAILABLE':
		case 'Unregistered':
			console.log('PeerStatus:Unregistered '+peer+':'+stats);
			$('#'+peer).text('desligado');
			$('#'+peer).removeClass('azul');
			$('#'+peer).removeClass('vermelho').addClass('offline');
			break;

		case 'RINGING':
		case 'Ringing':
			console.log('PeerStatus:Ringing '+peer+':'+stats);
			$('#'+peer).text('chamando');
			$('#'+peer).removeClass('offline');
			$('#'+peer).removeClass('azul').addClass('vermelho');
			break;

		case 'Registered':
		case 'Idle':
		//case 'NOT_INUSE':
			console.log('PeerStatus:Registered '+peer+':'+stats);
			$('#'+peer).text('disponivel');
			$('#'+peer).removeClass('offline');
			$('#'+peer).removeClass('vermelho').addClass('azul');	
			break;

		default:
			console.log('PeerStatus:Default '+peer+':'+stats);
			break;
}
}
}

function queuecount(queue,count) {
	if ( (queue !== "") && (count !== "") 
		&& (queue !== undefined) && (count !== undefined) ){
	
		if (count != 0) {
		        console.log('1-Queue:'+queue+' Count:'+count);
			$('#'+queue).text(count);
			$('#'+queue).removeClass('semligacao').addClass('vermelho');		
			
		} else {
			console.log('2-Queue:'+queue+' Count:'+count);
			$('#'+queue).text(count);
			$('#'+queue).removeClass('vermelho').addClass('semligacao');
}	
}
}
