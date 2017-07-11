<div class="section-intro">
	<section class="container">
		<header class="poster">
			<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
		</header>
		<article class="episode">
			<header>
				<a href="<?= $path('root') ?>">< Accueil</a><br>
				<span># <?= $episode->number() ?></span>
				<h1><?= $episode->title() ?></h1>
			</header>
			<div class="metadata">
				<time datetime="YYYY-MM-DD"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $episode->publish_datetime() ?></time>
				<a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> <?= $episode->nbr_comments() ?> commentaires</a>
			</div>
			<div class="metadata">
				<span class="act-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</span>
			</div>
			<p><?= $episode->text() ?></p>
		</article>
		<footer></footer>
	</section>
</div>
