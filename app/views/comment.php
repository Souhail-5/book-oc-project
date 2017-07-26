<div class="media mb-3">
	<img class="mr-3" src="<?= "https://www.gravatar.com/avatar/".md5(strtolower(trim($comment->email())))."?d=".urlencode('http://texcites.com/wp-content/uploads/2013/04/gravatar_logo.jpg') ?>" alt="Profil image" width="50" height="50">
	<div class="media-body">
		<div class="d-flex justify-content-between align-items-center">
			<h6 class="my-0 fz-1-05"><?= $comment->name() ?></h6>
			<form class="d-flex align-items-center" action="" method="POST">
				<?php if ($current_route->originalController() != 'comments'): ?>
					<button class="btn btn-link p-0 ml-4 meta-danger fz-0-95" type="submit" name="action" value="signal-comment">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-circle-remove wh-0-95">
							<use xlink:href="/sprite.svg#si-glyph-circle-remove">
						</svg>
						Signaler
					</button>
				<?php endif; ?>
				<input type="hidden" name="comment-id" value="<?= $comment->id() ?>">
			</form>
		</div>
		<p class="mt-3 more"><?= $comment->text() ?></p>
		<form class="d-flex justify-content-end align-items-center" action="" method="POST">
			<?php if ($current_route->originalController() == 'comments' && !empty($comment->nbrSignals())): ?>
				<button class="btn btn-link p-0 mr-auto meta-danger fz-0-95" type="submit" name="action" value="reset-signals-comment">
					Ignorer <?= $comment->nbrSignals().' '.$_ifPlural($comment->nbrSignals(), 'signalements', 'signalement') ?>
				</button>
			<?php endif; ?>
			<?php if ($current_route->originalController() == 'comments' && $current_route->name() != 'comments-trash'): ?>
				<button class="btn btn-link p-0 mr-4 meta-danger fz-0-95" type="submit" name="action" value="trash-comment">
					<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-trash wh-0-95">
						<use xlink:href="/sprite.svg#si-glyph-trash">
					</svg>
					Corbeille
				</button>
			<?php endif; ?>
			<?php if ($current_route->name() == 'comments-trash'): ?>
				<button class="btn btn-link p-0 mr-4 meta-danger fz-0-95" type="submit" name="action" value="delete-comment">
					<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-trash wh-0-95">
						<use xlink:href="/sprite.svg#si-glyph-trash">
					</svg>
					Supprimer définitivement
				</button>
			<?php endif; ?>
			<input type="hidden" name="comment-id" value="<?= $comment->id() ?>">
		</form>
	</div>
</div>
