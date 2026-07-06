/* ============================================
   DevSpace — Mouse Follow Effect & Animations
   ============================================ */

(function () {
  'use strict';

  // ==============================
  // MOUSE GLOW EFFECT (Canvas)
  // ==============================
  const canvas = document.getElementById('mouse-glow');
  const ctx = canvas.getContext('2d');

  let mouseX = window.innerWidth / 2;
  let mouseY = window.innerHeight / 2;
  let currentX = mouseX;
  let currentY = mouseY;
  const lerpFactor = 0.08;

  function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  function lerp(a, b, t) {
    return a + (b - a) * t;
  }

  function drawGlow() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    currentX = lerp(currentX, mouseX, lerpFactor);
    currentY = lerp(currentY, mouseY, lerpFactor);

    // Primary glow — blue/violet
    const gradient1 = ctx.createRadialGradient(currentX, currentY, 0, currentX, currentY, 500);
    gradient1.addColorStop(0, 'rgba(59, 130, 246, 0.12)');
    gradient1.addColorStop(0.3, 'rgba(139, 92, 246, 0.06)');
    gradient1.addColorStop(0.6, 'rgba(6, 182, 212, 0.03)');
    gradient1.addColorStop(1, 'transparent');

    ctx.fillStyle = gradient1;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Secondary glow — offset cyan
    const gradient2 = ctx.createRadialGradient(
      currentX + 100, currentY - 80, 0,
      currentX + 100, currentY - 80, 350
    );
    gradient2.addColorStop(0, 'rgba(6, 182, 212, 0.07)');
    gradient2.addColorStop(0.5, 'rgba(139, 92, 246, 0.03)');
    gradient2.addColorStop(1, 'transparent');

    ctx.fillStyle = gradient2;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Tertiary glow — pink accent
    const gradient3 = ctx.createRadialGradient(
      currentX - 120, currentY + 60, 0,
      currentX - 120, currentY + 60, 280
    );
    gradient3.addColorStop(0, 'rgba(236, 72, 153, 0.05)');
    gradient3.addColorStop(0.6, 'rgba(236, 72, 153, 0.02)');
    gradient3.addColorStop(1, 'transparent');

    ctx.fillStyle = gradient3;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    requestAnimationFrame(drawGlow);
  }

  // Mouse/touch handlers
  document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
  });

  document.addEventListener('touchmove', (e) => {
    mouseX = e.touches[0].clientX;
    mouseY = e.touches[0].clientY;
  });

  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();
  drawGlow();

  // ==============================
  // FLOATING PARTICLES
  // ==============================
  const particlesContainer = document.getElementById('particles-container');

  function createParticle() {
    const particle = document.createElement('div');
    particle.classList.add('particle');

    const size = Math.random() * 3 + 1;
    const left = Math.random() * 100;
    const duration = Math.random() * 15 + 10;
    const delay = Math.random() * 10;

    const colors = [
      'rgba(59, 130, 246, 0.4)',
      'rgba(139, 92, 246, 0.3)',
      'rgba(6, 182, 212, 0.3)',
      'rgba(236, 72, 153, 0.2)',
    ];
    const color = colors[Math.floor(Math.random() * colors.length)];

    particle.style.cssText = `
      width: ${size}px;
      height: ${size}px;
      left: ${left}%;
      background: ${color};
      animation-duration: ${duration}s;
      animation-delay: ${delay}s;
      box-shadow: 0 0 ${size * 3}px ${color};
    `;

    particlesContainer.appendChild(particle);
  }

  // Create initial particles
  for (let i = 0; i < 30; i++) {
    createParticle();
  }

  // ==============================
  // TYPING EFFECT
  // ==============================
  const typingElement = document.getElementById('typing-text');
  const phrases = [
    'Python Developer',
    'Machine Learning',
    'Data Science',
    'Java & Kotlin',
    'Web Developer',
    'Professor de Tecnologia',
  ];
  let phraseIndex = 0;
  let charIndex = 0;
  let isDeleting = false;
  let typingSpeed = 80;

  function typeEffect() {
    const currentPhrase = phrases[phraseIndex];

    if (isDeleting) {
      typingElement.textContent = currentPhrase.substring(0, charIndex - 1);
      charIndex--;
      typingSpeed = 40;
    } else {
      typingElement.textContent = currentPhrase.substring(0, charIndex + 1);
      charIndex++;
      typingSpeed = 80;
    }

    if (!isDeleting && charIndex === currentPhrase.length) {
      typingSpeed = 2000; // Pause at full phrase
      isDeleting = true;
    } else if (isDeleting && charIndex === 0) {
      isDeleting = false;
      phraseIndex = (phraseIndex + 1) % phrases.length;
      typingSpeed = 400; // Brief pause before new phrase
    }

    setTimeout(typeEffect, typingSpeed);
  }

  // Start typing after page loads
  setTimeout(typeEffect, 1200);

  // ==============================
  // HEADER SCROLL EFFECT
  // ==============================
  const header = document.querySelector('.header');
  let lastScroll = 0;

  window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;

    if (scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }

    lastScroll = scrollY;
  });

  // ==============================
  // MOBILE MENU TOGGLE
  // ==============================
  const menuToggle = document.getElementById('menu-toggle');
  const navLinks = document.getElementById('nav-links');

  if (menuToggle) {
    menuToggle.addEventListener('click', () => {
      navLinks.classList.toggle('open');
      menuToggle.classList.toggle('active');
    });

    // Close menu when a link is clicked
    navLinks.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navLinks.classList.remove('open');
        menuToggle.classList.remove('active');
      });
    });
  }

  // ==============================
  // SMOOTH SCROLL FOR NAV LINKS
  // ==============================
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // ==============================
  // TECH TAG STAGGER ANIMATION
  // ==============================
  const techTags = document.querySelectorAll('.tech-tag');
  techTags.forEach((tag, index) => {
    tag.style.animationDelay = `${0.4 + index * 0.05}s`;
    tag.style.animation = `fadeInUp 0.6s ease-out ${0.4 + index * 0.05}s both`;
  });

})();
