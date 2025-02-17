<?php

$groupswithaccess = 'RADIONER,CEO,FOUNDER';

require_once 'slpw/sitelokpw.php';
require_once 'slpw/slconfig.php';

require_once 'getID3/getid3/getid3.php';
require_once 'php/music_info_get.php';

date_default_timezone_set('US/Eastern');
function formatDateAgo ($value) {
  $time = strtotime($value);
  $d = new \DateTime($value);

  $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
  $months = ['January', 'February', 'March', 'April', ' May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

  if ($time > strtotime('-2 minutes')) {
    return 'few second ago';
  } elseif ($time > strtotime('-30 minutes')) {
    return  floor((strtotime('now') - $time) / 60) . ' min, ' . 'Today ';
  } elseif ($time > strtotime('today')) {
    return $d->format('G:i');
  } elseif ($time > strtotime('yesterday')) {
    return $d->format('G:i') . ', Yesterday';
  } elseif ($time > strtotime('this week')) {
    return  $d->format('G:i') . ', ' . $weekDays[$d->format('N') - 1];
  } else {
    return  $d->format('G:i') . ', ' . $d->format('j') . ' ' . $months[$d->format('n') - 1];
  }
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id !== null) {
  $song_res = $con->query("SELECT * FROM `song` WHERE `RDON_ID`='$id' AND `USER_NAME`='$slusername'");
  if ($song_res->num_rows === 0) {
    http_response_code(400);
    die('Song ID does not exist on the server');
  }

  $getID3 = new getID3();
  $song = $song_res->fetch_object();
  $title = $song->SONG_NAME;
  $artist = $song->ARTIST_NAME;
  $album = $song->ALBUM_NAME;
  $genre = $song->SONG_GENRE;
  $status = $song->SONG_STATUS;
  $license = $song->COPYRIGHT === 'c' ? 'C' : 'CC ' . strtoupper($song->COPYRIGHT);
  $record = $song->RECORD_LABEL;
  $source = get_music_source($id, $status);
  $artwork_src = get_art_work($id, $status);
  $mp3info = $getID3->analyze($source);
  $track = $mp3info['tags']['id3v2']['track_number'][0];
  $genre = strtoupper($genre);
  $year = $mp3info['tags']['id3v2']['year'][0];
  $duration = $mp3info['playtime_string'];
  $filesize = filesize($source) / 1000;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- META SECTION -->
  <title>UPLOAD - ASSET PRODUCER</title>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
  <link rel="manifest" href="/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- END META SECTION -->

  <!-- CSS INCLUDE -->
  <link rel="stylesheet" id="theme" href="/css/theme-dark.css">
  <link rel="stylesheet" href="/css/all.css">
  <link rel="stylesheet" href="/css/cropper/cropper.min.css">

  <script>var memberprofilepage = 1</script>
  <?php if (function_exists('startwhoisonline')) startwhoisonline('userid'); ?>

  <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>

  <!-- QR CODE CDN -->
  <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

  <!-- CLIPBOARD -->
  <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.3/clipboard.min.js"></script>

  <style>
  .fa-sort-down { color: #C0392B }
  .fa-sort-up { color: #27AE60 }

  .tDown { color: #C0392B }
  .tUp { color: #27AE60 }

  .linko { color: #737577; }
  .linko:hover { color: #3498DB; }
  </style>
</head>

<body>
  <!-- MODAL FOR QR -->
  <div class="modal" id="modal_small" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <div align="left" style="color:#33414E; width:30px; height:30px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="47" height="64" viewBox="0 0 47 64">
              <path style="fill:#3498DB;" d="M30.252 63.441c-4.55 0-7.864-1.089-9.946-3.267-2.08-2.177-3.121-4.525-3.121-7.041 0-.92.181-1.694.544-2.323a3.993 3.993
 0 0 1 1.489-1.489c.629-.363 1.403-.544 2.323-.544.92 0 1.693.181 2.323.544.629.363 1.125.86 1.488 1.489.363.629.544 1.403.544
 2.323 0 1.113-.266 2.02-.798 2.722-.533.702-1.162 1.161-1.888 1.38.63.87 1.622 1.487 2.977 1.85 1.355.388 2.71.581 4.065.581
 1.887 0 3.593-.508 5.118-1.524 1.524-1.017 2.65-2.517 3.376-4.501.726-1.984 1.089-4.235 1.089-6.752
 0-2.734-.4-5.07-1.198-7.005-.775-1.96-1.924-3.412-3.449-4.356a9.21 9.21 0 0 0-4.936-1.415c-1.162 0-2.613.484-4.356
 1.452l-3.194 1.597v-1.597L37.076 16.4H17.185v19.89c0 1.646.363 3.001 1.089 4.066s1.839 1.597 3.34 1.597c1.16 0 2.274-.387
 3.339-1.162a11.803 11.803 0 0 0 2.758-2.83c.097-.219.218-.376.363-.473a.723.723 0 0 1 .472-.181c.266 0 .58.133.944.4.339.386.508.834.508
 1.342a9.243 9.243 0 0 1-.182 1.017c-.822 1.839-1.96 3.242-3.412 4.21a8.457 8.457 0 0
 1-4.79 1.452c-4.308 0-7.285-.847-8.93-2.54-1.645-1.695-2.468-3.994-2.468-6.897V16.4H.052v-3.703h10.164v-8.42L7.893
 1.952V.066h6.751l2.54 1.306v11.325l26.28-.072 2.614 2.613-16.116 16.116a10.807 10.807 0 0 1 3.049-.726c1.742
 0 3.702.557 5.88 1.67 2.202 1.089 3.896 2.59 5.081 4.5 1.186 1.888 1.948 3.703 2.287 5.445.363 1.743.545 3.291.545
 4.646 0 3.098-.654 5.977-1.96 8.64-1.307 2.661-3.291 4.645-5.953 5.952-2.662 1.307-5.542 1.96-8.639 1.96z"></path>
            </svg>
          </div>

          <div style="padding-left:35px; margin-top:-20px;">
            <strong>Receive Tezos</strong>
          </div><br>
          <div align="jusity" style="padding-right:5px; padding-left:5px; font-size:9px; color:#515A5A;">
            <strong>Important:</strong> We are not custodian of your keys, so please connect your wallet if you want to see your QR code.
          </div><hr>

          <div align="center" id="qraddress"></div><hr>
          <div style="padding-bottom:20px;">
            <p style="color:#333; margin-bottom:-5px;"><strong>Wallet Address:</strong></p>
            <span style="font-size:11px; padding-right:10px;" id="wallet_address"></span>
            <div align="right" style="margin-top:-20px;">
              <button class="btn btn-default btn-xs copyButton" data-clipboard-action="copy" data-clipboard-target="#wallet_address"><i class="fad fa-copy"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END MODAL FOR QR -->

  <!-- MODAL FOR SIGNER -->
  <div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog" style="width:480px;">
      <div class="modal-content">
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <!-- END MODAL FOR SIGNER -->

  <!-- ALERT MESSAGE -->
  <div class="message-box message-box-warning animated fadeIn" id="message-box-warning">
    <div class="mb-container">
      <div class="mb-middle">
        <div class="mb-title"><span class="fa fa-warning"></span> Warning</div>
        <div class="mb-content">
          <p>Please complete all information required to save your song.</p>
        </div>
        <div class="mb-footer">
          <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
        </div>
      </div>
    </div>
  </div>
  <button type="button" class="btn btn-warning mb-control hide" id="warning_btn" data-box="#message-box-warning">Warning</button>
  <!--- ALERT MESSAGE --->

  <!-- START PAGE CONTAINER -->
  <div class="page-container">

    <!-- START PAGE SIDEBAR -->
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <li class="xn-logo">
            <a href="index.php">RADION</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img src="<?php siteloklink($slcustom2, 0); ?>" alt="" />
            </a>
            <div class="profile">
                <div class="profile-image">
                    <img src="<?php siteloklink($slcustom2, 0); ?>" alt="" />
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?php echo $slusername; ?></div>
                    <div class="profile-data-title"><?php echo $slusergroups; ?></div>
                </div>
                <div class="profile-controls">
                    <a href="#" class="profile-control-left sidebar-toggle"><i class="far fa-comment-alt-lines"></i></a>
                    <a href="edit-profile.php" class="profile-control-right"><i class="fad fa-user-edit"></i></a>
                </div>

            </div>
        </li>
        <li class="xn-openable">
        <a href="#">
          <lord-icon src="https://cdn.lordicon.com//mmspidej.json" trigger="click" target="a" colors="primary:#ffffff,secondary:#F39C12" style="width:45px;height:45px"></lord-icon>
          <span class="xn-text">&nbsp;&nbsp; MUSIC</span>
        </a>
        <ul>
            <li><a href="submission.php"><span class="xn-text"><i class="fad fa-upload fa-lg"></i>&nbsp;&nbsp; UPLOAD FILE</span></a></li>
            <li><a href="mint-NFT-song-track.php"><span class="xn-text"><i class="fad fa-compact-disc fa-lg"></i> &nbsp;&nbsp; CREATE A NFT SONG TRACK</span></a></li>
        </ul>
    </li>

    <li class="xn-openable">
        <a href="#">
          <lord-icon src="https://cdn.lordicon.com//hciqteio.json" trigger="click" target="a" colors="primary:#ffffff,secondary:#F39C12" style="width:45px;height:45px"></lord-icon>
          <span class="xn-text">&nbsp;&nbsp; DISCOVER MUSIC</span>
        </a>
        <ul>
            <li><a href="marketplace.php"><span class="xn-text"><i class="fad fa-poll-people fa-lg"></i>&nbsp;&nbsp; VOTE ROOM</span></a></li>
            <li><a href="NFT-music-marketplace-tezos.php"><span class="xn-text"><i class="fas fa-album-collection fa-lg"></i>&nbsp;&nbsp; NFT MARKETPLACE FOR MUSIC</span></a></li>
        </ul>
    </li>

    <li class="xn-openable">
    <a href="#">
      <lord-icon src="https://cdn.lordicon.com//dizvjgip.json" trigger="click" target="a" colors="primary:#ffffff,secondary:#F39C12" style="width:45px;height:45px"></lord-icon>
      <span class="xn-text">&nbsp;&nbsp; RADION SERVICES</span>
    </a>
        <ul>
          <li><a href="ad-submission.php"><span class="xn-text"><i class="far fa-ad fa-lg"></i>&nbsp;&nbsp; CREATE AD WITH CRYPTO</span></a></li>
          <li><a href="#"><span class="xn-text"><i class="fal fa-fingerprint fa-lg"></i>&nbsp;&nbsp; ISRC ASSIGNMENT &nbsp;&nbsp;&nbsp;<label class="label label-primary"> SOON</label></span></a></li>
          <li><a href="#"><span class="xn-text"><i class="fad fa-chart-network fa-lg"></i>&nbsp;&nbsp; MUSIC SYNC LICENSING &nbsp;&nbsp;&nbsp;<label class="label label-primary"> SOON</label></span></a></li>
        </ul>
    </li>

<li class="xn-openable">
<a href="submission.php">
  <lord-icon src="https://cdn.lordicon.com//zqxcrgvd.json" trigger="click" target="a" colors="primary:#ffffff,secondary:#F39C12" style="width:45px;height:45px"></lord-icon>
  <span class="xn-text">&nbsp;&nbsp; LAB</span>
</a>
<ul>
  <li><a href="#"><span class="xn-text"><i class="fad fa-sack-dollar fa-lg"></i>&nbsp;&nbsp; MECHANICAL ROYALTIES &nbsp;&nbsp;&nbsp;<label class="label label-warning"> IN PROGRESS</label></span></a></li>
  <li><a href="#"><span class="xn-text"><i class="fad fa-sack-dollar fa-lg"></i>&nbsp;&nbsp; CRYPTO BILLBOARD &nbsp;&nbsp;&nbsp;<label class="label label-warning"> IN PROGRESS</label></span></a></li>
</ul>
    </li>

    </ul>
    <!-- END X-NAVIGATION -->
    </div>
    <!-- END PAGE SIDEBAR -->

    <!-- PAGE CONTENT -->
    <div class="page-content">
      <!-- START X-NAVIGATION VERTICAL -->
      <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
        <!-- TOGGLE NAVIGATION -->
        <li class="xn-icon-button">
          <a href="#" class="x-navigation-minimize"><i class="fad fa-outdent fa-lg"></i></a>
        </li>
        <!-- END TOGGLE NAVIGATION -->

        <!-- POWER OFF -->
        <li class="xn-icon-button pull-right last">
          <a href="#"><i class="fad fa-sign-out-alt fa-lg"></i></a>
          <ul class="xn-drop-left animated zoomIn">
            <li><a href="#" class="mb-control" data-box="#mb-signout"><i class="fad fa-sign-out-alt"></i> Sign Out</a></li>
          </ul>
        </li>
        <!-- END POWER OFF -->

        <!-- ALERT NOTIFICATIONS -->
        <li class="xn-icon-button pull-right">
          <a href="#"><i class="fad fa-bell fa-lg"></i></a>
          <div class="informer informer-danger">
            <?php if (function_exists('sl_showprivatemessagecount')) { sl_showprivatemessagecount(); } ?>
          </div>
          <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fad fa-bell-on"></i> Notifications</h3>
              <div class="pull-right">
                <span class="label label-danger">
                  <?php if (function_exists('sl_showprivatemessagecount')) { sl_showprivatemessagecount(); } ?> new
                </span>
              </div>
            </div>
            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">

            </div>
            <div class="panel-footer text-center">
              <a href="#" class="sidebar-toggle">Show all messages</a>
            </div>
          </div>
        </li>
        <!-- ALERT NOTIFICATIONS ENDS -->

        <!-- LANGUAGE BAR -->
        <li class="xn-icon-button pull-right">
          <a href="#"><i class="fad fa-language fa-lg"></i></a>
          <ul class="xn-drop-left xn-drop-dark animated zoomIn">

            <li><a href="#"><img src="img/flags/us.png" style="height:20px; width:20;">&nbsp &nbsp English</a></li>
          </ul>
        </li>

        <!-- END LANGUAGE BAR -->
      </ul>
      <!-- END X-NAVIGATION VERTICAL -->

      <!-- START BREADCRUMB -->
      <ul class="breadcrumb"></ul>
      <!-- END BREADCRUMB -->

      <!-- PAGE CONTENT WRAPPER -->
      <div class="page-content-wrap">
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-info" role="alert" id="message_box" style="display:none">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              <span><i class="fa fa-audio-description fa-lg"></i></span><span style="padding-right:20px;"></span>
              <span id="on_sibmission">RADION is always active in Social Media! If you want to be updated with our progress, we recommend you to follow us in our <a href="https://web.telegram.org/#/im?p=@radion_project" target="blank">Telegram</a> Group.</span>
            </div>
          </div>
        </div>

        <!-- START WIDGETS -->
        <div class="row">

          <div class="col-md-3">

              <!-- START WIDGET MESSAGES -->
              <div class="widget widget-primary widget-item-icon" onclick="#">
                  <div class="widget-item-left">
                      <img src="img/ON-logo.png" style="height:40px; width:40px;">
                  </div>
                  <div class="widget-data">
                      <div class="widget-int num-count">TOKEN</div>
                      <div class="widget-title">BALANCE</div>
                      <div class="widget-subtitle radio-balance" style="color:#F39C12;">0 <span>RADIO</span></div>
                  </div>

              </div>
              <!-- END WIDGET MESSAGES -->

          </div>

            <div class="col-md-3">

                <!-- START WIDGET MESSAGES -->
                <div class="widget widget-primary widget-item-icon" onclick="#">
                    <div class="widget-item-left">
                        <div style="height:40px; width:40px; margin-left:10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="47" height="64" viewBox="0 0 47 64">
                                <path style="fill:#737577;" d="M30.252 63.441c-4.55 0-7.864-1.089-9.946-3.267-2.08-2.177-3.121-4.525-3.121-7.041 0-.92.181-1.694.544-2.323a3.993 3.993
0 0 1 1.489-1.489c.629-.363 1.403-.544 2.323-.544.92 0 1.693.181 2.323.544.629.363 1.125.86 1.488 1.489.363.629.544 1.403.544
2.323 0 1.113-.266 2.02-.798 2.722-.533.702-1.162 1.161-1.888 1.38.63.87 1.622 1.487 2.977 1.85 1.355.388 2.71.581 4.065.581
1.887 0 3.593-.508 5.118-1.524 1.524-1.017 2.65-2.517 3.376-4.501.726-1.984 1.089-4.235 1.089-6.752
0-2.734-.4-5.07-1.198-7.005-.775-1.96-1.924-3.412-3.449-4.356a9.21 9.21 0 0 0-4.936-1.415c-1.162 0-2.613.484-4.356
1.452l-3.194 1.597v-1.597L37.076 16.4H17.185v19.89c0 1.646.363 3.001 1.089 4.066s1.839 1.597 3.34 1.597c1.16 0 2.274-.387
3.339-1.162a11.803 11.803 0 0 0 2.758-2.83c.097-.219.218-.376.363-.473a.723.723 0 0 1 .472-.181c.266 0 .58.133.944.4.339.386.508.834.508
1.342a9.243 9.243 0 0 1-.182 1.017c-.822 1.839-1.96 3.242-3.412 4.21a8.457 8.457 0 0
1-4.79 1.452c-4.308 0-7.285-.847-8.93-2.54-1.645-1.695-2.468-3.994-2.468-6.897V16.4H.052v-3.703h10.164v-8.42L7.893
1.952V.066h6.751l2.54 1.306v11.325l26.28-.072 2.614 2.613-16.116 16.116a10.807 10.807 0 0 1 3.049-.726c1.742
0 3.702.557 5.88 1.67 2.202 1.089 3.896 2.59 5.081 4.5 1.186 1.888 1.948 3.703 2.287 5.445.363 1.743.545 3.291.545
4.646 0 3.098-.654 5.977-1.96 8.64-1.307 2.661-3.291 4.645-5.953 5.952-2.662 1.307-5.542 1.96-8.639 1.96z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count">XTZ</div>
                        <div class="widget-title">BALANCE</div>
                        <div class="widget-subtitle xtz-balance" style="color:#F39C12;">0 <span>&#42793;</span></div>
                    </div>

                </div>
                <!-- END WIDGET MESSAGES -->

            </div>


            <div class="col-md-6">

                <!-- START WIDGET CLOCK -->
                <div class="widget widget-primary widget-padding-sm">
                    <div class="widget-controls">
                        <div style="height:35px; width:35px; margin-bottom:-37px; padding-left:20px;" class="widget-control-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="47" height="64" viewBox="0 0 47 64">
                                <path style="fill:#7B7D7D;" d="M30.252 63.441c-4.55 0-7.864-1.089-9.946-3.267-2.08-2.177-3.121-4.525-3.121-7.041 0-.92.181-1.694.544-2.323a3.993 3.993
0 0 1 1.489-1.489c.629-.363 1.403-.544 2.323-.544.92 0 1.693.181 2.323.544.629.363 1.125.86 1.488 1.489.363.629.544 1.403.544
2.323 0 1.113-.266 2.02-.798 2.722-.533.702-1.162 1.161-1.888 1.38.63.87 1.622 1.487 2.977 1.85 1.355.388 2.71.581 4.065.581
1.887 0 3.593-.508 5.118-1.524 1.524-1.017 2.65-2.517 3.376-4.501.726-1.984 1.089-4.235 1.089-6.752
0-2.734-.4-5.07-1.198-7.005-.775-1.96-1.924-3.412-3.449-4.356a9.21 9.21 0 0 0-4.936-1.415c-1.162 0-2.613.484-4.356
1.452l-3.194 1.597v-1.597L37.076 16.4H17.185v19.89c0 1.646.363 3.001 1.089 4.066s1.839 1.597 3.34 1.597c1.16 0 2.274-.387
3.339-1.162a11.803 11.803 0 0 0 2.758-2.83c.097-.219.218-.376.363-.473a.723.723 0 0 1 .472-.181c.266 0 .58.133.944.4.339.386.508.834.508
1.342a9.243 9.243 0 0 1-.182 1.017c-.822 1.839-1.96 3.242-3.412 4.21a8.457 8.457 0 0
1-4.79 1.452c-4.308 0-7.285-.847-8.93-2.54-1.645-1.695-2.468-3.994-2.468-6.897V16.4H.052v-3.703h10.164v-8.42L7.893
1.952V.066h6.751l2.54 1.306v11.325l26.28-.072 2.614 2.613-16.116 16.116a10.807 10.807 0 0 1 3.049-.726c1.742
0 3.702.557 5.88 1.67 2.202 1.089 3.896 2.59 5.081 4.5 1.186 1.888 1.948 3.703 2.287 5.445.363 1.743.545 3.291.545
4.646 0 3.098-.654 5.977-1.96 8.64-1.307 2.661-3.291 4.645-5.953 5.952-2.662 1.307-5.542 1.96-8.639 1.96z"></path>
                            </svg>
                        </div>
        <div style="width:100%; margin:5px 20px 0px 40px; color:#7B7D7D;" align="left">
    <h5><strong style="color:#7B7D7D;">Tezos</strong></h5>
    <div style="margin-top:-10px; font-size:11px;">XTZ/USD</div>
    </div>
                    </div>

                    <div class="widget-big-int" style="margin-top:-33px;"><small>$</small><span class="tezos-price-usd"></span></div>
                    <div class="widget-subtitle">Change 24h
                      <span>
                        <span class="tezos-change-24hr-down" style="display:none;">
                          <span class="fas fa-sort-down fa-xs" style="vertical-align:2px;"></span>
                          <span class="tDown tezos-change-24hr" style="font-size:12px;"></span>
                        </span>
                        <span class="tezos-change-24hr-up" style="display:none;">
                          <span class="fas fa-sort-up fa-xs" style="vertical-align:-2px;"></span>
                          <span class="tUp tezos-change-24hr" style="font-size:12px;"></span>
                        </span>
                      </span>
                    </div>
                    <div class="widget-buttons widget-c3">


                            <div align="left" style="margin-top:0px; padding-left:15px;">
                            <!-- <span><a href="#modal_basic" class="widget-control-right linko" data-toggle="modal" style="font-size:13px; text-decoration:none;"><i class="fad fa-wallet"></i> Connect Wallet</a></span> -->
                            <span><a href="#" id="connect-wallet" class="widget-control-right" style="font-size:13px; text-decoration:none; color:#F39C12;"><i class="fad fa-wallet"></i> Connect Wallet</a></span>
                            <span style="padding-right:3px; padding-left:3px;">|</span>
                            <span><a href="#modal_small" data-toggle="modal" style="font-size:13px; text-decoration:none; color:#F39C12;"><i class="fad fa-qrcode"></i> Receive</a></span>
                            <span style="padding-right:3px; padding-left:3px;">|</span>
                            <span style="color:#797D7F;">USD Balance <i class="fas fa-dollar-sign"></i> <span class="usd-balance">0</span></span>
          </div>

                    </div>
                </div>
                <!-- END WIDGET CLOCK -->

            </div>
        </div>
        <!-- END WIDGETS -->

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="col-md-12" style="margin-bottom:-30px;">
                      <div class="col-md-6">
                        <h3 style="padding-top:20px;"><i class="fad fa-upload"></i> UPLOAD ZONE</h3>
                        <p>Make sure you upload a <code>WAV</code> format.</p>
                      </div>

                      <div class="col-md-6" align="right" style="padding-right:30px;">
                        <img id="cover-preview" src="<?= isset($artwork_src) ? $artwork_src : 'img/offline.jpg' ?>" style="width:80px; height:80px; border-radius:20px 10px 20px 10px;">
                        <p align="right"><small><strong>ALBUM COVER</strong></small></p>
                      </div>
                    </div>

                    <div class="row">
                      <!-- UPLOAD ZONE -->
                      <div class="panel-body">
                        <hr style="border-top:1px dashed #95B75D;">
                        <!-- UPLOAD ZONE ENDS -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-md-12 control-label"></label>
                            <div class="col-md-12">
                              <input type="file" class="fileinput btn-info btn-block" name="filename1" id="filename1" title="UPLOAD YOUR WAV HERE!" accept="audio/*" required>
                            </div>
                          </div>

                          <div align="justify" style="color:#c0c0c0; padding-right:20px; padding-left:20px;">
                            <small><strong>Note</strong>: You cannot mint a NFT without uploading an MP3 first.</small>
                          </div>

                          <div class="col-md-12" style="padding-bottom:30px; padding-top:20px;">
                            <?php if (!empty($song->IPFS_CID)) { ?>
                            <div>This asset was already minted</div>
                            <?php } ?>

                            <input type="hidden" id="license" value="<?= $license ?>">
                            <input type="hidden" id="filesize" value="<?= $filesize ?>">

                            <div class="form-group has-info">
                              <label class="control-label">RADION ID</label>
                              <input id="id" type="text" value="<?= $id ?>" class="form-control" readonly>
                            </div>

                            <div class="form-group has-info">
                              <label class="control-label">TITLE</label>
                              <input id="title" type="text" value="<?= $title ?>" class="form-control" readonly>
                            </div>

                            <div class="form-group has-info">
                              <label class="control-label">ARTIST</label>
                              <input id="artist" type="text" value="<?= $artist ?>" class="form-control" readonly>
                            </div>

                            <div class="form-group has-info">
                              <label class="control-label">ALBUM</label>
                              <input id="album" type="text" value="<?= $album ?>" class="form-control" readonly>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group has-info">
                              <label class="control-label">YEAR</label>
                              <input id="year" type="text" value="<?= $year ?>" class="form-control" readonly>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group has-info">
                              <label class="control-label">TRACK</label>
                              <input id="track" type="text" value="<?= $track ?>" class="form-control" readonly>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group has-info">
                              <label class="control-label">GENRE</label>
                              <input id="genre" type="text" value="<?= $genre ?>" class="form-control" readonly>
                            </div>
                          </div>

                          <div class="col-md-12" style="padding-bottom:30px; padding-top:20px;">
                            <div class="form-group has-info">
                              <label class="control-label">DESCRIPTION</label>
                              <textarea id="description" name="description" class="form-control"></textarea>
                            </div>
                          </div>

                          <div class="col-md-12" style="padding-top:0px;">
                                          <div class="form-group has-info">
                                            <label class="control-label">ISRC</label>
                                            <input id="isrc" type="text" value="" class="form-control">
                                          </div>
                                        </div>

                                        <div class="col-md-12" style="padding-top:20px;">
                                          <div class="form-group has-info">
                                            <label class="control-label">IDBML</label>
                                            <input id="idbml" type="text" value="" class="form-control">
                                          </div>
                                        </div>

                        </div>

                        <div class="col-md-6">

                          <div class="col-md-12" style="padding-top:0px;">
                            <div class="form-group has-info">
                              <label class="control-label">RECORD LABEL</label>
                              <input id="record-label" type="text" value="<?= $record ?>" class="form-control" readonly>
                            </div>
                          </div>

                          <div class="col-md-12" style="padding-top:20px;">
                            <div class="form-group has-info">
                              <label class="control-label">PUBLIC WALLET KEY</label>
                              <input id="wallet-address" name="wallet-address" type="text" class="form-control" value="<?= $slcustom6 ?>" placeholder="<?php echo $slcustom6; ?>" readonly>
                            </div>
                          </div>

                          <div class="col-md-12" style="padding-top:20px; padding-bottom:30px;">
                            <div class="form-group has-info">
                              <label class="control-label">PUBLISHER</label>
                              <input id="publisher" name="publisher" type="text" class="form-control" value="" placeholder="RADION - https://www.radion.fm" readonly>
                            </div>
                          </div>

                          <h3>LIMITED EDITIONS</h3>

                          <div class="col-md-12" style="margin-top:-28px;" align="right">
                            <div class="form-group has-info">
                              <label class="control-label">ALLOW SELL: </label>
                              <input style="margin-top:-3px;" class="iradio_minimal-grey" id="sell-allow" name="sell-allow" type="checkbox">
                            </div>
                          </div>

                          <div class="col-md-6" style="padding-top:20px;">
                            <div class="form-group has-info">
                              <label class="control-label">Limited Editions:</label>
                              <input id="editions-count" name="editions-count" type="number" class="form-control" value="">
                            </div>
                          </div>

                          <div class="col-md-6" style="padding-top:20px; padding-bottom:30px;">
                            <div class="form-group has-info">
                              <label class="control-label">Price per unit:</label>
                              <input id="sell-price" name="sell-price" type="number" class="form-control" value="" disabled>
                            </div>
                        </div>

                          <h5 style="padding-top:20px; color:#F39C12;">Select Licensing Terms</h5>

                          <div class="radio" style="padding-top:5px;">
                          <label>
                          <input type="radio" name="license-class" id="license-class-basic" value="basic"/>
                          Basic Lease
                          </label>
                          </div>

                          <div class="radio">
                          <label>
                          <input type="radio" name="license-class" id="license-class-youtube" value="youtube"/>
                          YouTube Lease
                          </label>
                          </div>

                          <div class="radio">
                          <label>
                          <input type="radio" name="license-class" id="license-class-trackout" value="trackout"/>
                          Trackout Lease
                          </label>
                          </div>

                          <div class="radio">
                          <label>
                          <input type="radio" name="license-class" id="license-class-premium" value="premium"/>
                          Premium Lease
                          </label>
                          </div>

                          <div class="radio" style="padding-bottom:20px;">
                          <label>
                          <input type="radio" name="license-class" id="license-class-exclusive" value="exclusive"/>
                          Exclusive Rights
                          </label>
                          </div>

                          <h5 style="padding-top:20px; color:#F39C12;">Legal Contract</h5>
                          <p>Do you want to enforce your NFT with a legal contract?</p>
                          <label>
                          <input type="radio" name="enforce-contract" id="enforce-contract-yes" value="yes"/>
                          Yes
                          <input type="radio" name="enforce-contract" id="enforce-contract-no" value="no" checked/>
                          No
                          </label>

                          <div class="form-group" style="margin-top:30px;">
                            <h5 style="color:#909497"><i class="fad fa-handshake fa-lg"></i><strong> Terms and Conditions</strong></h5>

                            <label class="check" style="padding-right:50px;"><input type="checkbox" name="agree_disagree"> <strong>Yes, I Accept.</strong></label>
                            <button type="button" id="submit_btn" class="btn btn-info btn-lg mb-control" disabled><i class="fas fa-check-circle"></i> Mint Now!</button>

                            <!-- Message with sound -->
                            <div class="message-box animated fadeIn" data-sound="alert" id="message-box-sound-1">
                              <div class="mb-container">
                                <div class="mb-middle">
                                  <div class="mb-title"><span class="fa fa-globe"></span> Alert</div>
                                  <div class="mb-content">
                                    <p>Important Note: We want to thank you for participating in RADION beta version! Keep in mind that no all modules are enable at this time, however your experience is very important to us... </p>
                                  </div>
                                  <div class="mb-footer">
                                    <button class="btn btn-success btn-lg pull-right mb-control-close"> Success </button>
                                    <button class="btn btn-danger btn-lg mb-control-close"> Cancel </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- END MESSAGE WITH SOUND -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div style="padding-bottom:20px; padding-top:20px;">
                      <h3><i class="fas fa-head-side-headphones fa-lg"></i> NETWORK REVIEW</h3>
                      <p>The result will determine whether or not your asset can be place in our live stream. You can vote for your own asset in marketplace!</p>
                    </div>

                    <!-- SUBMISSION LIST STATUS -->
                    <div class="panel panel-default">
                      <div class="form-group">
                        <div class="panel-body list-group list-group-contacts" id="status_table"></div>
                      </div>
                      <!-- END SUBMISSION LIST STATUS -->
                    </div>

                    <div>
                      <h3 style="color:#F39C12;">LICENSING AND TERMS</h3>
                      <li>MP3: <span id="nft-license-mp3"></span></li>
                      <li>WAV: <span id="nft-license-wav"></span></li>
                      <li>Trackout: <span id="nft-license-trackout"></span></li>
                      <li>Free Downloads: <span id="nft-license-free-downloads"></span></li>
                      <li>Distribution Copies: <span id="nft-license-distribution-copies"></span></li>
                      <li>Performances (No-Profit): <span id="nft-license-performances"></span></li>
                      <li>Paid Performances: <span id="nft-license-paid-performances"></span></li>
                      <li>Music Videos or (YouTube video): <span id="nft-license-music-videos"></span></li>
                      <li>Audio Streams: <span id="nft-license-audio-streams"></span></li>
                      <li>Video Streams: <span id="nft-license-video-streams"></span></li>
                      <li>Broadcasting Rights: <span id="nft-license-broadcasting-rights"></span></li>
                      <li>Number of radio stations: <span id="nft-license-radio-stations"></span></li>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-md-12" style="padding-bottom:50px;">
                  <form class="form-horizontal">
                    <div class="panel panel-default tabs">
                      <ul class="nav nav-tabs" role="tablist" style="padding-bottom:20px;">
                        <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">ASSETS</a></li>
                        <li><a href="#tab-second" role="tab" data-toggle="tab">CURRENT NFT</a></li>
                        <li><a href="#tab-third" role="tab" data-toggle="tab">LEGAL CONTRACTS</a></li>
                      </ul>

                      <div class="panel-body tab-content">
                        <div class="tab-pane active" id="tab-first">
                          <table style="width:100%;">
                            <thead>
                              <tr style="border-bottom: 2px solid #dddddd;" align="center">
                                <th style="width:15%; padding-bottom:10px; font-size:10px;"># ID</th>
                                <th align="center" style="width:10%; padding-bottom:10px; font-size:10px;">EARNINGS</th>
                                <th align="center" style="width:15%; padding-bottom:10px; font-size:10px;">SONG NAME</th>
                                <th align="center" style="width:15%; padding-bottom:10px; font-size:10px;">GENRE</th>
                                <th align="center" style="width:20%; padding-bottom:10px; font-size:10px;">NFT</th>
                                <th align="center" style="width:10%; padding-bottom:10px; font-size:10px;">EDITIONS</th>
                                <th align="center" style="width:15%; padding-bottom:10px; font-size:10px;">LICENSE AGREEMENT</th>
                              </tr>
                            </thead>
                            <tbody id="current_asset_table"></tbody>
                          </table>
                        </div>

                        <div class="tab-pane" id="tab-second">
                          <table style="width:100%;">
                            <thead>
                              <tr style="border-bottom: 2px solid #dddddd;" align="center">
                                <th style="width:5%; padding-bottom:10px; font-size:10px;">NFT</th>
                                <th align="center" style="width:15%; padding-bottom:10px; font-size:10px;"># ID</th>
                                <th align="center" style="width:13%; padding-bottom:10px; font-size:10px;">POTENTIAL PAYOUT</th>
                                <th align="center" style="width:12%; padding-bottom:10px; font-size:10px;">PAID</th>
                                <th align="center" style="width:30%; padding-bottom:10px; font-size:10px;">TRANSACTION HASH</th>
                                <th align="center" style="width:8%; padding-bottom:10px; font-size:10px;">PRICE</th>
                                <th align="center" style="width:7%; padding-bottom:10px; font-size:10px;">EDITIONS</th>
                                <th align="center" style="width:10%; padding-bottom:10px; font-size:10px;">LICENSE AGREEMENT</th>
                              </tr>
                            </thead>

                            <tbody id="current_asset_table_nft"></tbody>
                          </table>
                        </div>

                        <div class="tab-pane" id="tab-third">
                          <table style="width:100%;">
                            <thead>
                              <tr style="border-bottom: 2px solid #dddddd;" align="center">
                                <th align="center" style="width:5%; padding-bottom:10px; font-size:10px;">NFT</th>
                                <th align="center" style="width:35%; padding-bottom:10px; font-size:10px;">TRANSACTION HASH</th>
                                <th align="center" style="width:15%; padding-bottom:10px; font-size:10px;">BUYER</th>
                                <th align="center" style="width:15%; padding-bottom:10px; font-size:10px;">SELLER</th>
                                <th align="center" style="width:10%; padding-bottom:10px; font-size:10px;">CONTRACT TYPE</th>
                                <th align="center" style="width:15%; padding-bottom:10px; font-size:10px;">EXPIRATION</th>
                                <th align="center" style="width:5%; padding-bottom:10px; font-size:10px;">AGREEMENT</th>
                              </tr>
                            </thead>
                            <tbody>
<?php

$contracts = $con->query("SELECT * FROM `contracts` WHERE `producer`='$slusername' OR `buyer`='$slname'");
while ($row = $contracts->fetch_object()) {
  $time = time();
  $expiration = strtotime($row->date) + 31536000;
  $producer = $row->producer;
  $seller_res = $con->query("SELECT * FROM `sitelok` WHERE `Username`='$producer'");
  $producer_name = $seller_res->fetch_object()->Name;
  $license = $row->license;
  $license_name = '';

  if ($license === 'exclusive') $expiration = 'Permanent';
  else if ($time >= $expiration) $expiration = 'Contract ended';
  else $expiration = date('Y-m-d H:i:s', $expiration);

  switch ($license) {
    case 'basic':
      $license_name = 'Basic Lease';
      break;

    case 'youtube':
      $license_name = 'YouTube Lease';
      break;

    case 'trackout':
      $license_name = 'Trackout Lease';
      break;

    case 'premium':
      $license_name = 'Premium Lease';
      break;

    case 'exclusive':
      $license_name = 'Exclusive Rights';
      break;
  }

?>
<tr>
  <td style="padding-top:5px; padding-bottom:5px; border-bottom: 1px solid #dddddd; font-size:11px;"><?= $row->edition_id ?></td>
  <td style="padding-top:5px; padding-bottom:5px; border-bottom: 1px solid #dddddd; font-size:11px; color:#2980B9;"><?= $row->hash ?></td>
  <td style="padding-top:5px; padding-bottom:5px; border-bottom: 1px solid #dddddd; font-size:11px;"><?= $row->producer === $slusername ? $row->buyer : '' ?></td>
  <td style="padding-top:5px; padding-bottom:5px; border-bottom: 1px solid #dddddd; font-size:11px;"><?= $row->buyer === $slname ? $producer_name : '' ?></td>
  <td style="padding-top:5px; padding-bottom:5px; border-bottom: 1px solid #dddddd; font-size:11px;"><?= $license_name ?></td>
  <td style="padding-top:5px; padding-bottom:5px; border-bottom: 1px solid #dddddd; font-size:11px;"><?= $expiration ?></td>
  <td style="padding-top:5px; padding-bottom:5px; border-bottom: 1px solid #dddddd; font-size:11px;">
    <a href="/php/request_contract.php?hash=<?= $row->hash ?>" download="contract.pdf" class="btn btn-default btn-xs" role="button">DOWNLOAD</a>
  </td>
</tr>
<?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT WRAPPER -->
      </div>
      <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->

    <!-- MESSAGE BOX-->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
      <div class="mb-container">
        <div class="mb-middle">
          <div class="mb-title"><span class="fas fa-sign-out-alt"></span> Log <strong>Out</strong> ?</div>
          <div class="mb-content">
            <p>Are you sure you want to log out?</p>
            <p>Press No if youwant to continue work. Press Yes to logout current session.</p>
          </div>
          <div class="mb-footer">
            <div class="pull-right">
              <a href="/slpw/sitelokpw.php?sitelokaction=logout" class="btn btn-success btn-lg">Yes</a>
              <button class="btn btn-default btn-lg mb-control-close">No</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END MESSAGE BOX-->
  </div>

  <!-- START SIDEBAR -->
  <div class="sidebar">
    <div class="sidebar-wrapper scroll">
      <div class="sidebar-tabs">
        <a href="#sidebar_1" class="sidebar-tab active"><span class="fa fa-comments"></span> NFT MUSIC</a>
        <a href="#sidebar_2" class="sidebar-tab"><span class="fa fa-cog"></span> TERMS AND LICENSING</a>
      </div>

      <div class="sidebar-tab-content active" id="sidebar_1">
        <p style="padding-right:20px; padding-left:20px;" align="justify"><small>Important:<br><br><span style="color:#B3B6B7;">This simple form allow you to mint NFT music and sell them in our marketplace with the proper rights, however; this form is open to the public and it doesn't require a RADION account to use it. Be aware that potential buyers could pay attention to these details to make sure that if they buy a NFT, they are buying something legal and legit.<br><br> If you want to prove that you are the right holder of the song and be recognized by your talent and as an artist, we recommend you mint your NFT in our dashboard for more details.</small></span></p>

        <div class="content-frame-right">
          <div class="block push-up-10">
            <form action="upload.php" class="dropzone dropzone-mini" id="upload-dropzone"></form>
          </div>
          <p style="padding-left:20px; padding-right:20px;"><small><span style="color:#F39C12;">Note</span>: Make sure you drop your mp3 or wav file and your artwork img to mint your NFT.</small></p>
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <div class="col-md-12">
                <input type="text" placeholder="Artist Name" id="mint-artist" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <input type="text" placeholder="Song Name" id="mint-title" class="form-control">
              </div>
              <div class="col-md-4">
                <input type="text" placeholder="Genre" id="mint-genre" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Sell</label>
              <div class="col-md-2">
                <label class="switch switch-small">
                  <input type="checkbox" id="mint-sell" value="0">
                  <span></span>
                </label>
              </div>

              <div class="col-md-4">
                <input type="text" placeholder="Editions" id="mint-editions" class="form-control" disabled>
              </div>

              <div class="col-md-4">
                <input type="text" placeholder="Price in USD" id="mint-price" class="form-control" disabled>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">License</label>
              <div class="col-md-2">
                <label class="switch switch-small">
                  <input type="checkbox" id="mint-license" value="0">
                  <span></span>
                </label>
              </div>

              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <div class="col-md-8">
                    <div class="btn-group">
                      <a href="javascript:void(0)" class="btn btn-default dropdown-toggle" id="mint-terms-dropdown" disabled><span id="mint-terms">Select Terms & Licensing</span> <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="javascript:void(0)" id="mint-essential">Essential</a></li>
                        <li><a href="javascript:void(0)" id="mint-premium">Premium</a></li>
                        <li><a href="javascript:void(0)" id="mint-commercial">Commercial</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </form>
        </div>

        <div style="padding:15px;">
          <button class="btn btn-warning btn-block" id="mint-submit">MINT NOW</button>
        </div>

        <p align="center" style="color:#F39C12; padding-bottom:50px;"><small>3.69% commission fee per sell</small></p>
      </div>

      <div class="sidebar-tab-content form-horizontal" id="sidebar_2">
        <p style="padding:25px; color:#B3B6B7;" align="justify"><small>RADION attach a digital legal contract to each NFT. This contract detailed the terms and licensing that your NFT is subject to and how buyers can use your asset without infringements. Currently, RADION allows you to work with 3 different terms and licensing! These license apply for those who purchase the NFT. <br><br>
        <span style="color:#fff;"><strong>Essential</strong></span> - Price per Unit suggested $20 USD<br><br>
MP3: Yes<br>
WAV: No<br>
Trackout: No<br>
Free Downloads: No<br>
Distribution Copies: 5000<br>
Performances (No-Profit): None<br>
Paid Performances: 100<br>
Music Videos or (YouTube video): 1<br>
Audio Streams: Unlimited<br>
Video Streams: No<br>
Broadcasting Rights: Yes<br>
Number of radio stations: Unlimited<br>
Exclusive Rights: No<br><br>
<span style="color:#fff;"><strong>Premium</strong></span>- Price per Unit suggested $50 USD<br><br>
MP3: Yes<br>
WAV: No<br>
Trackout: No<br>
Free Downloads: No<br>
Distribution Copies: 8000<br>
Performances (No-Profit): None<br>
Paid Performances: 200<br>
Music Videos or (YouTube video): 2<br>
Audio Streams: Unlimited<br>
Video Streams: No<br>
Broadcasting Rights: Yes<br>
Number of radio stations: Unlimited<br>
Exclusive Rights: No<br><br>
<span style="color:#fff;"><strong>Commercial</strong></span> - Price per Unit suggested $300 USD<br><br>
MP3: Yes<br>
WAV: Yes<br>
Trackout: Yes<br>
Free Downloads: No<br>
Distribution Copies: 10000<br>
Performances (No-Profit): None<br>
Paid Performances: Unlimited<br>
Music Videos or (YouTube video): Unlimited<br>
Audio Streams: Unlimited<br>
Video Streams: No<br>
Broadcasting Rights: Yes<br>
Number of radio stations: Unlimited<br>
Exclusive Rights: No<br></small></p>
      </div>
    </div>
  </div>

  <!-- START PRELOADS -->
  <audio id="audio-alert" src="/audio/alert.mp3" preload="auto"></audio>
  <audio id="audio-fail" src="/audio/fail.mp3" preload="auto"></audio>
  <!-- END PRELOADS -->

  <!-- START SCRIPTS -->
  <!-- START PLUGINS -->
  <script src="/js/plugins/jquery/jquery.min.js"></script>
  <script src="/js/plugins/jquery/jquery-ui.min.js"></script>
  <script src="/js/plugins/bootstrap/bootstrap.min.js"></script>
  <script src="/js/all.min.js"></script>
  <script src="/js/plugins/dropzone/dropzone.min.js"></script>
  <script src="https://unpkg.com/@airgap/beacon-sdk@2.3.1/dist/walletbeacon.min.js"></script>
  <script>window.beaconSdk = beacon</script>
  <script src="https://unpkg.com/@taquito/taquito@10.1.0/dist/taquito.min.js"></script>
  <script src="https://unpkg.com/@taquito/beacon-wallet@10.1.0/dist/taquito-beacon-wallet.umd.js"></script>
  <!-- END PLUGINS -->

  <!-- START THIS PAGE PLUGINS-->
  <script src="/js/plugins/icheck/icheck.min.js"></script>
  <script src="/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
  <script src="/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
  <script src="/js/plugins/cropper/cropper.min.js"></script>
  <script src="/js/plugins/fileinput/fileinput.min.js"></script>
  <script src="/js/plugins/rickshaw/d3.v3.js"></script>
  <script src="/js/plugins/rickshaw/rickshaw.min.js"></script>
  <script src="/js/plugins/owl/owl.carousel.min.js"></script>
  <script src="/js/plugins/moment.min.js"></script>
  <script src="/js/plugins/jstree/jstree.min.js"></script>
  <script src="/js/demo_file_handling.js"></script>
  <!-- END THIS PAGE PLUGINS-->

  <!-- THIS PAGE PLUGINS -->
  <script src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>
  <script src="/js/plugins/bootstrap/bootstrap-select.js"></script>
  <script src="/js/plugins/noty/jquery.noty.js"></script>
  <script src="/js/plugins/noty/layouts/topRight.js"></script>
  <script src="/js/plugins/noty/themes/default.js"></script>
  <!-- END THIS PAGE PLUGINS -->

  <!-- START TEMPLATE -->
  <script src="/js/plugins.js"></script>
  <script src="/js/actions.js"></script>
  <script src="/js/demo_dashboard.js"></script>
  <script src="/js/id3-minimized.js"></script>
  <!-- END TEMPLATE -->

  <script src="https://unpkg.com/ipfs@0.54.4/dist/index.min.js"></script>
  <script src="/js/helpers.js"></script>
  <script src="/js/ipfs.js"></script>
  <script src="/js/minter-2.js"></script>
  <script src="/js/minter-editions.js"></script>
  <script src="/js/tezos.js"></script>
  <script>
  $(document).ready(function() {
    express_view()
    load_status_table()
    current_asset_table()
    current_asset_table_nft()

    setInterval(function() {
      load_status_table()
    }, 1000)
  })

  function load_status_table () {
    $.ajax({
      url: 'submission_status_table.php',
      type: 'POST',
      success: function(data, textStatus, jqXHR) {
        $('#status_table').html(data)
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log('Ajax Failed Error In Saving:' + textStatus)
      }
    })
  }

  function current_asset_table () {
    $.ajax({
      url: 'php/current_asset_table_editions.php',
      type: 'POST',
      success: function(data, textStatus, jqXHR) {
        $('#current_asset_table').html(data)
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log('Ajax Failed Error In Saving:' + textStatus)
      }
    })
  }

  function current_asset_table_nft () {
    $.ajax({
      url: 'php/current_asset_table_editions_nft.php',
      type: 'POST',
      success: function(data, textStatus, jqXHR) {
        $('#current_asset_table_nft').html(data)
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log('Ajax Failed Error In Saving:' + textStatus)
      }
    })
  }

  function express_view () {
    $.ajax({
      url: 'php/get_info.php',
      type: 'POST',
      data: { type: 2 },
      success: function(data) {
        if (!data.includes('NOTAVAIABLE')) {
          result = data.split('#####')
          on_link = ' '

          if (result[3] != 0) {
            on_link = '<a href="http://' + result[3] + '" target="_blank" style="text-decoration:none" rel="nofollow"> Visit sponsor</a>';
          }

          $('#on_sibmission').html(result[2] + on_link)
          if (result[4] != 'NO_IAMGE') {
            // $('.backg').css('background-image', 'url(' + result[4] + ')')
          }

          // document.body.style.backgroundImage = 'url("img_tree.png")'
          // var x = document.getElementsByClassName('example')
          $('#message_box').css('display', 'block')
        } else {
          $('#message_box').css('display', 'none')
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        if (xhr.status === 404) {
          // alert('Not allowed.')
        }

        if (xhr.status === 403) {
          // alert('Not allowed.')
        }
      }
    })
  }
  </script>
  <!-- END SCRIPTS -->

  <div class="modal" id="modal_no_footer" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="defModalHead"><i class="fa fa-exclamation-circle"></i> LICENSING CHART</h4>
        </div>

        <div class="modal-body">
          <p align="justify" style="padding-left:3%; padding-right:3%; padding-bottom:20px;">
            Creative Commons is a one of several public
            copyright license that enable the free distribution of an otherwise copyrighted "work" and it is characterized by the following icon
            <i class="fab fa-creative-commons fa-lg"></i>.<br><br>
            Public license or public copyright license is a license by which a copyright holder as licensor
            can grant additional copyright permissions to any and all persons in the general public as licensees.
          </p>

          <div style="background-color:#CCE4C8; padding:25px 5px 5px 25px; height:100px;">
            <i class="fab fa-creative-commons fa-2x"></i> <i class="fab fa-creative-commons-by fa-2x"></i> <span style="padding-left:85px; padding-right:30px;"> = </span><span align="right">Attribution alone</span><br>
            <i class="fab fa-creative-commons fa-2x"></i> <i class="fab fa-creative-commons-by fa-2x"></i> <i class="fab fa-creative-commons-sa fa-2x"></i> <span style="padding-left:60px; padding-right:30px;"> = </span> <span align="right">Attribution + ShareAlike</span>
            <p style="padding-top:5px; padding-right:10px; color:#27ae60" align="right"> - Attribution and allow Share, Remix and Commercial use -</p>
          </div>

          <div style="background-color:#E5EED6; padding:25px 5px 5px 25px; height:100px;">
            <i class="fab fa-creative-commons fa-2x"></i> <i class="fab fa-creative-commons-by fa-2x"></i> <i class="fab fa-creative-commons-nc fa-2x"></i> <span style="padding-left:60px; padding-right:30px;"> = </span><span align="right">Sharing + Non-Commercial</span><br>
            <i class="fab fa-creative-commons fa-2x"></i> <i class="fab fa-creative-commons-by fa-2x"></i> <i class="fab fa-creative-commons-nc fa-2x"></i> <i class="fab fa-creative-commons-sa fa-2x"></i> <span style="padding-left:35px; padding-right:30px;"> = </span><span align="right">Attribution + Noncommercial + ShareAlike</span>
            <p style="padding-top:5px; padding-right:10px; color:#27ae60" align="right">- Attribution and allow Share and Remix only -</p>
          </div>

          <div style="background-color:#F4F4D2; padding:25px 5px 5px 25px; height:100px;">
            <i class="fab fa-creative-commons fa-2x"></i> <i class="fab fa-creative-commons-by fa-2x"></i> <i class="fab fa-creative-commons-nd fa-2x"></i><span style="padding-left:60px; padding-right:30px;"> = </span><span align="right">Attribution + NoDerivatives</span><br>
            <i class="fab fa-creative-commons fa-2x"></i> <i class="fab fa-creative-commons-by fa-2x"></i> <i class="fab fa-creative-commons-nc fa-2x"></i> <i class="fab fa-creative-commons-nd fa-2x"></i><span style="padding-left:35px; padding-right:30px;"> = </span><span align="right">Attribution + Noncommercial + NoDerivatives</span>
            <p style="padding-top:5px; padding-right:10px; color:#f39c12" align="right">- Attribution and allow Share only. *Option 1 also allow Commercial use -</p>
          </div>

          <div style="background-color:#EDE2E2; padding:25px 5px 5px 25px; height:80px;">
            <i class="fa fa-copyright fa-2x"></i> <span style="padding-left:110px; padding-right:30px;"> = </span><span align="right">All Rights Reserved</span><br>
            <p style="padding-top:5px; padding-right:10px; color:#c0392b" align="right"> - Least Open -</p>
          </div><br>

          <p align="justify" style="padding-right:3%; padding-left:3%;">
            <strong>IMPORTANT NOTE</strong>:<br><br> We recommend you the following Licensing to distribute your work in our platform.
            <i class="fab fa-creative-commons fa-lg"></i>
            <i class="fab fa-creative-commons-by fa-lg"></i>
            <i class="fab fa-creative-commons-nc fa-lg"></i>
            <i class="fab fa-creative-commons-nd fa-lg"></i>
            <br><br>

            Keep in mind that CC license does not create conflict with other agreement as long as you don't have an exclusive deal. If you put your music under a non-commercial or no derivatives license, you still open
            to other deals. Agency or entities can contact you directly through RADION platform at any time. Just keep your profile info updated.<br><br>

            <p>
              <div align="right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </p>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script>
  var clipboard = new Clipboard('.copyButton')

  clipboard.on('success', function(e) {
    console.log(e)
  })

  clipboard.on('error', function(e) {
    console.log(e)
  })

  const inputs = [
    '#filename1',
    '[name="agree_disagree"]'
  ]

  $(inputs.join()).on('input', submitButton)
  $(inputs.join()).on('change', submitButton)

  function submitButton () {
    for (let i = 0; i < inputs.length; i++) {
      const input = inputs[i]
      const value = $(input).is('[type="checkbox"]') ? $(input).is(':checked') : $(input).val()
      if (!value) {
        $('#submit_btn').attr('disabled', true)
        return
      }
    }

    $('#submit_btn').attr('disabled', null)
  }

  $('[name="license-class"]').on('change', function () {
    const licenseClass = $('[name="license-class"]:checked').val()
    switch (licenseClass) {
      case 'basic':
        $('#nft-license-mp3').text('Yes')
        $('#nft-license-wav').text('No')
        $('#nft-license-trackout').text('No')
        $('#nft-license-free-downloads').text('No')
        $('#nft-license-distribution-copies').text('3000')
        $('#nft-license-performances').text('Unlimited')
        $('#nft-license-paid-performances').text('None')
        $('#nft-license-music-videos').text('1')
        $('#nft-license-audio-streams').text('Unlimited')
        $('#nft-license-video-streams').text('No')
        $('#nft-license-broadcasting-rights').text('No')
        $('#nft-license-radio-stations').text('None')
        break

      case 'youtube':
        $('#nft-license-mp3').text('')
        $('#nft-license-wav').text('')
        $('#nft-license-trackout').text('')
        $('#nft-license-free-downloads').text('')
        $('#nft-license-distribution-copies').text('')
        $('#nft-license-performances').text('')
        $('#nft-license-paid-performances').text('')
        $('#nft-license-music-videos').text('')
        $('#nft-license-audio-streams').text('')
        $('#nft-license-video-streams').text('')
        $('#nft-license-broadcasting-rights').text('')
        $('#nft-license-radio-stations').text('')
        break

      case 'trackout':
        $('#nft-license-mp3').text('Yes')
        $('#nft-license-wav').text('No')
        $('#nft-license-trackout').text('No')
        $('#nft-license-free-downloads').text('No')
        $('#nft-license-distribution-copies').text('8000')
        $('#nft-license-performances').text('None')
        $('#nft-license-paid-performances').text('200')
        $('#nft-license-music-videos').text('2')
        $('#nft-license-audio-streams').text('Unlimited')
        $('#nft-license-video-streams').text('No')
        $('#nft-license-broadcasting-rights').text('Yes')
        $('#nft-license-radio-stations').text('Unlimited')
        break

      case 'premium':
        $('#nft-license-mp3').text('Yes')
        $('#nft-license-wav').text('No')
        $('#nft-license-trackout').text('Yes')
        $('#nft-license-free-downloads').text('No')
        $('#nft-license-distribution-copies').text('10000')
        $('#nft-license-performances').text('None')
        $('#nft-license-paid-performances').text('Unlimited')
        $('#nft-license-music-videos').text('Unlimited')
        $('#nft-license-audio-streams').text('Unlimited')
        $('#nft-license-video-streams').text('No')
        $('#nft-license-broadcasting-rights').text('Yes')
        $('#nft-license-radio-stations').text('Unlimited')
        break

      case 'exclusive':
        $('#nft-license-mp3').text('No')
        $('#nft-license-wav').text('Yes')
        $('#nft-license-trackout').text('Yes')
        $('#nft-license-free-downloads').text('Unlimited')
        $('#nft-license-distribution-copies').text('Unlimited')
        $('#nft-license-performances').text('Unlimited')
        $('#nft-license-paid-performances').text('Unlimited')
        $('#nft-license-music-videos').text('Unlimited')
        $('#nft-license-audio-streams').text('Unlimited')
        $('#nft-license-video-streams').text('Unlimited')
        $('#nft-license-broadcasting-rights').text('Yes')
        $('#nft-license-radio-stations').text('Unlimited')
    }
  })
  </script>
</body>
</html>
