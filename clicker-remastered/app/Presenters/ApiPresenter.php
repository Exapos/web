<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Service\ProductService;
use App\Model\Service\InventoryItemService;
use App\Model\Service\UserAccountService;

final class ApiPresenter extends BasePresenter
{

	/** @var ProductService @inject */
	public $productService;

	/** @var UserAccountService @inject */
	public $userAccountService;

	/** @var InventoryItemService @inject */
	public $inventoryItemService;

	/** @var UserAccount */
	private $userAccount;

	public function startup()
	{
		parent::startup();
		if (!$this->user->isLoggedIn()) {
			$this->sendJson(['error' => 'You are not logged in']);
		}
		$this->userAccount = $this->userAccountService->find($this->user->getId());
	}

	public function actionSaveClicks($amount)
	{
		$this->userAccount->addMoney($amount);
		$this->userAccountService->save($this->userAccount);
		$this->sendJson(['response' => 'ok']);
	}
}
