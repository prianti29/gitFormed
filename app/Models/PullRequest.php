<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PullRequest extends Model
{
    use HasFactory;
    public function Repository()
    {
        return $this->belongsTo(Repository::class, 'repository_id');
    }

}
