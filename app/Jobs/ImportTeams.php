<?php

namespace App\Jobs;

use App\Models\LeaguesTeams;
use App\Models\Team;
use App\Services\HttpServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportTeams implements ShouldQueue
{
    use HttpServices;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $url;
    protected $league_id;
    /**
     * Create a new job instance.
     */
    public function __construct($url, $league_id)
    {
        $this->url = $url;
        $this->league_id = $league_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $teams = $this->get($this->url . '&limit=100');

            for ($i = 0; $i < count($teams["items"]); $i++) {

                $team = $this->get($teams["items"][$i]['$ref']);
                $ids = Team::pluck("id");

                if (!$ids->contains($team["id"])) {
                    $dbTeamsDB = Team::create([
                        "id" => $team["id"],
                        "guid" => $team["guid"],
                        "uid" => $team["uid"],
                        "slug" => $team["slug"],
                        "location" => $team["location"],
                        "name" => $team["name"],
                        "nickname" => $team["nickname"] ?? null,
                        "abbreviation" => $team["abbreviation"] ?? null,
                        "displayName" => $team["displayName"],
                        "shortDisplayName" => $team["shortDisplayName"],
                        "isActive" => $team["isActive"],
                        "isAllStar" => $team["isAllStar"],
                    ]);
                }
                LeaguesTeams::create([
                    "league_id" => $this->league_id,
                    "team_id" => $dbTeamsDB->id,
                ]);
            }
        } catch (\Throwable $th) {
            Log::notice($th);
        }
    }
}
