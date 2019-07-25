<?php

namespace MineSweeper;

class Board
{
    public static $isOver = false;
    public static $started = false;

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

    public function isOver()
    {
        return static::$isOver;
    }

    public function end()
    {
        $this->isOver = true;
        return $this;
    }

    public function start()
    {
        $this->started = true;
    }

    public function isStarted()
    {
        return static::$started;
    }

    /**
     * Generate Random Mines
     * @param int $total
     * @return array
     */
    protected function makeMines($total = 25)
    {
        $mines = [];
        while (count($mines) < $total) {
            $max = $this->row * $this->cell;
            $number = rand(1, $max);
            if (!in_array($number, $mines)) {
                $mines[] = $number;
            }
        }
        return $this->mines = $mines;
    }

    /**
     * Build the Board. Each Cell is a object of Cell Class
     * @return $this
     */
    public function generate()
    {
        $mines = $this->makeMines($this->totalMines);
        $i = 0;
        for ($r = 1; $r <= $this->row; $r++) {

            for ($c = 1; $c <= $this->cell; $c++) {
                $i++;
                $cellObj = new Cell($r - 1, $c - 1, $i);
                if (in_array($i, $mines) !== false) {
                    $cellObj->setMine(5);
                }
                $this->table[$r - 1][$c - 1] = $cellObj;

            }
        }
        $this->setCellNumber();
        return $this;
    }

    /**
     * Generate Cell number like 1,2 That means associate mines Related to this field.
     * If a cell contains a mine then it will have "X" instead of numberic number
     */
    public function setCellNumber()
    {
        for ($k = 0; $k < count($this->table); $k++) {
            $row = $this->table[$k];
            for ($c = 0; $c < count($row); $c++) {
                $cell = $row[$c];
                if ($cell->isMine()) {
                    $leftRow = $k > 0 ? $k - 1 : false;
                    $rightRow = $k + 1 < $this->cell ? $k + 1 : false;
                    if ($leftRow !== false) {
                        $leftRowCellTop = $c > 0 ? $c - 1 : false;
                        if ($leftRowCellTop !== false) {
                            $leftTopCell = $this->table[$leftRow][$leftRowCellTop];
                            $leftTopCell->incrementNumber();
                        }
                        $leftMiddleCell = $this->table[$leftRow][$c];
                        $leftMiddleCell->incrementNumber();

                        $leftRowCellBottom = $c + 1 < $this->cell ? $c + 1 : false;
                        if ($leftRowCellBottom !== false) {
                            $leftBottomCell = $this->table[$leftRow][$leftRowCellBottom];
                            $leftBottomCell->incrementNumber();
                        }
                    }
                    if ($rightRow !== false) {

                        $rightRowCellTop = $c > 0 ? $c - 1 : false;
                        if ($rightRowCellTop !== false) {
                            $rightTopCell = $this->table[$rightRow][$rightRowCellTop];
                            $rightTopCell->incrementNumber();
                        }
                        $rightMiddleCell = $this->table[$rightRow][$c];
                        $rightMiddleCell->incrementNumber();
                        $rightRowCellBottom = $c + 1 < $this->cell ? $c + 1 : false;
                        if ($rightRowCellBottom !== false) {
                            $rightBottomCell = $this->table[$rightRow][$rightRowCellBottom];
                            $rightBottomCell->incrementNumber();
                        }

                    }
                    $sameRowLeft = $c > 0 ? $c - 1 : false;
                    if ($sameRowLeft !== false) {
                        $sameLeftCell = $this->table[$k][$sameRowLeft];
                        $sameLeftCell->incrementNumber();
                    }
                    $sameRowRight = $c + 1 < $this->cell ? $c + 1 : false;
                    if ($sameRowRight !== false) {
                        $sameRightCell = $this->table[$k][$sameRowRight];
                        $sameRightCell->incrementNumber();
                    }
                }
            }

        }
    }

    /**
     * Display Actual board to the console
     * @param $output
     * @return \Symfony\Component\Console\Helper\Table
     */
    public function display($output)
    {
        return (new Display($this))->table($output);
    }

    /**
     * Hit a cell by Row and Value.
     * @param $row
     * @param $cell
     * @return bool
     * @throws \Exception
     */
    public function check($row, $cell)
    {
        if (isset($this->table[$row][$cell])) {
            $cellObj = $this->table[$row][$cell];
            print_r($cellObj);
            if ($cellObj->isMine()) {
                Board::$isOver = true;
                return false;
            } else {
                $cellObj->show();
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function getTable()
    {
        return $this->table;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function getCell()
    {
        return $this->cell;
    }


}