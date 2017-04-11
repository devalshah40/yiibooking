<span class="preheader">This is a receipt for your booking on {{ purchase_date }}.</span>
<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
      <table class="email-content" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td class="email-masthead">
            <a href="<?php echo Yii::app()->getBaseUrl(true); ?>" class="email-masthead_name">
              <?php echo Yii::app()->name; ?>
            </a>
          </td>
        </tr>
        <!-- Email Body -->
        <tr>
          <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
            <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0">
              <!-- Body content -->
              <tr>
                <td class="content-cell">
                  <h1>Hi <?php echo $booking->yatrik_name; ?>,</h1>
                  <p>Thanks for booking at Girnar Dharamshala. This email is the receipt for your purchase.</p>

                  <table class="purchase" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <h3><?php echo $booking->receipt_no; ?></h3></td>
                      <td>
                        <h3 class="align-right"><?php echo date('Y-m-d'); ?></h3></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                          <tr>
                            <th class="purchase_heading">
                              <p>Description</p>
                            </th>
                            <th class="purchase_heading">
                              <p class="align-right">Amount</p>
                            </th>
                          </tr>

                          <?php
                              $total_price = 0;
                              $date1 = new DateTime($booking->arrival_date);
                              $date2 = new DateTime($booking->departure_date);

                              $booking->noOfDays = $date2->diff($date1)->format("%a");

                              foreach ($booking->rooms as $key => $room) {
                                $roomObj = Rooms::model()->findByPk($room);
                          ?>
                            <tr>
                              <td width="80%" class="purchase_item">
                                <?php
                                echo $booking->noOfRooms[$key] .' ' . $roomObj->room_name;
                                ?>
                              </td>
                              <td class="align-right" width="20%" class="purchase_item">
                                <?php
                                $total_price += $booking->noOfDays * $roomObj->room_price * $booking->noOfRooms[$key];
                                echo $booking->noOfDays * $roomObj->room_price * $booking->noOfRooms[$key];
                                ?>
                              </td>
                            </tr>
                          <?php
                              }
                          ?>

                          <tr>
                            <td width="80%" class="purchase_footer" valign="middle">
                              <p class="purchase_total purchase_total--label">Total</p>
                            </td>
                            <td width="20%" class="purchase_footer" valign="middle">
                              <p class="purchase_total"><?php echo $total_price; ?></p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>