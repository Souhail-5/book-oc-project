<?php
/**
* Home Controller
*/
class HomeController
{
	function __construct()
	{
		$page = new Template('page');
		$page->language = "fr";
		$page->scripts = array(
			'#',
		);

		$page->title = "Billet simple pour l'Alaska";
		$page->stylesheets = array(
			'https://fonts.googleapis.com/css?family=Inconsolata:700|Lato:300,400|Merriweather:300',
			'/vendors/font-awesome-4.7.0/css/font-awesome.min.css',
			'/vendors/normalize/normalize.css',
			'/assets/css/main.css',
		);

		$episodes = new Template('episodes');
		$episodes->test = 'Nouvel épisode';

		$page->view = $episodes->render();

		echo $page->render();
	}
}
