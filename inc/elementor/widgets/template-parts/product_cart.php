<div class="card app_card card-transform">
	<div class="card_top position-relative">
		<img class="card-img-top app_card_image"
		     src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>"
		     alt="Card image cap">
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
		<h6 class="card-title text-center font-weight-bold"><a href="#">گوشی موبایل
				sumsung a30</a></h6>
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
