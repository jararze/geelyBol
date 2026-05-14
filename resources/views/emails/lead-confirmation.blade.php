<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hemos recibido tu información - Geely Bolivia</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif; background-color: #f7f7f9; color: #1f2937;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f7f7f9; padding: 20px 0;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background: #ffffff; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
                <tr>
                    <td style="background: linear-gradient(135deg, #1e40af, #1d4ed8); padding: 28px 32px; text-align: center;">
                        <h1 style="margin: 0; color: #ffffff; font-size: 24px;">¡Gracias por contactarnos!</h1>
                        <p style="margin: 6px 0 0; color: #dbeafe; font-size: 14px;">Geely Bolivia</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 28px 32px;">
                        <p style="margin: 0 0 16px; color: #111827; font-size: 16px;">
                            Hola{{ $customerName ? ' ' . $customerName : '' }},
                        </p>
                        <p style="margin: 0 0 16px; color: #4b5563; font-size: 14px; line-height: 1.6;">
                            Hemos recibido correctamente tu información a través del formulario
                            <strong>{{ $leadForm->name }}</strong>.
                        </p>
                        <p style="margin: 0 0 16px; color: #4b5563; font-size: 14px; line-height: 1.6;">
                            Un miembro de nuestro equipo se pondrá en contacto contigo en las próximas horas
                            para continuar con el proceso.
                        </p>
                        <p style="margin: 0 0 24px; color: #4b5563; font-size: 14px; line-height: 1.6;">
                            Si tienes alguna duda urgente, puedes escribirnos a
                            <a href="mailto:contacto@geely.com.bo" style="color: #1d4ed8;">contacto@geely.com.bo</a>
                            o visitarnos en cualquiera de nuestras sucursales.
                        </p>
                        <div style="border-top: 1px solid #e5e7eb; padding-top: 16px; color: #6b7280; font-size: 13px;">
                            Saludos cordiales,<br>
                            <strong style="color: #111827;">Equipo Geely Bolivia</strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="background: #f9fafb; padding: 16px 32px; text-align: center; color: #9ca3af; font-size: 12px;">
                        Este correo se generó automáticamente · No respondas a este mensaje
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
