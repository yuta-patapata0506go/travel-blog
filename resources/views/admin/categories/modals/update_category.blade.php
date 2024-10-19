<link rel="stylesheet" href="{{asset('css/admin/modals.css')}}">

<div class="modal fade" id="update-category"> 
    <div class="modal-dialog w-50 text-center">
        <div class="modal-content rounded border-dark">
            <div class="modal-header border-dark text-center bg-dark">
                <h5 class="modal-title text-light mx-auto">Update Category</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    @csrf
                    @method('PATCH')
                    
                    <div class="container">
                        <p>Category ID: 1</p>
                        <label for="category-name" class="form-label">Category Name</label>
                        <input type="text" id="category-name" class="form-control" value="Category 1">
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark btn-sm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
