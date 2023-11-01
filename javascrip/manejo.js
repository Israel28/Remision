// Carga el archivo JSON
fetch('data.json')
    .then(response => response.json())
    .then(data => {
        // Muestra los datos existentes en la lista
        const dataList = document.getElementById('dataList');
        data.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `Código: ${item.Codigo}, Cajas: ${item.cajas}, Piezas: ${item.piezas}`;
            dataList.appendChild(li);
        });

        // Maneja el envío del formulario para agregar nuevos datos
        const form = document.getElementById('dataForm');
        form.addEventListener('submit', e => {
            e.preventDefault();
            const codigo = document.getElementById('codigo').value;
            const cajas = document.getElementById('cajas').value;
            const piezas = document.getElementById('piezas').value;
            // Agrega los nuevos datos al archivo JSON
            data.push({ Codigo: codigo, cajas: parseInt(cajas), piezas: parseInt(piezas) });
            // Actualiza la lista en la página
            const li = document.createElement('li');
            li.textContent = `Código: ${codigo}, Cajas: ${cajas}, Piezas: ${piezas}`;
            dataList.appendChild(li);
            // Limpia los campos del formulario
            form.reset();
        });
    });
