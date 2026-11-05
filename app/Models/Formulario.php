<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Formulario extends Model
{
    /**
     * Campos que pueden ser asignados masivamente.
     */
    protected $fillable = [
        'nombre_formulario',
        'usuario_id',
        'pdf_path',
        'datos_path',
        'ediciones',
    ];

    /**
     * Un formulario pertenece a un usuario.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function limpiarArchivos(): void
    {
        $disk = Storage::disk('local');
        $rutas = array_filter([
            $this->datos_path,
            $this->pdf_path,
            'formularios/'.$this->id,
        ], function (?string $ruta): bool {
            return is_string($ruta) && trim($ruta) !== '';
        });
        $rutas = array_values(array_unique($rutas));

        foreach ($rutas as $ruta) {
            if (! $this->rutaEsPermitidaParaEliminacion($ruta)) {
                continue;
            }

            if ($disk->directoryExists($ruta)) {
                $disk->deleteDirectory($ruta);

                continue;
            }

            if ($disk->exists($ruta)) {
                $disk->delete($ruta);
            }
        }

        $carpeta = $this->rutaCarpetaFormulario();

        if (
            $carpeta !== null &&
            $this->rutaEsPermitidaParaEliminacion($carpeta) &&
            $disk->directoryExists($carpeta) &&
            $disk->allFiles($carpeta) === []
        ) {
            $disk->deleteDirectory($carpeta);
        }
    }

    private function rutaCarpetaFormulario(): ?string
    {
        if (is_string($this->datos_path) && $this->datos_path !== '') {
            $ruta = dirname($this->datos_path);

            return $ruta !== '.' ? $ruta : null;
        }

        if (is_string($this->pdf_path) && $this->pdf_path !== '') {
            $ruta = dirname($this->pdf_path);

            return $ruta !== '.' ? $ruta : null;
        }

        return null;
    }

    private function rutaEsPermitidaParaEliminacion(string $ruta): bool
    {
        $rutaNormalizada = trim(str_replace('\\', '/', $ruta), '/');

        if ($rutaNormalizada === '' || str_contains($rutaNormalizada, '..')) {
            return false;
        }

        $basesPermitidas = [
            'usuarios/'.$this->usuario_id,
            'formularios/'.$this->id,
        ];

        if ($this->usuario) {
            $nombreUsuario = preg_replace('/[^\pL\pN _().-]/u', ' ', $this->usuario->name);
            $nombreUsuario = trim(preg_replace('/\s+/u', ' ', $nombreUsuario), ' .');

            if ($nombreUsuario !== '') {
                $basesPermitidas[] = $nombreUsuario;
            }
        }

        foreach ($basesPermitidas as $base) {
            $baseNormalizada = trim(str_replace('\\', '/', $base), '/');

            if ($baseNormalizada === '') {
                continue;
            }

            if (
                $rutaNormalizada === $baseNormalizada ||
                Str::startsWith($rutaNormalizada, $baseNormalizada.'/')
            ) {
                return true;
            }
        }

        return false;
    }
}
