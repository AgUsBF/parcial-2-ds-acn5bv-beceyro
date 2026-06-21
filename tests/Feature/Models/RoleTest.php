<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
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

    public function test_propietario_cannot_access_roles(): void
    {
        $response = $this->actingAs($this->normalUser)
            ->get(route('roles.index'));

        $response->assertRedirect(route('dashboard'));
    }

    public function test_vet_cannot_access_roles(): void
    {
        $response = $this->actingAs($this->vet)
            ->get(route('roles.index'));

        $response->assertRedirect(route('dashboard'));
    }

    public function test_admin_can_view_roles_index(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('roles.index'));

        $response->assertStatus(200);
        $response->assertSeeLivewire('role-table');
    }

    public function test_admin_can_view_role_create_form(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('roles.create'));

        $response->assertStatus(200);
        $response->assertSee('Crear Nuevo Rol');
        $response->assertSee('Nombre del Rol');
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
}
