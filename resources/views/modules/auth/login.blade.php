@extends('layouts.auth')

@section('titulo_pagina', 'Login de usuario')

@section('contenido')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-color: #f8f9fc; display: flex !important; align-items: center; justify-content: center;">
                            <img src="{{ asset('img/logo1.png') }}" class="img-fluid" style="max-height: 80%; padding: 2rem;">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido de nuevo!</h1>
                                </div>
                                <form action="{{ route('logear') }}" method="post" class="user">
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            name="email" id="email" aria-describedby="emailHelp"
                                            placeholder="Introduce tu correo...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control form-control-user"
                                            placeholder="Contraseña">
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Entrar
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#">¿Olvidaste tu contraseña?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
