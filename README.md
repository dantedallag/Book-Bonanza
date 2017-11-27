Book Bonanza: A Book Recommendation System
By Patterson Jaffurs, Dante Dalla Gasperina, and Isaac Jorgensen


INSTALLATION GUIDE:

If you would like to use an already running version of Book Bonanza, please visit: http://linux.students.engr.scu.edu/ ddal- laga/htdocs/. To install your own version of Book Bonanza, please follow the instructions provided in this appendix. Note that this guide assumes that you have a Santa Clara University Design Center account, have access to a Design Center Computer, and have obtained all of the project files. If you have all of these things ready, you are prepared to proceed with the following steps:

1. Once logged into to a Design Center computer (Linux or Mac), open up a Terminal window.
2. If you do not have an SCU student webpage, enter the command webpage into the terminal and follow the steps onscreen to enable a webpage. It should take no longer than fifteen minutes to activate.
3. Place all of the Book Bonanza files in /webpages/⟨username⟩, using your preferred method. Ensure they are in a subfolder called htdocs.
4. Navigate in terminal to /webpages/⟨username⟩ and change the file permissions for each file with chmod 0644 ⟨filename⟩.
5. Now, you must setup MySQL, which you can start by emailing support@engr.scu.edu and asking for a MySQL account. Once created, your database name will be db ⟨username⟩, your username the same as your Design Center name, and your password your full Access Card ID number.
6. Setup your database with the command setup mysql5 and run it with mysql -h dbserver.engr.scu.edu -p -u ⟨username⟩ ⟨database name⟩ and enter your password.
7. Once at the MySQL command line, run source Tables.sql to create your database tables, making sure you are running from the folder where all of the Book Bonanza files are.
8. Exiting MySQL, you now must go through each Book Bonanza .php file and change the host, user, password, and database variables to match your own MySQL credentials. Otherwise, the webpage will use the wrong database.
9. You must also change any and all lines that contain the URL portion / ̃ddallaga/htdocs/ to have your Design Center username in place of ddallaga.

Your Book Bonanza webpage should now be up and running, accessible via http://linux.students.engr.scu.edu/ ̃⟨username⟩/ or from http://students.engr.scu.edu/ ̃⟨username⟩/. We hope that this guide was helpful for all of your book recommen- dation needs.