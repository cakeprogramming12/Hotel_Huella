<nav class="ts-sidebar">
    <ul class="ts-sidebar-menu">

        <li class="ts-label">ConfiguroWeb</li>
        <?PHP if(isset($_SESSION['id']))
				{ ?>
        <li><a href="http://localhost/Holiday_Inn_Express_Toluca/Registro/dashboard.php"><i
                    class="fa fa-desktop"></i>Consola</a>
        </li>
        <li><a href="http://localhost/Holiday_Inn_Express_Toluca/Registro/my-profile.php"><i class="fa fa-user"></i> Mi
                Perfil</a></li>
        <li><a href="http://localhost/Holiday_Inn_Express_Toluca/Registro/change-password.php"><i
                    class="fa fa-files-o"></i>Cambiar Contraseña</a></li>
        <li><a href="factura.php"><i class="fa fa-file-o"></i>Detalles de tu
                reserva</a></li>
        <li><a href="http://localhost/Holiday_Inn_Express_Toluca/Registro/access-log.php"><i
                    class="fa fa-file-o"></i>Registro de
                Acceso</a></li>

        <li><a href="http://localhost/Holiday_Inn_Express_Toluca/Registro/reservacion.php"><i
                    class="fa fa-file-o"></i>Hacer una
                reserva</a></li>


        <?php } else { ?>

        <li><a href="registration.php"><i class="fa fa-files-o"></i> Registro de Usuario</a></li>
        <li><a href="index.php"><i class="fa fa-users"></i> Ingreso de Usuario</a></li>
        <li><a href="admin"><i class="fa fa-user"></i> Acceso de Administrador</a></li>
        <li><a href="cleaner"><i class="fa fa-user"></i> Acceso de Personal de limpieza</a></li>
        <li><a href="superuser"><i class="fa fa-user"></i> Super usuario</a></li>
        <?php } ?>

    </ul>
</nav>