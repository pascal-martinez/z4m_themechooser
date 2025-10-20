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
 * Theme chooser module application controller
 *
 * File version: 1.1
 * Last update: 10/13/2025
 */

namespace z4m_themechooser\mod\controller;

use z4m_themechooser\mod\UserTheme;
/**
 * Description of Z4mThemeChooserCtrl
 */
class Z4mThemeChooserCtrl extends \AppController {
    static protected function action_store() {
        $request = new \Request();
        $response = new \Response();
        try {
            $userTheme = new UserTheme();
            $userTheme->store($request->new_theme);            
            $response->setSuccessMessage(NULL, MOD_Z4M_THEMECHOOSER_ACTION_STORE_OK);
        } catch (\Exception $ex) {
            \General::writeErrorLog(__METHOD__, $ex->getMessage());
            $response->setFailedMessage(NULL, MOD_Z4M_THEMECHOOSER_ACTION_STORE_ERROR);
        }
        return $response;
    }
}
