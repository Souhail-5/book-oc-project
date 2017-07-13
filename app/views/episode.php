<div class="section-intro">
	<section class="container">
		<header class="poster">
			<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
		</header>
		<article class="episode">
		<form action="" method="POST">
			<header>
				<a href="<?= $path('root') ?>">< Accueil</a><br>
				<span class="editable-content"># <?= $episode->number() ?></span>
				<h1 class="editable-content"><?= $episode->title() ?></h1>
			</header>
			<div class="metadata">
				<time datetime="YYYY-MM-DD"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $episode->publish_datetime() ?></time>
				<a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> <?= $episode->nbr_comments() ?> commentaires</a>
			</div>
			<div class="metadata">
				<span class="act-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</span>
			</div>
			<div class="editable-content" placeholder="test" style="min-height: 500px;">Edit me ! <?= $episode->text() ?></div>
			<button type="submit">Send</button>
		</form>
		</article>
		<footer></footer>
	</section>
</div>
