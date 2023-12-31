<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Repository extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pullRequest(): HasMany
    {
        return $this->hasMany(PullRequest::class);
    }
    public function watchers()
    {
        return $this->hasMany(Watcher::class, 'repository_id');
    }
    protected $fillable = [
        'repository_name',
        'user_id',
    ];
}
