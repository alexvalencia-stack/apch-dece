<?php

use Illuminate\Support\Facades\Schema;

it('runs every migration from scratch on the default SQLite connection', function () {
    $this->artisan('migrate:fresh')->assertSuccessful();

    expect(Schema::hasColumns('users', ['name', 'username', 'password', 'role', 'status']))->toBeTrue()
        ->and(Schema::hasColumn('users', 'email'))->toBeFalse()
        ->and(Schema::hasColumns('formularios', ['nombre_formulario', 'usuario_id', 'datos_path', 'pdf_path', 'ediciones']))->toBeTrue();
});
