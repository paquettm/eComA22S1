<html>
<head>
	<title>Vet clinic client list</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
<p><!--display the data as a table-->
	<a href="/Vet/add">Add a new client</a>
	<table>
		<tr><th>First Name</th><th>Last Name</th><th>Contact</th><th>action</th></tr>
	<?php

	foreach ($data as $item) {
		echo "<tr>
		<td type=name>$item->first_name</td>
		<td type=name>$item->last_name</td>
		<td type=name>$item->contact</td>
		<td type=action>
		<a href='/Vet/edit/$item->owner_id'>edit</a> | 
		<a href='/Vet/details/$item->owner_id'>details</a> |
		<a href='/Vet/delete/$item->owner_id'>delete</a> |
		<a href='/Animal/index/$item->owner_id'>my pets</a>
		</td>
		</tr>";
	}

?>
</table>
</p>

<ul>
<li><a href='/Main/index'>index</a></li>
<li><a href='/Main/index2'>index2</a></li>
</ul>


</body>
</html>