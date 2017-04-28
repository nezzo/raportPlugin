jQuery(document).ready(function(){
   jQuery('#tabs a').tabs();
   
   //Добавляем города (по ЧПУ ищем в базе города и заносим после в таблицу ЧПУ и id города)
   jQuery('.buttonCity').click(function(){
    var urlCity = jQuery(".urlCity").val();
    
        //проверяем если не пустая переменная то  выполняем условие
        if(!!urlCity){
            var urlData = {
			action: 'raportTable',
			urlCity: urlCity
		};

		// с версии 2.8 'ajaxurl' всегда определен в админке
		jQuery.post( ajaxurl, urlData, function(response) {
                    if(!!response){
                       alert("Город добавлен!"); 
                       
                        /*после занесение в базу данных очищаем поля
                       jQuery(".urlCity").val(" ");
                       */
                      
                       //перезагружаем страницу
                       location.reload();
                    }else{
                        alert("Ошибка!");
                    }
			
		});
            }
    });
    
    //Добавляем инстанции (по ЧПУ ищем в базе инстанции и заносим после в таблицу ЧПУ и id инстанции)
   jQuery('.buttonInstant').click(function(){
    var urlInstant = jQuery(".urlInstant").val();
    
        //проверяем если не пустая переменная то  выполняем условие
        if(!!urlInstant){
            var urlData = {
			action: 'raportTable',
			urlInstant: urlInstant
		};

		// с версии 2.8 'ajaxurl' всегда определен в админке
		jQuery.post( ajaxurl, urlData, function(response) {
                          
                         if(!!response){
                            alert("Инстанция добавлена!"); 
                    
                            /*после занесение в базу данных очищаем поля
                            jQuery(".urlInstant").val(" ");
                            */
                           
                            //перезагружаем страницу
                            location.reload();

                         }else{
                             alert("Ошибка!");
                         }
                        
		});
            }
    });
    
     //Добавляем субъект
   jQuery('.buttonSubject').click(function(){
    var subjectFio = jQuery(".subjectFio").val();
    var subjectDoljnost = jQuery(".subjectDoljnost").val();
    var subjectWork = jQuery(".subjectWork").val();
    var subjectInfo = jQuery(".subjectInfo").val();
    var mas = [subjectFio,subjectDoljnost,subjectWork,subjectInfo];
    
     
        //проверяем если не пустая переменная то  выполняем условие
        if(!!subjectFio){
            var urlData = {
			action: 'raportTable',
			mas: mas
		};

		// с версии 2.8 'ajaxurl' всегда определен в админке
		jQuery.post( ajaxurl, urlData, function(response) {
                    if(!!response){
                            alert("Субъект добавлен!"); 
                    
                            /*после занесение в базу данных очищаем поля
                            jQuery(".subjectFio").val(" ");
                            jQuery(".subjectDoljnost").val(" ");
                            jQuery(".subjectWork").val(" ");
                            jQuery(".subjectInfo").val(" ");
                            */
                           
                            //перезагружаем страницу
                            location.reload();

                         }else{
                             alert("Ошибка!");
                         }
 		});
            }
    });
    
    
    //функция по удалению строк в таблице Города
    jQuery('.btnCity').click(function(){
        
     //получаем в текущей  строке значение тега td (ЧПУ) по которой кликнули и удаляем с базы    
     //var city = jQuery(this).closest('tr').find('td:nth-child(2)').text();
     
     //получаем id  строки для удаления по id  в базе плагина
     var getIdStr = jQuery(this).closest('tr').attr('id');
      //проверяем если не пустая переменная то  выполняем условие
        if(!!getIdStr){
            var btnData = {
			action: 'delStr',
			getIdStr: getIdStr
		};

		// с версии 2.8 'ajaxurl' всегда определен в админке
		jQuery.post( ajaxurl, btnData, function(response) {
                    if(!!response){
                            
                           //alert(response);

                         }else{
                             alert("Ошибка!");
                         }
 		});
            }
            
            //удаляем нужную нам строку 
            jQuery(this).closest('tr').remove();
    
      
    });
    
    
   //функция по удалению строк в таблице Инстанции
    jQuery('.btnInstant').click(function(){
        
     //получаем в текущей  строке значение тега td (ЧПУ) по которой кликнули и удаляем с базы    
     //var city = jQuery(this).closest('tr').find('td:nth-child(2)').text();
     
     //получаем id  строки для удаления по id  в базе плагина
     var instant = jQuery(this).closest('tr').attr('id');
      //проверяем если не пустая переменная то  выполняем условие
        if(!!instant){
            var btnData = {
			action: 'delStr',
			instant: instant
		};

		// с версии 2.8 'ajaxurl' всегда определен в админке
		jQuery.post( ajaxurl, btnData, function(response) {
                    if(!!response){
                            
                           //alert(response);

                         }else{
                             alert("Ошибка!");
                         }
 		});
            }
            
            //удаляем нужную нам строку 
            jQuery(this).closest('tr').remove();
    
      
    });
    
    //функция по удалению строк в таблице Субъекты
    jQuery('.btnSub').click(function(){
        
     //получаем в текущей  строке значение тега td (ЧПУ) по которой кликнули и удаляем с базы    
     //var city = jQuery(this).closest('tr').find('td:nth-child(2)').text();
     
     //получаем id  строки для удаления по id  в базе плагина
     var sub = jQuery(this).closest('tr').attr('id');
      //проверяем если не пустая переменная то  выполняем условие
        if(!!sub){
            var btnData = {
			action: 'delStr',
			sub: sub
		};

		// с версии 2.8 'ajaxurl' всегда определен в админке
		jQuery.post( ajaxurl, btnData, function(response) {
                    if(!!response){
                            
                           //alert(response);

                         }else{
                             alert("Ошибка!");
                         }
 		});
            }
            
            //удаляем нужную нам строку 
            jQuery(this).closest('tr').remove();
    
      
    });
   
   
    
   
});
