<?php

test('la ruta home responde exitosamente', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
});