<?php

namespace Database\Seeders;

use App\Models\LeadForm;
use App\Models\LeadFormField;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class ClienteGeelyLeadFormSeeder extends Seeder
{
    public function run(): void
    {
        $form = LeadForm::updateOrCreate(
            ['slug' => 'cliente-geely'],
            [
                'name' => 'Registro de Cliente - Vehículo Adquirido',
                'description' => 'Complete el siguiente formulario con sus datos personales para mejorar nuestro servicio posventa.',
                'success_message' => '¡Gracias! Hemos registrado tus datos correctamente. Te contactaremos pronto.',
                'submit_button_text' => 'Registrar Información',
                'notification_emails' => [],
                'email_subject' => 'Nuevo registro de cliente - {form_name}',
                'public_url' => 'clientegeely-nuevo',
                'send_confirmation_to_user' => true,
                'confirmation_email_field' => 'email',
                'is_active' => true,
            ]
        );

        $form->fields()->delete();

        $vehicleOptions = $this->vehicleOptions();
        $cityOptions = $this->makeOptions([
            'La Paz', 'Santa Cruz', 'Cochabamba', 'Oruro', 'Potosí',
            'Tarija', 'Sucre', 'Trinidad', 'El Alto',
        ]);

        $fields = [
            // Sección: Datos Personales
            ['type' => 'text', 'name' => 'nombre', 'label' => 'Nombre', 'is_required' => true, 'section' => 'Datos Personales', 'width' => 'half'],
            ['type' => 'text', 'name' => 'apellido_paterno', 'label' => 'Apellido Paterno', 'is_required' => true, 'section' => 'Datos Personales', 'width' => 'half'],
            ['type' => 'text', 'name' => 'apellido_materno', 'label' => 'Apellido Materno', 'is_required' => true, 'section' => 'Datos Personales', 'width' => 'half'],
            ['type' => 'select', 'name' => 'sexo', 'label' => 'Sexo', 'is_required' => true, 'section' => 'Datos Personales', 'width' => 'half',
                'options' => $this->makeOptions(['Masculino', 'Femenino', 'Otro'])],
            ['type' => 'select', 'name' => 'nacionalidad', 'label' => 'Nacionalidad', 'is_required' => true, 'section' => 'Datos Personales', 'width' => 'half',
                'options' => $this->makeOptions(['Boliviana', 'Argentina', 'Brasileña', 'Chilena', 'Peruana', 'Colombiana', 'Ecuatoriana', 'Paraguaya', 'Uruguaya', 'Otra']),
                'default_value' => 'Boliviana'],
            ['type' => 'text', 'name' => 'documento', 'label' => 'Carnet de Identidad / Pasaporte', 'is_required' => true, 'section' => 'Datos Personales', 'width' => 'half'],
            ['type' => 'date', 'name' => 'fecha_nacimiento', 'label' => 'Fecha de Nacimiento', 'is_required' => true, 'section' => 'Datos Personales', 'width' => 'half'],
            ['type' => 'tel', 'name' => 'telefono', 'label' => 'Número de Teléfono Móvil', 'is_required' => true, 'section' => 'Datos Personales', 'width' => 'half'],
            ['type' => 'email', 'name' => 'email', 'label' => 'Email', 'is_required' => true, 'section' => 'Datos Personales', 'width' => 'full',
                'help_text' => 'Para mensajes importantes (Facturas, documentos, alertas, etc.)'],

            // Sección: Preferencias de Comunicación
            ['type' => 'paragraph', 'name' => 'comunicacion_intro', 'label' => '¿Desea recibir promociones y ofertas especiales de posventa para su vehículo?', 'section' => 'Preferencias de Comunicación', 'width' => 'full'],
            ['type' => 'checkbox_group', 'name' => 'canales_comunicacion', 'label' => 'Canales de comunicación preferidos', 'section' => 'Preferencias de Comunicación', 'width' => 'full',
                'options' => $this->makeOptions(['Mediante WhatsApp', 'Mediante Email', 'Mediante SMS', 'No deseo recibir promociones'])],

            // Sección: Dirección de Residencia
            ['type' => 'select', 'name' => 'ciudad', 'label' => 'Ciudad', 'is_required' => true, 'section' => 'Dirección de Residencia', 'width' => 'half', 'options' => $cityOptions],
            ['type' => 'text', 'name' => 'zona', 'label' => 'Zona o Barrio de Domicilio', 'is_required' => true, 'section' => 'Dirección de Residencia', 'width' => 'half'],
            ['type' => 'textarea', 'name' => 'direccion', 'label' => 'Dirección Completa de Domicilio', 'is_required' => true, 'section' => 'Dirección de Residencia', 'width' => 'full'],

            // Sección: Información Familiar
            ['type' => 'select', 'name' => 'estado_civil', 'label' => 'Estado Civil', 'is_required' => true, 'section' => 'Información Familiar', 'width' => 'half',
                'options' => $this->makeOptions(['Soltero/a', 'Casado/a', 'Divorciado/a', 'Viudo/a'])],
            ['type' => 'radio', 'name' => 'tiene_hijos', 'label' => '¿Tiene hijos?', 'is_required' => true, 'section' => 'Información Familiar', 'width' => 'half',
                'options' => $this->makeOptions(['Sí', 'No'])],

            // Sección: Información Laboral y Vehículo
            ['type' => 'text', 'name' => 'profesion', 'label' => 'Campo de Ejercicio Laboral', 'is_required' => true, 'section' => 'Información Laboral y Vehículo', 'width' => 'half'],
            ['type' => 'text', 'name' => 'asesor_ventas', 'label' => 'Nombre de su Asesor Profesional de Ventas', 'is_required' => true, 'section' => 'Información Laboral y Vehículo', 'width' => 'half'],
            ['type' => 'select', 'name' => 'vehiculo', 'label' => 'Vehículo Adquirido', 'is_required' => true, 'section' => 'Información Laboral y Vehículo', 'width' => 'full',
                'options' => $vehicleOptions],
            ['type' => 'textarea', 'name' => 'caracteristica_atractiva', 'label' => '¿Qué característica del vehículo adquirido le llamó más la atención?', 'is_required' => true, 'section' => 'Información Laboral y Vehículo', 'width' => 'full'],

            // Sección: Preguntas Opcionales
            ['type' => 'checkbox_group', 'name' => 'aficiones', 'label' => 'Aficiones', 'section' => 'Preguntas Opcionales', 'width' => 'full',
                'options' => $this->makeOptions([
                    'Fútbol', 'Otros deportes', 'Música', 'Películas series y cine',
                    'Videojuegos', 'Literatura y lectura', 'Viajes y turismo',
                    'Aventura y adrenalina', 'Pintura escultura y artes plásticas',
                    'Manualidades jardinería otros', 'Mascotas', 'Cocina comida y bebida',
                ])],
            ['type' => 'select', 'name' => 'estudios', 'label' => 'Estudios (Marque el nivel que completó)', 'section' => 'Preguntas Opcionales', 'width' => 'half',
                'options' => $this->makeOptions(['Primaria', 'Secundaria', 'Universitario', 'Postgrado'])],
            ['type' => 'radio', 'name' => 'conductor', 'label' => '¿Quién conducirá el vehículo?', 'section' => 'Preguntas Opcionales', 'width' => 'full',
                'options' => $this->makeOptions([
                    'Yo conduciré el vehículo generalmente',
                    'Mi cónyuge conducirá el vehículo generalmente',
                    'Mi hijo/hija conducirá el vehículo generalmente',
                    'Otra persona conducirá el vehículo generalmente',
                ])],
        ];

        foreach ($fields as $index => $f) {
            $f['order'] = $index + 1;
            $f['lead_form_id'] = $form->id;
            LeadFormField::create($f);
        }

        $this->command?->info("Lead Form 'cliente-geely' creado con " . count($fields) . ' campos.');
    }

    protected function makeOptions(array $labels): array
    {
        $opts = [];
        foreach ($labels as $label) {
            $opts[] = ['label' => $label, 'value' => $label];
        }
        return $opts;
    }

    protected function vehicleOptions(): array
    {
        $vehicles = Vehicle::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['slug', 'name']);

        if ($vehicles->isEmpty()) {
            return $this->makeOptions(['Starray', 'GX3 Pro', 'Cityray', 'Coolray Lite']);
        }

        return $vehicles->map(fn ($v) => ['label' => $v->name, 'value' => $v->slug])->all();
    }
}
