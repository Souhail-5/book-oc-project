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
			'<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata:700|Lato:300,400|Merriweather:300">',
			'<link rel="stylesheet" href="/vendors/font-awesome-4.7.0/css/font-awesome.min.css">',
			'<link rel="stylesheet" href="/vendors/bootstrap/dist/css/bootstrap.css">',
		];
		$this->scripts =
		[
			'<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>',
			'<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>',
			'<script src="/vendors/bootstrap/dist/js/bootstrap.js"></script>',
		];
		$this->customBtmScripts = [];
	}

	public function addStylesheets(array $stylesheets)
	{
		$this->stylesheets = array_merge($this->stylesheets, $stylesheets);
	}

	public function addScripts(array $scripts)
	{
		$this->scripts = array_merge($this->scripts, $scripts);
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
