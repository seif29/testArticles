<?php

/*
 * phpMyAdmin configuration storage settings.
 */
$i++;
$sessionValidity = 3600 * 24 * 7; // one week : 604800
/* Global docker */
$cfg['Servers'][$i]['pmadb']         = 'phpmyadmin';
$cfg['Servers'][$i]['host']          = '0.0.0.0';
$cfg['Servers'][$i]['hostname']      = 'mysql';
$cfg['Servers'][$i]['port']          = '3306';
$cfg['Servers'][$i]['connect_type']  = 'tcp';
$cfg['Servers'][$i]['extension']     = 'mysqli';
$cfg['Servers'][$i]['compress']      = FALSE;
$cfg['Servers'][$i]['auth_type']     = 'cookie';
$cfg['LoginCookieValidity']          = $sessionValidity;
ini_set('session.gc_maxlifetime', $sessionValidity);

    /* User used to manipulate with storage */
$cfg['Servers'][$i]['controlhost']      = 'localhost';
// $cfg['Servers'][$i]['controlport']   = '';
$cfg['Servers'][$i]['controluser']      = 'pma';
$cfg['Servers'][$i]['controlpass']      = 'pmapass';

/* Storage database and tables */
$cfg['Servers'][$i]['pmadb']                = 'phpmyadmin';
$cfg['Servers'][$i]['bookmarktable']        = 'pma__bookmark';
$cfg['Servers'][$i]['relation']             = 'pma__relation';
$cfg['Servers'][$i]['table_info']           = 'pma__table_info';
$cfg['Servers'][$i]['table_coords']         = 'pma__table_coords';
$cfg['Servers'][$i]['pdf_pages']            = 'pma__pdf_pages';
$cfg['Servers'][$i]['column_info']          = 'pma__column_info';
$cfg['Servers'][$i]['history']              = 'pma__history';
$cfg['Servers'][$i]['table_uiprefs']        = 'pma__table_uiprefs';
$cfg['Servers'][$i]['tracking']             = 'pma__tracking';
$cfg['Servers'][$i]['designer_coords']      = 'pma__designer_coords';
$cfg['Servers'][$i]['userconfig']           = 'pma__userconfig';
$cfg['Servers'][$i]['recent']               = 'pma__recent';
$cfg['Servers'][$i]['favorite']             = 'pma__favorite';
$cfg['Servers'][$i]['users']                = 'pma__users';
$cfg['Servers'][$i]['usergroups']           = 'pma__usergroups';
$cfg['Servers'][$i]['navigationhiding']     = 'pma__navigationhiding';
$cfg['Servers'][$i]['savedsearches']        = 'pma__savedsearches';
$cfg['Servers'][$i]['central_columns']      = 'pma__central_columns';
$cfg['Servers'][$i]['designer_settings']    = 'pma__designer_settings';
$cfg['Servers'][$i]['export_templates']     = 'pma__export_templates';