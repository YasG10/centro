<br>
<br>
<br>

<h1>{{ $modo }} Centro</h1>

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($centro) ? url('/centros/' . $centro->id) : url('/centros') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($centro))
        {{ method_field('PATCH') }}
    @endif

    <div class="form-group">
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre" class="form-control" value="{{ isset($centro->Nombre) ? $centro->Nombre : old('Nombre') }}" id="Nombre">
    </div>

    <div class="form-group">
        <label for="Director">Director</label>
        <input type="text" name="Director" class="form-control" value="{{ isset($centro->Director) ? $centro->Director : old('Director') }}" id="Director">
    </div>

    <div class="form-group">
        <label for="Descripcion">Descripción</label>
        <textarea id="Descripcion" class="form-control" name="Descripcion" style="height: 200px;">{{ isset($centro->Descripcion) ? $centro->Descripcion : old('Descripcion') }}</textarea>
    </div>

    <div class="form-group">
        <label for="Foto">Foto</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="Foto" id="Foto">
            <label class="custom-file-label" for="Foto">Seleccionar archivo</label>
        </div>
        @if (isset($centro->Foto))
            <img src="{{ asset('storage') . '/' . $centro->Foto }}" class="mt-2 img-thumbnail img-fluid" alt="Foto del Centro" width="200">
        @endif
    </div>

    <br>

    <button type="submit" class="btn btn-primary">{{ $modo }} Datos</button>
    <a href="{{ url('centros/') }}" class="btn btn-secondary">Regresar</a>
</form>
