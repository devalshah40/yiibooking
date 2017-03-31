<?php
$daterange = "$('#daterange').daterangepicker({ locale: {
      format: 'DD-MM-YYYY'
}});";

Yii::app()->clientScript->registerScript('daterange', $daterange, CClientScript::POS_READY);

$roomJs = <<<EOD
var room = 1;
function education_fields() {
   room++;
   var objTo = document.getElementById("education_fields");
   var divtest = document.createElement("div");
   divtest.setAttribute("class", "form-group removeclass"+room);
	 var rdiv = "removeclass"+room;
   divtest.innerHTML = '<div id="education_fields"><div class="form-group removeclass2">          <div class="col-xs-4">                <input type="text" class="form-control" placeholder="No of rooms">              </div>              <div class="col-xs-7">                <select class="form-control">                  <option>option 1</option>                  <option>option 2</option>                  <option>option 3</option>                  <option>option 4</option>                  <option>option 5</option>                </select>              </div>              <div class="col-xs-1">                <button type="button" class="btn btn-danger btn-flat" onclick="remove_education_fields('+ room +');">-</button>              </div>  <br>  <br>        </div></div>';        objTo.appendChild(divtest);
}
function remove_education_fields(rid) {
	   $(".removeclass"+rid).remove();
   }
EOD;


Yii::app()->clientScript->registerScript('room',$roomJs, CClientScript::POS_HEAD);

?>
<div class="row">
  <div class="col-md-5">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Search Rooms</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form">
        <div class="box-body">
          <!-- Date range -->
          <div class="form-group">
            <label>Date range:</label>

            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="daterange">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->
          <div class="form-group">
            <label>Select Rooms:</label>

            <div class="input-group">
              <div id="education_fields"></div>
              <div class="col-xs-4">
                <input type="text" placeholder="No of rooms" class="form-control">
              </div>
              <div class="col-xs-7">
                <select class="form-control">
                  <option>option 1</option>
                  <option>option 2</option>
                  <option>option 3</option>
                  <option>option 4</option>
                  <option>option 5</option>
                </select>
              </div>
              <div class="col-xs-1">
                <button type="button" class="btn btn-info btn-flat"  onclick="education_fields();">+</button>
              </div>
            </div>
            <!-- /.input group -->
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-md-7">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#activity" aria-expanded="true">Search result</a></li>
        <li class=""><a data-toggle="tab" href="#timeline" aria-expanded="false">Timeline</a></li>
        <li class=""><a data-toggle="tab" href="#settings" aria-expanded="false">Settings</a></li>
      </ul>
      <div class="tab-content">
        <div id="activity" class="tab-pane active">
          <!-- Post -->
          <div class="post">
            <div class="user-block">
              <img alt="user image" src="../../dist/img/user1-128x128.jpg" class="img-circle img-bordered-sm">
              <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>
                        </span>
              <span class="description">Shared publicly - 7:30 PM today</span>
            </div>
            <!-- /.user-block -->
            <p>
              Lorem ipsum represents a long-held tradition for designers,
              typographers and the like. Some people hate it and argue for
              its demise, but others ignore the hate as they create awesome
              tools to help create filler text for everyone from bacon lovers
              to Charlie Sheen fans.
            </p>
            <ul class="list-inline">
              <li><a class="link-black text-sm" href="#"><i class="fa fa-share margin-r-5"></i> Share</a></li>
              <li><a class="link-black text-sm" href="#"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
              </li>
              <li class="pull-right">
                <a class="link-black text-sm" href="#"><i class="fa fa-comments-o margin-r-5"></i> Comments
                  (5)</a></li>
            </ul>

            <input type="text" placeholder="Type a comment" class="form-control input-sm">
          </div>
          <!-- /.post -->

          <!-- Post -->
          <div class="post clearfix">
            <div class="user-block">
              <img alt="User Image" src="../../dist/img/user7-128x128.jpg" class="img-circle img-bordered-sm">
              <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>
                        </span>
              <span class="description">Sent you a message - 3 days ago</span>
            </div>
            <!-- /.user-block -->
            <p>
              Lorem ipsum represents a long-held tradition for designers,
              typographers and the like. Some people hate it and argue for
              its demise, but others ignore the hate as they create awesome
              tools to help create filler text for everyone from bacon lovers
              to Charlie Sheen fans.
            </p>

            <form class="form-horizontal">
              <div class="form-group margin-bottom-none">
                <div class="col-sm-9">
                  <input placeholder="Response" class="form-control input-sm">
                </div>
                <div class="col-sm-3">
                  <button class="btn btn-danger pull-right btn-block btn-sm" type="submit">Send</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.post -->

          <!-- Post -->
          <div class="post">
            <div class="user-block">
              <img alt="User Image" src="../../dist/img/user6-128x128.jpg" class="img-circle img-bordered-sm">
              <span class="username">
                          <a href="#">Adam Jones</a>
                          <a class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>
                        </span>
              <span class="description">Posted 5 photos - 5 days ago</span>
            </div>
            <!-- /.user-block -->
            <div class="row margin-bottom">
              <div class="col-sm-6">
                <img alt="Photo" src="../../dist/img/photo1.png" class="img-responsive">
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-6">
                    <img alt="Photo" src="../../dist/img/photo2.png" class="img-responsive">
                    <br>
                    <img alt="Photo" src="../../dist/img/photo3.jpg" class="img-responsive">
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <img alt="Photo" src="../../dist/img/photo4.jpg" class="img-responsive">
                    <br>
                    <img alt="Photo" src="../../dist/img/photo1.png" class="img-responsive">
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <ul class="list-inline">
              <li><a class="link-black text-sm" href="#"><i class="fa fa-share margin-r-5"></i> Share</a></li>
              <li><a class="link-black text-sm" href="#"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
              </li>
              <li class="pull-right">
                <a class="link-black text-sm" href="#"><i class="fa fa-comments-o margin-r-5"></i> Comments
                  (5)</a></li>
            </ul>

            <input type="text" placeholder="Type a comment" class="form-control input-sm">
          </div>
          <!-- /.post -->
        </div>
        <!-- /.tab-pane -->
        <div id="timeline" class="tab-pane">
          <!-- The timeline -->
          <ul class="timeline timeline-inverse">
            <!-- timeline time label -->
            <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                <div class="timeline-body">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                  weebly ning heekya handango imeem plugg dopplr jibjab, movity
                  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                  quora plaxo ideeli hulu weebly balihoo...
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                </h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                <div class="timeline-body">
                  Take me to your leader!
                  Switzerland is small and neutral!
                  We are more like Germany, ambitious and misunderstood!
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline time label -->
            <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                <div class="timeline-body">
                  <img class="margin" alt="..." src="http://placehold.it/150x100">
                  <img class="margin" alt="..." src="http://placehold.it/150x100">
                  <img class="margin" alt="..." src="http://placehold.it/150x100">
                  <img class="margin" alt="..." src="http://placehold.it/150x100">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.tab-pane -->

        <div id="settings" class="tab-pane">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label" for="inputName">Name</label>

              <div class="col-sm-10">
                <input type="email" placeholder="Name" id="inputName" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="inputEmail">Email</label>

              <div class="col-sm-10">
                <input type="email" placeholder="Email" id="inputEmail" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="inputName">Name</label>

              <div class="col-sm-10">
                <input type="text" placeholder="Name" id="inputName" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="inputExperience">Experience</label>

              <div class="col-sm-10">
                <textarea placeholder="Experience" id="inputExperience" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="inputSkills">Skills</label>

              <div class="col-sm-10">
                <input type="text" placeholder="Skills" id="inputSkills" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-danger" type="submit">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>