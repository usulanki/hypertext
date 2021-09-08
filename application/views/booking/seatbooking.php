    <!-- Content Wrapper -->

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Booking for <?php echo $bookingRoomMessage; ?></h1>
                </div>

                <!-- Content Row -->

                <div class="row booking_card">
                    <div class="slots">
                    </div>
                    <div class="booking-seat-container">
                    <div class="col-lg-12 seat-container" todaydate=<?php echo $todayDate;?> >
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body" id="results">
                                <div>
                                <?php
                                        foreach ($floorSeatData as $eachValue) { ?>
                                    <div class="seatrow container">
                                        

                                            <?php   foreach ($eachValue as $eachSeats) { 
                                            $bookStatusClass ="seat-available"; $bookedBy =''; ?>
                                           <?php if(isset($eachSeats['bookings'])){
                                                $bookStatus = $eachSeats['bookings']['booking_status'];
                                                
                                                if($bookStatus == "1"){ $bookStatusClass = "seat-booked"; $bookedBy = "Booked by ".$eachSeats['bookings']['first_name']; }
                                                if($bookStatus == "3") $bookStatusClass = "seat-notavailable";
                                           } ?>
                                            <div tooltip="Seat " placement="top" class="seat-item <?php echo $bookStatusClass; ?> seat_booking" seatid=<?php echo $eachSeats['seat_id'];   ?>   title=<?php echo $bookedBy; ?>  >
                                                <?php echo $eachSeats['seat_code']; ?>
                                            </div>


                                        <?php } ?>

                                        
                                    </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Booked
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Blocked
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-dark"> </i> Not available
                                        </span>
                                    </div>
                    </div>


                                   
                                
                </div>
<div class="row justify-content-center mx-0">

    </div>
            </div>
        </div>
    </div>




<div id="mySidenav" class="sidenav card border-left-primary shadow h-100 py-2">

<div class="dropdown hierarchy-select" id="example">
    <button type="button" class="btn btn-secondary dropdown-toggle" id="example-two-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <form method="post" id="userbookingForm">
                <div class="row booking_row">

                    <div class="col-md-12 form-group">
                        <div class="error-class" id="message-error"></div>    
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info float-right">Book</button>
                    </div>
                </div>
            </form>


    <div class="dropdown-menu" aria-labelledby="example-two-button">
        <div class="hs-searchbox">
            <input type="text" class="form-control" autocomplete="off">
        </div>
        <div class="hs-menu-inner">
            <a class="dropdown-item" data-value="" data-default-selected="" href="#">All colors</a>
            <a class="dropdown-item" data-value="1" href="#">2:30PM</a>
            <a class="dropdown-item" data-value="2" href="#">Orange</a>
            <a class="dropdown-item" data-value="3" href="#">Yellow</a>
            <a class="dropdown-item" data-value="4" href="#">Green</a>
            <a class="dropdown-item" data-value="5" href="#">Blue</a>
            <a class="dropdown-item" data-value="6" href="#">Purple</a>
            <a class="dropdown-item" data-value="7" href="#">Pink</a>
            <a class="dropdown-item" data-value="8" href="#">Brown</a>
            <a class="dropdown-item" data-value="9" href="#">Black</a>
            <a class="dropdown-item" data-value="10" href="#">Grey</a>
            <a class="dropdown-item" data-value="11" href="#">White</a>
        </div>
    </div>
    <input class="d-none" name="example_two" readonly="readonly" aria-hidden="true" type="text"/>
</div>

    
  <a href="javascript:void(0)" class="closebookingbtn closebtn">&times;</a>

</div>