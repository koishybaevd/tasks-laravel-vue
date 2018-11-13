<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'text', 'completed'
    ];

    public $timestamps = false;

    public function toggleTask()
    {
        $this->completed= !$this->completed;
        return $this;
    }
}
