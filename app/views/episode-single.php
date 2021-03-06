<header class="featured-image-main jumbotron jumbotron-fluid mb-0 py-0">
	<img src="/assets/images/featured-single-episode-<?= rand(1, 5) ?>.jpg" alt="Episode's featured image" class="cover">
</header>
<div class="container">
	<section class="episode-main-content-wrap row no-gutters">
		<div class="episode-main-content col-lg-10 offset-lg-1 py-3 pb-5">
			<nav class="px-2 px-lg-5">
				<ol class="breadcrumb bg-white pb-4 mb-4">
					<li class="breadcrumb-item"><a href="<?= $path('root') ?>">Accueil</a></li>
					<li class="breadcrumb-item"><a href="<?= $path('episodes') ?>">Épisodes</a></li>
					<?php if ($episode->status() == 'publish' && $user->isAuthenticated()): ?>
						<li class="breadcrumb-item"><a href="<?= $path('episodes') ?>">Publiés</a></li>
					<?php elseif ($episode->status() == 'draft' && $user->isAuthenticated()): ?>
						<li class="breadcrumb-item"><a href="<?= $path('episodes-draft') ?>">Brouillons</a></li>
					<?php endif; ?>
					<li class="breadcrumb-item active"><?= $episode->title() ?></li>
				</ol>
			</nav>
			<article class="episode px-2 px-lg-5">
				<?php if ($flash->exist()): ?>
					<div class="alert alert-<?= $flash->get('type') ?> mb-5 border-0" role="alert">
						<h4 class="alert-heading sans-serif"><?= $flash->get('title') ?></h4>
						<p class="m-0"><?= $flash->get('text') ?></p>
					</div>
				<?php endif; ?>
				<?php if ($user->isAuthenticated()): ?>
					<form action="" method="POST">
				<?php endif; ?>
						<header class="text-center">
							<div class="badge badge-primary mw-100 mt-2 mt-lg-5 mb-1 mb-lg-4">
								#
								<?php if ($user->isAuthenticated()): ?>
									<input class="ghost text-white mw-100" type="text" name="episode-number" id="input-episode-number" value="<?= $_esc($episode->number()) ?>" pattern="[0-9]+" placeholder="épisode" size="1">
									<span class="mr-1">-</span>
									<input class="ghost text-white mw-100" type="text" name="episode-part" id="input-episode-part" value="<?= $_esc($episode->part()) ?>" pattern="[0-9]+" placeholder="partie" size="1">
								<?php else: ?>
									<?= $_esc($episode->number()) ?><?= $_ifNotEmpty($episode->part(), " - {$_esc($episode->part())}") ?>
								<?php endif; ?>
							</div>
							<h1 class="episode-title mx-auto my-4 mb-lg-5"><?= $episode->title() ?></h1>
							<?php if ($user->isAuthenticated()): ?>
								<div class="input-group flex-column flex-lg-row justify-content-center mb-3">
									<span class="input-group-addon" id="basic-addon-slug"><?= $_SERVER['SERVER_NAME'] ?>/episode/</span>
									<input class="form-control flex-g-0" type="text" name="episode-slug" id="input-episode-slug" value="<?= $_esc($episode->slug()) ?>" pattern="[a-z0-9-]+" placeholder="Laissé vide, il sera généré automatiquement." aria-describedby="basic-addon-slug">
								</div>
							<?php endif; ?>
							<div class="d-flex flex-column flex-lg-row col-lg-6 offset-lg-3 <?= ($episode->status() == 'publish') ? "justify-content-between" : "justify-content-center" ?>">
								<time class="datetime meta mb-2 mb-lg-0" datetime="<?= ($episode->status() != 'publish') ? $episode->modificationDatetime() : $episode->publishDatetime() ?>">
									<svg-icon class="si-glyph-calendar-1 meta">
										<src href="/sprite.svg#si-glyph-calendar-1" />
									</svg-icon>
									<?= ($episode->status() != 'publish') ? 'Modifié' : 'Publié' ?> <span class="time-description"></span>
								</time>
								<?php if ($episode->status() == 'publish'): ?>
									<a class="meta" href="<?= $path('episode', [$episode->slug()]) ?>#anchor-comments">
										<svg-icon class="si-glyph-bubble-<?= $_ifPlural($episode->nbrComments(), 'message-talk', 'message') ?> meta">
											<src href="/sprite.svg#si-glyph-bubble-<?= $_ifPlural($episode->nbrComments(), 'message-talk', 'message') ?>" />
										</svg-icon>
										<?= $episode->nbrComments() ?>
										<?= $_ifPlural($episode->nbrComments(), 'commentaires', 'commentaire') ?>
									</a>
								<?php endif; ?>
							</div>
						</header>
						<div class="episode-text col-lg-10 offset-lg-1 text-justify" placeholder="test" style="min-height: 150px;">
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
				<aside class="comment-form-wrap mt-5 py-3">
					<hr class="my-5">
					<div class="px-2 px-lg-5">
						<h3 class="h2 sans-serif">Une réaction ?</h4>
						<p class="mt-4 mb-5">
							<?php if (!empty($comments)): ?>
								Rejoignez <a href="#anchor-comments">la discussion</a> en laissant votre commentaire à propos de cette épisode.
							<?php else: ?>
								Entamer la discussion, avec les lecteurs et moi, en laissant votre commentaire à propos de cette épisode.
							<?php endif; ?>
						</p>
						<?= $new_comment_form ?>
					</div>
				</aside>
			<?php endif; ?>
			<?php if (!empty($comments)): ?>
				<aside class="comments-wrap py-3">
					<hr class="my-5">
					<div class="px-2 px-lg-5">
						<h3 class="h2 sans-serif mb-5" id="anchor-comments">Commentaires</h4>
						<?= $comments ?>
					</div>
				</aside>
			<?php endif; ?>
		</div>
	</section>
	<small class="d-block w-100 mb-4 text-center">
		<a href="<?= $path('legal') ?>" class="meta">Mentions légales</a>
	</small>
</div>
