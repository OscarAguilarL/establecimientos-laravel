@extends('layouts.app')

@section('styles')
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  <!-- Esri Leaflet Geocoder -->
  <link
    rel="stylesheet"
    href="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin=""
  >

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css"
    integrity="sha512-0ns35ZLjozd6e3fJtuze7XJCQXMWmb4kPRbb+H/hacbqu6XfIX0ZRGt6SrmNmv5btrBpbzfdISSd8BAsXJ4t1Q=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center mt-4">Editar establecimiento</h1>

    <div class="mt-5 row justify-content-center">
      <form
        action="{{ route('establecimient.update', ['establecimiento' => $establecimiento->id]) }}"
        method="POST"
        class="col-md-9 col-12 card card-body"
        enctype="multipart/form-data"
      >
        @csrf
        @method('PUT')
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
              class="form-control @error('categoria_id') is-invalid @enderror"
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

            @error('categoria_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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

        <fieldset class="border p-4 mt-5">
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

          <div class="form-group">
            <div
              id="mapa"
              style="height: 400px"
            ></div>
          </div>

          <p class="informacion">Confirma que los siguientes campos son correctos</p>

          <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input
              type="text"
              id="direccion"
              name="direccion"
              placeholder="Dirección..."
              value="{{ old('direccion') }}"
              class="form-control @error('direccion') is-invalid @enderror"
            >
            @error('direccion')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="colonia">Colonia:</label>
            <input
              type="text"
              id="colonia"
              name="colonia"
              placeholder="Colonia..."
              value="{{ old('colonia') }}"
              class="form-control @error('colonia') is-invalid @enderror"
            >
            @error('colonia')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <input
            type="hidden"
            name="lat"
            id="lat"
            value="{{ old('lat') }}"
          >
          <input
            type="hidden"
            name="lng"
            id="lng"
            value="{{ old('lng') }}"
          >
        </fieldset>

        <fieldset class="border p-4 mt-5">
          <legend class="text-primary">Información Establecimiento: </legend>
          <div class="form-group">
            <label for="nombre">Teléfono</label>
            <input
              type="tel"
              class="form-control @error('telefono') is-invalid @enderror"
              id="telefono"
              placeholder="Teléfono Establecimiento"
              name="telefono"
              value="{{ old('telefono') }}"
            >

            @error('telefono')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>



          <div class="form-group">
            <label for="nombre">Descripción</label>
            <textarea
              class="form-control  @error('descripcion') is-invalid @enderror"
              name="descripcion"
            >{{ old('descripcion') }}</textarea>

            @error('descripcion')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="nombre">Hora Apertura:</label>
            <input
              type="time"
              class="form-control @error('apertura') is-invalid @enderror"
              id="apertura"
              name="apertura"
              value="{{ old('apertura') }}"
            >
            @error('apertura')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="nombre">Hora Cierre:</label>
            <input
              type="time"
              class="form-control @error('cierre') is-invalid @enderror"
              id="cierre"
              name="cierre"
              value="{{ old('cierre') }}"
            >
            @error('cierre')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
        </fieldset>

        <fieldset class="border p-4 mt-5">
          <legend class="text-primary"></legend>
          <div class="form-group">
            <label for="imagenes">Imagenes</label>
            <div
              id="dropzone"
              class="dropzone form-control"
            ></div>
          </div>
        </fieldset>

        <input
          type="hidden"
          name="uuid"
          id="uuid"
          value="{{ Str::uuid()->toString() }}"
        >
        <input
          type="submit"
          value="Registrar establecimiento"
          class="btn btn-primary mt-3 d-block"
        >
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <!-- Leafled -->
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  ></script>

  <script
    src="https://unpkg.com/esri-leaflet"
    defer
  ></script>
  <script
    src="https://unpkg.com/esri-leaflet-geocoder"
    defer
  ></script>

  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"
    integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    defer
  ></script>
@endsection
