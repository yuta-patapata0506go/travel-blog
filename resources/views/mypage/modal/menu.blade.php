

@section('css')
  <link rel="stylesheet" href="{{ asset('css/style_personal.css')}}">  
@endsection

<div class="modal fade" id="select-menu-{{ $user->id }}">
   <div class="modal-dialog">
       <div class="modal-content border-color">
           <div class="modal-header border-color">
               <h3 class="h5 modal-title text-s24">
                   Select the menu
               </h3>
           </div>
           <div class="modal-body">
               <div class="mt-3">
                    <div class="row">
                        <div class="col-auto">
                            <a href="{{route('profile.edit')}}"><i class="fa-regular fa-circle-check btn-style"></i></a>
                        </div>
                        <div class="col-auto">
                            <label for="edit" class="mt-1 text-s16">Edit Profile</label>
                        </div>  
                    </div> 
                    <div class="row">
                        <div class="col-auto">
                            <a href="{{route('profile.favorite')}}"><i class="fa-regular fa-circle-check btn-style"></i></a>
                        </div>
                        <div class="col-auto">
                            <label for="favorite" class="mt-1 text-s16">Edit Favorite</label>
                        </div>                      
                    </div>
                </div>
            </div>      
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-danger btn-modal" data-bs-dismiss="modal">Cancel</button>
            </div>          
       </div>
   </div>
 </div>