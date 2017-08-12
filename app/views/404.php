<div class="container vh-100">
	<div class="row justify-content-center align-items-center vh-66">
		<div class="col-md-6 p-5 bg-white wrap-shadow" action="" method="POST">
			<h1>404</h1>
			<h2>Page non trouvée :/</h2>
			<?php if ($flash->exist()): ?>
				<p><?= $flash->get('text') ?></p>
			<?php else: ?>
				<p>Vous êtes ici car vous avez demandé une page qui n'existe plus, ou pas du tout.</p>
			<?php endif; ?>
			<div>
				<a href="<?= $path('root') ?>">Revenir à l'accueil</a>
			</div>
		</div>
	</div>
</div>
