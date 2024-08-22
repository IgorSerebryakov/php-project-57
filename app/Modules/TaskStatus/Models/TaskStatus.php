<?php

namespace App\Modules\TaskStatus\Models;

use App\Modules\Task\Models\Task;
use Illuminate\Database\Eloquent\Events\Deleting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    public function tasks(): hasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
