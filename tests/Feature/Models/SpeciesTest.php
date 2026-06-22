<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Specie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpeciesTest extends TestCase
{
    use RefreshDatabase;

    private User $normalUser;
    private User $vet;
    private User $admin;


    protected function setUp(): void
    {
        parent::setUp();

        // Seed como en DatabaseSeeder
        Specie::create(['id' => 1, 'name' => 'Perro']);
        Role::create(['id' => 1, 'name' => 'Propietario']);
        Role::create(['id' => 2, 'name' => 'Veterinario']);
        Role::create(['id' => 3, 'name' => 'Admin']);

        $this->normalUser = User::create([
            'name' => 'Normal User',
            'email' => 'normal@test.com',
            'password' => bcrypt('password'),
            'role_id' => Role::NORMAL_ID,
        ]);

        $this->vet = User::create([
            'name' => 'Vet User',
            'email' => 'vet@test.com',
            'password' => bcrypt('password'),
            'role_id' => Role::VET_ID,
        ]);

        $this->admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role_id' => Role::ADMIN_ID,
        ]);
    }

    public function test_propietario_cannot_access_species(): void
    {
        $response = $this->actingAs($this->normalUser)
            ->get(route('species.index'));

        $response->assertRedirect(route('dashboard'));
    }

    public function test_vet_cannot_access_species(): void
    {
        $response = $this->actingAs($this->vet)
            ->get(route('species.index'));

        $response->assertRedirect(route('dashboard'));
    }

    public function test_admin_can_view_species_index(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('species.index'));

        $response->assertStatus(200);
        $response->assertSeeLivewire('specie-table');
    }

    public function test_admin_can_view_specie_create_form(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('species.create'));

        $response->assertStatus(200);
        $response->assertSee('Crear Nueva Especie');
        $response->assertSee('Nombre de la Especie');
    }

    public function test_admin_can_store_specie(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('species.store'), [
                'name' => 'Guest',
            ]);

        $response->assertRedirect(route('species.index'));
        $response->assertSessionHas('success', 'Especie creada correctamente.');

        $this->assertDatabaseHas('species', [
            'name' => 'Guest',
        ]);
    }

    public function test_admin_can_view_specie_detail(): void
    {
        $specie = Specie::where('id', 1)->first();

        $response = $this->actingAs($this->admin)
            ->get(route('species.show', $specie->id));

        $response->assertStatus(200);
        $response->assertSee('Detalle de Especie');
        $response->assertSee($specie->name);
    }

    public function test_admin_can_view_specie_edit_form(): void
    {
        $specie = Specie::where('id', 1)->first();

        $response = $this->actingAs($this->admin)
            ->get(route('species.edit', $specie->id));

        $response->assertStatus(200);
        $response->assertSee('Editar Especie');
        $response->assertSee($specie->name);
    }

    public function test_admin_can_update_specie(): void
    {
        $specie = Specie::where('id', 1)->first();

        $response = $this->actingAs($this->admin)
            ->put(route('species.update', $specie->id), [
                'name' => 'Perro Actualizado',
            ]);

        $response->assertRedirect(route('species.index'));
        $response->assertSessionHas('success', 'Especie actualizada correctamente.');
        $this->assertDatabaseHas('species', [
            'id' => $specie->id,
            'name' => 'Perro Actualizado',
        ]);
    }

    public function test_admin_can_update_specie_with_same_name(): void
    {
        $specie = Specie::where('id', 1)->first();

        $response = $this->actingAs($this->admin)
            ->put(route('species.update', $specie->id), [
                'name' => $specie->name,
            ]);

        $response->assertRedirect(route('species.index'));
        $response->assertSessionHas('success', 'Especie actualizada correctamente.');
    }

    public function test_admin_can_delete_specie(): void
    {
        $specie = Specie::create(['name' => 'TempSpecie']);

        $response = $this->actingAs($this->admin)
            ->delete(route('species.destroy', $specie->id));

        $response->assertRedirect(route('species.index'));
        $response->assertSessionHas('success', 'Especie eliminada correctamente.');

        $this->assertDatabaseMissing('species', [
            'id' => $specie->id,
        ]);
    }

    public function test_validation_errors_when_storing_specie(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('species.store'), [
                'name' => '', // Required validation error
            ]);

        $response->assertSessionHasErrors('name');

        $response2 = $this->actingAs($this->admin)
            ->post(route('species.store'), [
                'name' => 'Perro', // Unique validation error
            ]);

        $response2->assertSessionHasErrors('name');
    }
}
