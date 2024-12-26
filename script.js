document.getElementById('invitationForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const movie = document.getElementById('movie').value;
    const date = document.getElementById('date').value;

    alert(`¡Hola! Te invito a ver "${movie}" el ${date} en el Cine Plaza Central. ¡Espero que puedas venir!`);
});