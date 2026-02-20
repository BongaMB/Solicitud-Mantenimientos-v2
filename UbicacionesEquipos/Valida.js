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
        $('#id_ubicacion').val('');
        $('#nom_ubi').val('');
        $('#descri').val('');    
        $('#idDep').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#nom_ubi').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idubi = $(this).attr("data-id_ubicacion");// con el this , jalamos todos los datos y en este caso jalamos ela caja de texto osea el input
        var nomubi = $(this).attr("data-nom_ubi");
        var descri = $(this).attr("data-descri");
        var iddep = $(this).attr("data-idDep");
        $('#id_ubicacion').val(idubi);
        $('#nom_ubi').val(nomubi);
        $('#descri').val(descri);
        $('#idDep').val(iddep);
        $('#idDep').formSelect();
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#nom_ubi').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idubi = $(this).attr("data-id_ubicacion");
        var parametros = "id_ubicacion=" + idubi + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idubi>0){
                        table.row('#' + data.id_ubicacion).remove().draw();
                    }
                    M.toast({html: 'Ubicacion Eliminada', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{
            nom_ubi:{required:true, minlength:1, maxlength:60},
            descri:{required:true, minlength:1, maxlength:60},
            idDep:{required:true, minlength:1, maxlength:10},
            
            
        },
        messages: {
            nom_ubi:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            descri:{required:"No puedes dejar este campo vacío"},
            idDep:{required:"No puedes dejar este campo vacío"},
            


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
    var idubi = $("#id_ubicacion").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    var nomdep = $("#idDep option:selected").text();
    if (idubi > 0){// a qui define si es una insercion o una ctualizacion
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
                $('#id_ubicacion').val('');
                $('#nom_ubi').val('');
                $('#descri').val('');
                $('#idDep').val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];// este data tiene todo lo que se declaro con el $post
                if (idubi >0){
                    table.row('#' + data.id_ubicacion).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([
                    data.nom_ubi,
                    data.descri,
                    nomdep,
                    '<i class="material-icons edit" data-idubi="' + data.id_ubicacion + '" data-nom_ubi="' + data.nom_ubi +'" data-descri="' + data.descri +'" data-nomdep="' + nomdep +'" >create</i>' +
                    '<i class="material-icons delete" data-idubi="' + data.id_ubicacion + '">delete_forever</i>'
                    ]).draw().node();

                $(row).attr('id',data.id_ubicacion);

                M.toast({html: 'Ubicacion Guardada', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}
