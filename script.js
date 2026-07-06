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
  const lerpFactor = 0.12;

  // Dot-field configuration (antigravity-style)
  const CELL = 26;          // grid spacing (px) — smaller = more dots
  const DOT_R = 1.6;        // radius of each little dot (px)
  const RADIUS = 220;       // light influence radius around the pointer (px)
  const RADIUS2 = RADIUS * RADIUS;
  const COLOR = '37, 99, 235'; // royal blue (blue-600)

  let time = 0;

  function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  function lerp(a, b, t) {
    return a + (b - a) * t;
  }

  // Deterministic pseudo-random per cell (0..1), so each dash keeps its identity
  function hash(col, row) {
    const n = Math.sin(col * 127.1 + row * 311.7) * 43758.5453;
    return n - Math.floor(n);
  }

  function drawGlow() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    time += 0.03;

    currentX = lerp(currentX, mouseX, lerpFactor);
    currentY = lerp(currentY, mouseY, lerpFactor);

    // Only iterate the grid cells inside the light radius (performance)
    const startCol = Math.floor((currentX - RADIUS) / CELL);
    const endCol = Math.ceil((currentX + RADIUS) / CELL);
    const startRow = Math.floor((currentY - RADIUS) / CELL);
    const endRow = Math.ceil((currentY + RADIUS) / CELL);

    for (let col = startCol; col <= endCol; col++) {
      for (let row = startRow; row <= endRow; row++) {
        const rnd = hash(col, row);
        // Small per-dot drift so the field feels alive / in motion
        const driftX = Math.sin(time + rnd * 6.28) * 3;
        const driftY = Math.cos(time * 0.8 + rnd * 6.28) * 3;
        const cx = col * CELL + CELL / 2 + driftX;
        const cy = row * CELL + CELL / 2 + driftY;

        const dx = cx - currentX;
        const dy = cy - currentY;
        const dist2 = dx * dx + dy * dy;
        if (dist2 > RADIUS2) continue;

        // Falloff: 1 at the pointer, 0 at the edge (eased)
        let t = 1 - Math.sqrt(dist2) / RADIUS;
        t = t * t;

        // Gentle twinkle so dots flicker in and out of view
        const twinkle = 0.55 + 0.45 * Math.sin(time * 2 + rnd * 12.56);
        const alpha = t * twinkle * 0.7;
        if (alpha < 0.02) continue;

        ctx.fillStyle = `rgba(${COLOR}, ${alpha})`;
        ctx.beginPath();
        ctx.arc(cx, cy, DOT_R, 0, 6.2832);
        ctx.fill();
      }
    }

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
