<?php

namespace App\Console\Commands;

use App\Jobs\ImportLeagues;
use App\Jobs\ImportSeasons;
use App\Jobs\ImportTeams;
use App\Models\Sport as SportModel;
use App\Services\HttpServices;
use Illuminate\Console\Command;

class Sport extends Command
{
    use HttpServices;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sport {sport}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description: ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            $sport = $this->argument('sport');

            $this->info($this->description . $sport . ' based import');

            $sport = $this->get('http://sports.core.api.espn.com/v2/sports/' . $sport);

            $sportsID = SportModel::pluck('id');
            if (!$sportsID->contains($sport["id"])) {
                $sportDB = SportModel::create([
                    "id" => $sport["id"],
                    "guid" => $sport["guid"] ?? null,
                    "uid" => $sport["uid"],
                    "name" => $sport["name"],
                    "slug" => $sport["slug"],
                    "logo" => $sport["logos"][0]["href"],
                ]);

                $leagues = $this->get($sport["leagues"]['$ref']);
                for ($i = 0; $i < count($leagues["items"]); $i++) {
                    $league = $this->get($leagues["items"][$i]['$ref']);

                    ImportLeagues::dispatch($league, $sportDB->id);
                    ImportTeams::dispatch($league["teams"]['$ref'], $league["id"]);
                    ImportSeasons::dispatch($league["seasons"]['$ref'], $league["id"]);
                }
            } else {
                $this->info("The Sport already exists");
            }
        } catch (\Throwable $th) {
            $this->info('Error' . $th);
        }
    }
}
