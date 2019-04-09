// element yg di gunakan -> DOM

var keyword = document.getElementById('keyword');
var searchbtn = document.getElementById('searchbtn');
var content = document.getElementById('content');

//add event to search bar
keyword.addEventListener('keyup', function(){
	var xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function() {
		if( xhr.readyState == 4 && xhr.status == 200 ){
			//console.log(xhr.responseText);
			content.innerHTML = xhr.responseText;
			//console.log('ajax ok');
		}
	}

	xhr.open('GET', 'ajax/ajaxkaryawan.php?keyword=' +keyword.value, true);
	xhr.send();
});