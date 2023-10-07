<?php

namespace App\Jobs;

use App\Models\Season;
use App\Services\HttpServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportSeasons implements ShouldQueue
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
            $seasons = $this->get($this->url);

            for ($i = 0; $i < count($seasons["items"]); $i++) {
                $season = $this->get($seasons["items"][$i]['$ref']);

                Season::create([
                    "league_id" => $this->league_id,
                    "year" => $season["year"],
                    "startDate" => $season["startDate"],
                    "endDate" => $season["endDate"],
                    "displayName" => $season["displayName"],
                    "shortDisplayName" => $season["shortDisplayName"],
                    "abbreviation" => $season["abbreviation"],
                ]);
            }
        } catch (\Throwable $th) {
            Log::notice($th);
        }
    }
}
