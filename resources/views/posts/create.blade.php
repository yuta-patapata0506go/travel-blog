@extends('layouts.app')

@section('title', 'Post/Create')

@section('css')
@if ($type == 0)
    <link href="{{ asset('css/event-post.css') }}" rel="stylesheet">
@elseif ($type == 1)
    <link href="{{ asset('css/tourism-post.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
@endif
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="background"></div> <!-- 背景画像 -->
<div class="container container-fluid mt-5">

    @if ($type == 0)
        <h2 class="text-center mb-4">Event Post Form</h2>
    @else
        <h2 class="text-center mb-4">Tourism Post Form</h2>
    @endif

    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="spot" class="form-label">Spot <span class="text-danger">*</span>:</label>
            <select class="form-select form-shadow" id="spot" name="spot" required>
                <option value="">Please select a spot. If no spot is displayed here, you will need to go back to the previous page and register a spot first.</option>
                @foreach ($spots as $spot)
                    <option value="{{ $spot->id }}">{{ $spot->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image <span class="text-danger">*</span>:</label>
            <input type="file" class="form-control form-shadow" id="image" name="image[]" accept="image/*" multiple>
            <small class="form-text text-muted">The acceptable <span class="text-danger">multiple images</span> and formats are .jpg, .jpeg, .png, .gif (max 2MB)</small>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span>:</label>
            <input type="text" class="form-control form-shadow" id="title" name="title" placeholder="e.g.) You must go here!!" required>
        </div>

        @if ($type == 0)
            <div class="mb-3">
                <label for="event_name" class="form-label">Event name <span class="text-danger">*</span>:</label>
                <input type="text" class="form-control form-shadow" id="event_name" name="event_name" placeholder="e.g.) Sumida River Fireworks Festival" required>
            </div>
        @endif

        <div class="mb-3">
            <label for="comments" class="form-label">Comments:</label>
            <textarea class="form-control form-shadow" id="comments" name="comments" rows="3" placeholder="e.g)Experience the dazzling lights and vibrant atmosphere of the Sumida River Fireworks Festival!... "></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category:<span class="text-danger">*</span>:</label>
            <button type="button" class="btn-category" data-bs-toggle="modal" data-bs-target="#categoryModal2">Choose a category</button>
            <div id="selectedCategories" class="mt-2"></div>
        </div>

        @if ($type == 0)
            <div class="row">
                <div class="col-md-6">
                    <label for="start-date" class="form-label">Start Date <span class="text-danger">*</span>:</label>
                    <input type="date" id="start-date" name="start_date" class="form-control form-shadow">
                </div>
                <div class="col-md-6">
                    <label for="end-date" class="form-label">End Date <span class="text-danger">*</span>:</label>
                    <input type="date" id="end-date" name="end_date" class="form-control form-shadow">
                </div>
            </div>
        @endif

            <div class="mb-3">
                <label for="fee" class="form-label mt-2">Fee:</label>
                <div style="display: flex; gap: 10px; align-items: center;"> 
                    <!-- Adult Fee -->
                    <div class="input-group" style="flex: 1;">
                        <span class="input-group-text">Adult</span>
                        <input type="number" class="form-control form-shadow" id="adult_fee" name="adult_fee" placeholder="Enter adult fee amount" min="0" step="0.01">
                        <select class="form-select" id="adult_currency" name="adult_currency" style="width: 80px;">
                            <option value="" disabled selected>Select Currency</option>
                            <option value="Free">Free</option>
                            <option value="JPY">Yen</option>
                            <option value="USD">USD</option>
                            <option value="EUR">Euro</option>
                            <option value="GBP">British Pound</option>
                            <option value="AUD">Australian Dollar</option>
                            <option value="CAD">Canadian Dollar</option>
                            <option value="CHF">Swiss Franc</option>
                            <option value="CNY">Chinese Yuan</option>
                            <option value="KRW">South Korean Won</option>
                            <option value="INR">Indian Rupee</option>
                            <option value="PHP">Peso</option>
                            <option value="AED">AED</option>
                        </select>
                    </div>      
                    <!-- Child Fee -->
                    <div class="input-group" style="flex: 1;">
                        <span class="input-group-text">Child</span>
                        <input type="number" class="form-control form-shadow" id="child_fee" name="child_fee" placeholder="Enter child fee amount" min="0" step="0.01">
                        <select class="form-select" id="child_currency" name="child_currency" style="width: 80px;">
                            <option value="" disabled selected>Select Currency</option>
                            <option value="Free">Free</option>
                            <option value="JPY">Yen</option>
                            <option value="USD">USD</option>
                            <option value="EUR">Euro</option>
                            <option value="GBP">British Pound</option>
                            <option value="AUD">Australian Dollar</option>
                            <option value="CAD">Canadian Dollar</option>
                            <option value="CHF">Swiss Franc</option>
                            <option value="CNY">Chinese Yuan</option>
                            <option value="KRW">South Korean Won</option>
                            <option value="INR">Indian Rupee</option>
                            <option value="PHP">Peso</option>
                            <option value="AED">AED</option>
                        </select>
                    </div>         
                </div>
            </div>




            <div class="mb-3">
                <label for="info" class="form-label">Useful Information:</label>
                <input type="text" class="form-control form-shadow" id="helpful_info" name="helpful_info" placeholder="Enter any useful information">
            </div>

        <input type="hidden" name="type" value="{{ $type }}">

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn-post btn-lg-custom">Post</button>
            <button type="button" class="btn cancel-btn btn-lg-custom" onclick="window.location.href='{{ route('select-post-form') }}'">Cancel</button>
        </div>

        <!-- Category Modal -->
        <div class="modal fade" id="categoryModal2" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel">Select Categories</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="cat-form-div">
                        <form id="cat-form">
                            @foreach($all_categories->where('parent_id', null) as $parent)
                                <div class="form-group">
                                    <label for="parent_{{ $parent->id }}">■{{ $parent->name }}</label>
                                    <div class="row">
                                        @foreach($all_categories->where('parent_id', $parent->id) as $child)
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input2" name="category[]" type="checkbox" value="{{ $child->id }}" data-name="{{ $child->name }}">
                                                    <label class="form-check-label" for="{{ strtolower($child->name) }}">{{ $child->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="category-input" name="selected_categories">
                        <button type="button" id="selectedcategory-btn" class="btn btn-select btn-large" data-bs-dismiss="modal">
                        Select
                    </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection

@section('scripts')

    <script src="{{ asset('js/event-post.js') }}"></script>

@endsection
