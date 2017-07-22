<!-- To-do: Add some HTML5 semantic elements -->
<div class="container">
	<div id="main" class="row d-md-flex align-items-md-center">
		<div id="main-poster" class="align-self-md-start col-md-3 offset-md-1">
			<figure class="poster">
				<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
			</figure>
		</div>
		<div id="main-content" class="col-md-8 offset-md-3">
			<div id="admin-bar" class="justify-content-end navbar sticky-top navbar-light">
				<div class="form-inline ml-auto">
					<div class="dropdown">
						<button class="no-after btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-gear">
								<use xlink:href="sprite.svg#si-glyph-gear">
							</svg>
						</button>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="<?= $path('new-episode') ?>">Nouvel épisode</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= $path('new-episode') ?>">Mon profil</a>
							<a class="dropdown-item" href="#">Mes paramètres</a>
							<a class="dropdown-item" href="<?= $path('root') ?>">Accueil</a>
							<a class="dropdown-item" href="<?= $path('comments-signaled') ?>">Commentaires signalés</a>
						</div>
					</div>
				</div>
			</div>
			<div id="episodes-container">
			<?php if (!empty($comments_signaled)): ?>
				<?= $comments_signaled ?>
			<?php else: ?>
				<p>
					Aucun commentaire n'a été signalé.
				</p>
			<?php endif; ?>

			</div>
		</div>
	</div>
</div>
