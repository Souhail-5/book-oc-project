<div class="container">
	<div class="row justify-content-center align-items-center vh-66">
		<form class="col-md-4" action="" method="POST">
			<?php if ($user->hasFlash()): ?>
				<div class="alert alert-warning mb-3" role="alert">
					<p><?= $user->getFlash() ?></p>
				</div>
			<?php endif; ?>
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
			<button type="submit" name="action" value="sign-in" class="w-100 btn btn-primary">Submit</button>
		</form>
	</div>
</div>
