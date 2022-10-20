<html>
<head>
	<title>some title</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(
	function(){
		$.getJSON("/Food/outputJSON",
			function( obj ) {
				output = "";
				for (const item of obj) {
			  		output = output + item.name + " has the id " + item.id + "<br>";
 				}
 				$('#foods').html(output);
			}
		)
	}
);

</script>

</head>
<body>
Here is the list of foods from our database
<div id="foods">
	
</div>


<ul>
<li><a href='/Main/index'>back</a></li>
</ul>

</body>

</html>