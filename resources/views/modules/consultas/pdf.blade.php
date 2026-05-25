<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Consulta - {{ $consulta->mascota->nombre ?? 'Paciente' }}</title>
    
    <!-- Google Fonts for premium typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .report-card {
            background: #ffffff;
            width: 100%;
            max-width: 800px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            padding: 40px;
            border: 1px solid #e5e7eb;
            position: relative;
            overflow: hidden;
        }
        /* Top Decorative Clinical Strip */
        .report-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #3b82f6, #10b981);
        }
        /* Header section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 25px;
            margin-bottom: 30px;
        }
        .clinic-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .clinic-logo {
            background: #e0f2fe;
            color: #0284c7;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .clinic-info h1 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
        }
        .clinic-info p {
            font-size: 0.85rem;
            color: #64748b;
        }
        .document-title {
            text-align: right;
        }
        .document-title h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .document-title p {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 4px;
        }
        /* Grid Information */
        .grid-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            background: #fafafa;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px dashed #e2e8f0;
        }
        .info-group h3 {
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .info-group p {
            font-size: 0.95rem;
            color: #0f172a;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .info-group span {
            font-size: 0.85rem;
            color: #64748b;
            display: block;
        }
        /* Vital Signs Section */
        .vitals-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        .vital-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
        }
        .vital-card i {
            color: #3b82f6;
            font-size: 1.1rem;
            margin-bottom: 6px;
        }
        .vital-card small {
            font-size: 0.7rem;
            color: #64748b;
            text-transform: uppercase;
            display: block;
            margin-bottom: 4px;
            font-weight: 600;
        }
        .vital-card span {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
        }
        /* Diagnosis / Findings */
        .findings-container {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            margin-bottom: 35px;
            min-height: 250px;
        }
        .findings-header {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .findings-header i {
            color: #10b981;
        }
        .findings-content {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #334155;
        }
        .findings-content ul, .findings-content ol {
            padding-left: 20px;
            margin-bottom: 10px;
        }
        /* Footer clinical stamp & signature signature */
        .report-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 60px;
            border-top: 1px solid #f1f5f9;
            padding-top: 30px;
        }
        .signature-line {
            width: 250px;
            border-top: 2px solid #cbd5e1;
            text-align: center;
            padding-top: 8px;
            font-size: 0.85rem;
            color: #475569;
            font-weight: 600;
        }
        .signature-line span {
            font-size: 0.75rem;
            color: #64748b;
            display: block;
            margin-top: 2px;
            font-weight: 400;
        }
        .clinical-stamp {
            border: 2px dashed #94a3b8;
            border-radius: 8px;
            width: 130px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 600;
            text-align: center;
            padding: 10px;
            text-transform: uppercase;
        }
        /* Floating Action Bar */
        .action-bar {
            position: fixed;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(8px);
            padding: 12px 24px;
            border-radius: 50px;
            display: flex;
            gap: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }
        .btn {
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s ease;
        }
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: #475569;
            color: white;
        }
        .btn-secondary:hover {
            background: #334155;
            transform: translateY(-2px);
        }

        /* PRINT STYLING OVERRIDES */
        @media print {
            body {
                background: #ffffff;
                color: #000000;
                padding: 0;
            }
            .report-card {
                box-shadow: none;
                border: none;
                max-width: 100%;
                width: 100%;
                padding: 0;
            }
            .report-card::before {
                display: none;
            }
            .action-bar {
                display: none !important;
            }
            .grid-info {
                border: 1px solid #cbd5e1;
                background: #ffffff;
            }
            .vitals-grid {
                gap: 10px;
            }
            .vital-card {
                background: #ffffff;
                border: 1px solid #cbd5e1;
            }
            .findings-container {
                background: #ffffff;
                border: 1px solid #cbd5e1;
            }
        }
    </style>
</head>
<body>

    <!-- Report Document Structure -->
    <div class="report-card">
        <!-- Header -->
        <div class="header">
            <div class="clinic-brand">
                <div class="clinic-logo">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <div class="clinic-info">
                    <h1>SISTEMA VETERINARIO</h1>
                    <p>Reporte Clínico y Diagnóstico Profesional</p>
                </div>
            </div>
            <div class="document-title">
                <h2>Informe Médico</h2>
                <p>Folio Consulta: #CONS-{{ str_pad($consulta->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <!-- Paciente & Propietario Info -->
        <div class="grid-info">
            <div class="info-group">
                <h3>Paciente (Mascota)</h3>
                <p>{{ $consulta->mascota->nombre ?? 'N/A' }}</p>
                <span>Especie: {{ $consulta->mascota->especie ?? '—' }} • Raza: {{ $consulta->mascota->raza ?? '—' }}</span>
                <span>Sangre: {{ $consulta->mascota->tipo_sangre ?? '—' }}</span>
            </div>
            <div class="info-group">
                <h3>Propietario</h3>
                <p>{{ $consulta->mascota->dueno->nombre_completo ?? 'N/A' }}</p>
                <span>Teléfono: {{ $consulta->mascota->dueno->telefono ?? '—' }}</span>
                <span>Email: {{ $consulta->mascota->dueno->correo ?? '—' }}</span>
            </div>
        </div>

        <!-- Vital Signs Metrics -->
        <div class="vitals-grid">
            <div class="vital-card">
                <i class="fas fa-weight"></i>
                <small>Peso Corporal</small>
                <span>{{ $consulta->peso }} kg</span>
            </div>
            <div class="vital-card">
                <i class="fas fa-ruler-vertical"></i>
                <small>Talla / Longitud</small>
                <span>{{ $consulta->talla }} cm</span>
            </div>
            <div class="vital-card">
                <i class="far fa-calendar-alt"></i>
                <small>Fecha Consulta</small>
                <span>{{ \Carbon\Carbon::parse($consulta->fecha_consulta)->format('d/m/Y') }}</span>
            </div>
            <div class="vital-card">
                <i class="fas fa-user-md"></i>
                <small>Veterinario</small>
                <span style="font-size: 0.85rem; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $consulta->veterinario->nombre_completo ?? 'N/A' }}</span>
            </div>
        </div>

        <!-- Diagnostic Findings -->
        <div class="findings-container">
            <div class="findings-header">
                <i class="fas fa-file-medical-alt"></i> Diagnóstico e Informe Clínico
            </div>
            <div class="findings-content">
                @if($consulta->diagnostico)
                    {!! $consulta->diagnostico !!}
                @else
                    <p style="font-style: italic; color: #64748b;">No se registró un diagnóstico detallado para esta consulta.</p>
                @endif
            </div>
        </div>

        <!-- Footer clinical Stamp / Signatures -->
        <div class="report-footer">
            <div class="clinical-stamp">
                Sello de la<br>Clínica
            </div>
            <div class="signature-line">
                {{ $consulta->veterinario->nombre_completo ?? 'Médico Veterinario' }}
                <span>Médico Veterinario Firmante</span>
                @if(isset($consulta->veterinario->cedula))
                    <span>Cédula: {{ $consulta->veterinario->cedula }}</span>
                @else
                    <span>Cédula Profesional: N/A</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Floating Action Controls (Hidden in Printed PDF) -->
    <div class="action-bar">
        <button onclick="window.print();" class="btn btn-primary">
            <i class="fas fa-print"></i> Imprimir / Guardar en PDF
        </button>
        <button onclick="window.close();" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cerrar Ventana
        </button>
    </div>

    <!-- Auto Trigger Print Dialog on load for convenience -->
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>

</body>
</html>
