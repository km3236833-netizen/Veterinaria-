@extends('layouts.app')

@section('titulo_pagina', 'Nuevo Diagnóstico')

@section('contenido')
    <div class="container-fluid mt-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-file-medical text-primary mr-2"></i>Registrar Nuevo Diagnóstico
            </h1>
            <a href="{{ route('consultas.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Volver a Diagnósticos
            </a>
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
            <div class="col-lg-8 col-xl-9 mx-auto">
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit mr-1"></i> Formulario de Diagnóstico Médico</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('consultas.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <!-- Paciente Selection -->
                                <div class="col-md-6 form-group">
                                    <label for="mascota_id" class="font-weight-bold text-dark"><i class="fas fa-dog text-primary mr-1"></i> Paciente (Mascota)</label>
                                    <select class="form-control" name="mascota_id" id="mascota_id" required>
                                        <option value="" disabled selected>Selecciona un paciente...</option>
                                        @foreach($mascotas as $mascota)
                                            <option value="{{ $mascota->id }}" {{ (old('mascota_id') == $mascota->id || $mascotaPreseleccionada == $mascota->id) ? 'selected' : '' }}>
                                                {{ $mascota->nombre }} ({{ $mascota->especie }} - Propietario: {{ $mascota->dueno->nombre_completo ?? 'Sin Dueño' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mascota_id')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Veterinario Selection -->
                                <div class="col-md-6 form-group">
                                    <label for="veterinario_id" class="font-weight-bold text-dark"><i class="fas fa-user-md text-primary mr-1"></i> Veterinario Asignado</label>
                                    <select class="form-control" name="veterinario_id" id="veterinario_id" required>
                                        <option value="" disabled selected>Selecciona un veterinario...</option>
                                        @foreach($veterinarios as $vet)
                                            <option value="{{ $vet->id }}" {{ (old('veterinario_id') == $vet->id || (auth()->user()->rol === 'veterinario' && auth()->user()->veterinario && auth()->user()->veterinario->id == $vet->id)) ? 'selected' : '' }}>
                                                {{ $vet->nombre_completo }} ({{ $vet->especialidad }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('veterinario_id')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Fecha Consulta -->
                                <div class="col-md-4 form-group">
                                    <label for="fecha_consulta" class="font-weight-bold text-dark"><i class="far fa-calendar-alt text-primary mr-1"></i> Fecha y Hora de Consulta</label>
                                    <input type="datetime-local" class="form-control" name="fecha_consulta" id="fecha_consulta" value="{{ old('fecha_consulta', $fechaActual) }}" required>
                                    @error('fecha_consulta')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Peso -->
                                <div class="col-md-4 form-group">
                                    <label for="peso" class="font-weight-bold text-dark"><i class="fas fa-weight text-primary mr-1"></i> Peso (kg)</label>
                                    <input type="number" step="0.01" class="form-control" name="peso" id="peso" value="{{ old('peso') }}" placeholder="ej. 12.50" required>
                                    @error('peso')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Talla -->
                                <div class="col-md-4 form-group">
                                    <label for="talla" class="font-weight-bold text-dark"><i class="fas fa-ruler-vertical text-primary mr-1"></i> Talla (cm)</label>
                                    <input type="number" step="0.01" class="form-control" name="talla" id="talla" value="{{ old('talla') }}" placeholder="ej. 45.00" required>
                                    @error('talla')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Diagnóstico -->
                            <div class="form-group">
                                <label for="diagnostico" class="font-weight-bold text-dark"><i class="fas fa-notes-medical text-primary mr-1"></i> Diagnóstico Médico</label>
                                <textarea class="form-control" name="diagnostico" id="diagnostico" rows="4" placeholder="Describe detalladamente el diagnóstico clínico del paciente..." required>{{ old('diagnostico') }}</textarea>
                                @error('diagnostico')
                                    <small class="text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('consultas.index') }}" class="btn btn-secondary mr-2 font-weight-bold shadow-sm px-4">
                                    <i class="fas fa-times mr-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary font-weight-bold shadow-sm px-4">
                                    <i class="fas fa-save mr-1"></i> Registrar Diagnóstico
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos Personalizados para CKEditor 5 -->
    <style>
        .ck-editor__editable_inline {
            min-height: 200px !important;
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
