<?php

spl_autoload_register(function ($class) {
    require_once 'models/'.$class.'.php';
});

$currentParthUrl = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$page = new Template('page');
$page->language = "fr";
$page->scripts = array(
	'#',
);

if ($currentParthUrl[0] == 'episodes') {
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

if ($currentParthUrl[0] == 'episode') {
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
