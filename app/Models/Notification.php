<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id',
       'pull_request_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function generateMessage()
    {
        if ($this->pullRequest) {
            return "A pull request created with title: \"{$this->pullRequest->title}\" at repository: \"{$this->pullRequest->repository->repository_name}\"";
        }
        return "Notification without associated pull request";
    }

    public function pullRequest()
    {
        return $this->belongsTo(PullRequest::class, 'pull_request_id');
    }
}
