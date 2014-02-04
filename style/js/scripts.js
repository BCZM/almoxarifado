/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
 //SCRIPT PARA JANELA MODAL
    $('a[name=modal]').click(function(e) {
        
		e.preventDefault();
		
		var id = $(this).attr('href');
	
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		$(id).fadeIn(2000); 
	
	});
	
	$('.window .close').click(function (e) {
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});
        /*$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});*/
 //SCRIPT PARA JANELA MODAL
 
//SCRIPT PARA FILTRAR DADOS NA TABELA RELATÓRIO

//SCRIPT PARA FILTRAR DADOS NA TABELA RELATÓRIO
//INICIO 
$('.opcoes').hide();
$('#opcoes').click(function (){
      $('.opcoes').toggle();
});
//FIM

$("input[class=editar]").attr('disabled',true);


}); 

function exibir(obj){
    //alert(obj.id);
    if(obj.checked){
        //alert('checado!');
        $("input[name="+obj.id+"]").removeAttr('disabled');
    }
    else{
        //alert('nao checado');
            $("input[name="+obj.id+"]").attr('disabled',true);
        }
}   

