<?php
include 'navbar.php';
?>

<main>
    <div class="pd-wrap mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div id="slider" class="owl-carousel product-slider">
                        <div class="item mb-2">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-dtl">
                        <div class="product-info">
                            <div class="product-name">Variable Product</div>
                            <div class="product-price-discount"><span>$39.00</span><span class="line-through">$29.00</span></div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="size">Size</label>
                                <input type="text" class="form-control" value="" disabled>
                            </div>
                        </div>
                        <div class="product-count">
                            <label for="size">Quantity</label>
                            <form action="#" class="display-flex">
                                <div class="qtyminus">-</div>
                                <input type="text" name="quantity" value="1" class="qty" disabled>
                                <div class="qtyplus">+</div>
                            </form>
                            <a href="#" class="round-black-btn text-decoration-none">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>