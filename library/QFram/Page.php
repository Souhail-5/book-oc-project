<?php
namespace QFram;

use QFram\Template;

/**
* Page template
*/
class Page extends Template
{
	public function __construct(array $data=array())
	{
		parent::__construct('page', $data);
		$this->language = "fr";
		$this->title = "Billet simple pour l'Alaska";
		$this->stylesheets =
		[
			'https://fonts.googleapis.com/css?family=Inconsolata:700|Lato:300,400|Merriweather:300',
			'/vendors/font-awesome-4.7.0/css/font-awesome.min.css',
			'/vendors/kube/dist/css/kube.min.css',
		];
		$this->scripts = [
			[
				'src' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js',
				'execute' => 'defer',
			],
			[
				'src' => '/vendors/kube/dist/js/kube.min.js',
				'execute' => 'async',
			]
		];
		$this->customBtmScripts = [];
	}

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

	public function addCustomBtmScripts(array $customBtmScripts)
	{
		$ns = $this->customBtmScripts;
		foreach ($customBtmScripts as $script) {
			$ns[] = $script;
		}
		$this->customBtmScripts = $ns;
	}
}
