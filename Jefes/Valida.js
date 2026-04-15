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
        $('#idjefe').val('');
        $('#nom').val('');
        $('#correo').val('');
        $('#tel').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#nom').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idjefe = $(this).attr("data-idjefe");// con el this , jalamos todos los datos y en este caso jalamos ela caja de texto osea el input
        var nom = $(this).attr("data-nom");
        var correo = $(this).attr("data-correo");
        var tel = $(this).attr("data-tel");
        $('#idjefe').val(idjefe);
        $('#nom').val(nom);
        $('#correo').val(correo);
        $('#tel').val(tel);
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#nom').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idjefe = $(this).attr("data-idjefe");
        var parametros = "idjefe=" + idjefe + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idjefe>0){
                        table.row('#' + data.idjefe).remove().draw();
                    }
                    M.toast({html: 'Jefe Eliminada', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{
            
        },
        messages: {
            
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
    var idjefe = $("#idjefe").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    if (idjefe> 0){// a qui define si es una insercion o una ctualizacion
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

                limpiarFormulario(); // Llamo la funcion que se creo para que limpie todo lo que dice en el funcion
                $('#ventanaModal').modal('close');

                var data = respuesta['data'];// este data tiene todo lo que se declaro con el $post
                if (idjefe >0){
                    table.row('#' + data.idjefe).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([ //Luego lo vuelve agregar con su respectivo data , que ya trae todo lo del post
                    data.nom,
                    data.correo,
                    data.tel,
                    '<i class="material-icons edit" data-idjefe="' + data.idjefe + '" data-nom="' + data.nom +'" data-correo="' + data.correo +'" data-tel="' + data.tel +'">create</i><i class="material-icons delete" data-idjefe="' + data.idjefe + '">delete_forever</i>' //boton para eliminar o actualizar dentro de la tabla con sus botones
                ]).draw().node();
                $(row).attr('id',data.idjefe);

                M.toast({html: 'Jefe de departamento guardado', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}

function limpiarFormulario() {
    $('#formulario')[0].reset(); // limpia inputs y selects
    $('select').val('').formSelect(); // actualiza selects visualmente
    M.updateTextFields(); // actualiza etiquetas flotantes
}
