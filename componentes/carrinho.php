<!-- ===================== CARRINHO (DRAWER) ===================== -->
<div id="carrinho-drawer">
  <div class="cabecalho-carrinho">
    <h2>CARRINHO</h2>
    <button class="fechar-x" onclick="fecharCarrinho()">✕</button>
  </div>
  <div id="lista-carrinho"></div>
  <div class="rodape-carrinho">
    <div class="linha-total">
      <span>TOTAL:</span>
      <span id="total-carrinho">R$ 0,00</span>
    </div>
    <button class="btn-whatsapp" onclick="enviarPedidoWhatsapp()">ENVIAR PEDIDO POR WHATSAPP</button>
    <button class="btn-cancelar-carrinho" onclick="fecharCarrinho()">CANCELAR</button>
  </div>
</div>