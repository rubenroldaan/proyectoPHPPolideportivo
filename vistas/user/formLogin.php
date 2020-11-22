<script type="text/javascript">
    function ejecutar_ajax() {
        peticion_http = new XMLHttpRequest();
        mail = document.getElementById("mail").value
        peticion_http.open('GET','http://localhost/egho/index.php?action=buscarUser&mail='+mail,true);

    }

    function procesa_respuesta() {
        if (peticion_http.readyState == 4) {
            if (peticion_http.status == 200) {
                if (peticion_http.responseText == "0")
                    document.getElementById('msjUser').innerHTML = "El usuario no existe.";
                    console.log("no")
                if (peticion_http.responseText == "1")
                    document.getElementById('msjUser').innerHTML = 'Usuario OK';
                    console.log("si")
            }
        }
    }
</script>-


<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span> <img src="imgs/logo.png" class="w-75" alt="Logo"> </span><br/>
            <span class="logo_title mt-5"> Iniciar sesión </span>
        </div>
        <div class="card-body">
            
            <form action="index.php" method="get">
                <?php
                        if (isset($data['msjError'])) {
                            echo '<p style="color:red">'.$data['msjError'].'</p>';
                        }
                        if (isset($data['msjInfo'])) {
                            echo '<p style="color:green">'.$data['msjInfo'].'</p>';
                        }
                    ?>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    
                    
                    <input type="text" name="mail" class="form-control" id="mail" placeholder="Correo electrónico" onblur="ejecutar_ajax()">
                </div>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <input type="hidden" name="action" value="procesarLogin">
                    <input type="submit" name="btn" value="Iniciar sesión" class="btn btn-outline-danger float-right login_btn">
                </div>
            </form>
        </div>
    </div>
</div>