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
    {{Html::style('assets/font-awesome/css/font-awesome.css')}}
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
    {{ Html::script('js/index.js') }}
    {{ Html::script('js/rfid.js') }}

    <!--script for this page-->
    @stack('js')

  </body>
</html>
