<?php include "templates/header.php"; ?>

<!DOCTYPE html>
<html lang="en" class="bg-secondary">
<head>
    <meta charset="UTF-8">
    <title>Rationale</title>
</head>
<body>
    <div class="container-fluid bg-light">
	
	<h1>Rationale</h1>
	
	<p>This project was to create a basic expense tracker in which multiple users could add, edit, and remove items in which they purchased. The user would input the product name, cost, and how much they paid, then the system would automatically add the date and calculate the total amount owed.
	</p><p>It was decided that bootstrap would be used for all styling on the site as this would create a uniform and relatively simple style and would eliminate the need for an additional CSS file.
</p><p>The first part of the project that was completed was the user authentication system, it is based off the system in which was used in our tutorials with some modifications to use bootstrap and have all pages on the site uniform.
</p><p>The next section that was completed was the headers and footer. Unlike the footer, the header changed depending on if the user was logged in or not, this was achieved by having three header files, one for the sections that are viewed when logged in, one when logged out, and one for what is seen over the entire website. The header also contains the code to handle gathering user session data and redirects to the login screen where necessary. 
</p><p>Finally, the expense tracker was created. This again used the tutorial work as foundation and was modified where necessary. As for this type of application most of the user actions could be completed on one page, as many controls (such as viewing, adding, and deleting) were all combined into one page. An addition to ensure the user was authenticated to modify that data was also added, to prevent inadvertent or malicious deletion or modification of data. The data fields were also made to only allow the correct type of data and warn the user if they entered invalid data prior to it being sent to the server.
</p><p>There was one issue with the inputs that took a little effort to overcome, on a standard input form when the user presses refresh the data that was sent in the form is automatically entered and resent leading to duplicate entries, this was also made worse by inadequate feedback to the user and their natural instinct to press the refresh button when things aren’t working. To overcome this issue when data is entered the page will automatically clear the form and refresh the page to both show the new data and prevent accidental duplication of data.
</p><p>The database itself could not be reused from the tutorial work as both the data types and the number of fields were different. The new database required two table, one with the following fields and types for the product purchase data: ID (incrementing unique int), Username (string), Product name (string), price (float), amount paid (float), and the date entered (dateTime). And the other contained the user account data.
</p><p>This project did not focus on the user interface as the project was focused primarily on the back end of the website, however some considerations were taken on the front end to ensure the application is intuitive and easy to use even if it doesn’t look perfect.
</p>
	
	
	</div>

</body>
<?php include "templates/footer.php"; ?>
</html>