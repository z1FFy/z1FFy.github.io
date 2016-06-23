/**
 * customzr.js Library
 *
 * by @z1web
 */

customzr = {};
customzr.state = 'inactive';
customzr.run = function () {
		customzr.state = 'active';
}

$(document).ready(function () {
	customzr.run();
	console.log(customzr.state);
});