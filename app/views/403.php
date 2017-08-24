<div class="container vh-100">
	<div class="row justify-content-center align-items-center vh-66">
		<div class="col-md-6 p-5 bg-white wrap-shadow" action="" method="POST">
			<h1>403</h1>
			<h2>Aie aie aie !</h2>
			<?php if ($flash->exist()): ?>
				<p><?= $flash->get('text') ?></p>
			<?php else: ?>
				<p>Vous n'êtes pas autorisé à accéder à cette page ou à effectuer cette action.</p>
			<?php endif; ?>
			<div>
				<a href="<?= $path('root') ?>">Revenir à l'accueil</a>
			</div>
		</div>
	</div>
	<small class="d-block w-100 mb-4 text-center">
		<a href="<?= $path('legal') ?>" class="meta">Mentions légales</a>
	</small>
</div>
