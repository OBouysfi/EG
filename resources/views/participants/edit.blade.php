<!-- Modal pour modifier un participant -->
<div class="modal fade" id="editParticipantModal" tabindex="-1" role="dialog" aria-labelledby="editParticipantModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editParticipantModalLabel">Modifier Participant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editParticipantForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="centre_id">Centre</label>
                        <select class="form-control" id="centre_id" name="centre_id" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nom_prenom">Nom et Prénom</label>
                        <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="numero_cin">Numéro CIN</label>
                        <input type="text" class="form-control" id="numero_cin" name="numero_cin" required>
                    </div>
                    <div class="form-group">
                        <label for="date_naissance">Date de Naissance</label>
                        <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                    </div>
                    <div class="form-group">
                        <label for="ville_naissance">Ville de Naissance</label>
                        <input type="text" class="form-control" id="ville_naissance" name="ville_naissance" required>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="form-group">
                        <label for="ville_centre">Ville du Centre</label>
                        <input type="text" class="form-control" id="ville_centre" name="ville_centre" required>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" required>
                    </div>
                    <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <select class="form-control" id="categorie" name="categorie" required>
                            <option value="CAF">CAF</option>
                            <option value="JCB">JCB</option>
                            <option value="PACK">PACK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="montant_inscription">Montant Inscription</label>
                        <input type="number" class="form-control" id="montant_inscription" name="montant_inscription" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="commercial">Commercial</label>
                        <input type="text" class="form-control" id="commercial" name="commercial" required>
                    </div>
                    <div class="form-group">
                        <label for="etat">État</label>
                        <select class="form-control" id="etat" name="etat" required>
                            <option value="Non">Non</option>
                            <option value="Livré">Livré</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reste">Reste</label>
                        <input type="number" class="form-control" id="reste" name="reste" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>
</div>
