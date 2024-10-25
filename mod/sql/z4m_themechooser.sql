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
 * Theme chooser module SQL script
 * 
 * File version: 1.0
 * Last update: 10/22/2024
 */

CREATE TABLE IF NOT EXISTS `zdk_user_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Internal row ID',
  `user_id` int(11) NOT NULL COMMENT 'User ID',
  `theme_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Theme name',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci  COMMENT='User''s theme' AUTO_INCREMENT=1;


ALTER TABLE `zdk_user_themes`
  ADD CONSTRAINT `zdk_user_themes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `zdk_users` (`user_id`);

