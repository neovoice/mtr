//Autor: Wagner Bizarro
//console.log(PeersAdylnet);
PeersAdylnet.forEach(function(data, index){
	peer = (data.Peer);
	name = (data.Name);
 	group = (data.Group);
	dnd = (peer+"dnd");
	stats = (data.Status);	
	info = (peer+"info");
	
	$('#peers').append("<div class='Ramais'>"+name+"&nbsp"+peer+"&nbsp<img id="+info+" class='notinfo' src='images/info.png'/><br><b class='setor'>"+group+"</b><br><em id="+peer+" class='azul'>"+stats+"</em>&nbsp&nbsp<b class='dndOff' id='"+dnd+"'>dnd</b></div>&nbsp");	
});
