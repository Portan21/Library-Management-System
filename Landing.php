<?php
    echo"CATALOG";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Favicons
    ================================================== -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="CSS/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/CSS/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css" href="CSS/catalog.css">
<link rel="stylesheet" type="text/css" href="CSS/nivo-lightbox/nivo-lightbox.css">
<link rel="stylesheet" type="text/css" href="CSS/nivo-lightbox/default.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

    <title>Catalog</title>
    <!-- Include necessary CSS and JavaScript files here -->
</head>
<body>
    <a href="logout.php">logout, <?php echo'$_SESSION["first_name"]';?></a>
    
    <!-- Navigation Bar -->
    <nav id="menu" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="img/logo.png" alt="Library Logo" style="float: left; margin-right: 10px;">
                <a class="navbar-brand page-scroll" href="#page-top">SCRIBE</a>
                
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#Catalog" class="page-scroll">Catalog</a></li>
                    <li><a href="#Profile" class="page-scroll">Profile</a></li>
                    <li><a href="logout.php" class="page-scroll">Log Out, <?php echo'$_SESSION["first_name"]';?></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>

    <!-- Body Content -->
<!-- Landing page Section -->
<div id="portfolio">
  <div class="container">
    <div class="section-title">
      <h2>Library Management System</h2>
    </div>
    <center>
    <div class="row">
      <div class="portfolio-items">
        <div class="col-sm-6 col-md-6">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="https://www.youtube.com/" title="Project Title" data-lightbox-gallery="gallery1">
              <div class="hover-text">
                <h4>Create Librarian Account</h4>
              </div>
              <img src="Pictures/landing/createlib.png"  class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-6">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/08-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
              <div class="hover-text">
                <h4>Issue Book</h4>
              </div>
              <img src="Pictures/landing/issue.png" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-6">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/09-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
              <div class="hover-text">
                <h4>Borrow Request</h4>
              </div>
              <img src="Pictures/landing/borrow.png" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/09-large.png" title="Project Title" data-lightbox-gallery="gallery1">
              <div class="hover-text">
                <h4>Account Approval</h4>
              </div>
              <img src="Pictures/landing/accapp.png" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/09-large.png" title="Project Title" data-lightbox-gallery="gallery1">
              <div class="hover-text">
                <h4>Manage Accounts</h4>
              </div>
              <img src="Pictures/landing/manageacc.png" class="img-responsive" alt="Project Title"> </a> </div>
          </div>
        </div>
      </div>
    </div>
    </center>
  </div>
</div>
    
</div>
<script> 

// JavaScript logic for dynamic pagination
const table = document.querySelector('table');
        const rows = table.querySelectorAll('tbody tr');
        const rowsPerPage = 5;
        let totalPages = Math.ceil(rows.length / rowsPerPage);
        let currentPage = 0;

        function showPage(page) {
            rows.forEach((row, index) => {
                if (index >= page * rowsPerPage && index < (page + 1) * rowsPerPage) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
            document.getElementById('currentPage').textContent = page + 1 + '/' + totalPages;
        }

        showPage(currentPage); // Show the first page by default

        // Add event listeners to pagination buttons
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');

        prevButton.addEventListener('click', () => {
            if (currentPage > 0) {
                currentPage--;
                showPage(currentPage);
                prevButton.disabled = currentPage === 0;
                nextButton.disabled = false;
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentPage < totalPages - 1) {
                currentPage++;
                showPage(currentPage);
                nextButton.disabled = currentPage === totalPages - 1;
                prevButton.disabled = false;
            }
        });
        
        </script>
    </div>

</body>
</html>