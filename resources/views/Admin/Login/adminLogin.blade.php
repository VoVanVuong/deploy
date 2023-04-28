<html lang="en" class="material-style layout-fixed"><head>
    <title>Empire | Login</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Empire Bootstrap admin template made using Bootstrap 4, it has tons of ready made feature, UI components, pages which completely fulfills any dashboard needs.">
    <meta name="keywords" content="Empire, bootstrap admin template, bootstrap admin panel, bootstrap 4 admin template, admin template">
    <meta name="author" content="Srthemesvilla">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ ('assetsAdmin/fonts/fontawesome.css')}}">
    <link rel="stylesheet" href="{{ ('assetsAdmin/fonts/ionicons.css')}}">
    <link rel="stylesheet" href="{{ ('assetsAdmin/fonts/linearicons.css')}}">
    <link rel="stylesheet" href="{{ ('assetsAdmin/fonts/open-iconic.css')}}">
    <link rel="stylesheet" href="{{ ('assetsAdmin/fonts/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{ ('assetsAdmin/fonts/feather.css')}}">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ ('assetsAdmin/css/bootstrap-material.css')}}">
    <link rel="stylesheet" href="{{ ('assetsAdmin/css/shreerang-material.css')}}">
    <link rel="stylesheet" href="{{ ('assetsAdmin/css/uikit.css')}}">

    <!-- Libs -->
    <link rel="stylesheet" href="{{ ('assetsAdmin/libs/perfect-scrollbar/perfect-scrollbar.css')}}">
    <!-- Page -->
    <link rel="stylesheet" href="{{ ('assetsAdmin/css/pages/authentication.css')}}">
<style type="text/css" id="pace-js-stylesheets">
  .pace {
    display: block !important;
  }
  .page-loader {
    display: none;
    position: fixed;
    height: 2px;
    overflow: hidden;
    top: 0;
    left: 0;
    right: 0;
    z-index: 999999;
  }
  .page-loader div {
    position: absolute;
    top: 0;
    bottom: 0;
    transform: translate3d(0, 0, 0);
  }
  .pace-running:not(.pace-done) .page-loader {
    display: block;
  }
  .pace-running:not(.pace-done) .page-loader div {
    animation-duration: 1.2s;
    animation-name: pageLoaderAnimation;
    animation-iteration-count: infinite;
    animation-timing-function: ease-in-out;
  }
  .turbolinks-progress-bar {
    visibility: hidden !important;
  }
  [dir=rtl] .pace-running:not(.pace-done) .page-loader div,
  [dir=rtl].pace-running:not(.pace-done) .page-loader div {
    animation-name: pageLoaderAnimationRTL;
  }
  @-webkit-keyframes pageLoaderAnimation {
    0% { right: 100%; left: 0; }
    40% { right: 0; left: 0; }
    60% { left: 0; right: 0; }
    100% { left: 100%; right: 0; }
  }
  @keyframes pageLoaderAnimation {
    0% { right: 100%; left: 0; }
    40% { right: 0; left: 0; }
    60% { left: 0; right: 0; }
    100% { left: 100%; right: 0; }
  }
  @-webkit-keyframes pageLoaderAnimationRTL {
    0% { left: 100%; right: 0; }
    40% { left: 0; right: 0; }
    60% { right: 0; left: 0; }
    100% { right: 100%; left: 0; }
  }
  @keyframes pageLoaderAnimationRTL {
    0% { left: 100%; right: 0; }
    40% { left: 0; right: 0; }
    60% { right: 0; left: 0; }
    100% { right: 100%; left: 0; }
  }
  </style><style type="text/css">
.layout-fixed .layout-1 .layout-sidenav,
.layout-fixed-offcanvas .layout-1 .layout-sidenav {
  top: 0px !important;
}
.layout-container {
  padding-top: 0px !important;
}
.layout-content {
  padding-bottom: 0px !important;
}</style><style type="text/css">/*!
 * Waves v0.7.6
 * http://fian.my.id/Waves
 *
 * Copyright 2014-2018 Alfiana E. Sibuea and other contributors
 * Released under the MIT license
 * https://github.com/fians/Waves/blob/master/LICENSE */.waves-effect{position:relative;cursor:pointer;display:inline-block;overflow:hidden;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-tap-highlight-color:transparent}.waves-effect .waves-ripple{position:absolute;border-radius:50%;width:100px;height:100px;margin-top:-50px;margin-left:-50px;opacity:0;background:rgba(0,0,0,.2);background:-webkit-radial-gradient(rgba(0,0,0,.2) 0,rgba(0,0,0,.3) 40%,rgba(0,0,0,.4) 50%,rgba(0,0,0,.5) 60%,hsla(0,0%,100%,0) 70%);background:-o-radial-gradient(rgba(0,0,0,.2) 0,rgba(0,0,0,.3) 40%,rgba(0,0,0,.4) 50%,rgba(0,0,0,.5) 60%,hsla(0,0%,100%,0) 70%);background:-moz-radial-gradient(rgba(0,0,0,.2) 0,rgba(0,0,0,.3) 40%,rgba(0,0,0,.4) 50%,rgba(0,0,0,.5) 60%,hsla(0,0%,100%,0) 70%);background:radial-gradient(rgba(0,0,0,.2) 0,rgba(0,0,0,.3) 40%,rgba(0,0,0,.4) 50%,rgba(0,0,0,.5) 60%,hsla(0,0%,100%,0) 70%);-webkit-transition:all .5s ease-out;-moz-transition:all .5s ease-out;-o-transition:all .5s ease-out;transition:all .5s ease-out;-webkit-transition-property:-webkit-transform,opacity;-moz-transition-property:-moz-transform,opacity;-o-transition-property:-o-transform,opacity;transition-property:transform,opacity;-webkit-transform:scale(0) translate(0);-moz-transform:scale(0) translate(0);-ms-transform:scale(0) translate(0);-o-transform:scale(0) translate(0);transform:scale(0) translate(0);pointer-events:none}.waves-effect.waves-light .waves-ripple{background:hsla(0,0%,100%,.4);background:-webkit-radial-gradient(hsla(0,0%,100%,.2) 0,hsla(0,0%,100%,.3) 40%,hsla(0,0%,100%,.4) 50%,hsla(0,0%,100%,.5) 60%,hsla(0,0%,100%,0) 70%);background:-o-radial-gradient(hsla(0,0%,100%,.2) 0,hsla(0,0%,100%,.3) 40%,hsla(0,0%,100%,.4) 50%,hsla(0,0%,100%,.5) 60%,hsla(0,0%,100%,0) 70%);background:-moz-radial-gradient(hsla(0,0%,100%,.2) 0,hsla(0,0%,100%,.3) 40%,hsla(0,0%,100%,.4) 50%,hsla(0,0%,100%,.5) 60%,hsla(0,0%,100%,0) 70%);background:radial-gradient(hsla(0,0%,100%,.2) 0,hsla(0,0%,100%,.3) 40%,hsla(0,0%,100%,.4) 50%,hsla(0,0%,100%,.5) 60%,hsla(0,0%,100%,0) 70%)}.waves-effect.waves-classic .waves-ripple{background:rgba(0,0,0,.2)}.waves-effect.waves-classic.waves-light .waves-ripple{background:hsla(0,0%,100%,.4)}.waves-notransition{-webkit-transition:none!important;-moz-transition:none!important;-o-transition:none!important;transition:none!important}.waves-button,.waves-circle{-webkit-transform:translateZ(0);-moz-transform:translateZ(0);-ms-transform:translateZ(0);-o-transform:translateZ(0);transform:translateZ(0);-webkit-mask-image:-webkit-radial-gradient(circle,#fff 100%,#000 0)}.waves-button,.waves-button-input,.waves-button:hover,.waves-button:visited{white-space:nowrap;vertical-align:middle;cursor:pointer;border:none;outline:none;color:inherit;background-color:transparent;font-size:1em;line-height:1em;text-align:center;text-decoration:none;z-index:1}.waves-button{padding:.85em 1.1em;border-radius:.2em}.waves-button-input{margin:0;padding:.85em 1.1em}.waves-input-wrapper{border-radius:.2em;vertical-align:bottom}.waves-input-wrapper.waves-button{padding:0}.waves-input-wrapper .waves-button-input{position:relative;top:0;left:0;z-index:1}.waves-circle{text-align:center;width:2.5em;height:2.5em;line-height:2.5em;border-radius:50%}.waves-float{-webkit-mask-image:none;-webkit-box-shadow:0 1px 1.5px 1px rgba(0,0,0,.12);box-shadow:0 1px 1.5px 1px rgba(0,0,0,.12);-webkit-transition:all .3s;-moz-transition:all .3s;-o-transition:all .3s;transition:all .3s}.waves-float:active{-webkit-box-shadow:0 8px 20px 1px rgba(0,0,0,.3);box-shadow:0 8px 20px 1px rgba(0,0,0,.3)}.waves-block{display:block}</style></head>

<body class="  pace-done">
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->

    <!-- [ content ] Start -->
    <div class="authentication-wrapper authentication-1 px-4">
        <div class="authentication-inner py-5">

            <!-- [ Logo ] Start -->
            <div class="d-flex justify-content-center align-items-center">
                <div class="ui-w-60">
                    <div class="w-100 position-relative">
                        <img src="{{ URL::to('assetsAdmin/img/logo-dark.png') }}" alt="Brand Logo" class="img-fluid">
                    </div>
                </div>
            </div>
            <!-- [ Logo ] End -->

            <!-- [ Form ] Start -->
            <form  method="POST" action="{{ route('admin-login') }}" class="my-5">
                @csrf
                <div class="form-group">
                    <label  class="form-label">Email</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control">
                    <div class="clearfix"></div>
                    @error('email')
                    <span style="color:red">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                    <label class="form-label d-flex justify-content-between align-items-end">
                        <span>Password</span>
                        <a href="pages_authentication_password-reset.html" class="d-block small">Forgot password?</a>
                    </label>
                    <input name="password" type="password" class="form-control">
                    <div class="clearfix"></div>
                    @error('password')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                    @error('errors')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                <div class="d-flex justify-content-between align-items-center m-0">
                    <label class="custom-control custom-checkbox m-0">
                        <input type="checkbox" class="custom-control-input">

                        <span class="custom-control-label">Remember me</span>
                    </label>
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>
            </form>
            <!-- [ Form ] End -->
        </div>
    </div>
    <!-- [ content ] End -->

    <!-- Core scripts -->
    <script src="{{ URL::to('assetsAdmin/js/pace.js')}}"></script>
    <script src="{{ URL::to('assetsAdmin/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ URL::to('assetsAdmin/libs/popper/popper.js')}}"></script>
    <script src="{{ URL::to('assetsAdmin/js/bootstrap.js')}}"></script>
    <script src="{{ URL::to('assetsAdmin/js/sidenav.js')}}"></script>
    <script src="{{ URL::to('assetsAdmin/js/layout-helpers.js')}}"></script>
    <script src="{{ URL::to('assetsAdmin/js/material-ripple.js')}}"></script>

    <!-- Libs -->
    <script src="{{ URL::to('assetsAdmin/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <!-- Demo -->
    <script src="{{ URL::to('assetsAdmin/js/demo.js')}}"></script>



</body></html>
