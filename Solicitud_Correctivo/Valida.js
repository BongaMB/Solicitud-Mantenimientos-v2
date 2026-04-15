$(init);
var table = null;
var controlador = "controlador.php";

function init()
{

    //Botones aceptar y rechazar
    // Evento Aceptar
$(document).on("click", '.btn-aceptar', function() {
    var idCorr = $(this).attr("data-idCorr");
    if(confirm("¿Desea ACEPTAR esta solicitud?")) {
        procesarEstado(idCorr, 'Aceptado');
    }
});

// Evento Rechazar
$(document).on("click", '.btn-rechazar', function() {
    var idCorr = $(this).attr("data-idCorr");
    if(confirm("¿Desea RECHAZAR esta solicitud?")) {
        procesarEstado(idCorr, 'Rechazado');
    }
});


//Fin de lo botones Aceptar y Rechazar

    table = $('#dtTable').DataTable({ //Se define cuantosregistros va a mostrar con esto
        "aLengthMenu" : [[10,25,50,75,100],[10,25,50,75,100]],
        "iDisplayLength" : 15
    });
    $('#ventanaModal').modal();
    validateForm();

    $('#add').on("click", function(){ //pertenece al boton de "+"
        $('#idCorr').val('');
        $('#idDep').val('');    
        $('#id_area').val('');
        $('#idPer').val('');
        $('#fechaR').val('');
        $('#descrip').val('');
        $('#ventanaModal').modal('open'); // abre la ventana modal
        $('#idDep').focus();
    });

    $('#btnGuardar').on("click", function(){ // este boton lo vemos en el index.php y manda el evento submit , pero para eso tiene que validarse
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){ // el document jala todo lo del index, si en el docuemnto en el evento click donde ahi elementos con el evento edit
        var idCorr = $(this).attr("data-idCorr");
        var idDep = $(this).attr("data-idDep");
        var idarea = $(this).attr("data-id_area");
        var idper = $(this).attr("data-idPer");
        var fechaR = $(this).attr("data-fechaR");
        var descrip = $(this).attr("data-descrip");
 
        $('#idCorr').val(idCorr);
        $('#idDep').val(idDep);
        $('#idDep').formSelect();
        $('#id_area').val(idarea);
        $('#id_area').formSelect();
        $('#idPer').val(idper);
        $('#idPer').formSelect();
        $('#fechaR').val(fechaR);
        $('#descrip').val(descrip);
        M.updateTextFields();// con uptadeTextFields , recorre las etiquetas dentro del input 
        $('#ventanaModal').modal('open');// abrimos la venta modal
        $('#idDep').focus();//pone el cursor en el nomc
    });

    $(document).on("click", '.delete', function()// es lo mismo que el de "edit" pero ahora con el evento delete
    {
        var idCorr = $(this).attr("data-idCorr");
        var parametros = "idCorr=" + idCorr + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idCorr>0){
                        table.row('#' + data.idCorr).remove().draw();
                    }
                    M.toast({html: 'Solicitud Eliminada', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){ // esto es la validacion del formulario
    $('#formulario').validate({
        rules:{            
            idDep:{required:true},
            id_area:{required:true},
            idPer:{required:true},
            fechaR:{required:true},
            descrip:{required:true},
            
        },
        messages: {
            idDep:{required:"No puedes dejar este campo vacío"},
            id_area:{required:"No puedes dejar este campo vacío"},
            idPer:{required:"No puedes dejar este campo vacío"},
            fechaR:{required:"No puedes dejar este campo vacío"},
            descrip:{required:"No puedes dejar este campo vacío"},

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
    var idCorr = $("#idCorr").val();  
    var parametros = $("#formulario").serialize(); //serializa los datos que traen los datos
    var nombreDep = $("#idDep option:selected").text();
    var nombreArea = $("#id_area option:selected").text();
    var nomper = $("#idPer option:selected").text();

    if (idCorr > 0){// a qui define si es una insercion o una ctualizacion
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
                if (idCorr >0){
                    table.row('#' + data.idCorr).remove().draw();//jala todo lo del data en el idclasific
                }
                var row = table.row.add([ //Luego lo vuelve agregar con su respectivo data , que ya trae todo lo del post
                    nombreDep,
                    nombreArea,
                    nomper,
                    data.fechaR,
                    data.descrip,

                    '<i class="material-icons edit" data-idCorr="' + data.idCorr + '" data-nomdep="' + nombreDep +'" data-nomarea="' + nombreArea +'" data-nomper="' + nomper +'" data-fechaR="' + data.fechaR +'" data-descrip="' + data.descrip +'" >create</i><i class="material-icons delete" data-idCorr="' + data.idCorr + '">delete_forever</i>'+ //boton para eliminar o actualizar dentro de la tabla con sus botones
                    ' <i class="material-icons btn-aceptar green-text" style="cursor:pointer" data-idCorr="' + data.idCorr + '">check_circle</i>' +
                    ' <i class="material-icons btn-rechazar red-text" style="cursor:pointer" data-idCorr="' + data.idCorr + '">cancel</i>'
                ]).draw().node();
                $(row).attr('id',data.idCorr);

                //Aplicar color naranja por defecto a la nueva fila permanente
                $(row).css('background-color', '#FFE0B2');

                M.toast({html: 'solicitud de mantenimiento Guardada', classes: 'rounded blue lighten-2'});

            }
        } 
    });
}

function limpiarFormulario() {
    $('#formulario')[0].reset(); // limpia inputs y selects
    $('select').val('').formSelect(); // actualiza selects visualmente
    M.updateTextFields(); // actualiza etiquetas flotantes
}

//Funcion para los botones // Función auxiliar para enviar al controlador
function procesarEstado(id, estado) {
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: { idCorr: id, accion: 'Estado', nuevoEstado: estado },
        success: function(respuesta) {
            if (respuesta.status == 1) {
                M.toast({html: 'Solicitud ' + estado, classes: 'blue'});
                
                var bgColor = "";
                var txtColor = "black";
                
                if(estado == 'Aceptado') {
                    bgColor = "#C8E6C9";
                } else if(estado == 'Rechazado') {
                    bgColor = "#FFCDD2";
                    txtColor = "white";
                } else {
                    bgColor = "#FFE0B2";
                }

                // Forzamos el estilo directamente en el atributo para que sea inmediato
                $('#' + id).attr('style', 'background-color: ' + bgColor + ' !important; color: ' + txtColor + ' !important;');
                
            } else {
                M.toast({html: 'Error al actualizar estado', classes: 'rounded red'});
            }
        }
    });
}   


