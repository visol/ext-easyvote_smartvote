"use strict";

import ListView from './Views/Party/ListView';
import EnvironmentChecker from './EnvironmentChecker.js'

$(() => {

	var environment = new EnvironmentChecker();
	var isOk = environment.isLocalStorageAvailable() && environment.isLocalStorageReady();

	if (isOk) {
		new ListView();
	}
});