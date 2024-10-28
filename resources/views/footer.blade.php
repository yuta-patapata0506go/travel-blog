{{-- Footer --}}
<footer class="footer text-center {{ Auth::check() && Auth::user()->isAdmin() ? 'footer-admin' : '' }}">
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
                    <i class="fab fa-twitter"></i>
                </a>
            </div>

            <div class="col">
                <p class="my-auto">&copy; {{ date('Y') }} Where To Go</p>
            </div>

            <div class="col">
                @guest
                    <a href="{{ route('about') }}" class="footer-link">About</a>
                @else
                    @if (!Auth::user()->isAdmin())
                        <a href="{{ route('contact.create') }}" class="footer-link">Contact</a>
                    @endif
                    <a href="{{ route('about') }}" class="footer-link">About</a>
                @endguest
            </div>
        </div>
    </div>
</footer>

