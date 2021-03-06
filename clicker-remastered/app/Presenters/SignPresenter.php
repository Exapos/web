<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms\SignInFormFactory;
use App\Forms\SignUpFormFactory;
use App\Model\Entity\UserAccount;
use App\Model\Service\UserAccountService;
use Nette\Security\AuthenticationException;

final class SignPresenter extends BasePresenter
{

	/** @persistent */
	public $backlink = '';

	/** @var SignUpFormFactory @inject */
	public $signUpFactory;

	/** @var SignInFormFactory @inject */
	public $signInFactory;

	/** @var UserAccountService @inject */
	public $userAccountService;

	protected function createComponentSignUpForm()
	{
		$form = $this->signUpFactory->create();

		$form->onSave[] = function ($form, $values) {
			if ($this->userAccountService->findOneBy(['username' => $values->username])) {
				$this->flashMessage($this->translator->translate('accountWithThisNameAlreadyExists'));
				$this->redirect('this');
			}
			if ($this->userAccountService->findOneBy(['email' => $values->email])) {
				$this->flashMessage($this->translator->translate('accountWithThisEmailAlreadyExists'));
				$this->redirect('this');
			}
			$userAccount = new UserAccount();
			$userAccount->username = $values->username;
			$userAccount->email = $values->email;
			$userAccount->password = sha1($values->password);
			$userAccount->cookie = $this->getHttpRequest()->getCookies()['PHPSESSID'];
			$userAccount->money = 0;

			$this->userAccountService->save($userAccount);
			$this->getUser()->login($userAccount->username, $values->password);
			$this->redirect('Homepage:');
		};

		return $form;
	}

	protected function createComponentSignInForm()
	{
		$form = $this->signInFactory->create();

		$form->onSave[] = function ($form, $values) {
			try {
				$this->getUser()->login($values->username, $values->password);
				$userAccount  = $this->userAccountService->find($this->getUser()->getId());
				$userAccount->cookie = $this->getHttpRequest()->getCookies()['PHPSESSID'];
				$this->userAccountService->save($userAccount);
				$this->redirect('Homepage:');
			} catch (AuthenticationException $e) {
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
