<?php
include "email_status.php";
include "./includes/header.php";
?>
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators"> 
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./Photos/resort.jpg" class="d-block w-100" alt="... ">
        </div>
        <div class="carousel-item">
            <img src="./Photos/poolside.jpg" class="d-block w-100" alt="... ">
        </div>
        <div class="carousel-item">
            <img src="./Photos/hotel_pool1.jpeg" class="d-block w-100" alt="... ">
        </div>
    </div>
    <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon " aria-hidden="true "></span>
    <span class="visually-hidden ">Previous</span>
</button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true "></span>
    <span class="visually-hidden ">Next</span>
</button>
</div>
<!-- Rooms section -->
<section class="bg-light pb-lg-5">
        <div class="container" >
            <div class="rooms text-center">
                <h3 class="display-5 fw-bold pt-lg-4">ROOMS</h1>
                <p class="lead"><small>Our hotel maintains a clean and lively rooms in order to provide splendid services to our dear customers.</small></p>
            </div>
            <div class="container text-center">
                <div class="rooms row">
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card rounded">
                            <div class="card-header">Economy Room</div>
                            <div class="card-body ">
                                <img src="./Photos/hotel_rooms/executive_room.png" alt=" " class="card-img ">
                                <p class="card-text m-4">A budget-friendly package with a very excellent services and inclusions.</p>
                                <span class="vstack gap-2">
                            <a href="economy.php" class="btn btn-dark">Book now</a>
                            <a class="btn btn-light" data-bs-toggle="modal" href="#templateModal" role="button">More Details</a>
                            <div class="modal fade" id="templateModal" aria-hidden="true" aria-labelledby="templateModalLabel" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="templateModalLabel" style="font-family:var(--lobs2);">Economy Room</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <img src="./Photos/hotel_rooms/economy_room.png" class="rounded" style="min-height: 10em; max-width:100%">
                                            </div>
                                            <div class="col">
                                                <p class="text-md-start mt-3 mb-0">Description:</p>
                                                <p class="text-start" style="font-family:var(--poppins);">A cheap and budget-friendly package which includes free breakfast, lunch, and a dinner with a Dining facilities, pool, and beverages of your choice.</p>
                                            </div>
                                    <div class="wd-100"></div>
                                            <hr class="featurette-divider">
                                            <div class="row">
                                                <div class="col-md-4">   
                                                    <h4 class="text-xl-center" style="font-family:var(--poppins);">Entertainment:</h4>     
                                                    <ul class="entertainments text-sm-start">
                                                        <li>Beverage</li>
                                                        <li>64" Flat Screen TV</li>
                                                    </ul>     
                                                </div>
                                                <div class="col-md-4">                                        
                                                    <h4 class="text-xl-center" style="font-family:var(--poppins);">Facilities:</h4>     
                                                    <ul class="entertainments text-sm-start">
                                                        <li>Pool</li>
                                                        <li>Dining Area</li>
                                                        <li>Bathroom</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">                                          
                                                    <h4 class=" text-xl-center" style="font-family:var(--poppins);">Services:</h4>     
                                                    <ul class="entertainments text-sm-start">
                                                        <li>Breakfast in bed</li>
                                                        <li>Foot Spa</li>
                                                        <li>Massage</li>
                                                    </ul>
                                                    </div>   
                                                        </div>                                         
                                                    </div>
                                            </div>                                          
                                            <a href="economy.php" class="btn btn-dark">Book Now</a>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card rounded">
                            <div class="card-header">Deluxe Room</div>
                            <div class="card-body ">
                                <img src="./Photos/hotel_rooms/executive_room.png" alt=" " class="card-img ">
                                <p class="card-text m-4">Marvelous package perfect for travelers and families. </p>
                                <span class="vstack gap-2">
                                    <a href="deluxe.php" class="btn btn-dark"> Book now</a>
                                    <a class="btn btn-light" data-bs-toggle="modal" href="#templateModal2" role="button">More Details</a>
                                    <div class="modal fade" id="templateModal2" aria-hidden="true" aria-labelledby="templateModalLabel2" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title " id="templateModalLabel2" style="font-family:var(--lobs2);">Deluxe Room</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row py-2">
                                                        <div class="col-12">
                                                            <img src="./Photos/hotel_rooms/deluxe_room.png" class="rounded" style="min-height: 10em; max-width:100%">
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-md-start mt-3 mb-0">Description:</p>
                                                            <p class="text-start" style="font-family:var(--poppins);">A perfect package for family or group which includes neat and aesthetic facilities.</p>
                                                        </div>
                                                        <div class="wd-100"></div>
                                                        <hr class="featurette-divider">
                                                        <div class="row">
                                                            <div class="col-md-4">   
                                                                <h4 class="lead text-xl-center" style="font-family:var(--poppins);" >Entertainment:</h4>     
                                                                <ul class="entertainments text-sm-start">
                                                                    <li>Beverage</li>
                                                                    <li>64" Flat Screen TV</li>
                                                                    <li>Casino</li>
                                                                </ul>     
                                                            </div>
                                                            <div class="col-md-4">                                        
                                                                <h4 class="lead text-xl-center" style="font-family:var(--poppins);">Facilities:</h4>     
                                                                <ul class="entertainments text-sm-start">
                                                                    <li>Pool</li>
                                                                    <li>Special Dining Area</li>
                                                                    <li>Bathroom</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">                                          
                                                                <h4 class="lead text-xl-center" style="font-family:var(--poppins);">Services:</h4>     
                                                                <ul class="entertainments text-sm-start">
                                                                    <li>Breakfast in bed</li>
                                                                    <li>Massage</li>
                                                                    <li>Free Wifi</li>
                                                                </ul>
                                                            </div>   
                                                        </div>                                         
                                                    </div>
                                            </div>                                          
                                            <a href="deluxe.php" class="btn btn-dark">Book Now</a>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">Executive Room</div>
                        <div class="card-body">
                            <img src="./Photos/hotel_rooms/executive_room.png" alt=" " class="card-img ">
                            <p class="card-text m-4">A classy bundle for sassy people like you uwu.</p>
                            <span class="vstack gap-2">
                                    <a href="executive.php" class="btn btn-dark">Book now</a>
                                    <a class="btn btn-light" data-bs-toggle="modal" href="#templateModal3" role="button">More Details</a>
                                    <div class="modal fade" id="templateModal3" aria-hidden="true" aria-labelledby="templateModalLabel3" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="templateModalLabel3" style="font-family: var(--lobs2);">Executive Room</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <img src="./Photos/hotel_rooms/executive_room.png" class="rounded" style="min-height: 10em; max-width:100%">
                                                    </div>
                                                    <div class="col">
                                                        <p class="text-md-start mt-3 mb-0">Description:</p>
                                                        <p class="text-start" style="font-family:var(--poppins);">A special package with premium perks that includes free delicious breakfast, wonderful lunch, and a fancy dinner.</p>
                                                    </div>
                                                    <div class="wd-100"></div>
                                                    <hr class="featurette-divider">
                                                    <div class="row">
                                                        <div class="col-md-4">   
                                                            <h4 class="text-xl-center">Entertainment:</h4>     
                                                            <ul class="entertainments text-sm-start">
                                                                <li>Premium Beverages</li>
                                                                <li>64" Flat Screen TV</li>
                                                                <li>Unlimited Television Channels</li>
                                                                <li>Casino</li>
                                                            </ul>     
                                                        </div>
                                                        <div class="col-md-4">                                        
                                                            <h4 class="lead text-xl-center">Facilities:</h4>     
                                                            <ul class="entertainments text-sm-start">
                                                                <li>Pool</li>
                                                                <li>Jacuzzi</li>
                                                                <li>Gym</li>
                                                                <li>Sauna</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">                                          
                                                            <h4 class="lead text-xl-center">Services:</h4>     
                                                            <ul class="entertainments text-sm-start">
                                                                <li>Massage</li>
                                                                <li>Ventosa</li>
                                                                <li>Breakfast in bed</li>
                                                                <li>Quicker Service</li>
                                                            </ul>
                                                            </div>   
                                                        </div>                                         
                                                    </div>
                                            </div>                                          
                                            <a href="executive.php" class="btn btn-dark">Book Now</a>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
</section>
<!-- hotel amenities -->
<section>
<div class="container text-center">
                <hr class="featurette-divider">
                    <a class="btn btn-floating btn-lg text-dark m-1"  data-mdb-ripple-color="dark">
                        <img src="./Photos/amenities/wifi.svg" alt=""> WIFI</a>

                    <a class="btn btn-floating btn-lg text-dark m-1"  data-mdb-ripple-color="dark">
                        <img src="./Photos/amenities/parking.svg" alt=""> Parking</a>

                    <a class="btn btn-floating btn-lg text-dark m-1"  data-mdb-ripple-color="dark">
                        <img src="./Photos/amenities/sanitizedrooms.png" width="20" height="20" alt=""> Sanitized Rooms</a>

                    <a class="btn btn-floating btn-lg text-dark m-1"  data-mdb-ripple-color="dark">
                        <img src="./Photos/amenities/operation.png" width="20" height="20" alt=""> 24-Hr Operation</a>
                    <hr class="featurette-divider">
        </div>
</section>
<!-- gallery -->
<section>
<div class="container text-center p-lg-5">
            <h3 class="display-5 fw-bold pt-lg-4" style="font-family:var(--poppins);">Facilities</h1>
            <p class="lead text-muted mb-5">Our facilities are great and is rated 10 stars by International Hotel Association. It is also instagramable which is perfect for selfies, groupies, photoshoots, and other activities.</p>
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 w-25">
                    <img src="./Photos/sink.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />

                </div>
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 w-25">
                    <img src="./Photos/hotel_pool2.jpg" class="w-100 shadow-1-strong rounded mb-3" alt="" />

                    <img src="./Photos/poolside.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />
                </div>
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 w-50">
                    <img src="./Photos/resort.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="" />
                </div>
            </div>
    </div>
</section>
<?php
include "./includes/footer.php";
?>