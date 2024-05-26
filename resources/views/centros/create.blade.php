@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ url('/centros') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('centros.form', ['modo' => 'Crear'])
        </form>

    </div>
@endsection
