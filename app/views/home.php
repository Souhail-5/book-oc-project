<div class="container">
	<div class="row no-gutters align-items-md-center vh-100">
		<div class="home-poster-wrap align-self-md-start col-lg-3">
			<figure class="poster mt-2 mb-0">
				<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
			</figure>
		</div>
		<div class="main-content-wrap col-lg-10 offset-lg-2">
			<?php if ($user->isAuthenticated()): ?>
				<nav class="push navbar py-3 pr-3 flex-column flex-lg-row align-items-center">
					<div class="dropdown mr-lg-4">
						<button class="btn btn-link px-0 dropdown-toggle" type="button" id="dropdownMenuEpisodes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Épisodes
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuEpisodes">
							<a class="dropdown-item" href="<?= $path('episodes') ?>">Publiés</a>
							<a class="dropdown-item" href="<?= $path('episodes-draft') ?>">Brouillons</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= $path('episodes-trash') ?>">Corbeille</a>
						</div>
					</div>
					<div class="dropdown mr-lg-4">
						<button class="btn btn-link px-0 dropdown-toggle" type="button" id="dropdownMenuComments" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Commentaires
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuComments">
							<a class="dropdown-item" href="<?= $path('comments') ?>">Voir tout</a>
							<a class="dropdown-item" href="<?= $path('comments-approved') ?>">Approuvés</a>
							<a class="dropdown-item" href="<?= $path('comments-signaled') ?>">Signalés</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= $path('comments-trash') ?>">Corbeille</a>
						</div>
					</div>
					<div class="ml-lg-auto mt-3 mt-lg-0 align-self-stretch">
						<a class="btn btn-secondary w-100 no-after" href="<?= $path('episode-new') ?>">
							Nouvel épisode
						</a>
					</div>
				</nav>
			<?php endif; ?>
			<div class="<?= $user->isAuthenticated() ? 'vh-80' : 'vh-90' ?> ov-a">
				<nav class="push font-italic breadcrumb bg-white py-4">
					<span class="breadcrumb-item mr-2">Vous êtes ici :</span>
					<?php if ($current_route->name() == 'root'): ?>
						<span class="breadcrumb-item no-before">Accueil</span>
					<?php else: ?>
						<a class="breadcrumb-item no-before" href="<?= $path('root') ?>">Accueil</a>

						<?php if ($current_route->name() == 'episodes'): ?>
							<!-- Episodes -->
							<span class="breadcrumb-item">Épisodes</span>
						<?php endif; ?>
						<?php if ($current_route->name() == 'episodes-draft'): ?>
							<a class="breadcrumb-item" href="<?= $path('episodes') ?>">Épisodes</a>
							<span class="breadcrumb-item">Brouillon</span>
						<?php endif; ?>
						<?php if ($current_route->name() == 'episodes-trash'): ?>
							<a class="breadcrumb-item" href="<?= $path('episodes') ?>">Épisodes</a>
							<span class="breadcrumb-item">Corbeille</span>
						<?php endif; ?>

						<?php if ($current_route->name() == 'comments'): ?>
							<!-- Comments -->
							<span class="breadcrumb-item">Commentaires</span>
						<?php endif; ?>
						<?php if ($current_route->name() == 'comments-approved'): ?>
							<a class="breadcrumb-item" href="<?= $path('comments') ?>">Commentaires</a>
							<span class="breadcrumb-item">Approuvés</span>
						<?php endif; ?>
						<?php if ($current_route->name() == 'comments-signaled'): ?>
							<a class="breadcrumb-item" href="<?= $path('comments') ?>">Commentaires</a>
							<span class="breadcrumb-item">Signalés</span>
						<?php endif; ?>
						<?php if ($current_route->name() == 'comments-trash'): ?>
							<a class="breadcrumb-item" href="<?= $path('comments') ?>">Commentaires</a>
							<span class="breadcrumb-item">Corbeille</span>
						<?php endif; ?>
					<?php endif; ?>
				</nav>
				<?php if ($flash->exist()): ?>
					<div class="push pr-5 border-0 rounded-0 alert alert-<?= $flash->get('type') ?>" role="alert">
						<p class="m-0"><?= $flash->get('text') ?></p>
					</div>
				<?php endif; ?>
				<section class="push mt-4 pr-1 pr-lg-5">
					<?= $view ?>
				</section>
			</div>
		</div>
	</div>
</div>
