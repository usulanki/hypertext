$(document).ready(function () {


  function initDataCarousel() {
    $(' .owl_1').owlCarousel({
      loop: false,
      margin: 2,
      responsiveClass: true, autoplayHoverPause: true,
      autoplay: false,
      slideSpeed: 400,
      paginationSpeed: 400,
      autoplayTimeout: 3000,
      responsive: {
        0: {
          items: 3,
          nav: true,
          loop: false
        },
        600: {
          items: 3,
          nav: true,
          loop: false
        },
        1000: {
          items: 3,
          nav: true,
          loop: false
        }
      }
    })

  }


  var li = $(".owl-item li ");
  $(".owl-item li").click(function () {
    console.log("ASd")

  });

  var dateDiv = getDateData();
  $('.booking_card').prepend(dateDiv)
  initDataCarousel();
  function slotsTime(){
    var slotsDiv = '';
    $.ajax({
      type: 'GET',
      url: '/api/booking/getListOfAvailableSlots',
      async: false,
      success: function (response) {
        if (response.status == true) {
          slotsDiv += '<div class="col-lg-10"> <div class="card border-0"> <div class="card-body p-3 p-sm-5"> <div class="row text-center mx-0">';

          response.data.listOfSlots.forEach(element => {
            slotsDiv += '<div class="col-md-2 col-4 my-1 px-2" shiftid='+element.shift_id+'> <div class="cell py-1">'+element.shift_data+'</div></div>';
          });
          slotsDiv += '</div></div></div></div>';
          $('.slots').prepend(slotsDiv)
        }
  
      }
    });
  }

  function getDateData() {
    let curr = new Date();
    let week = []
    let days = ['sun', 'mon', 'tue', 'wed', 'thur', 'fri', 'sat'];
    let first = curr.getDate()
    let day = new Date(curr.setDate(first)).toISOString().slice(0, 10);
    let currday = curr.getDay()
    week.push(first + "," + days[currday] + "," + day)
    for (let i = 1; i <= 7; i++) {
      let first = curr.getDate() + 1;
      let day = new Date(curr.setDate(first)).toISOString().slice(0, 10);
      let currday = curr.getDay();
      let currdate = curr.getDate();
      if (currdate < 10) {
        currdate = '0' + currdate;
      }

      week.push(currdate + "," + days[currday] + "," + day)
    }
    var dateDiv = '<div><ul class="nav nav-tabs"><div class="owl_1 owl-carousel owl-theme">';
    week.forEach(element => {
      var dates = element.split(",");
      dateDiv += ' <div class="item dateslick" date=' + dates[2] + '> <li class=""><a data-toggle="tab"><div class="dateslider">' + dates[0] + '</div><div>' + dates[1] + '</div></a></li> </div> ';

    })
    dateDiv += '</div></ul></div>';
    return dateDiv;
  }


  $(document).on("click", ".dateslick", function () {

    var urlPath = location.pathname;

    $('.owl-stage>div.owl-item>div.dateslick>li').removeClass('active');
    $(this).children('li').addClass("active");
    urlPath = urlPath.split("/");
    let curr = new Date();
    let first = $(this).attr('date');
    let day = $(this).attr('date');
    $.ajax({
      url: "/api/booking/listFloorRoomsSeats",
      method: "POST",
      dataType: "json",
      data: {
        'floorId': urlPath['3'],
        'roomId': urlPath['2'],
        'seatsForDate': day
      },
      async: false,
      success: function (res) {
        var buildindFloorDiv = '';

        buildindFloorDiv += ' <div class="col-lg-12 seat-container" todaydate = ' + day + ' '
        buildindFloorDiv += 'rid=' + urlPath['2'] + ' fid=' + urlPath['3'] + '>'
        buildindFloorDiv += '<div class="card border-left-primary shadow h-100 py-2"><div class="card-body"><div>';
        res.data.floorRoomDetails.forEach(elementseat => {
          buildindFloorDiv += '<div class="seatrow container">  ';
          Object.values(elementseat).forEach(element => {
            var seatStatusClass = '<div placement="top" class="seat-item seat-available seat_booking " seatid = ' + element.seat_id + '>';
            if (element.bookings) {
              if (element.bookings.booking_status == "1") { var seatStatusClass = '<div placement="top" class="seat-item seat-booked seat_booking " seatid = ' + element.seat_id + ' title="Booked by '+element.bookings.first_name+'" >'; }
              if (element.bookings.booking_status == "3") { var seatStatusClass = '<div placement="top" class="seat-item seat-notavailable seat_booking " seatid = ' + element.seat_id + ' >' ; }
            }
            buildindFloorDiv += seatStatusClass + element.seat_code + '</div>  ';



          });
          buildindFloorDiv += ' </div>';
        });
        buildindFloorDiv += ' </div> </div> </div>   </div></div> </div>';
        buildindFloorDiv += '<div class="mt-4 text-center small"><span class="mr-2"><i class="fas fa-circle text-primary"></i> Booked</span> <span class="mr-2"><i class="fas fa-circle text-success"></i> Blocked</span><span class="mr-2"><i class="fas fa-circle text-dark"></i> Not available</span></div>';
        $('.booking-seat-container').html(buildindFloorDiv)
        initDataCarousel();
      }
    });

  });

  $(document).on("click", ".seat_booking", function () {

    var todaydate = document.getElementsByClassName('seat-container')[0].getAttribute("todaydate");
    $('.booking_row').html('');
    var seatDiv = '<div class="form-group col-md-12"><label for="toUserId">Enter Employee id</label><div><input type="text" class="form-control" name="toUserId"></div><span class="error-class" id="email_id-error"></span></div>';
    seatDiv += '<div class="form-group col-md-12 bookingseatid"><label for="seat_code">Selected Seat</label><div><input type="text" class="form-control" readonly name="seat_code" seatid=' + $(this).attr('seatid') + ' value=' + $(this)[0].innerText + '></div><span class="error-class" id="email_id-error"></span></div>';
    seatDiv += '<div class="form-group col-md-12 bookingseatid" style="display: none;"><label for="seat_id">Selected Seat</label><div><input type="text" class="form-control" readonly name="seatId"  value=' + $(this).attr('seatid') + '></div><span class="error-class" id="email_id-error"></span></div>';
    seatDiv += '<div class="form-group col-md-12 bookingdate"><label for="bookingfordate">Selected Booking Date</label><div><input type="text" readonly class="form-control" name="bookingfordate" value=' + todaydate + '></div><span class="error-class" id="email_id-error"></span></div>';
    seatDiv += '<div class="col-md-12 form-group"><div class="error-class" id="message-error"></div></div><div class="col-md-12"><button type="submit" class="btn btn-info float-right">Book</button></div>';
    if ($('.bookingseatid').length > 0) {
      $('.bookingseatid').remove();
    }
    if ($('.bookingdate').length > 0) {
      $('.bookingdate').remove();
    }

    var userdetailsDiv = '<div class="form-group col-md-12 bookingseatid"><label for="seat_code">Selected Seat</label><div><input type="text" class="form-control" readonly name="seat_code" seatid=' + $(this).attr('seatid') + ' value=' + $(this)[0].innerText + '></div><span class="error-class" id="email_id-error"></span></div>';
    userdetailsDiv += '<div class="form-group col-md-12 bookingdate"><label for="bookingfordate">Selected Booking Date</label><div><input type="text" readonly readonly class="form-control" name="bookingfordate" value=' + todaydate + '></div><span class="error-class" id="email_id-error"></span></div>';
    userdetailsDiv += '<div class="form-group col-md-12 bookingseatid" style="display: none;"><label for="seat_id">Selected Seat</label><div><input type="text" class="form-control" readonly name="seatId"  value=' + $(this).attr('seatid') + '></div><span class="error-class" id="email_id-error"></span></div>';
    if (this.classList.contains("seat-booked")) {
      $.ajax({
        type: 'POST',
        url: '/api/booking/userBookingDetails',
        data: {
          seatId: $(this).attr('seatid'),
          seatsForDate: todaydate
        },
        async: false,
        success: function (response) {

          userdetailsDiv += '<div class="form-group col-md-12"><label for="toUserId">Enter Employee id</label><div><input type="text" class="form-control" name="toUserId" value=' + response.data.userBookingDetails['0'].user_id + '></div><span class="error-class" id="email_id-error"></span></div>';
          userdetailsDiv += '<div class="form-group col-md-12"><label for="bookedby">Booked By</label><div><input type="text" class="form-control" name="bookedby" value=' + response.data.userBookingDetails['0'].first_name + '><span class="error-class" id="email_id-error"></span></div><div class="form-group col-md-12"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" ><label class="form-check-label" for="flexCheckChecked">Revoke Booking</label></div>';
          userdetailsDiv += '<div class="col-md-12 form-group"><div class="error-class" id="message-error"></div></div><div class="col-md-12"><button type="submit" class="btn btn-info float-right">Book</button></div>';

          if (response.status == false) {
            //check for validation error
            if (response.data['error'] != '') {

            }
            if (response.message != '') {

            }
          }
          if (response.status == true) {
            $('.booking_row').prepend(userdetailsDiv);

          }

        }
      });
    } else {

      $('.booking_row').prepend(seatDiv);
      $(this).removeClass("seat-available");
      $('.seatrow>div.seat-selected').addClass('seat-available');
      $('.seatrow>div.seat-selected').removeClass('seat-selected');
      

      $(this).addClass("seat-selected");
    }

    if (!this.classList.contains("seat-notavailable")) {
      document.getElementById("mySidenav").style.width = "350px";
    }


  });


  $(document).on("click", ".closebookingbtn", function () {
    document.getElementById("mySidenav").style.width = "0px";
  });

  $('#userbookingForm').submit(function (event) {
    event.preventDefault();
    var form = $(this);
    console.log($(this));

    var form_id = form.attr('id');
    var revokeBooking = '0';
    var booking_data = $(this).serialize();
    if (document.getElementById("flexCheckChecked")) {
      var check = $('input[id="flexCheckChecked"]').is(':checked');
      if (check) {
        revokeBooking = '1';
      }
    }
    booking_data += '&revokeBooking=' + revokeBooking
    $.ajax({
      type: 'POST',
      url: '/api/booking/userBooking',
      data: booking_data,
      async: false,
      success: function (response) {

        if (response.status == false) {
          //check for validation error
          if (response.data['error'] != '') {

          }
          if (response.message != '') {

          }
        }
        if (response.status == true) {
          console.log($(this));
          myFunction(response.message);
          console.log(revokeBooking)
          if (revokeBooking) {
            $(this).addClass("seat-available");
            $(this).removeClass("seat-booked");
          } else {
            $('.owl-stage>div.owl-item>div.dateslick>li.active').click();
            $(this).removeClass("seat-available");
            $(this).removeClass("seat-selected");
            $(this).addClass("seat-booked");
          }

        }
        $(".closebookingbtn").click();
      }
    });


  });

  function myFunction(data) {

    var x = document.getElementById("snackbar");
    document.getElementById("snackbar").innerHTML = data;
    x.className = "show";
    setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
  }


});