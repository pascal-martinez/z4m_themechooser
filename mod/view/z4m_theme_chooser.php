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
 * Theme chooser view
 *
 * File version: 1.1
 * Last update: 10/13/2025
 */

$isDarkThemeConfigured = z4m_themechooser\mod\UserTheme::isDarkThemeConfigured();
// Setting the $color $variable
require 'fragment/color_scheme.php';
?>
<style>
    html.z4m-theme-chooser-transition,
    html.z4m-theme-chooser-transition *,
    html.z4m-theme-chooser-transition *:before,
    html.z4m-theme-chooser-transition *:after {
      transition: background-color 700ms !important;
      transition-delay: 0s !important;
    }
</style>
<div id="z4m-theme-chooser" class="w3-modal">
    <div class="w3-modal-content w3-card-4 <?php echo $color['modal_content']; ?>">
        <header class="w3-container <?php echo $color['modal_header']; ?>">
            <a class="close w3-button w3-xlarge <?php echo $color['btn_hover']; ?> w3-display-topright" href="javascript:void(0)" aria-label="<?php echo LC_BTN_CLOSE; ?>"><i class="fa fa-times-circle fa-lg" aria-hidden="true" title="<?php echo LC_BTN_CLOSE; ?>"></i></a>
            <h4>
                <i class="fa fa-television fa-lg"></i>
                <span class="title"><?php echo MOD_Z4M_THEMECHOOSER_USER_PANEL_BUTTON_LABEL; ?></span>
            </h4>
        </header>
        <div class="w3-container w3-section">
            <form></form>
            <div class="w3-center">
<?php if ($isDarkThemeConfigured) : ?>
                <button class="select-theme w3-btn w3-border w3-light-gray w3-hover-opacity" data-theme="auto">
                    <div class="fa fa-adjust fa-fw" style="font-size: 120px"></div>
                    <div class="w3-margin-top w3-xlarge"><i class="fa fa-check w3-text-green"></i> <b><?php echo MOD_Z4M_THEMECHOOSER_MODAL_AUTO_THEME_LABEL; ?></b></div>
                </button>
<?php endif; ?>
                <button class="select-theme w3-btn w3-border w3-hover-opacity" data-theme="light">
                    <div class="fa fa-sun-o fa-fw" style="font-size: 120px"></div>
                    <div class="w3-margin-top w3-xlarge"><i class="fa fa-check w3-text-green"></i> <b><?php echo MOD_Z4M_THEMECHOOSER_MODAL_LIGHT_THEME_LABEL; ?></b></div>
                </button>
<?php if ($isDarkThemeConfigured) : ?>
                <button class="select-theme w3-btn w3-border w3-black w3-hover-opacity" data-theme="dark">
                    <div class="fa fa-moon-o fa-fw" style="font-size: 120px"></div>
                    <div class="w3-margin-top w3-xlarge"><i class="fa fa-check w3-text-green"></i> <b><?php echo MOD_Z4M_THEMECHOOSER_MODAL_DARK_THEME_LABEL; ?></b></div>
                </button>
<?php endif; ?>
            </div>
        </div>
        <div class="w3-container w3-padding-16 w3-border-top <?php echo $color['modal_footer_border_top']; ?> <?php echo $color['modal_footer']; ?>">
            <button type="button" class="cancel w3-button <?php echo $color['btn_cancel']; ?>">
                <i class="fa fa-close fa-lg"></i>&nbsp;<?php echo LC_BTN_CLOSE; ?>
            </button>
        </div>
    </div>
</div>