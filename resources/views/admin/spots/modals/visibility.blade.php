<!-- Hide Spot Modal -->
<div class="modal fade" id="hide-spot-{{ $spot->id }}" tabindex="-1" aria-labelledby="hideSpotModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hideSpotModalLabel">Hide Spot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to hide this spot?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.spots.hide', $spot->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger">Hide</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Unhide Spot Modal -->
<div class="modal fade" id="unhide-spot-{{ $spot->id }}" tabindex="-1" aria-labelledby="unhideSpotModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unhideSpotModalLabel">Unhide Spot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to unhide this spot?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.spots.unhide', $spot->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Unhide</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
