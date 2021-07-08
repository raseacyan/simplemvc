<!DOCTYPE html>
<html>
	<head>
		<title>Test</title>
	</head>
	<body>
		<form action="models.php" method="post" enctype="multipart/form-data">
			<label>Short Text</label><br>
			<input type="text" name="short_text" value="<?php echo $data->short_text; ?>"/><br>
			<label>Long Text</label><br>
			<textarea name="long_text"><?php echo $data->long_text; ?></textarea><br>			
			<label>Number</label><br>
			<input type="number" name="number" value="<?php echo $data->number; ?>"/><br>

			<p><img src="uploads/<?php echo $data->file_path;?>" width="60" /> </p>
			<label>New File</label><br>
			<input type="file" name="file"/><br><br>
			
			<input type="hidden" name="id" value="<?php echo $data->id; ?>"/>
			<input type="hidden" name="old_file_path" value="<?php echo $data->file_path; ?>"/>

			<input type="submit" name="submit" value="update">
		</form>
	</body>		
</html>