<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Grade extends Model {
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * all students for this grade
     */
    public function students(): HasMany {
        return $this->hasMany(Student::class);
    }

    /**
     * teacher assigned to the grade
     */
    public function teacher(): HasOne {
        return $this->hasOne(Teacher::class);
    }

    /**
     * The grade takes many subjects
     */
    public function subjects(): BelongsToMany {
        return $this->belongsToMany(Subject::class);
    }
}
