<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette\Application\LinkGenerator;
use App\Model\Service\ProductService;
use App\Model\Service\InventoryItemService;
use App\Service\MerchantService;

// sem nikdy nepatří HTML, JS, CSS, jinak půjdeš do programátorského vězení
final class HomepagePresenter extends BasePresenter
{

	/** @var ProductService @inject */
	public $productService;

	/** @var MerchantService @inject */
	public $merchantService;

	/** @var InventoryItemService @inject */
	public $inventoryItemService;

	/** @var LinkGenerator @inject */
	public $linkGenerator;

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
					if ($inventory->product->namePrivate == $product->namePrivate) {
						$product->count = $inventory->count;
					}
				}
			}
		}

		$this->template->products  = $products;
	}

	public function actionBuy()
	{
		$response = $this->merchantService->buyItemBySlug('grandmother', $this->userAccount);
		dump($response);
		exit;
	}

	public function beforeRender()
	{
		parent::beforeRender();
		$this->template->links = [
			'increaseMoney' => $this->linkGenerator->link('Api:SaveClicks'),
		];
	}
}
