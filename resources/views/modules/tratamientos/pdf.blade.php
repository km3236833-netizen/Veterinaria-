<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta Médica - {{ $item->mascota->nombre ?? 'Paciente' }}</title>
    
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
        .recipe-card {
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
        .recipe-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #4f46e5, #06b6d4);
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
            background: #e8f0fe;
            color: #4f46e5;
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
            color: #1e1b4b;
        }
        .clinic-info p {
            font-size: 0.85rem;
            color: #6b7280;
        }
        .document-title {
            text-align: right;
        }
        .document-title h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4f46e5;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .document-title p {
            font-size: 0.85rem;
            color: #6b7280;
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
            border: 1px dashed #e5e7eb;
        }
        .info-group h3 {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4b5563;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .info-group p {
            font-size: 0.95rem;
            color: #111827;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .info-group span {
            font-size: 0.85rem;
            color: #6b7280;
            display: block;
        }
        /* Prescription Details Card */
        .prescription-container {
            background: #f8fafc;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            margin-bottom: 35px;
        }
        .prescription-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }
        .medicine-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .medicine-title i {
            color: #4f46e5;
        }
        .prescription-dates {
            font-size: 0.85rem;
            color: #475569;
            font-weight: 600;
        }
        .prescription-dates span {
            color: #ef4444;
        }
        .specs-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .spec-item {
            background: #ffffff;
            border-radius: 8px;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
        }
        .spec-item small {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
            display: block;
            margin-bottom: 4px;
        }
        .spec-item span {
            font-size: 1rem;
            font-weight: 700;
            color: #334155;
        }
        /* Rich text indications container */
        .indications-box h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .indications-content {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #334155;
            padding-left: 5px;
        }
        .indications-content ul, .indications-content ol {
            padding-left: 20px;
            margin-bottom: 10px;
        }
        /* Footer clinical stamp & signature signature */
        .recipe-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 60px;
            border-top: 1px solid #f3f4f6;
            padding-top: 30px;
        }
        .signature-line {
            width: 250px;
            border-top: 2px solid #d1d5db;
            text-align: center;
            padding-top: 8px;
            font-size: 0.85rem;
            color: #4b5563;
            font-weight: 600;
        }
        .clinical-stamp {
            border: 2px dashed #9ca3af;
            border-radius: 8px;
            width: 130px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            color: #9ca3af;
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
            background: #4f46e5;
            color: white;
        }
        .btn-primary:hover {
            background: #4338ca;
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
            .recipe-card {
                box-shadow: none;
                border: none;
                max-width: 100%;
                width: 100%;
                padding: 0;
            }
            .recipe-card::before {
                display: none;
            }
            .action-bar {
                display: none !important;
            }
            .grid-info {
                border: 1px solid #d1d5db;
                background: #ffffff;
            }
            .prescription-container {
                background: #ffffff;
                border: 1px solid #d1d5db;
            }
            .spec-item {
                border: 1px solid #d1d5db;
            }
        }
    </style>
</head>
<body>

    <!-- Recipe Document Structure -->
    <div class="recipe-card">
        <!-- Header -->
        <div class="header">
            <div class="clinic-brand">
                <div class="clinic-logo">
                    <i class="fas fa-hand-holding-medical"></i>
                </div>
                <div class="clinic-info">
                    <h1>SISTEMA VETERINARIO</h1>
                    <p>Cuidado y Salud Profesional para tu Mascota</p>
                </div>
            </div>
            <div class="document-title">
                <h2>Receta Médica</h2>
                <p>Folio Receta: #REC-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <!-- Paciente & Propietario Info -->
        <div class="grid-info">
            <div class="info-group">
                <h3>Paciente (Mascota)</h3>
                <p>{{ $item->mascota->nombre ?? 'N/A' }}</p>
                <span>Especie: {{ $item->mascota->especie ?? '—' }} • Raza: {{ $item->mascota->raza ?? '—' }}</span>
                <span>Sangre: {{ $item->mascota->tipo_sangre ?? '—' }}</span>
            </div>
            <div class="info-group">
                <h3>Propietario</h3>
                <p>{{ $item->mascota->dueno->nombre_completo ?? 'N/A' }}</p>
                <span>Teléfono: {{ $item->mascota->dueno->telefono ?? '—' }}</span>
                <span>Email: {{ $item->mascota->dueno->correo ?? '—' }}</span>
            </div>
        </div>

        <!-- Prescription Details -->
        <div class="prescription-container">
            <div class="prescription-header">
                <div class="medicine-title">
                    <i class="fas fa-capsules"></i> {{ $item->medicamento }}
                </div>
                <div class="prescription-dates">
                    Vigencia: {{ \Carbon\Carbon::parse($item->fecha_inicio)->format('d/m/Y') }} hasta <span>{{ \Carbon\Carbon::parse($item->fecha_fin)->format('d/m/Y') }}</span>
                </div>
            </div>

            <div class="specs-grid">
                <div class="spec-item">
                    <small>Dosis Asignada</small>
                    <span>{{ $item->dosis }}</span>
                </div>
                <div class="spec-item">
                    <small>Frecuencia de Administración</small>
                    <span>{{ $item->frecuencia }}</span>
                </div>
            </div>

            <!-- Indications Content -->
            <div class="indications-box">
                <h4>Indicaciones de Uso</h4>
                <div class="indications-content">
                    @if($item->indicaciones)
                        {!! $item->indicaciones !!}
                    @else
                        <p style="font-style: italic; color: #6b7280;">Administrar el tratamiento médico conforme a las especificaciones generales de dosis y frecuencia.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer clinical Stamp / Signatures -->
        <div class="recipe-footer">
            <div class="clinical-stamp">
                Sello Médico<br>Veterinario
            </div>
            <div class="signature-line">
                Firma Médico Veterinario<br>Cédula Profesional
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
            // Un breve delay para permitir el renderizado tipográfico
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>

</body>
</html>
