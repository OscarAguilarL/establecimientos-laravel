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
          <legend class="text-primary">Nombre y categoría</legend>

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

        </fieldset>
      </form>
    </div>
  </div>
@endsection
