<?php
/**
 * page_header.php
 *
 * Author: pixelcave
 *
 * The header of each page
 *
 */
?>
<!-- Header -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!--
    Available header.navbar classes:

    'navbar-default'            for the default light header
    'navbar-inverse'            for an alternative dark header

    'navbar-fixed-top'          for a top fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
        'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

    'navbar-fixed-bottom'       for a bottom fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
        'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
-->
<header class="navbar<?php if ($template['header_navbar']) { echo ' ' . $template['header_navbar']; } ?><?php if ($template['header']) { echo ' '. $template['header']; } ?>">
    <!-- Left Header Navigation -->
    <ul class="nav navbar-nav-custom">
        <!-- Main Sidebar Toggle Button -->
        <li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');">
                <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
            </a>
        </li>
        <!-- END Main Sidebar Toggle Button -->

        <?php if ($template['header_link']) { ?>
        <!-- Header Link -->
        <li class="hidden-xs animation-fadeInQuick">
            <a href=""><strong><?php echo $template['header_link']; ?></strong></a>
        </li>
        <!-- END Header Link -->
        <?php } ?>
    </ul>
    <!-- END Left Header Navigation -->
	
    <!-- Right Header Navigation -->
    <ul class="nav navbar-nav-custom pull-right">
		
		
		
		
		
<?php
$data57 = mysqli_query($conn,"SELECT * FROM pricetoken ORDER BY created_date DESC LIMIT 1") or die(mysqli_error());
$info57 = mysqli_fetch_array( $data57 );
$usd = $info57['usd'];
$tokenz = $info57['tokenz'];
$usd = number_format("".$usd."",2)."";
$tokenz = number_format("".$tokenz."",5)."";
$data58 = mysqli_query($conn,"SELECT * FROM pricebtc ORDER BY created_date DESC LIMIT 1") or die(mysqli_error());
$info58 = mysqli_fetch_array( $data58 );
$usd58 = $info58['usd'];
$btc58 = $info58['btc'];
?>

<?php
include "../btc.php";

$btc58 = number_format("".$btc58."",5)."";
$btc   = number_format("".$btc  ."",2)."";
		
?>
		<!--<li>
		<font color="yellow">
		<?=$tokenz?> SCFToken <i class="fa fa-exchange"></i> <?=$usd?>USD
		<br>
		<?=$btc58?> BTC <i class="fa fa-exchange"></i> <?=$usd58?>USD
		</font>
        <!--<a href="#">1 SCFToken <i class="fa fa-exchange"></i> <?=$usd?>USD</a>-- >
        </li> -->
		
		
		<!--START WIDGGET style="color:red;" -- >
		<li>
				<a href="#">
					<div class="btn-group">
                        <button class="btn btn-effect-ripple btn-default"><i class="gi gi-coins"></i><?=$tokenz?> SCFX <i class="fa fa-exchange"></i> <i class="fa fa-usd"></i><?=$usd?>USDT</button>
                        <button href="javascript:void(0)" class="btn btn-effect-ripple btn-default"><?=$btc58?> BTC <i class="fa fa-exchange"></i> <?=$usd58?>USD</button>
                    </div>
				</a>
		</li> -->
			   <style>
			   .bsize {font-size: 12px; padding: 1px 5px; color:yellow; text-align: left; background: url("https://steamuserimages-a.akamaihd.net/ugc/172663821536493098/7BD0320DF4E62A7F536A7BA36256AC4EC5E45096/"); }
			   .csize {font-size: 12px; padding: px 0px;  text-align: left; }
			   .testhover:hover {  border: 1px solid red;  font-size: 12px; padding: 1px 5px; color:yellow; text-align: left; background-color: #000000; }
			   </style>
		<li>
		<!--
				<a href="#">
					<div class="btn-group">
                        <button class="btn btn-effect-ripple btn-default bsize text-left"><font color="black"><i class="gi gi-coins csize"></i><?=$tokenz?> SCFX<br><i class="fa fa-btc"></i><?=$btc58?> BTC </font></button>
                        <button class="btn btn-effect-ripple btn-default bsize"><font color="black"><i class="fa fa-exchange csize"></i><br><i class="fa fa-exchange"></i></font></button>
                        <button class="btn btn-effect-ripple btn-default bsize"><font color="black"><i class="fa fa-usd csize"></i><?=$usd?> USDT <br><i class="fa fa-usd"></i><?=$usd58?> USDT</font></button>
                    </div>
				</a> -->
				
				<a href="#">
                        <button class="btn btn-effect-ripple btn-info bsize text-left testhover">
						<table>
						<tr>
						<td><i class="gi gi-coins csize"></i></td><td><?=$tokenz?> SCFX</td>
						<td width="20px" align="center"><i class="fa fa-exchange csize"></i></td>
						<td><i class="fa fa-usd csize"></i><?=$usd?>USDT</td>
						</tr>
						<tr>
						<td><i class="fa fa-btc"></i></td><td><?=$btc58?> BTC</td>
						<td width="20px" align="center"><i class="fa fa-exchange csize"></i></td>
						<td><i class="fa fa-usd"></i><?=$btc?></td>
						</tr>
						</table>
						</button>
					
				</a>
		</li>
		<!--CLOSE WIDGGET-->
        <!-- Search Form -->
        <!--<li>
            <form action="page_ready_search_results.php" method="post" class="navbar-form-custom" role="search">
                <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
            </form>
        </li> -->
        <!-- END Search Form -->

        <!-- Alternative Sidebar Toggle Button -->
        <!--<li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                <i class="gi gi-settings"></i>
            </a>
        </li>-->
        <!-- END Alternative Sidebar Toggle Button -->

        <!-- User Dropdown -->
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <img src="img/placeholders/avatars/avatar9.jpg" alt="avatar">
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">
                    <strong><?=$_SESSION["USER_TYPE"]?></strong>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-inbox fa-fw pull-right"></i>
                        <?=$_SESSION["USER"]?>
                    </a>
                </li>
                
                <li class="divider"><li><!--
                <li>
                    <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                        <i class="gi gi-settings fa-fw pull-right"></i>
                        Settings
                    </a>
                </li>
                <li>
                    <a href="page_ready_lock_screen.php">
                        <i class="gi gi-lock fa-fw pull-right"></i>
                        Lock Account
                    </a>
                </li> -->
                <li>
                    <a href="logout.php">
                        <i class="fa fa-power-off fa-fw pull-right"></i>
                        Log out
                    </a>
                </li>
            </ul>
        </li>
        <!-- END User Dropdown -->
    </ul>
    <!-- END Right Header Navigation -->
    
</header>
<!-- END Header -->
