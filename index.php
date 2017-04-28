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

//регистрируем функцию для ajax хуков(удаление не нужных строк в таблице)
add_action('wp_ajax_delStr', 'delStr_callback');

//1 - это порядок выполнение функции (очередность если есть еще зацепки за хук), 2 - количество 
//параметров передаваемых функции
add_action('wp_getData', 'getData', 1,2);

//регистрируем хук по выводу ЧПУ и имен категорий
add_action('wp_selectTable', 'selectTable',1,3);

//регистрируем хук по выводу субъектов
add_action('wp_getSub','getSub',1);
 

//функция отвечает за добавление пункта меню Рапорт
function raportMenu() {
    add_menu_page('Меню Рапорта', 'Рапорт', 8, __FILE__, 'raportIndex',"dashicons-clipboard", "65.3");
}
 


function raportTable_callback() {
    global $wpdb;
    
        $urlCity = trim($_POST['urlCity']);
        $urlInstant = trim($_POST['urlInstant']);
        $subjectMas = $_POST['mas'];
        
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

//функция по удалению не нужных строк с базы
function delStr_callback(){
    global $wpdb;
    
    $btnCity = $_POST['getIdStr'];
    $btnInstant = $_POST['instant'];
    $btnSub = $_POST['sub']; 
    
    
    //удаляем строки в городах
     if(!empty($btnCity)){
         $dellCity = $wpdb->delete($wpdb->prefix . "raportTableCity",
                                                array( 'id' => $btnCity ));  
        echo $dellCity;
    }
    
    //удаляем строки в инстанциях
     if(!empty($btnInstant)){
         $dellInstant = $wpdb->delete($wpdb->prefix . "raportTableInstant",
                                                array( 'id' => $btnInstant ));  
        echo $dellInstant;
    }
    
    //удаляем строки в субъектах
     if(!empty($btnSub)){
         $dellSub = $wpdb->delete($wpdb->prefix . "raportTableSub",
                                                array( 'id' => $btnSub ));  
        echo $dellSub;
    }
    
    
   wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция

}