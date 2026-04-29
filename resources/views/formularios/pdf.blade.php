<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte_Folio_{{ $formulario->id }}</title>
    <style>
        /* Estilos compatibles con DomPDF (CSS tradicional) */
        @page { margin: 1cm; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #335535; font-size: 12px; line-height: 1.4; }
        .header { border-bottom: 3px solid #0f172a; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; color: #0f2a10; margin: 0; }
        .subtitle { font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
        
        .section-title { background: #9aff864b; padding: 5px 10px; font-weight: bold; text-transform: uppercase; font-size: 10px; color: #003807; margin-top: 20px; border-left: 4px solid #0a7e00; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { text-align: left; font-size: 10px; color: #64748b; text-transform: uppercase; padding: 8px; border-bottom: 1px solid #e2e8f0; }
        td { padding: 8px; border-bottom: 1px solid #f1f5f9; }
        
        .grid-container { width: 100%; }
        .col { width: 50%; vertical-align: top; }
        
        .stat-box { margin-bottom: 10px; }
        .label { font-size: 9px; text-transform: uppercase; color: #94a3b8; font-weight: bold; }
        .value { font-size: 14px; font-weight: bold; color: #1e293b; }
        .metrics-table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        .metrics-table td { width: 50%; vertical-align: top; border: none; padding: 0; }
        
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 9px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 5px; }
        .percentage { font-size: 20px; color: #0a7e00; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <table style="border: none;">
            <tr>
                <td style="border: none; width: 70%;">
                    <h1 class="title">FOLIO #{{ str_pad($formulario->id, 4, '0', STR_PAD_LEFT) }}</h1>
                    <span class="subtitle">Sudo-Trash • Reporte de Recolección</span>
                </td>
                <td style="border: none; width: 30%; text-align: right;">
                    <div class="label">Fecha de Captura</div>
                    <div class="value">{{ $formulario->fecha_captura }}</div>
                </td>
            </tr>
        </table>
    </div>

    <table class="grid-container">
        <tr>
            <td class="col">
                <div class="section-title">Control de Operación</div>
                <div class="stat-box">
                    <div class="label">Fecha de Orden</div>
                    <div class="value">{{ $formulario->fecha_orden }}</div>
                </div>
                <div class="stat-box">
                    <div class="label">Turno</div>
                    <div class="value">{{ $formulario->turno->horario }}</div>
                </div>
                <div class="stat-box">
                    <div class="label">Ruta Atendida</div>
                    <div class="value">Ruta {{ $formulario->ruta->numero }}</div>
                </div>
            </td>
            <td class="col">
                <div class="section-title">Eficiencia y Cobertura</div>
                <div style="text-align: center; padding: 10px;">
                    <div class="percentage">{{ $formulario->porcentaje_realizado }}%</div>
                    <div class="label">Cobertura Total</div>
                </div>
                <table class="metrics-table">
                    <tr>
                        <td>
                            <div class="stat-box">
                                <div class="label">Kg Recolectados</div>
                                <div class="value">{{ number_format($formulario->cantidad_kg) }} kg</div>
                            </div>
                        </td>
                        <td>
                            <div class="stat-box">
                                <div class="label">Puches</div>
                                <div class="value">{{ $formulario->puches }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">Equipo Asignado</div>
    <table>
        <tr>
            <td><div class="label">Unidad</div><div class="value">{{ $formulario->unidad->nombre }} (#{{ $formulario->unidad->numero }})</div></td>
            <td><div class="label">Chofer</div><div class="value">{{ $formulario->chofer->nombre }}</div></td>
            <td><div class="label">Despachador</div><div class="value">{{ $formulario->despachador->nombre }}</div></td>
        </tr>
    </table>

    <div class="section-title">Combustible y Kilometraje</div>
    <table>
        <tr>
            <th>Inicial</th>
            <th>Cargado</th>
            <th>Final</th>
            <th style="background: #deffcb8e;">Total Usado</th>
        </tr>
        <tr>
            <td>{{ $formulario->diesel_inicial }} Lts</td>
            <td>{{ $formulario->diesel_cargado }} Lts</td>
            <td>{{ $formulario->diesel_final }} Lts</td>
            <td style="background: #deffcb8e; font-weight: bold;">{{ $formulario->diesel_usado }} Lts</td>
        </tr>
    </table>

    <table style="margin-top: 20px;">
        <tr>
            <th>Km Inicial</th>
            <th>Km Final</th>
            <th style="background: #deffcb8e;">Total Km</th>
        </tr>
        <tr>
            <td>{{ $formulario->km_salida }} km</td>
            <td>{{ $formulario->km_entrada }} km</td>
            <td style="background: #deffcb8e; font-weight: bold;">{{ $formulario->km_total }} km</td>
        </tr>
    </table>

    <div class="section-title">Colonias Atendidas</div>
    <table>
        <thead>
            <tr>
                <th>Nombre de la Colonia</th>
                <th style="text-align: center;">Habitantes</th>
                <th style="text-align: right;">Cobertura</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formulario->colonias as $colonia)
            <tr>
                <td style="font-weight: bold;">{{ $colonia->nombre }}</td>
                <td style="text-align: center;">{{ $colonia->habitantes ?? 0 }}</td>
                <td style="text-align: right; color: #0a7e00; font-weight: bold;">{{ $colonia->pivot->porcentaje }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($formulario->comentarios)
    <div class="section-title">Observaciones</div>
    <p style="font-style: italic; color: #000000; padding: 10px; background: #fffbeb;">
        "{{ $formulario->comentarios }}"
    </p>
    @endif

    <div class="footer">
        Generado por Sudo-Trash - {{ now()->format('d/m/Y H:i:s') }} - Responsable: {{ $formulario->usuario->name ?? 'N/A' }} {{ $formulario->usuario->lastname ?? ' ' }}
    </div>

</body>
</html>