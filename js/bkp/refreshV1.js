//Autor: Wagner Bizarro
if(typeof(EventSource) !== "undefined") {
	var rsource = new EventSource("php/refresh.php");
	rsource.onmessage = function(event){
		var rdata = JSON.parse(event.data);
		//console.log(rdata);	
		if (rdata["evento"] == "peerstatus"){
			var rpeer = rdata["peer"];
			var rstatus = rdata["status"];
			var rdndStatus = rdata["dnd"];
			var rdnd = rdata["peer"]+"dnd";
			
			if (rdndStatus == 1) {
			//console.log('DND_ON '+rpeer+':'+rdndStatus);
			$('#'+rdnd).removeClass('dndOff').addClass('dndOn');
			}

			else if ( (rdndStatus == 0) || (rdnd == null)  ) {
			//console.log('DND_OFF '+rpeer+':'+rdndStatus);
			$('#'+rdnd).removeClass('dndOn').addClass('dndOff');	
			}
			
			switch(rstatus) {
				case 'InUse':
				case 'INUSE':
					//console.log('PeerStatus:INUSE '+rpeer+':'+rstatus);
					$('#'+rpeer).text('em ligacao');
					$('#'+rpeer).removeClass('offline');
					$('#'+rpeer).removeClass('azul').addClass('vermelho');
					$('#'+rpeer+"info").removeClass('notinfo');
					break;

				case 'UNAVAILABLE':
				case 'Unregistered':
					//console.log('PeerStatus:Unregistered '+rpeer+':'+rstatus);
					$('#'+rpeer).text('desligado');
					$('#'+rpeer).removeClass('azul');
 			        	$('#'+rpeer).removeClass('vermelho').addClass('offline');
					$('#'+rpeer+"info").addClass('notinfo');
					break;
				
				case 'RINGING':
				case 'Ringing':
					//console.log('PeerStatus:Ringing '+rpeer+':'+rstatus);
					$('#'+rpeer).text('chamando');
					$('#'+rpeer).removeClass('offline');
					$('#'+rpeer).removeClass('azul').addClass('vermelho');
					$('#'+rpeer+"info").removeClass('notinfo');
					break;			
				
				case 'Registered':
				case 'Idle':
					//console.log('PeerStatus:Registered '+rpeer+':'+rstatus);
					$('#'+rpeer).text('disponivel');
					$('#'+rpeer).removeClass('offline');
					$('#'+rpeer).removeClass('vermelho').addClass('azul'); 
					$('#'+rpeer+"info").addClass('notinfo');
					break;
	
				case 'NOT_INUSE':
				case 'UNKNOWN':
				case 'Reachable':
					break;
				
				default:
					if ( (rpeer !== rstatus) && (rstatus !== 4800) && (rstatus !== 4801) && (rstatus !== '') ){
					 	//console.log('PeerStatus:Default_IF '+rpeer+':'+rstatus);
						$('#'+rpeer).text('em ligacao');
						$('#'+rpeer).removeClass('offline');
						$('#'+rpeer).removeClass('azul').addClass('vermelho');
						$('#'+rpeer+"info").removeClass('notinfo'); 		
						break;	
					}
					//console.log('PeerStatus:Default '+rpeer+':'+rstatus);
					break;
		  }//Switch

		} //If_peerstatus
		
		if ( (rdata["evento"] == "queuestatus") && (rdata["count"] !== null) ){
			var rqueue = rdata["queue"];
			var rcount = rdata["count"];
			if (rdata["count"] != 0) {
				$('#'+rqueue).text(rcount);
				$('#'+rqueue).removeClass('semligacao').addClass('vermelho');
			}
			else {
				$('#'+rqueue).text(rcount);
				$('#'+rqueue).removeClass('vermelho').addClass('semligacao');	
				}
		}//If_queuesstatus
}//if_typeof
}//function
else {
	console.log("error: PHP Refresh send event to JS");	
}
