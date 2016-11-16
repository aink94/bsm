<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="author" content="{{ config('app.author') }}">
    <meta name="keyword" content="{{ config('app.name') }}, {{ config('app.description') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    {{Html::style('assets/css/bootstrap.css')}}
    <!--external css-->
    {{Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css')}}
    {{Html::style('assets/js/gritter/css/jquery.gritter.css')}}
        
    <!-- Custom styles for this template -->
    {{Html::style('assets/css/style.css')}}    
    {{Html::style('assets/css/style-responsive.css')}}

    @stack('css')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >

      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="#" class="logo"><b> {{ config('app.description') }} </b></a>
            <!--logo end-->
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="{{route('logout')}}"><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
        </header>
      <!--header end-->
      
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="#"><img src="assets/img/kasir-p.png" class="img-circle" width="60"></a></p>
                  <h5 class="centered">{{Auth::user()->nama}}</h5>
                  <h6 class="centered">{{Auth::user()->status->nama}}</h6>
                  @inject('menu', 'bsm\Helpers\Navigation\Contract\NavigationContract')

                  @foreach($menu->getMenu() as $keyMenu => $valueMenu)
                    @if(empty($valueMenu['submenus']))
                      <li>
                        <a href="{{route($valueMenu['url'])}}">
                          <i class="fa {{$valueMenu['icon']}}"></i> 
                          <span>{{$valueMenu['title']}}</span>
                        </a>
                      </li>
                    @else
                      <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa {{$valueMenu['icon']}}"></i>
                          <span>{{$valueMenu['title']}}</span>
                          <span class="pull-right">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                      </a>
                      <ul class="sub">
                        @foreach($valueMenu['submenus'] as $keySubmenu => $valSubmenu)
                            <li>
                              <a href="{{route($valSubmenu['url'])}}">
                                <i class="fa {{$valSubmenu['icon']}}"></i> 
                                {{$valSubmenu['title']}}
                              </a>
                            </li>

                        @endforeach
                      </ul>
                  </li>
                    @endif
                  @endforeach
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      @yield('content')
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <strong>Copyright &copy; 2016 - {{config('app.description', 'BSM')}}.</strong> All rights reserved.
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
  <div class="loading">
    <img src="assets/img/loading.gif">
  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    {{ Html::script('assets/js/jquery.js') }}
    {{ Html::script('assets/js/bootstrap.min.js') }}
    {{ Html::script('assets/js/jquery-ui-1.9.2.custom.min.js') }}
    {{ Html::script('assets/js/jquery.ui.touch-punch.min.js') }}
    {{ Html::script('assets/js/jquery.dcjqaccordion.2.7.js') }} {{-- class="include" --}}
    {{ Html::script('assets/js/jquery.scrollTo.min.js') }}
    {{ Html::script('assets/js/jquery.nicescroll.js') }}
    {{ Html::script('assets/js/jquery.sparkline.js') }}


    <!--common script for all pages-->
    {{ Html::script('assets/js/common-scripts.js') }}
    {{ Html::script('assets/js/gritter/js/jquery.gritter.js') }}    
    {{ Html::script('assets/js/gritter-conf.js') }}
    {{ Html::script('js/rfid.js') }}

    <!--script for this page-->
    @stack('js')

  <script>
      var rfidform = ''+
        '<form>'+
        '<div class="modal-body icon-rfid">'+
        '<center>'+
        '<img src="assets/img/scan-rfid.gif">'+
        '</center>'+
        '</div>'+
        '</form>';
      var modal = '' +
        '<div id="modal" class="modal modal" role="dialog" tabindex="-1" aria-labelledby="" aria-hidden="true">'+
        '<div class="modal-dialog">'+
        '<div class="modal-content">'+
        '<div class="modal-header">'+
        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
        '<h4 class="modal-title"></h4>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>';
      
      //Global Ajax
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              // 'Accept'      : 'application/json',
              // 'Content-Type': 'application/json'
          },
          //timeout: 1000,
          // beforeSend: function(xhr, settings){
          //   console.log("Before Send Global ----------------------------");
          //   console.log(xhr);
          //   //rfid
          //   switch (settings.context.context) {
          //     case "rfid" :
          //       $('body').append(modal);
          //       if($('form').length == 0) {
          //         $('.modal-content').append(rfidform);
          //       }
          //       $('.modal-title').text(settings.context.title+" Nasabah");
          //       $('#modal').modal({keyboard: false, backdrop: 'static'});
          //     break;
          //   }
          // }
      });
      $(document)
        .ajaxStart(onStart)
        .ajaxStop(onStop)
        .ajaxSend(onSend)
        .ajaxComplete(onComplete)
        .ajaxSuccess(onSuccess)
        .ajaxError(onError);
      //handle ajax global
      function onStart(event, settings){
        console.log("Start Global ----------------------------------");
        //$('.loading').show();
      }
      function onStop(event){
        console.log("Stop Global -----------------------------------");
      }
      function onSend(event, xhr, settings){
        console.log("Send Global -----------------------------------");
        if(typeof settings.context !== 'undefined'){
          switch (settings.context.context) {
            case "form" :
              $('.loading').show();
            break;
            case "rfid" :
              $('body').append(modal);
              if($('form').length == 0) {
                $('.modal-content').append(rfidform);
              }
              $('.modal-title').text(settings.context.title+" Nasabah");
              $('#modal').modal({keyboard: false, backdrop: 'static'});
            break;
          }
        }
      }
      function onComplete(event, xhr, settings){
        console.log("Complete Global -------------------------------");
        switch (settings.context.context) {
          case "form" :
            $('.loading').hide();
          break;
          case "rfid" :
            
          break;
        }
      }
      function onSuccess(event, xhr, settings){
        console.log("Success Global --------------------------------");
        console.log(event);
        console.log(xhr);
        console.log(settings);
        switch (settings.context.context) {
          case "form" :
            $('.loading').hide();
            $("#modal").modal("hide");
            $.gritter.add({
                title: xhr.responseJSON.title,
                text: xhr.responseJSON.message,
                image: 'assets/img/success.png',
                sticky: false,
                time: '5000',
                class_name: 'my-sticky-class'
            });
          break;
          case "rfid" :
            $.gritter.add({
                title: xhr.responseJSON.title,
                text: xhr.responseJSON.message,
                image: 'assets/img/success.png',
                sticky: false,
                time: '5000',
                class_name: 'my-sticky-class'
            });
          break;
        }
      }
      function onError(event, jqXHR, ajaxSettings, thrownError){
        console.log("Error Global ----------------------------------");
        console.log(event);
        console.log(jqXHR);
        console.log(ajaxSettings);
        //console.log(thrownError);
        
        switch (event.status){
          //RFID
          case 200:
            $.gritter.add({
                title: "RFID",
                text: "Data Kosong",
                image: 'assets/img/error.png',
                sticky: false,
                time: '5000',
                class_name: 'my-sticky-class'
            });
          break;
          //Laravel
          case 400:
            $("#modal").modal("hide");
            $.gritter.add({
                title: event.responseJSON.errors,
                text: event.responseJSON.message,
                image: 'assets/img/error.png',
                sticky: false,
                time: '5000',
                class_name: 'my-sticky-class'
            });
          break;
          case 422:
              $('.loading').hide();
              if(typeof jqXHR.responseJSON !== "undefined"){
                $.each(jqXHR.responseJSON, function(key, val){
                  $.gritter.add({
                      title: 'Error',
                      text: val,
                      image: 'assets/img/error.png',
                      sticky: false,
                      time: '5000',
                      class_name: 'my-sticky-class'
                  });
                });
              }
              jqXHR.abort();
            break;
        }

        if(ajaxSettings.context.context === "form"){
          switch (jqXHR.status){
            //notifikasi validation
            case 422:

              $('.loading').hide();
              if(typeof jqXHR.responseJSON !== "undefined"){
                $.each(jqXHR.responseJSON, function(key, val){
                  $.gritter.add({
                      title: 'Error',
                      text: val,
                      image: 'assets/img/error.png',
                      sticky: false,
                      time: '5000',
                      class_name: 'my-sticky-class'
                  });
                });
              }
            break;
            //Laravel
            case 400:
              $('.loading').hide();
              $.gritter.add({
                  title: jqXHR.responseJSON.errors,
                  text: jqXHR.responseJSON.message,
                  image: 'assets/img/error.png',
                  sticky: false,
                  time: '5000',
                  class_name: 'my-sticky-class'
              });
            break;
          }
        }else if(jqXHR.status == 400){
          var data = $.parseJSON(jqXHR.responseText);
          console.log(jqXHR.responseText);
          $.gritter.add({
              title: data.errors,
              text: data.message,
              image: 'assets/img/error.png',
              sticky: false,
              time: '5000',
              class_name: 'my-sticky-class'
          });
        }
      }
  </script>

  </body>
</html>
