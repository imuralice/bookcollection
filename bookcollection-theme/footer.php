<?php
/**
 * The template for displaying the footer
 */
?>
<footer class="site-footer">
    <div class="footer-inner">
        <!-- Gradient Logo -->
        <div class="footer-logo">
            <span class="books">Books</span><span class="collection">Collection</span>
        </div>

        <!-- Social Icons -->
        <div class="social-icons">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        </div>

        <!-- Copyright Text -->
        <p class="copyright">
            &copy; <?php echo esc_html(date('Y')); ?> BookCollection | 
            Proudly powered by <a href="<?php echo esc_url('https://your-website.com'); ?>">Anoop Kumar</a>
        </p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>