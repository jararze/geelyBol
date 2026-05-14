<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $leadForm->name }}</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif; background-color: #f7f7f9; color: #1f2937;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f7f7f9; padding: 20px 0;">
    <tr>
        <td align="center">
            <table role="presentation" width="640" cellpadding="0" cellspacing="0" style="background: #ffffff; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
                <tr>
                    <td style="background: linear-gradient(135deg, #1e40af, #1d4ed8); padding: 24px 32px;">
                        <h1 style="margin: 0; color: #ffffff; font-size: 22px;">Nuevo lead recibido</h1>
                        <p style="margin: 4px 0 0; color: #dbeafe; font-size: 14px;">Formulario: {{ $leadForm->name }}</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 28px 32px;">
                        <p style="margin: 0 0 18px; color: #4b5563; font-size: 14px;">
                            Recibido el <strong>{{ $lead->created_at?->format('d/m/Y H:i') }}</strong>
                            @if ($lead->ip_address)
                                desde IP <code style="background:#f3f4f6; padding:2px 4px; border-radius:4px;">{{ $lead->ip_address }}</code>
                            @endif
                        </p>

                        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                            @foreach ($lead->data ?? [] as $key => $value)
                                @php($label = $fieldLabels[$key] ?? $key)
                                @php($displayValue = is_array($value) ? implode(', ', array_map(fn($v) => is_scalar($v) ? (string)$v : json_encode($v), $value)) : (is_bool($value) ? ($value ? 'Si' : 'No') : (string) $value))
                                <tr>
                                    <td style="padding: 8px 12px 8px 0; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 13px; vertical-align: top; width: 35%;">
                                        {{ $label }}
                                    </td>
                                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; color: #111827; font-size: 14px; font-weight: 500; vertical-align: top;">
                                        {{ $displayValue !== '' ? $displayValue : '—' }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <div style="text-align: center; margin-top: 28px;">
                            <a href="{{ $adminUrl }}"
                               style="display: inline-block; padding: 12px 24px; background: #1d4ed8; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
                                Ver en panel admin
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="background: #f9fafb; padding: 16px 32px; text-align: center; color: #9ca3af; font-size: 12px;">
                        Geely Bolivia · Sistema automatizado · No respondas a este correo
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
