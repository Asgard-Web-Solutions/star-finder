<?php

namespace App\Http\Controllers;

use App\Action;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function makeAction($details)
    {
        $action = new Action();

        $action->character_id = $details['character'];
        $action->title = $details['title'];
        $action->type = $details['type'];
        $action->controller = $details['controller'];
        $action->target_id = $details['target'];

        $timeDisplay = $details['seconds'];
        $timeScale = "s";

        if ($timeDisplay > 60)
        {
            $timeDisplay = ($details['seconds'] / 60);
            $timeScale = "m";
        }

        if ($timeScale == "m" && $timeDisplay > 60)
        {
            $timeDisplay = ($details['seconds'] / 3600);
            $timeScale = "h";
        }

        if ($timeScale == "h" && $timeDisplay > 24) {
            $timeDisplay = ($details['seconds'] / 86400);
            $timeScale = "d";
        }

        $action->time = $timeDisplay . $timeScale;

        $theTime = Carbon::now();
        $theTime->addSeconds($details['seconds']);
        $action->finishes_at = $theTime;

        $action->save();

        return $action;
    }

    public function checkBaseMiningStatus($base)
    {
        $max['ore'] = calculateMaxStorage($base->level, $base->bonus, 'ore');
        $max['gas'] = calculateMaxStorage($base->level, $base->bonus, 'gas');

        $current['ore'] = $base->ore;
        $current['gas'] = $base->gas;

        $now = Carbon::now();

        foreach ($base->facilities as $facility) {
            if ($current[$facility->facility_type->material] < $max[$facility->facility_type->material]) {
                $facility->full = 0;
                $facility->mined_at = $now;
                $facility->save();
            } else {
                $facility->full = 1;
                $facility->save();
            }
        }
    }
}
