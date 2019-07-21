<?php

namespace MineSweeper;

use Symfony\Component\Console\Helper\Table;
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
        $this->table->setRows($this->board->getTable());
        return $this->table;
    }

}