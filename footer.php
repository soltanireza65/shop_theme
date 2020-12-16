<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shop_Theme
 */

?>

<footer class="page-footer font-small bg-gray pt-4 mt-5">
    <div class="container text-center text-md-left">
        <div class="row">
            <div class="col-md-2 mx-auto text-right d-none d-md-block">
                <a href="">
                    <h6 class="font-weight-bold text-uppercase mt-3 mb-4">
                        راهنمای خرید از دکان
                    </h6>
                </a>

                <ul class="list-unstyled">
                    <li>
                        <a href="#!">نحوه ثبت سفارش</a>
                    </li>
                    <li>
                        <a href="#!">رویه ارسال سفارش</a>
                    </li>
                    <li>
                        <a href="#!">شیوه‌های پرداخت</a>
                    </li>
                </ul>
            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none" />

            <!-- Grid column -->
            <div class="col-md-2 mx-auto text-right  d-none d-md-block">
                <a href="">
                    <h6 class="font-weight-bold text-uppercase mt-3 mb-4">
                        خدمات مشتری
                    </h6>
                </a>

                <ul class="list-unstyled">
                    <li>
                        <a href="#!">پاسخ به پرسش‌های متداول</a>
                    </li>
                    <li>
                        <a href="#!">رویه‌های بازگرداندن کالا</a>
                    </li>
                    <li>
                        <a href="#!">شرایط استفاده</a>
                    </li>
                    <li>
                        <a href="#!">حریم خصوصی</a>
                    </li>
                    <li>
                        <a href="#!">گزارش باگ</a>
                    </li>
                </ul>
            </div>

            <hr class="clearfix w-100 d-md-none" />

            <!-- Grid column -->
            <div class="col-md-2 mx-auto text-right  d-none d-md-block">
                <a href="">
                    <h6 class="font-weight-bold text-uppercase mt-3 mb-4">با دکان</h6>
                </a>

                <ul class="list-unstyled">
                    <li>
                        <a href="#!">اتاق خبر دکان</a>
                    </li>
                    <li>
                        <a href="#!">فروش در دکان</a>
                    </li>
                    <li>
                        <a href="#!">تماس با دکان</a>
                    </li>
                    <li>
                        <a href="#!">درباره دکان</a>
                    </li>
                </ul>
            </div>



            <!-- Grid column -->
            <!-- Grid column -->
            <div class="col-md-4 mx-auto text-right">
                <h6 class="font-weight-bold text-uppercase mt-3 mb-4 text-dark">
                    از تخفیف ها و محصولات جدید دکان با خبر شو:
                </h6>
                <div class="d-flex">
                    <input type="email" class="form-control br-left" id="inputEmail4" placeholder="ایمیل" />

                    <button type="button" class="btn btn-danger br-right">
                        ارسال
                    </button>
                </div>
                <?php do_shortcode('[contact-form-7 id="327" title="خبرنامه"]') ?>
                <?php do_shortcode('[contact-form-7 id="326" title="فرم تماس 1"]') ?>
                <h6 class="font-weight-bold text-uppercase mt-3 mb-4 text-dark">
                    دکان را در شبکه های اجتماعی دنبال کنید:
                </h6>
                <div class="d-flex">
                    <a href=""><i class="fab fa-instagram fa-2x ml-2"></i></a>
                    <a href=""><i class="fab fa-telegram fa-2x ml-2"></i></a>
                    <a href=""><i class="fab fa-twitter-square fa-2x"></i></a>
                </div>
            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none" />
        </div>
        <!-- Grid row -->
    </div>
    <hr />
    <div class="footer-copyright text-center py-3">© 2020 PayPracts</div>
    </div>
    <style>
        .footer_links {
            position: fixed;
            z-index: 22;
            bottom: 0em;
            height: 50px;
            left: 0em;
            right: 0em;
            background-color: black;
        }

        .footer_buttons {
            padding: 10px 30px;
            border: 2px solid black;
            color: white;
            vertical-align: center;
        }

        .footer_iconts {
            padding-bottom: 10px;
        }
    </style>
    <?php
    global $woocommerce;
    if (WC()->cart->get_cart_contents_count() && !is_cart() && !is_checkout()) {
    ?>
        <div class="footer_links d-flex justify-content-center d-block d-md-none d-lg-none">
            <a href="" class="footer_buttons"><i class="footer_iconts fas fa-shopping-cart fa-2x"></i></a>
            <a href="" class="footer_buttons"><i class="footer_iconts fas fa-shopping-cart fa-2x"></i></a>
        </div>

    <?php
    }
    ?>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>