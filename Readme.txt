The code on this repo has all the website code and the back end code.
The only requirement for the user is to install sphinx software and configure it to listen on localhost:9312.

------

At this point I'll assume that the sphinx has been configured. If the user needs any help he can refer to http://sphinxsearch.com/docs/current.html. The sphinx service should be running now.

For a fresh start:
1) Import the database schema and clear all the table entries.
2) Run the crawler found inside the Website/SE folder. It will start downloading the relevant papers.
3) After crawler is done, run parser found in the same folder. It will read the papers and introduce them in the database.
4) After this is done, run the buildNewIndex.bat file in the same folder. This will index the new files to make them searchable.
5) Now run the website on localhost and start using the search engine.