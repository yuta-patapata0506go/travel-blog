<head>
 <link rel="stylesheet" href="{{ asset('css/admin/modals.css') }}"> <!-- link modal.css -->
</head>

<div class="modal fade" id="create-category"> 
  <div class="modal-dialog w-50 text-center">
      <div class="modal-content border-dark">
          <div class="modal-header border-dark text-center bg-dark">
              <h5 class="modal-title text-light mx-auto">Create Category</h5>
          </div>
          <div class="modal-body">
            <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="container">
              <label for="category-name" class="form-label">Category Name</label>
              <br>
              <input type="text" id="category-name" name="name" class="form-control" placeholder="Category Name here...">

              <label for="parent_id">Parent Category:</label>
              <select name="parent_id" id="parent_id" class="form-select">
                <option value="">None</option>
                @foreach($parentCategories as $parent)
                  <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
             </select>
           </div>
           <br>
           <br>
                  
           <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
           <button type="submit" class="btn btn-dark btn-sm">Create</button>
           </form>
          </div>
      </div>
  </div>
</div>