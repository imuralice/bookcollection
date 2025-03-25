wp.customize('bc_books_per_slider', (value) => {
    value.bind((newValue) => {
        // Reload preview when setting changes
        wp.customize.previewer.refresh();
    });
});