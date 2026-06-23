<?php

namespace Tests\Unit;

use App\Livewire\VetTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VetTableTest extends TestCase
{
    use RefreshDatabase;

    public function test_builder_returns_only_vet_users(): void
    {
        Role::create(['name' => 'Propietario']);
        Role::create(['name' => 'Veterinario']);

        $vetUser = User::create([
            'name' => 'Veterinario Test',
            'email' => 'vet@example.com',
            'password' => bcrypt('password'),
            'role_id' => Role::VET_ID,
        ]);

        User::create([
            'name' => 'Propietario Test',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'),
            'role_id' => Role::NORMAL_ID,
        ]);

        $component = new VetTable;
        $query = $component->builder();
        $users = $query->get();

        $this->assertTrue($users->contains($vetUser));
        $this->assertFalse($users->contains(fn (User $user) => $user->role_id !== Role::VET_ID));
        $this->assertCount(1, $users);
    }
}
