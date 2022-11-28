<!DOCTYPE html>
<html>

<head>
	<title>
		How to get input type date
		in dd-mm-yyyy format ?
	</title>
	
	<style>
		body {
			text-align: center;
		}
		h1 {
			color: green;
		}
	</style>
</head>

<body>
	<h1>GeeksforGeeks</h1>
	
	<h3>
		Get input date in
		dd-mm-yyyy format
	</h3>
	
	<label for="Date of Birth">
		Enter the Date:
    
    <input type="date"
    value="2022-02-20"
    min="2022-02-20" max="2032-02-20">


	</label>
  <?php
  echo date("d/m/Y");
  ?>
</body>

</html>
