<?php
$this->view('shared/header', 'Client Animals');
?>
<!-- display the details for this client/owner -->
<?php $this->view('Owner/detailsPartial', $data['owner']); ?>

<p><!--display the list of animals owned by this client/owner-->
	<a href="/Animal/add/<?= $data['owner']->owner_id ?>">Add a new animal</a>
	<table>
		<tr><th>Name</th><th>DOB</th><th>action</th></tr>
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

<a href='/Vet/index'>Back to the client list</a>

<?php
$this->view('shared/footer');
?>