<?php
include_once __DIR__.'/../includes/config.php';

include_once DIR.INCLUDES.'topo.php';
include_once DIR.INCLUDES.'menu.html';

include_once DIR.CLASSES.'db.class.php';
    $Banco = new DB(HOST,USER,PASS,DB_NAME);
    $Banco->DBError();
include_once DIR.INCLUDES.'func_jQuery.php';
    ajaxjQuery('index.php','loginId');
    //checkBoxAll("regioes[]");

?>
<div id="content">
	<h1>Cadastro de Emails para envio
    <a href="<?php echo URL.MODULES?>lst_usuario_list.php">Voltar</a></h1>
	
	<div id="return"></div>
	<div id="load"><a href="javascript:void(0);" style="outline: none;" id="topFocus"><img src="<?php echo URL.IMG ?>loading.gif" alt ="" /></a><br />Aguarde, processando...</div>
	
	<form id="form">
		<input type="hidden" name="action" id="action" value="saveEmail" />
        
        <p>
            <label for="tratamento">Nome de tratamento:</label>
			<input type="text" value="" name="tratamento" id="tratamento" />
		</p>
        
        <p>
            <label for="primeiroNome">Nome do Cliente:</label>
			<input type="text" value="" name="primeiroNome" id="primeiroNome" />
		</p>
        
        <p>
            <label for="nomeMeio">Nome do meio:</label>
			<input type="text" value="" name="nomeMeio" id="nomeMeio" />
		</p>
        
        <p>
            <label for="sobrenome">Sobrenome:</label>
			<input type="text" value="" name="sobrenome" id="sobrenome" />
		</p>
    
        <p>
			<label for="email">Endere&ccedil;o de Email:</label>
			<input type="text" value="" name="email" id="email" />
		</p>
        
        <p>
			<label for="regiao">Regi&atilde;o:</label>
            <div>
            <table style="margin-left: 18px; width: 75%; border: 0px !important;">
            <tr><th><input type="checkbox" name="selectAll" onClick="CheckAll(this)" /><label> Todas as Regi&otilde;es</label></th></tr>
            <?php
				$Banco->selecionaTabela("`regiao`","`reg_id` as ID, `reg_nome` AS Nome, `reg_status` as Status","WHERE `reg_status`=1");
                $rsRegioes = $Banco->resultado;
                if(mysqli_num_rows($rsRegioes)>0):
                    $count = 0;
					echo "<pre>";
                    while($row = mysqli_fetch_object($rsRegioes)):
                        if($count==0):
                            echo '<tr>';
                        endif;
                        echo '<td><input type="checkbox" id="regioes[]" name="regioes[]" value="'.$row->ID.'+'.$row->Nome.'"><label for="regioes[]">'.$row->Nome.'</label></td>';
                        $count++;
                        if($count==3):
                            echo '</tr>';
                            $count = 0;
                        endif;
						//echo '<input type="checkbox" id="regioes[]" name="regioes[]" value="'.$row->ID.'"><label for="regioes[]">'.$row->Nome.'</label>'."\t\t";
                        endwhile;
                    echo "</pre>";
				else:
					echo 'Nenhuma regi&atilde;o encontrada';
				endif;
			?>
            </table>
            </div>
		</p>

		<p>
			<label for="nivel">N&iacute;vel do Cliente:</label>
			<select name="nivel" id="nivel">
				<option value="0"></option>
				<?php 
					$Banco->selecionaTabela("`nivel`","`lvl_id` as ID, `lvl_nome` AS Nome, `lvl_status` as Status","WHERE `lvl_status`=1");
                    $rsNiveis = $Banco->resultado;
                    //echo "valor do rsNivel ".$rsNiveis;
                    //$rsMudules = mysql_query("SELECT mod_id, mod_name FROM `modules` WHERE mod_status=1");
					if(mysqli_num_rows($rsNiveis)>0):
						while($row = mysqli_fetch_object($rsNiveis)):
						
							echo '<option value="'.$row->ID.'">'.$row->Nome.'</option>';
						
						endwhile;
					else:
						echo '<option value="0">Nenhum n&iacute;vel encontrado</option>';
					endif;
				?>
			</select>
		</p>
        
        <p>
			<label for="sexo">Sexo do Cliente:</label>
			<select name="sexo" id="sexo">
				<option value="1">Masculino</option>
                <option value="2">Feminino</option>
				<option value="3">N&atilde;o Informado</option>
			</select>
		</p>

		<p>
			<label for="status">Ativo:</label>
			<select name="status" id="status">
				<option value="1">Sim</option>
				<option value="0">N&atilde;o</option>
			</select>
		</p>
		
		<p>
			<input type="submit" value="Salvar" />
			<input type="reset" style="display: none;" id="clean" />
		</p>
	
	</form>

</div><!--### DIV id="content" ###-->

<?php include_once DIR.INCLUDES.'fundo.php'; ?>