<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model {
    use HasFactory;

    protected $fillable = ['phone_number', 'staff_id', 'user_id', 'grade_id'];

    /**
     * Get the grade assigned to the teacher
     */
    public function grade(): BelongsTo {
        return $this->belongsTo(Grade::class);
    }

    /**
     * The teacher can take multiple subjects
     */
    public function subjects(): BelongsToMany {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * Get the teacher user id;
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
