<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-8 md:mb-0">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h2 class="text-2xl font-bold">';
                    echo '<span class="text-green-400">わかば</span>のアプリ工房';
                    echo '</h2>';
                }
                ?>
                <p class="mt-2 text-gray-400"><?php bloginfo('description'); ?></p>
            </div>
            <div class="text-center md:text-right">
                <p class="text-gray-400">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html> 