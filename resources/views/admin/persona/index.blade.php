@extends('layouts.admin')

@section('titulo')
    Personas
@endsection

@section('contenido')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Personas</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Búsqueda de personas</h5>
                            </div>
                            <div class="card-body">
                                <form class="form-inline" id="formulario-busqueda">
                                    <label class="my-1 mr-2" for="busqueda">Nombre</label>
                                    <input type="text" class="form-control my-1 mr-sm-2" id="busqueda" name="busqueda"
                                        placeholder="">
                                    <button type="submit" class="btn btn-primary my-1">Buscar</button>
                                    <button onclick="modalCrear()" type="button"
                                        class="btn btn-success my-1 mx-1">Nuevo</button>
                                    {{-- <button onclick="reportePdf()" type="button" class="btn btn-success my-1 mx-1">Reporte
                                        PDF</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="tabla">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            search();
        });
        document.getElementById('formulario-busqueda').addEventListener('submit', function(evento) {
            evento.preventDefault();
            search();
        });

        function search() {
            const busqueda = document.getElementById('busqueda').value;
            axios.get(route('persona.search'), {
                    params: {
                        texto_busqueda: busqueda
                    }
                }).then(function(respuesta) {
                    const tabla_html = respuesta.data;
                    $('#tabla').html(tabla_html);
                })
                .catch(function() {
                    toastr.error('Error en la búsqueda');
                })
        }

        function modalCrear() {
            const ruta = route('persona.create');
            axios.get(ruta)
                .then(function(respuesta) {
                    const text_form = respuesta.data;
                    $('#modal-crud-contenido').html(text_form);
                    $('#modal-crud').modal('show'); // bootstrap
                })
                .catch(function() {
                    toastr.error('Error al cargar modal de crear')
                })
        }

        function guardar() {
            // peticion a store
            const ruta = route("persona.store");
            const formulario = document.getElementById("formulario-crear");
            const data = new FormData(formulario);
            axios.post(ruta, data)
                .then(function(respuesta) {
                    $('#modal-crud').modal('hide');
                    toastr.success(respuesta.data.message);
                    search();
                })
                .catch(function(error) {
                    // ??
                    if (error.response) {
                        toastr.error(error.response.data.message);
                        if (error.response.status === 422) {
                            mostrarErrores(error.response.data.errors, 'formulario-crear');
                        }
                    } else {
                        toastr.error("Error después de guardar");
                    }
                });
        }

        function modalEditar(id) {
            const ruta = route('persona.edit', [id]);
            axios.get(ruta)
                .then(function(respuesta) {
                    $('#modal-crud-contenido').html(respuesta.data);
                    $('#modal-crud').modal('show')
                })
                .catch(function() {
                    toastr.error('Error al cargar el modal de editar');
                })
        }

        function actualizar(id) {
            const ruta = route('persona.update', [id]);
            const formulario = document.getElementById("formulario-editar");
            const data = new FormData(formulario);
            axios.post(ruta, data)
                .then(function(respuesta) {
                    $('#modal-crud').modal('hide');
                    toastr.success(respuesta.data.message);
                    search();
                })
                .catch(function(error) {
                    if (error.response) {
                        toastr.error(error.response.data.message);
                        if (error.response.status === 422) {
                            mostrarErrores(error.response.data.errors, 'formulario-editar');
                        }
                    } else {
                        toastr.error("Error después de actualizar");
                    }
                });
        }

        function confirmarEliminar(id) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Este cambio no se puede deshacer!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="far fa-trash-alt"></i> Si, eliminar!',
                cancelButtonText: '<i class="far fa-window-close"></i> Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const ruta = route('persona.destroy', [id]);
                    const data = new FormData();
                    data.append('_method', 'DELETE');
                    axios.post(ruta, data)
                        .then(function(respuesta) {
                            toastr.success(respuesta.data.message);
                            search();
                        })
                        .catch(function(error) {
                            if (error.response) {
                                toastr.error(error.response.data.message);
                            } else {
                                toastr.error("Error después de eliminar");
                            }
                        })
                }
            })
        }

        function reportePdf() {
            axios.get(route('persona.reporte.pdf'), {
                    params: {
                        texto_busqueda: document.getElementById('busqueda').value
                    }
                })
                .then(function(respuesta) {
                    window.open(respuesta.data.url, '_blank').focus();
                })
                .catch(function(error) {
                    let mensaje = "Error al generar el reporte";
                    if (error.response) {
                        mensaje = error.response.data.message;
                    }
                    toastr.error(mensaje);
                });
        }
    </script>
@endsection
