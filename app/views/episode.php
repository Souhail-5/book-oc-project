<!-- To-do: Add some HTML5 semantic elements -->
<div class="container">
	<header id="hero-image" class="jumbotron jumbotron-fluid py-0">
		<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
	</header>
	<div class="row">
		<div class="col-md-10 offset-md-1 bg-white px-5">
			<article class="episode">
				<ol class="breadcrumb bg-white">
					<li class="breadcrumb-item"><a href="<?= $path('root') ?>">Accueil</a></li>
					<li class="breadcrumb-item active">Nouvel épisode</li>
				</ol>
				<form action="" method="POST">
					<header class="text-center">
						<span class="badge badge-default"># <span class="editable-content"><?= $episode->number() ?></span></span>
						<span class="badge badge-pill badge-default editable-content"><?= $episode->part() ?></span>
						<h1 class="editable-content"><?= $episode->title() ?></h1>
					</header>
					<div class="text-center">
						<time datetime="YYYY-MM-DD">
							<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-calendar-1">
								<use xlink:href="sprite.svg#si-glyph-calendar-1">
							</svg>
							<?= $episode->modificationDatetime() ?>
						</time>
						<a href="#"><?= $episode->nbrComments() ?> commentaires</a>
					</div>
					<div class="text-center">
						<button class="act-delete" type="submit" name="action" value="delete-episode">
							Supprimer
						</button>
						<button type="submit" name="action" value="update-episode">
							Enregistrer
						</button>
					</div>
					<div class="editable-content episode-text" placeholder="test" style="min-height: 150px;">
						<?= $episode->text() ?>
					</div>
				</form>
			</article>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 offset-md-1 bg-white px-5">
			<?= $new_comment_form ?>
		</div>
	</div>
</div>
