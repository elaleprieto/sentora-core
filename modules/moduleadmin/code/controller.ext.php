<?php

/**
 * @copyright 2014-2015 Sentora Project (http://www.sentora.org/) 
 * Sentora is a GPL fork of the ZPanel Project whose original header follows:
 *
 * ZPanel - A Cross-Platform Open-Source Web Hosting Control panel.
 *
 * @package ZPanel
 * @version $Id$
 * @author Bobby Allen - ballen@bobbyallen.me
 * @copyright (c) 2008-2014 ZPanel Group - http://www.zpanelcp.com/
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License v3
 *
 * This program (ZPanel) is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
class module_controller extends ctrl_module
{

    static $error;
    static $ok;
    static $error_message;
    static $Modules;
    static $Groups;

    static function getResult()
    {
        if (!fs_director::CheckForEmptyValue(self::$error_message))
            return ui_sysmessage::shout(ui_language::translate(self::$error_message), 'zannounceerror', 'zannounce');
        if (!fs_director::CheckForEmptyValue(self::$ok)) {
            return ui_sysmessage::shout(ui_language::translate("Changes to your module options have been saved successfully!"));
        } else {
            return ui_language::translate(ui_module::GetModuleDescription());
        }
        return;
    }
    
    
    
    static function getModules()
    {
        if(!isset($Modules))
        {
            ModulesFromDb();
        }
        
        if(count($Modules) > 0){
            return $Moduels;
        }
        return false;
    }
    
    static function getGroups()
    {
        if(!isset($Groups))
        {
            GroupsFromDb();
        }
        
        if(count($Groups) > 0){
            return $Groups;
        }
        return false;
    }
    
    static function ShowModuleInfo()
    {
        global $controller;
        
    } 
    
    
    //DB calls
    
    //Calls that don't contain parameters
    static function ModulesFromDb()
    {
        global $zdbh;
        $modules = $zdbh->prepare("Select * FROM x_modules");
        $modules->execute();
        $Modules = $modules->fetchAll();            
    }
    
    static function GroupsFromDb()
    {
        $groups = $zdbh->prepare("SELECT ug_name_vc FROM x_groups ORDER BY ug_name_vc ASC");
        $groups->execute();  
        $Groups = $groups->fetchAll();
    }
}
