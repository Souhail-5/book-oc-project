<div class="container">
	<div class="row no-gutters align-items-lg-center vh-100">
		<div class="home-poster-wrap d-flex flex-column col-lg-3 ov-a">
			<figure class="poster my-0">
				<img src="/assets/images/poster-livre.png" alt="Book's poster" class="cover">
			</figure>
			<header class="px-4">
				<h1 class="h6 my-4 text-center text-uppercase">
					Billet simple pour l'Alaska
				</h1>
				<p class="text-justify">Lisez mon roman épisode par épisode, directement depuis mon site. Partagez, commentez !</p>
				<p>Lire le <a href="#">premier épisode</a>.</p>
			</header>
			<div class="py-3 px-4 mt-auto d-flex justify-content-end align-items-center">
				<small class="mr-auto"><a href="<?= $path('legal') ?>" class="meta">Mentions légales</a></small>
				<a target="_blank" href="https://facebook.com"><img class="social-icon mr-2" width="16px" height="16px" src="/assets/images/facebook-logo.png" alt="Clik on the Facebook logo to go to my Facebook page."></a>
				<a target="_blank" href="https://twitter.com"><img class="social-icon" width="25px" height="25px" src="/assets/images/twitter-logo.png" alt="Clik on the Twitter logo to go to my Twitter page."></a>
			</div>
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
						<a class="btn btn-primary w-100 no-after" href="<?= $path('episode-new') ?>">
							Nouvel épisode
						</a>
					</div>
				</nav>
			<?php endif; ?>
			<div class="<?= $user->isAuthenticated() ? 'vh-80' : 'vh-90' ?> ov-a">
				<?php if ($current_route->breadcrumb()): ?>
					<nav class="push font-italic breadcrumb bg-white py-4 <?= $_ifNotEmpty($flash->exist(), 'border-0') ?>">
						<span class="breadcrumb-item mr-2">Vous êtes ici :</span>
						<?php $i = 0; $l = count($current_route->breadcrumb()); ?>
						<?php foreach ($current_route->breadcrumb() as $route_name => $route_display_name): ?>
							<?php if ($i == 0): ?>
								<a class="breadcrumb-item no-before" href="<?= $path($route_name) ?>"><?= $route_display_name ?></a>
							<?php elseif ($i == $l-1): ?>
								<span class="breadcrumb-item"><?= $route_display_name ?></span>
							<?php else: ?>
								<a class="breadcrumb-item" href="<?= $path($route_name) ?>"><?= $route_display_name ?></a>
							<?php endif; ?>
							<?php $i++; ?>
						<?php endforeach; ?>
					</nav>
				<?php else: ?>
					<div class="push breadcrumb bg-white py-4 <?= $_ifNotEmpty($flash->exist(), 'border-0') ?>">
						<span>Sommaire, <span class="font-italic">du plus récent au plus ancien</span>.</span>
					</div>
				<?php endif; ?>
				<?php if ($flash->exist()): ?>
					<div class="push alert alert-<?= $flash->get('type') ?> pr-5 border-0" role="alert">
						<p class="m-0"><?= $flash->get('text') ?></p>
					</div>
				<?php endif; ?>
				<section class="push mt-4 pr-1 pr-lg-5 pb-4">
					<?= $view ?>
				</section>
			</div>
		</div>
	</div>
</div>
