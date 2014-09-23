<?php


mysql_select_db($database_sistemai, $sistemai);
$query_producto = sprintf("SELECT * FROM sis_productos");
$producto = mysql_query($query_producto, $sistemai) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);

mysql_select_db($database_sistemai, $sistemai);
$query_proveedor = sprintf("SELECT * FROM sis_factura_proveedor");
$proveedor = mysql_query($query_proveedor, $sistemai) or die(mysql_error());
$row_proveedor = mysql_fetch_assoc($proveedor);
$totalRows_proveedor = mysql_num_rows($proveedor);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; utf-8" />
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

<style>

#progress { position:relative; width:200px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
#bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
#percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>



<script src="js/jquery.form.js"></script> 
 
    <script> 
        $(document).ready(function() {  
			$('#message').hide();
			$('#msgerror').hide();
			$("#progress").hide();
		 	$("form").keypress(function(e) {
       			if (e.which == 13) {
            return false;
        	}
    		});


    $("#grabar").click(function(){
 			
	if($("#id_proveedor").val().length < 1) {  
        $('#msgerror').show();
        $("#msgerror p").html("<strong>Error!</strong> Debes agregar un Proveedor").show();
      

        return false;  
    } 		 

 	if($("#fecha_inventario").val().length < 2) {  
        $('#msgerror').show();
        $("#msgerror p").html("<strong>Error!</strong> Debes agregar una fecha a la Re-Compra").show();
      

        return false;  
    } 
   

  		
     });

    var options = { 
    beforeSend: function() 
    {
    	
    	//clear everything
    	$("#bar").width('0%');
		$("#percent").html("0%");
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
    	$("#progress").show();
    	$("#bar").width(percentComplete+'%');
    	$("#percent").html(percentComplete+'%');

    
    },
    success: function() 
    {
        $("#bar").width('100%');
    	$("#percent").html('100%');
    	$('#message').show();
            	$('#msgerror').hide();
                $("#message p").html("Guardado con Exito!").show();
                
                $('#myForm').hide();

                setTimeout(function() {
              url = "index.php?mod=gestor-recompra";
              $(location).attr('href',url);
              },1000);
    },
	complete: function(response) 
	{
				
	},
	error: function()
	{
		$("#msgerror").html("<font color='red'> ERROR: unable to upload files</font>");

	}
     
}; 

     $("#myForm").ajaxForm(options);

     	
        }); 


  

    </script> 

 <script>
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );

  
 
  $(function() {
    $( "#id_proveedor" ).combobox();
  
  });

  $(function() {
    $( "#id_producto1" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto1" ).toggle();
    });
  });

    $(function() {
    $( "#id_producto2" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto2" ).toggle();
    });
  });

      $(function() {
    $( "#id_producto3" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto3" ).toggle();
    });
  });

        $(function() {
    $( "#id_producto4" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto4" ).toggle();
    });
  });

          $(function() {
    $( "#id_producto5" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto5" ).toggle();
    });
  });

$(function() {
    $( "#id_producto6" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto6" ).toggle();
    });
  });

    $(function() {
    $( "#id_producto7" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto7" ).toggle();
    });
  });

      $(function() {
    $( "#id_producto8" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto8" ).toggle();
    });
  });

        $(function() {
    $( "#id_producto9" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto9" ).toggle();
    });
  });

          $(function() {
    $( "#id_producto10" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto10" ).toggle();
    });
  });

  $(function() {
    $( "#id_producto11" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto11" ).toggle();
    });
  });

    $(function() {
    $( "#id_producto12" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto12" ).toggle();
    });
  });

      $(function() {
    $( "#id_producto13" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto13" ).toggle();
    });
  });

        $(function() {
    $( "#id_producto14" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto14" ).toggle();
    });
  });

          $(function() {
    $( "#id_producto15" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#id_producto15" ).toggle();
    });
  });
  </script>

</head>
<body>

<center>
<br>

<div id="msgerror" class="alert alert-warning alert-dismissable" style="position:absolute;z-index:10 !important;right:5px;top: 144px;">
   <i class="fa fa-warning"></i><p></p></div>
<!-- FORMULARIO REGISTRO  -->
<div class="box box-warning" id="wtop">
     <div class="box-header">
            <h3 class="box-title">Nueva Re-Compra de Productos</h3>
     </div><!-- /.box-header -->
<div class="box-body" style="width:100%">

<form   id="myForm" method="POST" action="modules/facturacion/grabar-recompra.php"  enctype="multipart/form-data" >

<div class="box-formulario">
<table style="width:100%">
 		<tr>
 			<td>
 				<div class="input-group">
						<span class="input-group-addon"><strong >Proveedor</strong></span>		
						<select name="id_proveedor" id="id_proveedor" class="form-control fm" >
			          		<option value=""></option>
			         		<?php do { ?>
			          		<option value="<?php echo $row_proveedor['id']; ?>"><?php echo $row_proveedor['nombre_marca']; ?></option>
			          		<?php } while ($row_proveedor = mysql_fetch_assoc($proveedor));
					  		$rows = mysql_num_rows($proveedor);
					  	  	if($rows > 0) {
					      	mysql_data_seek($proveedor, 0);
						  	$row_proveedor = mysql_fetch_assoc($proveedor);
							}
						    ?>
			    	</select>
				</div>	
 			</td>	
 		</tr>	
		<tr>
			<td>
			<div class="input-group">
			<span class="input-group-addon"><strong >Fecha</strong></span>		
			<input class="form-control fm" type="date" id="fecha_inventario" placeholder="Fecha" name="fecha_inventario" value="" style="width:200px;" />
			</div>
			</td>
		</tr>
		

		<tr>
			<td>

			<div class="input-group" >
			  <span class="input-group-addon"><i><strong class="fa fa-th-large"></strong></i></span>		
			  <textarea  class="form-control fm" name="observaciones" id="observaciones" placeholder="Observaciones"  style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                      

			</div>
			</td>
		</tr>


		<tr>
			<td>

			<table>
				<tr>
					<td>Producto</td>
					<td>Precio Compra</td>
					<td>Cantidad</td>
				</tr>

				<?php $ptotal=$_GET['p']; $i=1; do{  ?>
				<tr>
					<td>
						<div class="input-group">
						<span class="input-group-addon"><i><strong class="fa fa-th-large"></strong></i></span>		
						<select name="id_producto<?php echo $i;?>" id="id_producto<?php echo $i;?>" class="form-control fm" >
			          		<option value=""></option>
			         		<?php do { ?>
			          		<option value="<?php echo $row_producto['id']; ?>"><?php $preciot=(($row_producto['precio']*$row_producto['margen'])/100)+$row_producto['precio']; echo $row_producto['cod_prod']." - ".$row_producto['nombre_prod']." (".$row_config['simbolo_moneda'].round($preciot,2)." - ".$row_producto['margen']."%)"; ?></option>
			          		<?php } while ($row_producto = mysql_fetch_assoc($producto));
					  		$rows = mysql_num_rows($producto);
					  	  	if($rows > 0) {
					      	mysql_data_seek($producto, 0);
						  	$row_producto = mysql_fetch_assoc($producto);
							}
						    ?>
			           	</select>
						</div>	
					</td>
					<td>
						<div class="input-group">
						<span class="input-group-addon"><i><strong class="fa fa-th-large"></strong></i></span>		
						<input class="form-control fm" type="text" id="precio_costo<?php echo $i;?>" placeholder="$" name="precio_costo<?php echo $i;?>" value="" style="width:120px;" />
						</div>
					</td>
					<td>
						<div class="input-group">
						<span class="input-group-addon"><i><strong class="fa fa-th-large"></strong></i></span>		
						<input class="form-control fm" type="number" id="cant<?php echo $i;?>" placeholder="Cant" name="cant<?php echo $i;?>" value="" style="width:80px;" />
						</div>
					</td>
				</tr>
				<input type="hidden" name="id_detalle<?php echo $i;?>" id="id_detalle<?php echo $i;?>" value="">
				<input type="hidden" name="ptotal" id="ptotal" value="<?php echo $ptotal;?>">

				<?php  $i++; } while ( $i <= $ptotal); ?>

			</table>	
			<a href="index.php?mod=nueva-recompra&p=<?php $temp=$_GET['p']+1; echo $temp;?>" id="mascampos">Agregar Otro Producto</a>
			</td>
		</tr>

		
	</table>
	
		 <div class="boton-modulo">

			<a href="index.php?mod=gestor-recompra" class="btn btn-danger btn-lg"><i class="glyphicon glyphicon-remove"></i><span> Cancelar</span></a>	&nbsp;&nbsp;&nbsp;	 <input type="submit" id="grabar" class="btn btn-primary btn-lg " value="Grabar" />

		</div>
	
</div>

    
       <input type="hidden" name="id_fact_inventario" id="id_fact_inventario" value="">
        
	
</form>  


<br/>
    


<!-- FIN DE NUEVO INGRESO -->	

<!-- FIN DE NUEVO INGRESO -->	
		<div id="message" class="alert alert-success alert-dismissable" style="position:relative;z-index:10 !important;">
		   <i class="fa fa-check"></i><p></p>
		   	 <div id="progress">
		        <div id="bar"></div>
		        <div id="percent">0%</div >
			</div>

		</div>
	
		<!-- FIN DE CLIENTE NUEVO INGRESO -->	
</div>


</div>


				
		</center>
     
		</body>
		</html>