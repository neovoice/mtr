//Autor: Wagner Bizarro
//console.log(QueuesAdylnet);
QueuesAdylnet.forEach(function(data, index){
	queue = (data.Queue);
	num = (data.Num);
 	count = (data.Count);	
	
	$('#queues').append("<div class='Filas'><b>"+num+"</b>&nbsp"+queue+"&nbsp<img class='info' met='queue' id="+queue+" src='images/info.png'/></br><b class='ligacao'>ligacoes:</b><em class='semligacao' id="+queue+">"+count+"</em></br></div>");	
});
