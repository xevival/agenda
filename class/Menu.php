
 <?php
 
class Menu {
    
     public static function mostrarMenu(){
        $html ='<nav class="navbar navbar-default">
                    <div class="container-fluid">
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Gestion Agenda</a>
                      </div>
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                        	<li><a href="contactos.php">Contactos</a></li>
                        	<li><a href="buscar.php">Buscar</a></li>
        					<li><a href="email.php">Emails</a></li>
        					<li><a href="accesos.php">Ver accesos</a></li>
                          
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                          <li><a href="logout.php">Salir</a></li>
                        </ul>
                      </div>
                    </div>
                  </nav>';
        
        echo $html;
    }
    
    public static function mostrarPie(){
    	
    	
    	$html .= '<div class="pie">
				      <div>
				        <p class="text-muted credit">Example courtesy <a href="http://martinbean.co.uk">Martin Bean</a> and <a href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.</p>
				      </div>
				    </div>';
    	
    	
    	echo $html;
    	
    }

   
    
}

?>
