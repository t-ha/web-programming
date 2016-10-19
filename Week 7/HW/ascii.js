"use strict";
// Timothy Ha
// 05.21.14
// CSE 154 AP
// Jiaming Li
// Assignment #7: ASCIImation

(function() {
	// start up the set controls when the page opens
	// initialize variables for timer, the animation, current frame,
	// delay, and if animation is in progress
	window.onload = setControls;
	var timer;
	var ani;
	var current;
	var delay;
	var playing = 0;

	// enables the stop button, disables the start button and animation list
	// and processes the information
	// in the textarea for animation and animates with the set
	// delay and size
	function animate() {
		disable(false);
		playing = 1;
		ani = document.getElementById("textbox").value;
		ani = ani.split("=====\n");
		current = 0;
		setDelay();
		timer = setInterval(runAnimation, delay, playing);
	}

	// selects the animation to be shown in the textarea
	function selectAnimation() {
		document.getElementById("textbox").value = ANIMATIONS[this.value];
	}

	// changes the font size of the animation displayed in textarea
	function changeFSize() {
		var text = document.getElementById("textbox");
		text.style.fontSize = this.value;
	}

	// changes the delay of the animation if it is playing
	function changeDelay() {
		if (playing == 1) {
			delay = parseInt(this.value, 10);
			clearInterval(timer);
			timer = setInterval(runAnimation, delay, playing);
		}
	}

	// actually runs the animation, frame by frame and changes the delay if the animation
	// is playing and if a different animation is clicked
	function runAnimation() {
		if (playing == 1) {
			document.getElementById("turbo").onclick = changeDelay;
			document.getElementById("normal").onclick = changeDelay;
			document.getElementById("slo").onclick = changeDelay;
		}
		document.getElementById("textbox").value = ani[current];
		current = (current + 1) % ani.length;
	}

	// sets the initial size and animation and disables the stop button
	function setControls() {
		document.getElementById("size").onchange = changeFSize;
		document.getElementById("animation").onchange = selectAnimation;
		document.getElementById("start").onclick = animate;
		document.getElementById("stop").disabled = true;
		document.getElementById("stop").onclick = stopAnimation;
	}

	// sets the initial delay before animation begins
	function setDelay() {
		var turbo = document.getElementById("turbo");
		var normal = document.getElementById("normal");
		var slo = document.getElementById("slo");
		var speed;
		if (turbo.checked) {
			speed = turbo;
		} else if (normal.checked) {
			speed = normal;
		} else {
			speed = slo;
		}
		delay = parseInt(speed.value, 10);
	}

	// stops all animation progress and goes back to the original text
	// disables the stop button
	function stopAnimation() {
		clearInterval(timer);
		disable(true);
		playing = 0;
		document.getElementById("textbox").value = ANIMATIONS[document.getElementById("animation").value];
	}

	// either disables the stop button and enables the start button
	// and enables the animation dropdown list
	// or does the reverse
	function disable(disabled) {
		document.getElementById("stop").disabled = disabled;
		document.getElementById("start").disabled = !disabled;
		document.getElementById("animation").disabled = !disabled;
	}
})();

