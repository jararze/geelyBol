<?php

use App\Livewire\Front\CustomerRegistrationForm;
use App\Livewire\Front\FormDetail;
use App\Livewire\Front\Fortune;
use App\Livewire\Front\Thanks;
use App\Livewire\Front\VehicleDetail;
use App\Livewire\Front\VehicleShow;
use App\Mail\PurchasedVehicleFormNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/vehiculos/{category}/{slug}', VehicleDetail::class)->name('vehicle.detail');
Route::get('/vehiculo/{slug}', VehicleShow::class)->name('vehicle.show');
Route::get('/fortuna', Fortune::class)->name('fortune');

Route::get('/forms', FormDetail::class)->name('forms.base');
Route::get('/forms/{category}', FormDetail::class)->name('forms.category');
Route::get('/forms/{category}/{slug}', FormDetail::class)->name('forms.detail');

// Páginas de agradecimiento (Livewire)
Route::get('/gracias', Thanks::class)->name('forms.thanks');
Route::get('/forms/{category}/{slug}/enviado', Thanks::class)->name('forms.thanks.vehicle');

Route::get('/clientegeely', CustomerRegistrationForm::class)->name('purchased.vehicle.form');
Route::get('/clientegeely/gracias', Thanks::class)->name('purchased.vehicle.thanks');

// TODO: eliminar antes de desplegar a producción — ruta temporal para probar envío SMTP.
Route::get('/test-email', function () {
    $testData = [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'second_last_name' => 'García',
        'gender' => 'masculino',
        'nationality' => 'Boliviana',
        'id_document' => '1234567 LP',
        'birth_date' => '1990-05-15',
        'mobile_phone' => '77777777',
        'email' => 'test@test.com',
        'promo_whatsapp' => true,
        'promo_email' => true,
        'promo_sms' => false,
        'no_promotions' => false,
        'city' => 'La Paz',
        'neighborhood' => 'Zona Sur - Calacoto',
        'full_address' => 'Av. Test 123, entre calle 10 y calle 11',
        'marital_status' => 'casado',
        'has_children' => true,
        'number_of_children' => 2,
        'work_field' => 'Tecnología / Ingeniería',
        'sales_advisor_name' => 'Asesor Test',
        'purchased_vehicle' => 'starray',
        'vehicle_attractive_feature' => 'Diseño moderno y tecnología avanzada',
        'hobbies' => ['Deportes', 'Música', 'Viajes'],
        'education_level' => 'universitario',
        'main_driver' => 'yo',
        'ip_address' => '127.0.0.1',
        'created_at' => now(),
    ];

    try {
        Mail::to('jararze@gmail.com')
            ->send(new PurchasedVehicleFormNotification($testData));

        return 'Email de prueba enviado correctamente a: jararze@gmail.com';
    } catch (Exception $e) {
        return 'Error: '.$e->getMessage();
    }
})->name('test.email');

Route::middleware(['auth'])->group(function () {

    Route::view('dashboard', 'dashboard')->name('dashboard');

    Volt::route('backend/upload', 'backend.upload')->name('upload');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
