<?php
    echo"CATALOG";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <head>
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
<link rel="stylesheet" type="text/css" href="CSS/style.css">
<link rel="stylesheet" type="text/css" href="CSS/nivo-lightbox/nivo-lightbox.css">
<link rel="stylesheet" type="text/css" href="CSS/nivo-lightbox/default.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                    <li><a href="#Logout" class="page-scroll">Log Out</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>

    <!-- Body Content -->
     
    <div class = "container py-5">
    <div class ="row">
    <table id="example" class="content-table" tyle="width:100%">
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Year Published</th>
            <th>Availability</th>
            </tr>
        </thead>
        <tbody>
		<?php
        $result = mysqli_query($conn, "SELECT book_name,author,genres,rating,availability FROM book");
        while($row = mysqli_fetch_assoc($result)){
            echo 
            "<tr>
                <td class='px-4 py-2 text-center border'>$row[book_name]</td>
                <td class='px-4 py-2 text-center border'>$row[author]</td>
                <td class='px-4 py-2 text-center border'>$row[genres]</td>
                <td class='px-4 py-2 text-center border'>$row[rating]</td>
                <td class='px-4 py-2 text-center border'>$row[availability]</td>
            </tr>";
         }
         ?>
            <tr>
                <td class="px-4 py-2 text-center border">The Great Gatsby</td>
                <td class="px-4 py-2 text-center border">F. Scott Fitzgerald</td>
                <td class="px-4 py-2 text-center border">4.5</td>
                <td class="px-4 py-2 text-center border">Available</td>
            </tr>
        </tbody>
    </table>
      </div>
  </div>
    
    
    <!-- Pagination -->
    
</div>
<script> 
<script src = "https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src = "./app2.js"></script>
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