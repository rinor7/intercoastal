<!-- if its needed background without container 
add image-no-container-right class on parent div block-image-and-text-->
<?php if (!get_field('block-image-and-text')['disable_section'] ?? false): ?>
<section class="block-image-and-text image-no-container-right" aria-label="Image with Content Section">
    <div class="content-row">
        <div class="container">
            <div class="content">
                <div class="content-left">
                    <?php echo ( get_field('block-image-and-text')['content-left'] );?>
                </div>
                <div class="content-right">
                    <?php echo ( get_field('block-image-and-text')['content-right'] );?>
                </div>
            </div>
        </div>
    </div>
    <div class="image-row">
        <div class="container">
            <div class="img">
                <img src="<?php echo ( get_field('block-image-and-text')['image'] );?>" alt="Background"
                    loading=“lazy”>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>