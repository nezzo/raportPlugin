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

//хук по добавлению  новой строки под записью (Инфа для админа с рапорта)
add_action('add_meta_boxes', 'raport_meta_box');

// хук по сохранению доп поля (Рапорт)
add_action('save_post', 'save_raport_meta_fields'); 
 
//массив для глобального пользования (доп поле в Записи/рапорт)
$meta_fields = array(  
    
        array(  
            'label' => 'Информация для администратора',  
           // 'desc'  => 'Описание для поля.',  
            'id'    => 'raportTextarea',  // даем идентификатор.
            'type'  => 'textarea'  // Указываем тип поля.
        )
    );

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
                                    array( 'name' => $subjectMas[0],
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

// Добавляем дополнительное поле в Записи (если при этом приходят данные  с рапортом инфа для админа)
function raport_meta_box() {  
    add_meta_box(  
        'raport_meta_box', // Идентификатор(id)
        'Рапорт', // Заголовок области с мета-полями(title)
        'show_raport_metabox', // Вызов(callback)
        'post', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal', 
        'high');
}  

function show_raport_metabox(){
    global $meta_fields; // Обозначим наш массив с полями глобальным
    global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
    
                    
    // Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
 
    // Начинаем выводить таблицу с полями через цикл
    echo '<table class="form-table">';  
    foreach ($meta_fields as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr> 
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                <td>';  
                switch($field['type']) {  
                   // Зона Текста 
                    case 'textarea':  
                        echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea> 
                            <br /><span class="description">'.$field['desc'].'</span>';  
                    break;
                }
        echo '</td></tr>';  
    }  
    echo '</table>'; 
}

// Пишем функцию для сохранения  дополнительного поля
function save_raport_meta_fields($post_id) {  
    global $meta_fields;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
 
    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
