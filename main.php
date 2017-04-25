<?php
//страница меню  плагина рапорта
#TODO  надо правильно сверстать таблицу для субъекта, прикрутить кнопку для записи 
#через ajax  в базу каждую таблицу с  таблицы+ вывод только что добавленых и возможно надо будет 
#делать пагинацию но это не точно:) + надо сделать селект с таблиц в каждом разделе 
#может быть лучше или как то красивее сверстать менюшку плагина
function raportIndex(){
    
    //подключаем стили main.css
    wp_enqueue_style( 'mainStyle', '/wp-content/plugins/raport/src/css/main.css');
    
    
    //подключаем скрипт tabs.js
    wp_enqueue_script('tabsJs',   '/wp-content/plugins/raport/src/js/tabs.js');
    
    //подключаем скрипт main.js
    wp_enqueue_script('mainJs',  '/wp-content/plugins/raport/src/js/main.js');
    
    echo '
    <div class="container-raport">
        <div id="tabs" class="htabs">
              <a href="#tab-city">Название городов</a>
              <a href="#tab-instant">Название инстанций</a>
              <a href="#tab-fio">Имена субъектов</a>
        </div>
        
        <div class="downTabs">
            <div id="tab-city">
                <h3>Данные по регионам :</h3>
            <table class="list" style="width: 50%">
              <thead>
                <tr>
                  <td class="left">Название городов</td>
                  <td class="left">ЧПУ</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td class="left"><input type="text" name="nameCity" value="" /></td>
                    <td class="left"><input type="text" name="urlCity" value="" /></td>
                </tr>
              </tbody>
            </table>  
            </div>
            
            <div id="tab-instant">
                <h3>Данные по инстанциям :</h3>
                <table class="list" style="width: 50%">
              <thead>
                <tr>
                  <td class="left">Название инстанций</td>
                  <td class="left">ЧПУ</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td class="left"><input type="text" name="nameInstant" value="" /></td>
                    <td class="left"><input type="text" name="urlInstant" value="" /></td>
                </tr>
              </tbody>
            </table> 
            </div>
            
            <div id="tab-fio">
               <h3>Данные по субъектам :</h3>
               <table class="list" style="width: 50%">
              <thead>
                <tr>
                  <td class="left">ФИО суъекта</td>
                  <td class="left">ЧПУ</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td class="left"><input type="text" name="nameSubject" value="" /></td>
                    <td class="left"><input type="text" name="urlCity" value="" /></td>
                </tr>
              </tbody>
            </table> 
            </div>
        </div>
        
         
    </div>
    

   ';
}  
 

 