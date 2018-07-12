<?php

if (!function_exists('SortRanking')) {

    /**
     * function for use with usort
     * sort a array based on three values (wins, index, given_hits)
     *
     * @param array $a
     * @param array $b
     * @return int
     */
    function SortRanking(array $a, array $b)
    {
        if ($a['wins'] < $b['wins']) {
            return 1;
        }
        if ($a['wins'] > $b['wins']) {
            return -1;
        }
        if ($a['wins'] == $b['wins']) {
            if ($a['index'] < $b['index']) {
                return 1;
            }
            if ($a['index'] > $b['index']) {
                return -1;
            }
            if ($a['index'] == $b['index']) {
                if ($a['given_hits'] < $b['given_hits']) {
                    return 1;
                }
                if ($a['given_hits'] > $b['given_hits']) {
                    return -1;
                }
                if ($a['given_hits'] == $b['given_hits']) {
                    return 0;
                }
            }
        }
    }
}
