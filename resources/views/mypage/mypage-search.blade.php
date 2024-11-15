@section('css')
  <link rel="stylesheet" href="{{ asset('css/style_personal.css')}}">  
@endsection

<div class="mypage-bg"> 
            <form action="{{ route('mypage.search') }}" method="GET">
                <input type="text" name="keyword" placeholder="Search your posts">
                <button type="submit" class="btn-green text-center">Search</button>
            </form>
</div>
            