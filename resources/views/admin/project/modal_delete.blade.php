<div class="modal" tabindex="-1" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Una volta eliminata non sarà più possibile recuperarlo. Sei sicuro di procedere con l'eleminazione?
                </p>
            </div>
            <div class="modal-footer">
                <form id="form_delete" action="" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm btn-danger">
                        Cancella
                    </button>

                </form>

                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
