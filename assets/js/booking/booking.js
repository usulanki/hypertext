$(document).ready(function () {

  $(document).on("click", ".booking_card_details", function () {

    var bid = $(this).attr('id');
    console.log($(this))
    $.ajax({
      url: "/api/booking/listBuildingFloors",
      method: "POST",
      dataType: "json",
      data: {
        'buildingId': bid,

      },
      async: false,
      success: function (res) {
        var buildindFloorDiv = '';
        res.data.floorDetails.forEach(element => {

          buildindFloorDiv += '<div class="col-xl-3 col-md-6 mb-4 booking_card_floor_details" '
          buildindFloorDiv += 'fid=' + element.floor_id + '>'
          buildindFloorDiv += '<div class="card border-left-primary shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><div class="col mr-2"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">';
          buildindFloorDiv += '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">'
          buildindFloorDiv += element.floor_name + '</div>'
          buildindFloorDiv += '</div><div class="h5 mb-0 font-weight-bold text-gray-800"></div></div><div class="col-auto"><i class="fas fa-building fa-2x text-gray-300"></i></div></div></div></div></div>'
          $('.booking_card').html(buildindFloorDiv)

        })
      }
    });

  });

  $(document).on("click", ".booking_card_floor_details", function () {
    var fid = $(this).attr('fid');
    console.log(fid)
    $.ajax({
      url: "/api/booking/listFloorRooms",
      method: "POST",
      dataType: "json",
      data: {
        'floorId': fid,

      },
      async: false,
      success: function (res) {
        var buildindFloorDiv = '';
        res.data.floorRoomDetails.forEach(element => {

          buildindFloorDiv += '<div class="col-xl-3 col-md-6 mb-4 booking_card_floor_room_details" room='+element.room_name+' '
          buildindFloorDiv += 'rid=' + element.room_id + ' fid=' + fid + '>'
          buildindFloorDiv += '<div class="card border-left-primary shadow h-100 py-2"><div class="card-body"><div class="row no-gutters align-items-center"><div class="col mr-2"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1">';
          buildindFloorDiv += '<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">'
          buildindFloorDiv += element.room_name + '</div>'
          buildindFloorDiv += '</div><div class="h5 mb-0 font-weight-bold text-gray-800"></div></div><div class="col-auto"><i class="fas fa-building fa-2x text-gray-300"></i></div></div></div></div></div>'
          $('.booking_card').html(buildindFloorDiv)

        })
      }
    });
  });
  function getDateData() {
    let curr = new Date();
    let week = []
    let days = ['sun', 'mon', 'tue', 'wed', 'thur', 'fri', 'sat'];
    let first = curr.getDate()
    let currday = curr.getDay()
    week.push(first + "-" + days[currday])
    for (let i = 1; i <= 7; i++) {
      let first = curr.getDate() + 1
      let day = new Date(curr.setDate(first)).toISOString().slice(0, 10)
      let currday = curr.getDay()
      week.push(first + "-" + days[currday])
    }
    var dateDiv = '<ul class="nav nav-tabs"><div class="owl_1 owl-carousel owl-theme">';
    week.forEach(element => {
      console.log(element)
      var dates = element.split("-");
      console.log(dates)
      dateDiv += ' <div class="item dateslick" date=' + dates[0] + '> <li class="active"><a data-toggle="tab"><div class="dateslider">' + dates[0] + '</div><div>' + dates[1] + '</div></a></li> </div> ';

    })
    dateDiv += '</div></ul>';
    return dateDiv;
  }
  $(document).on("click", ".booking_card_floor_room_details", function () {

    var fid = $(this).attr('fid');
    var rid = $(this).attr('rid');
    var rname = $(this).attr('room');
    var dateDiv = getDateData();
    // console.log(dateDiv)
    // $.ajax({
    //   url: "/api/booking/listFloorRoomsSeats",
    //   method: "POST",
    //   dataType: "json",
    //   data: {
    //     'floorId': fid,
    //     'roomId': rid
    //   },
    //   async: false,
    //   success: function (res) {
    //     var buildindFloorDiv = '';
    //     buildindFloorDiv += dateDiv;
    //     buildindFloorDiv += ' <div class="col-lg-12 seat-container" style="margin-top: 100px;"  '
    //     buildindFloorDiv += 'rid=' + rid + ' fid=' + fid + '>'
    //     buildindFloorDiv += '<div class="card border-left-primary shadow h-100 py-2"><div class="card-body"><div><div class="seatrow container">  ';
    //     res.data.floorRoomDetails.forEach(element => {

    //       buildindFloorDiv += '<div placement="top" class="seat-item seat-available seat_booking " >' + element.seat_id + '</div>  ';

    //       $('.booking_card').html(buildindFloorDiv)

    //     })
    //     buildindFloorDiv += '  </div> </div>   </div></div> </div>';
    //     initDataCarousel();
    //   }
    // });
    if(rname == "Canteen"){
      window.location = 'canteen/' + rid + '/' + fid;
    }else{
      window.location = 'booking/' + rid + '/' + fid;
    }
    

  });




  $('#example').hierarchySelect({
    hierarchy: false,
    width: 'auto'
  });




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
    li.removeClass('active');
  });

});