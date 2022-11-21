<?php
$this->view('shared/header', 'Vet Clinic Client List');
?>
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
<li><a href='/Main/index'>Main index</a></li>
</ul>

<?php
$this->view('shared/footer');
?>