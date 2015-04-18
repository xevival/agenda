<?php

/**
 * Description of Login
 *
 * @author Pepino
 */
class Login {

    /**
     * Funcion que muestra el formulario de login en la pantalla principal
     */
    public static function mostrarFormulario($error) {

        $html  = '<div class="col-md-4"></div>';
        $html .= '<div class="col-md-4 well bs-component id="form">';

        $html.= '<form class="form-horizontal" action="login.php?do=doLogin" method="POST">
                    <fieldset>
                      <legend>Acceso a Agenda</legend>
                      <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Usuario</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="inputEmail" placeholder="Usuario" name="user">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                          <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="pass">
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                          <button type="reset" class="btn btn-default">Borrar</button>
                          <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>';
        
        if ( $error == 1 ){
        	$html.= '<div class="alert alert-danger" role="alert"><strong>ERROR! </strong>Datos de acceso incorrectos</div>';
        }
        
        $html.='</div>';
        echo $html;
    }
    
    public static function iniciarSession($user, $pass){
    	
    	$sql = 'SELECT 
    				id_usuario 
    			FROM 
    				usuarios u
    			WHERE
    				v_username="'.$user.'" AND v_pass="'.$pass.'"';
   
    	$user = GestorBD::tirarSQL($sql);
    	
    	return $user;
    	
    	
    }

}
