<html>
<head>
<title>2fa check</title>
</head>
<body>
	<p>Hi <?=$_SESSION['username']?>. Provide your 2-factor authentication code.</p>
<form method="post" action="">
<label>Current code:<input type="text" name="currentCode" /></label>
<input type="submit" name="action" value="Verify code" />
</form>
</body>
</html>