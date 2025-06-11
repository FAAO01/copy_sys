@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Copia de Seguridad</h1>
    <p>Descarga o importa una copia de seguridad de la base de datos.</p>

    <!-- Botón para descargar el backup -->
    <form method="GET" action="{{ url('settings/backup/download') }}">
        <button type="submit">Descargar archivo .sql</button>
    </form>

    <hr>

    <!-- Formulario para importar backup -->
    <form method="POST" action="{{ url('settings/backup/import') }}" enctype="multipart/form-data">
        @csrf
        <label for="sql_file">Importar archivo .sql:</label>
        <input type="file" name="sql_file" id="sql_file" accept=".sql" required>
        <button type="submit">Importar</button>
    </form>
</div>
@endsection
