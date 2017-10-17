# Week Three - A SQL query goes into a bar, walks up to two tables and asks, "Can I join you?

In order to complete this session, you will need to have completed the work from [week two](./week-two/).  A solution for last week's challenge can be found in this week's folder: [edit.php](/edit.php).

***Challenge - create a *D3* infographic on our page that gets its data from its own *database table*.***

No, step-by-step instructions this week. However as with last week's challenge here are some  hints:

* You can "include" other PHP scripts in index.php that will grab the code in another file.  This is useful for organising your codebase as you can separate different functionality into different files.  Use `<?php include 'graph.php' ?>` and work in a new file.
* `json_encode()` will return a string containing a JSON representation of data. So you can use a script to access data in a database and simply return JSON.  So far we've used PHP alongside HTML but pure PHP scripts are very common. Use `echo json_encode($data);` as the result of your script.
* A library of examples are available via the [D3 Github repository](https://github.com/d3/d3/wiki/Gallery)
* Trying modifying one of the Javascript examples to pick up your data. Eg:

    d3.json('./data.php', function (error, data) {
      data.forEach(function(d) {
        // set variables here
    })

* If you're stuck have a look at the examples in the src folder.  I've adapted [this example](http://bl.ocks.org/bbest/2de0e25d4840c68f2db1) of a D3 chart.

## Further reading:
* [Slim Micro-framework](https://www.slimframework.com/) - PHP micro framework that helps you quickly write simple yet powerful web applications and APIs. Gives you an understanding what larger libraries are doing without the bloat.
* [Laravel](https://laravel.com/) - Framework for "Web Artisans"
* [Code Igniter](https://codeigniter.com/) - Framework with a very small footprint
