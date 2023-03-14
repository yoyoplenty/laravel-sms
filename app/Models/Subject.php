<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model {
    use HasFactory;

    /**
     * The subject is taken by many grades
     */
    public function grades(): BelongsToMany {
        return $this->belongsToMany(Grade::class);
    }

    /**
     * The subject can be taken by many teachers
     */
    public function teachers(): BelongsToMany {
        return $this->belongsToMany(Teacher::class);
    }
}
