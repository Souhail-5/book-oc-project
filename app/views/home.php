<!-- To-do: Add some HTML5 semantic elements -->
<div class="container">
	<div class="row no-gutters d-md-flex align-items-md-center vh100">
		<div class="home-poster-wrap align-self-md-start col-md-3 offset-md-1">
			<figure class="poster mt-5">
				<img src="/assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
			</figure>
		</div>
		<div class="main-content-wrap col-md-8 offset-md-3">
			<div class="push navbar py-3 pr-3 flex-row justify-content-start align-items-center">
				<div class="dropdown">
					<button class="btn btn-link mr-4 px-0 dropdown-toggle" type="button" id="dropdownMenuEpisodes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Épisodes
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuEpisodes">
						<a class="dropdown-item" href="<?= $path('root') ?>">Publiés</a>
						<a class="dropdown-item" href="#">Brouillons</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Corbeille</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="btn btn-link mr-4 px-0 dropdown-toggle" type="button" id="dropdownMenuComments" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Commentaires
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuComments">
						<a class="dropdown-item" href="<?= $path('comments') ?>">Commentaires</a>
						<a class="dropdown-item" href="<?= $path('comments-signaled') ?>">Signalés</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Corbeille</a>
					</div>
				</div>
				<div class="ml-auto d-flex align-items-center">
					<a class="btn btn-secondary no-after" href="<?= $path('new-episode') ?>">
						Nouvel épisode
					</a>
				</div>
			</div>
			<div class="vh66 ov-a">
				<ol class="push font-italic breadcrumb bg-white mb-4 py-4">
					<li class="breadcrumb-item mr-2">Vous êtes ici :</li>
					<li class="breadcrumb-item active no-before">
						<?php if ($origin_action == 'showCommentsSignaled'): ?>
							Commentaires signalés
						<?php endif; ?>
						<?php if ($origin_action == 'show'): ?>
							Sommaire
						<?php endif; ?>
					</li>
				</ol>
				<div class="push pr-5">
					<?= $view ?>
				</div>
			</div>
		</div>
	</div>
</div>
