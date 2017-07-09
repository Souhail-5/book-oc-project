<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<?php foreach ($stylesheets as $stylesheet): ?>
		<link rel="stylesheet" href="<?php echo $stylesheet; ?>">
	<?php endforeach; ?>
	<?php foreach ($scripts as $script): ?>
		<script src="<?php echo $script; ?>"></script>
	<?php endforeach; ?>
</head>
<body>
	<?php echo $view; ?>
</body>
</html>
