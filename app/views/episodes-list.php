<nav>
	<ul class="episodes-list list-unstyled">
		<?php foreach ($episodes as $episode): ?>
		<li class="mb-5">
			<div class="mb-4">
				<h2 class="h3">
					<span class="badge badge-primary pr-2 py-1">
						# <?= $episode->number() ?><?= $_ifNotEmpty($episode->part(), "-{$episode->part()}") ?>
					</span>
					<a href="<?= $path('episode', [$episode->number(), $episode->slug()]) ?>"><?= $episode->title() ?></a>
				</h2>
			</div>
			<div class="d-flex justify-content-between">
				<time class="datetime meta" datetime="<?= $episode->modificationDatetime() ?>">
					<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-calendar-1">
						<use xlink:href="/sprite.svg#si-glyph-calendar-1">
					</svg>
					Publié <span></span>
				</time>
				<a class="meta" href="<?= $path('episode', [$episode->number(), $episode->slug()]) ?>#anchor-comments">
					<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-bubble-<?= $_ifPlural($episode->nbrComments(), 'message-talk', 'message') ?>">
						<use xlink:href="/sprite.svg#si-glyph-bubble-<?= $_ifPlural($episode->nbrComments(), 'message-talk', 'message') ?>">
					</svg>
					<?= $episode->nbrComments() ?>
					<?= $_ifPlural($episode->nbrComments(), 'commentaires', 'commentaire') ?>
				</a>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</nav>
