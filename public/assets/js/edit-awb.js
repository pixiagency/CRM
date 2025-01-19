/******/ (() => { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!***********************************************!*\
      !*** ./resources/assets/js/awb/create-awb.js ***!
      \***********************************************/
    $(document).ready(function () {
        $('#branch_id').on('change', function () {
            var selectedOption = $(this).find(':selected');
            var phone = selectedOption.data('phone');
            var address = selectedOption.data('address');
            var city = selectedOption.data('city');
            var area = selectedOption.data('area');
            $("#branch_phone").text(phone);
            $("#branch_address").text(address);
            $("#branch_city").text(city);
            $("#branch_area").text(area);
        });
        $('#branch_id').change();

        $("#collection").css('display', 'none');
        if ($("#payment_type").val() == 4) $("#collection").css('display', 'block');
        $('#payment_type').on('change', function () {
            var selectedOption = $(this).val();
            if (selectedOption == 4) $("#collection").css('display', 'block'); else $("#collection").css('display', 'none');
        });
        $('#shipment_type_id').on('change', function () {
            var selectedOption = $(this).find('option:selected');
            var has_dimension = selectedOption.data('has_dimension');
            if (has_dimension > 0) $("#awb_details").css('display', 'block'); else $("#awb_details").css('display', 'none');
        }); // Listen for changes to the number input

        $('#pieces').on('change', function () {
            // Get the number of fields to generate
            var numFields = $(this).val();
            var selectedOption = $('#shipment_type_id option:selected');
            var has_dimension = selectedOption.data('has_dimension');

            if (has_dimension > 0 && numFields) {
                // Clear the fields container
                $('#awb_details').empty(); // Generate the input fields

                for (var i = 0; i < numFields; i++) {
                    var input = $('<div class="col-md-4">\n' + '<label class="form-label">Length</label>\n' + '<input class="form-control" type="number" name="length[]"/>\n' + '</div>\n' + '<div class="col-md-4">\n' + '<label class="form-label">width</label>\n' + '<input class="form-control" type="number" name="width[]"/>\n' + '</div>\n' + '<div class="col-md-4">\n' + '<label class="form-label">height</label>\n' + '<input class="form-control" type="number" name="height[]"/>\n' + '</div>'); // Add the input field to the container

                    $('#awb_details').append(input);
                }
            } else // Clear the fields container
                $('#awb_details').empty();
        });
    });
    /******/
})()
    ;
