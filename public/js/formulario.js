document.addEventListener('DOMContentLoaded', function() {
    const selectorRuta = document.getElementById('ruta_selector');
    const tbodyColonias = document.getElementById('tabla_colonias_body');

    // --- 1. LA FUNCIÓN MATEMÁTICA ---
    function calcularEstadisticas() {
        // Buscamos todos los inputs que tengan la clase 'input-porcentaje'
        const inputs = document.querySelectorAll('.input-porcentaje');
        
        let suma = 0;
        let cantidad = inputs.length;

        // Sumamos los valores de todos los inputs
        inputs.forEach(input => {
            let valor = parseFloat(input.value) || 0;
            suma += valor;
        });

        // Operación: Suma / Cantidad (evitando dividir entre cero)
        let cobertura = cantidad > 0 ? (suma / cantidad) : 0;

        // Inyectamos los resultados en el HTML (verificando que existan)
        if (document.getElementById('calc_suma')) {
            document.getElementById('calc_suma').value = suma;
            document.getElementById('calc_cantidad').value = cantidad;
            document.getElementById('calc_cobertura').value = cobertura.toFixed(1) + '%'; 
        }
    }

    // --- 2. DELEGACIÓN DE EVENTOS (El motor en tiempo real) ---
    // La tabla escucha CUALQUIER cambio en los inputs que se generen dinámicamente
    if (tbodyColonias) {
        tbodyColonias.addEventListener('input', function(event) {
            if (event.target.classList.contains('input-porcentaje')) {
                // Limitamos visual y lógicamente entre 0 y 100
                let valor = parseFloat(event.target.value);
                if (valor > 100) event.target.value = 100;
                if (valor < 0) event.target.value = 0;
                
                // Forzamos el recalculo
                calcularEstadisticas();
            }
        });
    }

    // --- 3. LA LLAMADA A LA API DE COLONIAS ---
    if (selectorRuta && tbodyColonias) {
        selectorRuta.addEventListener('change', function() {
            const rutaId = this.value;
            
            tbodyColonias.innerHTML = '<tr><td colspan="4" class="px-6 py-8 text-center text-brand-600 animate-pulse">Consultando colonias...</td></tr>';

            fetch(`/api/rutas/${rutaId}/colonias`)
                .then(response => response.json())
                .then(colonias => {
                    tbodyColonias.innerHTML = ''; 

                    if (colonias.length === 0) {
                        tbodyColonias.innerHTML = '<tr><td colspan="4" class="px-6 py-8 text-center text-amber-500 italic">Esta ruta no tiene colonias asignadas.</td></tr>';
                        calcularEstadisticas(); // Resetea a 0
                        return;
                    }

                    // Construimos las filas (Nota: ya no usamos oninput aquí)
                    colonias.forEach(colonia => {
                        const fila = `
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm text-slate-400">#${colonia.id}</td>
                                <td class="px-6 py-4 text-sm font-bold text-slate-700 uppercase">${colonia.nombre}</td>
                                <td class="px-6 py-4 text-sm text-slate-500">${colonia.habitantes || 0}</td>
                                <td class="px-6 py-4">
                                    <div class="relative w-24">
                                        <input type="number" name="colonias[${colonia.id}][porcentaje]" 
                                            min="0" max="100" value="100" required
                                            class="input-porcentaje w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm font-bold text-right pr-7 focus:border-brand-500 outline-none transition-all">
                                        <span class="absolute inset-y-0 right-2 flex items-center text-slate-400 text-xs">%</span>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tbodyColonias.insertAdjacentHTML('beforeend', fila);
                    });

                    // Calculamos automáticamente al cargar la tabla (para que muestre el 100% inicial)
                    calcularEstadisticas();
                });
        });
    }
    
    // --- 4. FILTRADO DE UNIDADES ---
    const selectorTipo = document.getElementById('tipo_unidad_selector');
    const selectorUnidad = document.getElementById('unidad_selector');

    if (selectorTipo && selectorUnidad) {
        selectorTipo.addEventListener('change', function() {
            // Obtenemos el VALUE (que es el ID) y no el texto
            const tipoId = this.value; 
            
            // Efecto visual de carga
            selectorUnidad.disabled = false;
            selectorUnidad.classList.remove('bg-gray-100', 'text-slate-400', 'cursor-not-allowed');
            selectorUnidad.classList.add('bg-gray-50', 'text-slate-700', 'cursor-pointer');
            selectorUnidad.innerHTML = '<option value="" disabled selected>Buscando unidades...</option>';

            // Petición filtrando por ID
            fetch(`/api/tipos-unidades/${tipoId}/unidades`)
                .then(response => response.json())
                .then(unidades => {
                    selectorUnidad.innerHTML = '<option value="" disabled selected>Seleccionar unidad...</option>';
                    
                    if (unidades.length === 0) {
                        // Si no hay, bloqueamos de nuevo con un mensaje claro
                        selectorUnidad.innerHTML = '<option value="" disabled selected>Sin unidades registradas</option>';
                        selectorUnidad.disabled = true;
                        selectorUnidad.classList.add('bg-red-50', 'text-red-400');
                        return;
                    }

                    // Si hay unidades, las inyectamos
                    unidades.forEach(unidad => {
                        const option = document.createElement('option');
                        option.value = unidad.id;
                        // Mostramos el Número (Económico) para que el chofer lo identifique
                        option.textContent = `No. ${unidad.numero} - ${unidad.nombre || ''}`;
                        selectorUnidad.appendChild(option);
                    });
                });
        });
    }

    // --- 5. AUTOMATIZACIÓN DE KILOMETRAJE Y COMBUSTIBLE ---
    
    // Referencias a los inputs de KM
    const kmSalir = document.getElementById('km_salir');
    const kmRegresar = document.getElementById('km_regresar');
    const kmRecorridos = document.getElementById('km_recorridos');

    // Referencias a los inputs de Diésel
    const dInicial = document.getElementById('diesel_inicial');
    const dCargado = document.getElementById('diesel_cargado');
    const dFinal = document.getElementById('diesel_final');
    const dConsumido = document.getElementById('diesel_consumido');

    // Función: Calcular Kilómetros
    function calcularKm() {
        let salir = parseFloat(kmSalir.value) || 0;
        let regresar = parseFloat(kmRegresar.value) || 0;
        
        // La matemática: Regreso - Salida. (Si el regreso es menor, evitamos números negativos)
        let recorridos = regresar > salir ? (regresar - salir) : 0;
        
        kmRecorridos.value = recorridos;
    }

    // Función: Calcular Diésel Consumido
    function calcularDiesel() {
        let inicial = parseFloat(dInicial.value) || 0;
        let cargado = parseFloat(dCargado.value) || 0;
        let final = parseFloat(dFinal.value) || 0;
        
        // La matemática: (Lo que tenía + Lo que le puse) - Lo que le sobró
        let consumido = (inicial + cargado) - final;
        
        // Evitamos números negativos si aún no llenan todos los campos
        if(consumido < 0) consumido = 0; 
        
        dConsumido.value = consumido.toFixed(1);
    }

    // Asignamos los "escuchadores" a los inputs para que calculen al escribir
    if(kmSalir) kmSalir.addEventListener('input', calcularKm);
    if(kmRegresar) kmRegresar.addEventListener('input', calcularKm);
    
    if(dInicial) dInicial.addEventListener('input', calcularDiesel);
    if(dCargado) dCargado.addEventListener('input', calcularDiesel);
    if(dFinal) dFinal.addEventListener('input', calcularDiesel);
});