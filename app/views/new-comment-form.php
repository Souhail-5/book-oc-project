<form action="" method="POST">
	<div class="form-group">
	<label for="comment-name">Nom</label>
		<input type="text" class="form-control" id="comment-name" name="comment-name" aria-describedby="name-help" placeholder="Votre nom" pattern="[a-zA-Z ]{5,50}" value="<?= $_esc($comment->name()) ?>" required>
		<small id="name-help" class="form-text text-muted">Le nom ne doit comporter que des lettres et espaces. Sa longueur doit être comprise entre 5 et 50 caractères.</small>
	</div>
	<div class="form-group">
		<label for="comment-email">Adresse e-mail</label>
		<input type="email" class="form-control" id="comment-email" name="comment-email" aria-describedby="email-help" placeholder="Votre e-mail" value="<?= $_esc($comment->email()) ?>" required>
		<small id="email-help" class="form-text text-muted">Nous ne partagerons jamais votre adresse e-mail.</small>
	</div>
	<div class="form-group">
	<label for="comment-textarea">Votre commentaire</label>
		<textarea class="form-control" id="comment-textarea" name="comment-text" aria-describedby="text-help" rows="10" required minlength="1" maxlength="1400"><?= $_esc($comment->text()) ?></textarea>
		<small id="text-help" class="form-text text-muted">
			<span id="text-length-help">0</span> / 1400.
			La longueur du commentaire ne doit pas dépasser 1400 caractères.
		</small>
	</div>
	<div class="d-lg-flex justify-content-lg-between align-items-lg-center">
		<?php if (!empty($recaptcha_pkey)): ?>
			<div class="g-recaptcha mb-3 mb-lg-0" data-sitekey="<?= $recaptcha_pkey ?>"></div>
		<?php endif; ?>
		<button type="submit" name="action" value="new-episode-comment" class="btn btn-primary">Valider</button>
	</div>
	<input type="hidden" name="episode-id" value="<?= $episode->id() ?>">
</form>
