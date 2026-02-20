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
        $('#id_area').val('');
        $('#nomArea').val('');
        $('#idDep').val('');    
        $('#dire').val('');
        $('#subdir').val('');
        $('#direfi').val('');
        $('#oficina').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#nomArea').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idarea = $(this).attr("data-id_area");// con el this , jalamos todos los datos y en este caso jalamos ela caja de texto osea el input
        var nomarea = $(this).attr("data-nomArea");
        var idDep = $(this).attr("data-idDep");
        var dire = $(this).attr("data-dire");
        var subdir = $(this).attr("data-subdir");
        var dirf = $(this).attr("data-direfi");
        var oficina = $(this).attr("data-oficina");
        $('#id_area').val(idarea);
        $('#nomArea').val(nomarea);
        $('#idDep').val(idDep);
        $('#idDep').formSelect();
        $('#dire').val(dire);
        $('#subdir').val(subdir);
        $('#direfi').val(dirf);
        $('#oficina').val(oficina);
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#nomArea').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idarea = $(this).attr("data-id_area");
        var parametros = "id_area=" + idarea + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idarea>0){
                        table.row('#' + data.id_area).remove().draw();
                    }
                    M.toast({html: 'Area Eliminada', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{
            nomArea:{required:true, minlength:4, maxlength:60},
            dire:{required:true, minlength:1, maxlength:60},
            subdir:{required:true},
            direfi:{required:true, minlength:4, maxlength:60},
            oficina:{required:true, minlength:4, maxlength:60},
            
        },
        messages: {
            nomArea:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            dire:{required:"No puedes dejar este campo vacío"},
            subdir:{required:"No puedes dejar este campo vacío"},
            direfi:{required:"No puedes dejar este campo vacío"},
            oficina:{required:"No puedes dejar este campo vacío"},

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
    var idarea = $("#id_area").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    var nomdep = $("#idDep option:selected").text();
    if (idarea > 0){// a qui define si es una insercion o una ctualizacion
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
                $('#id_area').val('');
                $('#nomArea').val('');
                $('#idDep').val('');
                $('#dire').val('');
                $('#subdir').val('');
                $('#direfi').val('');
                $('#oficina').val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];// este data tiene todo lo que se declaro con el $post
                if (idarea >0){
                    table.row('#' + data.id_area).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([
                    data.nomArea,
                    nomdep,
                    data.dire,
                    data.subdir,
                    data.direfi,
                    data.oficina,
                    '<i class="material-icons edit" data-id_area="' + data.id_area + '" data-nomArea="' + data.nomArea + '" data-nomdep="' + nomdep +'" data-dire="' + data.dire + '" data-subdir="' + data.subdir + '" data-direfi="' + data.direfi + '" data-oficina="' + data.oficina + '">create</i>' +
                    '<i class="material-icons delete" data-id_area="' + data.id_area + '">delete_forever</i>'
                    ]).draw().node();

                $(row).attr('id', data.id_area);

                M.toast({html: 'Area Guardada', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}
