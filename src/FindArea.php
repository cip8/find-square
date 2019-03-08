<?php

namespace MaxSquare;

class FindArea
{
    /* Holds the square length */
    private $length = 0;

    public function __construct(iterable $input)
    {
        $this->compute($input);
    }

    /**
     * Computes & returns the square area (X^2)
     *
     * @param none
     * @return int Area of the biggest square
     */
    public function get() : int
    {
        return pow($this->length, 2);
    }

    /**
     * Displays execution times (script stats)
     *
     * @param array $times Stat times
     * @return string Execution stats in human-readable format
     */
    public function stats(array $times) : string
    {
        /* In case we send multiple times / laps, we destructure the array here */
        [$start, $end] = $times;
        $time = number_format(($end - $start), 3);
        $stats = "Execution took $time s.".PHP_EOL.
                 "Memory usage: ".(memory_get_peak_usage(true)/1024/1024)." MB".PHP_EOL;

        return $stats;
    }
 
    /**
     * Computes the maximal square lenght
     *
     * [! INFO] Please refer to the README gif animation for a visual representation of this process.
     *
     * We imagine a 2x2 square, which will be used to iterate through a helper array.
     *
     * This helper array stores computed values that indicate what is the maximum square lenght that can be formed when a certain line is iterated.
     *
     * As we iterate forward, we'll need the bottom-right corner to store the max square value. This value can be computed by taking the minimum value of its neighbours and adding itself to the sum.
     *
     * If this value is bigger than what we have stored as the max square lenght, we update the value.
     *
     * Before moving to the next interation, we copy the second helper array into the first one.
     * The second array will have its data overwritten by newer computations.
     *
     * @param iterable
     * @return void
     */
    private function compute(iterable $input) : void
    {
        /**
         * Will hold 2 arrays
         */
        $store = [];

        /* The foreach loop is faster than both the while() & for() procedures. */
        foreach ($input as $key => $row) {
            $row = array_map('intval', str_split($row));

            /* First row gets copied as it has no previous neighbours for a 2x2 square. */
            if ($key === 0) {
                $store[0] = $row;
                continue;
            }

            /* Get inside the row and compute cell 'square-ability' indexes */
            foreach ($row as $cellId => $cellValue) {

                /* The first cell is also copied as a square bigger than 1 can't be formed with it alone. */
                if ($cellId === 0) {
                    $store[1][0] = $cellValue;
                    continue;
                }

                /* We check if the value is one in order to avoid unnecessary min computations */
                if ($cellValue === 1) {
                    /* The bottom-right corner value depends on the other three cells in a 2x2 square. */
                    $store[1][$cellId] = min(
                        $store[0][$cellId-1],
                        $store[0][$cellId],
                        $store[1][$cellId-1]
                    ) + 1;
                } else {
                    $store[1][$cellId] = 0;
                }

                /**
                 * The bottom-right corner tells us the biggest square that can be formed with the data we currently processed. If this value is bigger than what we have, we save it.
                 */
                if ($store[1][$cellId] > $this->length) {
                    $this->length = $store[1][$cellId];
                }
            }

            /* Reuse the 2nd array to save memory */
            $store[0] = $store[1];
        }
    }
}
