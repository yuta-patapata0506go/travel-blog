<head>
    <link rel="stylesheet" href="{{ asset('css/admin/modals.css') }}"> <!-- link modal.css -->
</head>
  
<div class="modal fade" id="category-modal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog w-50">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center bg-dark">
                <h5 class="modal-title mx-auto text-light" id="categoryModalLabel">Recommended Posts</h5>
            </div>
            <div class="modal-body border-0 justify-content-center rounded">
                <form method="POST" action="{{ route('admin.recommendations.save') }}">
                    @csrf
                    @method('PATCH')
                    <p class="text-center">Please choose 1 category to display recommendations.</p>
                    @foreach($categories as $category)
                        @if (is_null($category->parent_id))
                            <hr>
                            <h5 class="text-center">{{ $category->name }}</h5>
                        @else
                            <div class="form-check d-flex justify-content-center mb-2">
                                <input class="form-check-input" type="radio" name="category_id" id="category{{ $category->id }}" value="{{ $category->id }}" @if (!empty($existingRecommendation) && $existingRecommendation->category_id == $category->id)
                                checked @endif>
                                <label class="form-check-label" for="category{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endif
                    @endforeach
                    @error('category_id') 
	                    <div class="text-danger small">{{ $message }}</div> 
                    @enderror
                    <div class="text-center mt-3">
                        <hr>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  
  


