<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Billet simple pour l'Alaska</title>
	<link href="https://fonts.googleapis.com/css?family=Inconsolata:700|Lato:300,400|Merriweather:300" rel="stylesheet">
	<link rel="stylesheet" href="vendors/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendors/normalize/normalize.css">
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
	<div class="section-intro">
		<div class="container">
			<figure class="poster">
				<img src="assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
			</figure>
			<section class="back-poster">
				<div class="admin-bar">
					<span class="act-new"><i class="fa fa-plus" aria-hidden="true"></i> Nouvel épisode</span>
				</div>
				<nav class="episodes-card">
					<ul>
						<?php for ($i=23; $i > 0; $i--): ?>
						<li>
							<div class="episode-header">
								<span># <?php echo $i;?></span>
								<h2>There will be blood</h2>
							</div>
							<div class="episode-metadata">
								<div>
									<time datetime="YYYY-MM-DD"><i class="fa fa-calendar" aria-hidden="true"></i> 26 juin 2017</time>
									<a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 2 commentaires</a>
								</div>
								<div>
									<span class="act-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer</span>
									<span class="act-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</span>
								</div>
							</div>
						</li>
						<?php endfor; ?>
					</ul>
				</nav>
			</section>
		</div>
	</div>
</body>
</html>
