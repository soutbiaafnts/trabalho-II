/**
 * 
 * Ao carregar a página, o JavaScript faz uma requisição AJAX para o endpoint /estados, que retorna a lista de estados em formato JSON. O JavaScript então popula o dropdown de estados com os dados recebidos.
 */
document.addEventListener('DOMContentLoaded', function() {

    //alert(BASE_URL);

    //Obtém o dropdown de estados
    const estadoSelect = document.getElementById('estado');

    //Obtem o dropdown de municípios
    const municipioSelect = document.getElementById('municipio');

    //Ao modificar o estado selecionado, faz uma requisição AJAX para obter os municípios correspondentes
    estadoSelect.addEventListener('change', function() {


        //Obtém o ID do estado selecionado
        const estadoId = this.value;

        //Limpa o dropdown de municípios
        municipioSelect.innerHTML = '<option value="">Selecione um município</option>'; 


        if (estadoId) {
            //Faz a requisição AJAX para obter os municípios do estado selecionado
            fetch(`${BASE_URL}/municipios/estado/${estadoId}`, {
    
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                    
                }

            )
                .then(response => response.json())
                .then(data => {
                    const status = data.status;
                    const municipios = data.data;

                    //console.log('Status:', status);
                    //console.log('Municípios:', municipios);

                    //Popula o dropdown de municípios com os dados recebidos
                    for (const municipio of municipios) {
                        const option = document.createElement('option');
                        option.value = municipio.id;
                        option.textContent = municipio.nome;
                        municipioSelect.appendChild(option);
                    }
                    
                })
                .catch(error => console.error('Erro ao carregar municípios:', error));

        }

    });

});