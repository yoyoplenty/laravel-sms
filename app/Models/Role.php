<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model {
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * A role belongs to many users
     */
    public function users(): HasMany {
        return $this->HasMany(User::class);
    }
}
