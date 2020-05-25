<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Grids\HallOfFameGridFactory;

final class HallOfFamePresenter extends BasePresenter
{

	/** @var HallOfFameGridFactory @inject */
	public $hallOfFameGridFactory;

	public function actionDefault()
	{
	}

	protected function createComponentHallOfFameGrid()
	{
		return $this->hallOfFameGridFactory->create(
			$this->userAccountService->getQueryBuilder()->orderBy('s.money', 'DESC')
		);
	}
	
}
