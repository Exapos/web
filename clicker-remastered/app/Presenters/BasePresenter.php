<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Model\Entity\UserAccount;
use App\Model\Service\UserAccountService;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

    /** @persistent */
    public $locale;

    /** @var \Kdyby\Translation\Translator @inject */
    public $translator;

    /** @var UserAccountService @inject */
    public $userAccountService;

    /** @var UserAccount */
    public $userAccount = null;

    public function startup()
    {
        parent::startup();
        if ($this->user->isLoggedIn()) {
            $this->userAccount = $this->userAccountService->find($this->user->getId());
        }
    }

    public function beforeRender()
    {
        parent::beforeRender();
        $this->template->userAccount = $this->userAccount;
    }
}
