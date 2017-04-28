<?php
//страница меню  плагина рапорта
function raportIndex(){
     global $wpdb;
    
    //подключаем стили bootstrap.css
    wp_enqueue_style( 'mainBootstrap', '/wp-content/plugins/raport/src/css/bootstrap.css');
    
    //подключаем стили tableStyle.css
    wp_enqueue_style( 'mainTable', '/wp-content/plugins/raport/src/css/tableStyle.css');
    
    //подключаем стили main.css
    wp_enqueue_style( 'mainStyle', '/wp-content/plugins/raport/src/css/main.css');
    
    
    //подключаем скрипт tabs.js
    wp_enqueue_script('tabsJs',   '/wp-content/plugins/raport/src/js/tabs.js');
    
    //подключаем скрипт main.js
    wp_enqueue_script('mainJs',  '/wp-content/plugins/raport/src/js/main.js');
   
     //переменная с названием таблицы Базы данных
    $tableCity =  $wpdb->prefix . 'raportTableCity';
    
    
    //переменная с названием таблицы Базы данных
    $tableInstant =  $wpdb->prefix . 'raportTableInstant';
        
        
?>
  
 <div class="container">
        <div id="tabs" class="htabs">
              <a href="#tab-city" class="btn btn-primary">Название городов</a>
              <a href="#tab-instant" class="btn btn-primary">Название инстанций</a>
              <a href="#tab-fio" class="btn btn-primary">Имена субъектов</a>
        </div>
        
        <div class="downTabs">
            <div id="tab-city">
                <h3>Данные по регионам :</h3>
            <table class="simple-little-table raportTable" cellspacing="0">
                <thead>
                    <th>Название городов</th>
                    <th>ЧПУ</th>
                    <th>Выберите действие</th>
                </thead>
                <tbody>
               <tr>
                    <td></td>
                    <td class="left"><input type="text" class="urlCity" name="urlCity" value="" /></td>
                    <td><button type="button" class="btn btn-success buttonCity">Добавить</button></td>
                </tr>
           
                <?=do_action('wp_selectTable','wp_getData',$tableCity, 'btnCity');?>
                </tbody>
            </table>  
            

            </div>
            
            <div id="tab-instant">
                <h3>Данные по инстанциям :</h3>
               <table class="simple-little-table raportTable" cellspacing="0">
              <tr>
                  <th>Название инстанции</th>
                  <th>ЧПУ</th>
                  <th>Выберите действие</th>
              </tr>
               
                
                <tr>
                    <td></td>
                    <td class="left"><input type="text" class="urlInstant" name="urlInstant" value="" /></td>
                    <td><button type="button" class="btn btn-success buttonInstant">Добавить</button></td>
                </tr>
                
                <?=do_action('wp_selectTable','wp_getData',$tableInstant, 'btnInstant');?>
          
            </table> 
            </div>
            
            <div id="tab-fio">
               <h3>Данные по субъектам :</h3>
              <table class="simple-little-table raportTable" cellspacing="0">
              <tr>
                  <th>ФИО</th>
                  <th>Должность</th>
                  <th>Место работы</th>
                  <th>Пару слов о субъекте</th>
                  <th>Выберите действие</th>
              </tr>
               
                
                <tr>
                    <td><textarea rows="5" cols="25" class="subjectFio" name="fio"></textarea></td>
                    <td><textarea rows="5" cols="25" class="subjectDoljnost" name="doljnost"></textarea></td>
                    <td><textarea rows="5" cols="25" class="subjectWork" name="work"></textarea></td>
                    <td><textarea rows="5" cols="25" class="subjectInfo" name="info"></textarea></td>
                    <td><button type="button" class="btn btn-success buttonSubject">Добавить</button></td>
                </tr>
                
                <?= do_action("wp_getSub")?>
               
              </table> 
            </div>
        </div>
        
         
    </div>
    

<?php
}  

//универсальная функция по выводу имени и ЧПУ категории 
function selectTable($funcRaport,$table,$btn){
    
    global $wpdb;
    
    $selectData = $wpdb->get_results($wpdb->prepare("SELECT term_id  FROM $table "));
 
    foreach ($selectData as $dataId) {
             
            //с помощью JOIN получаем с таблиц данные имена рубрик и ЧПУ
            $selectNameUrl = $wpdb->get_results($wpdb->prepare("SELECT ".$table.".id, name, slug  FROM $wpdb->terms
                            INNER JOIN $table on ".$table.".term_id = wp_terms.term_id
                            WHERE wp_terms.term_id = $dataId->term_id"));
            
            if(!empty($selectNameUrl)){
               
                //передаем параметры в функции для генерации таблицы с данными
                 do_action($funcRaport,$selectNameUrl,$btn);
            
                 
            }elseif(empty($selectNameUrl)){
                
                //если массив пришел пустой то удаляем id с таблицы плагина (Категории)
                $wpdb->delete( $table, array( 'term_id' => $dataId->term_id ) );
             }
         
             
    }
}

//получаем параметры и с помощью JOIN  вытягиваем данные с базы для таблиц
function getData($selectData, $btn){
     
      for ($i = 0; $i<count($selectData); ++$i){
           ?>
               <tr id="<?=$selectData->id?>">
                    <td><?=$selectData->name?></td>
                    <td><?=$selectData->slug?></td>
                    <td><button type="button" class="btn btn-danger <?=$btn?>">Удалить</button></td>
                </tr>
          <?php
     }
      
     
}

//выводим список субъектов
function getSub(){
    global $wpdb;
    
    //таблица субъекта
    $table = $wpdb->prefix . 'raportTableSub';
    
    $selectSub = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table "));
 
     foreach ($selectSub as $sub) {
        
     ?>
              <tr id="<?=$sub->id?>">
                    <td><?=$sub->fio?></td>
                    <td><?=$sub->doljnost?></td>
                    <td><?=$sub->mestoWork?></td>
                    <td><?=$sub->description?></td>
                    <td><button type="button" class="btn btn-danger btnSub">Удалить</button></td>
                </tr>
          <?php
    }
}