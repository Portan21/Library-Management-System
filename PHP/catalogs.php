<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["bookTitle"])) {
      $bookTitle = $_POST["bookTitle"];
      $accountid = $_SESSION["accountID"];

      $result = mysqli_query($conn, "SELECT bookID, availability FROM book WHERE book_name = '$bookTitle'");
      $row = mysqli_fetch_assoc($result);

      $bookid = $row["bookID"];
      $availability = $row["availability"];

      if($availability == 1){
        $reqquery = "INSERT INTO book_request(borrowerID, bookID) VALUES('$accountid','$bookid')";
        if(mysqli_query($conn,$reqquery)){
          // Update the 'book' table
          $updatequery = "UPDATE book SET availability = '2' WHERE bookID = '$bookid'";
          if (mysqli_query($conn, $updatequery)) {
              // The update was successful
          }
        }
        // For example, you can insert it into a database or perform any other necessary action.
        echo "<script> alert('Book:$bookTitle Borrowing Request Sent. Head to the Library WITHIN THE DAY to confirm your request and claim the book.'); </script>"; // You can provide a response if needed.
      }
      else{
        echo "<script> alert('Book:$bookTitle Currently Unavailable. Try borrowing another book.'); </script>";
      }


  } else {
      // Handle the case when 'bookTitle' is not received in the POST request.
      echo "<script> alert('BORROWING FAILED. Try again.'); </script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="stylesheet" href="../CSS/main.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> 

</head>
<body>

    <div class = "container py-5">
    <div class ="row">
    <table id="example" class="content-table" tyle="width:100%">
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Availability</th>
          </tr>
        </thead>
        <tbody>
		<?php
        $result = mysqli_query($conn, "SELECT book_name,author,genres,rating,availabilitytype,description FROM book b
        INNER JOIN availability_type a ON b.availability = a.availabilityID 
        ORDER BY bookID ASC");
        while($row = mysqli_fetch_assoc($result)){
          $bookName = htmlspecialchars($row['book_name']);
          $description = htmlspecialchars($row['description']);
          echo "<tr>
              <td class='px-4 py-2 text-center border'><a href='#' class='book-button' data-description='$description'>$bookName</a></td>
              <td class='px-4 py-2 text-center border'>$row[author]</td>
              <td class='px-4 py-2 text-center border'>$row[genres]</td>
              <td class='px-4 py-2 text-center border'>$row[rating]</td>
              <td class='px-4 py-2 text-center border'>$row[availabilitytype]</td>
          </tr>";
          
         }
         ?>
        </tbody>
      </table>
    </div>
</div>
	<!-- The modal container -->
<div id="myModal" class="modal2">
  <div class="modal-content2">
    <span class="close" id="closeModal">&times;</span>
    <h2 id="modal-title">Book Title</h2>
    <p id="modal-author">Author</p>
    <p id="modal-genres">Genres</p>
    <p id="modal-rating">Rating</p>
    <p id="modal-availability">Availability</p>
    <p id="modal-description">Description</p>
    <!-- Borrow button with ID for styling -->
    <form id="borrow-form" action="" method="post">
      <input type="hidden" id="book-title-input" name="bookTitle" value="">
      <button type="submit" id="borrow-button" name="borrow-button">Borrow</button>
    </form>

    <!-- Remove button with ID for styling 
    <button id="remove-button">Remove</button>-->

  </div>
</div>
	  <script>
      		// Get the modal and its elements
          const modal = document.getElementById("myModal");
        const modalTitle = document.getElementById("modal-title");
        const modalAuthor = document.getElementById("modal-author");
        const modalGenres = document.getElementById("modal-genres");
        const modalRating = document.getElementById("modal-rating");
        const modalAvailability = document.getElementById("modal-availability");
        const modalDescription = document.getElementById("modal-description")

        // Get all book buttons
        const bookButtons = document.querySelectorAll(".book-button");
        
        // Attach click event to each book button
        bookButtons.forEach((button) => {
          button.addEventListener("click", (e) => {
            e.preventDefault(); // Prevent the default behavior of anchor tags

            // Extract book details from the table row (adjust the class selectors accordingly)
            const row = button.closest("tr");
            const bookName = row.querySelector(".book-button").textContent;
            const author = row.querySelector(".px-4.py-2.text-center.border:nth-child(2)").textContent;
            const genres = row.querySelector(".px-4.py-2.text-center.border:nth-child(3)").textContent;
            const rating = row.querySelector(".px-4.py-2.text-center.border:nth-child(4)").textContent;
            const availability = row.querySelector(".px-4.py-2.text-center.border:nth-child(5)").textContent;
            // const description = row.querySelector(".px-4.py-2.text-center.border:nth-child(6)").textContent;

            const description = button.getAttribute("data-description");
        
            // Populate the modal with book details
            modalTitle.textContent = bookName;
            modalAuthor.textContent = "Authors: " + author;
            modalGenres.textContent = "Genres: " + genres;
            modalRating.textContent = "Rating: " + rating;
            modalAvailability.textContent = "Availability: " + availability;
            modalDescription.textContent = "Description: " + description; // Update the description

        
            // Show the modal
            modal.style.display = "flex";
          });
        });
        
        // Close the modal when the 'x' is clicked or when clicking outside of it
        const closeModal = document.getElementById("closeModal");
        closeModal.addEventListener("click", () => {
          modal.style.display = "none";
        });
        
        window.addEventListener("click", (event) => {
          if (event.target === modal) {
            modal.style.display = "none";
          }
        });

        // Get the "Borrow" button by its ID
        const borrowButton = document.getElementById("borrow-button");

        // Attach a click event to the "Borrow" button
        borrowButton.addEventListener("click", (e) => {
          e.preventDefault(); // Prevent the default form submission behavior

          // Extract the book title from the modal
          const bookTitle = modalTitle.textContent;

          // Populate the hidden input field with the book title
          const bookTitleInput = document.getElementById("book-title-input");
          bookTitleInput.value = bookTitle;

          // Submit the form
          document.getElementById("borrow-form").submit();

          // Close the modal
          modal.style.display = "none";
        });

    </script>
    <script src = "https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src = "../JavaScript/app2.js"></script>
</body>
</html>