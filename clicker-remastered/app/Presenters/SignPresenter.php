<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms\SignUpFormFactory;
use App\Forms\SignInFormFactory;

final class SignPresenter extends BasePresenter
{

	/** @persistent */
	public $backlink = '';

	/** @var SignUpFormFactory @inject */
	public $signUpFactory;

	/** @var SignInFormFactory @inject */
	public $signInFactory;

	protected function createComponentSignUpForm()
	{
		return $this->signUpFactory->create();
	}

	protected function createComponentSignInForm()
	{
		return $this->signInFactory->create();
	}

	public function actionOut(): void
	{
		$this->getUser()->logout();
	}
}
