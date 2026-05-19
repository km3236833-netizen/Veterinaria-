@extends('layouts.app')

@section('titulo_pagina', 'Editar Mascota')

@section('contenido')
    <div class="container-fluid mt-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-edit text-primary mr-2"></i>Editar Mascota
            </h1>
            <a href="{{ route('expedientes') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Volver a Expedientes
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modificar Datos de {{ $item->nombre }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('mascotas.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Owner Selection Search Section -->
                    <div class="card border-left-info shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="h6 font-weight-bold text-info mb-3">
                                <i class="fas fa-user mr-1"></i> 1. Seleccionar Dueño (Propietario)
                            </h5>
                            
                            <!-- Search Control input -->
                            <div class="form-group mb-1">
                                <label for="buscar_dueno" class="form-label font-weight-bold text-gray-700">Buscar Dueño por Nombre o Teléfono</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info border-info text-white">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="buscar_dueno" class="form-control border-info" placeholder="Escriba para buscar dueño..." autocomplete="off">
                                </div>
                            </div>

                            <!-- Bottom of Search Control: Dynamic search results -->
                            <div id="resultados_duenos" class="list-group shadow-sm mt-2 border rounded" style="max-height: 200px; overflow-y: auto; display: none; z-index: 1000; position: relative; background: white;">
                                @foreach($duenos as $dueno)
                                    <button type="button" class="list-group-item list-group-item-action dueno-option" data-id="{{ $dueno->id }}" data-nombre="{{ $dueno->nombre_completo }}" data-telefono="{{ $dueno->telefono }}">
                                        <i class="fas fa-user-circle text-muted mr-2"></i>
                                        <strong>{{ $dueno->nombre_completo }}</strong> 
                                        <span class="badge badge-light ml-2">📞 {{ $dueno->telefono }}</span>
                                    </button>
                                @endforeach
                                <div id="no-duenos-found" class="list-group-item text-muted text-center py-3" style="display: none;">
                                    <i class="fas fa-exclamation-triangle text-warning mr-1"></i> No se encontraron dueños.
                                    <a href="{{ route('duenos.create') }}" class="btn btn-sm btn-success ml-2 py-0"><i class="fas fa-plus"></i> Crear Nuevo Dueño</a>
                                </div>
                            </div>

                            <!-- Selected Owner Indicator -->
                            <div id="dueno_seleccionado_container" class="mt-3 p-3 bg-light border rounded align-items-center justify-content-between" style="display: none;">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3 bg-success text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs text-muted d-block uppercase font-weight-bold">DUEÑO SELECCIONADO</span>
                                        <span id="selected_dueno_name" class="font-weight-bold text-dark h5 mb-0"></span>
                                        <span id="selected_dueno_phone" class="text-muted ml-2"></span>
                                    </div>
                                </div>
                                <button type="button" id="btn_clear_dueno" class="btn btn-sm btn-outline-danger"><i class="fas fa-times mr-1"></i> Cambiar</button>
                            </div>

                            <!-- Hidden Owner ID field for form submission -->
                            <input type="hidden" name="dueno_id" id="dueno_id" required value="{{ old('dueno_id', $item->dueno_id) }}">
                            @error('dueno_id')
                                <span class="text-danger text-xs d-block mt-1 font-weight-bold">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Pet Fields Section -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre" class="form-label font-weight-bold">Nombre de la Mascota <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required value="{{ old('nombre', $item->nombre) }}" placeholder="Ej. Max">
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="especie" class="form-label font-weight-bold">Especie <span class="text-danger">*</span></label>
                            <select class="form-control @error('especie') is-invalid @enderror" id="especie" name="especie" required>
                                <option value="" disabled>Seleccione una especie</option>
                                <option value="Canino" {{ old('especie', $item->especie) == 'Canino' ? 'selected' : '' }}>Canino</option>
                                <option value="Felino" {{ old('especie', $item->especie) == 'Felino' ? 'selected' : '' }}>Felino</option>
                                <option value="Ave" {{ old('especie', $item->especie) == 'Ave' ? 'selected' : '' }}>Ave</option>
                                <option value="Reptil" {{ old('especie', $item->especie) == 'Reptil' ? 'selected' : '' }}>Reptil</option>
                                <option value="Otro" {{ old('especie', $item->especie) == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('especie')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="raza" class="form-label font-weight-bold">Raza <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('raza') is-invalid @enderror" id="raza" name="raza" required value="{{ old('raza', $item->raza) }}" placeholder="Ej. Golden Retriever">
                            @error('raza')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="fecha_nacimiento" class="form-label font-weight-bold">Fecha de Nacimiento <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" required value="{{ old('fecha_nacimiento', $item->fecha_nacimiento) }}">
                            @error('fecha_nacimiento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tipo_sangre" class="form-label font-weight-bold">Tipo de Sangre <span class="text-danger">*</span></label>
                            <select class="form-control @error('tipo_sangre') is-invalid @enderror" id="tipo_sangre" name="tipo_sangre" required>
                                <option value="" disabled>Seleccione el tipo de sangre</option>
                                <option value="DEA 1.1 Positivo" {{ old('tipo_sangre', $item->tipo_sangre) == 'DEA 1.1 Positivo' ? 'selected' : '' }}>DEA 1.1 Positivo</option>
                                <option value="DEA 1.1 Negativo" {{ old('tipo_sangre', $item->tipo_sangre) == 'DEA 1.1 Negativo' ? 'selected' : '' }}>DEA 1.1 Negativo</option>
                                <option value="DEA 1.2 Positivo" {{ old('tipo_sangre', $item->tipo_sangre) == 'DEA 1.2 Positivo' ? 'selected' : '' }}>DEA 1.2 Positivo</option>
                                <option value="A" {{ old('tipo_sangre', $item->tipo_sangre) == 'A' ? 'selected' : '' }}>A (Felinos)</option>
                                <option value="B" {{ old('tipo_sangre', $item->tipo_sangre) == 'B' ? 'selected' : '' }}>B (Felinos)</option>
                                <option value="AB" {{ old('tipo_sangre', $item->tipo_sangre) == 'AB' ? 'selected' : '' }}>AB (Felinos)</option>
                                <option value="Desconocido" {{ old('tipo_sangre', $item->tipo_sangre) == 'Desconocido' ? 'selected' : '' }}>Desconocido</option>
                            </select>
                            @error('tipo_sangre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="comportamiento" class="form-label font-weight-bold">Comportamiento / Estado <span class="text-danger">*</span></label>
                            <select class="form-control @error('comportamiento') is-invalid @enderror" id="comportamiento" name="comportamiento" required>
                                <option value="" disabled>Seleccione estado de comportamiento</option>
                                <option value="Dócil" {{ old('comportamiento', $item->comportamiento) == 'Dócil' ? 'selected' : '' }}>Dócil</option>
                                <option value="Estable" {{ old('comportamiento', $item->comportamiento) == 'Estable' ? 'selected' : '' }}>Estable</option>
                                <option value="En Tratamiento" {{ old('comportamiento', $item->comportamiento) == 'En Tratamiento' ? 'selected' : '' }}>En Tratamiento</option>
                                <option value="Nervioso" {{ old('comportamiento', $item->comportamiento) == 'Nervioso' ? 'selected' : '' }}>Nervioso</option>
                                <option value="Agresivo" {{ old('comportamiento', $item->comportamiento) == 'Agresivo' ? 'selected' : '' }}>Agresivo</option>
                                <option value="Urgente" {{ old('comportamiento', $item->comportamiento) == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                            </select>
                            @error('comportamiento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="custom-control custom-checkbox custom-control-lg mt-3">
                                <input type="checkbox" class="custom-control-input" id="es_adoptado" name="es_adoptado" value="1" {{ old('es_adoptado', $item->es_adoptado) ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="es_adoptado">¿Es adoptado(a)? (Marca si fue adoptado(a) o rescatado(a))</label>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="text-right">
                        <a href="{{ route('expedientes') }}" class="btn btn-secondary mr-2">Cancelar</a>
                        <button type="submit" class="btn btn-warning shadow text-dark font-weight-bold">
                            <i class="fas fa-save mr-1"></i> Actualizar Mascota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Live Search & Select Script for Owner Selection -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buscarDuenoInput = document.getElementById('buscar_dueno');
            const resultadosDuenosContainer = document.getElementById('resultados_duenos');
            const duenoOptionButtons = document.querySelectorAll('.dueno-option');
            const noDuenosFound = document.getElementById('no-duenos-found');
            
            const duenoIdHidden = document.getElementById('dueno_id');
            const duenoSeleccionadoContainer = document.getElementById('dueno_seleccionado_container');
            const selectedDuenoNameSpan = document.getElementById('selected_dueno_name');
            const selectedDuenoPhoneSpan = document.getElementById('selected_dueno_phone');
            const btnClearDueno = document.getElementById('btn_clear_dueno');

            // 1. Show results dropdown on focus or typing
            buscarDuenoInput.addEventListener('focus', function() {
                if (duenoIdHidden.value === '') {
                    filterAndShowDuenos();
                }
            });

            buscarDuenoInput.addEventListener('input', function() {
                filterAndShowDuenos();
            });

            // 2. Hide dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!buscarDuenoInput.contains(event.target) && !resultadosDuenosContainer.contains(event.target)) {
                    resultadosDuenosContainer.style.display = 'none';
                }
            });

            // 3. Filtering logic
            function filterAndShowDuenos() {
                const query = buscarDuenoInput.value.toLowerCase().trim();
                let matchingCount = 0;

                duenoOptionButtons.forEach(button => {
                    const nombre = button.getAttribute('data-nombre').toLowerCase();
                    const telefono = button.getAttribute('data-telefono').toLowerCase();

                    if (nombre.includes(query) || telefono.includes(query)) {
                        button.style.setProperty('display', 'block', 'important');
                        matchingCount++;
                    } else {
                        button.style.setProperty('display', 'none', 'important');
                    }
                });

                // Display options container
                resultadosDuenosContainer.style.display = 'block';

                if (matchingCount === 0) {
                    noDuenosFound.style.display = 'block';
                } else {
                    noDuenosFound.style.display = 'none';
                }
            }

            // 4. Selection logic
            duenoOptionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = button.getAttribute('data-id');
                    const nombre = button.getAttribute('data-nombre');
                    const telefono = button.getAttribute('data-telefono');

                    // Set hidden input
                    duenoIdHidden.value = id;

                    // Display success block
                    selectedDuenoNameSpan.textContent = nombre;
                    selectedDuenoPhoneSpan.textContent = "📞 " + telefono;
                    duenoSeleccionadoContainer.style.setProperty('display', 'flex', 'important');

                    // Hide search input and results container
                    buscarDuenoInput.closest('.form-group').style.display = 'none';
                    resultadosDuenosContainer.style.display = 'none';
                });
            });

            // 5. Clear selection logic
            btnClearDueno.addEventListener('click', function() {
                // Clear values
                duenoIdHidden.value = '';
                buscarDuenoInput.value = '';

                // Toggle elements
                duenoSeleccionadoContainer.style.setProperty('display', 'none', 'important');
                buscarDuenoInput.closest('.form-group').style.display = 'block';
                buscarDuenoInput.focus();
            });

            // 6. Handle validation/old data pre-selection
            const initialId = duenoIdHidden.value;
            if (initialId !== '') {
                const matchingButton = Array.from(duenoOptionButtons).find(btn => btn.getAttribute('data-id') === initialId);
                if (matchingButton) {
                    matchingButton.click();
                }
            }
        });
    </script>
@endsection
