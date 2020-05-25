<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Entity\UserAccount;
use App\Model\Service\InventoryItemService;
use App\Model\Service\ProductService;
use App\Model\Service\UserAccountService;

class MerchantService
{

    /** InventoryItemService @inject */
    public $inventoryItemService;

    /** UserAccountService @inject */
    public $userAccountService;

    /** ProductService @inject */
    public $productService;

    public function __construct(
        InventoryItemService $inventoryItemService,
        UserAccountService $userAccountService,
        ProductService $productService
    ) {
        $this->inventoryItemService = $inventoryItemService;
        $this->userAccountService = $userAccountService;
        $this->productService = $productService;
    }

    public function buyItemBySlug($slug, UserAccount $userAccount)
    {
        $product = $this->productService->findOneBy(['namePrivate' => $slug]);
        $productBought = $userAccount->getInventoryItemBySlug($slug);

        if (!$productBought) {
            // nakupuje to poprvé
            
        } else {

        }
        exit;
    }
}
