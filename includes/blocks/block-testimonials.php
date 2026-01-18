<div class="container">
<?php 
$testimonials = get_field('testimonial_slider', 'option'); // get repeater from options page
if( $testimonials ): ?>
<div class="swiper testimonial-slider <?php if (is_page_template('template-general.php')) : ?>testimonial-slider-general<?php endif; ?>">
    <div class="swiper-wrapper">
        <?php foreach( $testimonials as $t ): ?>
        <div class="swiper-slide">
            <div class="testimonial-content">
                <p class="quote">
                    <span class="stars"></span>
                    "<?php echo esc_html($t['quote']); ?>"
                </p>
                <div class="testimonial-author">
                    <?php if( $t['photo'] ): ?>
                        <img src="<?php echo esc_url($t['photo']['url']); ?>" alt="<?php echo esc_attr($t['name']); ?>">
                    <?php endif; ?>
                    <div class="author-info">
                        <strong><?php echo esc_html($t['name']); ?></strong>
                        <span><?php echo esc_html($t['position']); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
   <?php if (is_page_template('template-general.php')) : ?>
    <div class="pagination-wrapper">
       <div class="pagination">
         <div class="swiper-pagination"></div>
       </div>
        <div class="arrows">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>
</div>
