<?php

use App\Models\User;

test('la pantalla de inicio de sesión se puede renderizar', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});

test('los usuarios pueden autenticarse utilizando la pantalla de inicio de sesión', function () {
    $user = User::factory()->create();

    $response = $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('los usuarios no pueden autenticarse con una contraseña inválida', function () {
    $user = User::factory()->create();

    $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('los usuarios pueden cerrar sesión', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $this->assertGuest();
    $response->assertRedirect(route('home'));
});

test('los usuarios están limitados por la tasa de intentos', function () {
    $user = User::factory()->create();

    for ($i = 0; $i < 5; $i++) {
        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ])->assertStatus(302)->assertSessionHasErrors([
            'email' => 'Estas credenciales no coinciden con nuestros registros.',
        ]);
    }

    $response = $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('email');

    $errors = session('errors');

    $this->assertStringContainsString('Demasiados intentos de inicio de sesión', $errors->first('email'));
});