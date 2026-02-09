<?php
/**
 * Register all actions and filters for the plugin.
 *
 * @package PWMP_Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Pwmp_Loader
 */
class Pwmp_Loader {

	/**
	 * Array of actions.
	 *
	 * @var array
	 */
	protected $actions = array();

	/**
	 * Array of filters.
	 *
	 * @var array
	 */
	protected $filters = array();

	/**
	 * Add an action.
	 *
	 * @param string $hook     WordPress hook name.
	 * @param object $component Reference to the component instance.
	 * @param string $callback  Callback method name.
	 * @param int    $priority  Priority. Default 10.
	 * @param int    $accepted_args Number of arguments. Default 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a filter.
	 *
	 * @param string $hook     WordPress hook name.
	 * @param object $component Reference to the component instance.
	 * @param string $callback  Callback method name.
	 * @param int    $priority  Priority. Default 10.
	 * @param int    $accepted_args Number of arguments. Default 1.
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add hook to the collection.
	 *
	 * @param array  $hooks         Collection of hooks.
	 * @param string $hook          Hook name.
	 * @param object $component     Component instance.
	 * @param string $callback      Callback.
	 * @param int    $priority      Priority.
	 * @param int    $accepted_args Accepted arguments.
	 * @return array
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {
		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args,
		);
		return $hooks;
	}

	/**
	 * Register all hooks with WordPress.
	 */
	public function run() {
		foreach ( $this->filters as $hook ) {
			add_filter(
				$hook['hook'],
				array( $hook['component'], $hook['callback'] ),
				$hook['priority'],
				$hook['accepted_args']
			);
		}

		foreach ( $this->actions as $hook ) {
			add_action(
				$hook['hook'],
				array( $hook['component'], $hook['callback'] ),
				$hook['priority'],
				$hook['accepted_args']
			);
		}
	}
}
