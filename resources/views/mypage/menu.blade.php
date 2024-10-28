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
                  <a href="{{route('profile.edit')}}"><i class="fa-regular fa-circle-check"></i></a>
                  <label for="edit">Edit Profile</label>
                  <br>
                  <a href="{{route('profile.favorite')}}"><i class="fa-regular fa-circle-check"></i></a>
                    <label for="favorite">Edit Favorite</label>   
                </div>
            </div>      
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-danger btn-black" data-bs-dismiss="modal">Cancel</button>
            </div>          
       </div>
   </div>
 </div>