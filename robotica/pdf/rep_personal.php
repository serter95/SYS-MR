<?php 

$personal=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica'");
$total_personal=pg_num_rows($personal);

$masculino=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND sexo='M'");
$personal_masculino=pg_num_rows($masculino);

$femenino=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND sexo='F'");
$personal_femenino=pg_num_rows($femenino);

$escolar=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Escolar'");
$t_escolar=pg_num_rows($escolar);

$bachiller=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Bachiller'");
$t_bachiller=pg_num_rows($bachiller);

$medio_tecnico=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Medio Técnico'");
$t_medio_tecnico=pg_num_rows($medio_tecnico);

$TSU=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='TSU'");
$t_TSU=pg_num_rows($TSU);

$profesor=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Profesor'");
$t_profesor=pg_num_rows($profesor);

$licenciado=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Licenciado'");
$t_licenciado=pg_num_rows($licenciado);

$ingeniero=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Ingeniero'");
$t_ingeniero=pg_num_rows($ingeniero);

$diplomado=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Diplomado'");
$t_diplomado=pg_num_rows($diplomado);

$especializacion=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Especialización'");
$t_especializacion=pg_num_rows($especializacion);

$magister=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Magister'");
$t_magister=pg_num_rows($magister);

$doctorado=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Doctorado'");
$t_doctorado=pg_num_rows($doctorado);

$phd=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' AND grado_instruccion='Phd'");
$t_phd=pg_num_rows($phd);

?>

<style type="text/css">

.center_header
{
    margin-left: 230px; padding: 0;
}

.center
{
    margin-left: 240px; padding: 0;
}

.tabledate
{
    clear: both;
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    max-width: none !important;
    margin-left: 0px;
    border: 1px solid #ddd;
    border-collapse: separate !important;
    background-color: transparent;
    border-spacing: 0;
    display: table;
    text-align: center;
}

.td_title
{
    width:100px;
    text-align: center; 
    background-color:#0061C5;
    color:#fff;
}

.page_header
{
    width: 100%;
    border: none;     
    margin: 0 auto;
    margin-left: 380px;
    padding: 0;
    display: inline-block;
}

.footer_header
{
    width: 100%;
    border: none;        
    margin: 0 auto;
    margin-left: 470px;
}

#lol
{
    margin-left: 100px;
    position: absolute;
}

#fecha
{
    margin-left: 1000px;
    position: absolute;
}

#fieldset_izquierdo
{
    float: left;
    display: inline-block;
    width: 250px;
    margin-right: 50px;       
}

#fieldset_derecho
{
    float: right;
    display: inline-block;
    width: 250px;
    margin-left: 50px;
}

</style>

<page orientation='L' backtop="22mm" backbottom="14mm" backleft="10mm" backright="10mm" footer="page;">
    <page_header style="margin-bottom:20px;">
        <div id="lol" >
            <img src="upta.jpg" alt="Logo" height="80" width="90"/>
        </div>
        <table class="page_header" >
            <tr>          
                <td align="center">
                    <span>República Bolivariana de Venezuela</span><br>
                    <span>Ministerio del Poder Popular para la Educación Superior</span><br>
                    <span>UPT-Aragua "Federico Brito Figueroa"</span><br>
                    <span>Taller de Metalmecánica</span>
                </td>
            </tr>
        
        </table>

        <div id="fecha">
            <?php echo $hoy;?>
        </div>

    </page_header>

        <h3 align="center">Reporte de Personal</h3>
    
    <table align="center" class="tabledate">
         <tr>
            <td border="1" class="td_title" width="100">C.I</td>
            <td border="1" class="td_title" width="100">Nombres</td>
            <td border="1" class="td_title" width="100">Apellidos</td>
            <td border="1" class="td_title" width="30">Sexo</td>
            <td border="1" class="td_title" width="100">Grado de Instrucción</td>
            <td border="1" class="td_title" width="100">Especialidad</td>
            <td border="1" class="td_title" width="100">Cargo</td>
            <td border="1" class="td_title" width="100">Número de Contacto</td>
        </tr>
<?php
        while($fila=pg_fetch_assoc($datos))
        {
?>

            <tr>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['ci'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['nombres'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['apellidos'];?></td>
                <td border="1" style="text-align: center;" width="30"><?php echo $fila['sexo'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['grado_instruccion'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['especialidad'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['cargo'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['numero_contacto'];?></td>
            </tr>
<?php   
        }
?>
    
</table>

<table align="center">
    <tr>
        <td>
            <fieldset id="fieldset_izquierdo">
            <div style=" text-align: center; background-color:#0061C5; color:#fff;">Cantidad de Personal</div>
            <table>
                 <tr>
                    <td>
                        Nº Total del Personal: <?php echo $total_personal; ?> 
                        <br>
                        Nº de Personal Masculino: <?php echo $personal_masculino; ?> 
                        <br>
                        Nº de Personal Femenino: <?php echo $personal_femenino; ?>
                    </td>
                </tr>
            </table>
            </fieldset>
        </td>
        <td width="100px">
        </td>
        <td>
            <fieldset id="fieldset_derecho">
            <div style=" text-align: center; background-color:#0061C5; color:#fff;">Clasificación de Personal</div>
            <table>
                <tr>
                    <td>
                        Escolar: <?php echo $t_escolar; ?>
                        <br>
                        Bachiller: <?php echo $t_bachiller; ?>
                        <br>
                        Medio Técnico: <?php echo $t_medio_tecnico; ?>
                    </td>
                    <td>
                        TSU: <?php echo $t_TSU; ?>
                        <br>
                        Profesor: <?php echo $t_profesor; ?>
                        <br>
                        Licenciado: <?php echo $t_licenciado; ?>
                    </td>
                    <td>
                        Ingeniero: <?php echo $t_ingeniero; ?>
                        <br>
                        Diplomado: <?php echo $t_diplomado; ?>
                        <br>
                        Especialización: <?php echo $t_especializacion; ?>
                    </td>
                    <td>
                        Magister: <?php echo $t_magister; ?>
                        <br>
                        Doctorado: <?php echo $t_doctorado; ?>
                        <br>
                        Phd: <?php echo $t_phd; ?>
                    </td>
                </tr>
            </table>    
            </fieldset>
        </td>
    </tr>
</table>

    <page_footer>
        <table class="footer_header" >
            <tr>
                <td>
                    <span>&copy; Derechos Reservados</span><br>
                </td>
            </tr>
        </table>
    </page_footer>
</page>