@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="text-center mt-4">Registrar establecimiento</h1>

    <div class="mt-5 row justify-content-center">
      <form
        action=""
        class="col-md-9 col-12 card card-body"
      >
        <fieldset class="border p-4">
          <legend class="text-primary">Nombre, categoría e imagen principal</legend>

          <div class="form-group">
            <label for="nombre">Nombre del establecimiento</label>
            <input
              type="text"
              id="nombre"
              name="nombre"
              class="form-control @error('nombre') is-invalid @enderror"
              placeholder="Cafetería la brisa"
              value="{{ old('nombre') }}"
            >

            @error('nombre')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="categoria_id">Categoria</label>
            <select
              name="categoria_id"
              id="categoria_id"
              class="form-select @error('categoria_id') is-invalid @enderror"
            >
              <option
                value=""
                selected
                disabled
              >-- SELECCIONA UNA CATEGORIA --</option>
              @foreach ($categorias as $categoria)
                <option
                  value="{{ $categoria->id }}"
                  {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}
                >{{ $categoria->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="imagen_principal">Imagen principal</label>
            <input
              type="file"
              id="imagen_principal"
              name="imagen_principal"
              class="form-control @error('imagen_principal') is-invalid @enderror"
              value="{{ old('imagen_principal') }}"
            >

            @error('imagen_principal')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </fieldset>

        <fieldset class="border p-4">
          <legend class="text-primary">Ubicación</legend>

          <div class="form-group">
            <label for="formbuscador">Ingresa la dirección de tu establecimiento</label>
            <input
              type="text"
              id="formbuscador"
              placeholder="Calle la Angostura No. 2"
              class="form-control"
            >
            <p class="text-secondary mt-5 mb-3 text-center">El asistente colocará una dirección estimada, mueve el pin
              hacia el lugar correcto</p>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
@endsection
