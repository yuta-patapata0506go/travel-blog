<head>
    <link rel="stylesheet" href="{{ asset('css/admin/modals.css') }}"> <!-- link modal.css -->
  </head>
  
  <div class="modal fade" id="category-modal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog w-50">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center bg-dark">
                <h5 class="modal-title mx-auto text-light" id="categoryModalLabel">Recommended Posts</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <form id="category-form">
                    <p>Please choose posts to display recommendations.</p>
                    {{-- @foreach($categories as $category)
                        <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="category{{ $category->id }}" value="{{ $category->id }}">
                            <label class="form-check-label" for="category{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach --}}
                    {{-- Sample categories for testing --}}
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="category1" value="category1">
                        <label class="form-check-label" for="category1">Category 1</label>
                    </div>
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="category2" value="category2">
                        <label class="form-check-label" for="category2">Category 2</label>
                    </div>
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="category3" value="category3">
                        <label class="form-check-label" for="category3">Category 3</label>
                    </div>
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="category4" value="category4">
                        <label class="form-check-label" for="category4">Category 4</label>
                    </div>
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" id="category5" value="category5">
                        <label class="form-check-label" for="category5">Category 5</label>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="#">Save</button> {{-- onclick:submitCategories() --}}
            </div>
        </div>
    </div>
  </div>
  
  