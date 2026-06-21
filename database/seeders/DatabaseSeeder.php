<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Role;
use App\Models\Specie;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ESPECIES
        $species = ['Perro', 'Gato'];

        foreach ($species as $specie) {
            Specie::create([
                'name' => $specie,
            ]);
        }

        // ROLES
        $roles = ['Propietario', 'Veterinario', 'Admin'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }

        // USUARIOS
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('1234'),
            'role_id' => 1,
        ]);
        // Propietario 1
        User::create([
            'name' => 'Usuario 1',
            'email' => 'user1@test.com',
            'password' => bcrypt('1234'),
            'role_id' => 2,
        ]);
        // Propietario 2
        User::create([
            'name' => 'Usuario 2',
            'email' => 'user2@test.com',
            'password' => bcrypt('1234'),
            'role_id' => 2,
        ]);
        // Veterinario 1
        User::create([
            'name' => 'Veterinario 1',
            'email' => 'veterinario1@test.com',
            'password' => bcrypt('1234'),
            'role_id' => 3,
        ]);
        // Veterinario 2
        User::create([
            'name' => 'Veterinario 2',
            'email' => 'veterinario2@test.com',
            'password' => bcrypt('1234'),
            'role_id' => 3,
        ]);
        
        // MASCOTAS
        Animal::create([
            'name' => 'Firulais',
            'birth_date' => '2020-01-01',
            'sex' => 'Macho',
            'is_sterilized' => true,
            'comment' => 'Con problemas de piel',
            'specie_id' => 1,
            'user_id' => 2,
        ]);

        Animal::create([
            'name' => 'Michi',
            'birth_date' => '2023-02-02',
            'sex' => 'Macho',
            'is_sterilized' => false,
            'comment' => 'Diabetico',
            'specie_id' => 2,
            'user_id' => 2,
        ]);

        Animal::create([
            'name' => 'Luna',
            'birth_date' => '2021-03-03',
            'sex' => 'Hembra',
            'is_sterilized' => true,
            'comment' => '',
            'specie_id' => 1,
            'user_id' => 3,
        ]);
    }
}
