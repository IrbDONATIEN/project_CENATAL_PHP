# project_CENATAL_PHP_V1 PHP 


CENATAL
-----

## Introduction

CENATAL is a web application for the centralization of birth data throughout the Democratic Republic of Congo where each province must have its own code to control the flow of data it generates and also allows the State to have reliable statistics with data collected at source.

![accueil](https://user-images.githubusercontent.com/111361566/194841448-89fea6c4-7aeb-4e37-93e4-02a6ea68ab05.PNG)


## Overview

Our application is hierarchical in the following way:
- The national service of centralization that manages the statistics of birth data on the whole republic and also creates the provinces and each province creates in turn the others vice versa that is considered in the application as administrator.


- The provinces (Inspection) which is a source of birth data will manage the other structures under their responsibilities so that the generation of data is effective as organized in the home page.  

Here is the demo of the management interface of the application.

![demo](https://user-images.githubusercontent.com/111361566/194841479-ac77aec9-fca5-4360-88e7-add3b9e96f8c.PNG)


## Getting Started

### Pre-requisites and Local Development

Developers using this project should already have:

- WampServer 3
- PHP 7.3.1/5.6
- Sweet Alert
- JQuery
- MySQL
- File database: db_cenatal.sql

## The application logic:

- Copy the folder in the WWW into WampServer
- Start the WampServer
- Create the database name as above in WampServer
- Import the database below
- Use the name of the folder to see the application in the browser example: localhost/CENATAL then enter the classifier and you need to have the internet connection to see the site correctly.
  
## Types of users:

- Administrator : LYDIA and password: 11111
- User type:Inspection,Health area and hospital.
