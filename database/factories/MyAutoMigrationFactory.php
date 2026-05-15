<?php

namespace Database\Factories;

use App\Models\MyAutoMigration;
use Illuminate\Database\Eloquent\Factories\Factory;

class MyAutoMigrationFactory extends Factory
{
    protected $model = MyAutoMigration::class;

    public function definition()
    {
        return app($this->model)->definition($this->faker);
    }
}
