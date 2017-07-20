<form action="" method="POST">
	<div class="form-group">
	<label for="comment-name">Nom</label>
		<input type="text" class="form-control" id="comment-name" name="comment-name" placeholder="Votre nom">
	</div>
	<div class="form-group">
		<label for="comment-email">Adresse e-mail</label>
		<input type="email" class="form-control" id="comment-email" name="comment-email" aria-describedby="email-help" placeholder="Votre e-mail">
		<small id="email-help" class="form-text text-muted">Nous ne partagerons jamais votre adresse e-mail.</small>
	</div>
	<div class="form-group">
	<label for="comment-textarea">Votre commentaire</label>
		<textarea class="form-control" id="comment-textarea" name="comment-text" rows="3"></textarea>
	</div>
	<button type="submit" name="action" value="new-episode-comment" class="btn btn-primary">Submit</button>
</form>
