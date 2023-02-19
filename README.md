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

#### 9. validation in the register form

-   adding validation for the registration form
-   showing errors in the form and also adding errored styles
-   if there is any issue with the validation it will clear the form but all the hard work will be lost. so the value in the input section can be set **{{ old('prop') }}** this will save the old data so the user will fell great in filling the form again

#### 10. user created

-   after the validation a valid user's info is stored and passed as te request into the post method
-   then we insert the user in the database
-   the password will be hashed and the facade [underlying static method] make() will do that for us

#### 11. redirected to dashboard

-   after the successful user insertion into the db we are redirecting the user to the dashboard
-   adding the DashboardController, the dashboard blade view and teh route for that as well
-   **redirect()->route('dashboard') is used because if we ever change the directory of the view then the route name will be helping us to make the redirection easy**

#### 12. signing the user in [this step will be placed before the redirection]

#### 13. showing dynamic nav options based on the authenticated state

-   if the user is authenticated / signed / auth -> then it will display the user name and the logout
-   if the user is in guest mode / not auth / not logged in -> it will display the register and login
-   done in various forms but the most advanced one [auth / guest] is implemented

#### 14. login functionality added

-   the LoginController was added with index [for returning the view] and the store [actual signing in] methods
-   with proper login it moves forward to the dashboard else it redirects back to where it came from
-   added the login form with proper validation marker and alert in the blade file
-   added the login route
-   added the login route to the href of the anchor tag in the nav option of login

#### 15. logout functionality added

-   the LogoutController was added with only the store method where we are basically logging the user out and the redirecting to the homepage is done there
-   the logout was turned into a button within a form from the anchor tag as there is chance that any hacker can redirect a valid user to the logout by scripting and to protect from this we will be adding **@csrf** and the form config and this will be a post method for from the valid form
-   added the login route
-   added some extra styling for the button and the form

#### 16. homepage blade file added

#### 17. adding routes to almost all the nav links

#### 18. adding middleware

-   Dashboard -> auth [only the authorized users can see the dashboard]
-   Login -> guest [if the user is logged in should not be able to go to this route]
-   Register -> guest [if the user is logged in should not be able to go to this route]

#### 19. adding remember me functionality

-   the remember me checkbox was added to the login form
-   the functionality for the remember me token was done in the LoginController

#### 20. adding post functionality

-   added the post form in the blade file [added @csrf]
-   partially made the PostController with index and store [ partial ]
-   made the posts routes get and post

#### 21. adding post functionality [ contd ]

-   we made Post table with a migration, post factory and even a Post model
-   added the post params like body [post content -> text] & user_id

        // but the next solution works with the foreign key
        // the foreignId will be looking at user_id as user[table_name] & id[table_col]
        // constrained means the foreign key is constrained here. hit records according to their constraints foreign key
        // onDelete('cascade') means that if any user is deleted then his posts will also be deleted in the database level

        $table->foreignId('user_id')->constrained()->onDelete('cascade');

-   migrated the migration and db is now updated
-   add post validation in the PostController
-   add the routes for the post with both get and post method
-   added the create post function in the store method in the PostController
-   add mass assignment in the model then
-   work on the user elequent relationship for the one to many relationship

#### 22. adding the one to many elequent relationship between user and post model

-   added the elequent relationship

        // one to many
        // user : posts
        public function posts() {
            // as we have id in the user table and posts table has user_id
            // by convention we will not have to pass the next indexes with the parameters
            return $this->hasMany(Post::class);
        }

-   some key talks on the return values

        // posts() -> will return all the objects
        // dd(auth()->user()->posts());

        // post -> will return only the collection of the properties
        // dd(auth()->user()->posts);

#### 23. adding post functionality [ contd contd ]

-   the post can now be posted and seen in the db phpMyAdmin

#### 24. listing the posts

-   got all the posts and passed them to the post index blade page
-   as we need the name of user of a post so there needs to be a relation between post and the user and this will be done in the post model

        public function user()
        {
            return $this->belongsTo(User::class);
        }

-   iterating through the posts and showing stuff about them
-   Carbon is a third party date time manipulation library

#### 25. adding pagination

        $posts = Post::get();

-   this will return all the posts in a collection. if there are millions and millions of data then that would pull all those as collection. thats not good
-   solution pagination -> returns in LengthAwarePaginator

        $posts = Post::paginate(2);

-   this fixed the pagination styling issue adding in the tailwind.config.js

        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',

-   to add the pagination only the **links()** function did the trick

         {{ $posts->links() }}


