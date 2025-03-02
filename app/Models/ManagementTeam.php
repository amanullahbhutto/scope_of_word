<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementTeam extends Model
{
    use HasFactory;
    protected $table = 'management_teams'; // Table name

    protected $fillable = ['name', 'position', 'email']; // Mass assignable fields
}
