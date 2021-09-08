    <!-- Content Wrapper -->

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Booking</h1>
                </div>

                <!-- Content Row -->

                <div class="row booking_card">
                <?php
                foreach ($buildingData as $eachValue) {   ?>                    
                    <div class="col-xl-3 col-md-6 mb-4 booking_card_details" id="<?php   echo $eachValue['building_id'] ? $eachValue['building_id'] : ''  ?>">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <span><?php   echo $eachValue['building_name'] ? $eachValue['building_name'] : ''  ?> </span></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-building fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>

            </div>
        </div>
    </div>                

