//AUTOR: Wagner Bizarro
QueuesGiga.forEach(function(data, index){
	queue = (data.Queue);
	num = (data.Num);
 	count = (data.Count);	
	info = (queue+"info");
		
	$('#queues').append("<div class='Filas'><b>"+num+"</b>&nbsp"+queue+"&nbsp<img id="+info+" src='images/info.png'/></br><b class='ligacao'>ligacoes:</b><em class='semligacao' id="+queue+">"+count+"</em></br></div>&nbsp<script>$(function () { $('#"+info+"').click(function () { alert('Em desenvolvimento'); }); });</script>");
});
