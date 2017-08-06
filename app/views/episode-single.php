<!-- To-do: Add some HTML5 semantic elements -->
<header class="featured-image-main jumbotron jumbotron-fluid mb-0 py-0">
	<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
</header>
<div class="container">
	<div class="episode-main-content-wrap row no-gutters">
		<div class="episode-main-content col-lg-10 offset-lg-1 px-2 px-lg-5 py-3">
			<article class="episode">
				<ol class="breadcrumb bg-white pb-4 mb-4">
					<li class="breadcrumb-item"><a href="<?= $path('root') ?>">Accueil</a></li>
					<li class="breadcrumb-item active"><?= $episode->title() ?></li>
				</ol>
				<?php if ($flash->exist()): ?>
					<div class="alert alert-<?= $flash->get('type') ?> mb-5" role="alert">
						<h4 class="alert-heading"><?= $flash->get('title') ?></h4>
						<p><?= $flash->get('text') ?></p>
					</div>
				<?php endif; ?>
				<?php if ($user->isAuthenticated()): ?>
					<form action="" method="POST">
				<?php endif; ?>
						<header class="text-center">
							<div class="badge badge-primary mw-100">
								#
								<?php if ($user->isAuthenticated()): ?>
									<input class="ghost text-white mw-100" type="text" name="episode-number" id="input-episode-number" value="<?= $_esc($episode->number()) ?>" pattern="[0-9]+" placeholder="épisode" size="1">
									<span class="mr-1">-</span>
									<input class="ghost text-white mw-100" type="text" name="episode-part" id="input-episode-part" value="<?= $_esc($episode->part()) ?>" pattern="[0-9]+" placeholder="partie" size="1">
								<?php else: ?>
									<?= $_esc($episode->number()) ?> - <?= $_esc($episode->part()) ?>
								<?php endif; ?>
							</div>
							<h1 class="mx-auto my-3 my-lg-5 episode-title"><?= $episode->title() ?></h1>
							<?php if ($user->isAuthenticated()): ?>
								<div class="input-group flex-column flex-lg-row justify-content-center mb-3">
									<span class="input-group-addon" id="basic-addon-slug">Permalien</span>
									<input class="form-control flex-g-0" type="text" name="episode-slug" id="input-episode-slug" value="<?= $_esc($episode->slug()) ?>" pattern="[a-z0-9-]+" placeholder="Laissé vide, il sera généré automatiquement." aria-describedby="basic-addon-slug">
								</div>
							<?php endif; ?>
							<div class="d-flex flex-column flex-lg-row col-lg-6 offset-lg-3 <?= ($episode->status() == 'publish') ? "justify-content-between" : "justify-content-center" ?>">
								<time class="datetime meta mb-2 mb-lg-0" datetime="<?= ($episode->status() != 'publish') ? $episode->modificationDatetime() : $episode->publishDatetime() ?>">
									<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-calendar-1">
										<use xlink:href="/sprite.svg#si-glyph-calendar-1">
									</svg>
									<?= ($episode->status() != 'publish') ? 'Modifié' : 'Publié' ?> <span></span>
								</time>
								<?php if ($episode->status() == 'publish'): ?>
									<a class="meta" href="<?= $path('episode', [$episode->slug()]) ?>#anchor-comments">
										<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-bubble-<?= $_ifPlural($episode->nbrComments(), 'message-talk', 'message') ?>">
											<use xlink:href="/sprite.svg#si-glyph-bubble-<?= $_ifPlural($episode->nbrComments(), 'message-talk', 'message') ?>">
										</svg>
										<?= $episode->nbrComments() ?>
										<?= $_ifPlural($episode->nbrComments(), 'commentaires', 'commentaire') ?>
									</a>
								<?php endif; ?>
							</div>
						</header>
						<div class="episode-text" placeholder="test" style="min-height: 150px;">
							<?= $episode->text() ?>
						</div>
						<?php if ($user->isAuthenticated()): ?>
							<div class="d-flex flex-column flex-lg-row justify-content-lg-end align-items-lg-center" action="" method="POST">
								<input type="hidden" name="episode-id" value="<?= $episode->id() ?>">
								<button class="btn btn-link meta-danger mr-auto px-0 mb-3 mb-lg-0" type="submit" name="action" value="trash-episode">
									Mettre à la corbeille
								</button>
								<?php if ($episode->status() == 'publish'): ?>
									<button class="btn btn-primary" type="submit" name="action" value="update-episode">
										Publier les modifications
									</button>
								<?php else: ?>
									<button class="btn btn-link meta-success mb-3 mb-lg-0" type="submit" name="action" value="update-episode">
										Enregistrer
									</button>
									<button class="btn btn-primary" type="submit" name="action" value="publish-episode">
										Publier
									</button>
								<?php endif; ?>
							</div>
						<?php endif; ?>
				<?php if ($user->isAuthenticated()): ?>
					</form>
				<?php endif; ?>
			</article>
			<?php if (!empty($new_comment_form)): ?>
				<div class="mt-5">
					<h4>Un commentaire ?</h4>
					<hr>
					<?= $new_comment_form ?>
				</div>
			<?php endif; ?>
			<?php if (!empty($comments)): ?>
				<div class="mt-5">
					<h4 id="anchor-comments">Commentaires</h4>
					<hr>
					<?= $comments ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
