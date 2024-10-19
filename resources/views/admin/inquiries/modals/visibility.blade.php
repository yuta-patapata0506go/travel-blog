<head>
  <link rel="stylesheet" href="{{ asset('css/admin/modals.css') }}"> <!-- link modal.css -->
</head>

{{-- Visible(Unhide) --}}
<div class="modal fade" id="unhide-inquiry-"> {{-- id: unhide-inquiry-{{ $inquiry->id }} --}}
  <div class="modal-dialog w-50 text-center">
      <div class="modal-content border-dark">
          <div class="modal-header border-dark text-center bg-dark">
              <h5 class="modal-title text-light mx-auto">
                  <i class="fa-solid fa-eye"></i> Unhide Inquiry
              </h5>
          </div>
          <div class="modal-body">
              <div class="mt-3">
                  <div class="inquiry-profile">
                      {{-- @if($inquiry->image)  --}}
                          {{-- <img src="{{ asset('storage/' . $inquiry->image) }}" alt="Inquiry Image" class="inquiry-image"> --}}
                      {{-- @else --}}
                      <i class="fa-solid fa-address-card fa-4x"></i> {{-- Inquiry Icon --}}
                      {{-- @endif --}}
                  </div>
                  <p class="mt-1 text-muted">Inquiry Name{{-- {{ $inquiry->name }} --}}</p>
              </div>
              <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
              <p>Are you sure you want to unhide this inquiry?</p>
          </div>
          <div class="modal-footer border-0 justify-content-center">
              <form action="#" method="post">
                  @csrf
                  @method('PATCH')

                  <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-dark btn-sm">Unhide</button>
              </form>
          </div>
      </div>
  </div>
</div>

{{-- Hidden(Hide) --}}
<div class="modal fade" id="hide-inquiry-"> {{-- id: hide-inquiry-{{ $inquiry->id }} --}}
  <div class="modal-dialog w-50 text-center">
      <div class="modal-content border-dark">
          <div class="modal-header border-dark text-center bg-dark">
              <h5 class="modal-title text-light mx-auto">
                  <i class="fa-solid fa-eye-slash"></i> Hide Inquiry
              </h5>
          </div>
          <div class="modal-body">
              <div class="mt-3">
                  <div class="inquiry-profile">
                      {{-- @if($inquiry->image)  --}}
                          {{-- <img src="{{ asset('storage/' . $inquiry->image) }}" alt="Inquiry Image" class="inquiry-image"> --}}
                      {{-- @else --}}
                          <i class="fas fa-question-circle fa-4x"></i> {{-- Inquiry Icon --}}
                      {{-- @endif --}}
                  </div>
                  <p class="mt-1 text-muted">Inquiry Name{{-- {{ $inquiry->name }} --}}</p>
              </div>
              <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
              <p>Are you sure you want to hide this inquiry?</p>
          </div>
          <div class="modal-footer border-0 justify-content-center">
              <form action="#" method="post">
                  @csrf
                  @method('DELETE')

                  <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-dark btn-sm">Hide</button>
              </form>
          </div>
      </div>
  </div>
</div>