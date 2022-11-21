<?php
$this->view('shared/header', 'Show me the food');
?>
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

Here is the list of foods from our database
<div id="foods">
	
</div>


<ul>
<li><a href='/Main/index'>back</a></li>
</ul>

<?php
$this->view('shared/footer');
?>