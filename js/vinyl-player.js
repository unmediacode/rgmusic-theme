/**
 * Vinyl Player - Audio Controller
 * Reproduce audio al hacer hover sobre el cover del vinilo
 */

document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los reproductores de vinilo
    const vinylPlayers = document.querySelectorAll('.vinyl-player');
    let audioInitialized = false;
    
    vinylPlayers.forEach(function(player) {
        const audioUrl = player.getAttribute('data-audio');
        const cover = player.querySelector('.vinyl-cover');
        
        // Validar que existe URL de audio y cover
        if (!audioUrl || !cover) {
            console.warn('Vinyl player sin audio o cover:', player);
            return;
        }
        
        // Crear elemento de audio
        const audio = new Audio(audioUrl);
        audio.loop = false; // Cambiar a true si quieres que se repita
        audio.volume = 0.7; // Volumen al 70%
        
        // Función para inicializar el audio con la primera interacción
        function initAudio() {
            if (!audioInitialized) {
                audio.load(); // Precargar el audio
                audioInitialized = true;
                // Remover los listeners de inicialización
                document.removeEventListener('click', initAudio);
                document.removeEventListener('touchstart', initAudio);
                document.removeEventListener('keydown', initAudio);
            }
        }
        
        // Escuchar la primera interacción del usuario
        document.addEventListener('click', initAudio, { once: true });
        document.addEventListener('touchstart', initAudio, { once: true });
        document.addEventListener('keydown', initAudio, { once: true });
        
        // Evento: Reproducir al pasar el ratón
        cover.addEventListener('mouseenter', function() {
            audio.currentTime = 0; // Reiniciar desde el principio
            audio.play().catch(function(error) {
                // Si falla, intentar inicializar
                if (!audioInitialized) {
                    initAudio();
                }
            });
        });
        
        // Evento: Pausar al quitar el ratón
        cover.addEventListener('mouseleave', function() {
            audio.pause();
        });
    });
});
