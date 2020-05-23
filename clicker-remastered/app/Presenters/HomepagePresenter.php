<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Service\ProductService;
use App\Model\Service\InventoryItemService;

// sem nikdy nepatří HTML, JS, CSS

final class HomepagePresenter extends BasePresenter
{

	/** @var ProductService @inject */
	public $productService;

	/** @var InventoryItemService @inject */
	public $inventoryItemService;

	public function startup()
	{

		parent::startup();
		if (!$this->user->isLoggedIn()) {
			$this->redirect('Sign:in');
		}
	}

	public function actionDefault()
	{
		$products = $this->productService->findAll();
		$inventoryItems = $this->inventoryItemService->findBy(
			[
				'userAccount' => $this->user->getId()
			]
		);

		if ($inventoryItems) { // něco mám koupené
			foreach ($inventoryItems as $inventory) {
				foreach ($products as $product) {
					if($inventory->product->namePrivate == $product->namePrivate){
						$product->count = $inventory->count;
					}
				}
			}
		}

		$this->template->products  = $products;
	}

	public function actionPonozka()
	{
	}
}
