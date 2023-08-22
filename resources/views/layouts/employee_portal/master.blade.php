<!DOCTYPE html>
<html>
<head>
  <title>Employee Portal Dashboard</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  <link rel="stylesheet" href="{{asset('public/employee_portal/assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/employee_portal/assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}">


  <!-- Font Awsome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  
  <!-- end plugin css -->

  @stack('plugin-styles')

  <!-- common css -->
  <link rel="stylesheet" href="{{asset('public/employee_portal/css/app.css')}}">
  <link rel="stylesheet" href="{{asset('public/employee_portal/css/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/employee_portal/css/jquery-ui.css')}}"> 
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <div class="container-scroller" id="app">
    @include('layouts.employee_portal.header')
    <div class="container-fluid page-body-wrapper">
      <!-- @include('layouts.employee_portal.sidebar') -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        @include('layouts.employee_portal.footer')
      </div>
    </div>
  </div>

  <!-- base js -->
  <script src="{{asset('public/employee_portal/js/app.js')}}"></script>
  <script src="{{asset('public/employee_portal/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
  <!-- end base js -->

  <!-- plugin js -->
  @stack('plugin-scripts')
  <!-- end plugin js -->

  <!-- common js -->
  <script src="{{asset('public/employee_portal/assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('public/employee_portal/assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('public/employee_portal/assets/js/misc.js')}}"></script>
  <script src="{{asset('public/employee_portal/assets/js/settings.js')}}"></script>
  <script src="{{asset('public/employee_portal/assets/js/todolist.js')}}"></script>
  <script src="{{asset('public/employee_portal/js/wow.js')}}"></script>
  <script src="{{asset('public/employee_portal/js/jquery-ui.min.js')}}"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.4.1/slick.min.js"></script>
  
  <script type="text/javascript">
   $('#addstory').click(function(){
        //$('#storyForm').toggle('slow');
        $('html, body').animate({
          scrollTop: $("#storyForm").offset().top - 100
        }, 1000);
      });

   $('#addmediacontent').click(function(){
        //$('#storyForm').toggle('slow');
        $('html, body').animate({
          scrollTop: $("#mediaContentForm").toggle('slow').offset().top - 100
        }, 1000);
      });

   $('#content_bar').click(function(e) {
    e.stopPropagation();
    $('.story_content').css({
      'height': 'auto'
    })
  });

  //  $(document).click(function() {
  //   $('.story_content').css({
  //     'height': '50px'
  //   })
  // })

</script>
<script type="text/javascript">
  $(document).ready(function() {
    // Configure/customize these variables.
  var showChar = 200;  // How many characters are shown by default
  var showTeamChar = 367;
  var ellipsestext = "";
  var moretext = "read more";
  var lesstext = "read less";
  

  $('.more').each(function() {
      var content = $(this).html();

      if(content.length > showChar) {

          var c = content.substr(0, showChar);
          var h = content.substr(showChar, content.length - showChar);

          var html = c + '<span class="moreellipses">' + ellipsestext+ '...</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

          $(this).html(html);
      }

  });

  $(".morelink").click(function(e){
    e.preventDefault();
      if($(this).hasClass("less")) {
          $(this).removeClass("less");
          $(this).html(moretext);
      } else {
          $(this).addClass("less");
          $(this).html(lesstext);
          // alert("id");
                var id = $(this).parents('.story-desc').attr('val');  
                // alert(id);
                updateViewCount(id);
      }
      $(this).parent().prev().toggle();
      $(this).prev().toggle();
      return false;
  });


  $('.headmore').each(function() {
      var content = $(this).html();

      if(content.length > showChar) {

          var c = content.substr(0, showChar);
          var h = content.substr(showChar, content.length - showChar);

          var html = c + '<span class="moreellipses">' + ellipsestext+ '...</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="modal">' + moretext + '</a></span>';

          $(this).html(html);
      }

  });

  $('.st_des').each(function() {
      var content = $(this).html();

      if(content.length > showTeamChar) {

          var c = content.substr(0, showTeamChar);
          var h = content.substr(showTeamChar, content.length - showTeamChar); 

          //var html = c + '<span class="moreellipses">' + ellipsestext+ '...</span><span class="morecontent"><span>' + h + '';

          $(this).html(html);
      }

  });

  


    // Delete Todo record
    function updateViewCount(storyId) {
      $.ajax({
        url: "{{env('APP_URL')}}employee-portal/story/view_count-update-" + storyId,
        type: 'get',
        dataType: 'json',
        success: function (response) {
          console.log(response);
            if (response.response_code == 200) {
                $("#view_count"  + storyId).text(response.data);
                $("#story-op-status").addClass('text-success');
            } else {
                $("#story-op-status").addClass('text-danger')
            }
            $("#story-op-status").html(response.response_message)
            $("#story-op-status").show().delay(5000).queue(function (n) {
                $(this).hide();
                n();
            });
        },
        error: function (response) {
            console.log(response)
            $("#todo-op-status").addClass('text-danger')
            //$("#todo-op-status").html(response)
            $("#todo-op-status").show().delay(5000).queue(function (n) {
                $(this).hide();
                n();
            });
        }
      });
    }
});
$(".imageSlider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay:false,
    autoplaySpeed: 2e3,
    arrows:true,
    dots: !1,
    pauseOnHover: !1,
    infinite:true
    
});
</script>
<!-- end common js -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
   $('.file-size-limit').on('change', function() {
        var isSizeValid = true;
        console.log(this.files.length);
        // if(this.files.length>1){
            $.each(this.files ,function( index, file ){
                const size = (file.size / 1024 / 1024).toFixed(2);
                // console.log(size);
                if(size>5){
                    isSizeValid=false;
                }
            });
        // }
        if (!isSizeValid) {
            $(this).val(''); 
            alert("File must be less than size 5 MB");
        } 
    });
    @if(session('success'))
        swal("{{session('title_msg')?session('title_msg'):'Success'}}","{{ session('success') }}", "success").then(function() {
        // swal("Success", "{{ session('success') }}", "success").then(function() {
          //  window.location.reload();
        });  
    @endif
    @if(session('error'))
      swal("{{session('title_msg')?session('title_msg'):'Error'}}","{{ session('error') }}", "error").then(function() {
          // window.location.reload();
      });  

    @endif
</script>
@stack('custom-scripts')
</body>
</html>

