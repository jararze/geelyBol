<?php

use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/form-submissions', function() {
    return response()->json([
        'test_drive' => FormSubmission::where('tipo_formulario', 'test-drive')->get(),
        'cotizaciones' => FormSubmission::where('tipo_formulario', 'cotizacion')->get(),
        'consultas' => FormSubmission::where('tipo_formulario', 'consulta')->get(),
        'resumen' => FormSubmission::selectRaw('
            tipo_formulario,
            COUNT(*) as total,
            COUNT(CASE WHEN DATE(created_at) = CURDATE() THEN 1 END) as hoy,
            COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN 1 END) as esta_semana
        ')->groupBy('tipo_formulario')->get()
    ]);
});

Route::get('/export/excel-data', function() {
    $submissions = \App\Models\FormSubmission::orderBy('created_at', 'desc')->get();

    $output = "ID\tFecha\tTipo\tNombre\tEmail\tTelefono\tCiudad\tVehiculo\tMensaje\tOfertas\n";

    foreach($submissions as $sub) {
        $output .= implode("\t", [
                $sub->id,
                $sub->created_at->format('d/m/Y H:i'),
                $sub->tipo_formulario,
                $sub->nombre,
                $sub->email,
                $sub->codigo_pais . ' ' . $sub->telefono,
                $sub->ciudad,
                $sub->vehiculo ?? '',
                str_replace(["\n", "\r", "\t"], ' ', $sub->mensaje ?? ''),
                $sub->receive_offers ? 'Sí' : 'No'
            ]) . "\n";
    }

    return response($output, 200, [
        'Content-Type' => 'text/plain; charset=utf-8'
    ]);
});
