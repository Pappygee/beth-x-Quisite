// main.js

document.addEventListener('DOMContentLoaded', function () {
    const productsContainer = document.querySelector('.all-collection');
    const collectionBtns = document.querySelectorAll('.collection-btn');
    let products = [];

    // Fetch and render products
    function fetchProducts(collectionId = 0) {
        let url = 'products.php';
        if (collectionId) url += '?collection_id=' + collectionId;
        fetch(url)
            .then(res => res.json())
            .then(data => {
                products = data;
                renderProducts();
            });
    }

    // Render product cards
    function renderProducts() {
        if (!productsContainer) return;
        productsContainer.innerHTML = '';
        if (products.length === 0) {
            productsContainer.innerHTML = '<p>No products found.</p>';
            return;
        }
    products.forEach(prod => {
      const card = document.createElement('div');
      card.className = 'Products';
      card.style = 'border-radius:0.5rem;margin:2.5rem;width:21.25rem;box-shadow:0 0.25rem 0.5rem 0 rgba(0,0,0,0.2);background-color:fdfafa;';
      card.innerHTML = `
        <img src="${prod.image}" alt="${prod.name}" style="border-radius:0.5rem;background-color:white;width:100%;object-fit:cover;height:17.5rem;"><br>
        <div class="text" style="padding:0.625rem;margin:0.3125rem;">
          <h3 style=" color:#111827;font-size:1.4rem;display:inline-block;margin-right:8.125rem;">${prod.name}</h3>
          <span style="height:auto;display:inline-block;padding:0.5rem;border-radius:0.5rem;font-size:medium;background:#e6e6e6;">${prod.collection_name || ''}</span>
          <p style="width:20.625rem;font-size:0.950rem;">${prod.description}</p>
          <b style="color:#111827;font-size:1.2rem;margin-right:0.375rem;">₦${Number(prod.price).toLocaleString()}</b>
          <button class="add-to-cart-btn" style="margin-left:12.5rem;padding:0.695rem;width:5.625rem;color:white;background:#d32f2f;border:none;border-radius:1.25rem;" data-name="${encodeURIComponent(prod.name)}">Add to Cart</button>
        </div>
      `;
      productsContainer.appendChild(card);
    });
    }

  // Collection filter
  collectionBtns.forEach((btn, idx) => {
    btn.addEventListener('click', function () {
      collectionBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      if (btn.textContent === 'All') {
        fetchProducts();
      } else {
        // Find collection id by name
        fetch('products.php')
          .then(res => res.json())
          .then(data => {
            let btnName = btn.textContent;
            const nameMap = {
              'Body Spray': 'Body Spray',
              'Perfume': 'Perfume',
              'Roll On': 'Roll On',
              'Perfume Oil': 'Perfume Oil',
              'Combo': 'Combo'
            };
            const mappedName = nameMap[btnName] || btnName;
            const prod = data.find(p => p.collection_name && p.collection_name.toLowerCase() === mappedName.toLowerCase());
            if (prod) fetchProducts(prod.collection_id);
            else productsContainer.innerHTML = '<p>No products found.</p>';
          });
      }
    });
  });

    // WhatsApp Add to Cart
    productsContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-to-cart-btn')) {
            const prodName = decodeURIComponent(e.target.getAttribute('data-name'));
            const phone = '2349066733487'; // Nigeria country code + number
            const msg = encodeURIComponent(`Hello, I’m interested in buying ${prodName}. Is it available?`);
            window.open(`https://wa.me/${phone}?text=${msg}`, '_blank');
        }
    });

    // Initial load
    fetchProducts();
});

        //navbar click scroll
 // Select all navbar links
  document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault(); // Prevent default jump behavior
      
      // Get target section ID from href
      const targetId = this.getAttribute('href').substring(1);
      const targetSection = document.getElementById(targetId);

      // Scroll smoothly to section
      targetSection.scrollIntoView({
        behavior: 'smooth'
      });
    });
  });



   // Smooth scroll on navbar click
  document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      const targetSection = document.getElementById(targetId);
      targetSection.scrollIntoView({ behavior: 'smooth' });
    });
  });

  // Section animation on scroll
  const sections = document.querySelectorAll('.section');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show'); // animate in
      }
    });
  }, { threshold: 0.2 }); // trigger when 20% of section is visible

  sections.forEach(section => {
    observer.observe(section);
  });