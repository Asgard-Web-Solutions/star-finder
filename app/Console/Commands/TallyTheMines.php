<?php

namespace App\Console\Commands;

use App\Base;
use App\Facility;
use App\FacilityType;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TallyTheMines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:mines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run through the mines that exist and give the resources to the characters.';

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

        // Get facilities that are mines
        $facilityTypes = FacilityType::where('type', '=', 'mine')->get();

        foreach ($facilityTypes as $facilityType) {

            // Get all facilities that are this kind of mine
            $facilities = Facility::where('facility_type_id', '=', $facilityType->id)
                ->where('status', '=', 'completed')
                ->where('full', '=', 0)
                ->get();

            $mining = "nothing";

            if ($facilityType->name == "Titanium Mine") {
                $mining = "ore";
            }

            if ($facilityType->name == "Gas Mine") {
                $mining = "gas";
            }

            foreach ($facilities as $facility) {
                // Get the base that this facility belongs to
                $base = Base::find($facility->base_id);

                if ($mining == "ore") {
                    // Planetary Bonus will need to be pulled from the planet types table later
                    $planetaryBonus = 1;

                    // Figure out the mining speed PER HOUR
                    $miningSpeed = (config('formulas.mining_ore_multiplier') * $facility->level) + config('formulas.minint_ore_addition') * $planetaryBonus;

                    // Make sure the storage isn't full
                    $maxStorage = ($base->level ** (config('formulas.exponent_storage_ore') + $base->bonus)) + config('formulas.base_storage_ore');
                    $currentStorage = $base->ore;
                }

                if ($mining == "gas") {
                    // Planetary Bonus will need to be pulled from the planet types table later
                    $planetaryBonus = .5;

                    // Figure out the mining speed PER HOUR
                    $miningSpeed = (config('formulas.mining_gas_multiplier') * $facility->level) + config('formulas.minint_gas_addition') * $planetaryBonus;

                    // Make sure the storage isn't full
                    $maxStorage = ($base->level ** (config('formulas.exponent_storage_gas') + $base->bonus)) + config('formulas.base_storage_gas');
                    $currentStorage = $base->gas;
                }


                // Convert the PER HOUR to PER SECOND
                $resourcesPerSecond = $miningSpeed / 60 / 60;

                // How long has it been since this mine was last mined?
                $secondsMined = $now->diffInSeconds($facility->mined_at);

                $mineralsMined = $resourcesPerSecond * $secondsMined;

                $currentStorage = round($currentStorage + $mineralsMined);
                if ($currentStorage > $maxStorage) {
                    $currentStorage = $maxStorage;
                }

                // Save changes
                if ($mining == "ore") {
                    $base->ore = $currentStorage;
                }

                if ($mining == "gas") {
                    $base->gas = $currentStorage;
                }

                $base->save();

                $facility->mined_at = $now;
                $facility->save();
            }
        }
    }
}
