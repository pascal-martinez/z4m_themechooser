<?php

/*
 * ZnetDK, Starter Web Application for rapid & easy development
 * See official website https://www.znetdk.fr
 * Copyright (C) 2025 Pascal MARTINEZ (contact@znetdk.fr)
 * License GNU GPL http://www.gnu.org/licenses/gpl-3.0.html GNU GPL
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
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------
 * ZnetDK 4 Mobile Theme Chooser module class
 *
 * File version: 1.0
 * Last update: 10/15/2025
 */

namespace z4m_themechooser\mod;

/**
 * User Theme management
 */
class UserTheme {
    protected $userId;
    /**
     * New user theme
     * @param int $userId User identifier. If NULL, the current logged in user
     * identifier is used 
     * @throws \Exception Specified user ID is invalid.
     */
    public function __construct($userId = NULL) {
        if (is_null($userId)) {
            $userId = \UserSession::getUserId();
        } 
        if (is_null($userId) || !is_numeric($userId) || $userId < 1) {
            throw new \Exception('User ID is invalid.');
        }
        $this->userId = $userId;
    }
    
    public function store($themeName) {
        if ($themeName !== 'light' && $themeName !== 'dark' && $themeName !== 'auto') {
            throw new \Exception('Theme name is invalid.');
        }
        $dao = new \SimpleDAO('zdk_user_themes');
        $this->checkSQLTable($dao);
        $row = ['user_id' => $this->userId, 'theme_name' => $themeName];
        $rows = $dao->getRowsForCondition('user_id = ?', $this->userId);
        if (count($rows) > 0 && key_exists('id', $rows[0])) {
            $row['id'] = $rows[0]['id'];
        }
        return $dao->store($row);
    }

    public function remove($autocommit = TRUE) {
        $dao = new \SimpleDAO('zdk_user_themes');
        if (!$dao->doesTableExist()) {
            return;
        }
        $rows = $dao->getRowsForCondition('user_id = ?', $this->userId);
        if (count($rows) > 0) {
            $dao->remove(NULL, $autocommit);
        }
    }

    public function getName() {
        $dao = new \SimpleDAO('zdk_user_themes');
        $this->checkSQLTable($dao);
        $rows = $dao->getRowsForCondition('user_id = ?', $this->userId);
        return count($rows) === 0 ? 'auto' : $rows[0]['theme_name'];
    }
    
    static public function isDarkThemeConfigured() {
        return defined('MOD_Z4M_THEMECHOOSER_CSS_DARK_THEME') && MOD_Z4M_THEMECHOOSER_CSS_DARK_THEME !== NULL;
    }
    
    static public function getDarkThemeJSONData() {
        $data = [
            'css' => MOD_Z4M_THEMECHOOSER_CSS_DARK_THEME,
            'fileversion' => filemtime(ZNETDK_ROOT . MOD_Z4M_THEMECHOOSER_CSS_DARK_THEME)
        ];
        if (defined('MOD_Z4M_THEMECHOOSER_LOGO_DARK_THEME') && MOD_Z4M_THEMECHOOSER_LOGO_DARK_THEME !== NULL) {
            $data['icon'] = MOD_Z4M_THEMECHOOSER_LOGO_DARK_THEME;
        }
        return json_encode($data);
    }
    
    static public function getLightThemeJSONData() {
        $data = [
            'css' => CFG_MOBILE_W3CSS_THEME,
            'fileversion' => filemtime(ZNETDK_ROOT . CFG_MOBILE_W3CSS_THEME)
        ];
        if (defined('MOD_Z4M_THEMECHOOSER_LOGO_LIGHT_THEME') && MOD_Z4M_THEMECHOOSER_LOGO_LIGHT_THEME !== NULL) {
            $data['icon'] = MOD_Z4M_THEMECHOOSER_LOGO_LIGHT_THEME;
        }
        return json_encode($data);
    }

    protected function checkSQLTable($dao) {
        if (!$dao->doesTableExist() && !$this->createModuleSqlTable()) {
            throw new \Exception('SQL Table is missing and its creation failed.');
        }
    }
    protected function createModuleSqlTable() {
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
