Wannabe MVC
===========

Wannabe MVC is a different kind of MVC--it's a wannabe, really.  It was born out of a love for frameworks like [Ruby on Rails](http://rubyonrails.org/), [Lithium](http://lithify.me/), and [Symfony](http://www.symfony-project.org/) but isn't robust. It Doesn't really have an ORM or PDO or any other sweet acronym. It only works with MySQL. No magical `has_many` relational stuff (but it's super easy to do yourself.)

What it _does_ have is some basic functionality I just can't live without.

I built this in 3 days because I wanted:

1. Model instances returned from the database, not just an array of values (looking at you CakePHP)
2. A command line interface, especially scaffolding
3. Simple database migrations
4. To see if I actually know PHP
5. Prove to some friends I can build a satisfactory API
6. Ability to run on CentOS 4 (?!) and PHP 5.1 (!?)

Plenty of PHP frameworks met items 1-3, using anybody elses framework doesn't really help 4 and 5, and none of them met 6 (nor should they.)  This framework sort of just showed up in textmate as I worked on a certain project. Whenever I have to work on out-dated servers, expect updates.

In a nutshell, it's a great little tool for small sites that require a database on servers that can't be upgraded.

Requirements:
-------------

- PHP 5 (maybe even 4?)
- PHP command line interface
- MySQL

Installation:
-------------

__Create your application directory:__

    $ mkdir my_website
    $ cd my_website

__Clone the wannabe mvc framework__

    $ git clone git@github.com:rpflorence/wannabe-mvc.git

__Install it__

    $ php wannabe-mvc/install

__Configure__

1. Open `config/database.yml` and point it to a database (may have to create it first)
2. Point your web server to `public`

Usage
=====

Command Line Interface
----------------------

### Generators:

__scaffold__

    $ php script/generate scaffold [model] [column]:[type] [column2]:[type]
    $ php script/generate scaffold article title:string body:text

__controller__

    $ php script/generate controller [controller_name] [action] [action2]
    $ php script/generate controller home index about contact

__migration__

    $ php script/generate migration [migration_name]
    $ php script/generate migration add_email_to_authors

### Migrate / Rollback Database:

__migrate__

    $ php script/database migrate

__rollback__

Rollback takes a number of migrations to roll back, it defaults to 1.

    $ php script/database rollback
    $ php script/database rollback 2

