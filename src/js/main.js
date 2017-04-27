// #TODO надо создать 3 события по клику, и все слать на одну функцию где сделать 
// !empty  если есть какие то данные то работаем с ними (постом ловим данные и по условию срабатываем)

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
                       
                        //после занесение в базу данных очищаем поля
                       jQuery(".urlCity").val(" ");
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
                    
                            //после занесение в базу данных очищаем поля
                            jQuery(".urlInstant").val(" ");

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
                    
                            //после занесение в базу данных очищаем поля
                            jQuery(".subjectFio").val(" ");
                            jQuery(".subjectDoljnost").val(" ");
                            jQuery(".subjectWork").val(" ");
                            jQuery(".subjectInfo").val(" ");
                            
                            

                         }else{
                             alert("Ошибка!");
                         }
 		});
            }
    });
    
    
   
   
   
    
   
});