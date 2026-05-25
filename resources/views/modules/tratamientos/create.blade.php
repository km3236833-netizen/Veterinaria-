@extends('layouts.app')

@section('titulo_pagina', 'Registrar Tratamiento')

@section('contenido')
    <div class="container-fluid mt-4">
        <!-- Breadcrumbs (Migas de Pan) -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home mr-1"></i>Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tratamientos.index') }}">Tratamientos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nuevo Tratamiento</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-plus text-primary mr-2"></i>Registrar Nuevo Tratamiento
            </h1>
            <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Volver al Listado
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-left-danger" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i><strong>¡Error!</strong> Corrige los siguientes errores:
                <ul class="mb-0 mt-1">
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
            <div class="col-lg-12">
                <div class="card shadow mb-4 border-bottom-primary">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-capsules mr-1"></i> Formulario de Prescripción Médica</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tratamientos.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <!-- Paciente Selection -->
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold text-dark">Paciente (Mascota) <span class="text-danger">*</span></label>
                                    <select name="mascota_id" class="form-control" required>
                                        <option value="">-- Seleccionar Paciente --</option>
                                        @foreach($mascotas as $mascota)
                                            <option value="{{ $mascota->id }}" {{ (old('mascota_id') == $mascota->id || $mascotaPreseleccionada == $mascota->id) ? 'selected' : '' }}>
                                                {{ $mascota->nombre }} ({{ $mascota->especie }} • {{ $mascota->raza }}) - Dueño: {{ $mascota->dueno->nombre_completo ?? '—' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Medicamento -->
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold text-dark">Medicamento <span class="text-danger">*</span></label>
                                    <input type="text" name="medicamento" value="{{ old('medicamento') }}" class="form-control" placeholder="Ej. Amoxicilina, Meloxicam..." required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dosis -->
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold text-dark">Dosis <span class="text-danger">*</span></label>
                                    <input type="text" name="dosis" value="{{ old('dosis') }}" class="form-control" placeholder="Ej. 1/2 tableta, 1.5 ml..." required>
                                </div>

                                <!-- Frecuencia -->
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold text-dark">Frecuencia <span class="text-danger">*</span></label>
                                    <input type="text" name="frecuencia" value="{{ old('frecuencia') }}" class="form-control" placeholder="Ej. Cada 8 horas, 1 vez al día..." required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Fecha de Inicio -->
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold text-dark">Fecha de Inicio <span class="text-danger">*</span></label>
                                    <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', date('Y-m-d')) }}" class="form-control" required>
                                </div>

                                <!-- Fecha de Fin -->
                                <div class="col-md-6 form-group">
                                    <label class="font-weight-bold text-dark">Fecha de Fin <span class="text-danger">*</span></label>
                                    <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" class="form-control" required>
                                </div>
                            </div>

                            <!-- Indicaciones (CKEditor 5) -->
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Indicaciones y Recomendaciones Clínicas</label>
                                <textarea id="indicaciones" name="indicaciones" class="form-control" rows="6" placeholder="Administrar el medicamento después de las comidas...">{{ old('indicaciones') }}</textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="text-right mt-4">
                                <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary font-weight-bold px-4 mr-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary font-weight-bold px-4 shadow">
                                    <i class="fas fa-save mr-1"></i> Guardar Tratamiento
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CKEditor 5 CDN and Custom Styling -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 250px;
            border-radius: 0 0 10px 10px !important;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }
        .ck-toolbar {
            border-radius: 10px 10px 0 0 !important;
            border-bottom: none !important;
            background-color: #f8f9fc !important;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#indicaciones'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo' ]
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
