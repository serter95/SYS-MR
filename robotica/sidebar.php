 <?php
    require("seguridad.php");
    require("conexion.php");

    function barleft()
    {
?>
  <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
<?php
    $query=pg_query("SELECT * FROM usuario u, tipo_usuario t WHERE u.id_tipo_usuario=t.id_tipo AND u.estatus=1
      AND t.estatus=1 AND u.nom_usuario='".$_SESSION['nom_usuario']."' AND u.taller=2");
    
    $array=pg_fetch_assoc($query);
?>
      
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	 <!-- <p class="centered"><a href="#"><img src="imagenes/upta.png" class="img-circle" width="70"></a></p>-->
                      <p class="centered"><a href="#"><img src="imagenes/upta.png" width="70px"></a></p>

              	  <h5 class="centered">UPT-Aragua</h5>
              	  	
                  <li class="mt">
                      <a class="active" href="index.php">
                          <i class="fa fa-folder-open-o"></i>
                          <span class="t-menu">Inicio</span>
                      </a>
                  </li>
                <?php
                  if ($array['priv_horarios']!='0' || $array['priv_proyectos']!='0' || $array['priv_convenios']!='0')
                  {
                ?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-book"></i>
                          <span class="t-menu">Académico</span>
                      </a>
                      <ul class="sub">
                        <?php
                          if ($array['priv_horarios']!='0')
                          {
                        ?>
                          <li><a href="horarios.php"><span class="t-submenu">Planificación</span></a></li>
                          <li><a href="horarios_clase.php"><span class="t-submenu">Horarios</span></a></li>
                        <?php
                          }

                          if ($array['priv_proyectos']!='0')
                          {
                        ?>  
                          <li><a href="proyectos.php"><span class="t-submenu">Proyectos</span></a></li>
                        <?php
                          }

                          if ($array['priv_convenios']!='0')
                          {
                        ?>  
                          <li><a href="convenios.php"><span class="t-submenu">Convenios</span></a></li>
                        <?php
                          }
                        ?>
                      </ul>
                  </li>
                <?php
                  }

                  if ($array['priv_inventario']!='0' || $array['priv_maquinas']!='0' || $array['priv_personal']!='0')
                  {
                ?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span class="t-menu">Administrativo</span>
                      </a>
                      <ul class="sub">
                        <?php
                          if ($array['priv_inventario']!='0')
                          {
                        ?>
                          <li><a href="inventario.php"><span class="t-submenu">Inventario</span></a></li>
                        <?php
                          }

                          
                        ?>
                          <li><a href="actividades.php"><span class="t-submenu">Actividades</span></a></li>
                        <?php
                          

                          if ($array['priv_personal']!='0')
                          {
                        ?>  
                          <li><a href="personal.php"><span class="t-submenu">Personal</span></a></li>
                        <?php
                          }
                        ?>
                      </ul>
                  </li>
                <?php
                  }

                  if ($array['priv_usuarios']=='si' || $array['priv_bd']=='si' || $array['priv_auditoria']=='si')
                  {
                ?>  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span class="t-menu">Configuraci&oacute;n</span>
                      </a>
                      <ul class="sub">
                        <?php
                          if($array['priv_usuarios']=='si')
                          {
                        ?>  
                          <li><a href="usuarios.php" ><span class="t-submenu">Usuarios</span></a></li>
                        <?php
                          }

                          if($array['priv_auditoria']=='si')
                          {
                        ?>  
                         <li><a href="auditoria.php"><span class="t-submenu">Auditoría</span></a></li>
                        <?php
                          }
                        ?>
                      </ul>
                  </li>
                <?php
                  }
                ?>
                    <li class="sub-menu">
                      <a href="reportes.php">
                          <i class="fa fa-file-text-o"></i>
                          <span class="t-menu">Reportes</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-sitemap"></i>
                          <span class="t-menu">Intranet</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="http://dace.upta.edu.ve" target="_blank"><span class="t-submenu">Sistema DACE</span></a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-university"></i>
                          <span class="t-menu">Universidad FBF</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="http://upta.edu.ve" target="_blank"><span class="t-submenu">UPTA FBF</span></a></li>
                          <li><a  href="http://eva.upta.edu.ve" target="_blank"><span class="t-submenu">Aula Virtual</span></a></li>
                      </ul>
                  </li>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
   
      <!--sidebar end-->
<?php
    }
?>