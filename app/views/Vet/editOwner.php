<html>
<head>
	<title>Edit client</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
<form action='' method='post'>
	<label>First name:<input type="text" name="first_name" value="<?= $data->first_name ?>" /></label><br>
	<label>Last name:<input type="text" name="last_name" value="<?= $data->last_name ?>" /></label><br>
	<label>Contact:<input type="text" name="contact" value="<?= $data->contact ?>" /></label><br>
	<input type="submit" name="action" value="Save changes" />
</form>

</body>
</html>