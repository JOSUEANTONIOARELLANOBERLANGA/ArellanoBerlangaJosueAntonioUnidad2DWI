<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Planes Profesionales - JaabWeb</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<style>
  *, *::before, *::after {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: #121b2b;
    color: #e1e8f0;
    min-height: 100vh;
    overflow-x: hidden;
  }
  nav {
    position: sticky;
    top: 0;
    background: #172a45dd;
    backdrop-filter: saturate(180%) blur(12px);
    padding: 1rem 3rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 12px rgb(0 0 0 / 0.6);
    z-index: 9999;
    transition: background-color 0.4s ease;
  }
  nav.scrolled {
    background: #172a45ff;
    box-shadow: 0 4px 24px rgb(0 0 0 / 0.85);
  }
  .logo {
    font-weight: 700;
    font-size: 1.6rem;
    letter-spacing: 0.12rem;
    color: #4fc3f7;
    cursor: pointer;
    user-select: none;
    transition: color 0.3s ease;
  }
  .logo:hover, .logo:focus {
    color: #90caf9;
    outline: none;
  }
  nav ul {
    list-style: none;
    display: flex;
    gap: 2rem;
    margin: 0;
    padding: 0;
  }
  nav ul li a {
    color: #cfd8dc;
    font-weight: 600;
    text-decoration: none;
    font-size: 1rem;
    position: relative;
  }
  nav ul li a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -5px;
    left: 0;
    background-color: #4fc3f7;
    transition: width 0.3s ease;
  }
  nav ul li a:hover::after,
  nav ul li a:focus::after {
    width: 100%;
  }
  .cart-btn {
    background: #4fc3f7;
    border: none;
    border-radius: 30px;
    padding: 0.6rem 1.2rem;
    font-weight: 700;
    cursor: pointer;
    color: #0d1a2b;
    box-shadow: 0 6px 14px rgba(79, 195, 247, 0.6);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    user-select: none;
  }
  .cart-btn:hover,
  .cart-btn:focus {
    background: #71c4ff;
    box-shadow: 0 10px 22px rgba(79, 195, 247, 0.9);
    outline: none;
  }

  section#planes {
    max-width: 1100px;
    margin: 4rem auto 6rem;
    padding: 0 1rem;
  }
  .swiper {
    padding-bottom: 3.5rem;
  }
  .swiper-wrapper {
    align-items: stretch !important;
  }
  .swiper-slide {
    background: linear-gradient(135deg, #1e2c43, #142235);
    border-radius: 18px;
    padding: 2.5rem 2rem 3rem;
    box-shadow: 0 6px 18px rgba(79, 195, 247, 0.3), inset 0 0 10px rgba(79, 195, 247, 0.2);
    color: #e1e8f0;
    user-select: none;
    transition: box-shadow 0.4s ease, transform 0.4s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 560px;
  }
  .swiper-slide:hover,
  .swiper-slide:focus-within {
    box-shadow: 0 18px 38px rgba(79, 195, 247, 0.7), inset 0 0 20px rgba(79, 195, 247, 0.35);
    transform: translateY(-6px);
    outline: none;
  }
  .plan-title {
    font-weight: 700;
    font-size: 1.9rem;
    color: #4fc3f7;
    margin-bottom: 0.5rem;
    letter-spacing: 0.04rem;
    text-shadow: 0 0 6px rgba(79, 195, 247, 0.5);
  }
  .plan-price {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1.3rem;
    color: #82c7ff;
    letter-spacing: 0.06rem;
    text-shadow: 0 0 10px rgba(130, 199, 255, 0.6);
  }
  .plan-desc {
    font-size: 1.1rem;
    font-style: italic;
    margin-bottom: 1.8rem;
    color: #b0bec5;
  }
  .features {
    list-style: none;
    padding: 0;
    margin: 0 0 2.2rem;
    text-align: left;
    flex-grow: 1;
  }
  .features li {
    position: relative;
    padding-left: 28px;
    margin-bottom: 1rem;
    font-weight: 600;
    font-size: 1rem;
    color: #cfd8dc;
    transition: color 0.3s ease;
  }
  .features li::before {
    content: "✓";
    position: absolute;
    left: 0;
    top: 1px;
    font-weight: 700;
    font-size: 1.25rem;
    color: #4fc3f7;
    text-shadow: 0 0 6px rgba(79, 195, 247, 0.6);
    transition: color 0.3s ease;
  }
  .swiper-slide:hover .features li {
    color: #90caf9;
  }
  .swiper-slide:hover .features li::before {
    color: #90caf9;
  }
  .btn-select {
    padding: 0.9rem 3rem;
    font-size: 1.15rem;
    font-weight: 700;
    border: none;
    border-radius: 30px;
    background: #4fc3f7;
    color: #0d1a2b;
    cursor: pointer;
    box-shadow: 0 8px 20px rgba(79, 195, 247, 0.6);
    transition: background-color 0.3s ease, box-shadow 0.4s ease, transform 0.3s ease;
    user-select: none;
    align-self: center;
  }
  .btn-select:hover,
  .btn-select:focus {
    background: #71c4ff;
    box-shadow: 0 12px 28px rgba(79, 195, 247, 0.9);
    outline: none;
    transform: scale(1.05);
  }
  .swiper-pagination-bullets {
    bottom: 10px !important;
  }
  .swiper-pagination-bullet {
    width: 14px;
    height: 14px;
    background: #375a7f;
    opacity: 0.8;
    box-shadow: 0 0 8px #4fc3f7cc;
    transition: background-color 0.4s ease, box-shadow 0.4s ease;
  }
  .swiper-pagination-bullet-active {
    background: #4fc3f7 !important;
    opacity: 1;
    box-shadow: 0 0 22px #4fc3f7ee !important;
  }

  #cart {
    position: fixed;
    top: 0;
    right: -320px;
    width: 320px;
    height: 100vh;
    background: #1e2c43;
    box-shadow: -4px 0 12px rgba(79,195,247,0.8);
    padding: 1rem 1.5rem;
    transition: right 0.3s ease;
    z-index: 10000;
    display: flex;
    flex-direction: column;
  }
  #cart.open {
    right: 0;
  }
  #cart h2 {
    margin-top: 0;
    font-size: 1.6rem;
    color: #4fc3f7;
    text-align: center;
    margin-bottom: 1rem;
  }
  #cart-items {
    flex-grow: 1;
    overflow-y: auto;
  }
  .cart-item {
    border-bottom: 1px solid #375a7f;
    padding: 0.6rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1rem;
    color: #cfd8dc;
  }
  .cart-item > div {
    flex-grow: 1;
  }
  .cart-item .remove-btn {
    background: transparent;
    border: none;
    color: #f44336;
    font-weight: 700;
    cursor: pointer;
    font-size: 1.1rem;
    margin-left: 0.8rem;
    user-select: none;
  }
  .cart-item .remove-btn:hover {
    color: #ff7961;
  }
  #cart-total {
    font-weight: 700;
    font-size: 1.3rem;
    color: #82c7ff;
    margin-top: 1rem;
    text-align: right;
  }
  #cart-close {
    background: transparent;
    border: none;
    color: #4fc3f7;
    font-size: 1.5rem;
    cursor: pointer;
    align-self: flex-end;
    margin-bottom: 0.5rem;
    user-select: none;
  }
  #cart-close:hover {
    color: #71c4ff;
  }

  @media (max-width: 992px) {
    section#planes {
      max-width: 90%;
    }
    .plan-price {
      font-size: 2.2rem;
    }
  }
  @media (max-width: 768px) {
    nav {
      padding: 1rem 1.5rem;
    }
    nav ul {
      display: none;
    }
    .logo {
      font-size: 1.4rem;
    }
    .plan-price {
      font-size: 2rem;
    }
    .swiper-slide {
      padding: 2rem 1.5rem 2.5rem;
      height: 420px;
    }
    #cart {
      width: 100%;
      right: -100%;
    }
    #cart.open {
      right: 0;
    }
  }
  @media (max-width: 480px) {
    .plan-title {
      font-size: 1.5rem;
    }
    .plan-price {
      font-size: 1.6rem;
      margin-bottom: 1rem;
    }
    .plan-desc {
      font-size: 1rem;
      margin-bottom: 1.2rem;
    }
    .features li {
      font-size: 0.95rem;
      padding-left: 24px;
      margin-bottom: 0.75rem;
    }
    .features li::before {
      font-size: 1.1rem;
      top: 0;
    }
    .btn-select {
      padding: 0.8rem 2.5rem;
      font-size: 1rem;
    }
    .swiper-slide {
      height: auto;
      min-height: 400px;
    }
  }
</style>
</head>
<body>

<nav role="navigation" aria-label="Menú principal">
  <div class="logo" tabindex="0">JaabWeb</div>
  <ul>
    <li><a href="#planes">Planes</a></li>
    <li><a href="dashboard.php">Inicio</a></li>
  </ul>
  <button class="cart-btn" aria-label="Abrir carrito de compras" id="open-cart-btn">Carrito (0)</button>
</nav>

<section id="planes" aria-label="Planes profesionales JaabWeb">
  <div class="swiper mySwiper" data-aos="fade-up">
    <div class="swiper-wrapper">
      <div class="swiper-slide" data-aos="zoom-in" data-plan="Plan Básico" data-price="2500">
        <div class="plan-title">Plan Básico</div>
        <div class="plan-price">$2,500 MXN</div>
        <p class="plan-desc">Presencia básica para emprendedores.</p>
        <ul class="features">
          <li>Diseño responsive</li>
          <li>1 página personalizada</li>
          <li>Formulario de contacto</li>
          <li>SEO básico</li>
          <li>Soporte email 24/7</li>
        </ul>
        <button class="btn-select">Seleccionar</button>
      </div>
      <div class="swiper-slide" data-aos="zoom-in" data-plan="Plan Profesional" data-price="6000">
        <div class="plan-title">Plan Profesional</div>
        <div class="plan-price">$6,000 MXN</div>
        <p class="plan-desc">Funcionalidades avanzadas para crecer.</p>
        <ul class="features">
          <li>Diseño responsive y personalizado</li>
          <li>Hasta 5 páginas</li>
          <li>Blog integrado</li>
          <li>SEO avanzado</li>
          <li>Soporte telefónico y chat</li>
        </ul>
        <button class="btn-select">Seleccionar</button>
      </div>
      <div class="swiper-slide" data-aos="zoom-in" data-plan="Plan Premium" data-price="10500">
        <div class="plan-title">Plan Premium</div>
        <div class="plan-price">$10,500 MXN</div>
        <p class="plan-desc">Solución completa y escalable.</p>
        <ul class="features">
          <li>Diseño a medida y branding completo</li>
          <li>Páginas ilimitadas</li>
          <li>E-commerce integrado</li>
          <li>Soporte dedicado 24/7</li>
        </ul>
        <button class="btn-select">Seleccionar</button>
      </div>
      <div class="swiper-slide" data-aos="zoom-in" data-plan="Plan Startup" data-price="9000">
        <div class="plan-title">Plan Startup</div>
        <div class="plan-price">$9,000 MXN</div>
        <p class="plan-desc">Para startups con proyección.</p>
        <ul class="features">
          <li>Diseño personalizado</li>
          <li>10 páginas</li>
          <li>SEO y analytics</li>
          <li>Soporte prioritario</li>
        </ul>
        <button class="btn-select">Seleccionar</button>
      </div>
      <div class="swiper-slide" data-aos="zoom-in" data-plan="Plan Corporativo" data-price="16000">
        <div class="plan-title">Plan Corporativo</div>
        <div class="plan-price">$16,000 MXN</div>
        <p class="plan-desc">Para grandes empresas.</p>
        <ul class="features">
          <li>Diseño corporativo</li>
          <li>Páginas ilimitadas</li>
          <li>Integración ERP y CRM</li>
          <li>Soporte premium y SLAs</li>
        </ul>
        <button class="btn-select">Seleccionar</button>
      </div>
      <div class="swiper-slide" data-aos="zoom-in" data-plan="Plan eCommerce" data-price="14000">
        <div class="plan-title">Plan eCommerce</div>
        <div class="plan-price">$14,000 MXN</div>
        <p class="plan-desc">Tienda online completa.</p>
        <ul class="features">
          <li>Diseño especializado para ventas</li>
          <li>Catálogo ilimitado</li>
          <li>Pasarelas de pago</li>
          <li>Soporte técnico dedicado</li>
        </ul>
        <button class="btn-select">Seleccionar</button>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<!-- Carrito lateral -->
<aside id="cart" aria-label="Carrito de compras" role="region" aria-live="polite" aria-atomic="true">
  <button id="cart-close" aria-label="Cerrar carrito">&times;</button>
  <h2>Carrito</h2>
  <div id="cart-items" tabindex="0" aria-live="polite" aria-relevant="additions removals"></div>
  <div id="cart-total">Total: $0 MXN</div>
</aside>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  // Inicialización Swiper
  const swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    keyboard: {
      enabled: true,
    },
    mousewheel: true,
    breakpoints: {
      320: { slidesPerView: 1, spaceBetween: 10 },
      600: { slidesPerView: 2, spaceBetween: 20 },
      992: { slidesPerView: 3, spaceBetween: 30 },
    },
  });

  AOS.init({ once: true });

  // Manejo carrito
  const cartBtn = document.getElementById('open-cart-btn');
  const cart = document.getElementById('cart');
  const cartCloseBtn = document.getElementById('cart-close');
  const cartItemsContainer = document.getElementById('cart-items');
  const cartTotalEl = document.getElementById('cart-total');

  let cartItems = [];

  // Función para actualizar el contador y mostrar items
  function updateCart() {
    // Actualizar contador en botón
    cartBtn.textContent = `Carrito (${cartItems.length})`;

    // Mostrar items en carrito
    if(cartItems.length === 0) {
      cartItemsContainer.innerHTML = '<p style="color:#90caf9; text-align:center; margin-top: 1rem;">Tu carrito está vacío.</p>';
      cartTotalEl.textContent = 'Total: $0 MXN';
      return;
    }

    let html = '';
    let total = 0;
    cartItems.forEach((item, index) => {
      total += item.price;
      html += `<div class="cart-item" role="listitem">
        <div>${item.name}</div>
        <div>$${item.price.toLocaleString()} MXN</div>
        <button class="remove-btn" aria-label="Eliminar ${item.name} del carrito" data-index="${index}">&times;</button>
      </div>`;
    });
    cartItemsContainer.innerHTML = html;
    cartTotalEl.textContent = `Total: $${total.toLocaleString()} MXN`;

    // Agregar eventos para remover
    const removeBtns = cartItemsContainer.querySelectorAll('.remove-btn');
    removeBtns.forEach(btn => {
      btn.addEventListener('click', e => {
        const idx = parseInt(e.target.getAttribute('data-index'));
        if (!isNaN(idx)) {
          cartItems.splice(idx, 1);
          updateCart();
        }
      });
    });
  }

  // Añadir plan al carrito
  function addToCart(planName, planPrice) {
    cartItems.push({ name: planName, price: planPrice });
    updateCart();
    openCart();
  }

  // Abrir carrito
  function openCart() {
    cart.classList.add('open');
    cart.setAttribute('aria-hidden', 'false');
    cart.focus();
  }
  // Cerrar carrito
  function closeCart() {
    cart.classList.remove('open');
    cart.setAttribute('aria-hidden', 'true');
    cartBtn.focus();
  }

  // Eventos
  cartBtn.addEventListener('click', () => {
    if (cart.classList.contains('open')) {
      closeCart();
    } else {
      openCart();
    }
  });
  cartCloseBtn.addEventListener('click', closeCart);

  // Añadir evento a botones de planes
  document.querySelectorAll('.btn-select').forEach(button => {
    button.addEventListener('click', e => {
      const slide = e.target.closest('.swiper-slide');
      if (slide) {
        const planName = slide.getAttribute('data-plan');
        const planPrice = Number(slide.getAttribute('data-price'));
        addToCart(planName, planPrice);
      }
    });
  });

  // Inicializar carrito vacío
  updateCart();
</script>

</body>
</html>
