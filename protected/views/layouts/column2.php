<?php $this->beginContent('//layouts/main'); ?>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/avatar04.png" class="img-circle"
               alt="User Image"/>
        </div>
        <div class="pull-left info">
          <p><?php echo Yii::t('app', 'Hello'); ?>, <?php echo ucfirst(Yii::app()->user->name); ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php $this->widget('zii.widgets.CMenu', array(
        'htmlOptions' => array('class' => 'sidebar-menu'),
        'encodeLabel' => false,
        'items' => array(
          array('label' => Menu::link('MAIN NAVIGITION'), 'itemOptions' => array('class' => 'header')),
          array('label' => Menu::link('Dashboard', 'fa fa-dashboard'), 'url' => array('site/calendar')),
          array('label' => Menu::link('Bookings', 'glyphicon glyphicon-list-alt'), 'url' => array('booking/admin')),
          array('label' => Menu::link('Rooms', 'glyphicon glyphicon-home'), 'url' => array('rooms/index')),
//          array('label' => Menu::link('Available Rooms', 'glyphicon glyphicon-home'), 'url' => array('rooms/search')),
          array('label' => Menu::link('Dharamshala Search', 'glyphicon glyphicon-search'), 'url' => array('search/index')),
          array(
            'label' => Menu::link('Users', 'glyphicon glyphicon-user'),
            'url' => array('user/admin'),
            'visible'=> (Yii::app()->user->id == 1)
          )
        ),
      )); ?>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Right side column. Contains the navbar and content of the page -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo CHtml::encode($this->pageTitle); ?> </h1>

      <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
          'links' => $this->breadcrumbs,
          'tagName' => 'ol',
          'htmlOptions' => array('class' => 'breadcrumb'),
          'homeLink' => CHtml::tag('li', array(), CHtml::link(Yii::t('app', 'Home'), array('/site/index')), true),
          'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
          'inactiveLinkTemplate' => '<li class="active">{label}</li>',
          'separator' => '',
        )); ?><!-- breadcrumbs -->
      <?php endif ?>

    </section>

    <!-- Main content -->
    <section class="content">
      <?php
      $flashMessages = Yii::app()->user->getFlashes();
      if ($flashMessages) {
        foreach($flashMessages as $key => $message) {
          echo '<div class="alert alert-' . $key . ' alert-dismissable">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                ' . $message . "</div>";
        }
      }
      ?>
      <?php echo $content; ?>
    </section><!-- /.content -->

  </div><!-- /.right-side -->

<?php $this->endContent(); ?>