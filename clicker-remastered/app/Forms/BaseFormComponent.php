<?php

declare(strict_types=1);

namespace App\Forms;

use Nette\Utils\ArrayHash;
use Nette\Application\UI as UI;
use EveryBit\Forms\ExtendedForm;
use Kdyby\Translation\Translator;
use Nette\Bridges\ApplicationLatte\Template;

/**
 * Class BaseFormComponent
 * @package BaseModule\Components\Forms
 *
 * @property callable[] $onSave
 * @method onSave(ExtendedForm $form, ArrayHash $values) Occurs form succesfully processes inserted values
 * @method onValidate(ExtendedForm $form, ArrayHash $values) Occurs when form validates values
 * @property-read       Template $template
 */
abstract class BaseFormComponent extends UI\Control
{
    public $onSave = [];

    public $onValidate = [];

    /** @var FormFactory */
    protected $factory;

    /** @var Translator */
    private $translator;

    public function __construct(FormFactory $factory)
    {
        // parent::__construct();
        $this->factory = $factory;
        // $this->translator = $translator;
    }

    /**
     * @return ExtendedForm
     */
    public abstract function createComponentForm();

    protected function createForm()
    {
        $form = $this->factory->create();

        // $form->setTranslator($this->translator);

        $form->onValidate[] = [$this, 'validateForm'];

        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }

    abstract function processForm($form, $values);

    public function validateForm($form, $values)
    {
        $this->onValidate($form, $values);
    }

    /** @return ExtendedForm */
    protected function form()
    {
        return $this['form'];
    }
}
