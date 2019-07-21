<?php

namespace MineSweeper;

class Board
{
    private $row;
    private $cell;
    protected $table = [];

    /**
     * Board constructor.
     * @param $row
     * @param $cell
     */
    public function __construct($row, $cell)
    {
        $this->row = $row;
        $this->cell = $cell;
    }

    /**
     * @return $this
     */
    public function generate()
    {
        for ($r = 0; $r < $this->row; $r++) {
            for ($c = 0; $c < $this->cell; $c++) {
                $this->table[$r][$c] = new Cell($r, $c);
            }
        }
        return $this;
    }

    public function display($output)
    {
        return (new Display($this))->table($output);
    }

    public function reset()
    {

    }

    public function check($row, $cell)
    {

    }

    /**
     * @return array
     */
    public function getTable()
    {
        return $this->table;
    }

}