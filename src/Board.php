<?php

namespace MineSweeper;

class Board
{
    protected $row;
    protected $cell;
    protected $table = [];
    protected $mines = [];
    protected $totalMines = 25;


    /**
     * Board constructor.
     * @param $row
     * @param $cell
     * @param int $totalMines
     */
    public function __construct($row, $cell, $totalMines = 25)
    {
        $this->row = $row;
        $this->cell = $cell;
        $this->totalMines = $totalMines;
    }

    /**
     * @param int $total
     * @return array
     */
    protected function makeMines($total = 25)
    {
        $mines = [];
        while (count($mines) < $total) {
            $max = $this->row * $this->cell;
            $number = rand(0, $max);
            if (!in_array($number, $mines)) {
                $mines[] = $number;
            }
        }
        return $this->mines = $mines;
    }

    /**
     * @return $this
     */
    public function generate()
    {
        $mines = $this->makeMines();
        $i = 0;
        for ($r = 0; $r < $this->row; $r++) {
            for ($c = 0; $c < $this->cell; $c++) {
                $position = $r * $c;
                $cellObj = new Cell($r, $c, $position);
                if (in_array($position, $mines)) {
                    $cellObj->setMine(array_search($position, $mines));
                }
                $this->table[$r][$c] = $cellObj;
                $i++;
            }
            $i++;
        }
        return $this;
    }

    public function display($output)
    {
        return (new Display($this))->table($output);
    }

    /**
     * @param $row
     * @param $cell
     * @throws \Exception
     */
    public function check($row, $cell)
    {
        if (isset($this->table[$row][$cell])) {
            $cellObj = $this->table[$row][$cell];
            if ($cellObj->isMine()) {
                $this->isOver = true;
            } else {
                $cellObj->show();
            }
        } else {
            throw new \Exception('Invalid Row and Cell Given');
        }
    }

    /**
     * @return array
     */
    public function getTable()
    {
        return $this->table;
    }


}