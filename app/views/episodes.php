<div class="section-intro">
	<div class="container">
		<figure class="poster">
			<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
		</figure>
		<section class="back-poster">
			<div class="admin-bar">
				<a href="<?= $path('new-episode') ?>" class="act-new"><i class="fa fa-plus" aria-hidden="true"></i> Nouvel épisode</a>
			</div>
			<nav class="episodes-card">
				<ul>
					<?php foreach ($episodes as $episode): ?>
					<li>
						<div class="episode-header">
							<span># <?= $episode->number() ?></span>
							<h2><a href="<?= $path('episode', [$episode->number(), $episode->slug()]) ?>"><?= $episode->title() ?></a></h2>
						</div>
						<div class="episode-metadata">
							<div>
								<time datetime="YYYY-MM-DD"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $episode->modificationDatetime() ?></time>
							</div>
							<div>
								<a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> <?= $episode->nbrComments() ?> commentaires</a>
							</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</section>
	</div>
</div>
