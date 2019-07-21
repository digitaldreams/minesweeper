<?php

namespace MineSweeper;

class MineSweeper
{
    public static $isOver = false;
    public static $started = false;

    public static $discoveredMine = [];
    public static $mineLeft = [];
    public static $startedAt = '';

    public function __construct()
    {
        static::$startedAt = microtime();
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
}