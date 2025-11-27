<?php
/**
 * Navigation links shared across section shortcodes.
 *
 * @var array  $section_links Array of nav link definitions.
 * @var string $current_slug  Current section slug.
 */
?>
<nav class="kb-fortis-section-nav">
    <ul>
        <?php foreach ( $section_links as $slug => $link ) : ?>
            <li class="<?php echo $slug === $current_slug ? 'is-active' : ''; ?>">
                <a href="<?php echo esc_url( $link['url'] ); ?>">
                    <?php echo esc_html( $link['title'] ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
