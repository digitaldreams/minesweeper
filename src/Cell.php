<?php


namespace MineSweeper;


class Cell
{
    /**
     *  Unique ID of the Cell
     * @var string
     */
    protected $uid = '';

    /**
     * Row Number
     * @var string
     */
    protected $row = '';

    /**
     * Cell Number
     * @var string
     */
    protected $cell = '';

    /**
     * @var Number of Neighbouring mine e.g. 2. If it contain mine then it will be "X"
     */
    protected $number = '_';

    /**
     * Whether or Not mine is kept in this cell?
     * @var bool
     */
    protected $mine = false;

    /**
     * Check Whether or Not this cell is still hidden or Visible
     * @var bool
     */
    protected $visibility = false;

    /**
     * Cell constructor.
     * @param $row
     * @param $cell
     */
    public function __construct($row, $cell, $uid = '')
    {
        $this->row = $row;
        $this->cell = $cell;
        $this->uid = $uid;
    }

    /**
     * @return bool
     */
    public function isMine()
    {
        return !empty($this->mine);
    }

    /**
     * @return  $this
     */
    public function setMine($id)
    {
        $this->mine = $id;
        $this->number = 'X';
        return $this;
    }

    /**
     *
     */
    public function show()
    {
        $this->visibility = true;
    }

    /**
     * @return $this
     */
    public function incrementNumber()
    {
        if (!$this->isMine()) {
            $this->number = is_int($this->number) ? $this->number + 1 : 1;
        }
        return $this;
    }

    /**
     * @return Number|string
     */
    public function displayValue()
    {
        return $this->visibility ? $this->number : '_';
    }


}