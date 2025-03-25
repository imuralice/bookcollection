# BookCollection - Custom WordPress Theme and Plugin

This repository contains a custom WordPress theme (`bookcollection-theme`) and plugin (`book-manager`) for managing and displaying books.

## Features
- **Custom Post Type**: Books with metadata (author, year, featured status).
- **Custom Templates**: Homepage, archive, single book, and default interior page.
- **Shortcode**: `[book_list]` to display books in a grid format.
- **Filtering**: Filter books by author or year on the archive page.
- **Responsive Design**: Modern, mobile-friendly layout.

---

## Installation Instructions

### 1. Install the Theme
1. Download the `bookcollection-theme` folder from this repository.
2. Upload it to your WordPress installation under `wp-content/themes/`.
3. Go to **Appearance > Themes** in the WordPress dashboard.
4. Activate the `BookCollection` theme.

### 2. Install the Plugin
1. Download the `book-manager` folder from this repository.
2. Upload it to your WordPress installation under `wp-content/plugins/`.
3. Go to **Plugins > Installed Plugins** in the WordPress dashboard.
4. Activate the `Book Manager` plugin.

### 3. Add Sample Data (Optional)
- Use the WordPress importer or manually create sample books to test the functionality.

---

## Usage
- **Homepage**: Displays a slider of featured books.
- **Books Archive**: `/books/` shows all books with filtering options.
- **Single Book**: Each book has its own detailed page.
- **Shortcode**: Use `[book_list per_page="6"]` to embed a book grid on any page.

---

## Folder Structure
- `bookcollection-theme/`: Custom WordPress theme.
- `book-manager/`: Custom WordPress plugin.

---

## Support
For questions or issues, please open an issue in this repository or contact me directly.

---

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.