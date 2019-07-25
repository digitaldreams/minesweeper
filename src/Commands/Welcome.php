<?php


namespace MineSweeper\Console;


use MineSweeper\Board;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class Welcome extends Command
{

    public function configure()
    {
        $this->setName('welcome')
            ->setDescription('Welcome Screen')
            ->setHelp('This command allows you to Start the Game');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        Board::$started = true;

        $board = new Board(20, 30, 25);
        $board->generate()->display($output)->render();
        while (!Board::$isOver) {
            $io->ask('Type a Row and Cell Number e.g 5,10', 1, function ($number) use ($io, $board, $output) {
                $numbers = explode(",", $number);
                $row = isset($numbers[0]) ? (int)$numbers[0] : false;
                $cell = isset($numbers[1]) ? (int)$numbers[1] : false;

                if ($row !== false && $cell !== false) {
                    $bool = $board->check($row - 1, $cell - 1);
                    if ($bool) {

                        $board->display($output)->render();
                    } else {
                        $board->display($output)->render();
                        $io->caution('Game Over');
                    }
                } else {

                    $io->caution('Invalid Input given' . $number);
                }
            });
        }

    }
}