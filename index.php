<?php
/*
Plugin Name: Raport
Plugin URI:  https://isyms.ru
Description: Module from raport
Author:      Artur Legusha
Author URI:  https://isyms.ru
*/

require_once  dirname(__FILE__) . '/main.php';
require_once  dirname(__FILE__) . '/activation.php';

 #TODO надо создать будет хук по удалению модуля, что бы удалял все файлы модуля и удалял таблицы в базе
 

register_activation_hook( __FILE__, 'raportActiv' );

//добавляем пункт меню с помощью хука
add_action('admin_menu', "raportMenu");

//функция отвечает за добавление пункта меню Рапорт
function raportMenu() {
    add_menu_page('Меню Рапорта', 'Рапорт', 8, __FILE__, 'raportIndex',"dashicons-clipboard", "65.3");
}
