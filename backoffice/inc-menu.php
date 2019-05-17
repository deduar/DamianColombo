                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><span>Damian Colombo</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Bienvenido</span>
                            <h2><?php echo $_SESSION["nombreUsuario"];?></h2>

                        </div>
                        <hr>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

            <?php If ($_SESSION["nivel"]==0) { ?>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                        <br><br>
                            <ul class="nav side-menu">
                                <li><a href="#"><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron-down"></span></a>

                                    

                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="home.php?idWeb=6">Damian Colombo</a></li>
                                    </ul>



                                </li>
                                <li><a><i class="fa fa-edit"></i> Productos <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="productos-consulta.php">Editar</a>
                                        </li>
                                        <li><a href="producto-agregar.php">Agregar Articulo</a>
                                        </li>
                                        <li><a href="productos-orden.php?web=1">Orden Articulos</a>
                                        </li>
                                        
                                        <li><a href="producto-precios.php">Actualizar Precios</a>
                                        </li>
                                        <li><a href="productos-orden-destacados.php">Orden Destacados </a>  
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Dolar <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="dolar.php">Actualizar</a>
                                        </li>
                                        
                                       
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Pedidos <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="pedidos.php">Ultimos Pedidos</a>
                                        </li>
                                        <!--<li><a href="#">Alta Pedido</a>
                                        </li>
                                        <li><a href="#">Todos</a></li>-->
                                       
                                    </ul>
                                </li>
                               

                                <li><a><i class="fa fa-table"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="#">Listar Usuarios</a>
                                        </li>
                                        <li><a href="#">Agregar Usuario</a>
                                        </li>                                        
                                        
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-table"></i> Blog <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="blog-listar.php">Listar</a>
                                        </li>
                                        <li><a href="blog-agregar.php">Agregar</a>
                                        </li>                                        
                                        
                                    </ul>
                                </li>


                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->
            <?php }else{ ?>
                   <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="#"><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Productos <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="productos-consulta.php">Editar</a>
                                        </li>
                                        <li><a href="productos-listar-orden-outlet.php">Definir Orden</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->    
                <?php } ?>                

                   
                </div>