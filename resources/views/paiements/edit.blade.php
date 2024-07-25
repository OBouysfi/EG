<div class="modal fade" id="editPaiementModal" tabindex="-1" aria-labelledby="editPaiementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPaiementModalLabel">Modifier le Paiement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPaiementForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="participant_id">Participant</label>
                        <select name="participant_id" id="participant_id" class="form-control" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="seance">Séance</label>
                        <select name="seance" id="seance" class="form-control">
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="S4">S4</option>
                            <option value="Centre">Centre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="montant">Montant</label>
                        <input type="number" step="0.01" name="montant" id="montant" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="date_paiement">Date de Paiement</label>
                        <input type="date" name="date_paiement" id="date_paiement" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>