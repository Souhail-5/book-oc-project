<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Billet simple pour l'Alaska</title>
	<link rel="stylesheet" href="vendors/normalize/normalize.css">
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
	<section class="intro">
		<div class="container">
			<figure class="poster">
				<img src="assets/images/poster-le-roi-lion.jpg" alt="Book's poster" class="cover">
			</figure>
			<div class="back-poster">
				<div class="admin-bar">
					<span>Nouvel épisode</span>
				</div>
				<nav class="episodes-card">
					<ul>
						<?php for ($i=0; $i < 20; $i++): ?>
						<li>
							<div class="episode-header">
								<span># 23</span>
								<h2>There will be blood</h2>
							</div>
							<div class="episode-metadata">
								<time datetime="YYYY-MM-DD">Publié le 26 juin 2017</time>
								<a href="">2 commentaires</a>
							</div>
						</li>
						<?php endfor; ?>
					</ul>
				</nav>
			</div>
		</div>
	</section>
</body>
</html>
