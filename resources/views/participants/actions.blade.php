<div class="btn-group" role="group">
    <button type="button" class="btn btn-warning btn-sm" onclick="editParticipant({{ $participant->id }})">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" class="btn btn-danger btn-sm" onclick="deleteParticipant({{ $participant->id }})">
        <i class="fa fa-trash"></i>
    </button>
</div>
