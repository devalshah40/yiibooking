<?php
/**
 * Recover password email template
 */
?>
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
                  <h1>Hi <?php echo $user->getFullName(); ?>,</h1>
                  <p>Your new password is <?php echo $password; ?> </p>
                  <!-- Action -->
                </td>
              </tr>
            </table>
          </td>
        </tr>

