<?php

namespace App\Console\Commands;

use App\Action;
use App\Base;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actions:process';

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

                if ($action->type == "construction") {

                    $base = Base::find($action->target_id);
                    
                    $base->status = 'completed';
                    $base->save();

                    $action->delete();
                }
                
            }

        }
    }
}
