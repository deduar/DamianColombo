<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="filter-menu text-left">
            <a href="javascript:void(0);">Filtros</a>
        </div>
    </div>
</div>
<div class="row filter-active">
    <div class="col-12">
        <div class="filter-wrap">
                
                <form action="catalogo.php?codCategoria=<?php echo $codCategoria; ?>&codSubCategoria=<?php echo $codSubCategoria;?>" method="POST">
                <input type="hidden" name="fl" value="1">
                <div class="row">
                    <div class="product-filter col-lg-3 col-sm-6 col-12">
                        <h3 class="filter-title">Tipo Metal</h3>
                        <?php comboTipoMetal(1); ?>
                    </div>
                    <!-- Product Filter -->
                    <div class="product-filter col-lg-3 col-sm-6 col-12">
                        <h3 class="filter-title">Tipo Piedra</h3>
                        <?php comboTipoPiedra(2, 1); ?>
                    </div>
                    <!-- Product Filter -->
                    <div class="product-filter col-lg-3 col-sm-6 col-12">

                        <h3 class="filter-title">Filtrar por Precio</h3>
                        <div class="filter-price">
                            
                                <div id="slider-range"></div>
                                <div class="row">
                                    <div class="col-12">
                                        <p>Precio :<br>
                                            <input type="text" name="precio" id="amount">
                                        </p>
                                    </div>
                                    
                                </div>
                        </div>
                    </div>
                    <div class="product-filter col-lg-3 col-sm-6 col-12">
                        <div class="contact-form form-style">
                            <button type="submit" name="submit">Filtrar</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

