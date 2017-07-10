<div class="section-intro">
	<div class="container">
		<figure class="poster">
			<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
		</figure>
		<section class="back-poster">
			<div class="admin-bar">
				<span class="act-new"><i class="fa fa-plus" aria-hidden="true"></i> Nouvel épisode</span>
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
								<time datetime="YYYY-MM-DD"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $episode->publish_datetime() ?></time>
								<a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> <?= $episode->nbr_comments() ?> commentaires</a>
							</div>
							<div>
								<span class="act-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</span>
								<span class="act-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</span>
							</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</section>
	</div>
</div>
