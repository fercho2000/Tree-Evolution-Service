"use strict";

$(document).ready(function () {

        // $('#example-single').multiselect();
setTimeout(function () {

$(".multiselect-container .multiselect-item .input-group-addon i").removeClass('glyphicon glyphicon-search');
    $(".multiselect-container .multiselect-item .input-group-addon").addClass('fa fa-search');

    $(".multiselect-container .multiselect-item .input-group-btn i").removeClass('glyphicon glyphicon-remove-circle');
    $(".multiselect-container .multiselect-item .input-group-btn i").addClass('fa fa-times-circle-o');
    $(".btn-group .multiselect b").removeClass('caret');
    $(".btn-group .multiselect b").addClass('fa fa-caret-down');
},500)

    $("#example-single").multiselect(
        {
            theme:"bootstrap"
        }
    );
    $("#multiselect2").multiselect({
        enableFiltering: true,
        includeSelectAllOption: true,
        maxHeight: 300,
        dropUp: true
      
    });
    $("#select21").select2({
        theme: "bootstrap",
        placeholder: "single select"
    });
    $("#select22").select2({
        theme: "bootstrap",
        placeholder: "multi select"
    });

    $("#get_value_cate").select2({
        theme: "bootstrap",
        placeholder: "Select the category"
    });

    $("#get_value_impl").select2({
        theme: "bootstrap",
        placeholder: "Select the category"
    });

    //Select Novedades
    $("#get-value-imp").select2({
        theme: "bootstrap",
        placeholder: "Select an implement"
    });

    $("#get-value-emp").select2({
        theme: "bootstrap",
        placeholder: "Selecciona un empleado"
    });


    $("#get_value_imp").select2({
        theme: "bootstrap",
        placeholder: "Select an implement"
    });  
    
    $("#get_value_emp").select2({
        theme: "bootstrap",
        placeholder: "Select an employee"
    });

    // selects kits
    $("#get_value_servicio").select2({
        theme: "bootstrap",
        placeholder: "Select a service"
    });

    $("#SelectCiudad").select2({
        theme: "bootstrap",
        placeholder: "Select The City"
    });


    $("#SelectEditarCiudad").select2({
        theme: "bootstrap",
    });
    
    $("#SelectGenero").select2({
        theme: "bootstrap",
        placeholder: "Select Gender"
    });

    $("#SelectEditarGenero").select2({
        theme: "bootstrap",
        placeholder: "Select Gender"
        
    });

    $("#AgregarCliente").select2({
        theme: "bootstrap",
        placeholder: "Select The Client"
    });

    $("#UpdateCliente").select2({
        theme: "bootstrap",
        placeholder: "Select The Client"
    });    
    
    $("#get_value_cliente").select2({
        theme: "bootstrap",
        placeholder: "Select The Client"
    });

    $("#select_responsable").select2({
        theme: "bootstrap",
        placeholder: "Select The Responsible"
    });

    function formatState(state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span><img src="assets/img/us_states_flags/' + state.element.value.toLowerCase() + '.png" class="img-flag"  width="20px" height="20px"/> ' + state.text + '</span>'
        );
        return $state;
    }



    $("#SeletOrdenServicios").select2({
        theme: "bootstrap",
        placeholder: "Services"
    });

    $("#SeletOrdenServiciosEdit").select2({
        theme: "bootstrap",
        placeholder: "Services"
    });

    $("#select23").select2({
        templateResult: formatState,
        templateSelection: formatState,
        placeholder: "select with country flag",
        theme: "bootstrap"
    });

    $('#select24').select2({
        allowClear: true,
        theme: "bootstrap",
        placeholder: "select",
        width: null,
        containerCssClass: ':all:'
    });



    $('#select25').select2({
        allowClear: true,
        theme: "bootstrap",
        placeholder: "select"
    });

    $('#select26').select2({
        placeholder: "select",
        theme: "bootstrap"
    });


    $('#select-gear').selectize({
        sortField: 'text'
    });
    $("#selectize3").selectize({
        maxItems: 3
    });
    $('#selectize-tags1').selectize({
        plugins: ['restore_on_backspace'],
        delimiter: ',',
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input
            }
        }
    });
    $('#selectize-tags2').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input
            }
        }
    });
    $('#selectize-tags3').selectize({
        plugins: ['drag_drop'],
        delimiter: ',',
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input
            }
        }
    });

//Get selected option value
    var $selectValue = $('#select_value').find('strong');
    $selectValue.text($('#get_value').val());
    $('#get_value').selectric().on('change', function () {
        $selectValue.text($(this).val());
    });
//Get selected option value end

//Set value
    $('#set_value').selectric();

    $('#set_first_option').on('click', function () {
        $('#set_value').prop('selectedIndex', 0).selectric('refresh');
    });

    $('#set_second_option').on('click', function () {
        $('#set_value').prop('selectedIndex', 1).selectric('refresh');
    });

    $('#set_third_option').on('click', function () {
        $('#set_value').prop('selectedIndex', 2).selectric('refresh');
    });
    $('#set_fourth_option').on('click', function () {
        $('#set_value').prop('selectedIndex', 3).selectric('refresh');
    });
//Set value end

//Change options on the fly
    $('#dynamic').selectric();

    $('#bt_add_val').on('click', function () {
        var value = $.trim($('#add_val').val());
        $('#dynamic').append('<option>' + (value ? value : 'Empty') + '</option>').selectric('refresh');
        $('#add_val').val('');
    });
//Change options on the fly end
});