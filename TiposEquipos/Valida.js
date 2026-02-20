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
        $('#idTip').val('');
        $('#nomTip').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#nomTip').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idtip = $(this).attr("data-idTip");// con el this , jalamos todos los datos y en este caso jalamos ela caja de texto osea el input
        var nomtip = $(this).attr("data-nomTip");
        $('#idTip').val(idtip);
        $('#nomTip').val(nomtip);
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#nomTip').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idtip = $(this).attr("data-idTip");
        var parametros = "idTip=" + idtip + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idtip>0){
                        table.row('#' + data.idTip).remove().draw();
                    }
                    M.toast({html: 'Tipo de Equipo Eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{
            nomTip:{required:true, minlength:3, maxlength:60},
            
        },
        messages: {
            nomTip:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 3 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            
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
    var idtip = $("#idTip").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    if (idtip > 0){// a qui define si es una insercion o una ctualizacion
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
                $('#idTip').val('');
                $('#nomTip').val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];// este data tiene todo lo que se declaro con el $post
                if (idtip >0){
                    table.row('#' + data.idTip).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([ //Luego lo vuelve agregar con su respectivo data , que ya trae todo lo del post
                    data.nomTip,
                    '<i class="material-icons edit" data-idTip="' + data.idTip + '" data-nomTip="' + data.nomTip +'">create</i><i class="material-icons delete" data-idTip="' + data.idTip + '">delete_forever</i>' //boton para eliminar o actualizar dentro de la tabla con sus botones
                ]).draw().node();
                $(row).attr('id',data.idTip);

                M.toast({html: 'Tipo de Equipo/mobiliario Guardado', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}
