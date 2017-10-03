# Week One - Is there an echo in here?

Here are the instructions to follow for week one:

1.	Download and install [MAMP](https://www.mamp.info/en/) - the free MAMP download comes bundled with MAMP Pro trial version but you don't have to use, or pay for this (unless you want to at a later date). If you have a Windows laptop, try [XAMPP](https://www.apachefriends.org/index.html)
2.	Open MAMP.
3.	Hit Start Servers > http://localhost:8888/MAMP/?language=English should show a page that says “MAMP has been installed successfully”.
4.	Go to *Preferences > Web Server > Document Server* and change this path to where you want to keep your files for this project (you might want to create a new folder for your project before you do this).
5.	Go to [https://html5up.net/strata](https://html5up.net/strata) and download the Strava theme.
6.	Copy the contents of the *html5up-strata* folder into your project folder.
7.	Go to http://localhost:8888/ in your favourite browser.
8.	You should see the strata html pages.
9.	Open up your project folder or `index.html` in your favourite code-editor
10.	Rename the file to `index.php`
11.	Refresh the browser – in should find `index.php` instead of `index.html` – ie. No change!
12.	We’re going to use `echo` to customise the title of the website. Remove the text in between the title tags and replace with:

    `<title><?php echo “My website”; ?></title>`

13.	Refresh the browser… you should see the title change in the tab.
14.	Amazing… we’re coding PHP, it’s not that hard is it?
    Let’s declare some variables… delete the commented HTML under the `<!DOCTYPE HTML>` tag and replace it with something like:
    `<?php`
	      `$myName = "Dave Martin";`
        `$myJobTitle = "UWE Alumni and Indie Web Developer";`
    `?>`
    Notice how we put a semi-colon at the end of each PHP statement - watch out for this, if you leave out a semi-colon, it can cause errors in your code and your page not to run.
15. We can use these variables over-and-over again in our script.  It’s good to keep them together in the same place so we can easily refer to them.  Let’s replace:
    `<h1><strong>I am Strata</strong>, a super simple<br /> responsive site template freebie<br /> crafted by <a href="http://html5up.net">HTML5 UP</a>.</h1>`
with:
    `<h1><strong>I am <?php echo $myName; ?> :</strong> <?php echo $myJobTitle; ?>.</h1>`

16.	We could also replace our name in the title.  We need to use a full-stop to concatenate (join together) the string and our echo function:
    `<title><?php echo $myName . "'s website"; ?></title>`
17.	Let’s get dynamic.  Ever seen a website where the copyright symbol shows an old date?  It's not great because it creates uncertainty in our minds as to whether the information on the rest of the website is up-to-date.  Let’s change the Copyright to always have the current year:
a.	Add `$date = Date(Y);` to our variables at the top of the page.
b.	Replace:
    `<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>`
with:
    `<li>&copy; <?php echo $date; ?></li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>`
18.	For our next trick we are going to need 6 images: create two different sixes for each: (740px x 343px, and a thumbnail version 370px x 217px).  For each image, think of a *title*, think of a *description*. (I’m just going to use the ones in the theme).
19.	We can keep all this information in an *array* like follows (add this under your variables):
    `$myArray = [title => "First title", description => "This is a description of the first image"];`
20.	Let’s replace this html:

      <article class="6u 12u$(xsmall) work-item">
        <a href="images/fulls/01.jpg" class="image fit thumb">
          <img src="images/thumbs/01.jpg" alt="" />
        </a>
        <h3>Magna sed consequat tempus</h3>
        <p>Lorem ipsum dolor sit amet nisl sed nullam feugiat.</p>
      </article>

21.	…with the data we’re holding in the array:
    `<article class="6u 12u$(xsmall) work-item">`

      `<a href="images/fulls/01.jpg" class="image fit thumb">`

        `<img src="images/thumbs/01.jpg" alt="" />`

      `</a>`

      `<h3><?php echo $myArray[title]; ?></h3>`

      `<p><?php echo $myArray[description]; ?></p>`

    `</article>`

22.	You can think of the keys (title and description) as column headings in a table.  Our array is a one row table.  To make a multi-row table we need to have an array of arrays:

    `$myArray = [
      [title => "First title", description => "This is a description of the first image"],

      [title => "Second title", description => "This is a description of the second image"],

      [title => "Third title", description => "This is a description of the third image"],

      [title => "Fourth title", description => "This is a description of the fourth image"],

      [title => "Fifth title", description => "This is a description of the fifth image"],

      [title => "Sixth title", description => "This is a description of the sixth image"]
    ];`
23.	We’ll now have to change our html to reflect this:
    `<article class="6u 12u$(xsmall) work-item">
      <a href="images/fulls/01.jpg" class="image fit thumb">
        <img src="images/thumbs/01.jpg" alt="" />
      </a>
      <h3><?php echo $myArray[0][title]; ?></h3>
      <p><?php echo $myArray[0][description]; ?></p>
    </article>`
24.	Now repeat for the next 5… No wait!  DON’T REPEAT YOURSELF!!!  We can use a loop through our array like this…
a.	First of all change the html so that we echo out each line:
    `<?php
      echo "<article class='6u 12u$(xsmall) work-item'>";
      echo "  <a href='images/fulls/01.jpg' class='image fit thumb'><img src='images/thumbs/01.jpg' alt='' /></a>";
      echo "	<h3>" . $myArray[0][title] . "</h3>";
      echo "	<p>" . $myArray[0][description] . "</p>";
      echo "</article>";
    ?>`
b.	Then we can add the foreach loop:
    `for ($i = 0; $i < count($myArray); $i++ ) {
      $fileNumber = $i + 1;
      echo "<article class='6u 12u$(xsmall) work-item'>";
      echo "	<a href='images/fulls/0". $fileNumber .".jpg' class='image fit thumb'><img src='images/thumbs/0". $fileNumber .".jpg' alt='' /></a>";
      echo "	<h3>" . $myArray[$i][title] . "</h3>";
      echo "	<p>" . $myArray[$i][description] . "</p>";
      echo "</article>";
		  }
		}`

Now we’re cooking…

Next week:  We will replace our “array of arrays” with a database table in MySQL
