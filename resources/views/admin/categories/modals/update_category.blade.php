<head>
<link rel="stylesheet" href="{{asset('css/admin/modals.css')}}">
</head>


<div class="modal fade" id="update-category-{{$category->id}}"> 
    <div class="modal-dialog w-50 text-center">
        <div class="modal-content border-dark">
            <div class="modal-header border-dark text-center bg-dark">
                <h5 class="modal-title text-light mx-auto">Update Category</h5>
            </div>
            <div class="modal-body border-0 justify-content-center rounded">
                <form action="{{route('admin.categories.update',$category->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    
                    <div class="container mb-4">
                        <p>Category ID: {{$category->id}}</p>
                        <label for="category-name-{{$category->id}}" class="form-label">Category Name</label>
                        <input type="text" id="category-name-{{$category->id}}" name="name" class="form-control" value="{{$category->name}}">
                    </div>
                    <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

