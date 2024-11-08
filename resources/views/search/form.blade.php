<!-- resources/views/search/form.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Search</h1>

    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search products...">
        <button type="submit">Search</button>
    </form>
@endsection
