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
 * File version: 1.0
 * Last update: 10/25/2024
 */
namespace z4m_themechooser\mod\controller;

class Users extends \AppController {

    static public function getUserTheme() {
        $theme = CFG_MOBILE_W3CSS_THEME;
        $userId = \UserSession::getUserId();
        try {
            $dao = new \SimpleDAO('zdk_user_themes');
            if (!$dao->doesTableExist() && !Z4mThemeChooserCtrl::createModuleSqlTable()) {
                throw new \Exception('SQL Table is missing and its creation failed.');
            }            
            $rows = $dao->getRowsForCondition('user_id = ?', $userId);
            if (count($rows) > 0 && $rows[0]['theme_name'] === 'dark') {                
                $theme = MOD_Z4M_THEMECHOOSER_CSS_DARK_THEME;
            }
        } catch (\Exception $ex) {
            \General::writeErrorLog(__METHOD__, $ex->getMessage());
        }
        return $theme;
    }
    
    static public function onRemove($userId) {
        $dao = new \SimpleDAO('zdk_user_themes');
        if (!$dao->doesTableExist()) {
            return;
        }
        $rows = $dao->getRowsForCondition('user_id = ?', $userId);
        if (count($rows) > 0) {
            $dao->remove(NULL, FALSE);
        }
    }
}