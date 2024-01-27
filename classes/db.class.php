<?php

# db.class.php

class DB {
    
    /** ### PHP4 ###   **/
    var $conexao;
    var $resultado;
    
    function __construct($dominio, $usr, $pws, $db) {
        //$this->conexao = mysqli_connect($dominio, $usr, $pws);
        if (!$this->conexao = mysqli_connect($dominio, $usr, $pws)){
            echo "Não foi possivel fazer a conexão com o MySQL";
            exit;
        }
        if (!mysqli_select_db($this->conexao,$db)){
            echo "Não foi possivel fazer a conexao com o Banco de Dados <b>$db</b>";
            exit;
        }
        
        if (!mysqli_set_charset($this->conexao,"utf8")){
            echo "Não foi possivel configurar o pack de carcteres <b>$db</b>";
            exit;
        }
        
        mysqli_query($this->conexao,"SET NAMES 'utf8'");
        mysqli_query($this->conexao,"SET CHARACTER SET utf8");
        mysqli_query($this->conexao,"SET COLLATION_CONNECTION = 'utf8_general_ci'");
    }
    
    /* ### PHP5 ###
    public $conexao;
    public $resultado;
    
    function __construct($dominio, $usr, $pws, $db) {
        $this->conexao = mysql_connect($dominio, $usr, $pws);
        mysql_select_db($db, $this->conexao);
    }
    */
    
    function DBError(){
        //echo 'Conexão: '.$this->conexao;
        echo mysqli_error($this->conexao);
    }
    
    function inserirTabela($tab, $campos){
        $query = "INSERT INTO $tab VALUES $campos";
        //echo $query;
        $this->resultado = mysqli_query($this->conexao,$query) or die('errors+'.mysqli_error($this->conexao));
        //echo "Valor do this->resultado : ".$this->resultado; exit();
        
    }
    
    function selecionaTabela($tab, $campos, $condicao){
        $query = "SELECT $campos FROM $tab $condicao";
        //echo $query;
        //$this->resultado = mysql_query($query, $this->conexao);
        $this->resultado = mysqli_query($this->conexao,$query) or die('errors+'.mysqli_error($this->conexao));
    }
    
    function deletaTabela($tab, $condicao){
        $query = "DELETE FROM $tab $condicao";
        $this->resultado = mysqli_query($this->conexao,$query) or die('errors+'.mysqli_error($this->conexao));
    }
    
    function atualizaTabela($tab, $campos,$condicao){
        $query = "UPDATE $tab SET $campos $condicao";
        //echo $query; exit();
        $this->resultado = mysqli_query($this->conexao,$query) or die('errors+'.mysqli_error($this->conexao));
        //echo $this->resultado; exit();
    }
    
    function totalRegistrosTabela($tab, $campo){
        //$query = "SELECT COUNT(*) AS TotalRecords FROM Orders";
        //$this->resultado = mysql_query($query);
        $query = "SELECT COUNT($campo) AS TotalRecords FROM $tab";
        return $this->mysqli_result(mysqli_query($this->conexao,$query), 0,"TotalRecords");
    }

    function mysqli_result($search, $row, $field){
        $i=0; while($results=mysqli_fetch_array($search)){
        if ($i==$row){$result=$results[$field];}
        $i++;}
        return $result;
    } 
}
/*
// An "mysqli_result" function where $field can be like table_name.field_name with alias or not.
function mysqli_result($result,$row,$field=0) {
    if ($result===false) return false;
    if ($row>=mysqli_num_rows($result)) return false;
    if (is_string($field) && !(strpos($field,".")===false)) {
        $t_field=explode(".",$field);
        $field=-1;
        $t_fields=mysqli_fetch_fields($result);
        for ($id=0;$id<mysqli_num_fields($result);$id++) {
            if ($t_fields[$id]->table==$t_field[0] && $t_fields[$id]->name==$t_field[1]) {
                $field=$id;
                break;
            }
        }
        if ($field==-1) return false;
    }
    mysqli_data_seek($result,$row);
    $line=mysqli_fetch_array($result);
    return isset($line[$field])?$line[$field]:false;
}
*/