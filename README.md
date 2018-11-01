# contact_lenses_api

### Description
JSON API for contact lens option selection
Goal is to create a demo json api that could be consumed by a vue.js app to retrieve contact lens option values. 
Background
Depending on the configuration of contact lenses certain combination of parameters are not allowed.
Example general
Parameter 1 options: A,B,C
Parameter 2 options: X,Y,Z

Where A/Y and C/Z are not allowed. 

The selection process is always selects one parameter after another. This will allow us to filter out not allowed combinations.

Example combinations
First parameter: parameter 1 B
Options for second parameter 2: X,Y,Y

First parameter: parameter 1 A
Options for second parameter 2: X,Z

First parameter: parameter 2: Z
Options for second parameter 1: A,B

### Technical Setup
- run `composer install` to install needed dependencies
- run local web server using `php bin/console server:run`, then open browser with the URL server started in console.

### Sample links

- http://127.0.0.1:8000/strengths/cylinder/-2.25
- http://127.0.0.1:8000/strengths/cylinder/-1.75


- http://127.0.0.1:8000/axes/cylinder/-2.25
- http://127.0.0.1:8000/axes/cylinder/-1.75


- http://127.0.0.1:8000/cylinders/strength/-7.50
- http://127.0.0.1:8000/cylinders/strength/-5.50


- http://127.0.0.1:8000/axes/strength/-7.50
- http://127.0.0.1:8000/axes/strength/-5.50


- http://127.0.0.1:8000/strengths/axis/30
- http://127.0.0.1:8000/strengths/axis/170


- http://127.0.0.1:8000/cylinders/axis/30
- http://127.0.0.1:8000/cylinders/axis/170
