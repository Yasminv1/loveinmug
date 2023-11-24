
var url = "";
        	var validCep = false;
        	var validEmail = false;
        	var validTelefone = false;

			function validarFormulario(){
				return( validCep &&  validEmail &&  validTelefone );
			}

        	
			$(document).ready(function(){

				
				$("#frmCadUser").submit(function( event ){
					event.preventDefault();
					alert("Depois me preocupo em submeter o form pro php!");
					if (validarFormulario()){
					} else{
						alert("Arrume os dados!");
					}
				});

				$("input").keypress(function( event ){
					if ( event.keyCode === 13 ){
						event.preventDefault();
						$(this).blur();
					}
				});
				
				$("#cep").blur(function( event ){
					let cepStr = $(event.target).val().trim(); 
					// if ( cepStr.trim().length==8 ){
					if ( cepStr.trim().replace("-","").match(/^[\d]{8}$/g) ){
    					let url = "https://viacep.com.br/ws/"+ cepStr +"/json/";
    					$.get( url , function(data, status){
    					  	//  alert("Data: " + JSON.stringify( data ) + "\nStatus: " + status);
    							$("#endereco").val(data.logradouro);
    							$("#complemento").val(data.complemento);
    							$("#bairro").val(data.bairro);
    							$("#cidade").val(data.localidade);
    							$("#uf").val(data.uf);
    					});
    					validCep = true;
    					$(event.target).css("color", "black");			
    					$("#msgCep").hide();
					}else{
						$(event.target).css("color", "red");
						$(event.target).focus();
						$("#msgCep").html("Cep Inválido!").css("color", "red");
						$("#msgCep").show();
						validCep = false;
					}
				});
			});
		