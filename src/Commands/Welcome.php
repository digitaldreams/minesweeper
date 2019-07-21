<?php


namespace MineSweeper\Console;


use MineSweeper\Board;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use MineSweeper\MineSweeper;

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
        $mineSweeper = new MineSweeper();
        //   $input->getArgument('row');
        //   $input->getArgument('cell');
        $board = new Board(5, 5,3);
         $board->generate()->display($output)->render();
    }
}