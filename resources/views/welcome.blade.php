<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="icon" href="{{$data['fav_icon']}}" />
    <title>{{$data['app_name']}}</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('website/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{asset('website/css/templatemo-lava.css')}}">

    <link rel="stylesheet" href="{{asset('website/css/owl-carousel.css')}}">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="/"  class="logo">
                            <img src="{{$data['logo']}}" alt="">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{route('welcome')}}" class="menu-item-link">@lang('dashboard.home')</a></li>
                            <li class="scroll-to-section"><a href="#promotion" class="menu-item">@lang('dashboard.about')</a></li>
                            <li class="scroll-to-section"><a href="#contact-us" class="menu-item">@lang('dashboard.contact_us')</a></li>
                            <li class="scroll-to-section"><a href="{{route('privacy')}}" class="menu-item-link">@lang('dashboard.privacy')</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>@lang('dashboard.menu')</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-12 col-sm-12 col-xs-12"
                        data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <h1> <em>{{$data['app_name']}}</em></h1>
                        <p>
                           {{$data['about']}}
						</p>

                        <div class="donlwad">
                            <a href="{{$data['android_link']}}" target="_blank" rel="">
                                <img src="{{asset('website/images/dwonlowad_android.png')}}" alt="">
                            </a>
                            <a href="{{$data['ios_link']}}" target="_blank" rel="">
                                <img src="{{asset('website/images/dwonlowad_ios.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <!--
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <h2>01</h2>
                            <img src="{{asset('website/images/features-icon-1.png')}}" alt="">
                            <h4>Trend Analysis</h4>
                            <p>Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
                            <a href="#testimonials" class="main-button">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter bottom move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <h2>02</h2>
                            <img src="{{asset('website/images/features-icon-2.png')}}" alt="">
                            <h4>Site Optimization</h4>
                            <p>Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
                            <a href="#testimonials" class="main-button">
                                Discover More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <h2>03</h2>
                            <img src="{{asset('website/images/features-icon-3.png')}}" alt="">
                            <h4>Email Design</h4>
                            <p>Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
                            <a href="#testimonials" class="main-button">
                                More Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    -->
    <!-- ***** Features Big Item End ***** -->

    <div class="left-image-decor"></div>

   <!-- ***** Features Big Item Start ***** -->
   <section class="section" id="promotion">
    <div class="container">
        <div class="row">
            <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big"
                data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                <img src="{{$data['feature_image']}}" class="rounded img-fluid d-block mx-auto" alt="App">
            </div>

            <div class="right-text offset-lg-1 col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix">
                <ul>
                    <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                        <div class="img">
                            <img src="{{$data['feature_1_icon']}}" alt="">
                        </div>
                        <div class="text">
                            <p>
                                {{$data['feature_1_text']}}
                            </p>

                        </div>
                    </li>

                    <li data-scroll-reveal="enter right move 30px over 0.6s after 0.5s">
                        <div class="img">
                            <img src="{{$data['feature_2_icon']}}" alt="">
                        </div>
                        <div class="text">
                            <p>
                                {{$data['feature_2_text']}}
                            </p>
                        </div>
                    </li>
                    <li data-scroll-reveal="enter right move 30px over 0.6s after 0.6s">
                        <div class="img">
                            <img src="{{$data['feature_3_icon']}}" alt="">
                        </div>
                        <div class="text">
                            <p>
                                {{$data['feature_3_text']}}
                            </p>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
   </section>
    <!-- ***** Features Big Item End ***** -->

    <div class="right-image-decor"></div>

    <!-- ***** Testimonials Starts ***** -->
    <!--

    <section class="section" id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="center-heading">
                        <h2>What They Think <em>About Us</em></h2>
                        <p>Suspendisse vitae laoreet mauris. Fusce a nisi dapibus, euismod purus non, convallis odio.
                            Donec vitae magna ornare, pellentesque ex vitae, aliquet urna.</p>
                    </div>
                </div>
                <div class="col-lg-10 col-md-12 col-sm-12 mobile-bottom-fix-big"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <div class="owl-carousel owl-theme">
                        <div class="item service-item">
                            <div class="author">
                                <i><img src="{{asset('website/images/testimonial-author-1.png')}}" alt="Author One"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>Jonathan Smart</h4>
                                <p>“Nullam hendrerit, elit a semper pharetra, ipsum nibh tristique tortor, in tempus
                                    urna elit in mauris.”</p>
                                <span>Besta CTO</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i><img src="{{asset('website/images/testimonial-author-1.png')}}" alt="Second Author"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>Martino Tino</h4>
                                <p>“Morbi non mi luctus felis molestie scelerisque. In ac libero viverra, placerat est
                                    interdum, rhoncus leo.”</p>
                                <span>Web Analyst</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i><img src="{{asset('website/images/testimonial-author-1.png')}}" alt="Author Third"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>George Tasa</h4>
                                <p>“Fusce rutrum in dolor sit amet lobortis. Ut at vehicula justo. Donec quam dolor,
                                    congue a fringilla sed, maximus et urna.”</p>
                                <span>System Admin</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i><img src="{{asset('website/images/testimonial-author-1.png')}}" alt="Fourth Author"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>Sir James</h4>
                                <p>"Fusce rutrum in dolor sit amet lobortis. Ut at vehicula justo. Donec quam dolor,
                                    congue a fringilla sed, maximus et urna."</p>
                                <span>New Villager</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    -->
    <!-- ***** Testimonials Ends ***** -->


    <!-- ***** Footer Start ***** -->
    <footer id="contact-us">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <!-- ***** Contact Form Start ***** -->
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="contact-form">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <fieldset>
                                            <input name="name" type="text" id="name" placeholder="@lang('dashboard.full_name')" required=""
                                                style="background-color: rgba(250,250,250,0.3);">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <fieldset>
                                            <input name="email" type="text" id="email" placeholder="@lang('dashboard.email')"
                                                required="" style="background-color: rgba(250,250,250,0.3);">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <textarea name="message" rows="6" id="message" placeholder="@lang('dashboard.message')"
                                                required="" style="background-color: rgba(250,250,250,0.3);"></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="main-button">@lang('dashboard.send_message')</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- ***** Contact Form End ***** -->
                    <div class="right-content col-lg-6 col-md-12 col-sm-12">
                        <h2>@lang('dashboard.more_about')<em> {{$data['app_name']}}</em></h2>

                        <p>
                            {{$data['more_about']}}
						</p>
                        <ul class="social">
                            @foreach($data['socials'] as $social)
                                <li><a rel="nofollow" href="{{$social->link}}" target="_blank"><img src="{{$social->image}}" alt=""></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <p>{{$data['footer']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{asset('website/js/jquery-2.1.0.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{asset('website/js/popper.js')}}"></script>
    <script src="{{asset('website/js/bootstrap.min.js')}}"></script>

    <!-- Plugins -->
    <script src="{{asset('website/js/owl-carousel.js')}}"></script>
    <script src="{{asset('website/js/scrollreveal.min.js')}}"></script>
    <script src="{{asset('website/js/waypoints.min.js')}}"></script>
    <script src="{{asset('website/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('website/js/imgfix.min.js')}}"></script>

    <!-- Global Init -->
    <script src="{{asset('website/js/custom.js')}}"></script>

</body>
</html>
