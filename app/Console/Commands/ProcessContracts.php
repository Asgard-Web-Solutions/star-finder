<?php

namespace App\Console\Commands;

use App\Base;
use App\Character;
use App\Contract;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessContracts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:contracts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all player contracts that are waiting to be serviced.';

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
        $now = new Carbon();
        
        $contracts = Contract::where('status', '=', 'active')
            ->where('next_at', '<=', $now)
            ->get();

        foreach ($contracts as $contract) {
            $character = Character::find($contract->base->character_id);

            if ($contract->action == "sell") {
                $base = Base::find($contract->base_id);

                if ($contract->resource == "ore") {
                    $selling = floor($base->ore * ($contract->amount / 100));

                    $base->ore = $base->ore - $selling;
                }

                if ($contract->resource == "gas") {
                    $selling = floor($base->gas * ($contract->amount / 100));

                    $base->gas = $base->gas - $selling;
                }

                $character->money = $character->money + ($contract->price * $selling);
                $character->save();
                $base->save();

                // See if we need to turn mining back on at any of the facilities
                $max['ore'] = calculateMaxStorage($base->level, $base->bonus, 'ore');
                $max['gas'] = calculateMaxStorage($base->level, $base->bonus, 'gas');
                $current['ore'] = $base->ore;
                $current['gas'] = $base->gas;

                foreach ($base->facilities as $facility) {
                    if ($facility->full && $facility->facility_type->type == "mine") {
                        $resource = $facility->facility_type->material;
                        
                        if ($current[$resource] < $max[$resource]) {
                            $facility->full = 0;
                            $facility->mined_at = $now;
                            $facility->save();
                        }

                    }
                }
            }

            $next = $now;
            $contract->next_at = $next->addSeconds($contract->frequency);

            if ($contract->getOriginal('expires_at') < $now) {
                $contract->status = "expired";
            }

            $contract->save();
        }
    }
}
