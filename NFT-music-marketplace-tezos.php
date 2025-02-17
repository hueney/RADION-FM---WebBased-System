<!DOCTYPE html>
<html lang="en">
<head>
  <title>NFT for Music</title>
  <meta property="og:description" content="RADION FM allows you to create NFT for your music on Tezos blockchain.">
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
  <link rel="manifest" href="/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <link rel="stylesheet" href="css/theme-dark.css" id="theme">
  <script src="https://cdn.lordicon.com//libs/frhvbuzj/lord-icon-2.0.2.js"></script>
  <script src="https://unpkg.com/@airgap/beacon-sdk@2.3.1/dist/walletbeacon.min.js"></script>
  <script>window.beaconSdk = beacon</script>
  <script src="https://unpkg.com/@taquito/taquito@10.1.0/dist/taquito.min.js"></script>
  <script src="https://unpkg.com/@taquito/beacon-wallet@10.1.0/dist/taquito-beacon-wallet.umd.js"></script>
  <script src="https://unpkg.com/@taquito/michel-codec@10.1.0/dist/taquito-michel-codec.umd.js"></script>
  <script src="https://unpkg.com/mp3tag.js@3.1.1/dist/mp3tag.min.js"></script>
  <script src="https://unpkg.com/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
</head>

<body>
  <!-- START PAGE CONTAINER -->
  <div class="page-container page-navigation-top page-navigation-top-custom">
    <!-- PAGE CONTENT -->
    <div class="page-content">
      <!-- START PAGE CONTENT HEADER -->
      <div class="page-content-header">
        <a href="index.php" class="logo"><img src="/img/letsgo.png"></a>
        <div class="pull-right">
          <div class="socials">
            <a href="https://t.me/joinchat/TdHnxqPrcJPK3mZ1" target="blank" rel="nofollow"><span class="fab fa-telegram"></span></a>
            <a href="https://twitter.com/fm_radion" target="blank" rel="nofollow"><span class="fab fa-twitter"></span></a>
            <a href="https://www.youtube.com/channel/UCuJOeoT-2o2stPXXJJGzAdg" target="blank" rel="nofollow"><span class="fab fa-youtube"></span></a>

          </div>

          <div class="contacts">
            <a href="#" id="connect-wallet">CONNECT WALLET</a>
            <a href="user-assets.php">MY ASSETS</a>
            <a href="#" class="sidebar-toggle">MINT MUSIC</a>
          </div>
        </div>
      </div>
      <!-- END PAGE CONTENT HEADER -->

      <!-- START X-NAVIGATION VERTICAL -->
      <ul class="x-navigation x-navigation-horizontal">
        <li class="xn-navigation-control">
          <a href="#" class="x-navigation-control"></a>
        </li>

        <!-- SEARCH -->
        <li class="xn-search pull-right">
          <form role="form">
            <input type="text" name="search" placeholder="Search..."/>
          </form>
        </li>
        <!-- END SEARCH -->
      </ul>
      <!-- END X-NAVIGATION VERTICAL -->

      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li><a href="#"></a></li>
        <li class="active">This is an experimental feature open to the public. Our platform allows music producers to create NFT for their music and and sell them as NFT.</li>
      </ul>
      <!-- END BREADCRUMB -->

      <!-- INFORMATION FOR MARKETPLACE -->
      <div class="row">
        <div class="col-md-2">
          <a href="#" class="tile tile-primary">
            <span>Balance</span>
            <p id="wallet-balance"> <span>tez</span></p>
            <div class="informer informer-primary dir-tr"></div>
          </a>
        </div>

        <div class="col-md-2">
          <a href="#" class="tile tile-primary">
            $0
            <p>Total Marketcap</p>
            <div class="informer informer-primary dir-tr"></div>
          </a>
        </div>

        <div class="col-md-2">
          <a href="#" class="tile tile-primary">
            3.69%
            <p>Commission Fee</p>
            <div class="informer informer-primary dir-tr"></div>
          </a>
        </div>

        <div class="col-md-2">
          <a href="#" class="tile tile-primary">
            $0
            <p>Sales</p>
            <div class="informer informer-primary dir-tr"></div>
          </a>
        </div>

        <div class="col-md-2">
          <a href="#" class="tile tile-primary">
            <span id="editions-size">0</span>
            <p>ASSETS</p>
            <div class="informer informer-danger dir-tr"></div>
          </a>
        </div>

        <div class="col-md-2">
          <a href="#" class="tile tile-primary">
            <span><div align="center" style="color:#33414E; width:50px; height:50px; margin-left:80px; margin-bottom:5px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="47" height="64" viewBox="0 0 47 64">
                <path style="fill:#85929E;" d="M30.252 63.441c-4.55 0-7.864-1.089-9.946-3.267-2.08-2.177-3.121-4.525-3.121-7.041 0-.92.181-1.694.544-2.323a3.993 3.993
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
            </div></span>
            <p>$ <span class="tezos-price-usd"></span></p>
            <div class="informer informer-default"></div>
          </a>
        </div>
      </div>
      <!-- END INFORMATION FOR MARKETPLACE -->

      <div class="page-title">
        <h2>NFT MUSIC ASSETS</h2>
      </div>

      <!-- PAGE CONTENT WRAPPER -->
      <div class="page-content-wrap" style="min-height: 439px;">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body" id="nft-editions">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- PAGE CONTENT WRAPPER -->

      <template id="temp-edition">
        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-body panel-body-image">
              <img class="nft-artwork" src="/img/NFT.jpg" width="205" height="205">
              <a href="javascript:void(0)" class="panel-body-inform">
                <lord-icon src="https://cdn.lordicon.com//iiegcyhs.json" class="nft-play" trigger="click" target="a" stroke="70" colors="primary:#ffffff,secondary:#ffffff" style="width:42px;height:42px; margin-top:-7px; margin-left:-7px;"></lord-icon>
                <!-- <i class="fas fa-play nft-play"></i> -->
              </a>
            </div>

            <div class="panel-body">
              <div align="right" style="margin-top:-20px;"><label class="label label-default label-sm nft-format"></label></div>
              <div class="fas fa-shield-check fa-lg nft-shield" style="display:none; color:#229954; position:absolute; right:1;"></div>
              <h3 align="center" class="nft-artist"></h3>
              <p align="center"><span class="nft-title"></span></p>
              <div>Issuer: <span class="nft-issuer-address" style="font-size:11px; color:#979A9A;"></span></div>
              <div>Hosting: <span class="nft-host"></span></div>
              <div>Price: <span class="nft-price" style="color:#2980B9;"></span> <span style="color:#2980B9;">tz</span><span class="nft-sold-out"> / </span><strong class="nft-sold-out">$<span class="nft-price-usd"></span></strong></div>
              <div>Editions Available: <strong><span class="nft-editions-avail" style="color:#F39C12;"></span></strong></div>
              <div>Genre: <span class="nft-genre"></span></div>
              <div>Legal Contract: <strong><span class="nft-terms"></span></strong></div>
            </div>

            <div class="panel-footer text-muted" align="center">
              <button class="btn btn-primary btn-block btn-sm nft-buy">BUY</button>
            </div>
          </div>
        </div>
      </template>
    </div>
    <!-- END PAGE CONTENT -->
  </div>
  <!-- END PAGE CONTAINER -->

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

              <div class="form-group">
                <div class="col-md-8">
                  <div class="btn-group">
                    <a href="javascript:void(0)" class="btn btn-default dropdown-toggle" id="mint-terms-dropdown" disabled><span id="mint-terms">Select Terms & Licensing</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="javascript:void(0)" id="mint-basic">Basic Lease</a></li>
                      <li><a href="javascript:void(0)" id="mint-trackout">Trackout Lease</a></li>
                      <li><a href="javascript:void(0)" id="mint-premium">Premium Lease</a></li>
                      <li><a href="javascript:void(0)" id="mint-exclusive">Exclusive Rights</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div style="padding:15px;">
          <button class="btn btn-warning btn-block" id="mint-submit">MINT NOW</button>
        </div>

        <p align="center" style="color:#F39C12; padding-bottom:50px;"><small>3.69% commission fee per sell</small></p>
      </div>

      <div class="sidebar-tab-content form-horizontal" id="sidebar_2">
        <p style="padding:10px 30px 0px 30px; color:#B3B6B7;" align="justify"><small style="color:#fff;">RADION FM respects the intellectual property rights of others, and we expect our users to do the same. We use legal contracts to detail the terms that the asset is subject to, along with its licensing. Buyers must respect the terms of the contract in order to avoid copyright infringements and prevent potential penalties.</small><br><br>
</small></p>
<div style="border-bottom: 1px dashed #7B7D7D; padding: 0px 30px 0px 30px; "></div>
<p style="padding:20px 40px 0px 40px; color:#B3B6B7;" align="justify">
<small><span style="color:#fff;"><strong>Basic Lease</strong></span> - 1 Year Contract / PPU Suggested <span style="color:#f2c945;">$20</span> USD<br><br>
MP3: Yes<br>
WAV: No<br>
Licensing: Attributions / No Derivatives | <i class="fab fa-creative-commons fa-lg"></i> <i class="fab fa-creative-commons-by fa-lg"></i> <i class="fab fa-creative-commons-nd fa-lg"></i><br>
Trackout: No<br>
Free Downloads: No<br>
Distribution Copies: 3000<br>
Performances (No-Profit): Unlimited<br>
Paid Performances: None<br>
Music Videos or (YouTube video): 1<br>
Audio Streams: Unlimited<br>
Video Streams: No<br>
Broadcasting Rights: No<br>
Number of radio stations: None<br>
Exclusive Rights: No<br><br>
This license lets others reuse the work for any purpose, including commercially; however, it cannot be shared with others in adapted form, and credit must be provided to you.<br><br></small></p>

<div style="border-bottom: 1px dashed #7B7D7D; padding-right:30px; padding-left:30px;"></div>

<p style="padding:20px 40px 0px 40px; color:#B3B6B7;" align="justify"><small>
<span style="color:#fff;"><strong>Trackout Lease</strong></span>- 1 Year Contract / PPU Suggested <span style="color:#f2c945;">$100</span> USD<br><br>
MP3: Yes<br>
WAV: No<br>
Licensing: Attributions / No Derivatives | <i class="fab fa-creative-commons fa-lg"></i> <i class="fab fa-creative-commons-by fa-lg"></i> <i class="fab fa-creative-commons-nd fa-lg"></i><br>
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
This license lets others reuse the work for any purpose, including commercially; however, it cannot be shared with others in adapted form, and credit must be provided to you.<br><br></small></p>

<div style="border-bottom: 1px dashed #7B7D7D; padding:10px;"></div>

<p style="padding:20px 40px 0px 40px; color:#B3B6B7;" align="justify"><small>
<span style="color:#fff;"><strong>Lease Premium</strong></span> - 1 Year Contract / Price Suggested <span style="color:#f2c945;">$300</span> USD<br><br>
MP3: Yes<br>
WAV: No<br>
Licensing: Attributions / No Derivatives | <i class="fab fa-creative-commons fa-lg"></i> <i class="fab fa-creative-commons-by fa-lg"></i> <i class="fab fa-creative-commons-nd fa-lg"></i><br>
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
Exclusive Rights: No<br><br>
This license lets others reuse the work for any purpose, including commercially; however, it cannot be shared with others in adapted form, and credit must be provided to you.<br><br></small></p>

<div style="border-bottom: 1px dashed #7B7D7D; padding:10px;"></div>

<p style="padding:20px 40px 0px 40px; color:#B3B6B7;" align="justify"><small>
<span style="color:#fff;"><strong>Exclusive Rights</strong></span> - Permanent / Price Suggested <span style="color:#f2c945;">$2000</span> USD<br><br>
MP3: No<br>
WAV: Yes<br>
Licensing: N/A<br>
Trackout: Yes<br>
Free Downloads: Unlimited<br>
Distribution Copies: Unlimited<br>
Performances (No-Profit): Unlimited<br>
Paid Performances: Unlimited<br>
Music Videos or (YouTube video): Unlimited<br>
Audio Streams: Unlimited<br>
Video Streams: Unlimited<br>
Broadcasting Rights: Yes<br>
Number of radio stations: Unlimited<br>
Exclusive Rights: Yes<br><br>
Any NFT that carry this contract, allow you to become legally the new owner and/or right holder of the asset.<br><br>
</small></p>
      </div>
    </div>
  </div>
  <!-- END SIDEBAR -->

  <!-- MESSAGE BOX-->
  <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
      <div class="mb-middle">
        <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
        <div class="mb-content">
          <p>Are you sure you want to log out?</p>
          <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
        </div>

        <div class="mb-footer">
          <div class="pull-right">
            <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
            <button class="btn btn-default btn-lg mb-control-close">No</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END MESSAGE BOX-->

  <!-- START PRELOADS -->
  <audio id="audio-alert" src="/audio/alert.mp3" preload="auto"></audio>
  <audio id="audio-fail" src="/audio/fail.mp3" preload="auto"></audio>
  <!-- END PRELOADS -->

  <!-- START SCRIPTS -->
  <!-- START PLUGINS -->
  <script src="/js/plugins/jquery/jquery.min.js"></script>
  <script src="/js/plugins/jquery/jquery-ui.min.js"></script>
  <script src="/js/plugins/bootstrap/bootstrap.min.js"></script>
  <!-- END PLUGINS -->

  <!-- THIS PAGE PLUGINS -->
  <script src="/js/plugins/icheck/icheck.min.js"></script>
  <script src="/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
  <script src="/js/plugins/dropzone/dropzone.min.js"></script>
  <script src="/js/plugins/noty/jquery.noty.js"></script>
  <script src="/js/plugins/noty/layouts/topRight.js"></script>
  <script src="/js/plugins/noty/themes/default.js"></script>
  <!-- END PAGE PLUGINS -->

  <!-- START TEMPLATE -->
  <script src="/js/all.js"></script>
  <script src="/js/plugins.js"></script>
  <script src="/js/actions.js"></script>
  <script src="/js/tezos.js"></script>
  <script src="/js/helpers.js"></script>
  <script src="/js/ipfs.js"></script>
  <!-- END TEMPLATE -->
  <!-- END SCRIPTS -->

  <script>
  const { TezosToolkit, MichelsonMap } = taquito
  const { BeaconWallet } = taquitoBeaconWallet
  const { packDataBytes } = taquitoMichelCodec
  const { NetworkType } = beacon

  const rpc = 'https://mainnet-tezos.giganode.io'
  const tezos = new TezosToolkit(rpc)
  const wallet = new BeaconWallet({
    name: 'RADION FM',
    iconUrl: 'https://www.radion.fm/favicon/apple-icon-60x60.png',
    appUrl: 'https://www.radion.fm'
  })

  tezos.setWalletProvider(wallet)

  const api = 'https://api.better-call.dev/v1'
  const fa2 = 'KT1WjTTTgHy5MojfoAe1yFUGU6roLaE2x8Uj'
  const fixedPrice = 'KT1BNXQ8XLbBqapbQjPVg3xFnxoade2UjxE6'
  const editions = []
  let editionsStorage = null
  let marketStorage = null
  let maxEditionsPerRun = 0
  let editionTemplate = null

  $(document).ready(function () {
    editionTemplate = $('#temp-edition').prop('content')
    getEditions(fa2)

    $('#connect-wallet').click(async function (event) {
      event.preventDefault()
      await connectWallet()
    })
  })

  async function connectWallet () {
    const network = { type: NetworkType.MAINNET, rpcUrl: rpc }
    await wallet.requestPermissions({ network })
    const pkh = await wallet.getPKH()
    const balance = await tezos.tz.getBalance(pkh)
    const tezBalance = (balance.c[0] / 1000000).toFixed(6)
    $('#wallet-balance').text(tezBalance + ' tz')
  }

  async function getEditions () {
    console.log('Displaying Editions...')
    console.log('Getting edition contract\'s storage...')
    const editionsStorageJSON = await $.getJSON(`${api}/contract/mainnet/${fa2}/storage`)
    editionsStorage = parseMichelsonMap(editionsStorageJSON, {
      network: 'mainnet',
      includeNone: true
    })[0]
    const size = editionsStorage.next_edition_id
    let counts = 0

    console.log(size + ' editions found')
    console.log('Getting market contract\'s storage')
    const marketStorageJSON = await $.getJSON(`${api}/contract/mainnet/${fixedPrice}/storage`)
    marketStorage = parseMichelsonMap(marketStorageJSON, {
      network: 'mainnet',
      includeNone: false
    })[0]
    maxEditionsPerRun = editionsStorage.max_editions_per_run

    for (let i = size - 1; i >= 0 && counts < 6; i--) {
      console.log('Getting edition\'s (ID: ' + i + ') metadata...')
      const edition = (await editionsStorage.editions_metadata)[i]
      console.log(edition)

      const blocked = await $.get('/php/block-nft-limited.php', { id: i })
      if (blocked === 'Good') {
        await displayEdition(i, edition)
        counts++
      }

      editions[i] = edition
    }
  }

  async function displayEdition (eid, edition) {
    const elem = $(editionTemplate).clone(true, true)
    const values = edition['@map_4']
    const numberOfEditions = edition['@nat_8']
    const cid = values['""'].slice(7)
    console.log('Getting edition\'s (ID: ' + eid + ') additional data from IFPS')
    const editionData = await $.getJSON('https://www.radion.fm:8980/ipfs/' + cid)
    console.log('IPFS Metadata', editionData)
    const id = values.asset_id || ''
    const songName = values.song_name || ''
    const artist = values.artist || 'Artist Unknown'
    const genre = values.genre || 'None'
    const contractType = values.legal_contract_type || ''
    const title = (songName ? songName.substr(0, 27) : songName) || 'No title'
    console.log('Getting edition\'s market sales...')
    const sales = await getSales(eid, edition)
    console.log(sales)
    const price = sales.price / 1000000
    const priceInUsd = (price * parseFloat(window.priceUsd)).toFixed(2)
    let termsContract = ''
    let audioUrl = 'https://radion.fm:8002/stream/1'
    let artworkUrl = 'https://radion.fm/img/bg-capa.jpg'
    let audioFormat = ''
    let audioType = null
    let artworkType = null

    let metadata = null
    try {
      metadata = await getMetadata(id)
      artworkUrl = metadata.artwork ? 'https://radion.fm' + metadata.artwork : artworkUrl
      $(elem).find('.nft-shield').show()
    } catch (error) {}

    editionData.formats.forEach(format => {
      if (format.mimeType.startsWith('audio')) {
        audioUrl = format.uri
        audioType = format.mimeType
        audioFormat = audioType === 'audio/wav' ? 'WAV' : 'MP3'
      } else if (format.mimeType.startsWith('image')) {
        artworkUrl = format.uri
        artworkType = format.mimeType
      }
    })

    switch (contractType) {
      case 'essential':
        termsContract = 'Basic Lease'
        break

      case 'commercial':
        termsContract = 'Basic Lease'
        break

      case 'basic':
        termsContract = 'Basic Lease'
        break

      case 'trackout':
        termsContract = 'Trackout Lease'
        break

      case 'premium':
        termsContract = 'Premium Lease'
        break

      case 'exclusive':
        termsContract = 'Exclusive Rights'
        break

      case 'cc-by-nc-nd':
        termsContract = 'CC-BY-NC-ND'
        break

      default:
        termsContract = contractType
    }

    const host = audioUrl.startsWith('https://') ? 'RADION Server' : 'IPFS'
    const audioDataUrl = audioUrl.startsWith('https://') ? audioUrl : 'https://www.radion.fm:8980/ipfs/' + audioUrl.slice(7)
    console.log('Getting artwork data from ' + artworkUrl + '...')
    const artworkDataUrl = artworkUrl.startsWith('https://') ? artworkUrl : 'https://www.radion.fm:8980/ipfs/' + artworkUrl.slice(7)
    const issuer = edition['@address_2'].substr(0, edition['@address_2'].length - 15) + '...'
    $(elem).find('.nft-artwork').attr('src', artworkDataUrl).removeClass('nft-artwork')
    $(elem).find('.nft-artist').text(artist).removeClass('nft-artist')
    $(elem).find('.nft-title').text(title).removeClass('nft-title')
    $(elem).find('.nft-shield').removeClass('nft-shield')
    $(elem).find('.nft-issuer-address').text(issuer).removeClass('nft-issuer-address')
    $(elem).find('.nft-host').text(host).removeClass('nft-host')
    $(elem).find('.nft-format').text(audioFormat)
    if (audioFormat === 'MP3') $(elem).find('.nft-format').addClass('label-primary').removeClass('label-default')
    $(elem).find('.nft-format').removeClass('.nft-format')
    $(elem).find('.nft-price').text(price).removeClass('nft-price')
    $(elem).find('.nft-price-usd').text(priceInUsd).removeClass('nft-price-usd')
    if (sales.count === 0) {
      $(elem).find('.nft-sold-out').hide().removeClass('nft-sold-out')
      $(elem).find('.nft-editions-avail').text(numberOfEditions === 1 ? 'Sold' : 'Sold out').css('color', '#C0392B')
    }
    else $(elem).find('.nft-editions-avail').text(sales.count + '/' + numberOfEditions)
    $(elem).find('.nft-editions-avail').removeClass('nft-editions-avail')
    $(elem).find('.nft-terms').text(termsContract).removeClass('nft-terms')
    $(elem).find('.nft-genre').text(genre).removeClass('nft-genre')
    $(elem).find('.nft-buy').attr('data-buy', eid).removeClass('nft-buy').click(buyEdition)
    $(elem).find('.nft-play').attr({
      href: audioDataUrl,
      'data-hash': audioDataUrl
    }).removeClass('nft-play')
    $('#nft-editions').append(elem)
  }

  async function getSales (eid, edition) {
    const tokenIds = []
    const keys = []
    let count = 0
    let price = 0

    for (let i = 0; i < edition['@nat_8']; i++) {
      const tokenId = eid * maxEditionsPerRun + i
      const address = packDataBytes(
        { string: edition['@address_2'] },
        { prim: 'address' }
      ).bytes.slice(12)

      const contract = packDataBytes(
        { string: fa2 },
        { prim: 'address' }
      ).bytes.slice(12)

      const key = `Pair 0x${address} (Pair 0x${contract} ${tokenId})`

      tokenIds.push(tokenId)
      keys.push(key)
    }

    const sales = await marketStorage.sales
    for (let i = 0; i < keys.length; i++) {
      const key = keys[i]
      if (sales[key]) {
        price = sales[key]
        count++
      }
    }

    if (price === 0) {
      const response = await $.getJSON('https://api.better-call.dev/v1/contract/mainnet/' + fixedPrice + '/operations?entrypoints=buy')
      const operations = response.operations
      for (let i = 0; i < operations.length; i++) {
        const operation = operations[i]
        if (operation.internal) continue

        const parameters = parseMichelsonMap(operation.parameters)
        const tokenId = parameters[0].sale_token.token_for_sale_token_id
        if (tokenIds.includes(tokenId)) {
          price = operation.amount
          break
        }
      }
    }

    return { count, price }
  }

  async function buyEdition (event) {
    const network = { type: NetworkType.MAINNET, rpcUrl: rpc }
    await wallet.requestPermissions({ network })

    const eid = $(this).attr('data-buy')
    const edition = editions[eid]
    const values = edition['@map_4']
    const numberOfEditions = edition['@nat_8']
    const cid = values['""'].slice(7)
    const assetId = values.asset_id || ''
    const date = values.date || ''
    const license = values.legal_contract_type || ''
    const editionData = await $.getJSON('https://www.radion.fm:8980/ipfs/' + cid)
    const loggedIn = await isLoggedIn()
    let audioUrl = null
    let audioType = null

    if (!loggedIn) {
      noty({
        text: 'You should log in first to download the asset and contract',
        type: 'error',
        layout: 'topRight',
        timeout: 5000
      })
      return
    }

    editionData.formats.forEach(format => {
      if (format.mimeType.startsWith('audio')) {
        audioUrl = format.uri
        audioType = format.mimeType
      }
    })

    const marketSales = await marketStorage.sales
    const contract = await tezos.wallet.at(fixedPrice)
    let salePrice = 0
    let sale = null

    for (let i = 0; i < numberOfEditions; i++) {
      const tokenId = eid * maxEditionsPerRun + i
      const address = packDataBytes(
        { string: edition['@address_2'] },
        { prim: 'address' }
      ).bytes.slice(12)

      const contractAddress = packDataBytes(
        { string: fa2 },
        { prim: 'address' }
      ).bytes.slice(12)

      const keyString = `Pair 0x${address} (Pair 0x${contractAddress} ${tokenId})`
      const key = {
        seller: edition['@address_2'],
        sale_token: {
          token_for_sale_address: fa2,
          token_for_sale_token_id: tokenId
        }
      }

      if (typeof marketSales[keyString] !== 'undefined') {
        sale = key
        salePrice = marketSales[keyString] / 1000000
        break
      }
    }

    if (sale !== null) {
      const tokenId = sale.sale_token.token_for_sale_token_id
      const operation = await contract.methods.buy(sale.seller, fa2, tokenId).send({
        amount: salePrice
      })

      noty({
        text: '<i class="fas fa-compact-disc fa-lg fa-spin"></i> Transaction Request Sent. Confirming...<br>Please wait for confirmation! Do not refresh browser...',
        type: 'information',
        layout: 'topRight'
      })

      const hash = operation.opHash
      await operation.confirmation(1)

      noty({
        text: 'Please wait for download. Do not refresh browser! This may take a while...',
        type: 'information',
        layout: 'topRight'
      })

      let filename = editionData.name
      if (audioType === 'audio/mpeg') filename += '.mp3'
      else if (audioType === 'audio/wav') filename += '.wav'
      if (audioUrl.startsWith('ipfs://')) {
        const audioCID = audioUrl.slice(7)
        const downloadLink = '/ipfs/cat.php?cid=' + audioCID
        downloadURL(downloadLink, filename)
      } else {
        const windowURL = new URL(audioUrl)
        const params = new URLSearchParams(windowURL.search)
        params.set('hash', hash)

        const downloadLink = windowURL.pathname + '?' + params.toString()
        downloadURL(downloadLink, filename)
      }

      const params = new URLSearchParams()
      params.set('hash', hash)
      downloadURL('/php/request_contract.php?' + params.toString(), 'contract.pdf')

      // Display SUCCESS
      const sweetAlert = await Swal.fire({
        icon: 'success',
        title: 'SUCCESS',
        width: 450,
        html: '<br><p align="left" style="padding-left:10px;">WE HAVE CONFIRMATION!</p><hr><p align="left" style="padding-left:10px;"><strong>Transaction ID/Hash:</strong></p><p align="left" style="font-size:13px;padding-left:10px;">' + hash + '</p>',
        confirmButtonText: '<i class="fas fa-external-link-alt"></i> View in TzStats',
        showCancelButton: true,
        cancelButtonText: "<i class='fas fa-thumbs-up'></i> Got It"
      })

      if (sweetAlert.value) window.open('https://tzstats.com/' + hash)
    } else {
      noty({
        text: 'Unable to find the edition',
        layout: 'topRight',
        type: 'error',
        timeout: 5000
      })
    }
  }

  const player = new Audio()
  $(document).on('click', '[data-hash]', async function (event) {
    event.preventDefault()

    const lottie = $(this).prop('lottie')
    const source = $(this).attr('href')

    if (player.paused || player.src !== source) {
      $('[data-hash]').each(function (i, elem) {
        let eLottie = $(this).prop('lottie')
        eLottie.stop()
        eLottie.currentFrame = 0
        eLottie.renderFrame()
      })

      player.src = source
      lottie.play()
      player.play()
    } else {
      player.pause()
      lottie.stop()
      lottie.currentFrame = 0
      lottie.renderFrame()
    }
  })

  async function getHash (id) {
    return new Promise((resolve, reject) => {
      $.ajax('/php/get_hash.php', {
        type: 'GET',
        data: { id: id },
        success: function (data, status, xhr) {
          resolve(data)
        },
        error: function (xhr, status, error) {
          reject(error)
        }
      })
    })
  }

  async function getMetadata (id) {
    return new Promise((resolve, reject) => {
      $.ajax('/php/get_song_metadata.php', {
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function (data, status, xhr) {
          resolve(data)
        },
        error: function (xhr, status, error) {
          reject(error)
        }
      })
    })
  }

  let terms = null
  $('#mint-submit').click(async function (event) {
    event.preventDefault()

    const artist = $('#mint-artist').val()
    const title = $('#mint-title').val()
    const genre = $('#mint-genre').val()
    const editionsCount = parseInt($('#mint-editions').val() || '0')
    const files = $('#upload-dropzone').prop('dropzone').files
    let audioFile = null
    let audioType = null
    let imageFile = null
    let imageType = null

    for (let i = 0; i < files.length; i++) {
      const file = files[i]

      if (!file.accepted || (audioFile !== null && imageFile !== null)) break
      if (file.type.startsWith('audio')) {
        audioFile = file
        audioType = file.type
      } else if (file.type.startsWith('image')) {
        imageFile = file
        imageType = file.type
      }
    }

    if (!artist) {
      noty({
        text: 'Artist should not be empty',
        layout: 'topRight',
        type: 'error',
        timeout: 5000
      })
      return
    }

    if (!title) {
      noty({
        text: 'Title should not be empty',
        layout: 'topRight',
        type: 'error',
        timeout: 5000
      })
      return
    }

    if (!genre) {
      noty({
        text: 'Genre should not be empty',
        layout: 'topRight',
        type: 'error',
        timeout: 5000
      })
      return
    }

    if (audioType !== 'audio/mpeg' && audioType !== 'audio/wav') {
      noty({
        text: 'Audio file is neither MP3 nor WAV',
        layout: 'topRight',
        type: 'error',
        timeout: 5000
      })
      return
    }

    const audioData = await readFile(audioFile)
    let artworkData = null

    if (imageFile === null) {
      const mp3tag = new MP3Tag(audioData)
      mp3tag.read()

      if (mp3tag.tags.v2 && mp3tag.tags.v2.APIC) {
        const artwork = mp3tag.tags.v2.APIC[0]
        artworkData = artwork.data
        imageType = artwork.format
      } else {
        noty({
          text: 'No artwork found, please upload',
          layout: 'topRight',
          type: 'error'
        })
        return
      }
    } else artworkData = await readFile(imageFile)

    const validTerms = ['basic', 'trackout', 'premium', 'exclusive']
    if (!validTerms.includes(terms)) {
      noty({
        text: 'No terms and license selected',
        layout: 'topRight',
        type: 'error',
        timeout: 5000
      })
      return
    }

    const network = { type: NetworkType.MAINNET, rpcUrl: rpc }
    await wallet.requestPermissions({ network })
    const pkh = await wallet.getPKH()
    const balance = await tezos.tz.getBalance(pkh)
    const tezBalance = (balance.c[0] / 1000000).toFixed(6)
    $('#wallet-balance').text(tezBalance + ' tz')

    noty({
      text: 'Uploading asset to IPFS',
      layout: 'topRight',
      timeout: 10000
    })

    const { cid } = await ipfsAdd(audioData)
    const { cid: artworkCID } = await ipfsAdd(artworkData)
    const thumbnailUrl = 'ipfs://QmVPq2eaWdvAaKy7ii1WyHmp4EC6hWcN9FYi9KzKMurq7R'
    const audioUrl = 'ipfs://' + cid
    const artworkUrl = 'ipfs://' + artworkCID

    const contract = await tezos.contract.at(fa2)
    const sellContract = await tezos.contract.at(fixedPrice)
    const storage = await contract.storage()
    const editionId = storage.next_edition_id.c[0]
    const maxPerRun = storage.max_editions_per_run.c[0]
    const map = new MichelsonMap()
    const date = new Date()
    let termsURL = ''
    let sellPrice = 0

    if (!editionsCount) {
      noty({
        text: 'Number of editions should be a positive integer',
        layout: 'topRight',
        type: 'error',
        timeout: 5000
      })
      return
    }

    switch (terms) {
      case 'basic':
        termsURL = 'https://radion.fm/terms/basic.html'
        break

      case 'trackout':
        termsURL = 'https://radion.fm/terms/trackout.html'
        break

      case 'premium':
        termsURL = 'https://radion.fm/terms/premium.html'
        break

      case 'exclusive':
        termsURL = 'https://radion.fm/terms/exclusive.html'
        break
    }

    const bytes = JSON.stringify({
      name: title,
      symbol: 'RADION',
      decimals: 0,
      tags: [],
      artifactUri: audioUrl,
      thumbnailUri: thumbnailUrl,
      formats: [{
        uri: audioUrl,
        mimeType: audioType
      }, {
        uri: artworkUrl,
        mimeType: imageType
      }],
      date: date.toISOString(),
      // assets
      song_name: title,
      artist: artist,
      genre: genre,
      copyright_holder: 'Yes',
      publisher: 'RADION FM',
      legal_terms: termsURL,
      legal_contract_type: terms
    })

    const { cid: bytesCid } = await ipfsAdd(bytes)
    map.set('', strToHex('ipfs://' + bytesCid.toString()))
    map.set('date', strToHex(date.toISOString()))
    map.set('song_name', strToHex(title))
    map.set('artist', strToHex(artist))
    map.set('genre', strToHex(genre))
    map.set('copyright_holder', strToHex('Yes'))
    map.set('publisher', strToHex('RADION FM'))
    map.set('asset_format', strToHex(audioType === 'audio/wav' ? 'WAV' : 'MP3'))
    map.set('legal_terms', strToHex(termsURL))
    map.set('legal_contract_type', strToHex(terms))

    const batch = tezos.batch()
    const receivers = []
    let limitIndex = 0
    let limitCount = 0
    for (let i = 0; i < editionsCount; i++) {
      if (Array.isArray(receivers[limitIndex])) receivers[limitIndex].push(pkh)
      else receivers[limitIndex] = [pkh]

      limitCount++
      if (limitCount === 10) {
        limitCount = 0
        limitIndex++
      }
    }

    batch.withContractCall(contract.methods.mint_editions([{
      edition_info: map,
      number_of_editions: editionsCount
    }]))

    for (let i = 0; i < receivers.length; i++) {
      const receiver = receivers[i]
      batch.withContractCall(contract.methods.distribute_editions([{
        edition_id: editionId,
        receivers: receiver
      }]))
    }

    const toSell = $('#mint-sell').is(':checked')
    if (toSell) {
      const sellUSD = $('#mint-price').val()
      if (parseFloat(sellUSD) < 0) {
        noty({
          text: 'Price cannot be negative',
          layout: 'topRight',
          type: 'error',
          timeout: 5000
        })
        return
      }

      const sellXTZ = (parseFloat(sellUSD) / parseFloat(priceUsd)).toFixed(6)
      sellPrice = parseFloat(sellXTZ) * 1000000
      const operators = []
      const sales = []
      let limitIndex = 0
      let limitCount = 0

      for (let i = 0; i < editionsCount; i++) {
        const operator = {
          add_operator: {
            owner: pkh,
            operator: sellContract.address,
            token_id: maxPerRun * editionId + i
          }
        }

        const sale = {
          sale_price: sellPrice,
          sale_token_param_tez: {
            token_for_sale_address: contract.address,
            token_for_sale_token_id: maxPerRun * editionId + i
          }
        }

        if (Array.isArray(operators[limitIndex])) operators[limitIndex].push(operator)
        else operators[limitIndex] = [operator]

        if (Array.isArray(sales[limitIndex])) sales[limitIndex].push(sale)
        else sales[limitIndex] = [sale]

        limitCount++
        if (limitCount === 10) {
          limitCount = 0
          limitIndex++
        }
      }

      for (let i = 0; i < operators.length; i++) {
        const operator = operators[i]
        batch.withContractCall(contract.methods.update_operators(operator))
      }

      for (let i = 0; i < sales.length; i++) {
        const sale = sales[i]
        batch.withContractCall(sellContract.methods.sell(sale))
      }
    }

    try {
      const op = await tezos.wallet.batch(batch.operations).send()
      const n = noty({
        text: 'Please wait for confirmation!',
        layout: 'topRight',
        type: 'info'
      })

      const confirmed = await op.confirmation(1)
      const hash = op.opHash
      if (confirmed) {
        noty({
          text: 'Operation was successful',
          layout: 'topRight',
          type: 'success'
        })

        const sweetAlert = await Swal.fire({
          icon: 'success',
          title: 'SUCCESS',
          width: 450,
          html: '<br><p align="left" style="padding-left:10px;">WE HAVE CONFIRMATION!</p><hr><p align="left" style="padding-left:10px;"><strong>Transaction ID/Hash:</strong></p><p align="left" style="font-size:13px;padding-left:10px;">' + hash + '</p>',
          confirmButtonText: '<i class="fas fa-external-link-alt"></i> View in TzStats',
          showCancelButton: true,
          cancelButtonText: "<i class='fas fa-thumbs-up'></i> Got It"
        })

        if (sweetAlert.value) window.open('https://tzstats.com/' + hash)
      } else {
        noty({
          text: 'Unable to confirm the operation',
          layout: 'topRight',
          type: 'error'
        })
      }
    } catch (error) {}
  })

  $('#mint-sell').change(function () {
    const checked = $(this).is(':checked')
    if (checked) $('#mint-editions, #mint-price').attr('disabled', null)
    else $('#mint-editions, #mint-price').attr('disabled', true)
  })

  $('#mint-license').change(function () {
    const checked = $(this).is(':checked')
    if (checked) {
      $('#mint-terms-dropdown').attr({
        'data-toggle': 'dropdown',
        disabled: null
      })
    } else {
      terms = null
      $('#mint-terms').text('Select Terms & License')
      $('#mint-terms-dropdown').attr({
        'data-toggle': null,
        disabled: true
      })
    }
  })

  $('#mint-basic').click(function (event) {
    terms = 'basic'
    $('#mint-terms').text('Basic Lease')
  })

  $('#mint-trackout').click(function (event) {
    terms = 'trackout'
    $('#mint-terms').text('Trackout Lease')
  })

  $('#mint-premium').click(function (event) {
    terms = 'premium'
    $('#mint-terms').text('Premium Lease')
  })

  $('#mint-exclusive').click(function (event) {
    terms = 'exclusive'
    $('#mint-terms').text('Exclusive Rights')
  })

  async function isLoggedIn () {
    return await $.get('/php/isLoggedIn.php') === 'loggedIn'
  }

  async function saveAsset (data, type) {
    const formData = new FormData()
    formData.append('type', type)

    if (typeof data === 'string') formData.append('name', data)
    else {
      const blob = new Blob([data], { type: type })
      formData.append('bytes', blob)
    }

    return new Promise((resolve, reject) => {
      $.ajax('/php/store.php', {
        type: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          resolve(data.url)
        },
        error: function (xhr, status, error) {
          reject(error)
        }
      })
    })
  }
  </script>
</body>
</html>
