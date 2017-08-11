<div class="container vh-100">
	<div class="row no-gutters justify-content-center align-items-center vh-80">
		<form class="sign-in-form col-md-5 p-5" action="" method="POST">
			<?php if ($flash->exist()): ?>
				<div class="alert alert-<?= $flash->get('type') ?> mb-3 border-0" role="alert">
					<h4 class="alert-heading sans-serif"><?= $flash->get('title') ?></h4>
					<p class="m-0"><?= $flash->get('text') ?></p>
				</div>
			<?php endif; ?>
			<a class="d-inline-block mb-3" href="<?= $path('root') ?>">< Accueil</a>
			<h2 class="mb-4">Se connectez</h2>
			<p class="font-italic">Accédez à l'interface de gestion de votre site.</p>
			<div class="form-group">
				<label for="email">Adresse e-mail</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Votre e-mail">
			</div>
			<div class="form-group">
			<label for="password">Nom</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe">
			</div>
			<button type="submit" name="action" value="sign-in" class="w-100 btn btn-primary">Se connecter</button>
		</form>
	</div>
</div>
