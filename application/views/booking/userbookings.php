<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
    <div class="col-xl-3 col-md-6 mb-4 user_booking_card_details">
                        <?php
                            foreach ($userBookingData['userBookedByDetails'] as $eachValue) { ?>
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <span><?php   echo $eachValue['roomDetails']['room_name'] ? $eachValue['roomDetails']['room_name'] : ''  ?> </span>

                                        </div>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <span><?php   echo $eachValue['floorDetails']['floor_name'] ? $eachValue['floorDetails']['floor_name'] : ''  ?> </span>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php   echo $eachValue['seatDetails']['seat_code'] ? $eachValue['seatDetails']['seat_code'] : ''  ?>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php   echo $eachValue['booked_for_date'] ? $eachValue['booked_for_date'] : ''  ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-building fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
    </div>

</div>