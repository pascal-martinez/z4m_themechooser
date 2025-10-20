# ZnetDK 4 Module theme chooser
Allows the ZnetDK 4 Mobile application to be displayed with a dark theme.

![Screenshot of the Theme chooser UI provided by the ZnetDK 4 Mobile 'z4m_themechooser' module](https://mobile.znetdk.fr/applications/default/public/images/modules/z4m_themechooser/screenshot.png?v12)

## FEATURES
- This module add a "Theme" button to the User Panel.
When clicked, a modal dialog is displayed to apply the dark theme or to come
back to the light theme.    
- The favorite theme is saved in database for the logged in user.   
- The `Auto` button when selected, makes the theme selected automatically according to the selected theme at Operating System
or Web browser level.
- The `data-theme` attribute is added to the `body` element and is useful to know
which theme is currently applied (`'dark'` or `'light'`).
- The jQuery event `z4mthemechooserchange` is triggered by the HTML body element
each time the theme has changed.

## REQUIREMENTS
- [ZnetDK 4 Mobile](/../../../znetdk4mobile) version 3.2 or higher,
- A **MySQL** database is configured to store the application data,
- **PHP version 7.4** or higher,
- Authentication is enabled
([`CFG_AUTHENT_REQUIRED`](https://mobile.znetdk.fr/settings#z4m-settings-auth-required)
is `TRUE` in the App's
[`config.php`](/../../../znetdk4mobile/blob/master/applications/default/app/config.php)).

## INSTALLATION
1. Copy module's code in the `./engine/modules/z4m_themechooser/` subdirectory,
2. Edit the App's [`config.php`](/../../../znetdk4mobile/blob/master/applications/default/app/config.php)
located in the [`./applications/default/app/`](/../../../znetdk4mobile/tree/master/applications/default/app/) subfolder and set the path or URL of your dark theme CSS stylesheet to the `MOD_Z4M_THEMECHOOSER_CSS_DARK_THEME` PHP constant.    
If the app logo to be displayed for dark theme is different from the one for light theme, also set the path of your light and dark logos to the `MOD_Z4M_THEMECHOOSER_LOGO_LIGHT_THEME` and `MOD_Z4M_THEMECHOOSER_LOGO_DARK_THEME` PHP constants.    
For example:
```php
define('MOD_Z4M_THEMECHOOSER_CSS_DARK_THEME', 'applications/'.ZNETDK_APP_NAME.'/public/css/theme-dark.css');
// Optional: the paths of the light and dark logos
define('MOD_Z4M_THEMECHOOSER_LOGO_LIGHT_THEME', 'applications/'.ZNETDK_APP_NAME.'/public/images/logo-light.png');
define('MOD_Z4M_THEMECHOOSER_LOGO_DARK_THEME', 'applications/'.ZNETDK_APP_NAME.'/public/images/logo-dark.png');
```
3. In option, If the app logo to be displayed for dark theme is different from the one for light theme,
  edit the [`locale.php`](/../../../znetdk4mobile/blob/master/applications/default/app/lang/locale.php) script of your application
  and set the `LC_HEAD_IMG_LOGO` PHP constant to the path of the dark logo if dark theme is to be displayed.    
For example:
```php
/* Heading images */
use z4m_themechooser\mod\controller\Users;
if (Users::getUserTheme() === MOD_Z4M_THEMECHOOSER_CSS_DARK_THEME) {
    define('LC_HEAD_IMG_LOGO', ZNETDK_ROOT_URI . MOD_Z4M_THEMECHOOSER_LOGO_DARK_THEME);
} else {
    define('LC_HEAD_IMG_LOGO', ZNETDK_ROOT_URI . MOD_Z4M_THEMECHOOSER_LOGO_LIGHT_THEME);
}
```

## AVOIDING FLASH EFFECT
When **Auto** is selected in the Theme modal dialog and the color scheme is `dark` at OS or User Agent level,
a white background is displayed a few milliseconds before the dark theme be applied.
To avoid this flicker effect:
1. Imports the [`prevent_flash_effect.php`](mod/view/fragment/prevent_flash_effect.php) script at the end
of the `mobile_favicons.php` script specified via the [`CFG_MOBILE_FAVICON_CODE_FILENAME`](https://mobile.znetdk.fr/settings#z4m-settings-theming-favicon-code) constant.
For example:
```php
<?php require 'z4m_themechooser/mod/view/fragment/prevent_flash_effect.php'; ?>
```
2. Next, surrounds the light theme styles by the `:root:has(body[data-theme="light"])` selector.
For Example:
```css
:root:has(body[data-theme="light"]) {
    color-scheme: light;
    /* Other styles of the light theme... */
    body {
    --z4m-light-primary:#0b78d1;
    --z4m-light-primary-txt:#fff;
    --z4m-light-secondary:#FF9400;
    --z4m-light-secondary-txt:#000;
    --z4m-light:#FFF;
    /* And so on... */
    }
}
```
3. Finally, be sure the style `color-scheme: light;` is set among the styles of the light theme.

## TRANSLATIONS
This module is translated in **French**, **English** and **Spanish** languages.
To translate this module in another language or change the standard
translations:
1. Copy in the clipboard the PHP constants declared within the
[`locale_en.php`](mod/lang/locale_en.php) script of the module,
2. Paste them from the clipboard within the
[`locale.php`](/../../../znetdk4mobile/blob/master/applications/default/app/lang/locale.php) script of your application,
3. Finally, translate each text associated with these PHP constants into your own language.

## ISSUES
The `zdk_user_themes` SQL table is created automatically by the module
when the user's favorite theme is read or saved for the first time.
If the MySQL user declared through the
[`CFG_SQL_APPL_USR`](https://mobile.znetdk.fr/settings#z4m-settings-db-user)
PHP constant does not have `CREATE` privilege, the module can't create the
required SQL table.
In this case, you can create the `zdk_user_themes` SQL table by importing
in MySQL or phpMyAdmin the script
[`z4m_themechooser.sql`](mod/sql/z4m_themechooser.sql) provided by the module.

## CHANGE LOG
See [CHANGELOG.md](CHANGELOG.md) file.

## CONTRIBUTING
Your contribution to the **ZnetDK 4 Mobile** project is welcome. Please refer to the [CONTRIBUTING.md](https://github.com/pascal-martinez/znetdk4mobile/blob/master/CONTRIBUTING.md) file.
