<script>
$(function(){
       $('#example').dataTable( {
                    "sDom": 'T<"clear">lfrtip',
                    "oTableTools": {
                        "sSwfPath": "<?php echo  BARRA.url_base.BARRA.BASEJS ?>swf/copy_csv_xls_pdf.swf"
                        ,"aButtons":["print"]
                    }
	} ).columnFilter({aoColumns:[
				{ sSelector: "#coluna1", type:"select"  },
				{ sSelector: "#coluna2", type:"number-range" },
				{ sSelector: "#coluna3" }
				]}
			);
  ;
});

</script>
<div class="modulo">
    <h1>Relatório</h1>

<a href="#dialog" name="modal" ><img src="<?php echo BARRA.url_base.BARRA.BASEIMAGES?>add_user.png" />Adicionar novo</a>
<div id="dialog" class="window" >
    
    <a href="#" class="close">Fechar [X]</a><br />
    <div class="content_dialog">
    <h3>Inserir setor</h3>
            <form  action="<?php echo BARRA.url_base?>/setor/cadastrarsetor" method="post">
                <div class="pos_center">
                    <p>
                            <strong>Nome do setor</strong><br />
                            <input type="text" name="nomeSetor" value="" required="required" />
                    </p>
                    <p>
                            <strong>Código do setor</strong><br />
                            <input type="text" name="codigoSetor" value="" required="required" />
                    </p>
                    <p>
                        <input type="submit" name="insertS" value="Inserir setor" />
                    </p>
                </div>
            </form>
    </div>
</div>
<br>
<a href="#" id="opcoes">[+]Opções</a>
<div class="opcoes">
<table cellspacing="0" cellpadding="0" border="0" class="display" ID="Table1">
			
			<tbody>
				<tr id="filter_global">
					<td align="center">Coluna1</td>
					<td align="center" id="coluna1"></td>
				</tr>
				<tr id="filter_col1">
					<td align="center">Coluna2</td>
					<td align="center" id="coluna2"></td>
				</tr>
				<tr id="filter_col2">
					<td align="center">Coluna3</td>
					<td align="center" id="coluna3"></td>
				</tr>
			</tbody>
</table>
</div>

<table cellpadding="0" cellspacing="0" border="0" class="display" name="" id="example">
   
	<thead>
		<tr>
			<th>Coluna1</th>
			<th>Coluna2</th>
			<th>Coluna3</th>
                     
		</tr>
	</thead>
        <tfoot>
		<tr>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</tfoot>
        <tbody>
            <tr>
                <td>value</td>
                <td>56</td>
                <td>ativo</td>
            </tr>
            <tr>
                <td>value2</td>
                <td>12</td>
                <td>finalizado</td>
            </tr>
            <tr>
                <td>value3</td>
                <td>25</td>
                <td>ativo</td>
            </tr>            
            <tr>
                <td>vaue4</td>
                <td>18</td>
                <td>em andamento</td>
            </tr>
            <tr>
                <td>value5</td>
                <td>8</td>
                <td>concluido</td>
            </tr>            
        </tbody>

</table>  
<a onClick="window.print();return false" href="#">Imprimir</a>

</div>