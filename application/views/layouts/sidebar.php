<?php
$help="";
if($_SESSION['user_level'] == 'MANAGER' || $_SESSION['user_level'] == 'ADMIN'){
	$capPlan = "";$rosterC = "";$rosterU = "";$rosterD = "";$rosterI = "";$jobJl = "";$jobDmg = "";$jobJlAss = "";$jobDmgAss = "";$jobQA = "";$dmg = "";$jlbau = "";	$export = "";$punctuality = "";$empAllot = "";$signout = "";
}
if($_SESSION['user_level'] == 'Lead'){//|| $_SESSION['Designation'] ==  'Production Specialist_Lead'
	$capPlan = "";$rosterC = "";$rosterU = "";$rosterD = "";$rosterI = "";$jobJl = "";$jobDmg = "";$jobJlAss = "";$jobDmgAss = "";$jobQA = "";$dmg = "";$jlbau = "";	$export = "";$punctuality = "display:none;";$empAllot = "display:none;";$signout = "";
}
if($_SESSION['user_level'] == 'OPERATOR'){// && $_SESSION['Designation'] !=  'Production Specialist_Lead'
	$capPlan = "display:none;";$rosterC = "display:none;";$rosterU = "display:none;";$rosterD = "showOpt";$rosterI = "display:none;";$jobJl = "";$jobDmg = "";$jobJlAss = "display:none;";$jobDmgAss = "display:none;";$jobQA = "";$dmg = "";$jlbau = "";	$export = "display:none;";$punctuality = "display:none;";$empAllot = "display:none;";$signout = "display:none;";
}
if($_SESSION['user_level'] == 'POWER USER'){
	$capPlan = "display:none;";$rosterC = "display:none;";$rosterU = "display:none;";$rosterD = "showOpt";$rosterI = "display:none;";$jobJl = "";$jobDmg = "";$jobJlAss = "";$jobDmgAss = "";$jobQA = "";$dmg = "";$jlbau = "";	$export = "display:none;";$punctuality = "display:none;";$empAllot = "display:none;";$signout = "display:none;";
}
?>


<section class="sidebar" style="height: auto;">
<input type="hidden" class="base" value="<?php echo base_url(); ?>">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>public/img/user_white.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <span class="user-name"><?php echo $_SESSION['fName'] ?> </span></br>
		  <span class="user-role" style=""><?php echo $_SESSION['user_level']." - ".$_SESSION['TeamName'] ?> </span></br>
		  <span class="user-id" style="display:none;"><?php echo $_SESSION['EmployeeID']?></span>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">GENERAL</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Capacity Planner</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
         <!-- <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url('CapacityPlanner/index') ?>"><i class="fa fa-circle-o"></i>Option 1</a></li>
            <li><a href="<?php echo site_url('CapacityPlanner/index') ?>"><i class="fa fa-circle-o"></i>Option 2</a></li>
          </ul>-->
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Staffing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url('Staffing/create') ?>"><i class="fa fa-circle-o"></i>Create Roster</a></li>
            <li><a href="<?php echo site_url('Staffing/update') ?>"><i class="fa fa-circle-o"></i>Update Roster</a></li>
			<li><a href="<?php echo site_url('Staffing/display') ?>"><i class="fa fa-circle-o"></i>Display Roster</a></li>
			<li><a href="<?php echo site_url('Staffing/index') ?>"><i class="fa fa-circle-o"></i>Import Roster</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list-alt"></i> <span>My Job Queue</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url('JobQueue/index') ?>"><i class="fa fa-circle-o"></i>JL Jobs</a></li>
            <li><a href="<?php echo site_url('JobQueue/index') ?>"><i class="fa fa-circle-o"></i>DMGT Jobs</a></li>
			<li><a href="<?php echo site_url('JobQueue/index') ?>"><i class="fa fa-circle-o"></i>Assign JL Jobs</a></li>
			<li><a href="<?php echo site_url('JobQueue/index') ?>"><i class="fa fa-circle-o"></i>Assign DMGT Jobs</a></li>
			<li><a href="<?php echo site_url('JobQueue/index') ?>"><i class="fa fa-circle-o"></i>QA Jobs</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-server"></i> <span>Job Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url('JobManagement/index') ?>"><i class="fa fa-circle-o"></i>DMGT</a></li>
            <li><a href="<?php echo site_url('JobManagement/index') ?>"><i class="fa fa-circle-o"></i>John Lewis</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wpforms"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url('Reports/index') ?>"><i class="fa fa-circle-o"></i>Export Logs</a></li>
            <li><a href="<?php echo site_url('Reports/index') ?>"><i class="fa fa-circle-o"></i>View Punctuality Reports</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-globe"></i> <span>Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo site_url('Admin/index') ?>"><i class="fa fa-circle-o"></i>Employee Allotment</a></li>
            <li><a href="<?php echo site_url('Admin/index') ?>"><i class="fa fa-circle-o"></i>Force Signout</a></li>
          </ul>
        </li>
        
        
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>