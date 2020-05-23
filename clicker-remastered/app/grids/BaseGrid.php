<?php

declare(strict_types=1);

namespace App\Grids;

use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Localization\SimpleTranslator;

abstract class BaseGrid extends \Nette\Application\UI\Control
{

    private $grid;
    /**
     * @param UblabooGrid $parent
     * @param $name
     * @return DataGrid
     */
    protected function createGrid($parent, $name)
    {
        $grid = new DataGrid();

        $this->addComponent($grid, $name);

        $grid->setTranslator(new SimpleTranslator());

        $this->grid = $grid;

        return $grid;
    }
}
