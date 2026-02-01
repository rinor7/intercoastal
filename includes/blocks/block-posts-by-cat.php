<section class="blogs__section">

  <?php if ($uptitle || $title || $subtitle): ?>
    <div class="section-header">
      <?php if ($uptitle): ?>
        <div class="section-header-uptitle"><?php echo wp_kses_post($uptitle); ?></div>
      <?php endif; ?>

      <?php if ($title): ?>
        <div class="section-header-title"><?php echo wp_kses_post($title); ?></div>
      <?php endif; ?>

      <?php if ($subtitle): ?>
        <div class="section-header-subtitle"><?php echo wp_kses_post($subtitle); ?></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="container">
    <div class="row">
      <?php
      $default_cat_id = (int) get_option('default_category');

      $q_args = [
        'post_type'        => 'post',
        'posts_per_page'   => $posts_per_page,
        'category__not_in' => [$default_cat_id],
      ];

      if (!empty($cat_slug)) {
        $q_args['category_name'] = $cat_slug;
      }

      $the_query = new WP_Query($q_args);

      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
          ?>
          <div class="blog__item col-lg-4">
            <?php if (has_post_thumbnail()) : ?>
              <div class="blog__image">
                <?php the_post_thumbnail('medium'); ?>
              </div>
            <?php endif; ?>

            <div class="blog__item-content">
              <div class="blog__meta">
                <?php
                $tags = get_the_terms(get_the_ID(), 'post_tag');
                if ($tags && !is_wp_error($tags)) : ?>
                  <span class="blog__tag"><?php echo esc_html($tags[0]->name); ?></span>
                <?php endif; ?>

                <?php $mins = s25_get_read_time_minutes(get_the_ID(), 200); ?>
                <span class="blog__readtime"><?php echo esc_html($mins . ' min read'); ?></span>
              </div>

              <h3 class="blog__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h3>

              <div class="blog__excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
              </div>

              <a class="blog__readmore" href="<?php the_permalink(); ?>">
                <?php echo esc_html($read_more_text); ?>
                <span>
                  <svg width="4" height="7" viewBox="0 0 4 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.697388 0.129886L3.37439 2.80689C3.43639 2.86889 3.48405 2.93555 3.51739 3.00689C3.55072 3.07822 3.56705 3.15655 3.56639 3.24189C3.56572 3.32722 3.54905 3.40555 3.51639 3.47689C3.48372 3.54822 3.43605 3.61489 3.37339 3.67689L0.696387 6.35389C0.659054 6.39055 0.616054 6.42155 0.567387 6.44689C0.51872 6.47155 0.466388 6.48389 0.410388 6.48389C0.298388 6.48389 0.202054 6.44722 0.121387 6.37389C0.0407202 6.29922 0.00038674 6.20155 0.00038675 6.08089L0.000387246 0.403886C0.000387257 0.282553 0.0417212 0.184887 0.124388 0.110887C0.207054 0.0368874 0.303055 -0.000112819 0.412388 -0.000112809C0.440388 -0.000112807 0.535054 0.0432198 0.696387 0.129886" fill="white"/>
                  </svg>
                </span>
              </a>
            </div>
          </div>
          <?php
        endwhile;

      else : ?>
        <div class="col-12">
          <div class="blogs__empty">
            <?php echo esc_html__('No posts in this category yet.', 'textdomain'); ?>
          </div>
        </div>
      <?php
      endif;

      wp_reset_postdata();
      ?>
    </div><!-- /.row -->

    <?php if ($cat_obj && !is_wp_error($cat_obj) && $the_query->found_posts > 0) : ?>
      <div class="blogs__viewall">
        <a class="btn-all" href="<?php echo esc_url(get_category_link($cat_obj->term_id)); ?>">
          <?php echo esc_html($view_all_text); ?>
        </a>
      </div>
    <?php endif; ?>

  </div><!-- /.container -->
</section>
