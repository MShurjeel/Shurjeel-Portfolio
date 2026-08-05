<!-- Contact Section -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <?php include 'includes/header.php' ?>
    <!-- Contact Section -->
    <section class="contact-section text-center" id="contact">
        <div class="container">
            <div class="contact-header mb-5">
                <h2 class="contact-title">Get In Touch</h2>
                <p class="contact-subtext">Tell me about your project and I'll be in touch shortly</p>
            </div>
            <div class="contact-info d-flex justify-content-center flex-wrap mb-5">
                <span class="contact-info-item"><i class="bi bi-envelope"></i>&nbsp;
                    hello@example.com</span>&emsp;&emsp;
                <span class="contact-info-item"><i class="bi bi-telephone"></i>&nbsp; +1 (555)
                    248-0192</span>&emsp;&emsp;
                <span class="contact-info-item"><i class="bi bi-geo-alt"></i>&nbsp; Austin, TX</span>
            </div>
            <div class="container"></div>
            <!-- contact form -->
            <div class="contact-form-card text-start">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <input type="text" name="name" class="form-control contact-input" placeholder="Your Name">
                        </div>
                        <div class="col-md-6 mb-4">
                            <input type="email" name="email" class="form-control contact-input"
                                placeholder="Your Email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="position-relative">
                                <input type="password" id="passwordField" name="password" class="form-control contact-input"
                                    placeholder="Enter Password">
                                <i class="bi bi-eye-slash password-toggle" id="togglePasswordIcon">
                                </i>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <input type="number" name="budget" class="form-control contact-input"
                                placeholder="Budget (USD)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <input type="tel" name="phone" class="form-control contact-input"
                                placeholder="Phone Number">
                        </div>
                        <div class="col-md-6 mb-4">
                            <input type="url" name="website" class="form-control contact-input"
                                placeholder="Your Website">
                        </div>
                    </div>
                    <div class="mb-4">
                        <input type="text" name="subject" class="form-control contact-input" placeholder="Subject">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <input type="date" name="preferred_date" class="form-control contact-input"
                                placeholder="Preferred Date">
                        </div>
                        <div class="col-md-6 mb-4">
                            <input type="time" name="preferred_time" class="form-control contact-input"
                                placeholder="Preferred Time">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="contact-label">Your Budget:</label>
                            <input type="range" name="budget_range" class="form-control contact-input" min="10000"
                                max="500000" step="5000" value="10000">
                            <div class="range-labels">
                                <span>PKR 10,000</span>
                                <span id="rangeValue">PKR 100,000</span>
                                <span>PKR 500,000</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="contact-label">Preferred Brand Colors:</label>
                            <input type="color" name="brand_color" class="form-control contact-input">
                            <input type="color" name="brand_color" class="form-control contact-input">
                            <input type="color" name="brand_color" class="form-control contact-input">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="project_type[]" value="web"
                                id="projWeb">
                            <label class="form-check-label" for="projWeb">Web App</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="project_type[]" value="mobile"
                                id="projMobile">
                            <label class="form-check-label" for="projMobile">Mobile App</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="project_type[]" value="branding"
                                id="projBrand">
                            <label class="form-check-label" for="projBrand">Branding</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgency" value="asap" id="urgencyAsap">
                            <label class="form-check-label" for="urgencyAsap">ASAP</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="urgency" value="flexible"
                                id="urgencyFlex">
                            <label class="form-check-label" for="urgencyFlex">Flexible</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <input type="file" name="attachment" class="form-control contact-input">
                    </div>
                    <div class="mb-4">
                        <select name="referral" class="form-control contact-input">
                            <option selected disabled>How did you hear about me?</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="referral">Referral</option>
                            <option value="search">Search Engine</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <textarea name="message" rows="6" class="form-control contact-input"
                            placeholder="Your Message"></textarea>
                    </div>
                    <input type="hidden" name="form_source" value="contact-page">

                    <div class="text-center">
                        <button type="submit" class="btn contact-submit-btn">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include 'includes/footer.php' ?>
    <script>
       
        // ===== Password Show/Hide =====
        const passwordField = document.getElementById('passwordField');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        toggleIcon.addEventListener('click', () => {
            console.log("Click hua!");
            console.log(passwordField);
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        });

        // Slider value change
        budgetRange.addEventListener('input', () => {
            console.log(budgetRange.value); // slider move karte waqt value dikhegi
            rangeValue.textContent = 'PKR ' + budgetRange.value;
        });
    </script>