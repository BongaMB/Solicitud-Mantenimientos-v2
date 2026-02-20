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
        $('#idPer').val('');
        $('#nombrePer').val('');
        $('#correo').val('');
        $('#cargo').val('');
        $('#idDep').val('');
        $('#id_area').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#nombrePer').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idPer = $(this).attr("data-idPer");// con el this , jalamos todos los datos y en este caso jalamos ela caja de texto osea el input
        var nombrePer = $(this).attr("data-nombrePer");
        var correo = $(this).attr("data-correo");
        var cargo = $(this).attr("data-cargo");
        var idDep = $(this).attr("data-idDep");
        var idarea = $(this).attr("data-id_area");
        $('#idPer').val(idPer);
        $('#nombrePer').val(nombrePer);
        $('#correo').val(correo);
        $('#cargo').val(cargo);
        $('#idDep').val(idDep);
        $('#idDep').formSelect();
         $('#id_area').val(idarea);
        $('#id_area').formSelect();
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#nombrePer').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idPer = $(this).attr("data-idPer");
        var parametros = "idPer=" + idPer + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idPer>0){
                        table.row('#' + data.idPer).remove().draw();
                    }
                    M.toast({html: 'Empleado Eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{
            nombrePer:{required:true, minlength:1, maxlength:60},
            correo:{required:true, email:true},
            cargo:{required:true, minlength:1, maxlength:60},
            
        },
        messages: {
            nombrePer:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            correo:{required:"No puedes dejar este campo vacío", email:"Debes ingresar un correo"},
            cargo:{required:"No puedes dejar este campo vacío"},


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
    var idPer = $("#idPer").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    var nomdep = $("#idDep option:selected").text();
    var nomArea = $("#id_area option:selected").text();
    if (idPer > 0){// a qui define si es una insercion o una ctualizacion
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
                $('#idPer').val('');
                $('#nombrePer').val('');
                $('#correo').val('');
                $('#cargo').val('');
                $('#idDep').val('');
                $('#id_area').val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];// este data tiene todo lo que se declaro con el $post
                if (idPer >0){
                    table.row('#' + data.idPer).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([ //Luego lo vuelve agregar con su respectivo data , que ya trae todo lo del post
                    data.nombrePer,
                    data.correo,
                    data.cargo,
                    nomdep,
                    nomArea,
                    '<i class="material-icons edit" data-idPer="' + data.idPer + '" data-nombrePer="' + data.nombrePer +'" data-correo="' + data.correo +'" data-cargo="' + data.cargo +'" data-nomdep="' + nomdep +'" data-nomarea="' + nomArea + '" >create</i><i class="material-icons delete" data-idPer="' + data.idPer + '">delete_forever</i>' //boton para eliminar o actualizar dentro de la tabla con sus botones
                ]).draw().node();
                $(row).attr('id',data.idPer);

                M.toast({html: 'Empleado Guardado', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}
