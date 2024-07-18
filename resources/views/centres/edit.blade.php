<div class="modal fade" id="editCentreModal" tabindex="-1" role="dialog" aria-labelledby="editCentreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCentreModalLabel">Modifier Centre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCentreForm">
                    <div class="form-group">
                        <label for="centreName">Nom du centre</label>
                        <input type="text" class="form-control" id="centreName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="centreRegion">Région</label>
                        <select class="form-control" id="centreRegion" name="region_id" required>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>
</div>