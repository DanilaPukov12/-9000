;(function ($) {
    "use strict"

    const $transport_price = {
        'paz': 1200,
        'liaz': 1500
    }
    $('#calc-cost-btn').on('click', () => {
        // const $num_passenger = $('#number_passenger').val();
        const $num_hours = $('#number_hours').val();
        const $select_transport = $('#select_transport').val();
        const $calc_num = $('#calc-number');
        if($select_transport !== 'no') {
            $calc_num.html($transport_price[$select_transport] * $num_hours);
        } else {
            const $transport_price_values = Object.values($transport_price);
            const min = Math.min(...$transport_price_values);
            const max = Math.max(...$transport_price_values);

            $calc_num.html(`${min * $num_hours} - ${max * $num_hours}`);
        }
    })
})(jQuery)
