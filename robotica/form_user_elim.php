<?php 
    function form_user_elim()
    {
?>
<!-- eliminar modal-->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_all" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="alert">
                        <h4 class="modal-title">Confimar Usuario</h4>
                      </div>
                      <div class="modal-body">
                      <table width="100%" align="center">
                      <tr>
                      <td align="center">
                      <label>Nombre de Usuario</label>
                      <input readonly="" disabled="" type="text" class="form-control" style="width:20%;" id="username_confirm" value="<?php echo $_SESSION['nom_usuario']; ?>">
                      </td>
                      </tr>
                      <tr>
                      <td align="center">
                      <label>Contraseña</label>
                      <input  type="password" id="password" name="pass" class="form-control" style="width:20%;">
                      </td>
                      </tr>
                      </table>


                      </div>
                      <div class="modal-footer">


                        <button class="btn btn-primary" title="Aceptar" onclick="validando_usuario_elim()">Aceptar</button>

                    </div>
                  </div>
                </div>
              </div>
  

               <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_all_error" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <h4 class="modal-title">Confimar Usuario</h4>
                      </div>
                      <div class="modal-body">
                                 <h4 style="color:#000;">Error en la Contraseña</h4>                            


                      </div>
                      <div class="modal-footer">


                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal"  >Aceptar</button>

                    </div>
                  </div>
                </div>
              </div>
<?php
    }
?>
           