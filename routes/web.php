<?php

use App\Livewire\Front\CustomerRegistrationForm;
use App\Livewire\Front\FormDetail;
use App\Livewire\Front\Fortune;
use App\Livewire\Front\Thanks;
use App\Livewire\Front\VehicleDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/vehiculos/{category}/{slug}', VehicleDetail::class)->name('vehicle.detail');
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
        'email' => 'test@test.com',
        'mobile_phone' => '77777777',
        'purchased_vehicle' => 'starray',
        'sales_advisor_name' => 'Asesor Test',
        'city' => 'La Paz',
        'full_address' => 'Av. Test 123',
        'created_at' => now(),
    ];

    try {
        $emails = array_map('trim', explode(',', env('GEELY_NOTIFICATION_EMAILS', 'pcarrasco@nissan.com.bo')));
        foreach ($emails as $email) {
            Mail::to($email)->send(new \App\Mail\PurchasedVehicleFormNotification($testData));
        }
        return 'Emails individuales enviados correctamente a: ' . implode(', ', $emails);
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
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
