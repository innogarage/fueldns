<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FuelDNS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <!-- Le styles -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

<!-- Navbar
================================================== -->
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/">FuelDNS</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="<? if ($this->router->fetch_class() == "welcome") echo "active"; ?>">
                        <a href="/">Home</a>
                    </li>
                    <li class="<? if ($this->router->fetch_class() == "domains") echo "active"; ?>">
                        <a href="/domains">Domains</a>
                    </li>
                    <li class="<? if ($this->router->fetch_class() == "account") echo "active"; ?>">
                        <a href="/guide">Guide</a>
                    </li>
                </ul>
                <div class="btn-group pull-right">
                    <button class="btn"><i class="icon icon-user"></i> User280</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Account</a></li>
                        <li><a href="#">Billing</a></li>
                        <li><a href="#">API Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" style="margin:0px;padding:0px;position: relative">