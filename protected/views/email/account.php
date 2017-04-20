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
                  <h1>Hi <?php echo $user->name; ?>,</h1>
                  <p><?php echo $message; ?></p>

                  <table width="100%" cellspacing="0" cellpadding="0" class="attribute-list">
                    <tbody>
                      <tr>
                        <td class="attribute-list-container">
                          <table width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td class="attribute-list-item"><strong>Username:</strong> <?php echo $user->username; ?></td>
                              </tr>
                              <tr>
                                <td class="attribute-list-item"><strong>Password:</strong> <?php echo $user->initialPassword; ?></td>
                              </tr>
                              <tr>
                                <td class="attribute-list-item"><strong>Email address:</strong> <?php echo $user->email; ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>