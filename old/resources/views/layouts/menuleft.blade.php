<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cdbootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cdbootstrap/css/cdb.min.css" />
    <title>Document</title>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/cdb.min.js"></script>
  </body>

  <div class="app" style="display: flex; height: 100%; position: absolute">
    <div class="sidebar bg-dark text-white" id="sidebar-showcase" role="cdb-sidebar">
      <div class="sidebar-container">
        <div class="sidebar-header text-center">
          <a class="sidebar-brand ">Setting</a>
        </div>
  
        <div class="sidebar-nav">
          <div class="sidenav">
            <a href="/admin/detailadmin" class="sidebar-item">
              <i class="fa fa-th-large sidebar-icon"></i>
              <span>Dashboard</span>
            </a>
            <a href="/admin/statuscompany" class="sidebar-item">
              <i class="fa fa-sticky-note sidebar-icon"></i>
              <span>status</span>
            </a>
            <a href="/admin/about" class="sidebar-item">
                <i class="fa fa-sticky-note sidebar-icon"></i>
                <span>about</span>
              </a>
              <a href="/" class="sidebar-item">
                <i class="fa fa-sticky-note sidebar-icon"></i>
                <span>contact</span>
              </a>
            
          </div>
        </div>
  
       
      </div>
    </div>
  </div>
</html>

<script>
    const sidebar = document.querySelector('.sidebar');
    new CDB.Sidebar(sidebar);
  </script>
  
  <script src="../build/cdbbootstrap.js"></script>

  <script>
    const sidebarNav = document.querySelector('#sidebar-nav');
    new CDB.Sidebar(sidebarNav);
</script>
<script>
    const sidebarShow = document.querySelector('#sidebar-showcase');
    new CDB.Sidebar(sidebarShow);
</script>
