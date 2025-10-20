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
 * Parameters of the Theme chooser module
 *
 * File version: 1.2
 * Last update: 10/20/2025 
 */

/**
 * URL of the Dark theme stylesheet
 * @return string URL (NULL by default)
 */
define('MOD_Z4M_THEMECHOOSER_CSS_DARK_THEME', NULL);

/**
 * URL of the App's Dark logo
 * @return string URL (NULL by default)
 */
define('MOD_Z4M_THEMECHOOSER_LOGO_DARK_THEME', NULL);

/**
 * URL of the App's Light logo
 * @return string URL (NULL by default)
 */
define('MOD_Z4M_THEMECHOOSER_LOGO_LIGHT_THEME', NULL);

/**
 * Color scheme of the Theme chooser UI.
 * @var array|NULL Colors used to display the Theme chooser UI. The expected
 * array keys are 'modal_header', 'modal_content' ,'modal_footer',
 * 'modal_footer_border_top', 'btn_action', 'btn_hover' and 'btn_cancel'.
 * If NULL, default color CSS classes are applied.
 */
define('MOD_Z4M_THEMECHOOSER_COLOR_SCHEME', NULL);

/**
 * Path of the SQL script to update the database schema
 * @string Path of the SQL script
 */
define('MOD_Z4M_THEMECHOOSER_SQL_SCRIPT_PATH', ZNETDK_MOD_ROOT 
        . DIRECTORY_SEPARATOR . 'z4m_themechooser' . DIRECTORY_SEPARATOR
        . 'mod' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR
        . 'z4m_themechooser.sql');

// VERSIONS
define('MOD_Z4M_THEMECHOOSER_VERSION_NUMBER','1.2');
define('MOD_Z4M_THEMECHOOSER_VERSION_DATE','2025-10-20');