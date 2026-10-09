<!-- ===================== MODAL ADICIONAR AO CARRINHO ===================== -->
<div id="modal-overlay">
  <div class="modal-caixa">
    <img id="modal-imagem" src="" alt="">
    <h3 id="modal-titulo"></h3>
    <div class="preco-modal" id="modal-preco"></div>
    <div class="qtd-controle-modal">
      <button onclick="alterarQuantidadeModal(-1)">-</button>
      <span id="modal-quantidade">1</span>
      <button onclick="alterarQuantidadeModal(1)">+</button>
    </div>
    <div class="modal-botoes">
      <button class="btn-cancelar" onclick="fecharModal()">CANCELAR</button>
      <button class="btn-confirmar" onclick="confirmarAdicionar()">ADICIONAR</button>
    </div>
  </div>
</div>