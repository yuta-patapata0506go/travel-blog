<head>
    <link rel="stylesheet" href="{{ asset('css/admin/modals.css') }}">
  </head>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal{{ $spot->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog w-50 text-center">
      <div class="modal-content border-dark">
        <div class="modal-header bg-dark text-center d-flex justify-content-center">
          <h5 class="modal-title text-light" id="deleteModalLabel">Delete Spot</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
            <div class="mt-3">
                @if($spot->images->first())
                    <img src="{{ asset('storage/' . $spot->images->first()->image_url) }}" alt="Spot Image" width="100">
                @else
                    <i class="fa-solid fa-location-dot"></i> 
                @endif
                <p class="mt-1 text-muted">{{ $spot->name }} (ID: {{ $spot->id }} )</p>
            </div>
            <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
            <p>Are you sure you want to delete this spot?</p>
            <p class="text-danger fw-bold">Posts related to this spot will also be deleted.</p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
            <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
            <form id="deleteForm" action="{{ route('admin.spots.deleteSpot', $spot->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" data-id="{{ $spot->id }}" class="btn btn-dark btn-sm">Delete</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  