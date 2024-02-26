<?php

/**
 * Template Name: Orders info
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */

?>

<?php get_header(); ?>

<style>
    .order-info__table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .order-info__td,
    .order-info__th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    .order-info__tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php

        // Get orders data
        $initial_date = get_field('initial_date');
        $final_date = get_field('final_date');
        $orders = wc_get_orders(
            array(
                'limit'       => -1,
                'type'        => 'shop_order',
                'date_created' => $initial_date . '...' . $final_date
            )
        );

        ?>

        <main class="order-info">

            <table class="order-info__table">
                <tr class="order-info__tr">
                    <th class="order-info__th">ID de transacción</th>
                    <th class="order-info__th">Fecha</th>
                    <th class="order-info__th">ID de pago</th>
                    <th class="order-info__th">Monto</th>
                    <th class="order-info__th">Método de pago</th>
                </tr>
                <?php

                // Print order info
                foreach ($orders as $norder => $order) {

                    // Get pay ID
                    $pay_id = get_post_meta($order->get_id(), '_transaction_id', true);
                    // Get total
                    $total = $order->get_total();

                ?>

                    <tr class="order-info__tr">
                        <td class="order-info__td"><?php echo $order->get_id(); ?></td>
                        <td class="order-info__td"><?php echo date_format($order->get_date_created(), "d-m-Y"); ?></td>
                        <td class="order-info__td"><?php echo $pay_id; ?></td>
                        <td class="order-info__td"><?php echo $total; ?></td>
                        <td class="order-info__td"><?php echo $order->get_payment_method_title(); ?></td>
                    </tr>

                <?php
                }

                ?>
            </table>

        </main>

    <?php endwhile; ?>
<?php endif ?>

<?php get_footer(); ?>