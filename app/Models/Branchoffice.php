<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branchoffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'startTime',
        'endTime',
        'companyId'
    ];
}