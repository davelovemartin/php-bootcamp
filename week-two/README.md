# Week Two - while(!asleep()) sheep++;

In order to complete this session, you will need to have completed the work from [week one](./week-one/).

Here are the instructions to follow for week two:

1. Open *MAMP* and start your servers.
2. From the MAMP Start Page http://localhost:8888/MAMP/ click on the *phpMyAdmin link*. phpMyAdmin lets us create and SQL code by using a GUI.
3. We’re going to create a database by clicking on the *Databases* tab.
4.	Underneath *Create Database* in *Database name* type `my_database`, (leave collation) and click on the *Create* button.
5.	Next, we’re going to create a table to go into our database:

  a.	If you’re not already on the *Structure* tab, click on it!

  b.	Underneath *Create Table* type `my_table` into *name*,

  c.	Type `3` in the number of columns, and

  d.	Click on *Go* to create the table.

6. The next screen enables us to define the names of our table columns and the data types we can keep in the table.  Let’s give our columns the following *names*:
  `title`, `description`, `filename` set the *(data-)types* to `VARCHAR` and the *lengths* to `255`. Click on the *Preview SQL* button and you can see the SQL code that will be run to generate a table based on the information you’ve just entered.  Close the preview and click on the *Save* button to run the SQL.
![picture of PhpMyAdmin table structure](./Picture1.png)
7. We’re going to add some data to the table using SQL:

  a. Click on the *SQL* tab,

  b. Click on the *INSERT* button,

  c. Type in the following:

        INSERT INTO `my_table` (`id`,`title`, `description`, `filename`) VALUES (0,'First title','This is a description of the first image','01.jpg');


  Notice how the quote marks used here are actually *grave accents* (AKA *backticks*).

  d. Click on the *Go* button.

8. If you click on the Browse tab, you can see the contents of your one row table. Let’s go back to the SQL tab and re-create the rest of the data that was in last weeks’ array of arrays:

        INSERT INTO `my_table` (`id`,`title`, `description`, `filename`) VALUES (1, 'Second         title', 'This is a description of the second image', '02.jpg');
        INSERT INTO `my_table` (`id`,`title`, `description`, `filename`) VALUES (2, 'Third         title', 'This is a description of the third image', '03.jpg');
        INSERT INTO `my_table` (`id`,`title`, `description`, `filename`) VALUES (3, 'Fourth         title', 'This is a description of the fourth image', '04.jpg');
        INSERT INTO `my_table` (`id`,`title`, `description`, `filename`) VALUES (4, 'Fifth         title', 'This is a description of the fifth image', '05.jpg');
        INSERT INTO `my_table` (`id`,`title`, `description`, `filename`) VALUES (5, 'Sixth title', 'This is a description of the sixth image', '06.jpg');

9. We can use our PHP script to connect to the database, and loop through the data in the table but first we need to set up a database user:

  a.  Go to *Database: my_database* (in the breadcrumbs) and click on the *Privileges* tab;

  b.	Under *New*, click on *Add user account*;

  c.	Change *username* to: `my_name`, *hostname* to: `localhost`, and add some passwords;

  d.	Under *Global privileges* check `Check all`;

  e.	And click the *Go* button to add your user.

10. We can use these credentials to connect our script to the database.  In your index.php file add the following to the top of your script (above the variables):

        $db = new mysqli('localhost', 'my_name', 'myPassword', 'my_database');
        # check our connection to the database and return error if broken
        if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
        }
11. When we open a connection to a database, it’s a good idea to close it afterwards – add this to the very end of index.php:

        <?php
          # close the connection to your database
          $db->close();
        ?>

12. Let’s go ahead and pull out all the rows of data in our table:

        # select all rows from the table my_table
        $sql = <<<SQL
        SELECT *
        FROM `my_table`
        SQL;

        # check our query will actually run
        if(!$result = $db->query($sql)){
          die('There was an error running the query [' . $db->error . ']');
        }

13. We now have a variable `$result` that contains a *mysqli_result* object, we can now loop through the result:

  a.	Delete the `$myArray` variable and the array of arrays we created last week,

  b.	Replace:

        for ($i = 0; $i < count($myArray); $i++ ) {
          $fileNumber = $i + 1;
          echo "<article class='6u 12u$(xsmall) work-item'>";
          echo "	<a href='images/fulls/0". $fileNumber .".jpg' class='image fit        thumb'><img src='images/thumbs/0". $fileNumber .".jpg' alt='' /></a>";
          echo "	<h3>" . $myArray[$i][title] . "</h3>";
          echo "	<p>" . $myArray[$i][description] . "</p>";
          echo "</article>";
        }

    With:

        # loop through all the rows in the table
        while($row = $result->fetch_assoc()){
          echo "<article class='6u 12u$(xsmall) work-item'>";
          echo "	<a href='images/fulls/". $row['filename'] ."' class='image fit thumb'><img src='images/thumbs/". $row['filename'] ."' alt='' /></a>";
          echo "	<h3>" . $row['title'] . "</h3>";
          echo "	<p>" . $row['description'] . "</p>";
          echo "</article>";
        }
        # free up system resources
        $result->free();


## Challenge
Your challenge is to create a new php file that can edit the database from the browser.
Hints:
* Create a new file and give it a new name – I suggest `edit.php`.
* Create a link from `index.php` to your new page [html links](https://www.w3schools.com/html/html_links.asp) and check that it works!
* Create a HTML table (there's an example in the template if you want to use it) that has 4 columns, a row of table headings (“&nbsp;”,“title”, “description”, and “filename”) and a row in the table body [html tables](http://www.w3schools.com/html/html_tables.asp).
* We'll need to add a new column to the database table - `id` (set to `integer`) it might be easier to drop the table and insert new data.
* Use php to echo out the values in the database like we did in `index.php`.
* Wrap the table in a form element:

        <form name="form1" method="post" action="">
          <table>
          ...
          </table>
          <input type="submit" name="submit" class="button big" value="Save">
        </form>

and make each cell an input.  For example...

        <td><input name="title[]" type="text" id="title" value="' . $row['title'] . '"></td>

* `$_POST` is an array of variables passed to the current script via the HTTP POST method - [Php Forms](https://www.w3schools.com/PhP/php_forms.asp) you can use these to update the database with the data in the form by using an update query: [php mysql update](https://www.w3schools.com/php/php_mysql_update.asp) but you'll need to loop through the data collected in order to achieve this - you can add this code directly after the table. Use an if statement to call this code `if($_POST["submit"]){...}`


## Next week:
We will create a *D3* infographic on our page that gets its data from its own *database table*.

## Further reading:
* [MySQL Data Types](https://dev.mysql.com/doc/refman/5.6/en/data-types.html) - what all the different *data-types* are.
* [Grave Accents](https://stackoverflow.com/questions/7857278/what-is-the-meaning-of-grave-accent-aka-backtick-quoted-characters-in-mysql) - why we use the grave accent to escape characters in MySQL.
* [Introducing PHP Classes](http://codular.com/introducing-php-classes) - Working with classes in PHP is a great way to streamline your code... object oriented (OO) programming made easy.
* [MySQLi for beginners](http://codular.com/php-mysqli) - tutorial covering the basics
* [PHP symbols](https://stackoverflow.com/questions/3737139/reference-what-does-this-symbol-mean-in-php) - what do those funny characters mean? PHP Syntax explained.
