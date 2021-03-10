//Autor: Wagner Bizarro
PeersGiga.forEach(function(data, index){
	peer = (data.Peer);
	name = (data.Name);
 	group = (data.Group);
	dnd = (peer+"dnd");;
	stats = (data.Status);	

	$('#peers').append("<div class='Ramais'>"+name+"&nbsp"+peer+"&nbsp<img class='info' met='peer' id="+peer+" src='images/info.png'/><br><b class='setor'>"+group+"</b><br><em id="+peer+" class='azul'>"+stats+"</em>&nbsp&nbsp<b class='dndOff' id='"+dnd+"'>dnd</b></div>");
});
