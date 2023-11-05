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
<link rel="stylesheet" type="text/css"  href="Library-Management-System/CSS/bootstrap.css">
<link rel="stylesheet" type="text/css" href="Library-Management-System/fonts/font-awesome/CSS/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css" href="Library-Management-System/CSS/catalog.css">
<link rel="stylesheet" type="text/css" href="Library-Management-System/CSS/nivo-lightbox/nivo-lightbox.css">
<link rel="stylesheet" type="text/css" href="Library-Management-System/CSS/nivo-lightbox/default.css">
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
                <img src="../Pictures/user logo.png" alt="Library Logo" style="float: left; margin-right: 10px;">
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
    <div class="container">
    <br>
    <br>
    <br>
    <br>
     
        <br>
        <br>
        
        <!-- Add your page content here -->

        <div class="container mx-auto p-8">
    <h1 class="text-2xl font-semibold mb-4">Library Catalog</h1>
    <table id = "myTable" class="w-full table-auto bg-white border border-gray-200">
        <thead>
            <tr class="bg-blue-100">
                <th class="px-4 py-2 text-center border">Book Title</th>
                <th class="px-4 py-2 text-center border">Author</th>
                <th class="px-4 py-2 text-center border">Rating</th>
                <th class="px-4 py-2 text-center border">Year Published</th>
                <th class="px-4 py-2 text-center border">Availability</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-4 py-2 text-center border">The Great Gatsby</td>
                <td class="px-4 py-2 text-center border">F. Scott Fitzgerald</td>
                <td class="px-4 py-2 text-center border">4.5</td>
                <td class="px-4 py-2 text-center border">1925</td>
                <td class="px-4 py-2 text-center border">Available</td>
            </tr>
            <tr>
                <td class="px-4 py-2 text-center border">To Kill a Mockingbird</td>
                <td class="px-4 py-2 text-center border">Harper Lee</td>
                <td class="px-4 py-2 text-center border">4.8</td>
                <td class="px-4 py-2 text-center border">1960</td>
                <td class="px-4 py-2 text-center border">Available</td>
            </tr>

            <tr>
                <td class="px-4 py-2 text-center border">To Kill a Mockingbird</td>
                <td class="px-4 py-2 text-center border">Harper Lee</td>
                <td class="px-4 py-2 text-center border">4.8</td>
                <td class="px-4 py-2 text-center border">1960</td>
                <td class="px-4 py-2 text-center border">Available</td>
            </tr>

            <tr>
                <td class="px-4 py-2 text-center border">To Kill a Mockingbird</td>
                <td class="px-4 py-2 text-center border">Harper Lee</td>
                <td class="px-4 py-2 text-center border">4.8</td>
                <td class="px-4 py-2 text-center border">1960</td>
                <td class="px-4 py-2 text-center border">Available</td>
            </tr>

            <tr>
                <td class="px-4 py-2 text-center border">To Kill a Mockingbird</td>
                <td class="px-4 py-2 text-center border">Harper Lee</td>
                <td class="px-4 py-2 text-center border">4.8</td>
                <td class="px-4 py-2 text-center border">1960</td>
                <td class="px-4 py-2 text-center border">Available</td>
            </tr>
            
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="flex justify-center mt-4">
      <div class="bg-white p-2 border border-gray-200 rounded-md">
          <button id="prevPage" class="text-blue-500 px-3 py-2 mr-2 hover:underline" disabled>Previous</button>
          <span id="currentPage" class="px-2 py-2">1</span>
          <button id="nextPage" class="text-blue-500 px-3 py-2 ml-2 hover:underline">Next</button>
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