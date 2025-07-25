<button 
    name="btnAtualizacaoCadastro"
    id="btnAtualizacaoSucesso"
    class="w3-button w3-block w3-margin w3-green w3-cell w3-round-large" 
    style="width: 90%; padding: 12px;"
    onclick="mostrarFeedbackAtualizacao()"
    title="Confirmação de atualização dos dados">
    <i class="fa fa-check-circle"></i> Atualização Concluída com Sucesso!
</button>

<script>
function mostrarFeedbackAtualizacao() {

    console.log("Redirecionando para área restrita...");
    
 
    setTimeout(() => {
        const btn = document.getElementById('btnAtualizacaoSucesso');
        if(btn) btn.style.opacity = '0';
    }, 2500);
}
</script>
