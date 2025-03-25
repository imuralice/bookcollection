<?php get_header(); ?>
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Welcome to BookCollection</h1>
        <p class="subtitle">Discover your next favorite read from our curated collection</p>
        <a href="<?php echo get_post_type_archive_link('book'); ?>" class="btn">Explore All Books</a>
    </div>
</section>


<main>
    <?php
    // Override the main query to fetch featured books
    global $wp_query;
    $args = [
        'post_type' => 'book',
        'posts_per_page' => get_theme_mod('bc_books_per_slider', 6), // Use slider setting
        'meta_key' => '_bm_featured',
        'meta_value' => '1',
    ];
    $wp_query = new WP_Query($args);
    ?>

    <!-- NEW: Book Slider -->
    <div class="swiper book-slider">
        <div class="swiper-wrapper">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="swiper-slide">
                        <div class="book-item">
                            <?php if (get_post_meta(get_the_ID(), '_bm_featured', true)) : ?>
                                <div class="featured-ribbon">Featured</div>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                            <p>Author: <?php echo get_post_meta(get_the_ID(), '_bm_author', true); ?></p>
                            <p>Year: <?php echo get_post_meta(get_the_ID(), '_bm_year', true); ?></p>
                            <div class="description"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No featured books found.</p>
            <?php endif; ?>
        </div>
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <?php wp_reset_postdata(); ?>
</main>

<!-- NEW: Swiper Initialization -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const swiper = new Swiper('.book-slider', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
    });
});
</script>

<?php get_footer(); ?>