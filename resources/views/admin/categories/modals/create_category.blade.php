<link rel="stylesheet" href="{{asset('css/admin/modals.css')}}">


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
              <input type="text" id="category-name" name="title" class="form-control" placeholder="Category Name here...">
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

