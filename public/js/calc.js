;(async function ($) {
    "use strict"

    async function getPrice() {
        let $price;
        await $.ajax({
            url: 'api/price',
            method: 'post',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $price = data;
            },
            error: function (e) {
                console.log(e);
            }
        });

        return $price;
    }

    let $transport_price = await getPrice();

    const $transport_num_seats = {
        'paz': 19,
        'liaz': 24
    }
    $('#calc-cost-btn').on('click', () => {
        const $num_passenger = $('#number_passenger').val();
        const $num_hours = $('#number_hours').val();
        const $select_transport = $('#select_transport').val();
        const $calc_num = $('#calc-number');
        if($select_transport !== 'no') {
            const $num_transport = Math.ceil($num_passenger / $transport_num_seats[$select_transport]);
            $calc_num.html($transport_price[$select_transport] * $num_hours * $num_transport);
        } else {
            const $transport_price_values = Object.values($transport_price);
            const min_price = Math.min(...$transport_price_values);
            const max_price = Math.max(...$transport_price_values);

            const $transport_num_seats_values = Object.values($transport_num_seats);
            let min_seats = Math.min(...$transport_num_seats_values);
            let max_seats = Math.max(...$transport_num_seats_values);
            min_seats = Math.ceil($num_passenger / min_seats);
            max_seats = Math.ceil($num_passenger / max_seats);

            $calc_num.html(`${min_price * $num_hours * max_seats} - ${max_price * $num_hours * min_seats}`);
        }
    })
})(jQuery)
