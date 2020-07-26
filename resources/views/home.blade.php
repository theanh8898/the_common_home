@extends('layouts.app')

@section('content')
    <div>
        <!-- Slider section  -->
        <section class="slider-section">
            <div id="main-slider" class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" style="background-image: url({{ asset('theme/assets/images/slider.png') }})"></div>
                    <div class="swiper-slide" style="background-image: url({{ asset('theme/assets/images/bg1.jpg') }})"></div>
                    <div class="swiper-slide" style="background-image: url({{ asset('theme/assets/images/bg2.jpg') }})"></div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next">
                    <span>Next</span>
                </div>
                <div class="swiper-button-prev">
                    <span>Prev</span>
                </div>
                <!-- Find Room -->
                <div class="find-room">Find a room</div>
                <div class="find-room-form">
                    <form>
                        <div class="input-group">
                            <label>
                                <input type="text" name="name-destination" placeholder="Name or Destination">
                            </label>
                        </div>
                        <div class="input-group">
                            <label> Short Term / Long Term
                                <select name="term" id="findByTerm">
                                    <option value="0">Short Term</option>
                                    <option value="1">Long Term</option>
                                </select>
                            </label>
                        </div>
                    </form>
                </div>
                <!--btn-right-fixed-->
                <ul class="btn-right-fixed">
                    <li class="btn-item btn-down">
                        <a href="#home-page"><span class="fa fa-arrow-down"></span></a>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End slider section  -->
        <!--  Main-page-->
        <div class="main-page" id="home-page">
            <!-- Home-page   -->
            <div class="home-page">
                <!-- Slogan section  -->
                <section class="home-section slogan-sections">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 d-flex align-items-center">
                                <h3 class="title">Home stay for youth</h3>
                            </div>
                            <div class="col-md-6 col-sm-12 d-flex align-items-center">
                                <div class="slogan-text">
                                    Inspiring by the urge to show an authentic Vietnam, by the desire to make every single stay the most
                                    comfortable, just like staying at home,
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Slogan section  -->
                <!-- Selected Home section  -->
                <section class="section home-section selected-home-section">
                    <div class="container">
                        <div class="pattern pd-30">
                            <img src="{{ asset('theme/assets/images/Pattern.png') }}" alt="pattern"/>
                        </div>
                        <div class="section-title">
                            <h2>Selected Homes</h2>
                        </div>
                        <div class="section-inner">
                            <div class="link-more-wrapper">
                                <a class="link-more" href="#">See all home <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <div class="content">
                                <div class="row">
                                    @foreach($homes as $home)
                                    <div class="col-md-6 col-sm-12">
                                        <a class="item-box" href="#" >
                                            <div class="image-item">
                                                @if($home->medias->toArray() !== [])
                                                    <img src="{{ ($home->medias->toArray()[0])['name'] }}" alt="avatar">
                                                @else
                                                    <img src="{{ asset('theme/assets/images/home-2.png') }}" alt="avatar">
                                                @endif
                                                <div class="see-more-veil">
                                                    <p>See more <i class="fa fa-angle-double-right"></i></p>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <h3 class="title">{{ $home->name }}</h3>
                                                <div class="address">{{ $home->address }}/ {{ ($home->type_home === 0) ? "Dorm Homestay" : "Private Room Homestay" }}</div>
                                                <div class="intro">
                                                    {{ $home->introduction }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Selected Home section  -->
                <!-- Selected Videos section  -->
                <section class="section home-section selected-videos-section">
                    <div class="container">
                        <div class="section-title">
                            <h2>Selected Videos</h2>
                        </div>
                        <div class="section-inner">
                            <div class="link-more-wrapper">
                                <a class="link-more" href="#">Find all videos our youtube chanel <i
                                        class="fa fa-angle-double-right"></i></a>
                            </div>
                            <div class="content">
                                <div class="videos-carousel">
                                    <div class="carousel-cell">
                                        <div class="wrapper">
                                            <iframe
                                                width="100%" height="615"
                                                src="https://www.youtube.com/embed/6t-MjBazs3o"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                    <div class="carousel-cell">
                                        <div class="wrapper">
                                            <iframe
                                                width="100%" height="615" src="https://www.youtube.com/embed/jgZkrA8E5do" frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Selected Videos section  -->
                <!-- Our stories section  -->
                <section class="section home-section our-stories-section">
                    <div class="container-half">
                        <div class="section-inner">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4 position-relative">
                                    <h2 class="label">Our Stories</h2>
                                    <div class="wrapper">
                                        <div class="intro">
                                            San Francisco is a  city defined by its relationship to housing. Since the 90s it has faced an
                                            affordable housing shortage, and now, has some of the highest rents of any major US city. As
                                            planners and policy makers work to move beyond the city's past and find new paths forward,
                                            architects and designers are testing out diverse housing models. From dense residential towers to
                                            multi-unit developments, modern housing aims to strike a balance between economy and urbanity.
                                        </div>
                                        <div class="link-more-wrapper">
                                            <a class="link-more" href="#">See all stories <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-8">
                                    <div class="avatar-image">
                                        <a href="#" class="veil-wrapper">
                                            <img src="{{ asset('theme/assets/images/home-2.png') }}" alt="our-stories">
                                            <div class="see-more-veil">
                                                <p>See more <i class="fa fa-angle-double-right" aria-hidden="true"></i></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Our stories section  -->
                <!-- latest Posts section  -->
                <section class="section home-section latest-posts-section">
                    <div class="container">
                        <div class="section-title">
                            <h2>Latest posts</h2>
                        </div>
                        <div class="section-inner">
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-3">
                                    <a class="post-item" href="">
                                        <div class="avatar-item" style="background-image: url({{ asset('theme/assets/images/home-1.png') }})"></div>
                                        <div class="info-item">
                                            <h3 class="title">The best of lake BED</h3>
                                            <div class="intro">
                                                Discover the BED lake in the midle of our country to find out what make it so special
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-6 col-md-3">
                                    <a class="post-item" href="">
                                        <div class="avatar-item" style="background-image: url({{ asset('theme/assets/images/home-2.png') }})"></div>
                                        <div class="info-item">
                                            <h3 class="title">The best of lake BED</h3>
                                            <div class="intro">
                                                Discover the BED lake in the midle of our country to find out what make it so special
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-6 col-md-3">
                                    <a class="post-item" href="">
                                        <div class="avatar-item" style="background-image: url({{ asset('theme/assets/images/home-2.png') }})"></div>
                                        <div class="info-item">
                                            <h3 class="title">The best of lake BED</h3>
                                            <div class="intro">
                                                Discover the BED lake in the midle of our country to find out what make it so special
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-6 col-md-3">
                                    <a class="post-item" href="">
                                        <div class="avatar-item" style="background-image: url({{ asset('theme/assets/images/home-4.png') }})"></div>
                                        <div class="info-item">
                                            <h3 class="title">The best of lake BED</h3>
                                            <div class="intro">
                                                Discover the BED lake in the midle of our country to find out what make it so special
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section home-section line-section">
                    <img src="{{ asset('theme/assets/images/Line.png') }}" alt="line">
                </section>
                <!-- End Latest Posts section  -->
            </div>
            <!-- End Home-page   -->
        </div>
        <!--  End Main-page -->
{{--        This is home page {{ dd($homes[0]->name) }}--}}
    </div>
@endsection
