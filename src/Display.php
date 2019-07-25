<?php

namespace MineSweeper;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableCell;

/**
 * Class Display
 * @package MineSweeper
 */
class Display
{
    /**
     * @var Board
     */
    protected $board;

    protected $table;

    /**
     * Display constructor.
     * @param Board $board
     */
    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    /**
     * Show Rows and Columns to the console
     * @param $output
     * @return Table
     */
    public function table(OutputInterface $output)
    {
        $this->table = new Table($output);
        $cell = $this->board->getCell();
        $columns = range(1, $this->board->getCell());
        array_unshift($columns, new TableCell(' ', ['colspan' => 2]));
        $this->table->setHeaders($columns);
        $tableRows = $this->board->getTable();
        foreach ($tableRows as $r => $row) {
            $cellValue = [new TableCell($r + 1, ['colspan' => 2])];
            foreach ($row as $cell) {
                $cellValue[] = $cell->displayValue();
            }
            $this->table->addRow(new TableSeparator())->addRow($cellValue);
        }
        return $this->table;
    }

}