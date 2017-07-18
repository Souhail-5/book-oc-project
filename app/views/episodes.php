<div class="container">
	<div id="main" class="row d-md-flex align-items-md-center">
		<div id="poster-col" class="align-self-md-start col-md-3 offset-md-1">
			<figure class="poster">
				<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
			</figure>
		</div>
		<div id="main-col" class="col-md-8 offset-md-3">
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
						</div>
					</div>
				</div>
			</div>
			<nav id="episodes-container">
				<ul class="list-unstyled py-4">
					<?php foreach ($episodes as $episode): ?>
					<li>
						<div class="mb-4">
							<h2 class="h3"><span class="badge badge-default"># <?= $episode->number() ?></span><span class="badge badge-pill badge-default"><?= $episode->part() ?></span><a href="<?= $path('episode', [$episode->number(), $episode->slug()]) ?>"><?= $episode->title() ?></a></h2>
						</div>
						<div class="d-flex justify-content-between">
							<time datetime="YYYY-MM-DD">
								<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-calendar-1">
									<use xlink:href="sprite.svg#si-glyph-calendar-1">
								</svg>
								<?= $episode->modificationDatetime() ?>
							</time>
							<a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> <?= $episode->nbrComments() ?> commentaires</a>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</div>
	</div>
</div>
