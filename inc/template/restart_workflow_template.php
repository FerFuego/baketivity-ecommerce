<div class="wrap">

    <h1>Work Flow Settings </h1>
    <?php if($args['message']){
        echo '<div class="notice"><p>'.$args['message'].'</p></div>';
    }?>
    <form method="post" >
        <table class="form-table">

            <tr valign="top">
                <th scope="row">Subscription id</th>
                <td>
                    <input type="text" value="" name="subscriber_id">
                </td>
            </tr>

        </table>
        <?php submit_button(); ?>
    </form>
</div>
