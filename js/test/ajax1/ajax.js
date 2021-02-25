function ajaxcall(teste) {
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'dummy.php');
	xhr.onload = function () {
		console.log(this.response)	
	};
	xhr.send(teste);
	return false;
}
teste='ola';
ajaxcall(teste);
