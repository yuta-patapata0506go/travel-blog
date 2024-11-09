<head>
 <link rel="stylesheet" href="{{ asset('css/admin/modals.css') }}"> <!-- link modal.css -->
</head>

<!-- parents -->
{{-- Visible(Unhide) --}}
<div class="modal fade" id="unhide-category-{{ $category->id }}">
 <div class="modal-dialog w-50 text-center">
   <div class="modal-content border-dark">
     <div class="modal-header border-dark text-center bg-dark">
       <h5 class="modal-title text-light mx-auto">
         <i class="fa-solid fa-eye"></i> Unhide Category
       </h5>
     </div>
     <div class="modal-body">
       <div class="mt-3">
          <i class="fa-solid fa-address-card fa-4x"></i>
          <p class="mt-1 text-muted">{{ $category->name }}</p>
       </div>
       <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
       <p>Are you sure you want to unhide this category?</p>
     </div>
     <div class="modal-footer border-0 justify-content-center">
       <form action="{{ route('admin.categories.changeVisibility', $category->id) }}" method="post">
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
<div class="modal fade" id="hide-category-{{ $category->id }}">
 <div class="modal-dialog w-50 text-center">
   <div class="modal-content border-dark">
     <div class="modal-header border-dark text-center bg-dark">
       <h5 class="modal-title text-light mx-auto">
         <i class="fa-solid fa-eye-slash"></i> Hide Category
       </h5>
     </div>
     <div class="modal-body">
       <div class="mt-3">
        <i class="fa-solid fa-address-card fa-4x"></i>
        <p class="mt-1 text-muted">{{ $category->name }}</p>
       </div>
       <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
       <p>Are you sure you want to hide this Category?</p>
     </div>
     <div class="modal-footer border-0 justify-content-center">
       <form action="{{ route('admin.categories.changeVisibility', $category->id) }}" method="post">
         @csrf
         @method('PATCH')
         <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
         <button type="submit" class="btn btn-dark btn-sm">Hide</button>
       </form>
     </div>
   </div>
 </div>
</div>

