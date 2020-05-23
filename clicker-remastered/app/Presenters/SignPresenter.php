<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms\SignInFormFactory;
use App\Forms\SignUpFormFactory;
use App\Model\Entity\UserAccount;
use App\Model\Service\UserService;
use Nette\Security\AuthenticationException;

final class SignPresenter extends BasePresenter
{

	/** @persistent */
	public $backlink = '';

	/** @var SignUpFormFactory @inject */
	public $signUpFactory;

	/** @var SignInFormFactory @inject */
	public $signInFactory;

	/** @var UserService @inject */
	public $userService;

	protected function createComponentSignUpForm()
	{
		$form = $this->signUpFactory->create();

		$form->onSave[] = function ($form, $values) {
			$userAccount = new UserAccount();
			$userAccount->username = $values->username;
			$userAccount->email = $values->email;
			$userAccount->password = sha1($values->password);

			$this->getUser()->login($userAccount->username, $values->password);
			$this->redirect('Homepage:');
		};

		return $form;
	}

	protected function createComponentSignInForm()
	{
		$form =  $this->signInFactory->create();

		$form->onSave[] = function ($form, $values) {
			try {
				$this->getUser()->login($values->username, $values->password);
				$this->redirect('Homepage:');
			} catch (AuthenticationException $e) {
				dump($e);
				exit;
				$form->addError('Nesprávné přihlašovací jméno nebo heslo.');
			}
		};

		return $form;
	}

	public function actionOut(): void
	{
		$this->getUser()->logout();
	}
}
