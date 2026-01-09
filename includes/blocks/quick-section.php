<?php if (!get_field('quick-call-group')['disable_section'] ?? false): ?>
<section class="quick__section" aria-label="Quick Call to Action">
    <div class="container">
        <div class="side-wrapper">
            <div class="lefts">
                <h2><?php echo ( get_field('quick-call-group')['title'] );?></h2>
            </div>
            <div class="rights">
                <div class="default-btn">
                    <a href="<?php echo ( get_field('quick-call-group')['link'] );?>"
                        class="link-btn"><?php echo ( get_field('quick-call-group')['name'] );?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>