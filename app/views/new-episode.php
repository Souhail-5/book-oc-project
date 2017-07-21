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
						<span class="badge badge-default"># <span class="editable-content">X<?= $episode->number() ?></span></span>
						<span class="badge badge-pill badge-default editable-content">0<?= $episode->part() ?></span>
						<h1 class="editable-content">Titre de l'épisode <?= $episode->title() ?></h1>
					</header>
					<div class="text-center">
						<button class="act-delete" type="submit" name="action" value="delete-episode">
							Supprimer
						</button>
						<button type="submit" name="action" value="new-episode">
							Publier
						</button>
					</div>
					<div class="editable-content episode-text" placeholder="test" style="min-height: 150px;">
						Votre texte <?= $episode->text() ?>
					</div>
				</form>
			</article>
		</div>
	</div>
</div>
