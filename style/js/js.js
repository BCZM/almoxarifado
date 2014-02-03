/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




$(function(){
        $('#top').gotop();
  });
        var oTable;
        var bs = false;
        /*function selecionado(x){
                        $(x).addClass('gradeA');

                }
        function n_selecionado(x){
                        $(x).removeClass('gradeA');
                }*/


        /* Get the rows which are currently selected */
        function fnGetSelected( oTableLocal )
        {
                return oTableLocal.$('tr.row_selected');
        }

 
 
$(function(){
         

        /* Init the table */
       oTable = $('table[name=datatable]').dataTable(  {
                        "sScrollY": 200,
                        "sScrollX": "100%",
                        "sScrollXInner": "100%"
                        
                })
    ;
   
  
        
  /* Add a select menu for each TH element in the table footer */
    /*$("tfoot th").each( function ( i ) {
            this.innerHTML = fnCreateSelect( oTable.fnGetColumnData(i) );
            $('select', this).change( function () {
                    oTable.fnFilter( $(this).val(), i );
            } );
    } );*/
          //oTable = $('#usuario');
	/*$('body').on('click', '#usuario tbody td', function () {
        /*Obtém a posição da célula clicada 
        var aPos = oTable.fnGetPosition(this);

       /*Obtém o array com os dados da linha clicada
        var aData = oTable.fnGetData(aPos[0]);


        });*/

       $('.add').click( function () {
               /*Obtém a posição da célula clicada */
        var aPos = oTable.fnGetPosition(this);

       /*Obtém o array com os dados da linha clicada*/
        var aData = oTable.fnGetData(aPos[0]);
       
       adicionar(aData[0],aData[2],$('.material'));

       });

       var arr = new Array();
       var i = 0;
       
       /*Script para adicionar e remover campo*/
       
        function adicionar(nome,grupo,div){
            //alert(nome);
          var flag = false;   
             //arr[i] = [nome,grupo];
             
           for(var x=0; x < arr.length; x++){
                 
            if(nome == arr[x][0] && grupo == arr[x][1]){
                    flag = true;
                    break;
                 } 
                 
             }
             
             if(!flag){
                
             
                $('<tr>'
                   +'<td><input name="nome[]" type="text" value="'+ nome  +'" readonly="readonly" style=" width: 162px; height: 35px;" /></td>'
                   +'<td><input name="grupo[]" type="text" value="'+ grupo  +'" readonly="readonly" style=" width: 162px; height: 35px;" /></td>'
                   +'<td><input type="number" name="qnt[]" value="1"/></td>'
                   +'<td><a href="#" id="'+i+'" class="remove">Remove</a></td>'
                   +'</tr>')
                   .appendTo(div);
                 arr[i] = [nome,grupo];
                 i++;
                }  
            }

          $('.remove').live('click', function() { 
                               $(this).parents('tr').remove();
                            var id =  $(this).attr('id');
                               delete arr[id][0];
                               delete arr[id][1];
 
               });

        
});  