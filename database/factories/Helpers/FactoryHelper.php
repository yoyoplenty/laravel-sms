<?php


namespace Database\Factories\Helpers;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class FactoryHelper {
    /**
     * This function will get a random model id from the database.
     * @param string | HasFactory $model
     */
    public static function getRandomModelId(string $model) {
        $count = $model::query()->count();

        if ($count <= 0) return $model::factory()->create()->id;
        else  return rand(1, $count);
    }
}
