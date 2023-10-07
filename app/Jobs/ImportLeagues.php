<?php

namespace App\Jobs;

use App\Models\League;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\HttpServices;
use Illuminate\Support\Facades\Log;

class ImportLeagues implements ShouldQueue
{
    use HttpServices;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $leagueU;
    protected $sport_id;
    /**
     * Create a new job instance.
     */
    public function __construct($leagueU, $sport_id)
    {
        $this->leagueU = $leagueU;
        $this->sport_id = $sport_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        try {
            League::create([
                "id" => $this->leagueU["id"],
                "sport_id" => $this->sport_id,
                "guid" => $this->leagueU["guid"] ?? null,
                "uid" => $this->leagueU["uid"],
                "name" => $this->leagueU["name"],
                "shortName" => $this->leagueU["shortName"],
                "midsizeName" => $this->leagueU["midsizeName"],
                "slug" => $this->leagueU["slug"],
                "abbreviation" => $this->leagueU["abbreviation"],
                "isTournament" => $this->leagueU["isTournament"],
            ]);
        } catch (\Throwable $th) {
            Log::notice($th);
        }
    }
}
