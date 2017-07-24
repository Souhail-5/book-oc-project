<nav>
	<ul class="episodes-list list-unstyled">
		<?php foreach ($episodes as $episode): ?>
		<li class="mb-5">
			<div class="mb-4">
				<h2 class="h3">
					<span class="badge badge-primary pr-2 py-1">
						# <?= $episode->number() ?><?php if (empty($episode->part())): ?>-<?= $episode->part() ?><?php endif; ?>
					</span>
					<a href="<?= $path('episode', [$episode->number(), $episode->slug()]) ?>"><?= $episode->title() ?></a>
				</h2>
			</div>
			<div class="d-flex justify-content-between">
				<time class="meta-color" datetime="YYYY-MM-DD">
					<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-calendar-1 meta-color">
						<use xlink:href="sprite.svg#si-glyph-calendar-1">
					</svg>
					<?= $episode->modificationDatetime() ?>
				</time>
				<a class="meta-color" href="<?= $path('episode', [$episode->number(), $episode->slug()]) ?>#anchor-comments">
					<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-bubble-message meta-color">
						<use xlink:href="sprite.svg#si-glyph-bubble-message">
					</svg>
					<?= $episode->nbrComments() ?>
				</a>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</nav>
