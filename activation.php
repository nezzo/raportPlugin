<?php

//функция которая срабатывает при активации  плагина
function raportActiv(){
    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
    
    // мультисайт, оригинальный префикс
    $table_city = $wpdb->base_prefix . 'raportTableCity';
   
    //cоздаем и проверяем таблицу города
    $city = "CREATE TABLE $table_city (
			id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        term_id int(11) NOT NULL,
                        UNIQUE(term_id)
 	);";
	 dbDelta( $city );
        
        
        $table_instant = $wpdb->base_prefix . 'raportTableInstant';
        
        //cоздаем и проверяем таблицу инстанции
         $instant = "CREATE TABLE $table_instant (
			id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        term_id int(11) NOT NULL,
                        UNIQUE(term_id)
	);";
	 dbDelta($instant);
        
        $table_sub = $wpdb->base_prefix . 'raportTableSub';
        
        //cоздаем и проверяем таблицу субъекты
         $sub = "CREATE TABLE $table_sub (
			id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			name varchar(25) NOT NULL,
                        doljnost varchar(50) NOT NULL,
                        mestoWork varchar(50) NOT NULL,
                        description varchar(100) NOT NULL,
                        UNIQUE(name)
	);";
	 dbDelta($sub);
    
        
}