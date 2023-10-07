<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaguesTeams extends Model
{
    use HasFactory;
    protected $table = 'leagues_teams';
    protected $guarded = [];
}
