console.log(QueuesAdylnet);

var output = document.getElementById('queues');
//output.innerHTML = QueuesAdylnet['0'].Queue;

QueuesAdylnet.forEach(function(data, index){
	queue = (data.Queue);
	num = (data.Num);	
	count = (data.Count);
	//output.innerHTML = "<div class='Filas'><b>"+num+"</b></br></div>"+"<b class='ligacao'>ligacoes:</b><em class='semligacao' id="+queue+">"+count+"</em></br></div>&nbsp";
	//output.innerHTML = "<p>"+queue+"</p>"
	output.append("<p>"+queue+"</p>"); 
});
