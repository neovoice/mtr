//let QueuesAdylnet = require('/var/www/html/mtr/json/QueuesAdylnet.json');

//QueuesAdylnet.forEach(function(data, index){
$.getJSON('../json/QueuesAdylnet.json',function(data){
	//console.log(data);
	queue = (data.Queue);
	num = (data.Num);
	count = (data.Count);
	console.log("<div class='Filas'><b>"+num+"</b></br></div>"+"<b class='ligacao'>ligacoes:</b><em class='semligacao' id="+queue+">"+count+"</em></br></div>&nbsp");

});
