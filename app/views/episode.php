<div class="section-intro">
	<section class="container">
		<header class="poster">
			<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
		</header>
		<article class="episode">
		<form action="" method="POST">
			<header>
				<a href="<?= $path('root') ?>">< Accueil</a>
				<br>
				Numéro <span class="editable-content"><?= $episode->number() ?></span>
				<br>
				Partie <span class="editable-content"><?= $episode->part() ?></span>
				<h1 class="editable-content"><?= $episode->title() ?></h1>
			</header>
			<div class="metadata">
				<time datetime="YYYY-MM-DD"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $episode->publishDatetime() ?></time>
				<a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> <?= $episode->nbrComments() ?> commentaires</a>
			</div>
			<div class="metadata">
				<button class="act-delete" type="submit" name="action" value="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</button>
			</div>
			<div class="editable-content" placeholder="test" style="min-height: 50px;"><?= $episode->text() ?></div>
			<button type="submit" name="action" value="update">Send</button>
		</form>
		</article>
		<footer></footer>
	</section>
</div>
