<nav>
	<ul class="episodes-list list-unstyled">
		<?php foreach ($episodes as $episode): ?>
		<li class="mb-5">
			<div class="mb-4">
				<h2 class="h3">
					<span class="badge badge-primary pr-2 py-1">
						# <?= $_esc($episode->number()) ?><?= $_ifNotEmpty($episode->part(), "-{$episode->part()}") ?>
					</span>
					<?php if ($current_route->name() != 'episodes-trash'): ?>
						<a href="<?= $path('episode', [$episode->slug()]) ?>"><?= $episode->title() ?></a>
					<?php else: ?>
						<?= $episode->title() ?>
					<?php endif; ?>
				</h2>
			</div>

			<?php if ($current_route->name() == 'episodes-trash'): ?>
				<form class="d-flex justify-content-between" action="" method="POST">
					<input type="hidden" name="episode-id" value="<?= $episode->id() ?>">
					<button class="btn btn-link p-0 mr-4 meta-success fz-0-95" type="submit" name="action" value="untrash-episode">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-arrow-backward wh-0-95">
							<use xlink:href="/sprite.svg#si-glyph-arrow-backward">
						</svg>
						Restaurer
					</button>
					<button class="btn btn-link p-0 ml-auto meta-danger fz-0-95" type="submit" name="action" value="delete-episode">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-trash wh-0-95">
							<use xlink:href="/sprite.svg#si-glyph-trash">
						</svg>
						Supprimer définitivement
					</button>
				</form>
			<?php else: ?>
				<div class="d-flex justify-content-between">
					<time class="datetime meta" datetime="<?= ($current_route->name() == 'episodes-draft') ? $episode->modificationDatetime() : $episode->publishDatetime() ?>">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-calendar-1">
							<use xlink:href="/sprite.svg#si-glyph-calendar-1">
						</svg>
						<?= ($current_route->name() == 'episodes-draft') ? 'Modifié' : 'Publié' ?> <span></span>
					</time>
					<a class="meta" href="<?= $path('episode', [$episode->slug()]) ?>#anchor-comments">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-bubble-<?= $_ifPlural($episode->nbrComments(), 'message-talk', 'message') ?>">
							<use xlink:href="/sprite.svg#si-glyph-bubble-<?= $_ifPlural($episode->nbrComments(), 'message-talk', 'message') ?>">
						</svg>
						<?= $episode->nbrComments() ?>
						<?= $_ifPlural($episode->nbrComments(), 'commentaires', 'commentaire') ?>
					</a>
				</div>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	</ul>
</nav>
