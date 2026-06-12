document.addEventListener('DOMContentLoaded', function() {

    const estadoSelect = document.getElementById('estado');

    const municipioSelect = document.getElementById('municipio');

    function carregarMunicipios(estadoId, selectedMunicipioId = null) {
        municipioSelect.innerHTML = '<option value="">Selecione um município</option>';

        if (!estadoId) return;

        fetch(`${BASE_URL}/municipios/estado/${estadoId}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => response.json())
            .then(data => {
                for (const municipio of data.data) { 
                    const option = document.createElement('option');
                    option.value = municipio.id;
                    option.textContent = municipio.nome;

                    if (selectedMunicipioId && municipio.id == selectedMunicipioId) {
                        option.selected = true;
                    }

                    municipioSelect.appendChild(option);
                }
            })
            .catch(error => console.error('Erro ao carregar municípios:', error));
    }


    estadoSelect.addEventListener('change', function() {

        carregarMunicipios(this.value);

    });

    if (OLD_ESTADO_ID) { 
        carregarMunicipios(OLD_ESTADO_ID, OLD_MUNICIPIO_ID);
    }

});