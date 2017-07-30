<?php
namespace QFram;

use Controller;
use Router;

/**
* Auth Controller
*/
class Auth extends Controller
{
	protected function init()
	{
		$this->initPage();
		$this->initComponents([
			'home' => 'home',
			'sign-in-form' => 'sign-in-form',
		]);
	}

	public function show($value='')
	{
		# code...
	}

	public function signIn($value='')
	{
		# code...
	}

	public function signOut($value='')
	{
		# code...
	}

	public function signUp($value='')
	{
		# code...
	}
}
