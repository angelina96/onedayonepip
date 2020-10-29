  <style>
  /* //////////// NAVBAR IN MAINTENANCE //////////// */


  .navbar {
    margin-bottom: 0;
    background-color: #053EC3;
    z-index: 9999;
    border: 0;
    font-size: 12px !important;
    line-height: 1.42857143 !important;
    letter-spacing: 4px;
    border-radius: 0;
    font-family: 'Aldrich';
  }
  .navbar li a, .navbar .navbar-brand {
    color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
    color: #053EC3 !important;
    background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
    color: #fff !important;
  }
  /* //// new feature //// */
  .lawan {
    color: #ff0000 ;
  }
  /* //////////// NAVBAR IN MAINTENANCE //////////// */
  .blueline {
    border: 1px solid #053EC3; 
    border-radius:5px ;
    transition: box-shadow 0.5s;
	font-family: 'Aldrich';
  }
  .box-master {
    color: #ffffff !important;
    background-color: transparent !important;
    background-image:  url("images/b1.jpg");
    background-size: cover;
    background-position: center;
    padding: 1px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    border-bottom-left-radius: 2px;
    border-bottom-right-radius: 2px;
  }
  
  .plan-bg-master {
    background-color: #000000;
    background-image:  url("images/div2.png"),url("images/div1.png"),url("images/b8.jpg");
    background-position: center top,center bottom,center;
    background-repeat: no-repeat;
    background-size: 100% 50px,100% 25px,cover;
    }
  </style>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-menu-shahrul">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>               
      </button>
		<div class="animate-box" data-animate-effect="fadeInLeft">
		 <a class="navbar-brand" href="#myPage"> P.O. Agent</a>
		</div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
	
		<li class="w3-animate-zoom"><a href="page_po_agent.php"><IMG SRC='images/menu/pay1.png' WIDTH='16' HEIGHT='16' BORDER='0'>&nbsp;PAY-OUT [PO]</a></li>


        <li class="w3-animate-zoom"><a href="logout.php"><IMG SRC='images/menu/signout.png' WIDTH='16' HEIGHT='16' BORDER='0'>&nbsp;SIGN-OUT</a></li>
      </ul>
    </div>
  </div>
</nav>
<br><br>