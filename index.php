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
 

//хук срабатывает при активации плагина (создает 3 таблицы в базе)
register_activation_hook( __FILE__, 'raportActiv' );

//добавляем пункт меню с помощью хука
add_action('admin_menu', "raportMenu");

//регистрируем функцию для ajax хуков(получаем данные с  таблицы и работаем с базой)
add_action('wp_ajax_raportTable', 'raportTable_callback');

//функция отвечает за добавление пункта меню Рапорт
function raportMenu() {
    add_menu_page('Меню Рапорта', 'Рапорт', 8, __FILE__, 'raportIndex',"dashicons-clipboard", "65.3");
}
 


function raportTable_callback() {
    global $wpdb;
    
        $urlCity = trim($_POST['urlCity']);
        $urlInstant = trim($_POST['urlInstant']);
        $subjectMas = $_POST['mas'];
        
        
         #TODO  надо еще сделать функцию которая будет выводить данные для каждой таблицы (Города, Инстанции,
        #Субъекты)  
        

        if(!empty($urlCity)){
             
            //получаем id  рубрики
            $getCityId = $wpdb->get_results($wpdb->prepare("SELECT term_id  FROM $wpdb->terms
                    WHERE slug = '$urlCity'"));
            
 
            foreach ($getCityId as $city) {
                    
                    //заносим в таблицу данные (id  категории)
                    $insertCity = $wpdb->insert(
                                    $wpdb->prefix . "raportTableCity",
                                    array( 'term_id' => $city->term_id),
                                    array( '%d' )
                                 );
                    

                    echo $insertCity;
            }
           
        } 
        
        if(!empty($urlInstant)){
            
            //получаем id  рубрики
           $getInstantId = $wpdb->get_results($wpdb->prepare("SELECT term_id  FROM $wpdb->terms
                    WHERE slug = '$urlInstant'"));
            
            
           foreach ($getInstantId as $instant) {
                    
                    //заносим в таблицу данные (id  категории)
                    $insertInstant = $wpdb->insert(
                                    $wpdb->prefix . "raportTableInstant",
                                    array( 'term_id' => $instant->term_id),
                                    array( '%d' )
                                 );
                    

                    echo $insertInstant;
            }
            
        } 
        
        if($subjectMas[0] != " "){
            
             //заносим в таблицу данные (субъект)
                    $insertSubject = $wpdb->insert(
                                    $wpdb->prefix . "raportTableSub",
                                    array( 'fio' => $subjectMas[0],
                                           'doljnost' => $subjectMas[1],
                                           'mestoWork' => $subjectMas[2],
                                           'description' => $subjectMas[3],
                                          )
                                  );
                    

                    echo  $insertSubject;
                    
                     
         }
        
 
	wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
}