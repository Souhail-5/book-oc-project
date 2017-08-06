<div class="container">
	<div class="row justify-content-center align-items-center vh-66">
		<div class="col-md-6" action="" method="POST">
			<h1>404</h1>
			<h2>Page non trouvée :/</h2>
			<p>Vous êtes ici car vous avez demandé une page qui n'existe plus, ou pas du tout. Il se peut aussi que vous rencontriez cette page lorsque vous effectuez une action non acceptée.</p>
			<?php if ($flash->exist()): ?>
				<p><?= $flash->get('text') ?></p>
			<?php endif; ?>
			<div>
				<a href="<?= $path('root') ?>">Revenir à l'accueil</a>
			</div>
		</div>
	</div>
</div>
