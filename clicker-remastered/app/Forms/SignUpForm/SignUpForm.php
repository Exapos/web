<?php

declare(strict_types=1);

namespace App\Forms;

use Nette\Forms\Form;


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
			->addRule(Form::MIN_LENGTH, 'Jméno musí mít alespoň %d znaků', 5)
			->setRequired();

		$form->addEmail('email', 'E-mail:')
			->setRequired();

		$form->addPassword('password', 'Heslo:')
			->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 6)
			->setRequired();

		$form->addPassword('passwordVerify', 'Heslo znovu:')
			->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu')
			->addRule(Form::EQUAL, 'Hesla se neshodují', $form['password']);

		$form->addSubmit('submit', 'Registrovat se');

		return $form;
	}

	// public function onValidate($form, $value)
	// {
	// 	dump($form->getErrors());
	// 	exit;
	// }

	public function processForm($form, $values)
	{
		$this->onSave($form, $values);
	}
}
