<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('username');
        $table->string('password');
        $table->string('role');
        $table->boolean('status')->default(true);
        $table->timestamps();
    });

    $this->usuario = User::create([
        'name' => 'Ana Analista',
        'username' => 'ana',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
});

it('renders the comment and detail fields of the observation form as wrapping text boxes', function () {
    $campos = array_merge(
        array_map(fn (int $numero): string => "q{$numero}_com", range(1, 17)),
        ['q18_det', 'q19_det', 'opt_otro1_txt', 'opt_otro2_txt'],
    );

    $html = $this->actingAs($this->usuario)
        ->get(route('formularios.ficha-observacion'))
        ->assertOk()
        ->getContent();

    foreach ($campos as $campo) {
        expect($html)
            ->toMatch('/<textarea[^>]*name="'.$campo.'"/')
            ->not->toMatch('/<input[^>]*name="'.$campo.'"/');
    }
});

it('lets the observation page grow instead of hiding content that no longer fits', function () {
    $html = $this->actingAs($this->usuario)
        ->get(route('formularios.ficha-observacion'))
        ->getContent();

    expect($html)->not->toMatch('/\.page\s*\{[^}]*(?<![-\w])height:\s*297mm/s');
});
