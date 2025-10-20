# CHANGE LOG: Theme chooser (z4m_themechooser)

## Version 1.2, 2025-10-20
CHANGE: new 'Auto' button added to the 'Theme' modal to make the light or dark
theme applied automatically according to the Operating System or web browser
theme settings.
CHANGE: new jQuery event 'z4mthemechooserchange' triggered by the HTML body
element each time the theme has changed.
CHANGE: the company logo displayed in the banner of the login page and when user
is logged out is now already updated when theme scheme has changed.

## Version 1.1, 2025-08-08
BUG FIXING: in the README.md script of the module, the definition of the LC_HEAD_IMG_LOGO PHP
constant in the `locale.php` of the application was incorrect. The specified path must
be prefixed by the `ZNETDK_ROOT_URI` PHP constant. Otherwise, in case of http error 403 or 404,
the application's logo is not displayed.

## Version 1.0, 2024-10-25
First version.