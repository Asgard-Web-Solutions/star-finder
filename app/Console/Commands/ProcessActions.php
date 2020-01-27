<?php

namespace App\Console\Commands;

use App\Base;
use App\Action;
use App\Facility;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:actions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Procerss all actions pending in the actions table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();
        $actions = Action::where('finishes_at', '<=', $now)->get();

        foreach ($actions as $action)
        {
            if ($action->controller == "base") {

                if ($action->type == "construction" || $action->type == "upgrade") {

                    $base = Base::find($action->target_id);
                    
                    $base->status = 'completed';
                    $base->level = $base->level + 1;
                    $base->save();

                    $action->delete();
                }                
            }

            if ($action->controller == "facility") {

                if ($action->type == "construction" || $action->type == "upgrade") {
                    $facility = Facility::find($action->target_id);

                    $facility->status = 'completed';
                    $facility->level = $facility->level + 1;
                    $facility->mined_at = $action->getOriginal('finishes_at');
                    $facility->save();

                    $action->delete();
                }
            }

        }
    }
}
