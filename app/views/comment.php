<div class="media mb-4">
	<img class="mr-3" src="<?= "https://www.gravatar.com/avatar/".md5(strtolower(trim($_esc($comment->email()))))."?d=".urlencode('http://texcites.com/wp-content/uploads/2013/04/gravatar_logo.jpg') ?>" alt="Profil image" width="50" height="50">
	<div class="media-body">
		<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">
			<h6 class="mb-2 mb-lg-0 my-lg-0 fz-1-05"><?= $_esc($comment->name()) ?></h6>
			<form action="" method="POST">
				<?php if ($comment->approved() == 0 && $current_route->name() == 'episode'): ?>
					<button class="btn btn-link p-0 ml-lg-4 meta-danger fz-0-95" type="submit" name="action" value="signal-comment">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-circle-remove wh-0-95">
							<use xlink:href="/sprite.svg#si-glyph-circle-remove">
						</svg>
						Signaler
					</button>
					<input type="hidden" name="comment-id" value="<?= $comment->id() ?>">
				<?php endif; ?>
				<?php if ($comment->approved() == 0 && $current_route->originalController() == 'comments' && !empty($comment->nbrSignals())): ?>
					<span class="meta ml-lg-4 fz-0-95">
						<?= $comment->nbrSignals().' '.$_ifPlural($comment->nbrSignals(), 'signalements', 'signalement') ?>
					</span>
				<?php endif; ?>
			</form>
		</div>
		<p class="mt-3 more"><?= $_esc($comment->text()) ?></p>
		<?php if ($user->isAuthenticated()): ?>
			<form class="d-flex flex-column flex-lg-row align-items-start justify-content-lg-end align-items-lg-center" action="" method="POST">
				<?php if ($current_route->originalController() == 'comments' && $current_route->name() != 'comments-trash'): ?>
					<button class="btn btn-link p-0 mr-lg-4 mb-3 mb-lg-0 meta-danger fz-0-95" type="submit" name="action" value="trash-comment">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-trash wh-0-95">
							<use xlink:href="/sprite.svg#si-glyph-trash">
						</svg>
						Corbeille
					</button>
				<?php endif; ?>
				<?php if ($current_route->name() == 'comments-trash'): ?>
					<button class="btn btn-link p-0 mr-lg-4 mb-3 mb-lg-0 meta-success fz-0-95" type="submit" name="action" value="untrash-comment">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-arrow-backward wh-0-95">
							<use xlink:href="/sprite.svg#si-glyph-arrow-backward">
						</svg>
						Restaurer
					</button>
					<button class="btn btn-link p-0 ml-lg-auto meta-danger fz-0-95" type="submit" name="action" value="delete-comment">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-trash wh-0-95">
							<use xlink:href="/sprite.svg#si-glyph-trash">
						</svg>
						Supprimer définitivement
					</button>
				<?php endif; ?>
				<?php if ($comment->approved() == 0 && ($current_route->name() == 'comments' || $current_route->name() == 'comments-signaled')): ?>
					<button class="btn btn-link p-0 ml-lg-auto meta-success fz-0-95" type="submit" name="action" value="approve-comment">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-checked wh-0-95">
							<use xlink:href="/sprite.svg#si-glyph-checked">
						</svg>
						Approuver
					</button>
				<?php endif; ?>
				<?php if ($comment->approved() == 1 && ($current_route->name() == 'comments' || $current_route->name() == 'comments-approved')): ?>
					<button class="btn btn-link p-0 ml-lg-auto meta-danger fz-0-95" type="submit" name="action" value="disapprove-comment">
						<svg xmlns="http://www.w3.org/2000/svg" class="si-glyph-delete wh-0-95">
							<use xlink:href="/sprite.svg#si-glyph-delete">
						</svg>
						Désapprouver
					</button>
				<?php endif; ?>
				<input type="hidden" name="comment-id" value="<?= $comment->id() ?>">
			</form>
		<?php endif; ?>
	</div>
</div>
