<?php 
class Sesion {
	function isConnected ($variables=NULL, $valores=NULL){
		try {
			$TK = @$_SESSION['TK'];
			if(!isset($_SESSION[$TK])) return false;
		      if($_SESSION[$TK]!=(MD5($_SESSION['ID'].$_SESSION['NOM']))) return false;

		      if($variables!=NULL){
		        $ses = explode(',',$variables);
		        $val = explode(',',$valores);
		        $l = sizeof($ses);

		        for($i=0;$i<$l;$i++){
		        	if(!isset($_SESSION[$ses[$i]]) || $_SESSION[$ses[$i]]!=$val[$i]){
		        		return false;
		        		break;
		        	}
		        }
		    }

		    $now=time();
		    if(!isset($_SESSION['expire'])) return false;
		    if($now<$_SESSION['expire']) $_SESSION['expire'] = time() + (3600*60); else return false; 
		    return true;
		} catch (\Throwable $th) { }
	}
}
?>