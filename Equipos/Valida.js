$(init);
var table = null;
var controlador = "controlador.php";

function init()
{
    table = $('#dtTable').DataTable({ //Se define cuantosregistros va a mostrar con esto
        "aLengthMenu" : [[10,25,50,75,100],[10,25,50,75,100]],
        "iDisplayLength" : 15
    });
    $('#ventanaModal').modal();
    validateForm();

    $('#add').on("click", function(){ //pertenece al boton de "+"
        $('#idEq').val('');
        $('#nom').val('');
        $('#idTip').val('');    
        $('#marca').val('');
        $('#modelo').val('');
        $('#serial').val('');
        $('#id_ubicacion').val('');
        $('#estado').val('');
        $('#fechaad').val('');
       
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#nom').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idequi = $(this).attr("data-idEq");// con el this , jalamos todos los datos y en este caso jalamos ela caja de texto osea el input
        var nom = $(this).attr("data-nom");
        var idtip = $(this).attr("data-idTip");
        var marca = $(this).attr("data-marca");
        var modelo = $(this).attr("data-modelo");
        var serial = $(this).attr("data-serial");
        var idubi = $(this).attr("data-id_ubicacion");
        var estado = $(this).attr("data-estado");
        var fechaad = $(this).attr("data-fechaad");
        
        
 
        
        $('#idEq').val(idequi);
        $('#nom').val(nom);
        $('#idTip').val(idtip);
        $('#idTip').formSelect();
        $('#marca').val(marca);
        $('#modelo').val(modelo);
        $('#serial').val(serial);
        $('#id_ubicacion').val(idubi);
        $('#id_ubicacion').formSelect();
        $('#estado').val(estado);
        $('#fechaad').val(fechaad);
        

        
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#nom').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idequi = $(this).attr("data-idEq");
        var parametros = "idEq=" + idequi + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idequi>0){
                        table.row('#' + data.idEq).remove().draw();
                    }
                    M.toast({html: 'Equipo Eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{
            nom:{required:true},
            idTip:{required:true},
            marca:{required:true},
            modelo:{required:true},
            serial:{required:true},
            id_ubicacion:{required:true},
            fechaad:{required:true},
            estado:{required:true},
    
            
        },
        messages: {
            nom:{required:"No puedes dejar este campo vacío"},
            idTip:{required:"No puedes dejar este campo vacío"},
            marca:{required:"No puedes dejar este campo vacío"},
            modelo:{required:"No puedes dejar este campo vacío"},
            serial:{required:"No puedes dejar este campo vacío"},
            id_ubicacion:{required:"No puedes dejar este campo vacío"},
            fechaad:{required:"No puedes dejar este campo vacío"},
            estado:{required:"No puedes dejar este campo vacío"},
            

        },
        errorElement: "div",
        errorClass: "invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)                
        },
        submitHandler: function(form){ // si es correcta la validacion , este lo guardara
            guardarRegistro();
        }
    });
}

function guardarRegistro(){ // este lo guarada
    var idequi = $("#idEq").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    var tipo = $("#idTip option:selected").text();
    var idubi = $("#id_ubicacion option:selected").text();

    if (idequi > 0){// a qui define si es una insercion o una ctualizacion
        parametros = parametros + "&accion=Act";
    }
    else{
        parametros = parametros + "&accion=Ins";
    }
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                $('#idEq').val('');
                $('#nom').val('');
                $('#idTip').val('');
                $('#marca').val('');
                $('#modelo').val('');
                $('#serial').val('');
                $('#id_ubicacion').val('');
                $('#estado').val('');
                $('#fechaad').val('');
                
             

                $('#ventanaModal').modal('close');
                var data = respuesta['data'];// este data tiene todo lo que se declaro con el $post
                if (idequi >0){
                    table.row('#' + data.idEq).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([ //Luego lo vuelve agregar con su respectivo data , que ya trae todo lo del post
                    data.nom,
                    tipo,
                    data.marca,
                    data.modelo,
                    data.serial,
                    idubi,
                    data.estado,
                    data.fechaad,
                    

                    '<i class="material-icons edit" data-idEq="' + data.idEq + '" data-nom="' + data.nom +'" data-idTip="' + data.idTip +'" data-marca="' + data.marca +'" data-modelo="' + data.modelo +'" data-serial="' + data.serial +'" data-id_ubicacion="' + data.id_ubicacion +'" data-estado="' + data.estado +'" data-fechaad="' + data.fechaad +'">create</i><i class="material-icons delete" data-idEq="' + data.idEq + '">delete_forever</i>' //boton para eliminar o actualizar dentro de la tabla con sus botones
                ]).draw().node();
                $(row).attr('id',data.idEq);

                M.toast({html: 'Equipo Guardado', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}
