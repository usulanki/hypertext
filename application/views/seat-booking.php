    <!-- Content Wrapper -->

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                              <!-- Content Row -->
                <div class="row dashboard_card_count">
                  <div class="col-lg-12 seat-container" style="margin-top: 100px;">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body" id="results">  
                      <a href="#">
                        <span class="badge badge-secondary">Floor 1</span>
                      </a>
                      <a href="#">
                        <span class="badge badge-secondary">Floor 2</span>
                      </a>
                      <?php
                    //   echo "<pre>";
                    // print_r($bookingData);exit;
                      if ($seatsArr != "") {

                        if($bookingData['0']['booking_status'] == "RESERVED"){
                          $sclass = 'seat-booked';
                        }else{
                          $sclass = 'seat-item seat-available';
                        }

                        foreach ($seatsArr as $value) {   ?>
                          <div>

                            <div class="seatrow container">

                              <?php
                              if ($seatChartConfig->showRowsLabel) { ?>
                                <div>
                                  <div class="row-label"> <?php echo $value['seatRowLabel']; ?> </div>
                                </div>
                              <?php } ?>

                              <?php
                              foreach ($value['seats'] as $eachValue) {   ?>
                                <div id=<?php echo $eachValue['key'] ?> >
                                  <?php
                                  if ($eachValue['seatLabel'] == '') { ?>
                                    <div class="seat-item seat-space" style="color:white ; background-color:white"> </div>
                                  <?php } ?>
                                  <?php
                                  if (($bookingData['0']['booking_status'] == 'RESERVED') &&  $eachValue['key'] == $bookingData['0']['seat_id']) { ?>
                                    <div tooltip="Seat : Price : Rs" placement="top" onclick="openNav()" class="seat-item <?php echo $sclass; ?>" >
                                      <?php echo $eachValue['seatNo']; ?>
                                    </div>
                                  <?php } ?>
                                  <?php
                                  if (($eachValue['status'] == 'available' || $eachValue['status'] == 'booked') &&  $eachValue['seatLabel'] != '' && $eachValue['key'] != $bookingData['0']['seat_id']) { ?>
                                    <div tooltip="Seat : Price : Rs" placement="top" onclick="openNav()" class="seat-item seat-available" >
                                      <?php echo $eachValue['seatNo']; ?>
                                    </div>
                                  <?php } ?>

                                  <div tooltip="Seat not available" placement="top"></div>
                                </div>

                              <?php } ?>
                            </div>
                          </div>
                      <?php }
                      } ?>
                    </div>
                </div>
                                        </div>
                    </div>
</div>
</div>
</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>

<script type="text/javascript">
  var seatConfig=  null;

  var seatmap = [];
  var seatChartConfig = {
    "showRowsLabel" : true,
    "showRowWisePricing" : true,
    "newSeatNoForRow" : true
  }
  var cart = {
    "selectedSeats" : [],
    "seatstoStore": [],
    "totalamount" : 0,
    "cartId": "",
    "eventId" : 0
  }

var seatConfig = [
{
  "seat_map": [
    {
      "layout": "_____aaaaa__aaaaa__",
      "seat_label": "N"
    },
    {
      "layout": "_____aaaaa__aaaaa__",
      "seat_label": "M"
    },
    {
      "layout": "_____aaaaa__aaaaa__",
      "seat_label": "L"
    },
    {
      "layout": "_____aaaaa__aaaaa__",
      "seat_label": "K"
    },
    {
      "layout": "_____aaaaa______________",
      "seat_label": "J"
    },
    {
      "layout": "_____aaaaa_____________",
      "seat_label": "I"
    },
    {
      "layout": "_____eeeee_____________",
      "seat_label": "H"
    },
    {
      "layout": "__________________________",
      "seat_label": " "
    }
  ],
  "seat_price": 300
}
  
];

  function openNav() {
    document.getElementById("mySidenav").style.width = "350px";
    processSeatChart(seatConfig);
    var seatdiv = '';
    this.seatmap.forEach(element =>{
        console.log(element);
        seatdiv += '<div>';
        seatdiv += '<div class="seatrow container">';
        seatdiv += '<div>';
        seatdiv += '<div class="row-label">';
        seatdiv += element.seatRowLabel;
        seatdiv += '</div>';
        seatdiv += '</div>';
        

        element.seats.forEach(subelement=>{
          seatdiv += '<div id='+subelement.key+'>';
          if(subelement.seatLabel==''){
          seatdiv += '<div class="seat-item seat-space" style="color:white ; background-color:white"> </div>';
          }
          if ((subelement.status == 'available' || subelement.status == 'booked') &&  subelement.seatLabel != '' ){
            seatdiv +=  '<div tooltip="Seat : Price : Rs" placement="top" onclick="openNav()" class="seat-item seat-available" >';
            seatdiv +=  subelement.seatNo;
            seatdiv += '</div>';
            

          }
          seatdiv += '</div>';
        })
        seatdiv += '</div>';
        seatdiv += '</div>';
    });
    $('#results').html(seatdiv);
    console.log(seatdiv)
  }
  function closeNav(){
    document.getElementById("mySidenav").style.width = "0px";
  }
function processSeatChart ( map_data )
  {
    
      if( map_data.length > 0 )
      {
        var seatNoCounter = 1;
        for (let __counter = 0; __counter < map_data.length; __counter++) {
          var row_label = "";
          var item_map = map_data[__counter].seat_map;

          //Get the label name and price
          row_label = "Row "+item_map[0].seat_label + " - ";
          if( item_map[ item_map.length - 1].seat_label != " " )
          {
            row_label += item_map[ item_map.length - 1].seat_label;
          }
          else
          {
            row_label += item_map[ item_map.length - 2].seat_label;
          }
          row_label += " : Rs. " + map_data[__counter].seat_price;
          
          item_map.forEach(map_element => {
            var mapObj = {
              "seatRowLabel" : map_element.seat_label,
              "seats" : [],
              "seatPricingInformation" : row_label
            };
            row_label = "";
            var seatValArr = map_element.layout.split('');
            if( this.seatChartConfig.newSeatNoForRow )
            {
              seatNoCounter = 1; //Reset the seat label counter for new row
            }
            var totalItemCounter = 1;
            seatValArr.forEach(item => {
              var seatObj = {
                "key" : map_element.seat_label+"_"+totalItemCounter,
                "price" : map_data[__counter]["seat_price"],
                "status" : "available"
              };
               
              if( item != '_')
              {
                seatObj["seatLabel"] = map_element.seat_label+" "+seatNoCounter;
                if(seatNoCounter < 10)
                { seatObj["seatNo"] = "0"+seatNoCounter; }
                else { seatObj["seatNo"] = ""+seatNoCounter; }
                
                seatNoCounter++;
              }
              else
              {
                seatObj["seatLabel"] = "";
              }
              totalItemCounter++;
              mapObj["seats"].push(seatObj);
            });

            this.seatmap.push( mapObj );

          });
        }
      }
      
  }

</script>