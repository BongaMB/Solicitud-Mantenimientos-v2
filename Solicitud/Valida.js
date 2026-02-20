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
        $('#idSoli').val('');
        $('#idModalidad').val('');    
        $('#idDep').val('');
        $('#id_Man').val('');
        $('#idRes').val('');
        $('#fechaR').val('');
        $('#descrip').val('');
        $('#encar').val('');
        $('#EM').val('');
        $('#obser').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#tiposer').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idSoli = $(this).attr("data-idSoli");
        var idModalidad = $(this).attr("data-idModalidad");
        var idDep = $(this).attr("data-idDep");
        var idman = $(this).attr("data-id_Man");
        var idRes = $(this).attr("data-idRes");
        var fechaR = $(this).attr("data-fechaR");
        var descrip = $(this).attr("data-descrip");
        var encar = $(this).attr("data-encar");
        var EM = $(this).attr("data-EM");
        var obser = $(this).attr("data-obser");
 
        $('#idSoli').val(idSoli);
        $('#idModalidad').val(idModalidad);
        $('#idModalidad').formSelect();
        $('#idDep').val(idDep);
        $('#idDep').formSelect();
        $('#id_Man').val(idman);
        $('#id_Man').formSelect();
        $('#idRes').val(idRes);
        $('#idRes').formSelect();
        $('#fechaR').val(fechaR);
        $('#descrip').val(descrip);
        $('#encar').val(encar);
        $('#encar').formSelect();
        $('#EM').val(EM);
        $('#obser').val(obser);
        
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#tiposer').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idSoli = $(this).attr("data-idSoli");
        var parametros = "idSoli=" + idSoli + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idSoli>0){
                        table.row('#' + data.idSoli).remove().draw();
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
            idSoli:{required:true},
            idModalidad:{required:true},
            idDep:{required:true},
            idRes:{required:true},
            fechaR:{required:true},
            descrip:{required:true},
            encar:{required:true},
            EM:{required:true},
            obser:{required:true},
            
        },
        messages: {
            idSoli:{required:"No puedes dejar este campo vacío"},
            idModalidad:{required:"No puedes dejar este campo vacío"},
            idDep:{required:"No puedes dejar este campo vacío"},
            idRes:{required:"No puedes dejar este campo vacío"},
            fechaR:{required:"No puedes dejar este campo vacío"},
            descrip:{required:"No puedes dejar este campo vacío"},
            encar:{required:"No puedes dejar este campo vacío"},
            EM:{required:"No puedes dejar este campo vacío"},
            obser:{required:"No puedes dejar este campo vacío"},

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
    var idSoli = $("#idSoli").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    var tipom = $("#idModalidad option:selected").text();
    var nombreDep = $("#idDep option:selected").text();
    var nombreRes = $("#idRes option:selected").text();
    var nomman = $("#id_Man option:selected").text();
    var encar = $("#encar option:selected").text();

    if (idSoli > 0){// a qui define si es una insercion o una ctualizacion
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
                //$('#idSoli').val('');
                //$('#idModalidad').val('');
                //$('#idDep').val('');
                //$('#id_Man').val('');
                //$('#idRes').val('');
                //$('#fechaR').val('');
                //$('#descrip').val('');
                //$('#encar').val('');
                //$('#EM').val('');
                //$('#obser').val('');
                limpiarFormulario(); // Llamo la funcion que se creo para que limpie todo lo que dice en el funcion


                $('#ventanaModal').modal('close');
                var data = respuesta['data'];// este data tiene todo lo que se declaro con el $post
                if (idSoli >0){
                    table.row('#' + data.idSoli).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([ //Luego lo vuelve agregar con su respectivo data , que ya trae todo lo del post
                    tipom,
                    nombreDep,
                    nomman,
                    nombreRes,
                    data.fechaR,
                    data.descrip,
                    encar,
                    data.EM,
                    data.obser,

                    '<i class="material-icons edit" data-idSoli="' + data.idSoli + '" data-tipom="' + tipom +'" data-nombreDep="' + nombreDep +'" data-nomman="' + nomman +'" data-nombreRes="' + nombreRes +'" data-fechaR="' + data.fechaR +'" data-descrip="' + data.descrip +'" data-encar="' + encar +'" data-EM="' + data.EM +'" data-obser="' + data.obser +'">create</i><i class="material-icons delete" data-idSoli="' + data.idSoli + '">delete_forever</i>' //boton para eliminar o actualizar dentro de la tabla con sus botones
                ]).draw().node();
                $(row).attr('id',data.idSoli);

                M.toast({html: 'Orden de trabajo Guardada', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}

function limpiarFormulario() {
    $('#formulario')[0].reset(); // limpia inputs y selects
    $('select').val('').formSelect(); // actualiza selects visualmente
    M.updateTextFields(); // actualiza etiquetas flotantes
}


