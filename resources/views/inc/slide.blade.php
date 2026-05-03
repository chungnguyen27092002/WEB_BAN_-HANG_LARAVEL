<!-- <div class="amazingslider-wrapper" id="amazingslider-wrapper-1">
    <div class="amazingslider" id="amazingslider-1">
        <ul class="amazingslider-slides">
            @foreach($slide as $s)
            <li><a href="#" title=""><img src="{!! asset('uploads/slider/'.$s->slider_image)!!}" alt="" title="" /></a>
            </li>
            @endforeach
        </ul>
    </div>
</div> -->
<style>
     swiper-container {
      width: 100%;
      height: 100%;
      padding-top: 100px;
    }

    swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<swiper-container class="mySwiper" space-between="30"
    centered-slides="true" autoplay-delay="2500" autoplay-disable-on-interaction="false">
    @foreach($slide as $s)
    <swiper-slide><a style="width: 90%;" href="#" title=""><img src="{!! asset('uploads/slider/'.$s->slider_image)!!}" alt="" title="" /></a>
    </swiper-slide>
    @endforeach
</swiper-container>