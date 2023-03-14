<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model {
    use HasFactory;

    /**
     * Get the grade assigned to the teacher
     */
    public function grade(): BelongsTo {
        return $this->belongsTo(Grade::class);
    }

    /**
     * Get the teacher user id;
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
