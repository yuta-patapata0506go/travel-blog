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
                    <!-- Guest footer only -->
                    <a href="#" class="footer-link">About</a>
                @else
                    @if (!Auth::user()->isAdmin())
                        <a href="#" class="footer-link">Contact</a> {{-- {{ url('/contact') }} --}}
                    @endif
                    <a href="#" class="footer-link">About</a> {{-- {{ url('/about') }} --}}
                @endguest
            </div>
        </div>
    </div>
</footer>

