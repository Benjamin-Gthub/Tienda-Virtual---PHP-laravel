<?php $__env->startSection('contenido'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tipos de cursos</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col-md-6 -->
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Búsqueda de tipos de cursos</h5>
                            </div>
                            <div class="card-body">
                                <form class="form-inline" id="formulario-busqueda">
                                    <label class="my-1 mr-2" for="busqueda">Nombre</label>
                                    <input type="text" class="form-control my-1 mr-sm-2" id="busqueda" name="busqueda"
                                        placeholder="">
                                    <button type="submit" class="btn btn-primary my-1">Buscar</button>
                                    <button onclick="modalCrear()" type="button"
                                        class="btn btn-success my-1 mx-1">Nuevo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <div class="row">
                    <div class="col-12" id="listado">
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        document.getElementById('formulario-busqueda').addEventListener('submit', function(evento) {
            //evento.preventDefault(); // quitar el efecto del evento submit
           // search();
        });

        document.addEventListener('DOMContentLoaded', function() {
            search();
        });

        function search() {
            const busqueda = document.getElementById('busqueda').value;
            const parametros = {
                "params": {
                    "busqueda": busqueda
                }
            };
            axios.get(route('tipo_curso.search'), parametros)
                .then(function(respuesta) {
                    // 100,200,300
                    const contenido_html = respuesta.data;
                    $('#listado').html(contenido_html);
                })
                .catch(function() {
                    // 400, 500
                });

            // fetch(route('tipo_curso.search'), {
            //         "busqueda": busqueda
            //     })
            //     .then(function(respuesta) {
            //         console.log(respuesta.blob());
            //     })
            //     .catch();
        }

        function modalCrear() {
            axios.get(route('tipo_curso.create'))
                .then(function(respuesta) {
                    const formulario_html = respuesta.data;
                    $('#modal-agregar-contenido').html(formulario_html);
                    $('#modal-agregar').modal('show'); // modal se muestra
                })
                .catch(function() {

                });
        }

        function guardar() {
            const formulario = document.getElementById('formulario-crear');
            const data = new FormData(formulario);

            axios.post(route('tipo_curso.store'), data)
            .then(function(respuesta){
                // 200
                toastr.success(respuesta.data.message);
                search();
                $('#modal-agregar').modal('hide');
            })
            .catch(function(error){
                if(error.response){
                    if(error.response.status == 422){
                        console.log(error.response.data)
                        mostrarErrores(error.response.data.errores, 'formulario-crear');
                    }
                    toastr.error(error.response.data.message);
                }else{
                    toastr.error('Error luego de registrar tipo de curso');
                }
            });
        }

        function modalEditar(id) {
            axios.get(route('tipo_curso.edit', [id]))
            .then(function(respuesta){
                const form_html = respuesta.data;
                $('#modal-editar-contenido').html(form_html);
                $('#modal-editar').modal('show');
            })
            .catch(function(){
                toastr.error('Error al cargar el modal');
            });
        }

        function actualizar(id) {
            const formulario = document.getElementById('formulario-editar');
            const data = new FormData(formulario);
            axios.post(route('tipo_curso.update', [id]), data)
            .then(function(respuesta){
                toastr.success(respuesta.data.message);
                search();
                $('#modal-editar').modal('hide');
            })
            .catch(function(error){
                if(error.response){
                    if(error.response.status == 422){
                        console.log(error.response.data)
                        mostrarErrores(error.response.data.errores, 'formulario-editar');
                    }
                    toastr.error(error.response.data.message);
                }else{
                    toastr.error('Error luego de actualizar tipo de curso');
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
                    const data = new FormData();
                    data.append('_method', 'DELETE');
                    axios.post(route('tipo_curso.destroy', [id]), data)
                    .then(function(respuesta){
                        toastr.success(respuesta.data.message);
                        search();
                    })
                    .catch(function(){
                        toastr.error('Error al eliminar el tipo de curso');
                    });
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\isicursos\resources\views/admin/tipo_curso/index.blade.php ENDPATH**/ ?>