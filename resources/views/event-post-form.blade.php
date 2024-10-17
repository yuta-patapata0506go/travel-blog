<link href="{{ asset('css/event-post.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">


@extends('layouts.app')

@section('content')
<div class="background"></div> <!-- 背景画像 -->     
<div class="container container-fluid mt-5">
    <h2 class="text-center mb-4">Event Post Form</h2>
    
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="type" class="form-label">Spot <span class="text-danger">*</span>:</label>
            <select class="form-select" id="spot" name="spot" required>
                <option value="">Please select a spot. If no spot is displayed here, you will need to go back to the previous page and register a spot first.</option>
                <option value="public">Sapporo clock tower</option>
                <option value="private">Tokyo tower</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image <span class="text-danger">*</span>:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <small class="form-text text-muted">The acceptable formats are .jpg, .jpeg, .png, .gif (max 2MB)</small>
        </div>

        <div class="mb-3">
            <label for="event_name" class="form-label">Event name <span class="text-danger">*</span>:</label>
            <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Enter event name" required>
        </div>

        <div class="mb-3">
            <label for="comments" class="form-label">Comments:</label>
            <textarea class="form-control" id="comments" name="comments" rows="3" placeholder="Enter comments"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Category:</label>
            <button type="button" class="btn-category" data-bs-toggle="modal" data-bs-target="#categoryModal">
                Choose a category
            </button>
            <div id="selectedCategories" class="mt-2"></div>
        </div>
        <div class="row">
  <div class="col-md-6">
    <label for="start-date" class="form-label">Start Date <span class="text-danger">*</span>:</label>
    <input type="date" id="start-date" name="start_date" class="form-control">
  </div>
  <div class="col-md-6">
    <label for="end-date" class="form-label">End Date <span class="text-danger">*</span>:</label>
    <input type="date" id="end-date" name="end_date" class="form-control">
  </div>
</div>
       
        <div class="mb-3">
            <label for="fee" class="form-label">Fee:</label>
            <input type="text" class="form-control" id="fee" name="fee" placeholder="Enter fee amount">
        </div>

        <div class="mb-3">
            <label for="info" class="form-label">Useful Information:</label>
            <input type="text" class="form-control" id="info" name="info" placeholder="Enter any useful information">
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn-post btn-lg-custom">Post</button>
            <button type="button" class="btn cancel-btn btn-lg-custom">Cancel</button>
        </div>       
    </form>
</div>

<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Select Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                    <!-- Season -->
                    <div class="form-group">
                        <label for="season">■Season</label>
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="spring" value="Spring">
                              <label class="form-check-label" for="spring">Spring</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="summer" value="Summer">
                              <label class="form-check-label" for="summer">Summer</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-check">
                               <input class="form-check-input" type="checkbox" id="autumn" value="Autumn">
                               <label class="form-check-label" for="autumn">Autumn</label>
                               </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-check">
                               <input class="form-check-input" type="checkbox" id="winter" value="Winter">
                               <label class="form-check-label" for="winter">Winter</label>
                            </div>
                           </div>
                    </div>
                    <!-- With -->
                    <div class="form-group">
                        <label for="with">■With</label>
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="kids" value="Kids">
                              <label class="form-check-label" for="kids">Kids</label>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="couple" value="Couple">
                              <label class="form-check-label" for="couple">Couple</label>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="family" value="Family">
                              <label class="form-check-label" for="family">Family</label>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="friends" value="Friends">
                              <label class="form-check-label" for="friends">Friends</label>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="solo" value="Solo">
                              <label class="form-check-label" for="solo">Solo</label>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="2 people" value="2 people">
                              <label class="form-check-label" for="2 people">2 people</label>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="3-4 people" value="3-4 people">
                              <label class="form-check-label" for="3-4 people">3-4 people</label>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="over 5 people" value="over 5 people">
                              <label class="form-check-label" for="over 5 people">over 5 people</label>
                              </div>
                           </div>
                        </div>
                        <!-- Facility -->
                    <div class="form-group">
                        <label for="with">■Facility</label>
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="hot spring" value="Hot spring">
                              <label class="form-check-label" for="hot spring">Hot spring</label>
                            </div>
                        </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="sauna" value="Sauna">
                              <label class="form-check-label" for="sauna">Sauna</label>
                           </div>
                        </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="shopping" value="Shopping">
                              <label class="form-check-label" for="shopping">Shopping</label>
                           </div>
                        </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="pool" value="Pool">
                              <label class="form-check-label" for="pool">Pool</label>
                           </div>
                        </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="skating" value="Skating">
                              <label class="form-check-label" for="skating">Skating</label>
                           </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="skiing" value="Skiing">
                            <label class="form-check-label" for="skiing">Skiing</label>
                          </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="museum" value="Museum">
                            <label class="form-check-label" for="museum">Museum</label>
                        </div>
                        <div class="col-md-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="aquarium" value="Aquarium">
                            <label class="form-check-label" for="aquarium">Aquarium</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="zoo" value="Zoo">
                            <label class="form-check-label" for="zoo">Zoo</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="exhibition" value="Exhibition">
                            <label class="form-check-label" for="exhibition">Exhibition</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="park" value="Park">
                            <label class="form-check-label" for="park">Park</label>
                         </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="amusement park" value="Amusement park">
                            <label class="form-check-label" for="amusement park">Amusement park</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="camp" value="Camp">
                            <label class="form-check-label" for="camp">Camp</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="movie" value="Movie">
                            <label class="form-check-label" for="movie">Movie</label>
                          </div>
                        </div>
                    </div>
                        <!-- Fee -->
                    <div class="form-group">
                        <label for="season">■Fee</label>
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="free (for all)" value="Free (for all)">
                                <label class="form-check-label" for="free (for all)">Free (for all)</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-check">
                               <input class="form-check-input" type="checkbox" id="free (for kids)" value="Free (for kids)">
                               <label class="form-check-label" for="free (for kids)">Free (for kids)</label>
                               </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-check">
                               <input class="form-check-input" type="checkbox" id="cheap" value="Cheap">
                               <label class="form-check-label" for="cheap">Cheap</label>
                               </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="cashless" value="Cashless">
                              <label class="form-check-label" for="cashless">Cashless</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="cash only" value="Cash only">
                              <label class="form-check-label" for="cash only">Cash only</label>
                              </div>
                            </div>
                        </div>
                        <!-- Others -->
                    <div class="form-group">
                        <label for="season">■Others</label>
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="excited" value="Excited">
                              <label class="form-check-label" for="excited">Excited</label>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="related" value="Related">
                              <label class="form-check-label" for="related">Related</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="fun" value="Fun">
                              <label class="form-check-label" for="fun">Fun</label>
                            </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="noisily" value="Noisily">
                              <label class="form-check-label" for="noisily">Noisily</label>
                              </div>    
                           </div>    
                        </div>                
                    </div>                    
                </form>
            </div>            
            <div class="modal-footer">
    <button type="button" class="btn btn-select btn-large" data-bs-dismiss="modal" onclick="updateSelectedCategories()">Select</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/event-post.js') }}"></script>
@endsection
