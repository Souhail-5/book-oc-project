<nav id="episodes-container">
	<ul class="list-unstyled py-4">
		<?php foreach ($episodes as $episode): ?>
		<li>
			<div class="mb-4">
				<h2 class="h3">
					<span class="badge badge-default"># <?= $episode->number() ?></span>
					<span class="badge badge-pill badge-default"><?= $episode->part() ?></span>
					<a href="<?= $path('episode', [$episode->number(), $episode->slug()]) ?>"><?= $episode->title() ?></a>
				</h2>
			</div>
			<div class="d-flex justify-content-between">
				<time datetime="YYYY-MM-DD">
					<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-calendar-1">
						<use xlink:href="sprite.svg#si-glyph-calendar-1">
					</svg>
					<?= $episode->modificationDatetime() ?>
				</time>
				<a href="<?= $path('episode', [$episode->number(), $episode->slug()]) ?>#anchor-comments"><i class="fa fa-comments-o" aria-hidden="true"></i> <?= $episode->nbrComments() ?> commentaires</a>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</nav>
