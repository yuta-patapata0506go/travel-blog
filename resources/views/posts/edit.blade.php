<link href="{{ asset('css/event-post.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/modal.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

@extends('layouts.app')

@section('title', 'Post/Edit')

@section('content')
<div class="background"></div> <!-- 背景画像 -->     
<div class="container container-fluid mt-5">
@if ($type == 0)
  <h2 class="text-center mb-4">Edit Event Post Form</h2>
@else
  <h2 class="text-center mb-4">Edit Tourism Post Form</h2>
@endif
    
    <form action="{{ route('post.update', $post->id) }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="spot" class="form-label">Spot <span class="text-danger">*</span>:</label>
            <select class="form-select" id="spot" name="spot" required>
    @foreach ($spots as $spot)
        <option value="{{ $spot->id }}" {{ (int) $spot->id === (int) $post->spots_id ? 'selected' : '' }}>
            {{ $spot->name }}
        </option>
    @endforeach
</select>

        </div>
    
     <!-- 保存されている画像のサムネイル表示部分 
    <div class="d-flex mb-2">
        @foreach ($post->images as $image)
            <img src="{{ $image->image_url }}" class="img-responsive small-image">
        @endforeach
    </div>

     ファイル選択フィールド 
    <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple>
    <small class="form-text text-muted">Acceptable formats: jpeg, jpg, png, gif. Max file size: 2MB.</small>
</div> -->

<div class="mb-3">
    <label for="image" class="form-label">Image <span class="text-danger">*</span>:</label>
    
    <!-- 保存されている画像のサムネイル表示部分 -->
    <div class="d-flex mb-2">
        @foreach ($post->images as $image)
            <div class="position-relative me-2">
                <!-- 正しいパスで画像を表示 -->
                <img src="{{ asset('storage/' . $image->image_url) }}" class="img-responsive small-image" style="width: 100px; height: auto;">
                <!-- 削除ボタン -->
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="confirmDelete({{ $image->id }})">-</button>
            </div>
        @endforeach
    </div>


    <!-- ファイル選択フィールド -->
    <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple>
    <small class="form-text text-muted">Acceptable formats: jpeg, jpg, png, gif. Max file size: 2MB.</small>
</div>

<!-- 削除確認用のモーダル -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this image?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>






        <div class="mb-3">
            <label for="comments" class="form-label">Title:<span class="text-danger">*</span>:</label>
            <input type="text" class="form-control" id="title" name="title"  value="{{ $post->title }}" required>
        </div>
        @if ($type == 0)
        <div class="mb-3">
            <label for="event_name" class="form-label">Event name <span class="text-danger">*</span>:</label>
            <input type="text" class="form-control" id="event_name" name="event_name"  value="{{ $post->event_name }}" required>
        </div>
        @endif 

        <div class="mb-3">
            <label for="comments" class="form-label">Comments:</label>
            <textarea class="form-control" id="comments" name="comments" rows="3">{{ $post->comments }}</textarea>
        </div>

       <div class="mb-3">
            <label class="form-label">Category:</label>
            <button type="button" class="btn-category" data-bs-toggle="modal" data-bs-target="#categoryModal">
                Choose a category
            </button>
            <div id="selectedCategories" class="mt-2">
                <!-- 選択済みのカテゴリを表示 -->
                @foreach($selectedCategories as $categoryId)
                    <span class="category-badge">{{ $all_categories->find($categoryId)->name }}</span>
                @endforeach
            </div>

            <!-- 隠しフィールド（カテゴリIDを配列で保持） -->
            <div id="category-inputs">
                @foreach($selectedCategories as $categoryId)
                    <input type="hidden" name="category[]" value="{{ $categoryId }}">
                @endforeach
            </div>
        </div>

       


        @if ($type == 0)
        <div class="row">
          <div class="col-md-6">
            <label for="start-date" class="form-label">Start Date <span class="text-danger">*</span>:</label>
            <input type="date" id="start-date" name="start_date" class="form-control" value="{{ $startDate }}">
          </div>
          <div class="col-md-6">
            <label for="end-date" class="form-label">End Date <span class="text-danger">*</span>:</label>
            <input type="date" id="end-date" name="end_date" class="form-control" value="{{ $endDate }}">
          </div>
        </div>
        @endif 
       
        <div class="mb-3">
    <label for="fee" class="form-label mt-2">Fee:</label>
    <div style="display: flex; gap: 10px; align-items: center;"> 
        <!-- Adult Fee -->
        <div class="input-group" style="flex: 1;">
            <span class="input-group-text">Adult</span>
            <input 
                type="number" 
                class="form-control form-shadow" 
                id="adult_fee" 
                name="adult_fee" 
                placeholder="Enter adult fee amount" 
                min="0" 
                step="0.01" 
                value="{{ $post->adult_fee ?? '' }}"
            >
            <select 
                class="form-select" 
                id="adult_currency" 
                name="adult_currency" 
                style="width: 80px;"
            >
                <option value="" disabled {{ !$post->adult_currency ? 'selected' : '' }}>Select Currency</option>
                <option value="Free" {{ $post->child_currency == 'Free' ? 'selected' : '' }}>Free</option>
                <option value="JPY" {{ $post->adult_currency == 'JPY' ? 'selected' : '' }}>Yen</option>
                <option value="USD" {{ $post->adult_currency == 'USD' ? 'selected' : '' }}>USD</option>
                <option value="EUR" {{ $post->adult_currency == 'EUR' ? 'selected' : '' }}>Euro</option>
                <option value="GBP" {{ $post->adult_currency == 'GBP' ? 'selected' : '' }}>British Pound</option>
                <option value="AUD" {{ $post->adult_currency == 'AUD' ? 'selected' : '' }}>Australian Dollar</option>
                <option value="CAD" {{ $post->adult_currency == 'CAD' ? 'selected' : '' }}>Canadian Dollar</option>
                <option value="CHF" {{ $post->adult_currency == 'CHF' ? 'selected' : '' }}>Swiss Franc</option>
                <option value="CNY" {{ $post->adult_currency == 'CNY' ? 'selected' : '' }}>Chinese Yuan</option>
                <option value="KRW" {{ $post->adult_currency == 'KRW' ? 'selected' : '' }}>South Korean Won</option>
                <option value="INR" {{ $post->adult_currency == 'INR' ? 'selected' : '' }}>Indian Rupee</option>
            </select>
        </div>      

        <!-- Child Fee -->
        <div class="input-group" style="flex: 1;">
            <span class="input-group-text">Child</span>
            <input 
                type="number" 
                class="form-control form-shadow" 
                id="child_fee" 
                name="child_fee" 
                placeholder="Enter child fee amount" 
                min="0" 
                step="0.01" 
                value="{{ $post->child_fee ?? '' }}"
            >
            <select 
                class="form-select" 
                id="child_currency" 
                name="child_currency" 
                style="width: 80px;"
            >
                <option value="" disabled {{ !$post->child_currency ? 'selected' : '' }}>Select Currency</option>
                <option value="Free" {{ $post->child_currency == 'Free' ? 'selected' : '' }}>Free</option>
                <option value="JPY" {{ $post->child_currency == 'JPY' ? 'selected' : '' }}>Yen</option>
                <option value="USD" {{ $post->child_currency == 'USD' ? 'selected' : '' }}>USD</option>
                <option value="EUR" {{ $post->child_currency == 'EUR' ? 'selected' : '' }}>Euro</option>
                <option value="GBP" {{ $post->child_currency == 'GBP' ? 'selected' : '' }}>British Pound</option>
                <option value="AUD" {{ $post->child_currency == 'AUD' ? 'selected' : '' }}>Australian Dollar</option>
                <option value="CAD" {{ $post->child_currency == 'CAD' ? 'selected' : '' }}>Canadian Dollar</option>
                <option value="CHF" {{ $post->child_currency == 'CHF' ? 'selected' : '' }}>Swiss Franc</option>
                <option value="CNY" {{ $post->child_currency == 'CNY' ? 'selected' : '' }}>Chinese Yuan</option>
                <option value="KRW" {{ $post->child_currency == 'KRW' ? 'selected' : '' }}>South Korean Won</option>
                <option value="INR" {{ $post->child_currency == 'INR' ? 'selected' : '' }}>Indian Rupee</option>
            </select>
        </div>         
    </div>
</div>


        <div class="mb-3">
            <label for="helpful_info" class="form-label">Useful Information:</label>
            <input type="text" class="form-control" id="helpful_info" name="helpful_info" value="{{ old('helpful_info', $post->helpful_info) }}">
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn-post btn-lg-custom">Update</button>
            <button type="button" class="btn cancel-btn btn-lg-custom" onclick="window.location.href='{{ route('post.show', $post->id) }}'">Cancel</button>

        </div>       
    </form>
</div>

<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="categoryModalLabel">Select Categories</h5>
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
                                            <input 
                                                class="form-check-input" 
                                                name="category_modal" 
                                                type="checkbox" 
                                                value="{{ $child->id }}" 
                                                data-name="{{ $child->name }}"
                                                {{ in_array($child->id, $selectedCategories) ? 'checked' : '' }}>
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
                <button type="button" id="selectedcategory-btn" class="btn btn-select btn-large" data-bs-dismiss="modal">Select</button>
            </div>
        </div>
    </div>
</div>


                    
               

@endsection
@section('scripts')

    <script src="{{ asset('js/edit-event.js') }}"></script>

@endsection
