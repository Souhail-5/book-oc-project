<!-- To-do: Add some HTML5 semantic elements -->
<header class="featured-image-main jumbotron jumbotron-fluid py-0">
	<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
</header>
<div class="container">
	<div class="episode-main-content-wrap row">
		<div class="episode-main-content col-md-10 offset-md-1 px-5 py-3">
			<form class="episode" action="" method="POST">
				<ol class="breadcrumb bg-white pb-4 mb-4">
					<li class="breadcrumb-item"><a href="<?= $path('root') ?>">Accueil</a></li>
					<li class="breadcrumb-item active">Nouvel épisode</li>
				</ol>
				<?php if (!empty($warning)): ?>
					<div class="alert alert-warning mb-5" role="alert">
						<h4 class="alert-heading">Attention !</h4>
						<p><?= $warning ?></p>
					</div>
				<?php endif; ?>
				<header class="text-center">
					<div class="badge badge-primary mw-100">
						#
						<input class="ghost text-white mw-100" type="text" name="episode-number" id="input-episode-number" value="<?= $episode->number() ?>" pattern="[0-9]+" placeholder="épisode" size="1" required>
						<span class="mr-1">-</span>
						<input class="ghost text-white mw-100" type="text" name="episode-part" id="input-episode-part" value="<?= $episode->part() ?>" pattern="[0-9]+" placeholder="partie" size="1">
					</div>
					<h1 class="w-75 mx-auto my-5 episode-title"><?= $episode->title() ?></h1>
					<div class="input-group justify-content-center mb-3">
						<span class="input-group-addon" id="basic-addon-slug">Permalien</span>
						<input class="form-control flex-g-0" type="text" name="episode-slug" id="input-episode-slug" value="<?= $episode->slug() ?>" pattern="[a-z0-9-]+" placeholder="Laissé vide, il sera généré automatiquement." aria-describedby="basic-addon-slug">
					</div>
				</header>
				<div class="episode-text" placeholder="test" style="min-height: 150px;">
					<?= $episode->text() ?>
				</div>
				<div class="text-right">
					<button class="btn btn-link meta-success" type="submit" name="action" value="draft-episode">
						Enregistrer en tant que brouillon
					</button>
					<button class="btn btn-primary" type="submit" name="action" value="publish-new-episode">
						Publier
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
