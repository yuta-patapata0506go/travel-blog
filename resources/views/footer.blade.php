@extends('layouts.app')

@section('title', 'Footer-UI')

@section('footer')
{{-- Footer --}}
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="https://facebook.com" target="_blank" class="social-icon">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="social-icon">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com" target="_blank" class="social-icon">
                    <i class="fab fa-x"></i>
                </a>
            </div>

            <div class="col">
                <p class="my-auto">&copy; {{ date('Y') }} Where To Go</p>
            </div>

            <div class="col">
                @guest
                    <!-- No Contact link -->
                @else
                    @if (!Auth::user()->isAdmin())
                        <a href="#" class="footer-link">Contact</a> {{-- {{ url('/contact') }} --}}
                    @endif
                @endguest
                <a href="#" class="footer-link">About</a> {{-- {{ url('/about') }} --}}
            </div>
        </div>
    </div>
</footer>
@endsection

{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
