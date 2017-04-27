<?php
//страница меню  плагина рапорта
#через ajax  в базу каждую таблицу с  таблицы+ вывод только что добавленых и возможно надо будет 
#делать пагинацию но это не точно:) + надо сделать селект с таблиц в каждом разделе 
function raportIndex(){
    
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
    
    echo '
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
              <tr>
                  <th>Название городов</th>
                  <th>ЧПУ</th>
                  <th>Выберите действие</th>
              </tr>
               
                
                <tr>
                    <td></td>
                    <td class="left"><input type="text" class="urlCity" name="urlCity" value="" /></td>
                    <td><button type="button" class="btn btn-success buttonCity">Добавить</button></td>
                </tr>
                <tr>
                    <td>asdasd</td>
                    <td>asdasd</td>
                    <td><button type="button" class="btn btn-danger">Удалить</button></td>
                </tr>
                <tr>
                    <td>asdasas</td>
                    <td>asdasdas</td>
                    <td><button type="button" class="btn btn-danger">Удалить</button></td>
                </tr>
               
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
                <tr>
                    <td>asdasd</td>
                    <td>asdasd</td>
                    <td><button type="button" class="btn btn-danger">Удалить</button></td>
                </tr>
                <tr>
                    <td>asdasas</td>
                    <td>asdasdas</td>
                    <td><button type="button" class="btn btn-danger">Удалить</button></td>
                </tr>
               
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
                <tr>
                    <td>asdasd</td>
                    <td>asdasd</td>
                    <td>asdasd</td>
                    <td>asdasd</td>
                    <td><button type="button" class="btn btn-danger">Удалить</button></td>
                </tr>
                <tr>
                    <td>asdasas</td>
                    <td>asdasdas</td>
                    <td>asdasd</td>
                    <td>asdasd</td>
                    <td><button type="button" class="btn btn-danger">Удалить</button></td>
                </tr>
               
            </table> 
            </div>
        </div>
        
         
    </div>
    

   ';
}  
 

 