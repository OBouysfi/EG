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
                <form id="editPaiementForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="participant_id">Participant</label>
                        <select name="participant_id" id="participant_id" class="form-control" required>
                            <!-- Participants seront ajoutés par JavaScript -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="seance">Séance</label>
                        <select name="seance" id="seance" class="form-control" required>
                            <!-- Séances seront ajoutées par JavaScript -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="montant">Montant</label>
                        <input type="number" name="montant" id="montant" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="date_paiement">Date de Paiement</label>
                        <input type="date" name="date_paiement" id="date_paiement" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
