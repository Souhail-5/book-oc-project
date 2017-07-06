<?php
/**
* Episode Controller
*/
class EpisodeController
{
	function __construct()
	{
		$page = new Template('page');
		$page->language = "fr";
		$page->scripts = array(
			'#',
		);

		$page->title = "Nom de l'épisode";
		$page->stylesheets = array(
			'https://fonts.googleapis.com/css?family=Inconsolata:700|Lato:300,400|Merriweather:300',
			'/vendors/font-awesome-4.7.0/css/font-awesome.min.css',
			'/vendors/normalize/normalize.css',
			'/assets/css/episode.css',
		);

		$episode = new Template('episode');

		$page->view = $episode->render();

		echo $page->render();
	}
}
