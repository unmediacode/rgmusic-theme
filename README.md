# 🎵 Tema Hijo YOOtheme RGMUSIC

Tema hijo de YOOtheme Pro con reproductor de vinilo giratorio y sistema de personalización mediante variables CSS.

---

## 📦 Instalación

1. **Sube el tema** a `/wp-content/themes/yootheme-rgmusic/`
2. **Activa el tema** desde WordPress → Apariencia → Temas
3. **Asegúrate** de tener YOOtheme Pro instalado y activado

---

## 🎨 Personalización de Colores y Tipografías

Todos los estilos se personalizan editando las **variables CSS** en `/css/custom.css` (líneas 14-45).

### Cambiar Colores

```css
:root {
    --pareli-primary: #ff00c1;      /* Color principal */
    --pareli-secondary: #00fff9;    /* Color secundario */
    --pareli-dark: #000000;         /* Negro */
    --pareli-light: #ffffff;        /* Blanco */
    --pareli-gray: #666666;         /* Gris */
}
```

### Cambiar Tipografías

```css
:root {
    --pareli-font-body: 'Inter', sans-serif;      /* Fuente del texto */
    --pareli-font-heading: 'Poppins', sans-serif; /* Fuente de títulos */
}
```

### Cambiar Tamaños de Fuente

```css
:root {
    --pareli-font-size-base: 16px;
    --pareli-font-size-h1: 48px;
    --pareli-font-size-h2: 36px;
    --pareli-font-size-h3: 28px;
}
```

---

## 🎵 Reproductor de Vinilo

### Cómo usar en el Builder de YOOtheme

1. **Añade un elemento HTML** en el Builder
2. **Pega este código:**

```html
<div class="vinyl-player" data-audio="URL_DE_TU_AUDIO.mp3">
    <img src="URL_DEL_COVER.png" class="vinyl-cover" alt="Cover">
    <img src="URL_DEL_VINILO.png" class="vinyl-disc" alt="Vinyl">
</div>
```

3. **Reemplaza las URLs:**
   - `URL_DE_TU_AUDIO.mp3` → URL de tu archivo de audio
   - `URL_DEL_COVER.png` → URL de tu imagen de cover
   - `URL_DEL_VINILO.png` → URL de tu imagen de vinilo

### Características

- ✅ **Vinilo gira constantemente** en loop
- ✅ **Audio se reproduce al pasar el ratón** por el cover
- ✅ **Audio se pausa al quitar el ratón**
- ✅ **Responsive** - Se adapta a móviles y tablets
- ✅ **JavaScript vanilla** - Sin dependencias externas

### Personalizar el Reproductor

Edita `/css/custom.css` líneas 105-150:

**Cambiar tamaño:**
```css
.vinyl-player {
    width: 400px;   /* Cambia el tamaño */
    height: 400px;
}
```

**Cambiar velocidad de rotación:**
```css
animation: spin-always 3s linear infinite;
/* 3s = 3 segundos por vuelta
   2s = más rápido
   5s = más lento */
```

**Cambiar posición del vinilo:**
```css
transform: translate(-25%, -50%);
/* -25% = posición horizontal
   Más negativo = más a la izquierda
   Menos negativo = más a la derecha */
```

---

## 📁 Estructura de Archivos

```
yootheme-pareli/
├── style.css           # Identificación del tema
├── functions.php       # Carga de estilos
├── css/
│   └── custom.css      # Estilos personalizados
├── js/
│   └── (vacío)         # Para futuros scripts
└── README.md           # Esta guía
```

---

## 🎯 Características del Tema

### ✅ Incluido
- Sistema de variables CSS para personalización fácil
- Reproductor de vinilo giratorio
- Estilos responsive
- Tipografías personalizables
- Colores personalizables
- Botones con gradientes

### ❌ No incluido
- Librerías JavaScript externas
- Preloader de carga
- Efectos glitch
- WaveSurfer.js
- Howler.js

---

## 🔧 Añadir Funcionalidades Adicionales

Si necesitas añadir JavaScript personalizado:

1. Crea un archivo en `/js/custom.js`
2. Añade en `functions.php`:

```php
wp_enqueue_script(
    'pareli-custom-js',
    get_stylesheet_directory_uri() . '/js/custom.js',
    ['jquery'],
    wp_get_theme()->get('Version'),
    true
);
```

---

## 📝 Notas Importantes

1. **No edites el tema padre** - Todos los cambios deben hacerse en este tema hijo
2. **Usa variables CSS** - Facilita el mantenimiento y los cambios futuros
3. **Prueba en diferentes dispositivos** - El tema es responsive pero verifica siempre
4. **Haz copias de seguridad** - Antes de hacer cambios importantes

---

## 🆘 Soporte

Para dudas o problemas:
- Revisa que YOOtheme Pro esté actualizado
- Verifica que las URLs de audio e imágenes sean correctas
- Limpia la caché del navegador con Ctrl+Shift+R

---

## 📄 Licencia

GPL v2 or later
