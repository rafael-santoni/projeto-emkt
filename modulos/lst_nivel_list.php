<?php
include_once __DIR__.'/../includes/config.php';

include_once DIR.INCLUDES.'topo.php';
include_once DIR.INCLUDES.'menu.html';

include_once DIR.CLASSES.'db.class.php';
    $Banco = new DB(HOST,USER,PASS,DB_NAME);
    $Banco->DBError();

include_once DIR.INCLUDES.'func_jQuery.php';
    ajaxjQuery('index.php', 'action', 'history.go();');
    checkBoxAll("niveis2delete[]");

$pagAtual=1;
$totalNiveis = $Banco->totalRegistrosTabela("`nivel`","*");
$totalPaginas = (($totalNiveis % 30) == 0) ? $totalNiveis / 30 : intval($totalNiveis/30)+1 ;
if (isset($_GET['pag']) || !empty($_GET["pag"])){
	if ($_GET['pag']>$totalPaginas || !is_numeric($_GET['pag'])){
        echo '<h2>Erro ao processar</h2>N&atilde;o foi possivel completar a opera&ccedil;&atilde;o. <BR />P&aacute;gina n&atilde;o definida!'; exit();
	}
    $pagAtual = $_GET['pag'];
}
$limiteInicio = ""; //$limiteFim = ""; 
$limiteTotal = 30; 
$limiteInicio = ($pagAtual*$limiteTotal)-$limiteTotal;
//$limiteFim = $pagAtual*$limiteTotal;
?>

<div id="content">
	<h1>Listagem de N&iacute;veis
    <a href="<?php echo URL.MODULES?>lst_nivel_add.php">Novo</a></h1>

    <pre><?php echo "\t Pagina $pagAtual / $totalPaginas \t\t" . montaListaPagina($totalPaginas,$pagAtual,"lst_nivel_list.php") . "\r\n\r\n"; ?></pre>	
	<div id="return"></div>
	<div id="load"><img src="<?php echo URL.IMG ?>loading.gif" alt ="" /><br />Aguarde, processando...</div>
	
	<form id="form">
	   <input type="hidden" name="action" id="action" value="deleteNivel" />
	   <table cellspacing ="0">
	   <tr class="header">
			<td>C&oacute;digo</td>
            <td>N&iacute;vel</td>
			<td>Status (ativo)</td>
			<td></td>
			<td><input type=checkbox name="selectAll" onClick="CheckAll(this)"></td>
	   </tr>
		
		<?php 
			$Banco->selecionaTabela("`nivel`","`lvl_id` as ID, `lvl_nome` as Nome, `lvl_status` AS Status","");
            $rsNiveis = $Banco->resultado; 
            //$lstEmail = array();
            //$lstEmail = mysql_fetch_object($Banco->resultado);
            /*$rsModules = mysql_query("SELECT 
										mI.mdi_id AS 'mItemId',
										mI.mod_id AS 'mItemModId',
										mI.mdi_name AS 'mItemName',
										mI.mdi_url AS 'mItemURL',
										mI.mdi_status AS 'mItemStatus',
										m.mod_id AS 'moduleId',
										m.mod_name AS 'moduleName' 
									FROM `modules_item` mI, `modules` m
									WHERE mI.mod_id = m.mod_id") or die (mysql_error());      */
			//echo 'lista: '; print_r($rsListaEmail);
            if(mysqli_num_rows($rsNiveis)>0):
				$i=1;
				while($row = mysqli_fetch_object($rsNiveis)):
					//$cor = ($i % 2 == 0) ? 'class="listra"' : '';
					$cor = ($i % 2 == 0) ? 'class="listra"' : '';
	// 				echo '<PRE>';
	// 				print_r($row);
	// 				echo '</PRE>';  ?>
					<tr <?php echo $cor ?>>
						<td><?php echo $row->ID ?></td>
						<td><?php echo $row->Nome ?></td>
						<td><?php echo ($row->Status == 1) ? '<span class="sim">Sim</span>' : '<span class="nao">N&atilde;o</span>' ?></td>
						<td><a href="<?php echo URL.MODULES?>lst_nivel_update.php?lvl=<?php echo $row->ID ?>"><img src="<?php echo URL.IMG?>bt_edit.png" alt="Editar registro" title="Titulo Editar" /></a></td>
						<td><input type="checkbox" name="niveis2delete[]" value="<?php echo $row->ID; ?>"> <img src="<?php echo URL.IMG?>bt_delete.png" alt="Excluir registro" title="Titulo Excluir" /></a></td>
					</tr>
			<?php 
				$i++;
				endwhile;
 
                //$pageNum = montaListaPagina($totalPaginas,$pagAtual,"lst_email_list.php");
                $pageNum = "<td ALIGN=\"CENTER\" style=\"border: none;\" >".montaListaPagina($totalPaginas,$pagAtual,"lst_nivel_list.php")."</td>";
                $pagAnterior=($pagAtual==1)?"<td style=\"border: none;\"></td>":"<td ALIGN=\"LEFT\" style=\"border: none;\"> < <a href=\"?pag=".($pagAtual-1)."\">Ant.</a></td>";
                $proxPagina=($pagAtual==$totalPaginas)?"<td style=\"border: none;\"></td>":"<td ALIGN=\"RIGHT\" style=\"border: none;\"><a href=\"?pag=".($pagAtual+1)."\">Prox.</a> ></td>";
                //echo '<tr>'.$pagAnterior.'<td colspan="3" ALIGN="center">'."$firstPage  $pageB4 | $pageNum | $nextPage  $lastPage </td><td></td><td></td>$proxPagina</tr>";
                echo '<tr><table style="width: 100%; border: none;"><tr class="listaPaginas">'.$pagAnterior.$pageNum.$proxPagina.'</tr></table></tr>';
			else:
				echo '<tr><td colspan="5">Nenhum registro encontrado!</td></tr>';
			
			endif;
		?>
	</table>

	<?php if(mysqli_num_rows($rsNiveis)>0){ echo '<input type="submit" value="Excuir" class="btnDel" />';} ?>
	</form>

</div><!--### DIV id="content" ###-->

<?php include_once DIR.INCLUDES.'fundo.php'; ?>