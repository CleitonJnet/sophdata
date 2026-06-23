<?php

use App\Models\User;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Profile\EditProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('login page can be rendered', function () {
    $this->get('/login')
        ->assertOk()
        ->assertSee('Entrar')
        ->assertSee('E-mail')
        ->assertSee('Senha');
});

test('registration page can be rendered', function () {
    $this->get('/register')
        ->assertOk()
        ->assertSee('Criar conta SophData')
        ->assertSee('Telefone')
        ->assertSee('Tipo de cliente')
        ->assertSee('Confirmar senha');
});

test('forgot password page can be rendered', function () {
    $this->get('/forgot-password')
        ->assertOk()
        ->assertSee('Esqueci minha senha');
});

test('guests are redirected from dashboard', function () {
    $this->get('/dashboard')
        ->assertRedirect('/login');
});

test('authenticated user can access dashboard', function () {
    $user = User::create([
        'name' => 'Cliente SophData',
        'email' => 'cliente-dashboard@sophdata.test',
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('Painel do cliente SophData');
});

test('profile page can be rendered by authenticated users', function () {
    $user = User::create([
        'name' => 'Cliente SophData',
        'email' => 'cliente-profile@sophdata.test',
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user)
        ->get('/profile')
        ->assertOk()
        ->assertSee('Editar perfil')
        ->assertSee('Telefone')
        ->assertSee('Tipo de cliente');
});

test('users can register with only required fields', function () {
    Livewire::test(Register::class)
        ->set('name', 'Cliente SophData')
        ->set('email', 'novo@sophdata.test')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertRedirect('/dashboard');

    $this->assertAuthenticated();

    $user = User::where('email', 'novo@sophdata.test')->firstOrFail();

    expect($user->phone)->toBeNull()
        ->and($user->customer_type)->toBeNull();
});

test('users can register with optional phone and customer type', function () {
    Livewire::test(Register::class)
        ->set('name', 'Cliente PJ')
        ->set('email', 'pj@sophdata.test')
        ->set('phone', '(11) 99999-0000')
        ->set('customer_type', 'business')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertRedirect('/dashboard');

    $user = User::where('email', 'pj@sophdata.test')->firstOrFail();

    expect($user->phone)->toBe('(11) 99999-0000')
        ->and($user->customer_type)->toBe('business');
});

test('invalid customer type fails on registration', function () {
    Livewire::test(Register::class)
        ->set('name', 'Cliente SophData')
        ->set('email', 'invalido@sophdata.test')
        ->set('customer_type', 'enterprise')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertHasErrors(['customer_type']);
});

test('registration accepts customer type query aliases', function () {
    Livewire::withQueryParams(['tipo' => 'pj'])
        ->test(Register::class)
        ->assertSet('customer_type', 'business');

    Livewire::withQueryParams(['customer_type' => 'personal'])
        ->test(Register::class)
        ->assertSet('customer_type', 'personal');
});

test('authenticated user can update phone and customer type on profile', function () {
    $user = User::create([
        'name' => 'Cliente SophData',
        'email' => 'perfil@sophdata.test',
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user);

    Livewire::test(EditProfile::class)
        ->set('name', 'Cliente Atualizado')
        ->set('email', 'perfil@sophdata.test')
        ->set('phone', '(21) 98888-7777')
        ->set('customer_type', 'personal')
        ->call('save')
        ->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toBe('Cliente Atualizado')
        ->and($user->phone)->toBe('(21) 98888-7777')
        ->and($user->customer_type)->toBe('personal');
});

test('invalid customer type fails on profile update', function () {
    $user = User::create([
        'name' => 'Cliente SophData',
        'email' => 'perfil-invalido@sophdata.test',
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user);

    Livewire::test(EditProfile::class)
        ->set('customer_type', 'enterprise')
        ->call('save')
        ->assertHasErrors(['customer_type']);
});

test('users can authenticate', function () {
    User::create([
        'name' => 'Cliente SophData',
        'email' => 'cliente@sophdata.test',
        'password' => Hash::make('password'),
    ]);

    Livewire::test(Login::class)
        ->set('email', 'cliente@sophdata.test')
        ->set('password', 'password')
        ->call('login')
        ->assertRedirect('/dashboard');

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    User::create([
        'name' => 'Cliente SophData',
        'email' => 'cliente@sophdata.test',
        'password' => Hash::make('password'),
    ]);

    Livewire::test(Login::class)
        ->set('email', 'cliente@sophdata.test')
        ->set('password', 'senha-errada')
        ->call('login')
        ->assertHasErrors(['email']);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::create([
        'name' => 'Cliente SophData',
        'email' => 'cliente-logout@sophdata.test',
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user)
        ->post('/logout')
        ->assertRedirect('/');

    $this->assertGuest();
});

test('public home and portals still load', function () {
    $this->get('/')->assertRedirect('/para-empresas');
    $this->get('/para-empresas')->assertOk();
    $this->get('/para-voce')->assertOk();
});
