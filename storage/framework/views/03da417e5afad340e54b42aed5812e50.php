<?php
    $vehicleMap = [
        'starray' => 'Starray',
        'gx3-pro' => 'GX3 Pro',
        'cityray' => 'Cityray',
        'coolray' => 'Coolray Lite',
    ];

    $fullName = trim(
        ($data['first_name'] ?? '') . ' ' .
        ($data['last_name'] ?? '') . ' ' .
        ($data['second_last_name'] ?? '')
    );

    $vehicleKey = $data['purchased_vehicle'] ?? '';
    $vehicleLabel = $vehicleMap[$vehicleKey] ?? $vehicleKey;

    $createdAt = $data['created_at'] ?? now();
    if (!($createdAt instanceof \DateTimeInterface)) {
        try {
            $createdAt = \Carbon\Carbon::parse($createdAt);
        } catch (\Throwable $e) {
            $createdAt = now();
        }
    }
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
                                A continuación los datos principales:
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;font-size:14px;">
                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Datos del cliente
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;width:40%;">Nombre completo</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;font-weight:bold;"><?php echo e($fullName ?: '—'); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Email</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;">
                                        <a href="mailto:<?php echo e($data['email'] ?? ''); ?>" style="color:#1e5bb8;text-decoration:none;"><?php echo e($data['email'] ?? '—'); ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Teléfono</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($data['mobile_phone'] ?? '—'); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Vehículo y asesor
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Vehículo comprado</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#1e5bb8;font-weight:bold;"><?php echo e($vehicleLabel ?: '—'); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Asesor de ventas</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($data['sales_advisor_name'] ?? '—'); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Dirección
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Ciudad</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($data['city'] ?? '—'); ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#666666;">Dirección completa</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #eeeeee;color:#111111;"><?php echo e($data['full_address'] ?? '—'); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="background-color:#000000;color:#ffffff;padding:10px 14px;font-weight:bold;font-size:13px;letter-spacing:0.5px;text-transform:uppercase;">
                                        Registro
                                    </td>
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