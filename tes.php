<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<input type="date" id="date_picker_end" onchange="handledatechange()">
<input type="date" id="date_picker_end1" onchange="handledatechange1()">
	<input type="text" id="tanggal">
	<input type="text" id="tanggal2">
	<script>
		function handledatechange() {
			var date_picker_end = document.getElementById("date_picker_end").value;
			document.getElementById("tanggal").value = changedateformat(date_picker_end);
		}
		function changedateformat(val) {
			const myArray = val.split("-");

			let year = myArray[0];
			let month = myArray[1];
			let day = myArray[2];

			let formatteddate = year + "-" + month + "-" + day;
			return formatteddate;
		}
		function handledatechange1() {
			var date_picker_end = document.getElementById("date_picker_end1").value;
			document.getElementById("tanggal2").value = changedateformat1(date_picker_end);
		}
		function changedateformat1(val) {
			const myArray = val.split("-");

			let year = myArray[0];
			let month = myArray[1];
			let day = myArray[2];

			let formatteddate = year + "-" + month + "-" + day;
			return formatteddate;
		}
	</script>
</body>
</html>