Cakephp Questions and Answers Plugin

    Author: Anikendra Das Choudhury (anikendra@gmail.com)
    http://www.webappniche.com
    version: 1.0

The purpose of the plugin is to provide a ready to use Cakephp questions and answers solution in line of Yahoo Answers. 

Changelog

    1.0 Initial release alpha

About Plugin

    Live Demo: http://hotbhojpuri.in/sawaljawab

Feature List

    Fully functional questions and answers plugin in line of Yahoo Answers with points system. Works seemlessly with your already built user authentication via AuthComponent. Designed with Twitter Bootstrap so can be integrated into existing project with much ease.

        Questions and Answers in multi level categories.
	Supports login via Cakephp AuthComponent.
        Designed with Twitter Bootstrap.
        Supports three states for Questions viz. Open, Resolved and Deleted.
	Points system for more user engagement.
	SEO friendly urls.
	Favourite Questions functionality.
	
Install and Setup

    First clone the repository into your app/Plugin/Answers directory

    git clone https://github.com/anikendra/cakeanswers app/Plugin/Answers

    Load the plugin in your app/Config/bootstrap.php file:

    //app/Config/bootstrap.php
    CakePlugin::load('Answers');

    Create the required tables using the script cakeanswers.sql. That's it cakeanswers is ready to be used.

Usage

    The plugin is ready for production use from word go. Only thing that needs to be taken care is that the users table in your application database should have a field first_name. Create your own url routes if you want to. The plugin has been developed keeping SEO aspects in mind.  

You can see a live application running on cakeanswers plugin at http://hotbhojpuri.in/sawaljawab 
