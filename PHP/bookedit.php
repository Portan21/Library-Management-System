<?php
require 'config.php';

if(empty($_SESSION["accountID"])){
  header("Location: login.php");
}

if(empty($_SESSION["bookTitle"])){
    header("Location: catalogs.php");
}
else{
    $title = $_SESSION["bookTitle"];
}

if(empty($_SESSION["typeID"])){
  header("Location: bookdetail.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["submit"])) {
        // Get the values from the form
        $descriptionValue = mysqli_real_escape_string($conn, $_POST["description"]);
        $titlevalue = mysqli_real_escape_string($conn, $_POST["title"]);
        $authorvalue = mysqli_real_escape_string($conn, $_POST["author"]);
        $genresvalue = mysqli_real_escape_string($conn, $_POST["genres"]);
        $ratingvalue = mysqli_real_escape_string($conn, $_POST["rating"]);
        $availabilityvalue = mysqli_real_escape_string($conn, $_POST["availability"]);

        // Update the information in the database
        $updatequery = "UPDATE book SET 
            book_name = '$titlevalue',
            author = '$authorvalue',
            genres = '$genresvalue',
            rating = '$ratingvalue',
            availability = '$availabilityvalue',
            description = '$descriptionValue'
            WHERE book_name = '$title'";

            
        if (mysqli_query($conn, $updatequery)) {
            // The update was successful
        } else {
            // Handle the case where the update fails
            echo "Error updating record: " . mysqli_error($conn);
        }

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details - Edit</title> 
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="landing.php">SCRIBE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-lg-0 ms-auto">

            <li class="nav-item">
            <a class="nav-link active" href="catalogs.php">Catalog</a>
            </li>
	    <?php
	    if(!empty($_SESSION["typeID"])){
	    echo"
            <li class='nav-item'>
            <a class='nav-link' href='attendance(librarians)-records.php'>Records</a>
            </li>

            <li class='nav-item'>
            <a class='nav-link' href='request.php'>Request</a>
            </li>

            <li class='nav-item'>
            <a class='nav-link' href='borrowed.php'>Borrowed</a>
            </li>

            <li class='nav-item'>
            <a class='nav-link' href='penalty.php'>Penalty</a>
            </li>";
	    }

	    ?>

            <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
    </nav>
    <div class="container">
        <div class="row mt-3"></div>

        <div class="row mb-2">
            <div class="col">
                <a href="catalogs.php" class="mt-2 text-decoration-none text-uppercase">< BACK TO LIBRARY CATALOG</a>
                
                <h1 class="mt-1 text-uppercase">EDIT BOOK DETAIL</h1>
            </div>
        </div>
            <form action="" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <?php
                        $escapedTitle = mysqli_real_escape_string($conn, $title);
                        $result = mysqli_query($conn, "SELECT bookID, genres, book_name, author, description, rating, availability FROM book WHERE book_name = '$escapedTitle'");
                
                        while($row = mysqli_fetch_assoc($result)){
                            $bookID = $row['bookID'];
                            $author = $row['author'];
                            $genres = $row['genres'];
                            $rating = $row['rating'];
                            $availability = $row['availability'];
                            $description = $row['description'];
                        }
                        ?>
                        <label for="title">Title</label>
                        <input type="text" class="form-control mb-2 mt-1" value="<?php echo $title ?>" name="title" placeholder="Title" required>

                        <label for="author">Author</label>
                        <input type="text" class="form-control mb-2 mt-1" value="<?php echo $author ?>" name="author" placeholder="Author" required>

                        <label for="description">Description</label>
                        <textarea class="form-control mb-2 mt-1" name="description" placeholder="Description" rows="15" cols="50" required><?php echo $description ?></textarea>

                    </div>

                    <div class="col-md-4 mb-5">
                        
                        <a>GENRES</a>
                        <textarea type="text" class="form-control mb-3 mt-1" name="genres" placeholder="Genres" rows="5" cols="50" required><?php echo $genres ?></textarea>

                        <a>RATINGS</a>
                        <div class="row">
                            <div class="col-md-6 mt-1">
                                <input type="number" class="form-control mb-3" value="<?php echo $rating ?>" name="rating" placeholder="Ratings" step="0.01" min="0" max="5" required>
                            </div>
                        </div>

                        <a>AVAILABILITY</a>
                        <div class="row mb-4">
                            <div class="col-md-6 mt-1">
                                <select name="availability" id="sduration" class="form-select" aria-label="Default select example">
                                    <?php
                                    switch ($availability) {
                                        case '1':
                                            echo "
                                                <option value='1'>Available</option>
                                                <option value='4'>Removed</option>
                                            ";
                                            break;
                                        
                                        case '2':
                                            echo "
                                                <option value='2'>Reserved</option>
                                            ";
                                            break;

                                        case '3':
                                            echo "
                                                <option value='3'>Unavailable</option>
                                            ";
                                            break;

                                        case '4':
                                            echo "
                                                <option value='4'>Removed</option>
                                                <option value='1'>Available</option>
                                            ";
                                            break;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <button type="submit" name="submit" id="submit" class="btn btn-danger btn-lg mt-2"><b>EDIT BOOK DETAILS</b></button>
                    </div>
                </div>
            </form>

    </div>

    <script src = "https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src = "../JavaScript/app2.js"></script>
</body>
</html>