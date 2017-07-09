<!DOCTYPE html>
<html lang="<?= $language; ?>">
<head>
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	<?php foreach ($stylesheets as $stylesheet): ?>
		<link rel="stylesheet" href="<?= $stylesheet; ?>">
	<?php endforeach; ?>
	<?php foreach ($scripts as $script): ?>
		<script src="<?= $script; ?>"></script>
	<?php endforeach; ?>
</head>
<body>
	<?= $view; ?>
</body>
</html>
