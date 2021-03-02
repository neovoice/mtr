//Autor: Wagner Bizarro
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
