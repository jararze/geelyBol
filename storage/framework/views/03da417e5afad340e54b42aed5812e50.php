<?php
    $vehicleMap = [
        'starray' => 'Starray',
        'gx3-pro' => 'GX3 Pro',
        'cityray' => 'Cityray',
        'coolray' => 'Coolray Lite',
    ];

    $genderMap = [
        'masculino' => 'Masculino',
        'femenino' => 'Femenino',
        'otro' => 'Otro',
    ];

    $maritalStatusMap = [
        'soltero' => 'Soltero',
        'casado' => 'Casado',
        'divorciado' => 'Divorciado',
        'viudo' => 'Viudo',
    ];

    $educationLevelMap = [
        'primaria' => 'Primaria',
        'secundaria' => 'Secundaria',
        'universitario' => 'Universitario',
        'postgrado' => 'Postgrado',
    ];

    $mainDriverMap = [
        'yo' => 'Yo mismo',
        'conyuge' => 'Cónyuge',
        'hijo' => 'Hijo(a)',
        'otro' => 'Otro',
    ];

    $fullName = trim(
        ($data['first_name'] ?? '') . ' ' .
        ($data['last_name'] ?? '') . ' ' .
        ($data['second_last_name'] ?? '')
    );

    $vehicleKey = $data['purchased_vehicle'] ?? '';
    $vehicleLabel = $vehicleMap[$vehicleKey] ?? $vehicleKey;

    $genderLabel = $genderMap[$data['gender'] ?? ''] ?? ($data['gender'] ?? '');
    $maritalStatusLabel = $maritalStatusMap[$data['marital_status'] ?? ''] ?? ($data['marital_status'] ?? '');
    $educationLevelLabel = $educationLevelMap[$data['education_level'] ?? ''] ?? ($data['education_level'] ?? '');
    $mainDriverLabel = $mainDriverMap[$data['main_driver'] ?? ''] ?? ($data['main_driver'] ?? '');

    $birthDate = $data['birth_date'] ?? null;
    if ($birthDate && !($birthDate instanceof \DateTimeInterface)) {
        try {
            $birthDate = \Carbon\Carbon::parse($birthDate);
        } catch (\Throwable $e) {
            $birthDate = null;
        }
    }

    $createdAt = $data['created_at'] ?? now();
    if (!($createdAt instanceof \DateTimeInterface)) {
        try {
            $createdAt = \Carbon\Carbon::parse($createdAt);
        } catch (\Throwable $e) {
            $createdAt = now();
        }
    }

    $hobbies = $data['hobbies'] ?? null;
    if (is_string($hobbies)) {
        $decoded = json_decode($hobbies, true);
        $hobbies = is_array($decoded) ? $decoded : array_filter(array_map('trim', explode(',', $hobbies)));
    }
    if (!is_array($hobbies)) {
        $hobbies = [];
    }

    $boolLabel = function ($value) {
        if (is_null($value) || $value === '') {
            return '—';
        }
        return filter_var($value, FILTER_VALIDATE_BOOLEAN) ? 'Sí' : 'No';
    };

    $valueOrDash = function ($value) {
        if (is_null($value) || $value === '') {
            return '—';
        }
        return $value;
    };
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo registro de cliente Geely</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,Helvetica,sans-serif;color:#111111;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="620" cellpadding="0" cellspacing="0" style="max-width:620px;width:100%;background-color:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                    <tr>
                        <td style="background-color:#000000;padding:28px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="color:#ffffff;font-size:22px;font-weight:bold;letter-spacing:1px;">
                                        GEELY BOLIVIA
                                    </td>
                                    <td align="right" style="color:#1e5bb8;font-size:13px;font-weight:bold;">
                                        Nuevo registro
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color:#1e5bb8;height:4px;line-height:4px;font-size:0;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td style="padding:32px;">
                            <h2 style="margin:0 0 8px 0;color:#000000;font-size:20px;">Registro de cliente recibido</h2>
                            <p style="margin:0 0 24px 0;color:#444444;font-size:14px;line-height:1.5;">
                                Se ha registrado un nuevo cliente a través del formulario en <strong>/clientegeely</strong>.
                                A continuación el detalle completo del registro:
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;font-size:14px;">
                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Datos personales
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;width:40%;">Nombre completo</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;font-weight:bold;"><?php echo e($fullName ?: '—'); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Sexo</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($genderLabel)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Nacionalidad</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['nationality'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Carnet / Pasaporte</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['id_document'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Fecha de nacimiento</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($birthDate ? $birthDate->format('d/m/Y') : '—'); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Teléfono móvil</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['mobile_phone'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Correo electrónico</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($data['email'])): ?>
                                            <a href="mailto:<?php echo e($data['email']); ?>" style="color:#1e5bb8;text-decoration:none;"><?php echo e($data['email']); ?></a>
                                        <?php else: ?>
                                            —
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Preferencias de comunicación
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">WhatsApp</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($boolLabel($data['promo_whatsapp'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Email</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($boolLabel($data['promo_email'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">SMS</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($boolLabel($data['promo_sms'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">No desea promociones</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($boolLabel($data['no_promotions'] ?? null)); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Dirección
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Ciudad</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['city'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Zona / Barrio</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['neighborhood'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Dirección completa</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['full_address'] ?? null)); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Información familiar
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Estado civil</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($maritalStatusLabel)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Tiene hijos</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($boolLabel($data['has_children'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Número de hijos</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['number_of_children'] ?? null)); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Información laboral y vehículo
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Campo laboral</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['work_field'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Asesor de ventas</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['sales_advisor_name'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Vehículo adquirido</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#1e5bb8;font-weight:bold;"><?php echo e($vehicleLabel ?: '—'); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Característica atractiva</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['vehicle_attractive_feature'] ?? null)); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Información opcional
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;vertical-align:top;">Aficiones</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($hobbies) > 0): ?>
                                            <ul style="margin:0;padding-left:18px;">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $hobbies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hobby): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li style="margin:2px 0;"><?php echo e($hobby); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </ul>
                                        <?php else: ?>
                                            —
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Nivel de estudios</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($educationLevelLabel)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Conductor principal</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($mainDriverLabel)); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Registro
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Dirección IP</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($valueOrDash($data['ip_address'] ?? null)); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;color:#666666;">Fecha de registro</td>
                                    <td style="padding:10px 14px;color:#111111;"><?php echo e($createdAt->format('d/m/Y H:i')); ?></td>
                                </tr>
                            </table>

                            <p style="margin:28px 0 0 0;color:#888888;font-size:12px;line-height:1.5;">
                                Este correo fue generado automáticamente por el sitio web de Geely Bolivia.
                                Para consultar el registro completo, ingresar al panel de administración.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color:#f4f4f4;padding:16px 32px;text-align:center;color:#999999;font-size:11px;">
                            © <?php echo e(date('Y')); ?> Geely Bolivia · geely@teknicos.com.bo
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH C:\Users\jarar\Herd\geely-site\resources\views/emails/purchased-vehicle-notification.blade.php ENDPATH**/ ?>