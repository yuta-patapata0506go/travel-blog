@if ($type == 0)
@extends('layouts.app')




@section('css')
<link href="{{ asset('css/event-post.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- 観光用のフォーム -->
@elseif ($type == 1)
    <!-- イベント用のフォーム -->
@endif