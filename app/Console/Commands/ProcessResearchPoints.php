<?php

namespace App\Console\Commands;

use App\Character;
use Illuminate\Console\Command;

class ProcessResearchPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:research';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give research points to users based on how many bases they have.';

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
        $characters = Character::all();

        foreach ($characters as $character)
        {
            $base_load = 0;

            foreach ($character->bases as $base) {
                $base_load = $base_load + $base->level;
            }

            $newPoints = ((config('game.daily_research_points') + ($base_load / 10)) / 48); // 24 
            $character->research_points = $character->research_points + $newPoints;

            $character->save();

            echo "Adding " . $newPoints;
        }
    }
}
