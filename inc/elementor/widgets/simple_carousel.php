<?php

require_once get_template_directory() . '/inc/elementor/helpers/utlis.php';
// namespace PyPracts;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class CarouselWidget extends Widget_Base
{

    public function get_name()
    {
        return 'carousel';
    }

    public function get_title()
    {
        return 'اسلایدر ساده';
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['pypracts'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => 'کوئری',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

<div class="product-carousel">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->



        <div class="swiper-slide">
            <div class="card app_card">
                <div class="card_top position-relative">
                <img class="card-img-top app_card_image" src="http://localhost/negarshop/wp-content/uploads/2019/05/71-z0QKBWHL._SL1500_-1-300x300.jpg" alt="Card image cap">
                <div class="product_icons_wraper align-middle position-absolute">
                    <div class="product_icons radius text-center d-flex">
                    <a href="">
                        <i class=" align-middle px-2  fas fa-shopping-cart"></i>
                    </a>
                    <a href="">
                        <i class=" align-middle px-2  fas fa-random"></i>
                    </a>
                    <a href="">
                        <i class=" align-middle px-2  fas fa-heart"></i>
                    </a>
                    </div>
                    <div class="product_rating_stars text-center">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    </div>
                </div>
                </div>
                <div class="card-body">
                <h6 class="card-title text-center font-weight-bold"><a href="#">گوشی موبایل sumsung a30</a></h6>
                <div class="d-flex align-items-center">
                    <div class="">
                    <a href="" class="fas fa-shopping-cart card_shopping_icon"></a>
                    </div>
                    <div class="mr-auto">
                    <!-- <p class="card-text font-weight-bold"> -->
                    <del class="text-muted discount_price">25000</del>
                    <!-- </p> -->
                    <p class="card-text font-weight-bold text-left">
                        15000 تومان
                    </p>
                    </div>
                </div>
                </div>
            </div>
        </div>





    </div>
</div>
<script>
jQuery(document).ready(function(){
    var mySwiper = new Swiper('.product-carousel', {
        breakpoints: {
        480: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 3,
        },
        1000: {
          slidesPerView: 4,
        },
      },

      slidesPerView: 4,
      autoplay: {
        delay: 3000,
      },
      loop: true,
      spaceBetween: 10,

})
});
</script>
        <?php

    }
}
