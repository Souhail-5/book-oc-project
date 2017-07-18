<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<?php foreach ($stylesheets as $stylesheet): ?>
		<?= $stylesheet ?>
	<?php endforeach; ?>
	<?php foreach ($scripts as $script): ?>
		<?= $script ?>
	<?php endforeach; ?>
</head>
<body id="<?= $bodyId ?>">
	<?= $view; ?>
	<?php foreach ($customBtmScripts as $script): ?>
		<script type="text/javascript"><?= $script ?></script>
	<?php endforeach; ?>
</body>
</html>
