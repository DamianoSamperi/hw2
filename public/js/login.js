function MostraRicerca(event){
    const form=document.querySelector("form");
    form.classList.remove("Hidden");
    event.currentTarget.addEventListener("click",NascondiRicerca);
    event.currentTarget.removeEventListener("click",MostraRicerca);
}
function NascondiRicerca(event){
    const Ricerca=document.querySelector("form");
    Ricerca.classList.add("Hidden");
    event.currentTarget.removeEventListener("click",NascondiRicerca);
    event.currentTarget.addEventListener("click",MostraRicerca);
}
function OnResponse(response){
 return response.json();
}

const Cerca = document.querySelector('a.button');
Cerca.addEventListener("click",MostraRicerca);