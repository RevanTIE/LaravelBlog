<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->truncateTables([
            "users",
            "entradas",
            "comentarios"
        ]);
        $this->call(UsersTableSeeder::class);
        $this->call(EntradasTableSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    public function truncateTables(array $tables){
        foreach ($tables as $table) {
            //deshabilita las llaves foráneas
            \DB::statement('SET FOREIGN_KEY_CHECKS=0');
            //Se trunca la tabla
            \DB::table($table)->truncate();
            //Se habilitan las llaves foráneas
            \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
