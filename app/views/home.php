<!-- To-do: Add some HTML5 semantic elements -->
<div class="container">
	<div class="row no-gutters d-md-flex align-items-md-center vh100">
		<div class="home-poster-wrap align-self-md-start col-md-3 offset-md-1">
			<figure class="poster mt-5">
				<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
			</figure>
		</div>
		<div class="main-content-wrap col-md-8 offset-md-3">
			<div class="push navbar py-3 pr-3 flex-row justify-content-start align-items-center">
				<div class="dropdown">
					<button class="btn btn-link mr-4 px-0 dropdown-toggle" type="button" id="dropdownMenuEpisodes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Épisodes
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuEpisodes">
						<a class="dropdown-item" href="<?= $path('episodes') ?>">Publiés</a>
						<a class="dropdown-item" href="<?= $path('episodes-draft') ?>">Brouillons</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= $path('episodes-trash') ?>">Corbeille</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="btn btn-link mr-4 px-0 dropdown-toggle" type="button" id="dropdownMenuComments" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
				<div class="ml-auto d-flex align-items-center">
					<a class="btn btn-secondary no-after" href="<?= $path('new-episode') ?>">
						Nouvel épisode
					</a>
				</div>
			</div>
			<div class="vh66 ov-a">
				<nav class="push font-italic breadcrumb bg-white mb-4 py-4">
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
				<div class="push pr-5">
					<?= $view ?>
				</div>
			</div>
		</div>
	</div>
</div>
