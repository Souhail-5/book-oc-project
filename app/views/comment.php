<div class="media mb-3">
	<img class="mr-3" src="<?= "https://www.gravatar.com/avatar/".md5(strtolower(trim($comment->email())))."?d=".urlencode('http://texcites.com/wp-content/uploads/2013/04/gravatar_logo.jpg') ?>" alt="Profil image" width="50" height="50">
	<div class="media-body">
		<div class="d-flex justify-content-between align-items-center">
			<h6 class="my-0"><?= $comment->name() ?></h6>
			<form action="" method="POST">
				<button type="submit" name="action" value="comment-signal">Signaler</button>
				<button type="submit" name="action" value="comment-delete">Supprimer</button>
			</form>
		</div>
		<p><?= $comment->text() ?></p>
	</div>
</div>
