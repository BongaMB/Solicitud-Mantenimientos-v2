$(init);
var table = null;
var controlador = "controlador.php";

function init()
{

    
    table = $('#dtTable').DataTable({
        "aLengthMenu" : [[10,25,50,75,100],[10,25,50,75,100]],
        "iDisplayLength" : 15
    });
    $('#ventanaModal').modal();
    validateForm();

    $('#add').on("click", function(){
        $('#idSoli').val('');
        $('#idModalidad').val('');    
        $('#idDep').val('');
        $('#id_Man').val('');
        $('#idPer').val('');
        $('#fechaR').val('');
        $('#descrip').val('');
        $('#em').val('');
        $('#obser').val('');
        $('#ventanaModal').modal('open');
        $('#tiposer').focus();
    });

    $('#btnGuardar').on("click", function(){
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){
        var idSoli = $(this).attr("data-idSoli");
        var idModalidad = $(this).attr("data-idModalidad");
        var idDep = $(this).attr("data-idDep");
        var idman = $(this).attr("data-id_Man");
        var idPer = $(this).attr("data-idPer");
        var fechaR = $(this).attr("data-fechaR");
        var descrip = $(this).attr("data-descrip");
        var EM = $(this).attr("data-em");
        var obser = $(this).attr("data-obser");
 
        $('#idSoli').val(idSoli);
        $('#idModalidad').val(idModalidad);
        $('#idModalidad').formSelect();
        $('#idDep').val(idDep);
        $('#idDep').formSelect();
        $('#id_Man').val(idman);
        $('#id_Man').formSelect();
        $('#idPer').val(idPer);
        $('#idPer').formSelect();
        $('#fechaR').val(fechaR);
        $('#descrip').val(descrip);
        $('#em').val(EM);
        $('#obser').val(obser);
        
        M.updateTextFields();
        $('#ventanaModal').modal('open');
        $('#tiposer').focus();
    });

    $(document).on("click", '.delete', function(){
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
                    M.toast({html: 'Orden de trabajo Eliminada', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });

}

function validateForm(){
    $('#formulario').validate({
        rules:{
            idSoli:{required:true},
            idModalidad:{required:true},
            idDep:{required:true},
            fechaR:{required:true},
            descrip:{required:true},
            em:{required:true},
            obser:{required:true},
        },
        messages: {
            idSoli:{required:"No puedes dejar este campo vacío"},
            idModalidad:{required:"No puedes dejar este campo vacío"},
            idDep:{required:"No puedes dejar este campo vacío"},
            fechaR:{required:"No puedes dejar este campo vacío"},
            descrip:{required:"No puedes dejar este campo vacío"},
            em:{required:"No puedes dejar este campo vacío"},
            obser:{required:"No puedes dejar este campo vacío"},
        },
        errorElement: "div",
        errorClass: "invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)                
        },
        submitHandler: function(form){
            guardarRegistro();
        }
    });
}

function guardarRegistro(){
    var idSoli = $("#idSoli").val();  
    var parametros = $("#formulario").serialize();
    var tipom = $("#idModalidad option:selected").text();
    var nombreDep = $("#idDep option:selected").text();
    var nombrePer = $("#idPer option:selected").text();
    var nomman = $("#id_Man option:selected").text();

    var nom = $("#idDep option:selected").attr('data-nom');

    if (idSoli > 0){
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
                limpiarFormulario();

                $('#ventanaModal').modal('close');
                var data = respuesta['data'];
                if (idSoli >0){
                    table.row('#' + data.idSoli).remove().draw();
                }
                var row = table.row.add([
                    tipom,
                    nombreDep,
                    nomman,
                    nombrePer,
                    data.fechaR,
                    data.descrip,
                    nom,
                    data.em,
                    data.obser,
                    '<i class="material-icons edit" data-idSoli="' + data.idSoli + '" data-tipom="' + tipom +'" data-nombreDep="' + nombreDep +'" data-nomman="' + nomman +'" data-nombrePer="' + nombrePer +'" data-fechaR="' + data.fechaR +'" data-descrip="' + data.descrip +'" data-nom="' + nom +'" data-em="' + data.em +'" data-obser="' + data.obser +'">create</i><i class="material-icons delete" data-idSoli="' + data.idSoli + '">delete_forever</i>'
                ]).draw().node();
                $(row).attr('id',data.idSoli);

                M.toast({html: 'Orden de trabajo Guardada', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}

function limpiarFormulario() {
    $('#formulario')[0].reset();
    $('select').val('').formSelect();
    M.updateTextFields();
}
