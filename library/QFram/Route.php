<?php
namespace QFram;

/**
* Route model
*/
class Route
{
	use \QFram\Helper\Utility;

	protected $name;
	protected $urlPattern;
	protected $controller;
	protected $originalController;
	protected $action;
	protected $originalAction;
	protected $varsNames = array();
	protected $vars = array();
	protected $before = array();
	protected $breadcrumb = array();

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function name() { return $this->name; }
	public function urlPattern() { return $this->urlPattern; }
	public function controller() { return $this->controller; }
	public function originalController() { return $this->originalController; }
	public function action() { return $this->action; }
	public function originalAction() { return $this->originalAction; }
	public function varsNames() { return $this->varsNames; }
	public function vars() { return $this->vars; }
	public function before() { return $this->before; }
	public function breadcrumb() { return $this->breadcrumb; }

	public function setName($value)
	{
		$this->name = $value;
	}

	public function setUrlPattern($value)
	{
		$this->urlPattern = $value;
	}

	public function setController($value)
	{
		$this->controller = str_replace('-', '', ucwords($value, '-'));
		$this->originalController = $value;
	}

	public function setAction($value)
	{
		$this->action = str_replace('-', '', lcfirst(ucwords($value, '-')));
		$this->originalAction = $value;
	}

	public function setVarsNames(array $value)
	{
		$this->varsNames = $value;
	}

	public function setVars(array $value)
	{
		$this->vars = $value;
	}

	public function setBefore(array $before)
	{
		foreach ($before as $key => $value) {
			$before[$key]["controller"] = str_replace('-', '', ucwords($before[$key]["controller"], '-'));
			$before[$key]["action"] = str_replace('-', '', lcfirst(ucwords($before[$key]["action"], '-')));
		}
		$this->before = $before;
	}

	public function setBreadcrumb(array $breadcrumb)
	{
		foreach ($breadcrumb as $route_name => $route_display_name) {
			if (preg_match_all('`{(.*)}`U', $route_display_name, $matches)) {
				foreach ($matches[1] as $value) {
					if (!isset($this->vars()[$value]) && isset($breadcrumb[$route_name])) {
						unset($breadcrumb[$route_name]);
					} else {
						$breadcrumb[$route_name] = preg_replace('`{'.$value.'}`U', $this->vars()[$value], $route_display_name);
					}
				}
			}
		}
		$this->breadcrumb = $breadcrumb;
	}

	public function setVarsFromUrl($url)
	{
		if (
			preg_match('`^'.$this->urlPattern().'(?:\\?[a-z0-9-&=]{3,})?$`', $url, $matches) &&
			(
				(int) count($this->varsNames()) >= (int) (count($matches)-1)
			)
		) {
			$vars = [];
			foreach ($matches as $key => $match) {
				if ($key !== 0) {
					$vars[$this->varsNames()[$key - 1]] = $match;
				}
			}
			$this->setVars($vars);
		}
	}

	public function isValidUrl($url)
	{
		if (
			preg_match('`^'.$this->urlPattern().'(?:\\?[a-z0-9-&=]{3,})?$`', $url, $matches) &&
			(
				(int) count($this->varsNames()) >= (int) (count($matches)-1)
			)
		) {
			return true;
		}
		return false;
	}
}
