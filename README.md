# phrase_analyser
Yowe test (created using Symfony 4.2)
<hr>
#How to Install

- clone the repository
- run : composer install
- run : bin/console server:run
- access it locally using by 127.0.0.1:8000 (keep in mind port 8000 might be different in your case if its busy)

# Description:
Create a web application that will analyse customer input and provide some statistics.
Runflow:
Step 1. Customer is asked to insert a string (not longer then 255 chars)
Step 2. Customer submits the data and receives a grid overview with character statistics.
column1 - character symbol
column2 - how many times character encountered.
column3 - sibling character info: character was seen standing before [list of chars], after [list of chars], longest
distance between chars is 10 (in case of 2 or more characters).
Guidance:
- use framework if needed. using composer is a plus
- Using Db is not requireed in this assignment
- Assignment should be implemented using objects arranged into graph
- Write a phpunit for function that will traverse the graph.
