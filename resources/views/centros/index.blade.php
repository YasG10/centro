@extends('layouts.app')

@section('content')
    <br>
    <br>
    <div class="container">

        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert" id="alerta">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="cerrarAlerta()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <script>
            function cerrarAlerta() {
                document.getElementById('alerta').style.display = 'none';
            }
        </script>

        <br>


        <div class="row">
            @foreach ($centros as $centro)
                <div class="col-12 mb-4">
                    <div class="card border-0">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img class="card-img" src="{{ asset('storage') . '/' . $centro->Foto }}"
                                    alt="{{ $centro->Nombre }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $centro->Nombre }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $centro->Director }}</h6>
                                    <p class="card-text">{{ $centro->Descripcion }}</p>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a href="{{ url('/centros/' . $centro->id . '/edit') }}"
                                            class="btn btn-primary">Editar</a>
                                        <form action="{{ url('/centros/' . $centro->id) }}" class="d-inline" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" onclick="return confirm('¿Quieres borrar?')"
                                                class="btn btn-secondary">Borrar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {!! $centros->links() !!}
    </div>
@endsection
