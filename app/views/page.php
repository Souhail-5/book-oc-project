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
	<?php if ($user->isAuthenticated()): ?>
		<nav class="navbar fixed-bottom navbar-inverse bg-inverse zi-50 flex-row justify-content-between align-items-center py-1 fz-0-95">
			<span class="text-white">Mode administration</span>
			<button class="btn btn-link meta-danger p-0 m-0" form="form-log-out" type="submit" name="action" value="sign-out">
				<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-turn-off">
				    <use xlink:href="/sprite.svg#si-glyph-turn-off" />
				</svg>
				Se déconnecter
			</button>
			<form method="POST" id="form-log-out" class="hidden-xs-up">
			</form>
		</nav>
	<?php endif; ?>
	<?= $view; ?>
	<?php foreach ($customBtmScripts as $script): ?>
		<script type="text/javascript"><?= $script ?></script>
	<?php endforeach; ?>
</body>
</html>
