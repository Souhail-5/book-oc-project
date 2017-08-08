<div>
	<?php if (!empty($comments_list)): ?>
		<?= $comments_list ?>
		<?= $pagination ?>
	<?php else: ?>
		<p>
			Aucun commentaire.
		</p>
	<?php endif; ?>
</div>
