<img align="right" width="250" height="100" src="https://github.gatech.edu/storage/user/54135/files/d636b590-c129-459a-bd4f-5a8fffd95dd4">


# Ubuntu Community Catalyst 
Ubuntu Community Catalyst is a “neighborhood development platform" that works with community leaders to identify systemic issues and create plans to dismantle them. The website itself serves as a connective tissue between Ubuntu and the community. The website allows anyone interested in the cause to actively involve themselves at any time whether that involves donating money or volunteering their time. The main goal of the Ubuntu Community Catalyst Website Rebuild is to find ways where user interaction can increase. With this in mind and input from the organization, we will be implementing different features where community input will be actively present. 
  1. Calendar
  2. Blog
  3. e-Commerce
  4. Project pages, etc. 

# Ubuntu_Catalyst Release Notes
## Version 0.2.0
### New Features
* Added Ubuntu template and basic calendar feature 
* Added all necessary base template files
* Added dummy/template pages for pages which we will be working on in the future
### Bug Fixes
* Updated website to add in dummy pages where we may not have specific information
* Manually adding username & password into the backend panel will now allow a user to login properly
* Fixing adding more features with the calendar feature 
### Known Issues
* Need to create a functioning login page
* Login page needs to redirect to user page instead of dummy page
* Having two pages for administrators and general users

## Version 0.1.0
### New Features 
* Added all necessary base template files
* Added dummy/template pages for pages which we will be working on in the future
### Bug Fixes
* Updated website to add in dummy pages where we may not have specific information
* Manually adding username & password into the backend panel will now allow a user to login properly
### Known Issues
* Adding a login page and calendar feature
* Login page needs to redirect to user page instead of dummy page


# Ubuntu_Catalyst Feature Testing Code Base
PHP version 8.1.13 VS16 x64 Thread Safe (Windows)

# Instructions on how to run the code base locally
To Run locally (without sql capabilities) run the following in the command prompt after installing php: 
  1. cd [path to directory here]
  2. php -S 127.0.0.1:8000

To Run using Xampp webserver after installing php:
  1. Navigate to the location to where you installed xampp  (Usually C:\xampp)
  2. Inside of the htdocs folder, open git bash OR cd git bash to the directory of the htdocs file (Usually C:\xampp\htdocs)
  3. Type the command: git clone [HTTPS link to repository here]
  4. Open the Xampp control panel
  5. Click start buttons next to the names Apache and mySQL modules
  6. Open a browser and enter the url: localhost/Ubuntu_Catalyst

To push changes commands: 
  1. git status: to see if the computer has picked up changes 
  2. git add . 
  3. git commit -m "": adding a message that will be seen next to the file name
  4. git push: pushes the changes 
