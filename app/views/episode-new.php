<header class="featured-image-main jumbotron jumbotron-fluid mb-0 py-0">
	<img src="/assets/images/featured-single-episode-<?= rand(1, 5) ?>.jpg" alt="Book's poster" class="cover">
</header>
<div class="container">
	<div class="episode-main-content-wrap row no-gutters">
		<div class="episode-main-content col-lg-10 offset-lg-1 px-2 px-lg-5 py-3 pb-5">
			<form class="episode" action="" method="POST">
				<ol class="breadcrumb bg-white pb-4 mb-4">
					<li class="breadcrumb-item"><a href="<?= $path('root') ?>">Accueil</a></li>
					<li class="breadcrumb-item active">Nouvel épisode</li>
				</ol>
				<?php if ($flash->exist()): ?>
					<div class="alert alert-<?= $flash->get('type') ?> mb-5 border-0" role="alert">
						<h4 class="alert-heading sans-serif"><?= $flash->get('title') ?></h4>
						<p class="m-0"><?= $flash->get('text') ?></p>
					</div>
				<?php endif; ?>
				<header class="text-center">
					<div class="badge badge-primary mw-100 mt-2 mt-lg-5 mb-1 mb-lg-4">
						#
						<input class="ghost text-white mw-100" type="text" name="episode-number" id="input-episode-number" value="<?= $episode->number() ?>" pattern="[0-9]{0,999}" placeholder="épisode" size="1">
						<span class="mr-1">-</span>
						<input class="ghost text-white mw-100" type="text" name="episode-part" id="input-episode-part" value="<?= $episode->part() ?>" pattern="[0-9]{0,999}" placeholder="partie" size="1">
					</div>
					<h1 class="episode-title mx-auto my-4 mb-lg-5"><?= $_ifNotEmpty($episode->title(), $episode->title(), 'Votre titre') ?></h1>
					<div class="input-group flex-column flex-lg-row justify-content-center mb-3">
						<span class="input-group-addon ov-a" id="basic-addon-slug"><?= $_SERVER['SERVER_NAME'] ?>/episode/</span>
						<input class="form-control flex-g-0" type="text" name="episode-slug" id="input-episode-slug" value="<?= $_esc($episode->slug()) ?>" pattern="[a-z0-9-]{0,255}" placeholder="Laissé vide, il sera généré automatiquement." aria-describedby="basic-addon-slug">
					</div>
				</header>
				<div class="episode-text col-lg-10 offset-lg-1 text-justify" placeholder="test" style="min-height: 150px;">
					<?= $_ifNotEmpty($episode->text(), $episode->text(), 'Il était une fois ...') ?>
				</div>
				<div class="d-flex flex-column flex-lg-row justify-content-lg-end align-items-lg-center">
					<button class="btn btn-link meta-success mb-3 mb-lg-0" type="submit" name="action" value="draft-episode">
						Enregistrer en tant que brouillon
					</button>
					<button class="btn btn-primary" type="submit" name="action" value="publish-new-episode">
						Publier
					</button>
				</div>
			</form>
		</div>
	</div>
	<small class="d-block w-100 mb-4 text-center">
		<a href="<?= $path('legal') ?>" class="meta">Mentions légales</a>
	</small>
</div>
