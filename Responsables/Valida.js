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
        $('#idRes').val('');
        $('#nombreRes').val('');
        $('#correo').val('');    
        $('#tel').val('');
        $('#encar').val('');
        $('#PR').val('');
        $('#idDep').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#nombreRes').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idRes = $(this).attr("data-idRes");// con el this , jalamos todos los datos y en este caso jalamos ela caja de texto osea el input
        var nombreRes = $(this).attr("data-nombreRes");
        var correo = $(this).attr("data-correo");
        var tel = $(this).attr("data-tel");
        var encar = $(this).attr("data-encar");
        var PR = $(this).attr("data-PR");
        var idDep = $(this).attr("data-idDep");
        $('#idRes').val(idRes);
        $('#nombreRes').val(nombreRes);
        $('#correo').val(correo);
        $('#tel').val(tel);
        $('#encar').val(encar);
        $('#PR').val(PR);
        $('#idDep').val(idDep);
        $('#idDep').formSelect();
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#nombreRes').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idRes = $(this).attr("data-idRes");
        var parametros = "idRes=" + idRes + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idRes>0){
                        table.row('#' + data.idRes).remove().draw();
                    }
                    M.toast({html: 'Responsable Eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{
            nombreRes:{required:true, minlength:1, maxlength:60},
            correo:{required:true, minlength:1, maxlength:60},
            tel:{required:true, minlength:1, maxlength:10},
            encar:{required:true},
            PR:{required:true, minlength:1, maxlength:60},
            
        },
        messages: {
            nombreRes:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            correo:{required:"No puedes dejar este campo vacío"},
            tel:{required:"No puedes dejar este campo vacío"},
            encar:{required:"No puedes dejar este campo vacío"},
            PR:{required:"No puedes dejar este campo vacío"},


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
    var idRes = $("#idRes").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    var nomdep = $("#idDep option:selected").text();
    if (idRes > 0){// a qui define si es una insercion o una ctualizacion
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
                $('#idRes').val('');
                $('#nombreRes').val('');
                $('#correo').val('');
                $('#tel').val('');
                $('#encar').val('');
                $('#PR').val('');
                $('#idDep').val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];// este data tiene todo lo que se declaro con el $post
                if (idRes >0){
                    table.row('#' + data.idRes).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([ //Luego lo vuelve agregar con su respectivo data , que ya trae todo lo del post
                    data.nombreRes,
                    data.correo,
                    data.tel,
                    data.encar,
                    data.PR,
                    nomdep,
                    '<i class="material-icons edit" data-idRes="' + data.idRes + '" data-nombreRes="' + data.nombreRes +'" data-correo="' + data.correo +'" data-tel="' + data.tel +'" data-encar="' + data.encar +'" data-PR="' + data.PR +'" data-nomdep="' + nomdep +'">create</i><i class="material-icons delete" data-idRes="' + data.idRes + '">delete_forever</i>' //boton para eliminar o actualizar dentro de la tabla con sus botones
                ]).draw().node();
                $(row).attr('id',data.idRes);

                M.toast({html: 'Empleado Guardado', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}
