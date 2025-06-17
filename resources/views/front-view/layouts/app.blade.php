<!DOCTYPE html>
<html lang="en">

<head>
    @include('front-view.layouts.partials.head')
</head>

<body>

    <div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /Loader_form -->

    <header>
        <div id="logo_home">
            <h1><a href="/" title="Survey">Survey</a></h1>
        </div>

        <a id="menu-button-mobile" class="cmn-toggle-switch cmn-toggle-switch__htx" href="javascript:void(0);"><span>Menu mobile</span></a>
        <nav class="main_nav">
            <ul class="nav nav-tabs">
                <li><a href="#tab_1" data-bs-toggle="tab">Survey</a></li>
            </ul>
        </nav>
    </header><!-- /header -->

    <div class=" txt row animated fadeInUp w-100 justify-content-center align-items-center p-3 m-0">
        <div class="col-12 col-md-6 col-lg-4">
            <h2>Welcome to Our Design Survey</h2>
            <p class="fw-light">Thank you for taking the time to participate! Your feedback is incredibly valuable in helping us improve and innovate our products.</p>
            <div class="main_nav d-block position-relative bg-transparent border-0 right-0" style="right: 0; top:20px !important;">
                <div class="nav nav-tabs bg-transparent border-0">
                    <a href="#tab_1" id="menu-button-mobile2" data-bs-toggle="tab" class="btn neon-button start-survey">Let's Start</a>
                </div>
            </div>
        </div>
    </div>

    <video id="my-video" class="video" loop muted autoplay playsinline>
      <source src="{{ asset('asset/media/demo-2.mp4')}}" type="video/mp4">
      <source src="{{ asset('asset/media/demo-2.ogv')}}" type="video/ogg">
      <source src="{{ asset('asset/media/demo-2.webm')}}" type="video/webm">
	</video><!-- /video -->

    <div class="layer"></div><!-- /mask -->

    <div id="main_container">

        @yield('content')
    </div><!-- /main_container -->

    <div id="additional_links">
        <ul>
            <li>© Survey</li>
        </ul>
    </div><!-- /add links -->

	<!-- SCRIPTS -->
    <!-- Jquery-->
    @include('front-view.layouts.partials.foot')


</body>

</html>
