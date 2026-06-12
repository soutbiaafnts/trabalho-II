function confirma (){
    var resposta = confirm("Deseja realmente excluir este cliente?");
    if (resposta == true) {
        return true;
    } else {
        return false;
    }
}