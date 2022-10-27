const search = () => {
    const search = document.getElementById("product").value;
    if (search.trim().length <= 0) {
        alert("Entre com o nome de um produto.");
        return false;
    }
    else return true;
}