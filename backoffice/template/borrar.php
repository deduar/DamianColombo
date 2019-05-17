"<table class='table table-striped responsive-utilities jambo_table bulk_action'>
                                        <thead>
                                            <tr class='headings'>
                                                <th class='column-title'>Código</th>
                                                <th class='column-title'>Descripción</th>
                                                <th class='column-title'>Cantidad</th>
                                                <th class='column-title'>Precio</th>
                                                <th class='column-title'>Desc.</th>
                                                <th class='column-title no-link last'><span class='nobr'>Total Prod.</span></th>

                                            </tr>

                                        </thead>

                                        <tbody>";
                                              <?$totalPrecio=0;

                                                $result = mysql_query('SELECT * FROM det_pedidos INNER JOIN productmain ON det_pedidos.id = productmain.idProductMain  WHERE det_pedidos.id_pedido=$id_pedido ORDER BY productmain.codigo');
                                              $cont=1;
                                              $total=0;
                                              while ($row = mysql_fetch_array($result)) { 
                                              
                                                  $codigo=$row['codigo'];
                                                              $cantidad=$row['cantidad'];
                                                              $fecha=$row['fecha'];
                                                              $descuento=$row['descuento'];
                                                              $estado=$row['estado'];
                                                              $precio=$row['precio'];
                                                              $subtotal=$cantidad*$precio;
                                                              If ($descuento>0){

                                                                $descuento2=($subtotal*$descuento)/100;
                                                                $subtotal=$subtotal-$descuento2;

                                                              }
                                                                $id_detpedido=$row['id_detpedido'];     
                                                                $descripcion=$row2['descripcion'];

                                                                $total=$total+$subtotal;

                                                                $totalProd2=$totalProd2+$subtotal;                                                                                                          
                                              
                                              
                                                if ($cont%2==0) { 
                                                    $est='TrBackoffice'; 
                                                } else { 
                                                    $est='TrBackofficeB'; 
                                                } 
                                              ?>
                                                <tr class='even pointer'>


                                                    <td class=' '><? echo $row['codigo']; ?></td>
                                                    <td class=' '><? echo $row['descripcion']; ?></td>
                                                    <td class=' '><? echo $row['cantidad']; ?></td>
                                                    <td class=' '>$ <? echo money_format('%(#10n', $precio);?></td>
                                                    <td class=' '>$ <? echo $descuento;?> %</td>

                                                    <td class=' '>$ <? echo money_format('%(#10n', $subtotal);?></td>           
                                                </tr>
                                            <? 
                                            $cont++;
                                            } 
                                            
                                            $subTotalPedido=$totalProd2;

                                            $descuentoTotal2=($totalProd2*$descuentoTotal)/100;
                                            $totalProd2=$totalProd2-$descuentoTotal2;
                                            $iva=($totalProd2*21)/100;
                                            $total=$totalProd2+$iva;
                                            ?>
                                                <tr>
                                            <td class=' '></td>
                                            <td></td>
                                            <td></td>
                                            <td class=' '>DESCUENTO S/TOTAL %</td>
                                            <td class=' '></td>              
                                            <td class=' '><? echo $descuentoTotal; ?> %</td>       
                                            <td></td>    
                                        </tr>
                                         <tr>
                                            <td class=' '></td>
                                            <td></td>
                                            <td></td>
                                            <td class=' '>SUB-TOTAL</td>
                                            <td class=' '></td>              
                                            <td class=' '>$ <? echo money_format('%(#10n', $subTotalPedido);?></td>       
                                            <td></td>    
                                        </tr>
                                        <tr>
                                            <td class=' '></td>
                                            <td></td>
                                            <td></td>
                                            <td class=' '>DESCUENTO S/TOTAL</td>
                                            <td class=' '></td>              
                                            <td class=' '>- ($ <? echo money_format('%(#10n', $descuentoTotal2);?>)</td>       
                                            <td></td>    
                                        </tr>                                        
                                        <tr>
                                            <td class=' '></td>
                                            <td></td>
                                            <td></td>
                                            <td class=' '>IVA</td>
                                            <td class=' '></td>              
                                            <td class=' '>$ <? echo money_format('%(#10n', $iva);?></td>           
                                            <td></td>
                                        </tr>             
                                        <tr>

                                            <td class=' '></td>
                                            <td></td>
                                            <td></td>
                                            <td class=' '>TOTAL</td>
                                            <td class=' '></td>              
                                            <td class=' '><strong>$ <? echo money_format('%(#10n', $total);?></strong></td>           
                                            <td></td>
                                        </tr>                                                                                             
                                        </tbody>

                                    </table> 