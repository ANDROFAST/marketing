
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
<div class="col-sm-11">
  <h2>TU CUENTA</h2><hr>
 <div class="row">
     <div class="col-xs-5">
        <div class="form-group">
            <p>Correo</p>
            <input type="email" class="form-control" id="txtemail"> 
        </div>
    </div>
 </div>
  <a data-toggle="collapse" href="#demo">Cambiar contraseña</a><hr>
  <div id="demo" class="collapse">
      <div class="row">
        <div class="col-xs-4">
            <input type="password" class="form-control" id="usr" placeholder="Nueva contraseña"> 
        </div>
      </div><br>
      <div class="row">
        <div class="col-xs-4">
            <input type="password" class="form-control" id="usr" placeholder="Vuelva a escribir contraseña"> 
        </div>
      </div>
  </div>

  <div class="row">
    <div class="col-xs-4">
        <br>
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" id="btnagregar" 
            onclick="leerDatos()">ENVIAR 
        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
    </div>
  </div>
</div>
  
<script src="js/cliente.js" type="text/javascript"></script>

