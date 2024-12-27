document.getElementById('invitationForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const movie = document.getElementById('movie').value;
    const date = document.getElementById('date').value;

    // Aquí podrías guardar la información si es necesario, pero para este ejemplo solo redirigimos.
    
    // Redirigir a la página de confirmación
    window.location.href = 'confirmacion.html';
});
