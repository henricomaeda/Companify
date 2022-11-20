// Campo de pesquisa.
const search = () => {
    const search = document.getElementById("product").value;
    if (search.trim().length <= 0) {
        alert("Entre com o nome de um produto.");
        return false;
    }
    else return true;
}

// Rolagem para o topo.
const scrollToTop = () => {
	// Para o navegador Safari.
	document.body.scrollTop = 0;
	
	// Para os navegadores Chrome, Firefox, IE e Opera.
	document.documentElement.scrollTop = 0;
}

window.onscroll = function() {scrollDisplay()};
const scrollDisplay = () => {
	const scrollView = document.body.scrollTop >= 20 || document.documentElement.scrollTop >= 20;
	const scrollButton = document.getElementById("scrollButton");
	
	if (scrollView) {
		scrollButton.style.opacity = 0.92;
		scrollButton.style.visibility = "visible";
	}
	else {
		scrollButton.style.opacity = 0;
		scrollButton.style.visibility = "hidden";
	}
}