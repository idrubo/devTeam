<?php

/**
 * Used for setting up the routing in the system
 */
class Router
{
	/**
	 * Executes the system routing
	 * @throws Exception
	 */
	public function execute($routes)
	{
		// tries to find the route and run the given action on the controller

		/* DEBUG */ msgToConsole ('Into: Router::execute.');

		try {
			// the controller and action to execute
			$controller = null;
			$action = null;

			// tries to find a simple route
			$routeFound = $this->_getSimpleRoute($routes, $controller, $action);

			if (!$routeFound) {
				// tries to find the a matching "parameter route"
				$routeFound = $this->_getParameterRoute($routes, $controller, $action);
			}

			// no route found, throw an exception to run the error controller
			if (!$routeFound || $controller == null || $action == null) {

				/* DEBUG */ msgToConsole ('Exception to be thrown.');

				throw new Exception('no route added for ' . $_SERVER['REQUEST_URI']);
			}
			else {
				// executes the action on the controller

				/* DEBUG */ varToConsole ('controller', $controller);
				/* DEBUG */ varToConsole ('action', $action);

				$controller->execute($action);
				// $controller->checkAction($action);
			}
		}
		catch(Exception $exception) {
			// runs the error controller

			/* DEBUG */ msgToConsole ('Exception catched.');

			$controller = new ErrorController ();
			$controller->setException ($exception);
			$controller->execute ('error');
		}

		/* DEBUG */ msgToConsole ('Leaving: Router::execute.');

	}

	/**
	 * Tests if a route has parameters
	 * @param string $route the route (uri) to test
	 * @return boolean
	 */
	public function hasParameters($route)
	{
		return preg_match('/(\/:[a-z]+)/', $route);
	}

	/**
	 * Fetches the current URI called
	 * @return string the URI called
	 */
	protected function _getUri()
	{

		/* DEBUG */ msgToConsole ('Into: Router::_getUri.');

		/* DEBUG */ varToConsole ('_SERVER[REQUEST_URI]', $_SERVER['REQUEST_URI']);

		$uri = explode('?',$_SERVER['REQUEST_URI']);

		/* DEBUG */ varToConsole ('exploded uri', $uri);

		$uri = $uri[0];

		/* DEBUG */ varToConsole ('uri[0]', $uri);

		$uri = substr($uri, strlen(WEB_ROOT));

		/* DEBUG */ varToConsole ('WEB_ROOT', WEB_ROOT);
		/* DEBUG */ varToConsole ('strlen (WEB_ROOT)', strlen(WEB_ROOT));
		/* DEBUG */ varToConsole ('substr uri', $uri);

		/* DEBUG */ msgToConsole ('Leaving: Router::_getUri.');

		return $uri;
	}

	/**
	 * Tries to find a matching simple route
	 * @param array $routes the list of routes in the system
	 * @param Controller $controller the controller to use (sent as reference)
	 * @param string $action the action to execute (sent as reference)
	 * @return boolean
	 */
	protected function _getSimpleRoute($routes, &$controller, &$action)
	{

		/* DEBUG */ msgToConsole ('Into: Router::_getSimpleRoute.');

		// fetches the URI
		$uri = $this->_getUri();

		/* DEBUG */ varToConsole ('uri', $uri);

		// if the route isn't defined, try to add a trailing slash
		if (isset($routes[$uri])) {
			$routeFound = $routes[$uri];
		}
		else if(isset($routes[$uri . '/'])) {
			$routeFound = $routes[$uri . '/'];
		}
		else {
			$uri = substr($uri, 0, -1);
			// fetches the current route
			$routeFound = isset($routes[$uri]) ? $routes[$uri] : false;
		}

		// if a matching route was found
		if ($routeFound) {
			list ($name, $action) = explode ('#', $routeFound);

			// initializes the controller
			$controller = $this->_initializeController($name);

			/* DEBUG */ varToConsole ('controller', $controller);
			/* DEBUG */ varToConsole ('name', $name);
			/* DEBUG */ varToConsole ('action', $action);
			/* DEBUG */ msgToConsole ('Leaving: Router::_getSimpleRoute.');

			return true;
		}

		return false;
	}

	/**
	 * Tries to find a matching parameter route
	 * @param array $routes the list of routes in the system
	 * @param Controller $controller the controller to use (sent as reference)
	 * @param string $action the action to execute (sent as reference)
	 * @return boolean
	 */
	protected function _getParameterRoute($routes, &$controller, &$action)
	{
		// fetches the URI
		$uri = $this->_getUri();

		// testing routes with parameters
		foreach ($routes as $route => $path) {
			if ($this->hasParameters($route)) {
				$uriParts = explode('/:', $route);

				$pattern = '/^';
				//$pattern .= '\\'.($uriParts[0] == '' ? '/' : $uriParts[0]); 
				if ($uriParts[0] == '') {
					$pattern .= '\\/';
				}
				else {
					$pattern .= str_replace('/', '\\/', $uriParts[0]);
				}

				foreach (range(1, count($uriParts)-1) as $index) {
					$pattern .= '\/([a-zA-Z0-9]+)';
				}

				// now also handles ending slashes!
				$pattern .= '[\/]{0,1}$/';

				$namedParameters = array();
				$match = preg_match($pattern, $uri, $namedParameters);
				// if the route matches
				if ($match) {
					list($name, $action) = explode('#', $path);

					// initializes the controller
					$controller = $this->_initializeController($name);

					// adds the named parameters to the controller
					foreach (range(1, count($namedParameters)-1) as $index) {
						$controller->addNamedParameter(
							$uriParts[$index],
							$namedParameters[$index]
						);
					}

					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Initializes the given controller
	 * @param string $name the name of the controller
	 * @return mixed null if error, else a controller
	 */
	protected function _initializeController($name)
	{
		/* DEBUG */ msgToConsole ('Into: Router::_initializeController.');

		// initializes the controller
		$controller = ucfirst($name) . 'Controller';
		// constructs the controller

		/* DEBUG */ varToConsole ('controller', $controller);

		/* DEBUG */ msgToConsole ('Leaving: Router::_initializeController.');

		return new $controller();
	}
}
?>
