@extends('layouts.app')

@section('title', 'Reply Mail')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/create_reply.css') }}">
@endsection

@section('content')
    <h1>{{ $responseTitle }}</h1>
    <p>{{ $responseBody }}</p>
@endsection
