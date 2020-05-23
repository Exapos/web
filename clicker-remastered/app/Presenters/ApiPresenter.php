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

	/** @var InventoryItemService @inject */
	public $inventoryItemService;

	public function startup()
	{
		parent::startup();
		if (!$this->user->isLoggedIn()) {
			$this->sendJson(['error' => 'You are not logged in']);
		}
	}

	public function actionSaveClicks()
	{
		$amount = 5;
		$this->userAccount->addMoney($amount);
		$this->userAccountService->save($this->userAccount);
		$this->sendJson(['response' => 'ok']);
	}
}
