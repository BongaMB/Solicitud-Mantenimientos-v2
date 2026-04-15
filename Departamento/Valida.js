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
        $('#idDep').val('');
        $('#nombreDep').val('');
        $('#correoDep').val('');
        $('#telefono').val('');
        $('#idjefe').val('');
        $('#id_area').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#nombreDep').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var iddep = $(this).attr("data-idDep");// con el this , jalamos todos los datos y en este caso jalamos ela caja de texto osea el input
        var nomdep = $(this).attr("data-nombreDep");
        var correo = $(this).attr("data-correoDep");
        var tel = $(this).attr("data-telefono");
        var idjefe = $(this).attr("data-idjefe");
        var area = $(this).attr("data-id_area");
        $('#idDep').val(iddep);
        $('#nombreDep').val(nomdep);
        $("#correoDep").val(correo);
        $("#telefono").val(tel);
        $("#idjefe").val(idjefe);
        $("#idjefe").formSelect();
        $("#id_area").val(area);
        $("#id_area").formSelect();
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#nombreDep').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idDep = $(this).attr("data-idDep");
        var parametros = "idDep=" + idDep + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idDep>0){
                        table.row('#' + data.idDep).remove().draw();
                    }
                    M.toast({html: 'Departamento Eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{
            nombreDep:{required:true, minlength:4, maxlength:60},
            correoDep:{required:true, minlength:1, maxlength:60},
            telefono:{required:true, digits:true},
            Encargado:{required:true, minlength:4, maxlength:60},
        },
        messages: {
            nombreDep:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            correoDep:{required:"No puedes dejar este campo vacío"},
            telefono:{required:"No puedes dejar este campo vacío"},
            Encargado:{required:"No puedes dejar este campo vacío"},
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
    var iddep = $("#idDep").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    var nom = $("#idjefe option:selected").text();
    var nomArea = $("#id_area option:selected").text();
    if (iddep > 0){// a qui define si es una insercion o una ctualizacion
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
                if (iddep >0){
                    table.row('#' + data.idDep).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([ //Luego lo vuelve agregar con su respectivo data , que ya trae todo lo del post
                    data.nombreDep,
                    data.correoDep,
                    data.telefono,
                    nom,
                    nomArea,
                    '<i class="material-icons edit" data-idDep="' + data.idDep + '" data-nombreDep="' + data.nombreDep +'" data-correoDep="' + data.correoDep + '" data-telefono="' + data.telefono +'" data-nom="' + nom + '" data-nomarea="' + nomArea + '">create</i><i class="material-icons delete" data-idDep="' + data.idDep + '">delete_forever</i>' //boton para eliminar o actualizar dentro de la tabla con sus botones
                ]).draw().node();
                $(row).attr('id',data.idDep);

                M.toast({html: 'Departamento Guardado', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}


    function limpiarFormulario() {
        $('#formulario')[0].reset(); // limpia inputs y selects
        $('select').val('').formSelect(); // actualiza selects visualmente
        M.updateTextFields(); // actualiza etiquetas flotantes
    }
