<?php

declare(strict_types=1);


namespace App\Commands;


use App\AdventOfCode\Day1;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;


class AdventOfCode extends Command
{
    protected static $defaultName = 'advent-of-code';
    private Day1 $day1;
    private int $result;

    public function __construct(Day1 $dayOne)
    {
        $this->day1 = $dayOne;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Advent of Code 2020');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $dayQuestion = new ChoiceQuestion(
            'Chose the day...',
            [
                'Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7', 'Day 8', 'Day 9', 'Day 10',
                'Day 11', 'Day 12', 'Day 13', 'Day 14', 'Day 15', 'Day 16', 'Day 17', 'Day 18', 'Day 19', 'Day 20',
                'Day 21', 'Day 22', 'Day 23', 'Day 24', 'Day 25'
            ],
            0
        );
        $dayQuestion->setErrorMessage('The day is invalid');

        $partQuestion = new ChoiceQuestion(
            'Part one or two?',
            ['Part One', 'Part Two'],
            0
        );
        $partQuestion->setErrorMessage('This part is invalid');


        $day = $helper->ask($input, $output, $dayQuestion);
        $part = $helper->ask($input, $output, $partQuestion);

        if ($day === "Day 1") {
            switch ($part) {
                case "Part One":
                    $this->result = $this->day1->partOne();
                    break;
                case "Part Two":
                    $this->result = $this->day1->partTwo();
                    break;
            }
        }else{
            $output->writeln('You have selected <fg=yellow;options=bold>' . $day . '</> and <fg=yellow;options=bold>' . $part . '</> but isn\'t ready yet!');
            return Command::FAILURE;
        }

        $output->writeln('You have selected <fg=yellow;options=bold>' . $day . '</> and <fg=yellow;options=bold>' . $part . '</> and the result is: <fg=green>' . $this->result . '</>');
        return Command::SUCCESS;

    }
}
