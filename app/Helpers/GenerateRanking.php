<?php

use App\tournament;

if (!function_exists('GenerateRanking')) {

    /**
     * generates a ranking
     *
     * @param \App\tournament $tournament
     * @return array
     */
    function GenerateRanking(tournament $tournament)
    {
        $rank = [];
        foreach ($tournament->participants as $participant) {
            $rank[$participant->id] = ['id' => $participant->id, 'wins' => 0, 'assigned' => False, 'given_hits' => 0, 'recv_hits' => 0, 'index' => 0, 'participant' => $participant];
        }
        foreach ($tournament->combats as $combat) {
            $rank[$combat->participant1_id]['given_hits'] += $combat->hits1;
            $rank[$combat->participant2_id]['given_hits'] += $combat->hits2;

            $rank[$combat->participant1_id]['recv_hits'] += $combat->hits2;
            $rank[$combat->participant2_id]['recv_hits'] += $combat->hits1;

            $rank[$combat->participant1_id]['index'] += $combat->hits1 - $combat->hits2;
            $rank[$combat->participant2_id]['index'] += $combat->hits2 - $combat->hits1;

            if ($combat->hits1 > $combat->hits2) {
                $rank[$combat->participant1_id]['wins']++;
            } elseif ($combat->hits1 < $combat->hits2) {
                $rank[$combat->participant2_id]['wins']++;
            }
        }

        usort($rank, "SortRanking");
        return $rank;
    }
}
