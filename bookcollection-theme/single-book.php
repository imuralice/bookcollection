<?php get_header(); ?>
<main>
    <section class="single-book-section">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="single-book-container">
                <div class="book-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', ['class' => 'cover-image']); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-book.jpg" alt="Default Book Cover" class="cover-image">
                    <?php endif; ?>
                </div>
                <div class="book-details">
                    <h1><?php the_title(); ?></h1>
                    <p><strong>Author:</strong> <?php echo get_post_meta(get_the_ID(), '_bm_author', true); ?></p>
                    <p><strong>Year:</strong> <?php echo get_post_meta(get_the_ID(), '_bm_year', true); ?></p>
                    <div class="description">
                        <h3>Description</h3>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </section>
</main>
<?php get_footer(); ?>