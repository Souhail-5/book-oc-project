<!DOCTYPE html>
<html lang="<?= $language; ?>">
<head>
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	<?php foreach ($stylesheets as $stylesheet): ?>
		<link rel="stylesheet" href="<?= $stylesheet ?>">
	<?php endforeach; ?>
	<?php foreach ($scripts as $script): ?>
		<script src="<?= $script['src'] ?>" <?= $script['execute'] ?>></script>
	<?php endforeach; ?>
</head>
<body>
	<?= $view; ?>
	<?php foreach ($customBtmScripts as $script): ?>
		<script type="text/javascript"><?= $script ?></script>
	<?php endforeach; ?>
</body>
</html>
