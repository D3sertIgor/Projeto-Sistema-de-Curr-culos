<button 
    name="btnInfInserir"
    class="w3-button w3-block w3-margin w3-green w3-cell w3-round-large" 
    style="width: 90%; padding: 12px;">
    <i class="fa fa-check-circle"></i> Inclusão Realizada com Sucesso!
</button>
<script>

document.querySelector('[name="btnInfInserir"]').addEventListener('click', function() {
    this.style.transition = 'opacity 0.5s';
    this.style.opacity = '0';
    setTimeout(() => this.remove(), 500);
});
</script>