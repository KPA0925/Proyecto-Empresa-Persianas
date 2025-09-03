<?php

test('la pantalla de registro se puede renderizar', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);
});

test('los nuevos usuarios pueden registrarse', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});