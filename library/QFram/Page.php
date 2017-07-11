<?php
namespace QFram;

use QFram\Template;

/**
* Page template
*/
class Page extends Template
{
	protected $language = "fr";
	protected $title = "Billet simple pour l'Alaska";
	protected $stylesheets =
	[
		'https://fonts.googleapis.com/css?family=Inconsolata:700|Lato:300,400|Merriweather:300',
		'/vendors/font-awesome-4.7.0/css/font-awesome.min.css',
		'/vendors/normalize/normalize.css',
	];
	protected $scripts = [];
	protected $custom_b_scripts = [];

	public function addStylesheets(array $stylesheets)
	{
		$ns = $this->stylesheets;
		foreach ($stylesheets as $stylesheet) {
			$ns[] = $stylesheet;
		}
		$this->stylesheets = $ns;
	}

	public function addScripts(array $scripts)
	{
		$ns = $this->scripts;
		if (isset($scripts[0]) && is_array($scripts[0])) {
			foreach ($scripts as $script) {
				$ns[] = $script;
			}
		} else {
			$ns[] =
			[
				'src' => $scripts['src'],
				'execute' => $scripts['execute'],
			];
		}

		$this->scripts = $ns;
	}
}
