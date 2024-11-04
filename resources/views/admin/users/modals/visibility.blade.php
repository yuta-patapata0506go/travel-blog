<head>
  <link rel="stylesheet" href="{{ asset('css/admin/modals.css') }}"> <!-- link modal.css -->
</head>

{{-- Visible(Unhide) --}}
<div class="modal fade" id="unhide-user-{{ $user->id }}">
    <div class="modal-dialog w-50 text-center">
        <div class="modal-content border-dark">
            <div class="modal-header border-dark text-center bg-dark">
                <h5 class="modal-title text-light mx-auto">
                    <i class="fa-solid fa-eye"></i> Unhide User
                </h5>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <div class="user-profile">
                        <i class="fas fa-user-circle fa-4x"></i>
                    </div>
                    <p class="mt-1 text-muted">{{ $user->name }}</p>
                </div>
                <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
                <p>Are you sure you want to unhide this user?</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <form action="{{ route('admin.users.unhide', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark btn-sm">Unhide</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  

{{-- Hidden(Hide) --}}
<div class="modal fade" id="hide-user-{{ $user->id }}">
    <div class="modal-dialog w-50 text-center">
        <div class="modal-content border-dark">
            <div class="modal-header border-dark text-center bg-dark">
                <h5 class="modal-title text-light mx-auto">
                    <i class="fa-solid fa-eye-slash"></i> Hide User
                </h5>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <div class="user-profile">
                        <i class="fas fa-user-circle fa-4x"></i>
                    </div>
                    <p class="mt-1 text-muted">{{ $user->name }}</p>
                </div>
                <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
                <p>Are you sure you want to hide this user?</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <form action="{{ route('admin.users.hide', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
  
                    <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark btn-sm">Hide</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  