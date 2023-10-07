<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

trait HttpServices
{
    public function get($url)
    {
        $response = Http::get($url);
        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Error al obtener datos de la API'], $response->status());
        }
    }
}
