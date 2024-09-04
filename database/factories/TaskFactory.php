<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titulo = $this->faker->unique->word(30);
        $prioridad = $this->faker->randomElement(['baja', 'media', 'alta']);
        $estatus = $this->faker->randomElement(['pendiente', 'proceso', 'completado']);
        return [
            'titulo' => $titulo,
            'descripcion' => $this->faker->text(250),
            'prioridad' => $prioridad,
            'estatus' => $estatus,
            'fecha_vencimiento' => $this->faker->dateTimeThisDecade(),
            'category_id'=> Category::all()->random()->id,
            'user_id'=> User::all()->random()->id,



        ];
    }
}
