//Autor: Wagner Bizarro
//console.log(QueuesAdylnet);
QueuesAdylnet.forEach(function(data, index){
	queue = (data.Queue);
	num = (data.Num);
 	count = (data.Count);	
	
	$('#queues').append("<div class='Filas'><b>"+num+"</b>&nbsp"+queue+"</br><b class='ligacao'>ligacoes:</b><em class='semligacao' id="+queue+">"+count+"</em></br></div>&nbsp");	
});
