<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mos Proyectos</title>
    <link rel="stylesheet" type="text/css" href="css/cloud-admin.css" >
  	<link rel="stylesheet" type="text/css"  href="css/themes/default.css" id="skin-switcher" >
  	<link rel="stylesheet" type="text/css"  href="css/responsive.css" >

  	<!-- JQUERY UI-->
  	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min.css" />
  	<!-- DATE RANGE PICKER -->
  	<link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
  	<!-- DATA TABLES -->
  	<link rel="stylesheet" type="text/css" href="js/datatables/media/css/jquery.dataTables.min.css" />
  	<link rel="stylesheet" type="text/css" href="js/datatables/media/assets/css/datatables.min.css" />
  	<link rel="stylesheet" type="text/css" href="js/datatables/extras/TableTools/media/css/TableTools.min.css" />
  	<!-- FONTS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->

    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">FIELDER Rendimiento</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->
<!--============================================================================================-->
<div class="col-md-12">
	<div class="panel panel-default">
	  <div class="panel-heading">
      <button class="btn btn-primary" onclick="verSupervisor()">Ver  Supervisor Metro</button>
      <button class="btn btn-primary" onclick="verSupervisor()">Ver  Supervisor Occdidente</button>
      <button class="btn btn-primary" onclick="verSupervisor()">Ver  Supervisor Sureste</button>
        <button  class="btn btn-primary" onclick="verIndividual()">Ver  Individual</button>
	  </div>
	  <div class="panel-body" align="center">
<div id="verSupervisor">
  <div class="row">
    <div class="col-md-12">
      <!-- BOX -->
      <div class="box border green">
        <div class="box-title">
          <h4><i class="fa fa-table"></i>Dynamic Data dddddd</h4>
          <div class="tools hidden-xs">
            <a href="#box-config" data-toggle="modal" class="config">
              <i class="fa fa-cog"></i>
            </a>
            <a href="javascript:;" class="reload">
              <i class="fa fa-refresh"></i>
            </a>
            <a href="javascript:;" class="collapse">
              <i class="fa fa-chevron-up"></i>
            </a>
            <a href="javascript:;" class="remove">
              <i class="fa fa-times"></i>
            </a>
          </div>
        </div>
        <div class="box-body">
          <table id="datatable1" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th class="hidden-xs">Platform(s)</th>
                <th>Engine version</th>
                <th class="hidden-xs">CSS grade</th>
              </tr>
            </thead>
            <tbody>
              <tr class="gradeX">
                <td>Trident</td>
                <td>
                  Internet
                   Explorer
                  4.0
                  </td>
                <td class="hidden-xs">Win 95+</td>
                <td class="center">4</td>
                <td class="center hidden-xs">X</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th class="hidden-xs">Platform(s)</th>
                <th>Engine version</th>
                <th class="hidden-xs">CSS grade</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /BOX -->
    </div>
  </div>
</div>
<div style="display:none;" id="verIndividual">
  <div class="row">
    <div class="col-md-12">
      <!-- BOX -->
      <div class="box border green">
        <div class="box-title">
          <h4><i class="fa fa-table"></i>Dynamic Data dddddd</h4>
          <div class="tools hidden-xs">
            <a href="#box-config" data-toggle="modal" class="config">
              <i class="fa fa-cog"></i>
            </a>
            <a href="javascript:;" class="reload">
              <i class="fa fa-refresh"></i>
            </a>
            <a href="javascript:;" class="collapse">
              <i class="fa fa-chevron-up"></i>
            </a>
            <a href="javascript:;" class="remove">
              <i class="fa fa-times"></i>
            </a>
          </div>
        </div>
        <div class="box-body">
          <table id="datatable1" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th class="hidden-xs">Platform(s)</th>
                <th>Engine version</th>
                <th class="hidden-xs">CSS grade</th>
              </tr>
            </thead>
            <tbody>
              <tr class="gradeX">
                <td>Trident</td>
                <td>
                  Internet
                   Explorer
                  4.0
                  </td>
                <td class="hidden-xs">Win 95+</td>
                <td class="center">4</td>
                <td class="center hidden-xs">X</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th class="hidden-xs">Platform(s)</th>
                <th>Engine version</th>
                <th class="hidden-xs">CSS grade</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /BOX -->
    </div>
  </div>
</div>
	  </div>
	</div>
</div>
<!--============================================================================================-->
    </div>
</div>
<!-- DATA TABLES -->
<script type="text/javascript" src="js/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/datatables/media/assets/js/datatables.min.js"></script>
<script type="text/javascript" src="js/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
<script type="text/javascript" src="js/datatables/extras/TableTools/media/js/ZeroClipboard.min.js"></script>
<!-- COOKIE -->
<script type="text/javascript" src="js/jQuery-Cookie/jquery.cookie.min.js"></script>
<!-- CUSTOM SCRIPT -->
<script src="js/script.js"></script>
<script>
  jQuery(document).ready(function() {
    App.setPage("dynamic_table");  //Set current page
    App.init(); //Initialise plugins and elements
  });
</script>
<!-- /JAVASCRIPTS -->
<!-- jQuery -->
<script src="js/funciones.js"></script>
<script src="js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>
</div>
</body>
</html>
