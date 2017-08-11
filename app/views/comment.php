<div class="media mb-4">
	<img class="mr-3" src="<?= "https://www.gravatar.com/avatar/".md5(strtolower(trim($_esc($comment->email()))))."?d=".urlencode('http://texcites.com/wp-content/uploads/2013/04/gravatar_logo.jpg') ?>" alt="Profil image" width="50" height="50">
	<div class="media-body">
		<div class="d-flex flex-column flex-lg-row justify-content-start align-items-lg-center">
			<div class="h6 mb-2 mb-lg-0 my-lg-0 fz-1-05">
				<?= $_esc($comment->name()) ?>
			</div>
			<form class="ml-auto" action="" method="POST">
				<?php if ($comment->approved() == 0 && $current_route->name() == 'episode'): ?>
					<button class="btn btn-link p-0 ml-lg-4 meta-danger fz-0-95" type="submit" name="action" value="signal-comment">
						<svg-icon class="si-glyph-circle-remove wh-0-95 meta">
							<src href="/sprite.svg#si-glyph-circle-remove" />
						</svg-icon>
						Signaler
					</button>
					<input type="hidden" name="comment-id" value="<?= $comment->id() ?>">
				<?php endif; ?>
				<?php if ($comment->approved() == 0 && $current_route->originalController() == 'comments' && !empty($comment->nbrSignals())): ?>
					<span class="meta ml-lg-4 fz-0-95">
						<span class="font-weight-bold text-danger"><?= $comment->nbrSignals() ?></span>
						<?= $_ifPlural($comment->nbrSignals(), 'signalements', 'signalement') ?>
					</span>
				<?php endif; ?>
			</form>
		</div>
		<time class="datetime d-flex mb-2 mb-lg-0 my-lg-0 fz-0-80" datetime="<?= $comment->publishDatetime() ?>">
			<span class="meta mr-1">Publié</span><span class="time-description meta"></span>
		</time>
		<p class="comment-text mt-3 more"><?= nl2br($_esc($comment->text())) ?></p>
		<?php if ($user->isAuthenticated()): ?>
			<form class="d-flex flex-column flex-lg-row align-items-start justify-content-lg-end align-items-lg-center" action="" method="POST">
				<?php if ($current_route->originalController() == 'comments' && $current_route->name() != 'comments-trash'): ?>
					<button class="btn btn-link p-0 mr-lg-4 mb-3 mb-lg-0 meta-danger fz-0-95" type="submit" name="action" value="trash-comment">
						<svg-icon class="si-glyph-trash wh-0-95 meta">
							<src href="/sprite.svg#si-glyph-trash" />
						</svg-icon>
						Corbeille
					</button>
				<?php endif; ?>
				<?php if ($current_route->name() == 'comments-trash'): ?>
					<button class="btn btn-link p-0 mr-lg-4 mb-3 mb-lg-0 meta-success fz-0-95" type="submit" name="action" value="untrash-comment">
						<svg-icon class="si-glyph-arrow-backward wh-0-95 meta">
							<src href="/sprite.svg#si-glyph-arrow-backward" />
						</svg-icon>
						Restaurer
					</button>
					<button class="btn btn-link p-0 ml-lg-auto meta-danger fz-0-95" type="submit" name="action" value="delete-comment">
						<svg-icon class="si-glyph-trash wh-0-95 meta">
							<src href="/sprite.svg#si-glyph-trash" />
						</svg-icon>
						Supprimer définitivement
					</button>
				<?php endif; ?>
				<?php if ($comment->approved() == 0 && ($current_route->name() == 'comments' || $current_route->name() == 'comments-signaled')): ?>
					<button class="btn btn-link p-0 ml-lg-auto meta-success fz-0-95" type="submit" name="action" value="approve-comment">
						<svg-icon class="si-glyph-checked wh-0-95 meta">
							<src href="/sprite.svg#si-glyph-checked" />
						</svg-icon>
						Approuver
					</button>
				<?php endif; ?>
				<?php if ($comment->approved() == 1 && ($current_route->name() == 'comments' || $current_route->name() == 'comments-approved')): ?>
					<button class="btn btn-link p-0 ml-lg-auto meta-warning fz-0-95" type="submit" name="action" value="disapprove-comment">
						<svg-icon class="si-glyph-delete wh-0-95 meta">
							<src href="/sprite.svg#si-glyph-delete" />
						</svg-icon>
						Désapprouver
					</button>
				<?php endif; ?>
				<input type="hidden" name="comment-id" value="<?= $comment->id() ?>">
			</form>
		<?php endif; ?>
	</div>
</div>
