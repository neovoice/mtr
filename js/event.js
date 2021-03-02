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
			evt = jdata["Event"]; 
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			exten = exten.replace(/(\r\n|\n|\r)/gm, "");
			evt = evt.replace(/(\r\n|\n|\r)/gm, "");
			if ( peer != exten){
			sleep(2000).then(() => {
				peerdial(peer,exten);
				updateJSON(evt,peer,exten);
			});
			}	
		}
	
		//INUSE, NOT_INUSE, UNAVAILABLE
		if ( (jdata["Event"].includes("PeerStatus")) && (jdata["Peer"] !== undefined) 
			&& (jdata["State"] !== undefined) ){
			peer = jdata["Peer"];
			stats = jdata["State"];
			evt = jdata["Event"];
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			peer = peer.replace(/\D/g,'');
			stats = stats.replace(/(\r\n|\n|\r)/gm, "");
			evt = evt.replace(/(\r\n|\n|\r)/gm, "");
			peerstatus(peer,stats);
			updateJSON(evt,peer,stats);
		}

		//Registered, Unregistered
		if ( (jdata["Event"].includes("DeviceStateChange")) && (jdata["Peer"] !== undefined) 
			&& (jdata["PeerStatus"] !== undefined) ){
			peer = jdata["Peer"];
			stats = jdata["PeerStatus"];
			evt = jdata["Event"];
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			peer = peer.replace(/\D/g,'');
			stats = stats.replace(/(\r\n|\n|\r)/gm, "");
			evt = evt.replace(/(\r\n|\n|\r)/gm, "");
			peerstatus(peer,stats);
			updateJSON(evt,peer,stats);
		}
		
		//Idle, InUse, Ringing		
		if ( (jdata["Event"].includes("ExtensionStatus")) && (jdata["Exten"] !== undefined)
			&& (jdata["StatusText"] !== undefined) ){
			peer = jdata["Exten"];
			stats = jdata["StatusText"];
			evt = jdata["Event"];
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			peer = peer.replace(/\D/g,'');
			stats = stats.replace(/(\r\n|\n|\r)/gm, "");
			evt = evt.replace(/(\r\n|\n|\r)/gm, ""); 
			peerstatus(peer,stats);
			updateJSON(evt,peer,stats);
		}	

		//InUse, Idle
		if ( (jdata["Event"].includes("Hangup")) && (jdata["Device"] !== undefined)
			&& (jdata["StatusText"] !== undefined) ){
			peer = jdata["Device"];
			stats = jdata["StatusText"];
			evt = jdata["Event"];
			peer = peer.replace(/(\r\n|\n|\r)/gm, "");
			peer = peer.replace(/\D/g,'');
			stats = stats.replace(/(\r\n|\n|\r)/gm, "");
			evt = evt.replace(/(\r\n|\n|\r)/gm, "");
			peerstatus(peer,stats);
			updateJSON(evt,peer,stats);
		}

		//Queue Count
		if ( (jdata["Event"].includes("QueueCallerJoin")) && (jdata["Queue"] !== undefined)
			&& (jdata["Count"] !== undefined) ){
				queue = jdata["Queue"];
				count = jdata["Count"];
				evt = jdata["Event"];
				queue = queue.replace(/(\r\n|\n|\r)/gm, "");
				count = count.replace(/(\r\n|\n|\r)/gm, "");
				evt = evt.replace(/(\r\n|\n|\r)/gm, "");
				queuecount(queue,count);
				updateJSON(evt,queue,count);
			}
		
		if ( (jdata["Event"].includes("QueueCallerLeave")) && (jdata["Queue"] !== undefined)
			&& (jdata["Count"] !== undefined) ){
				queue = jdata["Queue"];
				count = jdata["Count"];
				 evt = jdata["Event"];
				queue = queue.replace(/(\r\n|\n|\r)/gm, "");
				count = count.replace(/(\r\n|\n|\r)/gm, "");
				evt = evt.replace(/(\r\n|\n|\r)/gm, "");
				queuecount(queue,count);
				updateJSON(evt,queue,count);
			}		 
  }
} 
else {
	console.log("error: PHP Event send event to JS");
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
			//console.log(peer+" DND_ON");
			$('#'+dnd).removeClass('dndOff').addClass('dndOn');
			break;

		case '4800':
			//console.log(peer+" DND_OFF");
			$('#'+dnd).removeClass('dndOn').addClass('dndOff');	
			break;

		default:
			if (peer != exten) {
			//console.log('PEERDIAL:Default '+peer+': '+exten);
			$('#'+peer).text('em ligacao');
			$('#'+peer).removeClass('offline');
			$('#'+peer).removeClass('azul').addClass('vermelho');
			$('#'+peer+"info").removeClass('notinfo');
			break;
			} else	
			//console.log('PEERDIAL2:Default '+peer+': '+exten);
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
			//console.log('PeerStatus:INUSE '+peer+':'+stats);
			$('#'+peer).text('em ligacao');
			$('#'+peer).removeClass('offline');
			$('#'+peer).removeClass('azul').addClass('vermelho');
			$('#'+peer+"info").removeClass('notinfo');
			break;

		case 'UNAVAILABLE':
		case 'Unregistered':
			//console.log('PeerStatus:Unregistered '+peer+':'+stats);
			$('#'+peer).text('desligado');
			$('#'+peer).removeClass('azul');
			$('#'+peer).removeClass('vermelho').addClass('offline');
			$('#'+peer+"info").addClass('notinfo');
			break;

		case 'RINGING':
		case 'Ringing':
			//console.log('PeerStatus:Ringing '+peer+':'+stats);
			$('#'+peer).text('chamando');
			$('#'+peer).removeClass('offline');
			$('#'+peer).removeClass('azul').addClass('vermelho');
			$('#'+peer+"info").removeClass('notinfo');
			break;

		case 'Registered':
		case 'Idle':
		//case 'NOT_INUSE':
			//console.log('PeerStatus:Registered '+peer+':'+stats);
			$('#'+peer).text('disponivel');
			$('#'+peer).removeClass('offline');
			$('#'+peer).removeClass('vermelho').addClass('azul');
			$('#'+peer+"info").addClass('notinfo');	
			break;

		default:
			//console.log('PeerStatus:Default '+peer+':'+stats);
			break;
}
}
}

function queuecount(queue,count) {
	if ( (queue !== "") && (count !== "") 
		&& (queue !== undefined) && (count !== undefined) ){
	
		if (count != 0) {
		        //console.log('1-Queue:'+queue+' Count:'+count);
			$('#'+queue).text(count);
			$('#'+queue).removeClass('semligacao').addClass('vermelho');		
			
		} else {
			//console.log('2-Queue:'+queue+' Count:'+count);
			$('#'+queue).text(count);
			$('#'+queue).removeClass('vermelho').addClass('semligacao');
}	
}
}

function updateJSON(evt,name,stats) { 
	$.ajax({
		url: "/mtr/php/updatejson.php",
		type: "POST",
		data: "evento="+evt+"&name="+name+"&stats="+stats,
		dataType: "html"
	
	}).done(function(resposta) {
		console.log(resposta);

	}).fail(function(jqXHR, textStatus ) {
		console.log("Request failed: " + textStatus);

	}).always(function() {
		//console.log("Evento: "+evt+" name: "+name+" stats: "+stats);
		//console.log("Update JSON");
	});   

}
