<?php

namespace App\Console\Commands;

use App\Jobs\ImportSeasons;
use App\Jobs\ImportTeams;
use App\Models\League as LeagueModel;
use App\Models\Sport;
use App\Services\HttpServices;
use Illuminate\Console\Command;

class League extends Command
{
    use HttpServices;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:league {league}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description : Soccer league based import';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $leagueName = $this->argument('league');

            $this->info($this->description . ' - ' . $leagueName);
            $sport = $this->get('http://sports.core.api.espn.com/v2/sports/soccer/');

            $sportsID = Sport::pluck('id');
            if (!$sportsID->contains($sport["id"])) {
                $sportDB = Sport::create([
                    "id" => $sport["id"],
                    "guid" => $sport["guid"] ?? null,
                    "uid" => $sport["uid"],
                    "name" => $sport["name"],
                    "slug" => $sport["slug"],
                    "logo" => $sport["logos"][0]["href"],
                ]);
            }

            $league = $this->get('http://sports.core.api.espn.com/v2/sports/soccer/leagues/' . $leagueName);

            $slugs = LeagueModel::pluck("slug")->toArray();
            if (!in_array($league["slug"], $slugs)) {
                $leagueDB = LeagueModel::create([
                    "id" => $league["id"],
                    "sport_id" => $sportDB->id,
                    "guid" => $league["guid"] ?? null,
                    "uid" => $league["uid"],
                    "name" => $league["name"],
                    "shortName" => $league["shortName"],
                    "midsizeName" => $league["midsizeName"],
                    "slug" => $league["slug"],
                    "abbreviation" => $league["abbreviation"],
                    "isTournament" => $league["isTournament"],
                ]);

                ImportTeams::dispatch($league["teams"]['$ref'], $leagueDB->id);
                ImportSeasons::dispatch($league["seasons"]['$ref'], $leagueDB->id);
            } else {
                $this->info("The soccer league already exists");
            }
        } catch (\Throwable $th) {
            $this->info('Error' . $th);
        }
    }
}
