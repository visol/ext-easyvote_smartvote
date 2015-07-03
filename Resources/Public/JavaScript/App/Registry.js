/*jshint esnext:true */

/*
 * This file is part of the TYPO3 CMS project.
 *
 * See LICENSE.txt that was shipped with this package.
 */

export default class Registry {

	/**
	 * @return {Object}
	 */
	static get(name) {

		return Registry.instances[name];
	}

	/**
	 * @return void
	 */
	static set(name, object) {
		if (!Registry.instances) {
			Registry.instances = {};
		}
		Registry.instances[name] = object;
	}

}
