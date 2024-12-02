<div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-start">
                    <div class="mr-2">
                        <i class="fas fa-fw fa-exclamation-circle "></i>
                    </div>
                    <div>
                        <h5 class="modal-title " id="exampleModalLabel">Confirmación de Eliminación</h5>
                    </div>
                </div>
                <div class="modal-body">
                    <span>¿Estás seguro de que deseas eliminar este registro?</span>
                    <span>Todos sus datos se eliminarán de forma permanente. Esta acción no se puede deshacer.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
                        Cancelar
                    </button>
                    <form action="{{ $deleteFormAction }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var modalElement = document.getElementById('exampleModal');
            var modal = new bootstrap.Modal(modalElement);
            window.addEventListener('show-bootstrap-modal', () => {
                modal.show();
            });
            window.addEventListener('close-modal', () => {
                modal.hide();
            });
        });

    </script>
@stop
