<?php

declare(strict_types=1);

namespace App\Forms;

interface SignInFormFactory
{

	/**
	 * @return SignInForm
	 */
	public function create();
}

class SignInForm extends BaseFormComponent
{

	public function render()
	{
		$this->template->setFile(__DIR__ . '/signInForm.latte');
		$this->template->render();
	}

	public function createComponentForm()
	{
		$form = $this->createForm();

		$form->addText('username', 'Uživatelské jméno')
			->setRequired();

		$form->addPassword('password', 'Heslo:')
			->setRequired();

		$form->addSubmit('submit', 'Přihlásit se');

		return $form;
	}

	public function processForm($form, $values)
	{
		$this->onSave($values);
	}
}
