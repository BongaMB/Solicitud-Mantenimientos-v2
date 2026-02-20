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
        $('#idModalidad').val('');
        $('#tipo').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#tipo').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idMod = $(this).attr("data-idModalidad");// con el this , jalamos todos los datos y en este caso jalamos ela caja de texto osea el input
        var tipo = $(this).attr("data-tipo");
        $('#idModalidad').val(idMod);
        $('#tipo').val(tipo);
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#tipo').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idModalidad = $(this).attr("data-idModalidad");
        var parametros = "idModalidad=" + idModalidad + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idModalidad>0){
                        table.row('#' + data.idModalidad).remove().draw();
                    }
                    M.toast({html: 'Modalidad Eliminada', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{
            tipo:{required:true, minlength:1, maxlength:60},
        },
        messages: {
            tipo:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
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
    var idMod = $("#idModalidad").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    if (idMod > 0){// a qui define si es una insercion o una ctualizacion
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
                $('#idModalidad').val('');
                $('#tipo').val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];// este data tiene todo lo que se declaro con el $post
                if (idMod >0){
                    table.row('#' + data.idModalidad).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([ //Luego lo vuelve agregar con su respectivo data , que ya trae todo lo del post
                    data.tipo,
                    '<i class="material-icons edit" data-idModalidad="' + data.idModalidad + '" data-tipo="' + data.tipo +'">create</i><i class="material-icons delete" data-idModalidad="' + data.idModalidad + '">delete_forever</i>' //boton para eliminar o actualizar dentro de la tabla con sus botones
                ]).draw().node();
                $(row).attr('id',data.idModalidad);

                M.toast({html: 'Departamento Guardado', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}
