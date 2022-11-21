<?php
$this->view('shared/header', 'Show me the food');
?>
<p><!--display the data as a table-->
	<table>
		<tr><th>id</th><th>Name</th><th>action</th></tr>
	<?php

	foreach ($data as $item) {
		echo "<tr>
		<td type=id>$item->id</td>
		<td type=name>$item->name</td>
		<td type=action><a href='/Food/delete/$item->id'>delete</a></td>
		</tr>";
	}

?>
</table>
</p>
<form action='' method='post'>
	Input the food that you like:
	<input type="text" name="new_food" />
	<input type="submit" name="action" value="Send" />
</form>


<ul>
<li><a href='/Main/index'>back to Index</a></li>
<li><a href='/Food/display'>foods AJAX(JSON) example</a></li>
<li><a href='/Vet/index'>Veterinarian Clinic example</a></li>
</ul>

</ul>
<?php
$this->view('shared/footer');
?>