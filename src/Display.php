<?php

namespace MineSweeper;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Output\OutputInterface;

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
     * @param $output
     * @return Table
     */
    public function table(OutputInterface $output)
    {
        $this->table = new Table($output);
        $cell = $this->board->getCell();
        $columns = range(1, $this->board->getCell());
        $this->table->addRow($columns);
        $tableRows = $this->board->getTable();
        foreach ($tableRows as $r => $row) {
            $cellValue = [];
            foreach ($row as $cell) {
                $cellValue[] = $cell->displayValue();
            }
            $this->table->addRow(new TableSeparator())->addRow($cellValue);
        }
        return $this->table;
    }

}