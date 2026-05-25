@extends('layouts.app')

@section('titulo_pagina', 'Editar Diagnóstico')

@section('contenido')
    <div class="container-fluid mt-4">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white shadow-sm" style="border-radius: 10px;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-primary"><i class="fas fa-home mr-1"></i> Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('consultas.index') }}" class="text-primary">Diagnósticos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('consultas.detalle', ['consulta' => $item->id, 'mascota' => $item->mascota_id]) }}" class="text-primary">Detalle de Consulta</a></li>
                <li class="breadcrumb-item active text-gray-600" aria-current="page">Editar Diagnóstico</li>
            </ol>
        </nav>

        <!-- Page Heading & Title with Pet Name and Consultation Date -->
        <div class="card shadow-sm mb-4 border-left-primary bg-white" style="border-radius: 10px;">
            <div class="card-body py-3">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div>
                        <h1 class="h4 mb-1 text-gray-800 font-weight-bold">
                            <i class="fas fa-paw text-primary mr-2"></i>Paciente: <span class="text-primary">{{ $item->mascota->nombre ?? 'N/A' }}</span>
                        </h1>
                        <p class="text-xs text-muted mb-0">
                            <i class="far fa-calendar-alt mr-1"></i><strong>Fecha y Hora de la Consulta:</strong> 
                            {{ \Carbon\Carbon::parse($item->fecha_consulta)->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <a href="{{ route('consultas.detalle', ['consulta' => $item->id, 'mascota' => $item->mascota_id]) }}" class="btn btn-secondary btn-sm shadow-sm mt-2 mt-sm-0" style="border-radius: 8px;">
                        <i class="fas fa-arrow-left fa-sm mr-1"></i> Volver al Detalle
                    </a>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-left-danger" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i><strong>¡Error!</strong> Por favor corrige los siguientes errores:
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8 col-xl-7 mx-auto">
                <div class="card shadow mb-4 border-left-warning" style="border-radius: 10px;">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-warning"><i class="fas fa-file-medical-alt mr-1"></i> Formulario de Diagnóstico Médico</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('consultas.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- Hidden inputs to satisfy validation rules for other fields -->
                            <input type="hidden" name="mascota_id" value="{{ $item->mascota_id }}">
                            <input type="hidden" name="veterinario_id" value="{{ $item->veterinario_id }}">
                            <input type="hidden" name="fecha_consulta" value="{{ $item->fecha_consulta }}">
                            <input type="hidden" name="peso" value="{{ $item->peso }}">
                            <input type="hidden" name="talla" value="{{ $item->talla }}">
                            
                            <!-- Diagnóstico field (Visible) -->
                            <div class="form-group mb-4">
                                <label for="diagnostico" class="font-weight-bold text-dark mb-2">
                                    <i class="fas fa-notes-medical text-primary mr-1"></i> Describe el Diagnóstico de la Consulta
                                </label>
                                <textarea class="form-control" name="diagnostico" id="diagnostico" rows="6" style="border-radius: 8px; resize: vertical;" placeholder="Escribe aquí de manera detallada el diagnóstico clínico del paciente..." required>{{ old('diagnostico', $item->diagnostico) }}</textarea>
                                @error('diagnostico')
                                    <small class="text-danger font-weight-bold mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('consultas.detalle', ['consulta' => $item->id, 'mascota' => $item->mascota_id]) }}" class="btn btn-secondary mr-2 font-weight-bold shadow-sm px-4" style="border-radius: 8px;">
                                    <i class="fas fa-times mr-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning text-dark font-weight-bold shadow-sm px-4" style="border-radius: 8px;">
                                    <i class="fas fa-save mr-1"></i> Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

    <!-- Estilos Personalizados para CKEditor 5 -->
    <style>
        .ck-editor__editable_inline {
            min-height: 250px !important;
            border-radius: 0 0 8px 8px !important;
            color: #495057 !important;
            background-color: #fff !important;
        }
        .ck-toolbar {
            border-radius: 8px 8px 0 0 !important;
            background-color: #f8f9fc !important;
            border-color: #c5c7d0 !important;
        }
        .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border-color: #cbd5e0 !important;
        }
        .ck.ck-editor__main>.ck-editor__editable.ck-focused {
            border-color: #4e73df !important;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25) !important;
        }
    </style>

    <!-- Script de CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#diagnostico'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo' ]
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
