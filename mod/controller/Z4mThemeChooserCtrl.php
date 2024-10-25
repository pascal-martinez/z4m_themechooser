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
 * Last update: 02/17/2024
 */

namespace z4m_themechooser\mod\controller;

/**
 * Description of Z4mThemeChooserCtrl
 */
class Z4mThemeChooserCtrl extends \AppController {

    static protected function action_store() {
        $request = new \Request();
        $response = new \Response();
        $userId = \UserSession::getUserId();
        if (is_null($userId) || $request->new_theme === NULL 
                || ($request->new_theme !== 'light' && $request->new_theme !== 'dark')) {
            $response->setFailedMessage(NULL, MOD_Z4M_THEMECHOOSER_ACTION_STORE_ERROR);
            return $response;
        }
        $row = ['user_id' => $userId, 'theme_name' => $request->new_theme];
        try {            
            $dao = new \SimpleDAO('zdk_user_themes');
            if (!$dao->doesTableExist() && !self::createModuleSqlTable()) {
                throw new \Exception('SQL Table is missing and its creation failed.');
            }
            $rows = $dao->getRowsForCondition('user_id = ?', $userId);
            if (count($rows) > 0 && key_exists('id', $rows[0])) {
                $row['id'] = $rows[0]['id'];
            }
            $dao->store($row);
            $response->setSuccessMessage(NULL, MOD_Z4M_THEMECHOOSER_ACTION_STORE_OK);
        } catch (\Exception $ex) {
            \General::writeErrorLog(__METHOD__, $ex->getMessage());
            $response->setFailedMessage(NULL, MOD_Z4M_THEMECHOOSER_ACTION_STORE_ERROR);
        }
        return $response;
    }
    
    static public function createModuleSqlTable() {
        if (!file_exists(MOD_Z4M_THEMECHOOSER_SQL_SCRIPT_PATH)) {
            \General::writeErrorLog(__METHOD__, "SQL script '" 
                    . MOD_Z4M_THEMECHOOSER_SQL_SCRIPT_PATH 
                    ."' is missing.");
            return FALSE;
        }
        $sqlScript = file_get_contents(MOD_Z4M_THEMECHOOSER_SQL_SCRIPT_PATH);
        try {
            $db = \Database::getApplDbConnection();
            $db->exec($sqlScript);
            return TRUE;
        } catch (\Exception $ex) {
            \General::writeErrorLog(__METHOD__, $ex->getMessage());
        }
        return FALSE;
    }

}
