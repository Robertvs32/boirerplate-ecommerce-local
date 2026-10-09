const WHATSAPP_NUMERO = '5511999999999';

/* ---------------- CARRINHO EM sessionStorage ---------------- */
function getCarrinho(){
  return JSON.parse(sessionStorage.getItem('carrinho') || '[]');
}
function salvarCarrinho(carrinho){
  sessionStorage.setItem('carrinho', JSON.stringify(carrinho));
  atualizarBadge();
}
function atualizarBadge(){
  const carrinho = getCarrinho();
  const total = carrinho.reduce((s, i) => s + i.quantidade, 0);
  const badge = document.getElementById('badge-carrinho');
  badge.textContent = total;
  badge.style.display = total > 0 ? 'flex' : 'none';
}
function formatarPreco(v){
  return 'R$ ' + v.toFixed(2).replace('.', ',');
}

/* ---------------- FILTROS (MOBILE) ---------------- */
function toggleFiltros(){
  document.getElementById('filtros').classList.toggle('ativo');
}

/* ---------------- MODAL ADICIONAR AO CARRINHO ---------------- */
let produtoModalAtual = null;

function abrirModalAdicionar(botao){
  produtoModalAtual = {
    id: botao.dataset.id,
    titulo: botao.dataset.titulo,
    valor: parseFloat(botao.dataset.valor),
    imagem: botao.dataset.imagem
  };
  document.getElementById('modal-imagem').src = produtoModalAtual.imagem;
  document.getElementById('modal-titulo').textContent = produtoModalAtual.titulo;
  document.getElementById('modal-preco').textContent = formatarPreco(produtoModalAtual.valor);
  document.getElementById('modal-quantidade').textContent = '1';
  document.getElementById('modal-overlay').classList.add('ativo');
}
function fecharModal(){
  document.getElementById('modal-overlay').classList.remove('ativo');
  produtoModalAtual = null;
}
function alterarQuantidadeModal(delta){
  const el = document.getElementById('modal-quantidade');
  let q = parseInt(el.textContent, 10) + delta;
  if (q < 1) q = 1;
  el.textContent = q;
}
function confirmarAdicionar(){
  if (!produtoModalAtual) return;
  const qtd = parseInt(document.getElementById('modal-quantidade').textContent, 10);
  const carrinho = getCarrinho();
  const existente = carrinho.find(i => i.id === produtoModalAtual.id);
  if (existente) {
    existente.quantidade += qtd;
  } else {
    carrinho.push({ ...produtoModalAtual, quantidade: qtd });
  }
  salvarCarrinho(carrinho);
  fecharModal();
}

/* ---------------- CARRINHO (DRAWER) ---------------- */
function abrirCarrinho(){
  renderizarCarrinho();
  document.getElementById('carrinho-drawer').classList.add('ativo');
  document.getElementById('overlay-fundo').classList.add('ativo');
}
function fecharCarrinho(){
  document.getElementById('carrinho-drawer').classList.remove('ativo');
  document.getElementById('overlay-fundo').classList.remove('ativo');
}
function renderizarCarrinho(){
  const carrinho = getCarrinho();
  const lista = document.getElementById('lista-carrinho');
  lista.innerHTML = '';
  let total = 0;

  if (carrinho.length === 0){
    lista.innerHTML = '<p class="carrinho-vazio">Seu carrinho está vazio.</p>';
  } else {
    carrinho.forEach((item, idx) => {
      total += item.valor * item.quantidade;
      const div = document.createElement('div');
      div.className = 'item-carrinho';
      div.innerHTML = `
        <img src="${item.imagem}" alt="">
        <div class="item-info">
          <strong>${item.titulo}</strong>
          <span>${formatarPreco(item.valor)} / un</span>
          <div class="qtd-controle">
            <button onclick="alterarQuantidadeCarrinho(${idx}, -1)">-</button>
            <span>${item.quantidade}</span>
            <button onclick="alterarQuantidadeCarrinho(${idx}, 1)">+</button>
            <button class="btn-remover" onclick="removerItemCarrinho(${idx})">🗑</button>
          </div>
        </div>`;
      lista.appendChild(div);
    });
  }
  document.getElementById('total-carrinho').textContent = formatarPreco(total);
}
function alterarQuantidadeCarrinho(idx, delta){
  const carrinho = getCarrinho();
  carrinho[idx].quantidade += delta;
  if (carrinho[idx].quantidade <= 0) carrinho.splice(idx, 1);
  salvarCarrinho(carrinho);
  renderizarCarrinho();
}
function removerItemCarrinho(idx){
  const carrinho = getCarrinho();
  carrinho.splice(idx, 1);
  salvarCarrinho(carrinho);
  renderizarCarrinho();
}

/* ---------------- ENVIO DO PEDIDO PARA O WHATSAPP ---------------- */
function enviarPedidoWhatsapp(){
  const carrinho = getCarrinho();
  if (carrinho.length === 0){
    alert('Seu carrinho está vazio.');
    return;
  }
  let texto = 'Olá! Gostaria de fazer o seguinte pedido:%0A%0A';
  let total = 0;
  carrinho.forEach(item => {
    const subtotal = item.valor * item.quantidade;
    total += subtotal;
    texto += `${item.quantidade}x ${item.titulo} - ${formatarPreco(subtotal)}%0A`;
  });
  texto += `%0ATotal: ${formatarPreco(total)}`;
  window.open(`https://wa.me/${WHATSAPP_NUMERO}?text=${texto}`, '_blank');
}

document.addEventListener('DOMContentLoaded', atualizarBadge);