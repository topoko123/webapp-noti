<?php
        session_start();
        include_once('server.php');  
?>
<?php 
      if (!isset($_SESSION['rusmail'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if(isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['firstname']);
        unset($_SESSION['lastname']);        
        unset($_SESSION['rusmail']);
        header('location: login.php');
    }

    if(isset($_POST['addN'])){
      $roomname = $_POST['roomname'];
      $qs = "SELECT * FROM `room` WHERE `room_name` = '".$roomname."'"; 
      $check = mysqli_query($conn, $qs);
      if(mysqli_num_rows($check) > 0){
          echo "<script>alert('ชื่อห้องนี้ถูกใช้แล้ว');</script>";
        
      }else{
        $query = mysqli_query($conn,"INSERT INTO room(room_name) VALUES('$roomname')");
        if($query){
          echo "<script>alert('สร้างห้องสำเร็จ');</script>";
          
        }else{
          echo "<script>alert('สร้างห้องไม่สำเร็จ');</script>";
        }
      }
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
  <meta name="author" content="">  
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/css.css">
  <title>เว็บประชามสัมพันธ์RMUTSB</title>

    
</head>
<body id="page-top">
   

   
   
   
 <style type = "text/css">
      #show {
    display: none;
  }

  #show.visible {
    display: block;
  }


  </style>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">WBLNTF</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>หน้าแรก</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      <!-- Nav Item - Pages Collapse Menu -->
      <?php if ($_SESSION['status'] == 1) : ?>

<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
<i class="fas fa-fw fa-cog"></i>
<span>ส่งการแจ้งเตือน</span>
</a>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header">ตัวเลือก:</h6>
<a class="collapse-item" href="notify_service.php">ส่งข้อความ</a>
<a class="collapse-item" href="chanel.php">ห้องติดตาม</a>
<!--  <a class="collapse-item" href="cards.html">Cards</a>-->
</div>
</div>
</li>
<?php else : ?>
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
<i class="fas fa-fw fa-cog"></i>
<span>การติดตาม</span>
</a>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header">ตัวเลือก:</h6>
<a class="collapse-item" href="chanel.php">ห้องติดตาม</a>
<!--  <a class="collapse-item" href="cards.html">Cards</a>-->
</div>
</div>
</li>
<?php endif; ?>

<!-- Nav Item - Tables -->
<?php if ($_SESSION['status'] == 1) : ?>
<li class="nav-item">
<a class="nav-link" href="import.php">
  <i class="fas fa-fw fa-table"></i>
  <span>ข้อมูล</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="msghis.php">
  <i class ="fas fa-fw fa-table"></i>        
  <span>ประวัติการส่ง</span></a>
</li>
<?php endif; ?>

      <!-- Divider -->
      <hr class="sidebar-divider">

      
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
     
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
          
                <!-- Counter - Alerts -->
                
              <!-- Dropdown - Alerts -->
          
            <!-- Nav Item - Messages -->
          
                <!-- Counter - Messages -->
                
              
              <!-- Dropdown - Messages -->
             

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "คุณ ".$_SESSION['firstname']." ".$_SESSION['lastname'] ?></span>
                
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php?logout='1'" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  ออกจากระบบ
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- Begin Page Content -->
      <div class="container-fluid">

<?php if($_SESSION['status'] == 1):?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
         <label for="name" class="form-lable mt-3">ชื่อห้อง</label>
        <input type="text" name="roomname" class="form-control" placeholder="กรอกชื่อห้อง...">
                     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="submit" name="addN" class="btn btn-primary">เพิ่มข้อมูล</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>
      
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ส่งข้อความ</h1>


<?php
    $sqli = "SELECT * FROM `room`";
    $rr= mysqli_query($conn, $sqli);
?>
<?php
    $sqlii = "SELECT * FROM `subscribe` ";
    $rrr = mysqli_query($conn, $sqlii);
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
  <?php if($_SESSION['status'] == 1) :?>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  สร้างห้อง
</button>
  <?php endif; ?>
      <div class="row justify-content-content-center">
          <table class="table">
            <thead>
                    <tr>
                          <th>รายชื่อห้องติดตาม</th>
                          <th colspan="2">การติดตาม</th>                          
                    </tr> 
            </thead>
        <?php 
            while  ($row = $rr->fetch_assoc()): ?>
              
                <?php $memId = $_SESSION['memId']; ?>
                <?php $roomId = $row['roomId']; ?>
                <?php $sq = "SELECT * FROM `subscribe` WHERE `memId`= '$memId' AND `roomId` = '$roomId' ";?>
                <?php $query = mysqli_query($conn, $sq); ?>
                
                  <?php if (mysqli_num_rows($query) > 0) : ?>
                    <tr>
                          <td><?php echo $row['room_name']; ?></td>                       
                          <td>
                                <a href="chanel3.php?chanel=<?php echo $row['roomId']; ?>"
                                class ="btn btn-success">ยกเลิกติดตาม</a> 
                          </td>
                          
                          <?php if($_SESSION['status'] == 1) :?>
                        <td>
                        <a href="delete.php?id=<?php echo $row['roomId']; ?>" class="btn btn-danger btn-lg active" role="button" 
                        aria-pressed="true">ลบ</a>
                      </td>
                          <?php endif; ?>
                    
                    </tr>
                  <?php else : ?>
                      <tr>
                          <td><?php echo $row['room_name']; ?></td>                       
                          <td>
                                <a href="chanel2.php?chanel=<?php echo $row['roomId']; ?>"
                                class ="btn btn-success">+ติดตาม</a> 
                          </td>
                          <?php if($_SESSION['status'] == 1) :?>
                        <td>
                        <a href="delete.php?id=<?php echo $row['roomId']; ?>" class="btn btn-danger btn-lg active" role="button" 
                        aria-pressed="true">ลบ</a>
                      </td>
                          <?php endif; ?>
                    </tr>
                    <?php endif; ?>

                    
             <?php endwhile; ?>
                
       <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <button name="follow-button" id="follow-button">+ Follow</button>	-->
          </table>   
      </div>
  </div>
</div>
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


  <!-- Scroll to Top Button-->
 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เตรียมตัวออกจากระบบ</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">คุณต้องการออกจากระบบ ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <a class="btn btn-primary" href="index.php?logout='1'">ออกจากระบบ</a>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>