<?php

declare(strict_types=1);

namespace App\Forms;

interface SignUpFormFactory
{

	/**
	 * @return SignUpForm
	 */
	public function create();
}

class SignUpForm extends BaseFormComponent
{

	public function render()
	{
		$this->template->setFile(__DIR__ . '/signUpForm.latte');
		$this->template->render();
	}

	public function createComponentForm()
	{
		$form = $this->createForm();

		$form->addText('username', 'Jméno')
			->setRequired();

		$form->addText('email', 'E-mail:')
			->setRequired();

		$form->addPassword('password', 'Heslo:')
			->setRequired();

		$form->addPassword('passwordVerify', 'Heslo znovu:')
			->setRequired();

		$form->addSubmit('submit', 'Přihlásit se');

		return $form;
	}

	public function processForm($form, $values)
	{
		$this->onSave($values);
	}
}
