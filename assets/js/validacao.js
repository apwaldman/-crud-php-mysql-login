
	
$( "#formularioValidation" ).validate({
   debug: true,
   rules: {
     
	 nome:{
            minlength: 3,
            maxlength: 20,
            // ou
            rangelength: [3, 20] 
         },
	 
	 
	 replyto: {
       required: true,
           email: true,
          // remote: 'check-email.php' //Deve utilizar um arquivo 
          (por exemplo: check-email.php) para verificar algo, e 
          assim retornar um boolean true ou false para satisfazer esta opção;
     },
       
	assunto:{
            min: 5,
            max: 25,
            // ou
            range: [5, 25] //Realiza a mesma coisa dos anteriores
         }      
   },
   messages:{
         //exemplo
      nome: {
			accept: "Nome deve ter entre 3 e 20 caracteres"
      }
	  assunto: {
			accept: "Assunto deve ter entre 5 e 25 caracteres"
      }
   }
 });