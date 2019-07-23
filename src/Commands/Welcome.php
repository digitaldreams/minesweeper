<?php


namespace MineSweeper\Console;


use MineSweeper\Board;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use MineSweeper\MineSweeper;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Author: Chidume Nnamdi <kurtwanger40@gmail.com>
 */
class Welcome extends Command
{

    public function configure()
    {
        $this->setName('welcome')
            ->setDescription('Welcome Screen')
            ->setHelp('This command allows you to Start the Game');
        //   ->addArgument('row', InputArgument::REQUIRED, 'Row Number')
        //   ->addArgument('cell', InputArgument::REQUIRED, 'Cell Number');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->progressStart(3);

        $mineSweeper = new MineSweeper();
        MineSweeper::$started = true;
        //   $input->getArgument('row');
        //   $input->getArgument('cell');
        $board = new Board(5, 5, 3);
        $board->generate()->display($output)->render();
        while (!MineSweeper::$isOver) {
            $io->ask('Type a Row and Cell Number e.g 5,10', 1, function ($number) use ($io, $board, $output) {
                $numbers = explode(",", $number);
                $row = isset($numbers[0]) ? (int)$numbers[0] : false;
                $cell = isset($numbers[1]) ? (int)$numbers[1] : false;

                if ($row !== false && $cell !== false) {
                    $bool = $board->check($row - 1, $cell - 1);
                    if ($bool) {
                        $io->progressAdvance(1);
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