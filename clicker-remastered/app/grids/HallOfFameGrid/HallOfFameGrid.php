<?php

declare(strict_types=1);

namespace App\Grids;

use Dibi\Fluent;
use Nette\Utils\Html;
use App\Grids\BaseGrid;
use App\Model\Entity\Order;
use Ublaboo\DataGrid\Exception\DataGridException;

interface HallOfFameGridFactory
{

    /**
     * @param $dataSource
     * @return HallOfFameGrid
     */
    public function create($dataSource);
}

class HallOfFameGrid extends BaseGrid
{

    private $dataSource;

    public function __construct(
        $dataSource
    ) {
        parent::__construct();
        $this->dataSource = $dataSource;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/hallOfFameGrid.latte');
        $this->template->render();
    }

    protected function createComponentGrid($name)
    {
        $grid = $this->createGrid($this, $name);

        $grid->addColumnText('username', 'username');
        
        $grid->addColumnText('money', 'money');
        
        $grid->setDataSource($this->dataSource);

        return $grid;
    }

}
