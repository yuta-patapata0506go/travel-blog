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
                    <i class="fab fab fa-twitter "></i>
                </a>
            </div>

            <div class="col">
                <p class="my-auto">&copy; {{ date('Y') }} Where To Go</p>
            </div>

            <div class="col">
                @guest
                    <!-- Guest footer only -->
                    <a href="#" class="footer-link">Contact</a> {{-- {{ url('/contact') }} --}}
                    <a href="#" class="footer-link">About</a> {{-- {{ url('/about') }} --}}
                @else
                    {{-- 
                    @if (!Auth::user()->isAdmin())
                        <a href="#" class="footer-link">Contact</a> {{-- {{ url('/contact') }} --}}
                    {{-- @endif  --}}
                    {{-- Admin and logged-in users will not see these links for now --}}
                    {{-- <a href="#" class="footer-link">Contact</a> --}}
                    <a href="#" class="footer-link">About</a> {{-- {{ url('/about') }} --}}
                @endguest
            </div>
        </div>
    </div>
</footer>

