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

Route::get('/export/purchased-data', function() {
    $submissions = \App\Models\PurchasedVehicleForm::orderBy('created_at', 'desc')->get();

    // Encabezados con todos los campos
    $output = "ID\tNombre\tApellido\tSegundo Apellido\tGénero\tNacionalidad\tDocumento ID\tFecha Nacimiento\tTeléfono\tEmail\tQuiere Promociones\tPromo WhatsApp\tPromo Email\tPromo SMS\tSin Promociones\tCiudad\tBarrio\tDirección Completa\tEstado Civil\tTiene Hijos\tNúmero de Hijos\tCampo de Trabajo\tNombre Asesor\tVehículo Comprado\tCaracterística Atractiva\tHobbies\tNivel Educación\tConductor Principal\tFecha Creación\tFecha Actualización\n";

    foreach($submissions as $sub) {
        // Procesar hobbies (JSON)
        $hobbies = '';
        if ($sub->hobbies) {
            if (is_string($sub->hobbies)) {
                $hobbiesArray = json_decode($sub->hobbies, true);
                $hobbies = is_array($hobbiesArray) ? implode(', ', $hobbiesArray) : $sub->hobbies;
            } else if (is_array($sub->hobbies)) {
                $hobbies = implode(', ', $sub->hobbies);
            }
        }

        $output .= implode("\t", [
                $sub->id ?? '',
                $sub->first_name ?? '',
                $sub->last_name ?? '',
                $sub->second_last_name ?? '',
                $sub->gender ?? '',
                $sub->nationality ?? '',
                $sub->id_document ?? '',
                $sub->birth_date ?? '',
                $sub->mobile_phone ?? '',
                $sub->email ?? '',
                $sub->wants_promotions ? 'Sí' : 'No',
                $sub->promo_whatsapp ? 'Sí' : 'No',
                $sub->promo_email ? 'Sí' : 'No',
                $sub->promo_sms ? 'Sí' : 'No',
                $sub->no_promotions ? 'Sí' : 'No',
                $sub->city ?? '',
                $sub->neighborhood ?? '',
                str_replace(["\n", "\r", "\t"], ' ', $sub->full_address ?? ''),
                $sub->marital_status ?? '',
                $sub->has_children ? 'Sí' : 'No',
                $sub->number_of_children ?? '',
                $sub->work_field ?? '',
                $sub->sales_advisor_name ?? '',
                $sub->purchased_vehicle ?? '',
                str_replace(["\n", "\r", "\t"], ' ', $sub->vehicle_attractive_feature ?? ''),
                $hobbies,
                $sub->education_level ?? '',
                $sub->main_driver ?? '',
                $sub->created_at ? $sub->created_at->format('d/m/Y H:i:s') : '',
                $sub->updated_at ? $sub->updated_at->format('d/m/Y H:i:s') : ''
            ]) . "\n";
    }

    return response($output, 200, [
        'Content-Type' => 'text/plain; charset=utf-8',
    ]);
});
