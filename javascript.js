// Mensagem para o usuário.
const hideMessage = () => {
	const message = document.getElementById("message");
	message.style.bottom = "-20%";
	message.style.opacity = "0%";
}

// Rolagem para o topo.
const scrollToTop = () => {
	// Para o navegador Safari.
	document.body.scrollTop = 0;
	
	// Google Chrome | Firefox | IE | Opera.
	document.documentElement.scrollTop = 0;
}

window.onscroll = function() {scrollDisplay()};
const scrollDisplay = () => {
	const scrollView = document.body.scrollTop >= 30 || document.documentElement.scrollTop >= 30;
	const scrollButton = document.getElementById("scrollButton");
	
	if (scrollView) scrollButton.style.visibility = "visible";
	else scrollButton.style.visibility = "hidden";
}

// Marcado como sem sobrenome.	
const noLastname = () => {
	if (document.getElementById("checkbox").checked == true) {
		document.getElementById("lastname").required = false;
		document.getElementById("lastname").readOnly = true;
	}
	else {
		document.getElementById("lastname").required = true;
		document.getElementById("lastname").readOnly = false;
	}
}