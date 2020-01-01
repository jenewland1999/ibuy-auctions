# CSY2028 Web Programming - Assignment 01 (iBuy Auctions)

iBuy Auctions is a watered-down clone of the popular auction site eBay. The site is built from the ground up using PHP, MySQL, HTML, CSS and JavaScript.

## Disclaimer

This project is not suited for production. This is entirely for assignment/demonstration purposes.

## How it Works

Visitors to the site can view auctions and reviews as well as sign in or register to the site. When a visitor registers they become a user. Users have added capabilities like creating, updating and deleting (CRUD) their own auctions, posting reviews on auctions and logging out.

A special type of user can be created from another database client such as MySQL Workbench called an administrator. An administrator or admin, for short, can create, update and delete (CRUD) categories, moderate auctions as well as update and delete all auctions. Admins can also manage all other users.

## Local Environment Setup

To run this website I'm using a pre-built/configured virtual machine available through Vagrant. The box and details about it can be found at <https://r.je/vje-minimal-virtual-server>.

1. Install Virtual Box, Vagrant, MySQL Workbench and Git.
2. In your terminal application, navigate to an empty directory and run vagrant init `csy2028/current`
3. Run `vagrant up`
4. Open MySQL Workbench and create a new connection using the DB information below
5. Create a DB Schema called `assignment` then save it and exit MySQL Workbench
6. Back in the terminal application, navigate inside `websites` and run `git clone git@github.com:jenewland1999/csy2028_as1 ibuy/`
7. Open your web browser of choice and type `https://ibuy.v.je/`
8. Ta-da! iBuy Auctions is running.

## Database Connection Info

- Host: v.je
- Port: 3306
- Username: student
- Password: student

---

Copyright &copy; 2019 Jordan Newland
