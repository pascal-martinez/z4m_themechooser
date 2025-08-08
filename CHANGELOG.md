# CHANGE LOG: Theme chooser (z4m_themechooser)

## Version 1.1, 2025-08-08
BUG FIXING: in the README.md script of the module, the definition of the LC_HEAD_IMG_LOGO PHP
constant in the `locale.php` of the application was incorrect. The specified path must
be prefixed by the `ZNETDK_ROOT_URI` PHP constant. Otherwise, in case of http error 403 or 404,
the application's logo is not displayed.

## Version 1.0, 2024-10-25
First version.