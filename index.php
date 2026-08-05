<?php require_once "config/config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Website</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
</head>

<body>
    <?php include 'includes/header.php' ?>
    <!-- Hero Section -->
    <section class="hero-section text-center" id="hero">
        <div class="container">
            <div class="profile-pic-wrapper mb-4 Glightbox">
                <a href="assets/images/hero section/hero-img-2.jpeg">
                    <img src="assets/images/hero section/hero-img-2.jpeg" alt="Muhammad Shurjeel"
                        class="profile-pic">
                </a>
            </div>
            <div class="status-badge mb-4">
                <span class="status-dot"></span>
                Available for new projects
            </div>
            <h1 class="hero-heading mb-4">
                I'm M Shurjeel,
                a <span class="highlight">product designer</span>
                & developer building delightful digital experiences.
            </h1>
            <p class="hero-subtext mb-4">
                For nearly a decade I've helped startups and studios ship interfaces that are as dependable as they
                are
                beautiful — from first sketch to final pixel.
            </p>
            <div class="hero-buttons d-flex justify-content-center gap-3 mb-5">
                <button type="button" class="btn custom-btn">
                    View My Work
                </button>
                <button type="button" class="btn custom-btn-outline">
                    Let's Talk
                </button>
            </div>
            <div class="social-icons">
                <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="social-icon"><i class="bi bi-dribbble"></i></a>
                <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="social-icon"><i class="bi bi-github "></i></a>
            </div>
            <div class="trusted-by-wrapper mt-5">
                <p class="trusted-by-text">Trusted by forward-thinking teams and studios</p>
                <div class="container trusted-by-logos d-flex justify-content-center align-items-center">
                    <img src="assets/images/hero section/clients-1.webp" alt="img1" class="trusted-logo">
                    <img src="assets/images/hero section/clients-2.webp" alt="img2" class="trusted-logo">
                    <img src="assets/images/hero section/clients-3.webp" alt="img3" class="trusted-logo">
                    <img src="assets/images/hero section/clients-4.webp" alt="img4" class="trusted-logo">
                    <img src="assets/images/hero section/clients-5.webp" alt="img5" class="trusted-logo">
                    <img src="assets/images/hero section/clients-6.webp" alt="img6" class="trusted-logo">
                </div>
            </div>
    </section>
    <!-- About Section -->
    <section class="about-section text-center" id="about">
        <div class="container">
            <h1 class="about-section-title">About Me</h1>
            <div class="about-subtext">
                <p>A short story, and a few numbers that sum up the journey</p>
            </div>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 about-paragraph">
                        <p>I'm a multidisciplinary product designer and front-end developer based in Austin, Texas.
                            I
                            help
                            founders
                            turn rough ideas into refined, usable products — pairing research-driven design
                            decisions
                            with
                            clean,
                            accessible code. When I'm not pushing pixels you'll find me sketching type, mentoring
                            juniors,
                            or
                            chasing good coffee.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="stats" class="container about-stats-container light-background">
            <div class="row  text-center">
                <div class="col-lg-3 ">
                    <div class="about-stats">
                        <p><span class="counter" data-count="8">0</span>+</p>
                        <div class="about-stats-text ">Years Experience</div>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="about-stats">
                        <p><span class="counter" data-count="120"> 0</span>+</p>
                        <div class="about-stats-text ">Projects Shipped</div>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="about-stats">
                        <p><span class="counter" data-count="48"> 0</span></p>
                        <div class="about-stats-text ">Happy Clients</div>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="about-stats mb-5">
                        <p><span class="counter" data-count="16"> 0</span></p>
                        <div class="about-stats-text"> Awards Won</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section -->
    <section class="services-section text-center" id="services">
        <div class="container">
            <div class="services-header">
                <h2 class="service-section-title text-white">
                    What I Do
                </h2>
                <p class="service-subtext">
                    A focused set of services, delivered end to end
                </p>
            </div>
            <div class="service-item">
                <div class="service-content d-flex">
                    <div class="service-number">
                        01
                    </div>
                    <div>
                        <h3 class="service-title">
                            UI / UX Design
                        </h3>
                        <p class="service-description">
                            Research-led interfaces with clear hierarchy and effortless flows.
                        </p>
                    </div>
                </div>
                <div class="service-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
            <div class="service-item">
                <div class="service-content d-flex">
                    <div class="service-number">
                        02
                    </div>
                    <div>
                        <h3 class="service-title">
                            Front-End Development
                        </h3>
                        <p class="service-description">
                            Pixel-accurate, accessible builds in modern frameworks.
                        </p>
                    </div>
                </div>
                <div class="service-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
            <div class="service-item">
                <div class="service-content d-flex">
                    <div class="service-number">
                        03
                    </div>
                    <div>
                        <h3 class="service-title">
                            Design Systems
                        </h3>
                        <p class="service-description">
                            Scalable component libraries that keep teams shipping consistently.
                        </p>
                    </div>
                </div>
                <div class="service-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
            <div class="service-item">
                <div class="service-content d-flex">
                    <div class="service-number">
                        04
                    </div>
                    <div>
                        <h3 class="service-title">
                            Brand & Identity
                        </h3>
                        <p class="service-description">
                            Distinct visual identities that give products a memorable voice.
                        </p>
                    </div>
                </div>
                <div class="service-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
            <div class="service-item">
                <div class="service-content d-flex">
                    <div class="service-number">
                        05
                    </div>
                    <div>
                        <h3 class="service-title">
                            Product Strategy
                        </h3>
                        <p class="service-description">
                            Turning fuzzy goals into focused, validated roadmaps.
                        </p>
                    </div>
                </div>
                <div class="service-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>
        </div>
    </section>
    <!-- Skills Section -->
    <section class="skills-section text-center text-white" id="skills">
        <div class="container">
            <div class="skills-header">
                <h2 class="skills-section-title">Skills &amp; Tools</h2>
                <p class="skills-subtext">The craft and software I reach for every day</p>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row text-start">
                <!-- Left -->
                <div class="col-lg-5">
                    <h3 class="skills-left-title">A blend of design taste and engineering rigor.</h3>
                    <p class="skills-left-text">
                        I move comfortably between the canvas and the codebase, which means designs
                        stay faithful from concept to production. Here's where I spend most of my time.
                    </p>
                    <div class="skill-tags light-background">
                        <span class="skill-tag">Figma</span>
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">TypeScript</span>
                        <span class="skill-tag">SCSS</span>
                        <span class="skill-tag">Webflow</span>
                        <span class="skill-tag">Framer</span>
                    </div>
                </div>
                <!-- Right -->
                <div class="col-lg-6">
                    <div class="skill-item">
                        <div class="skill-item-header">
                            <span class="skill-label">Interface Design</span>
                            <span class="skill-percent">95%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="progress-bar" style="width: 95%;"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-item-header">
                            <span class="skill-label">Front-End Development</span>
                            <span class="skill-percent">90%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="progress-bar" style="width: 90%;"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-item-header">
                            <span class="skill-label">Design Systems</span>
                            <span class="skill-percent">88%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="progress-bar" style="width: 88%;"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-item-header">
                            <span class="skill-label">Prototyping &amp; Motion</span>
                            <span class="skill-percent">82%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="progress-bar" style="width: 82%;"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-item-header">
                            <span class="skill-label">Brand &amp; Visual Identity</span>
                            <span class="skill-percent">78%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="progress-bar" style="width: 78%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Experience Section -->
    <section class="experience-section text-center text-white" id="experience">
        <div class="container mb-5">
            <div class="experience-header">
                <h2 class="experience-title">Experience</h2>
                <p class="experience-subtext">The roles and milestones that shaped how I work today</p>
            </div>
            <div class="row text-start">
                <!-- Left: Work timeline -->
                <div class="col-lg-6">
                    <div class="timeline-column-header d-flex align-items-center mb-4">
                        <div class="timeline-icon"><i class="bi bi-briefcase"></i></div>&emsp;
                        <h3 class="timeline-column-title">Work</h3>
                    </div>
                    <div class="timeline">
                        <div class="timeline-item mb-4">
                            <span class="timeline-dot"></span>
                            <span class="timeline-year">2021 — Present</span>
                            <h4 class="timeline-title">Senior Product Designer</h4>
                            <p class="timeline-subtitle">Lumen Inc. · Remote</p>
                            <p class="timeline-text">Lead designer on the analytics platform, owning everything from
                                research to shipped UI and the design system that supports it.</p>
                        </div>
                        <div class="timeline-item mb-4">
                            <span class="timeline-dot"></span>
                            <span class="timeline-year">2018 — 2021</span>
                            <h4 class="timeline-title">Product Designer &amp; Front-End</h4>
                            <p class="timeline-subtitle">Northwind Studio · Austin</p>
                            <p class="timeline-text">Designed and built marketing sites and web apps for early-stage
                                startups, bridging design and engineering on small teams.</p>
                        </div>
                        <div class="timeline-item">
                            <span class="timeline-dot"></span>
                            <span class="timeline-year">2016 — 2018</span>
                            <h4 class="timeline-title">UI Designer</h4>
                            <p class="timeline-subtitle">Atlas Agency · Austin</p>
                            <p class="timeline-text">Crafted interfaces and brand systems for agency clients across
                                fintech, health, and consumer products.</p>
                        </div>
                    </div>
                </div>
                <!-- Right: Education & Awards timeline -->
                <div class="col-lg-6">
                    <div class="timeline-column-header d-flex align-items-center mb-4">
                        <div class="timeline-icon"><i class="bi bi-mortarboard"></i></div>&emsp;
                        <h3 class="timeline-column-title">Education &amp; Awards</h3>
                    </div>
                    <div class="timeline">
                        <div class="timeline-item mb-4">
                            <span class="timeline-dot"></span>
                            <span class="timeline-year">2012 — 2016</span>
                            <h4 class="timeline-title">BFA, Communication Design</h4>
                            <p class="timeline-subtitle">University of Texas · Austin</p>
                            <p class="timeline-text">Graduated with honors. Focused on typography, interaction design,
                                and the craft of building usable systems.</p>
                        </div>
                        <div class="timeline-item mb-4">
                            <span class="timeline-dot"></span>
                            <span class="timeline-year">2022</span>
                            <h4 class="timeline-title">Awwwards — Site of the Day</h4>
                            <p class="timeline-subtitle">Lumen Analytics</p>
                            <p class="timeline-text">Recognized for design excellence and accessibility on a complex
                                data product.</p>
                        </div>
                        <div class="timeline-item">
                            <span class="timeline-dot"></span>
                            <span class="timeline-year">2020</span>
                            <h4 class="timeline-title">CSS Design Awards — Winner</h4>
                            <p class="timeline-subtitle">Marrow Coffee</p>
                            <p class="timeline-text">Honored for a bold, cohesive brand and e-commerce experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="experience-btn mt-2">
            <i class="bi bi-download"></i> Download Full Resume
        </a>
    </section>
    <!-- Selected Work Section -->
    <section class="work-section text-center text-white" id="portfolio">
        <div class="container">
            <div class="work-header">
                <h2 class="work-title">Selected Work</h2>
                <p class="work-subtext">A closer look at a few projects and the impact they made</p>
            </div>
            <!-- Work Item 1 -->
            <div class="row align-items-center text-start work-item">
                <!-- Left: project image -->
                <div class="col-lg-6">
                    <div class="work-image-wrapper">
                        <img src="assets/images/portfolio-images/portfolio-1.webp" alt="Lumen Analytics"
                            class="work-image">
                    </div>
                </div>
                <!-- Right: project details -->
                <div class="col-lg-6">
                    <span class="work-meta">WEB APP · 2024</span>
                    <h3 class="work-project-title">Lumen Analytics</h3>
                    <p class="work-description">
                        A calmer way to read product metrics. We rebuilt the information architecture
                        and shipped a focused dashboard that cut time-to-insight in half.
                    </p>
                    <a href="#" class="work-link">
                        View case study <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <!-- Work Item 2 -->
            <div class="row align-items-center text-start work-item">
                <div class="col-lg-6 order-lg-1">
                    <span class="work-meta">MOBILE APP · 2023</span>
                    <h3 class="work-project-title">Pace Fitness</h3>
                    <p class="work-description">
                        An iOS coaching app designed around real gestures and motivation. Daily
                        active users doubled within three months of launch.
                    </p>
                    <a href="#" class="work-link">
                        View case study <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <div class="work-image-wrapper">
                        <img src="assets/images/portfolio-images/portfolio-2.webp" alt="Pace Fitness"
                            class="work-image">
                    </div>
                </div>
            </div>
            <!-- Work Item 3 -->
            <div class="row align-items-center text-start work-item">
                <div class="col-lg-6">
                    <div class="work-image-wrapper">
                        <img src="assets/images/portfolio-images/portfolio-3.webp" alt="Marrow Coffee"
                            class="work-image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="work-meta">BRANDING · 2023</span>
                    <h3 class="work-project-title">Marrow Coffee</h3>
                    <p class="work-description">
                        A full identity system for a specialty roaster — logo, packaging, and a warm
                        visual language that scaled across every touchpoint.
                    </p>
                    <a href="#" class="work-link">
                        View case study <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Section -->
    <section class="testimonials-section text-center text-white">
        <div class="container">
            <div class="testimonials-header">
                <h2 class="testimonials-title">Kind Words</h2>
                <p class="testimonials-subtext">A few notes from people I've had the joy of working with</p>
            </div>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="testimonial-card">
                                    <div class="testimonial-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <p class="testimonial-text">
                                        Shurjeel translated a vague idea into a product our users adore.
                                        The detail in both design and code was outstanding.
                                    </p>
                                    <div class="testimonial-footer align-items-center">
                                        <img src="assets/images/testimonials/person1.webp" alt="Elena Ross"
                                            class="img-fluid testimonial-avatar">
                                        <div>
                                            <h5 class="testimonial-name">Elena Ross</h5>
                                            <p class="testimonial-role">Founder, Lumen</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2:-->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="testimonial-card">
                                    <div class="testimonial-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <p class="testimonial-text">
                                        Rare to find someone equally strong in design and engineering.
                                        Deadlines met, communication clear, result above expectations.
                                    </p>
                                    <div class="testimonial-footer align-items-center">
                                        <img src="assets/images/testimonials/person2.webp" alt="Marcus Hale"
                                            class="img-fluid testimonial-avatar">
                                        <div>
                                            <h5 class="testimonial-name">Marcus Hale</h5>
                                            <p class="testimonial-role">PM, Northwind</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="testimonial-card">
                                    <div class="testimonial-stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <p class="testimonial-text">
                                        Our design system was a mess before Shurjeel. He brought order
                                        and consistency that let the whole team move twice as fast.
                                    </p>
                                    <div class="testimonial-footer align-items-center">
                                        <img src="assets/images/testimonials/person3.webp" alt="Priya Nair"
                                            class="img-fluid testimonial-avatar">
                                        <div>
                                            <h5 class="testimonial-name">Priya Nair</h5>
                                            <p class="testimonial-role">Design Lead, Atlas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0"
                        class="active"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2"></button>
                </div>
            </div>
        </div>
    </section>
    <!-- How I Work Section -->
    <section class="process-section text-center text-white">
        <div class="container">
            <h2 class="process-title">How I Work</h2>
            <p class="process-subtext">A simple, collaborative process that keeps projects on track</p>
            <div class="row text-start">
                <!-- Step 1 -->
                <div class="col-lg-3 ">
                    <div class="process-card">
                        <span class="process-number">01</span>
                        <div class="process-icon"><i class="bi bi-search"></i></div>
                        <h4 class="process-card-title">Discover</h4>
                        <p class="process-card-text">
                            We dig into your goals, users, and constraints so we're solving
                            the right problem from day one.
                        </p>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="col-lg-3">
                    <div class="process-card">
                        <span class="process-number">02</span>
                        <div class="process-icon"><i class="bi bi-pencil-square"></i></div>
                        <h4 class="process-card-title">Design</h4>
                        <p class="process-card-text">
                            Wireframes evolve into polished, interactive designs — reviewed
                            together at every milestone.
                        </p>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="col-lg-3">
                    <div class="process-card">
                        <span class="process-number">03</span>
                        <div class="process-icon"><i class="bi bi-code-square"></i></div>
                        <h4 class="process-card-title">Build</h4>
                        <p class="process-card-text">
                            Designs become accessible, performant front-end code with no
                            fidelity lost in handoff.
                        </p>
                    </div>
                </div>
                <!-- Step 4 -->
                <div class="col-lg-3">
                    <div class="process-card active">
                        <span class="process-number">04</span>
                        <div class="process-icon"><i class="bi bi-rocket-takeoff"></i></div>
                        <h4 class="process-card-title">Launch</h4>
                        <p class="process-card-text">
                            We ship, measure, and refine — with support through release
                            and beyond.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA Section -->
    <section class="cta-section text-center">
        <div class="container">
            <span class="cta-badge">Let's work together</span>
            <h2 class="cta-title mb-4">Ready to bring your next idea to life?</h2>
            <p class="cta-subtext mb-4">
                I have room for one or two new projects this quarter. If you're
                building something you care about, I'd love to hear about it.
            </p>
            <a href="contact.php" target="_blank" class="btn cta-btn mb-4">
                Start a Project <i class="bi bi-arrow-right"></i>
            </a>
            <p class="cta-note">
                <i class="bi bi-clock"></i>
                Typical reply within 24 hours
            </p>
        </div>
    </section>
    <!-- Newsletter Section -->
    <!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-box text-center">
            <h2 class="newsletter-title">Stay in the Loop</h2>
            <p class="newsletter-text">
                Subscribe for design insights, development tips, and portfolio updates.
            </p>

            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Your email">
                <button class="newsletter-btn">Subscribe</button>
            </form>
        </div>
    </div>
</section>
    <?php include 'includes/footer.php' ?>
</body>

</html>