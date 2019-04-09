$(document).ready(function(){

	$.ajax({
		url : "http://localhost/test/data.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var total = {
				male : [],
				female : []
			};

			var len = data.length;

			for (var i=0; i<len; i++){
				if(data[i].gender == "male"){
					total.male.push(data[i].total);
				}else if (data[i].gender == "female"){
					total.female.push(data[i].total);
				}
			}
			console.log(total);

			var ctx = $("#graphCanvas");

			var data = {
				labels : ["Male", "Female"],
				datasets : [
					{
						label : "Male",
						data : gender.male,
						backgroundColor : "blue",
						borderColor : "lightblue",
						fill : false,
						lineTension : 0,
						pointRadius : 5
					},
					{
						label : "Female",
						data : gender.female,
						backgroundColor : "green",
						borderColor : "lightgreen",
						fill : false,
						lineTension : 0,
						pointRadius : 5	
					}
				]
			};
			var options = {
				title : {
					display: true,
					position: "top",
					text: "bar",
					fontSize: 18,

				}
			};

			var chart = new Chart (ctx, {
				type : "bar",
				data : data,
				options : {}
			});

		},
		error : function(data){
			console.log(data);
		}
	});
});