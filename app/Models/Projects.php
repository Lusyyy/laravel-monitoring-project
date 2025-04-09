<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Report;
class Projects extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $guarded = [
        'id',
    ];

    public function reports(){
        return $this->hasMany(Report::class, 'project_id');
    }
}
