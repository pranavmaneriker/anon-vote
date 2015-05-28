<?php
	error_reporting(E_ALL);
?>
<html>
<body>
	<form method="POST" action="vote_model.php">
		Random shit
		<input type="hidden" value="1234" name="vote_for"/>
		Id:<input type="text" name="id" id="id"/>
		Key: <input type="password" name="secret_key"/>
		<input type="submit" value="submit">
	</form>
</body>
</html>