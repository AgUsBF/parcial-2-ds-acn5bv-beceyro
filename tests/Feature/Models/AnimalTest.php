<?php

namespace Tests\Feature;

use App\Models\Animal;
use App\Models\Role;
use App\Models\Specie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnimalTest extends TestCase
{
    use RefreshDatabase;

    private User $normalUser;

    private User $vet;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed como en DatabaseSeeder
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

    public function test_propietario_can_access_animals(): void
    {
        $response = $this->actingAs($this->normalUser)
            ->get(route('animals.index'));

        $response->assertStatus(200);
        $response->assertSeeLivewire('animal-table');
    }

    public function test_vet_can_access_animals(): void
    {
        $response = $this->actingAs($this->vet)
            ->get(route('animals.index'));

        $response->assertStatus(200);
        $response->assertSeeLivewire('animal-table');
    }

    public function test_admin_can_access_animals(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('animals.index'));

        $response->assertStatus(200);
        $response->assertSeeLivewire('animal-table');
    }

    public function test_admin_can_view_animal_create_form(): void
    {
        Specie::create(['name' => 'Perro']);

        $response = $this->actingAs($this->admin)
            ->get(route('animals.create'));

        $response->assertStatus(200);
        $response->assertSee('Crear Nueva Mascota');
        $response->assertSee('Nombre de la Mascota');
        $response->assertSee('Fecha de Nacimiento');
        $response->assertSee('Sexo');
        $response->assertSee('¿Está esterilizado?');
        $response->assertSee('Comentario');
        $response->assertSee('Especie');
        $response->assertSee('Propietario');
    }

    public function test_admin_can_store_role(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('roles.store'), [
                'name' => 'Guest',
            ]);

        $response->assertRedirect(route('roles.index'));
        $response->assertSessionHas('success', 'Rol creado correctamente.');

        $this->assertDatabaseHas('roles', [
            'name' => 'Guest',
        ]);
    }

    public function test_admin_can_view_role_detail(): void
    {
        $role = Role::where('id', Role::VET_ID)->first();

        $response = $this->actingAs($this->admin)
            ->get(route('roles.show', $role->id));

        $response->assertStatus(200);
        $response->assertSee('Detalle de Rol');
        $response->assertSee($role->name);
    }

    public function test_admin_can_view_role_edit_form(): void
    {
        $role = Role::where('id', Role::VET_ID)->first();

        $response = $this->actingAs($this->admin)
            ->get(route('roles.edit', $role->id));

        $response->assertStatus(200);
        $response->assertSee('Editar Rol');
        $response->assertSee($role->name);
    }

    public function test_admin_can_update_role(): void
    {
        $role = Role::where('id', Role::VET_ID)->first();

        $response = $this->actingAs($this->admin)
            ->put(route('roles.update', $role->id), [
                'name' => 'Veterinario Senior',
            ]);

        $response->assertRedirect(route('roles.index'));
        $response->assertSessionHas('success', 'Rol actualizado correctamente.');

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => 'Veterinario Senior',
        ]);
    }

    public function test_admin_can_update_role_with_same_name(): void
    {
        $role = Role::where('id', Role::VET_ID)->first();

        $response = $this->actingAs($this->admin)
            ->put(route('roles.update', $role->id), [
                'name' => $role->name,
            ]);

        $response->assertRedirect(route('roles.index'));
        $response->assertSessionHas('success', 'Rol actualizado correctamente.');
    }

    public function test_admin_can_delete_role(): void
    {
        $role = Role::create(['name' => 'TempRole']);

        $response = $this->actingAs($this->admin)
            ->delete(route('roles.destroy', $role->id));

        $response->assertRedirect(route('roles.index'));
        $response->assertSessionHas('success', 'Rol eliminado correctamente.');

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
        ]);
    }

    public function test_validation_errors_when_storing_role(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('roles.store'), [
                'name' => '', // Required validation error
            ]);

        $response->assertSessionHasErrors('name');

        $response2 = $this->actingAs($this->admin)
            ->post(route('roles.store'), [
                'name' => 'Admin', // Unique validation error
            ]);

        $response2->assertSessionHasErrors('name');
    }

    public function test_animal_edit_form_displays_saved_birth_date(): void
    {
        $specie = Specie::create(['name' => 'Gato']);
        $animal = Animal::create([
            'name' => 'Mittens',
            'birth_date' => '2020-01-01',
            'sex' => 'Hembra',
            'is_sterilized' => true,
            'comment' => 'Very friendly',
            'specie_id' => $specie->id,
            'user_id' => $this->normalUser->id,
        ]);

        $response = $this->actingAs($this->normalUser)
            ->get(route('animals.edit', $animal->id));

        $response->assertStatus(200);
        $response->assertSee('Editar Mascota');
        $response->assertSee('Mittens');
        $response->assertSee('2020-01-01');
    }

    public function test_admin_can_view_animal_edit_form_with_birth_date(): void
    {
        $specie = Specie::create(['name' => 'Perro']);
        $animal = Animal::create([
            'name' => 'Luna',
            'birth_date' => '2024-05-10',
            'sex' => 'Hembra',
            'is_sterilized' => true,
            'comment' => 'Mascota de prueba',
            'specie_id' => $specie->id,
            'user_id' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('animals.edit', $animal->id));

        $response->assertStatus(200);
        $response->assertSee('value="2024-05-10"', false);
    }

    public function test_animal_index_shows_formatted_values_and_actions_column(): void
    {
        $specie = Specie::create(['name' => 'Conejo']);

        Animal::create([
            'name' => 'Nube',
            'birth_date' => '2023-08-15',
            'sex' => 'Hembra',
            'is_sterilized' => true,
            'comment' => 'Mascota de prueba',
            'specie_id' => $specie->id,
            'user_id' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('animals.index'));

        $response->assertStatus(200);
        $response->assertSee('Nube');
        $response->assertSee('15/08/2023');
        $response->assertSee('Sí');
        $response->assertSee('Acciones');
    }
}
