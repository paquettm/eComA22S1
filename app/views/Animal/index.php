<html>
<head>
	<title>Client Animal list</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>

<h1>Client information</h1>
<?php
	$this->view('Owner/detailsPartial', $data['owner']);
?>

<h1>List of pets</h1>
<p><!--display the data as a table-->
	<a href="/Animal/add/<?= $data['owner']->owner_id ?>">Add a new pet</a>
	<table>
		<tr><th>Name</th><th>Date of Birth</th><th>action</th></tr>
	<?php

	foreach ($data['animals'] as $item) {
		echo "<tr>
		<td type=name>$item->name</td>
		<td type=name>$item->dob</td>
		<td type=action>
		<a href='/Animal/edit/$item->animal_id'>edit</a> | 
		<a href='/Animal/details/$item->animal_id'>details</a> |
		<a href='/Animal/delete/$item->animal_id'>delete</a>
		</td>
		</tr>";
	}

?>
</table>
</p>

<a href='/Vet/index'>Back to the list of clients</a>

</body>
</html>