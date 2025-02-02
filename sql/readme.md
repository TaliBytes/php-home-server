# MySQL Setup Steps

A few steps need to be taken to set up the MySQL database portion of the webserver:

1 - Create the necessary tables using tables_create.sql.

2 - Populate bare minimum necessary data using tables_populate.sql (not added yet).

3 - Recommended but optional: Create triggers for tracking changes in database (audit) using triggers_audit.sql (not added yet). Alternatively, use my Gist [audit_createTriggers.sql](https://gist.github.com/TaliBytes/fffe05b9603ea090da7536cb1a4c0db3) to manually define what tables and columns to track.
