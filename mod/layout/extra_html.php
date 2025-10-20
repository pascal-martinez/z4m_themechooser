<?php
/**
 * ZnetDK, Starter Web Application for rapid & easy development
 * See official website https://mobile.znetdk.fr
 * Copyright (C) 2024 Pascal MARTINEZ (contact@znetdk.fr)
 * License GNU GPL https://www.gnu.org/licenses/gpl-3.0.html GNU GPL
 * --------------------------------------------------------------------
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------
 * Theme chooser module extra HTML code
 *
 * File version: 1.1
 * Last update: 10/16/2025
 */
use z4m_themechooser\mod\UserTheme;
if (CFG_PAGE_LAYOUT === 'mobile') :
    $initialThemeName = 'auto';
    if (CFG_AUTHENT_REQUIRED === TRUE && UserSession::isAuthenticated(TRUE)) {
        try {
            $userTheme = new UserTheme();
            $initialThemeName = $userTheme->getName();
        } catch (\Exception $ex) {
            General::writeErrorLog('z4m_themechooser/extra_html', $ex->getMessage());
        }
    }
    // Setting the $color $variable
    require 'z4m_themechooser/mod/view/fragment/color_scheme.php'; ?>
        <div id="z4m-theme-chooser-extra-code" class="w3-hide" data-theme="<?php echo $initialThemeName; ?>" data-isdebug="<?php echo CFG_DEV_JS_ENABLED ? '1' : '0'; ?>"
             data-light='<?php echo UserTheme::getLightThemeJSONData(); ?>'
             data-dark='<?php echo UserTheme::getDarkThemeJSONData(); ?>'>
            <button type="button" class="choosetheme w3-button <?php echo $color['btn_action']; ?> <?php echo $color['btn_hover']; ?> w3-block w3-section w3-padding"><i class="fa fa-television fa-lg"></i> <?php echo MOD_Z4M_THEMECHOOSER_USER_PANEL_BUTTON_LABEL; ?></button>
        </div>
<?php endif;
