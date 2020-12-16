<?php

/**
 *  Dokan Dashboard Template
 *
 *  Dokan Dashboard Sales chart report widget
 *
 * @since 2.4
 *
 * @package dokan
 */
?>

<div class="dashboard-widget sells-graph">
    <div class="widget-title">
        <i class="fa fa-credit-card"></i> <?php esc_html_e( 'Sales this Month', 'dokan-lite' ); ?>
    </div>
<!--    <table style="font-size:smaller;color:#aaa;">-->
<!--        <tbody>-->
<!--        <tr>-->
<!--            <td class="legendColorBox">-->
<!--                <div style="border:1px solid #ccc;padding:1px">-->
<!--                    <div style="width:4px;height:0;border:5px solid rgb(52,152,219);overflow:hidden"></div>-->
<!--                </div>-->
<!--            </td>-->
<!--            <td class="legendLabel">مجموع فروش</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td class="legendColorBox">-->
<!--                <div style="border:1px solid #ccc;padding:1px">-->
<!--                    <div style="width:4px;height:0;border:5px solid rgb(26,188,156);overflow:hidden"></div>-->
<!--                </div>-->
<!--            </td>-->
<!--            <td class="legendLabel">تعداد سفارشات</td>-->
<!--        </tr>-->
<!--        </tbody>-->
<!--    </table>-->


	<?php
	require_once DOKAN_INC_DIR . '/reports.php';
	dokan_dashboard_sales_overview();
	?>
</div> <!-- .sells-graph -->
