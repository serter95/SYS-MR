<?php 
    require("seguridad.php");
    require("conexion.php");
    function cabecera()
    {


?><!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
     
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php#" class="logo"><b>SYS-M&R</b> &nbsp; <b>Robótica</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                     <?php
                            date_default_timezone_set('America/Caracas');
                            $hoy=date('Y-m-d');

                            $usuario=$_SESSION['nom_usuario'];

                            $query=pg_query("SELECT * FROM planificacion_semanal INNER JOIN (personal INNER JOIN 
                            usuario ON personal.id=usuario.id_personal AND 
                            usuario.nom_usuario='$usuario' AND personal.estatus=1 AND
                            usuario.estatus=1 AND area='Robotica') ON planificacion_semanal.id_personal=personal.id
                            AND planificacion_semanal.estatus=1 AND personal.estatus=1 AND fecha<='$hoy'
                            AND estado In ('En proceso') ORDER BY fecha DESC");

                            $query2=pg_query("SELECT * FROM planificacion_semanal INNER JOIN (personal INNER JOIN 
                            usuario ON personal.id=usuario.id_personal AND 
                            usuario.nom_usuario='$usuario' AND personal.estatus=1 AND
                            usuario.estatus=1 AND area='Robotica') ON planificacion_semanal.id_personal=personal.id
                            AND planificacion_semanal.estatus=1 AND personal.estatus=1 AND fecha<='$hoy'
                            AND estado In ('En proceso') ORDER BY fecha DESC LIMIT 5");

                            #echo $query;

                            $num=pg_num_rows($query);
                        ?>

                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope-o"></i>
                        <?php
                            if ($num > 0)
                            {
                        ?>
                            <span class="badge bg-theme"><?php echo $num; ?></span>
                        <?php
                            }
                        ?>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                        <?php
                            if ($num > 0)
                            {
                        ?>
                                <p class="green">Tienes <?php echo $num; ?> nuevas tareas</p>
                        <?php
                            }
                            else
                            {
                        ?>
                                <p class="green">No tienes tareas</p>
                        <?php
                            }
                        ?>
                            </li>
                        <?php
                            while($array=pg_fetch_assoc($query2))
                            {
                                $fecha=explode('-', $array['fecha']);
                                $fecha_planif=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];

                                $nom=explode(' ', $array['nombres']);
                                $ape=explode(' ', $array['apellidos']);

                                $nombre=$nom[0].' '.$ape[0];

                                $id=$array['id_planif'];
                        ?>
                            <li>
                                <a href="notificaciones.php?id=<?php echo $id;?>">
                                    <span class="subject">
                                    <span class="time"><?php echo $fecha_planif; ?></span><br>
                                    <span class="from"><?php echo $nombre; ?></span>
                                    </span>
                                    <span class="message">
                                                <?php

                                                    $lon=strlen($array['actividad']);
                                                    
                                                    if ($lon > 46)
                                                    {
                                                       echo substr($array['actividad'], 0, 43).'...';
                                                    }
                                                    else
                                                    {
                                                        echo $array['actividad'];
                                                    }
                                                ?>
                                    </span>
                                </a>
                            </li>
                        <?php
                            }
                        ?>
                            <li>
                                <a href="notificaciones.php?id=todos">Ver todas las tareas</a>
                            </li>
                        </ul>


                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>

            <div class="top-menu">
            <div id="nom_usuario"><?php echo "Usuario: ".$_SESSION['nom_usuario'];?>&nbsp;&nbsp;&nbsp;<?php echo "Tipo: ".$_SESSION['tipo'];?></div>
            	<ul class="nav pull-right top-menu">
                         <li class="dropdown" style="margin-top:10%;">
                                  <a  class="dropdown-toggle" href="../manual/" target="_blank" title="Manual de Usuario">
                                    <span style="font-size:25px; border-radius:50%; margin-top:7px;" class="fa fa-book"></span>
                                </a>
                            </li>

                            <li id="header_inbox_bar" class="dropdown" style="margin-top:10%;">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span style="font-size:25px; border-radius:50%; margin-top:7px;"class="li_user"></span>
                                </a>
                        <ul class="dropdown-menu extended inbox" style="margin-left:-200px; margin-top:19%;">
                            <div class="notify-arrow notify-arrow-green" style="margin-left:205px;"></div>
                            <li>
                                <p class="green">Usuario</p>
                            </li>
                            <li>
                                <a href="configuracion.php">
                                    <i class="fa fa-cog" style="font-size: 30px; margin:5px; margin-right:10%; float:left;"></i>
                                    <span class="subject">
                                        <span style="font-size:15px;"><b>Configuración</b></span>
                                    </span>    
                                        <span class="message">Configuración de Cuenta</span>
                                </a>
                            </li>
                            <li>
                                <a href="salir.php">
                                    <i class="fa fa-power-off" style="font-size:30px; margin:5px; margin-right:10%; float:left;"></i>
                                    <span class="subject">
                                        <span style="font-size:15px;"><b>Salir</b></span>
                                    </span>
                                        <span class="message">Salir del sistema</span>
                                </a>
                            </li>
                        </ul>
                    </li>
               	</ul>
            </div>
  
      <!--header end-->
      <?php
    }
?>