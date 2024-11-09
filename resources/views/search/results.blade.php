<!-- resources/views/search/results.blade.php -->

@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <h1>Search Results for: {{ $query }}</h1>

    @if($results->isEmpty())
        <p>No results found.</p>
    @else
        <ul>
            @foreach($results as $product)
                <li>{{ $product->name }} - {{ $product->description }}</li>
            @endforeach
        </ul>
    @endif


    <!-- ソートが適用されている場合のメッセージ -->
    @if(isset($sort))
        <p>Sorted by: {{ $sort }}</p>
    @endif
@endsection
