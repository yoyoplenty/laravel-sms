<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model {
    use HasFactory;

    protected $fillable = [];

    /**
     * Get the grade the student belongs to.
     */
    public function grade(): BelongsTo {
        return $this->belongsTo(Grade::class);
    }

    /**
     * Get the student user id;
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
