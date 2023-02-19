# Postrify

---

<h6>this is a laravel app inspired by learnathon@2023</h6>

---

### Detailed Commits

#### 1. clean up

-   after the initial setup we clear the route
-   set the posts route
-   clear the welcome.blade.php
-   add the app.bladed.php with **yeilds**
-   add the posts index blade file and show simple string

#### 2. tailwind added

-   tailwind docs rocks
-   just follow them

#### 3. navbar added

#### 4. base template setup

-   the nav bar is having some margin bottom
-   the main content is having nice spacing
-   the base bg color is tuned a bit darker

#### 5. migration

-   migrating the defaults
-   adding the username to the users table by the following code

        php artisan make:migration add_username_to_users_table

-   adding the username column in the up migration and in the down migration we are dropping that col
-   migrating again

#### 6. adding the mass assignment for username col

#### 7. adding key few things about register

-   adding the register controller in the auth folder
-   adding the register view in the auth folder as well
-   adding the register route and assigning the class and function

#### 8. adding the register route & the register form

-   in the routes we are giving the name of the register route
-   we are adding the route in the nav part
-   added the form for the registration
-   any form we submit is by default set to cross site request forgery protection. So it must be set that who is submitting the form is actually submitting it or not. And for that we have to see the session tokens. **if page is expired | err 419** -> solution can be @csrf at the beginning of form
-   adding the store route for the form to be stored and adding the store function in the Register controller
