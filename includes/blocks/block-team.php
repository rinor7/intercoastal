<?php 
$block = get_field('block-team');
$features = $block['features'] ?? [];

if ( ! ($block['disable_section'] ?? false) ):
?>

<section class="block-team" aria-label="Team Section">

    <!-- SECTION HEADER -->
    <div class="section-header">
        <?php if (!empty($block['section_uptitle'])): ?>
            <div class="section-header-uptitle">
                <?php echo wp_kses_post($block['section_uptitle']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($block['section_title'])): ?>
            <div class="section-header-title">
                <?php echo wp_kses_post($block['section_title']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($block['section_subtitle'])): ?>
            <div class="section-header-subtitle">
                <?php echo wp_kses_post($block['section_subtitle']); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- TEAM MEMBERS GRID -->
   <div class="container">
        <div class="team-members-grid">
            <?php if ($features): ?>
                <?php foreach ($features as $member): 
                    $image = $member['photo'] ?? '';
                    $name = $member['name'] ?? '';
                    $role = $member['role'] ?? '';
                    $description = $member['description'] ?? '';
                    $linkedin = $member['linkedin'] ?? '';
                    $x = $member['x'] ?? '';
                    $website = $member['website'] ?? '';
                ?>
                <div class="team-member">
                    <div class="team-member-photo">
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? $name); ?>">
                        <?php else: ?>
                            <div class="placeholder-photo"></div>
                        <?php endif; ?>
                    </div>
                    <div class="team-member-info">
                        <?php if ($name): ?><h4 class="team-member-name"><?php echo esc_html($name); ?></h4><?php endif; ?>
                        <?php if ($role): ?><div class="team-member-role"><?php echo esc_html($role); ?></div><?php endif; ?>
                        <?php if ($description): ?><p class="team-member-description"><?php echo esc_html($description); ?></p><?php endif; ?>
                    </div>
                    <div class="team-member-socials">
                        <?php if ($linkedin): ?>
                            <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
                        <?php endif; ?>
                        <?php if ($x): ?>
                            <a href="<?php echo esc_url($x); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-x-twitter"></i></a>
                        <?php endif; ?>
                        <?php if ($website): ?>
                            <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-globe"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
   </div>

</section>
<?php endif; ?>
