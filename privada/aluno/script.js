
function filtrarCursos() {
    const termoPesquisa = document.getElementById("searchInput").value.toLowerCase();
    const cursos = document.querySelectorAll(".card");

    cursos.forEach((curso) => {
        const tituloCurso = curso.querySelector(".card-title").textContent.toLowerCase();
        if (tituloCurso.includes(termoPesquisa)) {
            curso.style.display = "block";
        } else {
            curso.style.display = "none";
        }
    });
}

function limparCampoPesquisa() {
    document.getElementById("searchInput").value = "";
}
