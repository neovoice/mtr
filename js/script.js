//Autor: Wagner Bizarro
//Function pesquisar
$(document).ready(function(){
	$("#search").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#main div").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
	});

//plus and minus expand divs
//Filas
	$("#img1").click(function(){
		if($(this).attr("imgnumber") == "1") {
			$(this).attr("src", "images/plus.png");
			$(this).attr("imgnumber", "2");
			$(".Filas").css("display","none");
		}else {
			$(this).attr("src", "images/minus.png");
			$(this).attr("imgnumber", "1");
			$(".Filas").css("display","inline-block");
		}
	});

//Ramais
	$("#img2").click(function(){
		if($(this).attr("imgnumber") == "1") {
			$(this).attr("src", "images/plus.png");
			$(this).attr("imgnumber", "2");
			$(".Ramais").css("display","none");
		}else {
			$(this).attr("src", "images/minus.png");
			$(this).attr("imgnumber", "1");
			$(".Ramais").css("display","inline-block");

		}
	});

//Info
	$(".info").click(function () {
		var infoname = $(this).attr("name");
		var infotype = $(this).attr("met");
		//alert(infotype+' '+infoname);
		
		$.ajax({
			url: "/mtr/php/info.php",
			type: "POST",
			data: "type="+infotype+"&name="+infoname,
			dataType: "html",
			success: function(response) {
				alert(response);
			}
		
		});
	}); 	

});
