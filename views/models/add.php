<!DOCTYPE html>
<html>
	<head>
		<title>Test</title>
	</head>
	<body>
		<form action="models.php" method="post" enctype="multipart/form-data">
			<label>Short Text</label><br>
			<input type="text" name="short_text"/><br>
			<label>Long Text</label><br>
			<textarea name="long_text"></textarea><br>			
			<label>Number</label><br>
			<input type="number" name="number"/><br>
			<label>File</label><br>
			<input type="file" name="file"/><br><br>			
			<input type="submit" name="submit" value="create">
		</form>
	</body>		
</html>