<?php

declare(strict_types=1);


namespace App\AdventOfCode;


use App\Service\AdventOfCode;
use App\Service\FileFinder;

class Day1 implements AdventOfCode
{

    private array $values;

    public function __construct(FileFinder $fileFinder)
    {
        $this->values = $fileFinder->find('day1.txt');
    }

    final public function partOne(): int
    {
        foreach ($this->values as $i) {
            foreach ($this->values as $j) {
                $sum = $i + $j;
                if ($sum === 2020) {
                    return $i * $j;
                }
            }
        }
    }

    final public function partTwo(): int
    {
        foreach ($this->values as $i) {
            foreach ($this->values as $j) {
                foreach ($this->values as $k) {
                    $sum = $i + $j + $k;
                    if ($sum === 2020) {
                        return $i * $j * $k;
                    }
                }
            }
        }
    }
}
