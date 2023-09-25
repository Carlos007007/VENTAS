<div class="full-width navBar">
    <div class="full-width navBar-options">
        <i class="fas fa-exchange-alt fa-fw" id="btn-menu"></i> 
        <nav class="navBar-options-list">
            <ul class="list-unstyle">
                <li class="text-condensedLight noLink" >
                    <a class="btn-exit" href="<?php echo APP_URL."logOut/"; ?>" >
                        <i class="fas fa-power-off"></i>
                    </a>
                </li>
                <li class="text-condensedLight noLink" >
                    <small><?php echo $_SESSION['usuario']; ?></small>
                </li>
                <li class="noLink">
                    <?php
                        if(is_file("./app/views/fotos/".$_SESSION['foto'])){
                            echo '<img class="is-rounded img-responsive" src="'.APP_URL.'app/views/fotos/'.$_SESSION['foto'].'">';
                        }else{
                            echo '<img class="is-rounded img-responsive" src="'.APP_URL.'app/views/fotos/default.png">';
                        }
                    ?>
                </li>
            </ul>
        </nav>
    </div>
</div>