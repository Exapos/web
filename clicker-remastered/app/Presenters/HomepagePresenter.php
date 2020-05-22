<?php

declare(strict_types=1);

namespace App\Presenters;

// sem nikdy nepatří HTML, JS, CSS

final class HomepagePresenter extends BasePresenter
{

	public function startup()
	{
		parent::startup();
		if (!$this->user->isLoggedIn()) {
			$this->redirect('Sign:in');
		}
	}

	public function actionDefault()
	{
		// hlavní URL
	}

	public function actionPonozka()
	{
	}
}
