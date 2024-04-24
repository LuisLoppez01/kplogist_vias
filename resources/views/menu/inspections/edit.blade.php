@extends('adminlte::page')

@section('title', 'FFCC')

@section('content_header')
    <h1>Editar inspección</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">


            {!! Form::open(['route'=>  ['menu.inspections.update',$inspection], 'method' => 'put','onsubmit' => 'event.preventDefault()','files'=>true, 'id'=>'myform']) !!}

            @livewire('inspection-form-edit',['inspection' => $inspection])


            {!! Form::submit('Guardar inspección', ['class' => 'btn btn-primary mt-2','id'=>'b_save']) !!}
            {!! Form::close() !!}

        </div>
        @stop

        @section('css')
            <style>
                .image-wrapper {
                    padding-bottom: 20%;
                }

                .image-wrapper img {
                    position: absolute;
                    object-fit: contain;
                    width: 100%;
                    height: 100%;
                }

                @media (min-width: 576px) {
                    .etiqueta-movil {
                        display: none;
                    }
                }

                @media (max-width: 577px) {
                    .etiqueta-escritorio {
                        display: none;
                    }
                }
            </style>
        @stop

        @section('js')
            <script> console.log('Hi!'); </script>
            <script>
                const fileInput = document.getElementById('file');
                const preview = document.getElementById('evidencia');
                const reader = new FileReader();

                function handleEvent(event) {
                    if (event.type === "load") {
                        preview.src = reader.result;
                    }
                }

                function addListeners(reader) {
                    reader.addEventListener('loadstart', handleEvent);
                    reader.addEventListener('load', handleEvent);
                    reader.addEventListener('loadend', handleEvent);
                    reader.addEventListener('progress', handleEvent);
                    reader.addEventListener('error', handleEvent);
                    reader.addEventListener('abort', handleEvent);
                }

                function handleSelected(e) {
                    const selectedFile = fileInput.files[0];
                    if (selectedFile) {
                        addListeners(reader);
                        reader.readAsDataURL(selectedFile);
                    }
                }

                fileInput.addEventListener('change', handleSelected);
            </script>
            <script>
                var b_save = document.getElementById('b_save');
                // Obtener los elementos select y el botón
                var via = document.getElementById('via');
                var herraje = document.getElementById('herraje');
                var select1 = document.getElementById('yard_id');
                var track_id = document.getElementById('track_id');
                var tracksection_id = document.getElementById('tracksection_id');
                var railroadswitch_id = document.getElementById('railroadswitch_id');


                // Función para verificar los estados de los select
                function verificarViaTramos() {

                    if (track_id.value !== '0' && tracksection_id.value !== '0') {
                        b_save.disabled = false; // Habilitar el botón si ambos select tienen un valor seleccionado
                    } else {
                        b_save.disabled = true; // Deshabilitar el botón si alguno de los select no tiene un valor seleccionado
                    }
                }

                function verificarHerrajes() {

                    if (railroadswitch_id.value !== '0') {
                        b_save.disabled = false; // Habilitar el botón si ambos select tienen un valor seleccionado
                    } else {
                        b_save.disabled = true; // Deshabilitar el botón si alguno de los select no tiene un valor seleccionado
                    }
                }

                function verificarVia() {
                    railroadswitch_id.value = 0;
                }

                function verificarHerraje() {
                    track_id.value = 0;
                    tracksection_id.value = 0;
                }

                function handleClick(event) {
                    event.preventDefault();
                    console.log('boton!');
                    if (via !== null) {
                        if (via.checked) {
                            console.log('El radio 1 está seleccionado');
                            if (track_id.value == 0 || tracksection_id.value == 0) {
                                b_save.disabled = true;
                                alert("selecciona una via y un tramo");
                            } else {
                                document.getElementById('myform').submit();
                            }

                        }
                    }
                    if (herraje !== null) {
                        if (herraje.checked) {
                            console.log('El radio 2 está seleccionado');
                            if (railroadswitch_id.value == 0) {
                                b_save.disabled = true;
                                alert("selecciona un Herraje");
                            } else {
                                document.getElementById('myform').submit();
                            }
                        }
                    }

                }

                // Escuchar los cambios en los select y llamar a la función verificarEstados

                b_save.addEventListener('click', handleClick);
                track_id.addEventListener('change', verificarViaTramos);
                tracksection_id.addEventListener('change', verificarViaTramos);
                railroadswitch_id.addEventListener('change', verificarHerrajes);

            </script>
@stop
