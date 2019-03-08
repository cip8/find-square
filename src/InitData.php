<?php

namespace MaxSquare;

class InitData
{
    private $rows;
    
    private $cols;

    public function __construct($rows, $cols)
    {
        $this->rows = $rows;
        $this->cols = $cols;
    }

    /**
     * @param none
     * @return array
     */
    public function store() : array
    {
        $data = [];

        for ($r = 0; $r < $this->rows; $r++) {
            $string = '';
            for ($c = 0; $c < $this->cols; $c++) {
                $string .= mt_rand(0, 1);
            }
            $data[$r] = $string;
        }

        return $data;
    }

    /**
     * Generators help better use system memory as computed values are provided during each iteration.
     *
     * @param none
     * @return Generator
     */
    public function generate() : \Generator
    {
        for ($r = 0; $r < $this->rows; $r++) {
            $string = '';
            for ($c = 0; $c < $this->cols; $c++) {
                $string .= mt_rand(0, 1);
            }
            yield $string;
        }
    }
}
