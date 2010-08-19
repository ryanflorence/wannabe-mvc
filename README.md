Wannabe MVC
===========

Wannabe MVC is a different kind of MVC--it's a wannabe, really.  It was born out of a love for frameworks like [Ruby on Rails](http://rubyonrails.org/), [Lithium](http://lithify.me/), and [Symfony](http://www.symfony-project.org/) but isn't robust. It Doesn't really have an ORM or PDO or any other sweet acronym. It only works with MySQL.

What it _does_ have is some basic functionality I just can't live without.

I built this (quickly) because I wanted:

1. Model instances returned from the database, not just an array of values (looking at you CakePHP)
2. A command line interface, especially scaffolding
3. Database migrations (dumps are for the birds)
4. Support for `has_many` and `belongs_to` magic (`habtm` eventually)

And Needed:

5. The ability to run on our work server: CentOS 4 (?!) and PHP 5.1 (!?)

Plenty of PHP frameworks met my wants but none of them met my need (nor should they.)  This framework sort of just showed up in textmate as I worked on a certain project. Whenever I have to work on out-dated servers, expect updates.

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


Command Line Interface
======================

Generators:
-----------

__scaffold__

    $ php script/generate scaffold [model] [column]:[type] [column2]:[type]
    $ php script/generate scaffold article title:string body:text

__controller__

    $ php script/generate controller [controller_name] [action] [action2]
    $ php script/generate controller home index about contact

__migration__

    $ php script/generate migration [migration_name]
    $ php script/generate migration add_email_to_authors

Migrate / Rollback Database:
----------------------------

__migrate__

    $ php script/database migrate

__rollback__

Rollback takes a number of migrations to roll back, it defaults to 1.

    $ php script/database rollback
    $ php script/database rollback 2


Models, Views, Controllers
==========================

Models
------

		// Query the DB
		Article::find('all');
		Article::find(5);
		User::find_all_by('email', 'rpflorence@example.com');

		// update and save
		$article->title = 'Totally Rad';
		$article->save();

		// Has Many
		class Category extends ModelBase {
			
			public $has_many = array('articles');
			
		}
		
		// Belongs To
		class Article extends ModelBase {
			
			public $belongs_to = array('category', 'user');
			
		}

Controller
----------

    class ArticleController extends ControllerBase {
		
      public function awesome(){
        $this->sauce = 'Awesome';
      }
    
    }

View
----

    <!-- http://example.com/aticles/awesome
    <h1><?php echo $this->sauce ?></h1>

