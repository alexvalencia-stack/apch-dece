<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Process\Exceptions\ProcessTimedOutException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use JsonException;
use Symfony\Component\Process\Exception\ProcessStartFailedException;

use function Illuminate\Support\defer;

class FormularioController extends Controller
{
    private const TAMANO_MAXIMO_DATOS = 2 * 1024 * 1024;

    private const MAPA_FORMULARIOS = [
        'ENTREVISTA ESTUDIANTES' => 'entrevista-estudiantes',
        'FICHA DE OBSERVACIÓN' => 'ficha-observacion',
        'FICHA DE DERIVACIÓN' => 'ficha-derivacion',
        'ENTREVISTA REPRESENTANTES' => 'entrevista-representantes',
        'ENTREVISTA DOCENTES' => 'entrevista-docentes',
        'CONSENTIMIENTO INFORMADO' => 'consentimiento-informado',
        'FICHA DE NOTIFICACIÓN DE ALERTA DECE' => 'ficha-alerta-dece',
        'PLAN DE ATENCIÓN PSICOSOCIAL Y SEGUIMIENTO' => 'plan-atencion-psicosocial',
    ];

    public function index()
    {
        return view('formularios.index', [
            'carpetas' => $this->listarCarpetasUsuario(),
        ]);
    }

    public function crearCarpeta(Request $request)
    {
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                'regex:/^\pL+(?: \pL+)*$/u',
            ],
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios entre palabras.',
        ]);

        $disk = Storage::disk('local');
        $nombreCarpeta = $datos['nombre'];
        $rutaCarpeta = $this->rutaCarpetaUsuario($nombreCarpeta);

        if (in_array($nombreCarpeta, $this->listarCarpetasUsuario(), true)) {
            return back()
                ->withErrors(['nombre' => 'Ya existe una carpeta con ese nombre.'])
                ->withInput();
        }

        if (! $disk->makeDirectory($rutaCarpeta)) {
            Log::error('No se pudo crear una carpeta de formularios.', [
                'ruta_carpeta' => $rutaCarpeta,
                'usuario_id' => auth()->id(),
            ]);

            return back()
                ->withErrors(['carpeta' => 'No se pudo crear la carpeta. Inténtelo nuevamente.'])
                ->withInput();
        }

        return redirect()
            ->route('formularios.index')
            ->with('success', 'La carpeta se creó correctamente.');
    }

    private function listarCarpetasUsuario(): array
    {
        $disk = Storage::disk('local');
        $rutasBase = [
            $this->rutaBaseUsuario(),
            'usuarios/'.auth()->id(),
        ];
        $carpetas = [];

        foreach ($rutasBase as $rutaBase) {
            if (! $disk->directoryExists($rutaBase)) {
                continue;
            }

            $carpetas = array_merge(
                $carpetas,
                array_map(
                    static fn (string $ruta): string => basename($ruta),
                    $disk->directories($rutaBase)
                )
            );
        }

        $carpetas = array_values(array_unique($carpetas));
        sort($carpetas, SORT_NATURAL | SORT_FLAG_CASE);

        return $carpetas;
    }

    private function rutaCarpetaUsuario(string $nombreCarpeta): string
    {
        return $this->rutaBaseUsuario().'/'.$nombreCarpeta;
    }

    private function rutaBaseUsuario(?User $usuario = null): string
    {
        $usuario ??= auth()->user();
        abort_if(! $usuario, 500, 'No se pudo determinar el usuario para guardar sus carpetas.');

        $nombreUsuario = preg_replace('/[^\pL\pN _().-]/u', ' ', $usuario->name);
        $nombreUsuario = trim(preg_replace('/\s+/u', ' ', $nombreUsuario), ' .');

        abort_if($nombreUsuario === '', 500, 'No se pudo determinar el nombre del usuario para guardar sus carpetas.');

        return $nombreUsuario;
    }

    public function plantilla(string $vistaFormulario)
    {
        abort_unless(in_array($vistaFormulario, self::MAPA_FORMULARIOS, true), 404);

        return view('formularios.'.$vistaFormulario, [
            'carpetas' => $this->listarCarpetasUsuario(),
        ]);
    }

    public function misFormularios($nombre)
    {
        $formularios = Formulario::with('usuario')
            ->where('nombre_formulario', $nombre)
            ->where('usuario_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'formularios' => $formularios,
            'usuario_actual' => auth()->id(),
        ]);
    }

    public function misDocumentos(string $tipo)
    {
        $tiposFormulario = [
            'entrevista-estudiantes' => [
                'nombre' => 'ENTREVISTA ESTUDIANTES',
                'ruta' => 'formularios.entrevista-estudiantes',
            ],
            'ficha-observacion' => [
                'nombre' => 'FICHA DE OBSERVACIÓN',
                'ruta' => 'formularios.ficha-observacion',
            ],
            'ficha-derivacion' => [
                'nombre' => 'FICHA DE DERIVACIÓN',
                'ruta' => 'formularios.ficha-derivacion',
            ],
            'entrevista-representantes' => [
                'nombre' => 'ENTREVISTA REPRESENTANTES',
                'ruta' => 'formularios.entrevista-representantes',
            ],
            'entrevista-docentes' => [
                'nombre' => 'ENTREVISTA DOCENTES',
                'ruta' => 'formularios.entrevista-docentes',
            ],
            'consentimiento-informado' => [
                'nombre' => 'CONSENTIMIENTO INFORMADO',
                'ruta' => 'formularios.consentimiento-informado',
            ],
            'ficha-alerta-dece' => [
                'nombre' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
                'ruta' => 'formularios.ficha-alerta-dece',
            ],
            'plan-atencion-psicosocial' => [
                'nombre' => 'PLAN DE ATENCIÓN PSICOSOCIAL Y SEGUIMIENTO',
                'ruta' => 'formularios.plan-atencion-psicosocial',
            ],
        ];

        abort_unless(isset($tiposFormulario[$tipo]), 404);

        $tipoSeleccionado = $tiposFormulario[$tipo];
        $formularios = Formulario::query()
            ->where('usuario_id', auth()->id())
            ->where('nombre_formulario', $tipoSeleccionado['nombre'])
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(20);

        $formularios->getCollection()->each(function (Formulario $formulario) use ($tipoSeleccionado): void {
            $formulario->setAttribute(
                'identificador',
                $this->identificadorCarpeta($formulario, $tipoSeleccionado['nombre'])
            );
        });

        return view('formularios.mis-documentos', [
            'formularios' => $formularios,
            'nombreFormulario' => $tipoSeleccionado['nombre'],
            'rutaFormulario' => $tipoSeleccionado['ruta'],
        ]);
    }

    private function identificadorCarpeta(Formulario $formulario, string $nombreFormulario): string
    {
        if (! $formulario->datos_path) {
            return '—';
        }

        $segmentos = explode('/', trim($formulario->datos_path, '/'));

        if (
            count($segmentos) >= 4 &&
            $segmentos[0] === 'usuarios' &&
            (int) ($segmentos[1] ?? 0) === $formulario->usuario_id
        ) {
            $indiceFormulario = array_search($nombreFormulario, $segmentos, true);

            return is_int($indiceFormulario) && $indiceFormulario >= 3
                ? $segmentos[$indiceFormulario - 1]
                : $segmentos[2];
        }

        $usuario = $formulario->usuario_id === auth()->id()
            ? auth()->user()
            : $formulario->usuario;

        if (! $usuario || $segmentos[0] !== $this->rutaBaseUsuario($usuario)) {
            return '—';
        }

        $indiceFormulario = array_search($nombreFormulario, $segmentos, true);

        return is_int($indiceFormulario) && $indiceFormulario >= 2
            ? $segmentos[$indiceFormulario - 1]
            : (count($segmentos) >= 3 ? $segmentos[count($segmentos) - 2] : '—');
    }

    public function verPdf(Formulario $formulario)
    {
        abort_unless($formulario->usuario_id === auth()->id(), 404);

        if (
            ! $formulario->pdf_path ||
            ! Storage::disk('local')->exists($formulario->pdf_path)
        ) {
            abort(404, 'El PDF no existe.');
        }

        return response()->file(
            Storage::disk('local')->path($formulario->pdf_path),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="formulario-'.$formulario->id.'.pdf"',
            ]
        );
    }

    public function editar(Formulario $formulario)
    {
        abort_unless($formulario->usuario_id === auth()->id(), 404);
        abort_if($formulario->ediciones >= 1, 403, 'Este formulario ya fue editado.');

        $vistaFormulario = self::MAPA_FORMULARIOS[$formulario->nombre_formulario] ?? null;

        abort_unless($vistaFormulario, 404, 'No se reconoce el tipo de formulario.');

        if (
            ! $formulario->datos_path ||
            ! Storage::disk('local')->exists($formulario->datos_path)
        ) {
            abort(404, 'Los datos del formulario no existen.');
        }

        try {
            $datos = json_decode(
                Storage::disk('local')->get($formulario->datos_path),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (JsonException $exception) {
            Log::error('No se pudieron leer los datos para editar el formulario.', [
                'formulario_id' => $formulario->id,
                'exception' => $exception::class,
                'message' => $exception->getMessage(),
            ]);

            abort(500, 'No se pudieron leer los datos del formulario.');
        }

        abort_unless(is_array($datos), 500, 'Los datos del formulario no tienen un formato válido.');

        return view('formularios.'.$vistaFormulario, [
            'datosEditar' => $datos,
            'formularioEditar' => $formulario,
        ]);
    }

    public function actualizar(Request $request, Formulario $formulario)
    {
        abort_unless($formulario->usuario_id === auth()->id(), 404);

        $datosValidados = $request->validate([
            'datos' => ['required', 'array', $this->reglaTamanoMaximoDatos()],
        ]);

        $nombreFormulario = $formulario->nombre_formulario;
        $vistaFormulario = self::MAPA_FORMULARIOS[$nombreFormulario] ?? null;

        abort_unless($vistaFormulario, 404, 'No se reconoce el tipo de formulario.');

        $disk = Storage::disk('local');
        $datosPath = $formulario->datos_path;

        abort_unless($datosPath, 404, 'Los datos del formulario no existen.');
        $pdfPath = $this->rutaPdfFormulario($formulario);

        $datosJson = json_encode(
            $datosValidados['datos'],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        );
        $archivoTemporal = dirname($datosPath).'/datos-'.Str::uuid().'.tmp';
        $datosOriginales = $disk->get($datosPath);

        $errorAlGuardar = null;
        $formularioActualizado = DB::transaction(function () use ($formulario, $datosJson, $archivoTemporal, $datosPath, $disk, &$errorAlGuardar): ?Formulario {
            $registro = Formulario::query()
                ->lockForUpdate()
                ->findOrFail($formulario->id);

            abort_unless($registro->usuario_id === auth()->id(), 404);
            abort_if($registro->ediciones >= 1, 403, 'Este formulario ya fue editado.');

            if (! $disk->put($archivoTemporal, $datosJson)) {
                $errorAlGuardar = 'No se pudo guardar el archivo temporal de datos.';

                return null;
            }

            if (! $disk->move($archivoTemporal, $datosPath)) {
                $errorAlGuardar = 'No se pudieron reemplazar los datos del formulario.';

                return null;
            }

            $registro->update([
                'ediciones' => 1,
            ]);

            return $registro;
        });

        if (! $formularioActualizado) {
            $disk->delete($archivoTemporal);

            Log::error('No se pudo guardar la edición del formulario.', [
                'formulario_id' => $formulario->id,
                'message' => $errorAlGuardar,
            ]);

            return response()->json([
                'success' => false,
                'datos_guardados' => false,
                'message' => $errorAlGuardar ?? 'No se pudo guardar la edición del formulario.',
            ], 500);
        }

        $this->programarGeneracionPdf(
            $formularioActualizado,
            $datosValidados['datos'],
            $vistaFormulario,
            $pdfPath
        );

        return response()->json([
            'success' => true,
            'formulario_id' => $formularioActualizado->id,
            'message' => 'Formulario actualizado. Se abrirá la impresión.',
        ]);
    }

    private function reglaTamanoMaximoDatos(): Closure
    {
        return function (string $atributo, mixed $valor, Closure $fail): void {
            $tamano = strlen(json_encode($valor, JSON_PARTIAL_OUTPUT_ON_ERROR) ?: '');

            if ($tamano > self::TAMANO_MAXIMO_DATOS) {
                $fail('Los datos del formulario superan el tamaño permitido.');
            }
        };
    }

    public function registros(Request $request)
    {
        $query = Formulario::with('usuario');

        if ($request->filled('usuario_id')) {
            $query->where('usuario_id', $request->usuario_id);
        }

        if ($request->filled('nombre_formulario')) {
            $query->where('nombre_formulario', $request->nombre_formulario);
        }

        $orden = $request->input('orden', 'desc');

        if (! in_array($orden, ['asc', 'desc'])) {
            $orden = 'desc';
        }

        $formularios = $query
            ->orderBy('created_at', $orden)
            ->get();

        $formularios->each(function (Formulario $formulario): void {
            $formulario->setAttribute(
                'identificador',
                $this->identificadorCarpeta($formulario, $formulario->nombre_formulario)
            );
        });

        $usuarios = User::orderBy('name')->get();

        $formulariosDisponibles = [
            'ENTREVISTA ESTUDIANTES',
            'FICHA DE OBSERVACIÓN',
            'FICHA DE DERIVACIÓN',
            'ENTREVISTA REPRESENTANTES',
            'ENTREVISTA DOCENTES',
            'CONSENTIMIENTO INFORMADO',
            'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
            'PLAN DE ATENCIÓN PSICOSOCIAL Y SEGUIMIENTO',
        ];

        return view(
            'formularios.registros',
            compact(
                'formularios',
                'usuarios',
                'formulariosDisponibles'
            )
        );
    }

    public function eliminar(Formulario $formulario)
    {
        DB::transaction(function () use ($formulario): void {
            $formulario->limpiarArchivos();
            $formulario->delete();
        });

        return redirect()
            ->route('formularios.registros')
            ->with(
                'success',
                'Registro y documentos eliminados correctamente.'
            );
    }

    public function guardarDocumento(Request $request)
    {
        $datos = $request->validate([
            'nombre_formulario' => [
                'required',
                'string',
                'max:255',
                Rule::in(array_keys(self::MAPA_FORMULARIOS)),
            ],
            'datos' => ['required', 'array', $this->reglaTamanoMaximoDatos()],
            'carpeta' => [
                'required',
                'string',
                'max:100',
                'regex:/^[\pL\pN][\pL\pN _()-]*$/u',
            ],
        ]);

        $nombreCarpeta = $datos['carpeta'];
        $disk = Storage::disk('local');
        $carpetasDisponibles = $this->listarCarpetasUsuario();

        if (! in_array($nombreCarpeta, $carpetasDisponibles, true)) {
            return response()->json([
                'success' => false,
                'message' => 'La carpeta seleccionada no existe en su espacio. Elija una carpeta creada por usted.',
            ], 422);
        }

        $rutaDestino = $this->rutaCarpetaUsuario($nombreCarpeta);

        if (! $disk->makeDirectory($rutaDestino)) {
            Log::error('No se pudo preparar la carpeta seleccionada para guardar el formulario.', [
                'ruta_destino' => $rutaDestino,
                'usuario_id' => auth()->id(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'No se pudo preparar la carpeta seleccionada.',
            ], 500);
        }

        $formulario = Formulario::create([
            'nombre_formulario' => $datos['nombre_formulario'],
            'usuario_id' => auth()->id(),
            'ediciones' => 0,
        ]);

        $carpetaFormulario = $rutaDestino.'/'.$datos['nombre_formulario'];
        $nombreArchivo = Str::slug($formulario->nombre_formulario).'-'.$formulario->id;
        $datosPath = $carpetaFormulario.'/'.$nombreArchivo.'.json';
        $pdfPath = $carpetaFormulario.'/'.$nombreArchivo.'.pdf';
        $datosJson = json_encode($datos['datos'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

        if (! $disk->makeDirectory($carpetaFormulario)) {
            $formulario->delete();

            Log::error('No se pudo crear la carpeta de almacenamiento del formulario.', [
                'formulario_id' => $formulario->id,
                'ruta_destino' => $carpetaFormulario,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'No se pudo preparar la carpeta para guardar el formulario.',
            ], 500);
        }

        $jsonGuardado = $disk->put(
            $datosPath,
            $datosJson
        );

        if (! $jsonGuardado) {
            $disk->delete($datosPath);
            $formulario->delete();

            Log::error('No se pudieron guardar los datos del formulario.', [
                'formulario_id' => $formulario->id,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'No se pudo guardar el formulario.',
            ], 500);
        }

        $formulario->update([
            'datos_path' => $datosPath,
        ]);

        $this->programarGeneracionPdf(
            $formulario,
            $datos['datos'],
            self::MAPA_FORMULARIOS[$datos['nombre_formulario']],
            $pdfPath
        );

        return response()->json([
            'success' => true,
            'formulario_id' => $formulario->id,
            'message' => 'Formulario guardado. Se abrirá la impresión.',
        ]);
    }

    private function rutaPdfFormulario(Formulario $formulario): string
    {
        if ($formulario->pdf_path) {
            return $formulario->pdf_path;
        }

        $carpetaDatos = dirname($formulario->datos_path);
        $nombreArchivo = Str::slug($formulario->nombre_formulario).'-'.$formulario->id.'.pdf';

        return (
            Str::startsWith($formulario->datos_path, $this->rutaBaseUsuario($formulario->usuario).'/') ||
            Str::startsWith($formulario->datos_path, 'usuarios/'.$formulario->usuario_id.'/')
        )
            ? $carpetaDatos.'/'.$nombreArchivo
            : 'formularios/'.$formulario->id.'/documento.pdf';
    }

    private function programarGeneracionPdf(Formulario $formulario, array $datos, string $vistaFormulario, string $pdfPathRelativo): void
    {
        $disk = Storage::disk('local');
        $carpeta = 'formularios/'.$formulario->id;
        $htmlPathRelativo = $carpeta.'/formulario.html';
        $pdfTemporalRelativo = $carpeta.'/documento-'.Str::uuid().'.tmp.pdf';
        $htmlPath = $disk->path($htmlPathRelativo);
        $pdfTemporal = $disk->path($pdfTemporalRelativo);
        $script = base_path('scripts/generar-pdf.cjs');

        defer(function () use ($datos, $vistaFormulario, $disk, $formulario, $carpeta, $htmlPathRelativo, $pdfPathRelativo, $pdfTemporalRelativo, $htmlPath, $pdfTemporal, $script): void {
            try {
                $html = view('formularios.'.$vistaFormulario)->render();

                foreach (['images/logo-apch.png', 'images/ecuador-resuelve.png'] as $imagen) {
                    $rutaImagen = public_path($imagen);

                    if (! is_file($rutaImagen)) {
                        continue;
                    }

                    $html = str_replace(
                        asset($imagen),
                        'data:image/png;base64,'.base64_encode(file_get_contents($rutaImagen)),
                        $html
                    );
                }

                $datosJson = json_encode(
                    $datos,
                    JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR
                );
                $scriptDatos = '<script type="application/json" id="datos-formulario-pdf">'.$datosJson.'</script>';
                $posicionCierreBody = strripos($html, '</body>');

                if ($posicionCierreBody === false) {
                    Log::error('No se pudo preparar el formulario para generar el PDF.', [
                        'formulario_id' => $formulario->id,
                    ]);

                    return;
                }

                $html = substr_replace($html, $scriptDatos, $posicionCierreBody, 0);

                if (! $disk->put($htmlPathRelativo, $html)) {
                    Log::error('No se pudo guardar el HTML temporal del formulario.', [
                        'formulario_id' => $formulario->id,
                    ]);

                    return;
                }

                $resultado = Process::path(base_path())
                    ->timeout(60)
                    ->env([
                        'CHROME_PATH' => (string) config('services.pdf.chrome_path'),
                        'PDF_SANDBOX' => config('services.pdf.sandbox') ? '1' : '0',
                    ])
                    ->run(['node', $script, $htmlPath, $pdfTemporal]);

                if (! $resultado->successful() || ! $disk->exists($pdfTemporalRelativo) || $disk->size($pdfTemporalRelativo) === 0) {
                    Log::error('Falló la generación del PDF del formulario.', [
                        'formulario_id' => $formulario->id,
                        'exit_code' => $resultado->exitCode(),
                        'error_output' => mb_substr(trim($resultado->errorOutput()), 0, 4000),
                    ]);

                    return;
                }

                if (! $disk->move($pdfTemporalRelativo, $pdfPathRelativo)) {
                    Log::error('No se pudo reemplazar el PDF del formulario.', [
                        'formulario_id' => $formulario->id,
                    ]);

                    return;
                }

                $formulario->update([
                    'pdf_path' => $pdfPathRelativo,
                ]);
            } catch (ProcessTimedOutException|ProcessStartFailedException $exception) {
                Log::error('Falló la generación del PDF del formulario.', [
                    'formulario_id' => $formulario->id,
                    'exception' => $exception::class,
                    'message' => $exception->getMessage(),
                ]);
            } finally {
                $disk->delete($htmlPathRelativo);
                $disk->delete($pdfTemporalRelativo);

                if (
                    ! Str::startsWith($pdfPathRelativo, $carpeta.'/') &&
                    $disk->directoryExists($carpeta) &&
                    $disk->files($carpeta) === [] &&
                    $disk->directories($carpeta) === []
                ) {
                    $disk->deleteDirectory($carpeta);
                }
            }
        });
    }
}
