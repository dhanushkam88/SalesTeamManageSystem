<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $file;

    public function setUp(): void
    {
        parent::setUp();
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        $this->user = User::factory()->create();
        $this->user = $this->user->assignRole("admin");
    }

    public function test_if_admin_can_list_all_Users_in_the_Users_table() : void
    {
        User::factory(10)->create([
            'manager_id' => 1,
        ]);

        $response = $this->actingAs($this->user)->get(route('dashboard.index'))->assertStatus(200);

        $this->assertDatabaseCount('users', 11);
    }

    public function test_if_admin_can_view_the_user_data() : void
    {
        User::factory()->create();
        $this->assertDatabaseCount('users', 2);
        $user = User::role('admin')->first();
        $response = $this->actingAs($this->user)->get(route('dashboard.show', ['dashboard' => $user->id,
            '_token' => csrf_token()]))
            ->assertStatus(200);
    }

    public function test_if_admin_can_create_a_user() : void
    {
        $response = $this->actingAs($this->user)->post(route('user.store'), [
            'name' => 'test_first_name',
            'email' => 'email@emil.com',
            'contact' => '+11111111111',
            'manager_id' => '1',
            'status' => '2',
            'joined_date' => '2022-05-22',
            'current_route' => 'Cinnamon gardens, colombo 7',
            'address' => 'No 88, Cinnamon gardens, colombo 7',
            'city' => 'kandy',
            'province' => 'Central',
            'zip' => '20000',
            'password' => '0773518123',
            'comment' => 'gdfdufudsvufsvudf'
        ])->assertStatus(302);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_if_admin_can_update_a_user() : void
    {
        User::factory()->create([
            'name' => 'test_first_name',
            'email' => 'email@emil.com',
            'contact' => '+11111111111',
            'manager_id' => '1',
            'status' => '2',
        ]);

        $this->assertDatabaseCount('users', 2);
        $user = User::where('manager_id',1)->first();

        $response = $this->actingAs($this->user)->put(route('user.update',['user' => $user->id]), [
            'id' => $user->id,
            'fname' => 'first_name_2',
            'contact_number' => '0777735181',
            'email' => 'email2@emil.com',
            'address' => 'test test test test',
            'city' => 'kandy',
            'province' => 'western',
            'zip' => '20000',
            'comments' => 'test test test test',
        ])->assertStatus(302);

        $user = User::where('manager_id',1)->first();

        $this->assertDatabaseCount('users', 2);
        $this->assertEquals("first_name_2", $user->name);
    }

    public function test_if_admin_can_delete_a_user() : void
    {
        User::factory()->create([
            'manager_id' => 1,
        ]);

        $this->assertDatabaseCount('users', 2);

        $customer = User::where('manager_id',1)->first();
        $confirmText = 'DELETE';

        $response = $this->actingAs($this->user)->delete(route('user.destroy', ['id' => $customer->id,
            'user' =>$customer->id, 'confirmText' => $confirmText, '_token' => csrf_token()]))
            ->assertStatus(302);

        $this->assertDatabaseCount('users', 1);
    }
}
