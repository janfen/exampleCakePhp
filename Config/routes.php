<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'users', 'action' => 'login'));

	#Router::connect('/posts/add', array('controller' => 'posts', 'action' => 'add'));
	#Router::connect('/posts/edit/*', array('controller' => 'posts', 'action' => 'edit'));
	#Router::connect('/posts/view/*', array('controller' => 'posts', 'action' => 'view'));
	#Router::connect('/posts/delete/*', array('controller' => 'posts', 'action' => 'delete'));
	#Router::connect('/posts/*', array('controller' => 'posts', 'action' => 'index'));
	#Router::connect('/threads/add', array('controller' => 'threads', 'action' => 'add'));
	#Router::connect('/threads/edit/*', array('controller' => 'threads', 'action' => 'edit'));
	#Router::connect('/threads/view/*', array('controller' => 'threads', 'action' => 'view'));
	#Router::connect('/threads/delete/*', array('controller' => 'threads', 'action' => 'delete'));
	#Router::connect('/threads/*', array('controller' => 'threads', 'action' => 'index'));
	#Router::connect('/users/add', array('controller' => 'users', 'action' => 'add'));
	#Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	#Router::connect('/users/logout', array('controller' => 'users', 'action' => 'logout'));
	#Router::connect('/*', array('controller' => 'users', 'action' => 'login'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
